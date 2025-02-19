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
use App\Models\Scan;
use App\Models\ScanStatistics;

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
    public function analytics($code = null)
    {
        // $userId = auth()->id();
        $userId = Auth::user()->id; // Get the authenticated user's ID
        if ($code) {
            $project = QrBasicInfo::where('project_code',$code)->first(); 
            
            return view('analytics',['project'=>$project,'code'=>$code]);
        }
        else{
            $projects = QrBasicInfo::where('userid',$userId)->orderBy('created_at','DESC')->get();
            return view('analytics',['projects'=>$projects,'code'=>$code]);
        }
    }
    public function getCountriesData($code){

        $totalScans = ScanStatistics::where('code', $code)
        ->count();

        $country_data = ScanStatistics::select(
            'country',
            DB::raw('COUNT(country) as scan_count'),
            DB::raw('(COUNT(*) / '.$totalScans.' * 100) as percentage')
        )
        ->where('code', $code)
        ->groupBy('country')
        ->orderByDesc('scan_count')
        ->get();


        return response()->json($country_data);

    }
    public function getCityData($code)
    {
        $totalScans = ScanStatistics::where('code', $code)
                    ->count();

        $city_data = ScanStatistics::select(
                'city',
                DB::raw('COUNT(city) as scan_count'),
                DB::raw('(COUNT(*) / '.$totalScans.' * 100) as percentage')
            )
            ->where('code', $code)
            ->groupBy('city')
            ->orderByDesc('scan_count')
            ->get();


        return response()->json($city_data);
    }
    public function getBarChartAnalyticData(Request $request)
    {   
        $code = $request->code; 
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $range = $request->range;

        $query = Scan::select('user_agent', DB::raw('COUNT(*) as scan_count'))
            ->where('qr_code_id', $code)
            ->where('scan_date', '>=', DB::raw('(SELECT MIN(start_date) FROM qr_basic_info)'));

        if ($start_date && $end_date && $range !== 'day') {
            $query->whereBetween('scan_date', [$start_date, $end_date]);
        }

        if ($range === 'day') {
            $query->where('scan_date', '>=', $start_date);
        }

        $data = $query->groupBy('user_agent')->orderByDesc('scan_count')->get(); 

        return response()->json($data);
    }

    public function getLineChartAnalyticData(Request $request)
    {
        $code = $request->code; 
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $range = $request->range;

        $query = ScanStatistics::select(DB::raw('DATE(scandate) as scan_date'), DB::raw('SUM(scan_count) as total_scans'))
            ->where('code', $code);

        if ($start_date && $end_date && $range !== 'day') {
            $query->whereBetween('scandate', [$start_date, $end_date]);
        }

        if ($range === 'day') {
            $query->where('scandate', '>=', $start_date);
        }

        $data = $query->groupBy(DB::raw('DATE(scandate)'))->orderByDesc('scan_date')->get(); 

        return response()->json($data);
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
    //    $data = 'https://infiniteqrcode.com/';
       
       $data = route('mysms', ['id' => $projectCode]);

        
    
   
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

        $url = $data."redirects/sms?id=". $projectCode; 

        // Save in DB
        $sms = Sms::create([
            'code' => $projectCode,
            'qrtype' => $request->qroption,
            'qrsms' => $request->sms,
            'countrycode' => $request->countrycode,
            'phonenumber' => $request->phone,
            'url'=>$url ,
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
            'url'=>$url ,
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
    public function login()
    {
        return view('signin');
    }

    public function dashboard()
    {
        // Get the authenticated user's ID
        // $userId = Auth::user()->username;

        $userId = Auth::user()->id;

        // Fetch the latest 3 project codes from 'qr_basic_info'
        $codes = QrBasicInfo::where('userid', $userId)
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
                $project = QrBasicInfo::where('project_code', $id)
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

        $infos = QrBasicInfo::where('userid', $userId)->get(); 


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
