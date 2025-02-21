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
        $countries = $this->getAllCountries();
        
        return view('signin')->with(['countries'=>$countries]);
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

public function getAllCountries(){

    $countries = [
        ["name" => "Afghanistan", "dial_code" => "+93"],
        ["name" => "Albania", "dial_code" => "+355"],
        ["name" => "Algeria", "dial_code" => "+213"],
        ["name" => "Andorra", "dial_code" => "+376"],
        ["name" => "Angola", "dial_code" => "+244"],
        ["name" => "Antigua and Barbuda", "dial_code" => "+1-268"],
        ["name" => "Argentina", "dial_code" => "+54"],
        ["name" => "Armenia", "dial_code" => "+374"],
        ["name" => "Australia", "dial_code" => "+61"],
        ["name" => "Austria", "dial_code" => "+43"],
        ["name" => "Azerbaijan", "dial_code" => "+994"],
        ["name" => "Bahamas", "dial_code" => "+1-242"],
        ["name" => "Bahrain", "dial_code" => "+973"],
        ["name" => "Bangladesh", "dial_code" => "+880"],
        ["name" => "Barbados", "dial_code" => "+1-246"],
        ["name" => "Belarus", "dial_code" => "+375"],
        ["name" => "Belgium", "dial_code" => "+32"],
        ["name" => "Belize", "dial_code" => "+501"],
        ["name" => "Benin", "dial_code" => "+229"],
        ["name" => "Bhutan", "dial_code" => "+975"],
        ["name" => "Bolivia", "dial_code" => "+591"],
        ["name" => "Bosnia and Herzegovina", "dial_code" => "+387"],
        ["name" => "Botswana", "dial_code" => "+267"],
        ["name" => "Brazil", "dial_code" => "+55"],
        ["name" => "Brunei", "dial_code" => "+673"],
        ["name" => "Bulgaria", "dial_code" => "+359"],
        ["name" => "Burkina Faso", "dial_code" => "+226"],
        ["name" => "Burundi", "dial_code" => "+257"],
        ["name" => "Cambodia", "dial_code" => "+855"],
        ["name" => "Cameroon", "dial_code" => "+237"],
        ["name" => "Canada", "dial_code" => "+1"],
        ["name" => "Central African Republic", "dial_code" => "+236"],
        ["name" => "Chad", "dial_code" => "+235"],
        ["name" => "Chile", "dial_code" => "+56"],
        ["name" => "China", "dial_code" => "+86"],
        ["name" => "Colombia", "dial_code" => "+57"],
        ["name" => "Comoros", "dial_code" => "+269"],
        ["name" => "Congo", "dial_code" => "+242"],
        ["name" => "Costa Rica", "dial_code" => "+506"],
        ["name" => "Croatia", "dial_code" => "+385"],
        ["name" => "Cuba", "dial_code" => "+53"],
        ["name" => "Cyprus", "dial_code" => "+357"],
        ["name" => "Czech Republic", "dial_code" => "+420"],
        ["name" => "Denmark", "dial_code" => "+45"],
        ["name" => "Djibouti", "dial_code" => "+253"],
        ["name" => "Dominican Republic", "dial_code" => "+1-809"],
        ["name" => "Ecuador", "dial_code" => "+593"],
        ["name" => "Egypt", "dial_code" => "+20"],
        ["name" => "El Salvador", "dial_code" => "+503"],
        ["name" => "Estonia", "dial_code" => "+372"],
        ["name" => "Ethiopia", "dial_code" => "+251"],
        ["name" => "Fiji", "dial_code" => "+679"],
        ["name" => "Finland", "dial_code" => "+358"],
        ["name" => "France", "dial_code" => "+33"],
        ["name" => "Gabon", "dial_code" => "+241"],
        ["name" => "Gambia", "dial_code" => "+220"],
        ["name" => "Georgia", "dial_code" => "+995"],
        ["name" => "Germany", "dial_code" => "+49"],
        ["name" => "Ghana", "dial_code" => "+233"],
        ["name" => "Greece", "dial_code" => "+30"],
        ["name" => "Guatemala", "dial_code" => "+502"],
        ["name" => "Honduras", "dial_code" => "+504"],
        ["name" => "Hungary", "dial_code" => "+36"],
        ["name" => "Iceland", "dial_code" => "+354"],
        ["name" => "India", "dial_code" => "+91"],
        ["name" => "Indonesia", "dial_code" => "+62"],
        ["name" => "Iran", "dial_code" => "+98"],
        ["name" => "Iraq", "dial_code" => "+964"],
        ["name" => "Ireland", "dial_code" => "+353"],
        ["name" => "Israel", "dial_code" => "+972"],
        ["name" => "Italy", "dial_code" => "+39"],
        ["name" => "Jamaica", "dial_code" => "+1-876"],
        ["name" => "Japan", "dial_code" => "+81"],
        ["name" => "Jordan", "dial_code" => "+962"],
        ["name" => "Kazakhstan", "dial_code" => "+7"],
        ["name" => "Kenya", "dial_code" => "+254"],
        ["name" => "Kuwait", "dial_code" => "+965"],
        ["name" => "Lebanon", "dial_code" => "+961"],
        ["name" => "Malaysia", "dial_code" => "+60"],
        ["name" => "Maldives", "dial_code" => "+960"],
        ["name" => "Mexico", "dial_code" => "+52"],
        ["name" => "Morocco", "dial_code" => "+212"],
        ["name" => "Nepal", "dial_code" => "+977"],
        ["name" => "Netherlands", "dial_code" => "+31"],
        ["name" => "New Zealand", "dial_code" => "+64"],
        ["name" => "Nigeria", "dial_code" => "+234"],
        ["name" => "North Korea", "dial_code" => "+850"],
        ["name" => "Norway", "dial_code" => "+47"],
        ["name" => "Oman", "dial_code" => "+968"],
        ["name" => "Pakistan", "dial_code" => "+92"],
        ["name" => "Palestine", "dial_code" => "+970"],
        ["name" => "Panama", "dial_code" => "+507"],
        ["name" => "Paraguay", "dial_code" => "+595"],
        ["name" => "Peru", "dial_code" => "+51"],
        ["name" => "Philippines", "dial_code" => "+63"],
        ["name" => "Poland", "dial_code" => "+48"],
        ["name" => "Portugal", "dial_code" => "+351"],
        ["name" => "Qatar", "dial_code" => "+974"],
        ["name" => "Romania", "dial_code" => "+40"],
        ["name" => "Russia", "dial_code" => "+7"],
        ["name" => "Saudi Arabia", "dial_code" => "+966"],
        ["name" => "Singapore", "dial_code" => "+65"],
        ["name" => "South Africa", "dial_code" => "+27"],
        ["name" => "Spain", "dial_code" => "+34"],
        ["name" => "Sri Lanka", "dial_code" => "+94"],
        ["name" => "Sweden", "dial_code" => "+46"],
        ["name" => "Switzerland", "dial_code" => "+41"],
        ["name" => "Thailand", "dial_code" => "+66"],
        ["name" => "Turkey", "dial_code" => "+90"],
        ["name" => "United Arab Emirates", "dial_code" => "+971"],
        ["name" => "United Kingdom", "dial_code" => "+44"],
        ["name" => "United States", "dial_code" => "+1"],
        ["name" => "Venezuela", "dial_code" => "+58"],
        ["name" => "Vietnam", "dial_code" => "+84"]
    ];
    

    return $countries;

}
            
          
          
}
