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
      
        $projects = DB::select("SELECT * FROM qr_basic_info WHERE userid = ? ORDER BY created_at DESC", [$userId]);
         
        return view('analytics',compact('projects'));
    }
    public function create() {
        return view('qrcode.create');
    }

    // Generate QR Code and Save to DB
    public function myqrcode(Request $request) {
        $request->validate([
            'phone' => 'required',
            'sms' => 'required',
            'projectname' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'usage' => 'required',
            'folderinput'=>'required'
        ]);

        $message = [
            'Phone' => $request->countrycode . $request->phone,
            'Message' => $request->sms,
        ];
    
        
        // Generate QR Code and save to storage
       $data = 'https://infiniteqrcode.com/';
        

        
    
   
    $projectCode = 'P' . time() . rand(100, 999);
    $qrCodePath = 'qrcodes/' . $projectCode . '.svg';

        // Generate QR Code with Logo (Merge Logo)

        $qrCode = QrCode::format('svg')
            //  Merge logo
            ->size(300)
            ->errorCorrection('H')
            ->generate($data);

        // Save QR Code to Storage
        Storage::disk('public')->put($qrCodePath, $qrCode);

        // Generate the full URL of the QR Code
        $qrCodeUrl = asset('storage/' . $qrCodePath);

        // Save in DB
        $sms = Sms::create([
            'code' => $projectCode,
            'qrtype' => $request->qroption,
            'qrsms' => $request->sms,
            'countrycode' => $request->countrycode,
            'phonenumber' => $request->phone,
            'url'=>$qrCodeUrl  ,
            'qrimage'=>$qrCodePath,
            'userid' => Auth::user()->id ?? 'Guest', // Store user ID or 'Guest'
             
        ]);
        $qrBasicInfo = QrBasicInfo::create([
            'project_code' => $projectCode,
            'project_name' => $request->projectname,
            'folder_name' => $request->folderinput, // Storing in 'qrcodes' folder
            'qrtype' => $request->qroption, // Assuming QR type is SMS
            'start_date' => $request->startdate,
            'end_date' => $request->enddate,
            'usage_type' => $request->usage,
            'remarks' => $request->remarks,
            'url'=>$qrCodeUrl  ,
            'userid' => Auth::user()->id ?? 'Guest', // Store user ID or 'Guest'
            'qrtable' => 'smsqr', // Store QR content
            'total_scans' => 0,
            'unique_scans' => 0,
            
        ]);

        $qrCode = QrCode::format('svg')
        // Merge logo
        ->size(300)
        ->errorCorrection('H')
        ->generate($data);

    // Save QR Code to Storage
    Storage::disk('public')->put($qrCodePath, $qrCode);

    // Generate the full URL of the QR Code
    $qrCodeUrl = asset('storage/' . $qrCodePath);
    

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

    public function mysms($id)
    {
        $qrCode = QrBasicInfo::findOrFail($id);
        // $userId = Auth::user()->id;
        

        return view('mysms', compact('qrCode'));
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
