<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Response;
use App\Models\Sms;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\QrBasicInfo;



class HomeController extends Controller
{
    public function createqrcode()
    {
        return view('createqrcode'); 
    }

    public function url()
    {
        return view('url'); 
    }
    public function video()
    {
        return view('video'); 
    }
    public function wifi()
    {
        return view('wifi'); 
    }
    public function vcard()
    {
        return view('vcard'); 
    }
    public function sms()
    {
        return view('sms'); 
    }
    public function email()
    {
        return view('email'); 
    }
    public function image()
    {
        return view('image'); 
    }
    public function pdf()
    {
        return view('pdf');
    }
    public function bitcoin()
    {
        return view('bitcoin');
    }
    public function mp3()
    {
        return view('mp3'); 
    }
    public function appstore()
    {
        return view('appstore'); 
    }
    public function socialmedia()
    {
        return view('socialmedia');
    }
    public function analytics()
    {

        // $userId = auth()->id();
        $userId = auth()->id(); // Get the authenticated user's ID
      
        // $projects = DB::select("SELECT * FROM qr_basic_info WHERE userid = ? ORDER BY created_at DESC", [$userId]);
        $projects = QrBasicInfo::where('userid',$userId)->orderBy('created_at','desc')->get();
        return view('analytics',compact('projects'));
    }
    public function create() {
        return view('qrcode.create');
    }
    // Show QR Code List
    public function list() {
        $qrcodes = Sms::latest()->get();
        return view('scan', compact('qrcodes'));
    }

    // Show QR Code Details
    public function show($id) {
        $sms = Sms::findOrFail($id);
        return view('qrcode.show', compact('sms'));
    }

    public function plandetails()
    {
        return view('plandetails');
    }
    public function index()
    {
        return view('index');
    }
    public function signin()
    {
        return view('signin');
    }

    public function dashboard()
    {
        // Get the authenticated user's ID
        // $userId = Auth::user()->username;

        $userId = Auth::user()->id;

        // Fetch the latest 3 project codes from 'qr_basic_info'
        $codes = DB::table('qr_basic_info')
            ->where('userid', $userId)
            ->orderByDesc('created_At')
            ->limit(3)
            ->pluck('project_code')
            ->toArray();  

        $qrCodes = [];
        $combinedResults = [];

        // Define all QR code tables
        $tables = [
            'urlcode', 'btcqr', 'apkqr','emailqr','imageqr', 'mp3qr', 'pdfqr', 'smsqr',
            'vcard', 'videoqr', 'wifiqr', 'socmedqr'
        ]; 

        foreach ($codes as $code) {
            foreach ($tables as $table) {
                $results = DB::table($table)
                    ->select('id', 'url', 'code', 'qrtype', 'created_at as date', 'userid')
                    ->where('userid', $userId)
                    ->where('code', $code)
                    ->get();  

                foreach ($results as $row) {
                    $combinedResults[] = (array)$row;
                }
            }
        }

        foreach ($combinedResults as $item) {
            if (isset($item['code'])) {
                $id = $item['code'];
                $project = DB::table('qr_basic_info')
                    ->where('project_code', $id)
                    ->select('project_name', 'total_scans')
                    ->first();

                $item['projectname'] = $project->project_name ?? '';
                $item['totalscans'] = $project->total_scans ?? '0';
                $qrCodes[] = $item;
            }
        }

        // Fetch user subscription details
        $user = DB::table('users')
            ->where('id', $userId)
            ->orderBy('created_At', 'desc')
            ->first(); 

        $subscriptionStart = Carbon::parse($user->subscription_start);
        $subscriptionEnd = Carbon::parse($user->subscription_end); 
        $currentDate = Carbon::now();

        $timestamp = strtotime($subscriptionEnd);
        $formattedDate = date('d M. Y', $timestamp); 

        $diffTotal = $subscriptionStart->diffInDays($subscriptionEnd); 
        $remainingDays = $currentDate->diffInDays($subscriptionEnd, false);
        $isPast = $currentDate->greaterThan($subscriptionEnd);

        // Set validity based on plan type
        $validity = 0;
        $dynamic = 0;
        $static = 0;

        switch ($user->plan) {
            case 'free':
                $validity = 50;
                $dynamic = 5;
                $static = 5;
                break;
            case 'basic':
                $validity = 5000;
                $dynamic = 10;
                $static = '∞';
                break;
            case 'pro':
                $validity = 20000;
                $dynamic = '∞';
                $static = '∞';
                break;
            case 'expert':
                $validity = '∞';
                $dynamic = '∞';
                $static = '∞';
                break;
        } 


        $staticCount = 0;
        $dynamicCount = 0;

        $infos = DB::table('qr_basic_info')
            ->where('userid', $userId)
            ->get(); 


            foreach ($infos as $item) {
                if ($item->qrtype === 'Static') {
                    $staticCount++;
                } elseif ($item->qrtype === 'Dynamic') {
                    $dynamicCount++;
                }
            }
            $totalCount = $staticCount + $dynamicCount;

    return view('dashboard', compact('userId', 'user','formattedDate','totalCount','staticCount','dynamicCount','qrCodes', 'validity', 'dynamic', 'static', 'remainingDays', 'isPast', 'diffTotal'));
}
public function scanData(){


    $userId = Auth::user()->id;

    $response = QrBasicInfo::selectRaw('DATE(qr_basic_info.created_At) AS scan_date, qr_basic_info.qrtype, SUM(qr_basic_info.total_scans) AS total_scans')
    ->leftJoin('users', 'qr_basic_info.userid', '=', 'users.id')
    ->where('qr_basic_info.userid', $userId)
    ->where(function ($query) {
        $query->where('qr_basic_info.created_At', '>=', DB::raw('CURDATE() - INTERVAL 7 DAY'))
              ->orWhereBetween('qr_basic_info.created_At', [DB::raw('users.subscription_start'), DB::raw('users.subscription_end')]);
    })
    ->where('renew_status', 'Enabled')
    ->where('users.subscribe_status', 'Active')
    ->groupBy('scan_date', 'qr_basic_info.qrtype')
    ->orderBy('scan_date')
    ->orderBy('qr_basic_info.qrtype')
    ->get();

    return response()->json($response);

}



          
          
}
