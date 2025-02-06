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
      
        $projects = DB::select("SELECT * FROM qr_basic_info WHERE userid = ? ORDER BY created_at DESC", [$userId]);
         
        return view('analytics',compact('projects'));
    }
    public function create() {
        return view('qrcode.create');
    }

    // Generate QR Code and Save to DB
    public function myqrcode(Request $request) {
        $request->validate([
            'countrycode' => 'required',
            'phone' => 'required',
            'sms' => 'required',
            'projectname' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'usage' => 'required',
        ]);

        $message = "Phone: " . $request->countrycode . $request->phone . "\nMessage: " . $request->sms;
        
        // Generate QR Code and save to storage
       $data = 'http://127.0.0.1:8000/';
        

        
    
       // Define storage path for QR code
    $qrCodePath = 'qrcodes/' . time() . '.svg';

    // Generate QR Code with Logo (Merge Logo)
    $qrCode = QrCode::format('svg')
        // Merge logo
        ->size(300)
        ->errorCorrection('H')
        ->generate($data);

    // Save QR Code to Storage
    Storage::disk('public')->put($qrCodePath, $qrCode);

    // Generate the full URL of the QR Code
    $qrCodeUrl = asset('storage/' . $qrCodePath);

        // Save in DB
        $sms = Sms::create([
            'countrycode' => $request->countrycode,
            'phonenumber' => $request->phone,
            'qrsms' => $request->sms,
            'project_name' => $request->projectname,
            'start_date' => $request->startdate,
            'end_date' => $request->enddate,
            'usage' => $request->usage,
            'remarks' => $request->remarks,
            'qr_code_path' => $qrCodePath,
        ]);

        return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
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

    public function myqrcodelist()
    {
        return view('my-qr-code');
    }
        

       
    public function upgrade()
    {
        return view('upgrade');
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

    $userId = Auth::user()->username;



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
        'urlcode', 'btcqr', 'apkqr', 'dynamicurlcode', 'emailqr', 'epcqr', 'eventqr',
        'facebookqr', 'imageqr', 'mp3qr', 'pdfqr', 'smsqr', 'textqr', 'twitterqr', 'vcard',
        'vcardplus', 'videoqr', 'wifiqr', 'couponqr', 'businessqr', 'socmedqr'
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
        ->where('username', $userId)
        ->orderBy('created_At', 'desc')
        ->first();

    $subscriptionStart = Carbon::parse($user->subscription_start);
    $subscriptionEnd = Carbon::parse($user->subscription_end);
    $currentDate = Carbon::now();

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

    return view('dashboard', compact('userId','qrCodes', 'validity', 'dynamic', 'static', 'remainingDays', 'isPast', 'diffTotal'));
}




          
          
}
