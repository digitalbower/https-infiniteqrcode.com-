<?php

namespace App\Http\Controllers;

use App\Models\Appstoreqr;
use App\Models\Bitcoinqr;
use App\Models\Emailqr;
use App\Models\Imageqr;
use App\Models\MP3qr;
use App\Models\Pdfqr;
use App\Models\QrBasicInfo;
use App\Models\Scan;
use App\Models\ScanStatistics;
use App\Models\Sms;
use App\Models\SocialMediaqr;
use App\Models\Urlqr;
use App\Models\User;
use App\Models\VCardqr;
use App\Models\Videoqr;
use App\Models\Wifiqr;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class MyQRCodeController extends Controller
{
    public function createEmailQrcode(Request $request){
        $request->validate([
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'projectname' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'folderinput'=>'required'
        ]);
        //Control Qr code generation limit 
        $qrType = $request->qroption; 

        if (Gate::denies('create', [QrBasicInfo::class, $qrType])) {
            return back()->with('error', 'You have reached the QR code limit for your plan. Please upgrade to add more.');
        }
        
        $projectCode = 'P' . time() . rand(100, 999); 
         // Generate QR Code and save to storage
         $data = route('preview-email', ['id' => $projectCode]); 
 
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
         Emailqr::create([
             'code' => $projectCode,
             'qrtype' => $request->qroption,
             'email'=>$request->email,
             'subject'=>$request->subject,
             'message'=>$request->message,
             'url'=>$qrCodeUrl,
             'qrimage'=>$qrCodePath,
             'userid' => Auth::user()->id ?? 'Guest', // Store user ID or 'Guest'
         ]);
         $qrBasicInfo = QrBasicInfo::create([
             'project_code' => $projectCode,
             'project_name' => $request->projectname,
             'folder_name' => $request->folderinput, 
             'qrtype' => $request->qroption,
             'start_date' => $request->startdate,
             'end_date' => $request->enddate,
             'usage_type' => $request->usage,
             'remarks' => $request->remarks,
             'url'=>$qrCodeUrl,
             'userid' => Auth::user()->id ?? 'Guest', // Store user ID or 'Guest'
             'qrtable' => 'emailqr', 
             'total_scans' => 0,
             'unique_scans' => 0,
             'created_At' => now(),
         ]);
 
         return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
      // Generate QR Code and Save to DB
      public function createSmsQrcode(Request $request) {
        $request->validate([
             'phone' => 'required',
             'sms' => 'required',
             'projectname' => 'required',
             'startdate' => 'required|date',
             'enddate' => 'required|date',
             'folderinput'=>'required'
         ]);
 
         $message = [
             'Phone' => $request->countrycode . $request->phone,
             'Message' => $request->sms,
         ];

        //Control Qr code generation limit

        $qrType = $request->qroption; 

        if (Gate::denies('create', [QrBasicInfo::class, $qrType])) {
            return back()->with('error', 'You have reached the QR code limit for your plan. Please upgrade to add more.');
        }
        
         // Generate QR Code and save to storage
    
     $projectCode = 'P' . time() . rand(100, 999);
 
     $data = route('preview-sms', ['id' => $projectCode]); 
 
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
             'url'=>$qrCodeUrl,
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
    public function createWifiQrcode(Request $request){
        $request->validate([
            'ssid' => 'required',
            'password' => 'required',
            'enctype' => 'required',
            'projectname' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'folderinput'=>'required'
        ]);
        //Control Qr code generation limit

        $qrType = $request->qroption; 

        if (Gate::denies('create', [QrBasicInfo::class, $qrType])) {
            return back()->with('error', 'You have reached the QR code limit for your plan. Please upgrade to add more.');
        }
        $projectCode = 'P' . time() . rand(100, 999);

        // Generate QR Code and save to storage

        $data = route('preview-wifi', ['id' => $projectCode]); 

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
         Wifiqr::create([
             'code' => $projectCode,
             'qrtype' => $request->qroption,
             'ssid'=>$request->ssid,
             'password'=>$request->password,
             'enctype'=>$request->enctype,
             'url'=>$qrCodeUrl,
             'qrimage'=>$qrCodePath,
             'userid' => Auth::user()->id ?? 'Guest', // Store user ID or 'Guest'
         ]);
         $qrBasicInfo = QrBasicInfo::create([
             'project_code' => $projectCode,
             'project_name' => $request->projectname,
             'folder_name' => $request->folderinput, 
             'qrtype' => $request->qroption,
             'start_date' => $request->startdate,
             'end_date' => $request->enddate,
             'usage_type' => $request->usage,
             'remarks' => $request->remarks,
             'url'=>$qrCodeUrl,
             'userid' => Auth::user()->id ?? 'Guest', // Store user ID or 'Guest'
             'qrtable' => 'wifiqr', 
             'total_scans' => 0,
             'unique_scans' => 0,
             'created_At' => now(),
         ]);
 
         return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function createBitcoinQrcode(Request $request){
        $request->validate([
            'currency' => 'required',
            'quantity' => 'required',
            'btcaddr' => 'required',
            'btcnetwrk'=>'required',
            'projectname' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'folderinput'=>'required'
        ]);
        //Control Qr code generation limit

        $qrType = $request->qroption; 

        if (Gate::denies('create', [QrBasicInfo::class, $qrType])) {
            return back()->with('error', 'You have reached the QR code limit for your plan. Please upgrade to add more.');
        }
         $projectCode = 'P' . time() . rand(100, 999);

        // Generate QR Code and save to storage

        $data = route('preview-bitcoin', ['id' => $projectCode]); 
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
         Bitcoinqr::create([
             'code' => $projectCode,
             'qrtype' => $request->qroption,
             'currency'=>$request->currency,
             'quantity'=>$request->quantity,
             'btcaddr'=>$request->btcaddr,
             'btcnetwrk'=>$request->btcnetwrk,
             'url'=>$qrCodeUrl,
             'qrimage'=>$qrCodePath,
             'userid' => Auth::user()->id ?? 'Guest', // Store user ID or 'Guest'
         ]);
         $qrBasicInfo = QrBasicInfo::create([
             'project_code' => $projectCode,
             'project_name' => $request->projectname,
             'folder_name' => $request->folderinput, 
             'qrtype' => $request->qroption,
             'start_date' => $request->startdate,
             'end_date' => $request->enddate,
             'usage_type' => $request->usage,
             'remarks' => $request->remarks,
             'url'=>$qrCodeUrl,
             'userid' => Auth::user()->id ?? 'Guest', // Store user ID or 'Guest'
             'qrtable' => 'btcqr', 
             'total_scans' => 0,
             'unique_scans' => 0,
             'created_At' => now(),
         ]);
 
         return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function createPdfQrcode(Request $request){
    
        $request->validate([
            'pdfpath' => 'required|mimes:pdf',
            'projectname' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'folderinput'=>'required'
        ]);
        //Control Qr code generation limit

        $qrType = $request->qroption; 

        if (Gate::denies('create', [QrBasicInfo::class, $qrType])) {
            return back()->with('error', 'You have reached the QR code limit for your plan. Please upgrade to add more.');
        }
        $projectCode = 'P' . time() . rand(100, 999);

        // Generate QR Code and save to storage

        $data = route('preview-pdf', ['id' => $projectCode]);
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

        if ($request->file('pdfpath')) {
            $file = $request->file('pdfpath');
            $fileName = time() . '.' . $file->getClientOriginalExtension(); 
            $filePath = $file->storeAs('pdfs', $fileName, 'public');
        }
         // Save in DB
        $pdf =Pdfqr::create([
            'code' => $projectCode,
            'qrtype' => $request->qroption,
            'pdfpath'=>$filePath,
            'url'=>$qrCodeUrl ,
            'qrimage'=>$qrCodePath,
            'userid' => Auth::user()->id ?? 'Guest', // Store user ID or 'Guest'
        ]);
        $qrBasicInfo = QrBasicInfo::create([
            'project_code' => $projectCode,
            'project_name' => $request->projectname,
            'folder_name' => $request->folderinput, 
            'qrtype' => $request->qroption,
            'start_date' => $request->startdate,
            'end_date' => $request->enddate,
            'usage_type' => $request->usage,
            'remarks' => $request->remarks,
            'url'=>$qrCodeUrl ,
            'userid' => Auth::user()->id ?? 'Guest', // Store user ID or 'Guest'
            'qrtable' => 'pdfqr', 
            'total_scans' => 0,
            'unique_scans' => 0,
            'created_At' => now(),
        ]);

        return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function createMp3Qrcode(Request $request){
    
        $request->validate([
            'qrtext' => 'required',
            'mp3path' => 'required|file|mimes:mp3',
            'projectname' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'folderinput'=>'required'
        ]);
        //Control Qr code generation limit

        $qrType = $request->qroption; 

        if (Gate::denies('create', [QrBasicInfo::class, $qrType])) {
            return back()->with('error', 'You have reached the QR code limit for your plan. Please upgrade to add more.');
        }
       
        $projectCode = 'P' . time() . rand(100, 999);

        // Generate QR Code and save to storage

        $data = route('preview-mp3', ['id' => $projectCode]);
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

        // Store the file
        if ($request->hasFile('mp3path')) {
            $file = $request->file('mp3path');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('mp3s', $fileName, 'public');

        }
         // Save in DB
        $pdf =MP3qr::create([
            'code' => $projectCode,
            'qrtype' => $request->qroption,
            'qrtext' => $request->qrtext,
            'mp3path'=>$filePath,
            'url'=>$qrCodeUrl,
            'qrimage'=>$qrCodePath,
            'userid' => Auth::user()->id ?? 'Guest', // Store user ID or 'Guest'
        ]);
        $qrBasicInfo = QrBasicInfo::create([
            'project_code' => $projectCode,
            'url'=>$qrCodeUrl,
            'project_name' => $request->projectname,
            'folder_name' => $request->folderinput, 
            'qrtype' => $request->qroption, 
            'start_date' => $request->startdate,
            'end_date' => $request->enddate,
            'usage_type' => $request->usage,
            'remarks' => $request->remarks,
            'url'=>$qrCodeUrl,
            'userid' => Auth::user()->id ?? 'Guest', // Store user ID or 'Guest'
            'qrtable' => 'mp3qr', 
            'total_scans' => 0,
            'unique_scans' => 0,
            'created_At' => now(),
        ]);

        return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function createImageQrcode(Request $request){
    
        $request->validate([
            'imagepath' => 'required|image|mimes:jpeg,png,jpg',
            'projectname' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'folderinput'=>'required'
        ]);
        //Control Qr code generation limit

        $qrType = $request->qroption; 

        if (Gate::denies('create', [QrBasicInfo::class, $qrType])) {
            return back()->with('error', 'You have reached the QR code limit for your plan. Please upgrade to add more.');
        }
       
        $projectCode = 'P' . time() . rand(100, 999);

        // Generate QR Code and save to storage

        $data = route('preview-image', ['id' => $projectCode]);
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

        // Store the file
        if ($request->hasFile('imagepath')) {
            $file = $request->file('imagepath');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('images', $fileName, 'public');

        }
         // Save in DB
        $img =Imageqr::create([
            'code' => $projectCode,
            'qrtype' => $request->qroption,
            'imagepath'=>$filePath,
            'url'=>$qrCodeUrl ,
            'qrimage'=>$qrCodePath,
            'userid' => Auth::user()->id ?? 'Guest', // Store user ID or 'Guest'
        ]);
        $qrBasicInfo = QrBasicInfo::create([
            'project_code' => $projectCode,
            'project_name' => $request->projectname,
            'folder_name' => $request->folderinput, 
            'qrtype' => $request->qroption, 
            'start_date' => $request->startdate,
            'end_date' => $request->enddate,
            'usage_type' => $request->usage,
            'remarks' => $request->remarks,
            'url'=>$qrCodeUrl,
            'userid' => Auth::user()->id ?? 'Guest', // Store user ID or 'Guest'
            'qrtable' => 'imageqr', 
            'total_scans' => 0,
            'unique_scans' => 0,
            'created_At' => now(),
        ]);

        return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function createVideoQrcode(Request $request){
    
        $request->validate([
            'videopath' => 'required|file|mimes:mp4,mov',
            'projectname' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'folderinput'=>'required'
        ]);
        
        //Control Qr code generation limit

        $qrType = $request->qroption; 

        if (Gate::denies('create', [QrBasicInfo::class, $qrType])) {
            return back()->with('error', 'You have reached the QR code limit for your plan. Please upgrade to add more.');
        }
        $projectCode = 'P' . time() . rand(100, 999);

        // Generate QR Code and save to storage

        $data = route('preview-video', ['id' => $projectCode]);
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

        // Store the file
        if ($request->hasFile('videopath')) {
            $file = $request->file('videopath');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('videos', $fileName, 'public');

        }
         // Save in DB
        $video =Videoqr::create([
            'code' => $projectCode,
            'qrtype' => $request->qroption,
            'videopath'=>$filePath,
            'url'=>$qrCodeUrl ,
            'qrimage'=>$qrCodePath,
            'userid' => Auth::user()->id ?? 'Guest', // Store user ID or 'Guest'
        ]);
        $qrBasicInfo = QrBasicInfo::create([
            'project_code' => $projectCode,
            'project_name' => $request->projectname,
            'folder_name' => $request->folderinput, 
            'qrtype' => $request->qroption, 
            'start_date' => $request->startdate,
            'end_date' => $request->enddate,
            'usage_type' => $request->usage,
            'remarks' => $request->remarks,
            'url'=>$qrCodeUrl,
            'userid' => Auth::user()->id ?? 'Guest', // Store user ID or 'Guest'
            'qrtable' => 'videoqr', 
            'total_scans' => 0,
            'unique_scans' => 0,
            'created_At' => now(),
        ]);

        return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function createAppstoreQrcode(Request $request){
        $request->validate([
            'projectname' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'folderinput'=>'required'
        ]);
        //Control Qr code generation limit

        $qrType = $request->qroption; 

        if (Gate::denies('create', [QrBasicInfo::class, $qrType])) {
            return back()->with('error', 'You have reached the QR code limit for your plan. Please upgrade to add more.');
        }
        $projectCode = 'P' . time() . rand(100, 999);

        // Generate QR Code and save to storage

        $data = route('preview-app', ['id' => $projectCode]);
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
          Appstoreqr::create([
             'code' => $projectCode,
             'qrtype' => $request->qroption,
             'appurl'=>$request->appurl,
             'playstoreurl'=>$request->playstoreurl,
             'windowsurl'=>$request->windowsurl,
             'Huawei'=>$request->Huawei,
             'url'=>$qrCodeUrl,
             'qrimage'=>$qrCodePath,
             'userid' => Auth::user()->id ?? 'Guest', // Store user ID or 'Guest'
         ]);
         $qrBasicInfo = QrBasicInfo::create([
             'project_code' => $projectCode,
             'project_name' => $request->projectname,
             'folder_name' => $request->folderinput, 
             'qrtype' => $request->qroption,
             'start_date' => $request->startdate,
             'end_date' => $request->enddate,
             'usage_type' => $request->usage,
             'remarks' => $request->remarks,
             'url'=>$qrCodeUrl,
             'userid' => Auth::user()->id ?? 'Guest', // Store user ID or 'Guest'
             'qrtable' => 'apkqr', 
             'total_scans' => 0,
             'unique_scans' => 0,
             'created_At' => now(),
         ]);
 
         return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function createUrlQrcode(Request $request){
        $request->validate([
            'qrurl' => 'required',
            'projectname' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'folderinput'=>'required'
        ]);
        //Control Qr code generation limit

        $qrType = $request->qroption; 

        if (Gate::denies('create', [QrBasicInfo::class, $qrType])) {
            return back()->with('error', 'You have reached the QR code limit for your plan. Please upgrade to add more.');
        }
        $projectCode = 'P' . time() . rand(100, 999);

        // Generate QR Code and save to storage

        $data = route('preview-url', ['id' => $projectCode]);
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
          Urlqr::create([
             'code' => $projectCode,
             'qrtype' => $request->qroption,
             'qrurl'=>$request->qrurl,
             'url'=>$qrCodeUrl,
             'qrimage'=>$qrCodePath,
             'userid' => Auth::user()->id ?? 'Guest', // Store user ID or 'Guest'
         ]);
         $qrBasicInfo = QrBasicInfo::create([
             'project_code' => $projectCode,
             'project_name' => $request->projectname,
             'folder_name' => $request->folderinput, 
             'qrtype' => $request->qroption,
             'start_date' => $request->startdate,
             'end_date' => $request->enddate,
             'usage_type' => $request->usage,
             'remarks' => $request->remarks,
             'url'=>$qrCodeUrl,
             'userid' => Auth::user()->id ?? 'Guest', // Store user ID or 'Guest'
             'qrtable' => 'urlcode', 
             'total_scans' => 0,
             'unique_scans' => 0,
             'created_At' => now(),
         ]);
 
         return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function createVcardQrcode(Request $request){
        $request->validate([
            'contactimg'=>'nullable|file|mimes:jpeg,png,jpg',
            'first_name'=> 'required',
            'last_name'=> 'required',
            'mobile'=> 'required',
            'email'=> 'required',
            'projectname' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'folderinput'=>'required'
        ]);
        //Control Qr code generation limit

        $qrType = $request->qroption; 

        if (Gate::denies('create', [QrBasicInfo::class, $qrType])) {
            return back()->with('error', 'You have reached the QR code limit for your plan. Please upgrade to add more.');
        }
        $projectCode = 'P' . time() . rand(100, 999);

        // Generate QR Code and save to storage

        $data = route('preview-vcard', ['id' => $projectCode]);
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

         if ($request->hasFile('contactimg')) {
            $file = $request->file('contactimg');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('contact_images', $fileName, 'public');

        }
 
          // Save in DB
          VCardqr::create([
            'code' => $projectCode,
            'qrtype' => $request->qroption,
            'contactimg'=>$filePath ?? null,
            'first_name'=> $request->first_name,
            'last_name'=> $request->last_name,
            'mobile'=> $request->mobile,
            'email'=> $request->email,
            'company'=> $request->company,
            'street'=> $request->street,
            'website'=> $request->website,
            'city'=> $request->city,
            'zip'=> $request->zip,
            'state'=> $request->state,
            'country'=> $request->country,
            'url'=>$qrCodeUrl,
            'qrimage'=>$qrCodePath,
            'userid' => Auth::user()->id ?? 'Guest', // Store user ID or 'Guest'
         ]);
         $qrBasicInfo = QrBasicInfo::create([
             'project_code' => $projectCode,
             'project_name' => $request->projectname,
             'folder_name' => $request->folderinput, 
             'qrtype' => $request->qroption,
             'start_date' => $request->startdate,
             'end_date' => $request->enddate,
             'usage_type' => $request->usage,
             'remarks' => $request->remarks,
             'url'=>$qrCodeUrl,
             'userid' => Auth::user()->id ?? 'Guest', // Store user ID or 'Guest'
             'qrtable' => 'vcard', 
             'total_scans' => 0,
             'unique_scans' => 0,
             'created_At' => now(),
         ]);
 
         return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function createSocialQrcode(Request $request){
        $request->validate([
            'projectname' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'folderinput'=>'required'
        ]);
        //Control Qr code generation limit

        $qrType = $request->qroption; 

        if (Gate::denies('create', [QrBasicInfo::class, $qrType])) {
            return back()->with('error', 'You have reached the QR code limit for your plan. Please upgrade to add more.');
        }
        $projectCode = 'P' . time() . rand(100, 999);

        // Generate QR Code and save to storage

        $data = route('preview-social', ['id' => $projectCode]);
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
          SocialMediaqr::create([
            'code' => $projectCode,
            'qrtype' => $request->qroption,
            'whtext'=> $request->whtext,
            'whurl'=> $request->whturl,
            'fbtext'=> $request->fbtext,
            'fburl'=> $request->fburl,
            'ybtext'=> $request->yutext,
            'yturl'=> $request->yturl,
            'insurl'=> $request->insurl,
            'instext'=> $request->instext,
            'wchurl'=> $request->wchurl,
            'wchtext'=> $request->wchtext,
            'tikurl'=> $request->tikturl,
            'tiktext'=> $request->tiktext,
            'dyurl'=> $request->dyurl,
            'dytext'=> $request->dytext,
            'telurl'=> $request->telurl,
            'teltext'=> $request->teltext,
            'snpurl'=> $request->snpurl,
            'snptext'=> $request->snptext,
            'url'=>$qrCodeUrl,
            'qrimage'=>$qrCodePath,
            'userid' => Auth::user()->id ?? 'Guest', // Store user ID or 'Guest'
         ]);
         $qrBasicInfo = QrBasicInfo::create([
             'project_code' => $projectCode,
             'project_name' => $request->projectname,
             'folder_name' => $request->folderinput, 
             'qrtype' => $request->qroption,
             'start_date' => $request->startdate,
             'end_date' => $request->enddate,
             'usage_type' => $request->usage,
             'remarks' => $request->remarks,
             'url'=>$qrCodeUrl,
             'userid' => Auth::user()->id ?? 'Guest', // Store user ID or 'Guest'
             'qrtable' => 'socmedqr', 
             'total_scans' => 0,
             'unique_scans' => 0,
             'created_At' => now(),
         ]);
 
         return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function editEmailQrcode($code){

        $email = Emailqr::leftJoin('qr_basic_info','qr_basic_info.project_code','=','emailqr.code')
        ->where('emailqr.code',$code)->first(); 
        return view('email-edit')->with(['email'=>$email]);
    }
    public function updateEmailQrcode(Request $request,$code){ 
        $request->validate([
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'projectname' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'folderinput'=>'required'
        ]);
          // Save in DB
        $email = Emailqr::where('code',$code)->first();
        $email->qrtype= $request->qroption;
        $email->email=$request->email;
        $email->subject=$request->subject;
        $email->message=$request->message;
        $email->save();

        $qrBasicInfo = QrBasicInfo::where('project_code',$code)->first();
        $qrBasicInfo->project_name= $request->projectname;
        $qrBasicInfo->folder_name=$request->folderinput; 
        $qrBasicInfo->start_date= $request->startdate;
        $qrBasicInfo->end_date= $request->enddate;
        $qrBasicInfo->usage_type= $request->usage;
        $qrBasicInfo->remarks= $request->remarks;
        $qrBasicInfo->save(); 
          
         return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function previewEmail($code)
    {
        $qrBasicInfo = QrBasicInfo::where('project_code', $code)->first(); 
        if($qrBasicInfo){
            $user = User::findOrFail($qrBasicInfo->userid); 

            if (Gate::forUser($user)->denies('scan', $qrBasicInfo)) {
                abort(403, 'Scan limit reached! Please upgrade your plan.');
            }
            $qrCode = Emailqr::where('code',$code)->first();  

            return view('email-preview')->with(['qrCode'=>$qrCode]);
        }
        else{
            return view('qr-error')->with('message', 'QR Code does not exist.');
        }
    }
    public function editSmsQrcode($code){

        $sms = Sms::leftJoin('qr_basic_info','qr_basic_info.project_code','=','smsqr.code')
        ->where('smsqr.code',$code)->first(); 
        return view('sms-edit')->with(['sms'=>$sms]);
    }
    public function updateSmsQrcode(Request $request,$code){ 
        $request->validate([
            'phone' => 'required',
            'sms' => 'required',
            'projectname' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'folderinput'=>'required'
        ]);
          // Save in DB
        $sms = Sms::where('code',$code)->first();
        $sms->qrtype= $request->qroption;
        $sms->qrsms=$request->sms;
        $sms->countrycode=$request->countrycode;
        $sms->phonenumber=$request->phone;
        $sms->save();

        $qrBasicInfo = QrBasicInfo::where('project_code',$code)->first();
        $qrBasicInfo->project_name= $request->projectname;
        $qrBasicInfo->folder_name=$request->folderinput; 
        $qrBasicInfo->start_date= $request->startdate;
        $qrBasicInfo->end_date= $request->enddate;
        $qrBasicInfo->usage_type= $request->usage;
        $qrBasicInfo->remarks= $request->remarks;
        $qrBasicInfo->save(); 
          
        return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function editWifiQrcode($code){

        $wifi = Wifiqr::leftJoin('qr_basic_info','qr_basic_info.project_code','=','wifiqr.code')
        ->where('wifiqr.code',$code)->first(); 
        return view('wifi-edit')->with(['wifi'=>$wifi]);
    }
    public function updateWifiQrcode(Request $request,$code){ 
        $request->validate([
            'ssid' => 'required',
            'password' => 'required',
            'enctype' => 'required',
            'projectname' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'folderinput'=>'required'
        ]);

          // Save in DB
        $wifi = Wifiqr::where('code',$code)->first();
        $wifi->qrtype= $request->qroption;
        $wifi->ssid=$request->ssid;
        $wifi->password=$request->password;
        $wifi->enctype=$request->enctype;
        $wifi->save();

        $qrBasicInfo = QrBasicInfo::where('project_code',$code)->first();
        $qrBasicInfo->project_name= $request->projectname;
        $qrBasicInfo->folder_name=$request->folderinput; 
        $qrBasicInfo->start_date= $request->startdate;
        $qrBasicInfo->end_date= $request->enddate;
        $qrBasicInfo->usage_type= $request->usage;
        $qrBasicInfo->remarks= $request->remarks;
        $qrBasicInfo->save(); 
          
        return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function previewWifi($code)
    {
        $qrBasicInfo = QrBasicInfo::where('project_code', $code)->first(); 
        if($qrBasicInfo){
            $user = User::findOrFail($qrBasicInfo->userid); 

            if (Gate::forUser($user)->denies('scan', $qrBasicInfo)) {
                abort(403, 'Scan limit reached! Please upgrade your plan.');
            }
            $qrCode = Wifiqr::where('code',$code)->first(); 

            return view('wifi-preview')->with(['qrCode'=>$qrCode]);
        }
        else{
            return view('qr-error')->with('message', 'QR Code does not exist.');
        }
    }
    public function editBitcoinQrcode($code){

        $bitcoin = Bitcoinqr::leftJoin('qr_basic_info','qr_basic_info.project_code','=','btcqr.code')
        ->where('btcqr.code',$code)->first();  
        return view('bitcoin-edit')->with(['bitcoin'=>$bitcoin]);
    }
    public function updateBitcoinQrcode(Request $request,$code){
        $request->validate([
            'currency' => 'required',
            'quantity' => 'required',
            'btcaddr' => 'required',
            'btcnetwrk'=>'required',
            'projectname' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'folderinput'=>'required'
        ]);
        
          // Save in DB
          $bitcoin = Bitcoinqr::where('code',$code)->first();
          $bitcoin->qrtype= $request->qroption;
          $bitcoin->currency=$request->currency;
          $bitcoin->quantity=$request->quantity;
          $bitcoin->btcaddr=$request->btcaddr;
          $bitcoin->btcnetwrk=$request->btcnetwrk;
          $bitcoin->save();
  
          $qrBasicInfo = QrBasicInfo::where('project_code',$code)->first();
          $qrBasicInfo->project_name= $request->projectname;
          $qrBasicInfo->folder_name=$request->folderinput; 
          $qrBasicInfo->start_date= $request->startdate;
          $qrBasicInfo->end_date= $request->enddate;
          $qrBasicInfo->usage_type= $request->usage;
          $qrBasicInfo->remarks= $request->remarks;
          $qrBasicInfo->save(); 
 
         return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function previewBitcoin($code)
    {
        $qrBasicInfo = QrBasicInfo::where('project_code', $code)->first(); 
        if($qrBasicInfo){
            $user = User::findOrFail($qrBasicInfo->userid); 

            if (Gate::forUser($user)->denies('scan', $qrBasicInfo)) {
                abort(403, 'Scan limit reached! Please upgrade your plan.');
            }
            $qrCode = Bitcoinqr::where('code',$code)->first();  
    
            return view('bitcoin-preview')->with(['qrCode'=>$qrCode]);
        }
        else{
            return view('qr-error')->with('message', 'QR Code does not exist.');
        }
       
    }
    public function editPdfQrcode($code){

        $pdf = Pdfqr::leftJoin('qr_basic_info','qr_basic_info.project_code','=','pdfqr.code')
        ->where('pdfqr.code',$code)->first(); 
        return view('pdf-edit')->with(['pdf'=>$pdf]);
    }
    public function updatePdfQrcode(Request $request,$code){
    
        $request->validate([
            'pdfpath' => 'nullable|mimes:pdf',
            'projectname' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'folderinput'=>'required'
        ]);

        // Save in DB
        $pdf = Pdfqr::where('code',$code)->first();


        if ($request->file('pdfpath')) {
            // Delete old file
            if ($pdf->pdfpath && Storage::disk('public')->exists($pdf->pdfpath)) {  
                Storage::disk('public')->delete($pdf->pdfpath);
            }

            // Upload new file
            $file = $request->file('pdfpath');
            $fileName = time() . '.' . $file->getClientOriginalExtension(); 
            $filePath = $file->storeAs('pdfs', $fileName, 'public');

            // Update DB
            $pdf->pdfpath=$filePath;
        }
          $pdf->qrtype= $request->qroption;
          $pdf->save();
  
          $qrBasicInfo = QrBasicInfo::where('project_code',$code)->first();
          $qrBasicInfo->project_name= $request->projectname;
          $qrBasicInfo->folder_name=$request->folderinput; 
          $qrBasicInfo->start_date= $request->startdate;
          $qrBasicInfo->end_date= $request->enddate;
          $qrBasicInfo->usage_type= $request->usage;
          $qrBasicInfo->remarks= $request->remarks;
          $qrBasicInfo->save(); 
        return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function previewPdf($code)
    {
        $qrBasicInfo = QrBasicInfo::where('project_code', $code)->first(); 
        if($qrBasicInfo){
            $user = User::findOrFail($qrBasicInfo->userid); 

            if (Gate::forUser($user)->denies('scan', $qrBasicInfo)) {
                abort(403, 'Scan limit reached! Please upgrade your plan.');
            }
            $qrCode = Pdfqr::where('code',$code)->first();  
    
            return view('pdf-preview')->with(['qrCode'=>$qrCode]);
        }
        else{
            return view('qr-error')->with('message', 'QR Code does not exist.');
        }
      
    }
    public function downloadPdf($code){
        $qrCode = Pdfqr::where('code',$code)->first();  
        $filePath = storage_path('app/public/' . $qrCode->pdfpath);  
        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            abort(404, 'File not found.');
        }
    }
    public function editMp3Qrcode($code){

        $mp3 = MP3qr::leftJoin('qr_basic_info','qr_basic_info.project_code','=','mp3qr.code')
        ->where('mp3qr.code',$code)->first(); 
        return view('mp3-edit')->with(['mp3'=>$mp3]);
    }
    public function updateMp3Qrcode(Request $request,$code){
    
        $request->validate([
            'qrtext' => 'required',
            'mp3path' => 'nullable|file|mimes:mp3',
            'projectname' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'folderinput'=>'required'
        ]);
        

        $mp3 = MP3qr::where('code',$code)->first();

        if ($request->hasFile('mp3path')) { 
            if ($mp3->mp3path && Storage::disk('public')->exists($mp3->mp3path)) {  
                Storage::disk('public')->delete($mp3->mp3path);
            }

            $file = $request->file('mp3path');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('mp3s', $fileName, 'public');

            $mp3->mp3path=$filePath;
        }
       
        // Save in DB
        $mp3->qrtype= $request->qroption;
        $mp3->qrtext = $request->qrtext;
        $mp3->save();

        $qrBasicInfo = QrBasicInfo::where('project_code',$code)->first();
        $qrBasicInfo->project_name= $request->projectname;
        $qrBasicInfo->folder_name=$request->folderinput; 
        $qrBasicInfo->start_date= $request->startdate;
        $qrBasicInfo->end_date= $request->enddate;
        $qrBasicInfo->usage_type= $request->usage;
        $qrBasicInfo->remarks= $request->remarks;
        $qrBasicInfo->save(); 
        return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function previewMp3($code)
    {
        $qrBasicInfo = QrBasicInfo::where('project_code', $code)->first(); 
        if($qrBasicInfo){
            $user = User::findOrFail($qrBasicInfo->userid); 

            if (Gate::forUser($user)->denies('scan', $qrBasicInfo)) {
                abort(403, 'Scan limit reached! Please upgrade your plan.');
            }
            $qrCode = MP3qr::where('code',$code)->first();  

            return view('mp3-preview')->with(['qrCode'=>$qrCode]);
        } else{
            return view('qr-error')->with('message', 'QR Code does not exist.');
        }
    }
    public function editImageQrcode($code){

        $image = Imageqr::leftJoin('qr_basic_info','qr_basic_info.project_code','=','imageqr.code')
        ->where('imageqr.code',$code)->first(); 
        return view('image-edit')->with(['image'=>$image]);
    }
    public function updateImageQrcode(Request $request,$code){
    
        $request->validate([
            'imagepath' => 'nullable|image|mimes:jpeg,png,jpg',
            'projectname' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'folderinput'=>'required'
        ]);
        
        $img = Imageqr::where('code',$code)->first();
        // Store the file
        if ($request->hasFile('imagepath')) {
            if ($img->imagepath && Storage::disk('public')->exists($img->imagepath)) {  
                Storage::disk('public')->delete($img->imagepath);
            }
            $file = $request->file('imagepath');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('images', $fileName, 'public');

            $img->imagepath=$filePath;
        }
        $img->qrtype= $request->qroption;
        $img->save();

        $qrBasicInfo = QrBasicInfo::where('project_code',$code)->first();
        $qrBasicInfo->project_name= $request->projectname;
        $qrBasicInfo->folder_name=$request->folderinput; 
        $qrBasicInfo->start_date= $request->startdate;
        $qrBasicInfo->end_date= $request->enddate;
        $qrBasicInfo->usage_type= $request->usage;
        $qrBasicInfo->remarks= $request->remarks;
        $qrBasicInfo->save(); 

        return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function previewImage($code)
    {
        $qrBasicInfo = QrBasicInfo::where('project_code', $code)->first(); 
        if($qrBasicInfo){
            $user = User::findOrFail($qrBasicInfo->userid); 

            if (Gate::forUser($user)->denies('scan', $qrBasicInfo)) {
                abort(403, 'Scan limit reached! Please upgrade your plan.');
            }
            $qrCode = Imageqr::where('code',$code)->first();  
    
            return view('image-preview')->with(['qrCode'=>$qrCode]);
        }
        else{
            return view('qr-error')->with('message', 'QR Code does not exist.');
        }
        
    }
    public function editVideoQrcode($code){

        $video = Videoqr::leftJoin('qr_basic_info','qr_basic_info.project_code','=','videoqr.code')
        ->where('videoqr.code',$code)->first(); 
        return view('video-edit')->with(['video'=>$video]);
    }
    public function updateVideoQrcode(Request $request,$code){
    
        $request->validate([
            'videopath' => 'nullable|file|mimes:mp4,mov',
            'projectname' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'folderinput'=>'required'
        ]);

        $video = Videoqr::where('code',$code)->first();

        // Store the file
        if ($request->hasFile('videopath')) {
            if ($video->videopath && Storage::disk('public')->exists($video->videopath)) {  
                Storage::disk('public')->delete($video->videopath);
            }
            
            $file = $request->file('videopath');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('videos', $fileName, 'public');

            $video->videopath=$filePath;
        }
        // Save in DB
        $video->qrtype= $request->qroption;
        $video->save();

        $qrBasicInfo = QrBasicInfo::where('project_code',$code)->first();
        $qrBasicInfo->project_name= $request->projectname;
        $qrBasicInfo->folder_name=$request->folderinput; 
        $qrBasicInfo->start_date= $request->startdate;
        $qrBasicInfo->end_date= $request->enddate;
        $qrBasicInfo->usage_type= $request->usage;
        $qrBasicInfo->remarks= $request->remarks;
        $qrBasicInfo->save(); 
        return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function previewVideo($code)
    {
        $qrBasicInfo = QrBasicInfo::where('project_code', $code)->first(); 
        if($qrBasicInfo){
            $user = User::findOrFail($qrBasicInfo->userid); 

            if (Gate::forUser($user)->denies('scan', $qrBasicInfo)) {
                abort(403, 'Scan limit reached! Please upgrade your plan.');
            }
            $qrCode = Videoqr::where('code',$code)->first();  
    
            return view('video-preview')->with(['qrCode'=>$qrCode]);
        }
        else{
            return view('qr-error')->with('message', 'QR Code does not exist.');
        }
       
    }
    public function editAppstoreQrcode($code){

        $app = Appstoreqr::leftJoin('qr_basic_info','qr_basic_info.project_code','=','apkqr.code')
        ->where('apkqr.code',$code)->first(); 
        return view('appstore-edit')->with(['app'=>$app]);
    }
    public function updateAppstoreQrcode(Request $request,$code){
        $request->validate([
            'projectname' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'folderinput'=>'required'
        ]);

        // Save in DB
        $app = Appstoreqr::where('code',$code)->first();
        $app->qrtype= $request->qroption;
        $app->appurl=$request->appurl;
        $app->playstoreurl=$request->playstoreurl;
        $app->windowsurl=$request->windowsurl;
        $app->Huawei=$request->Huawei;
        $app->save();

        $qrBasicInfo = QrBasicInfo::where('project_code',$code)->first();
        $qrBasicInfo->project_name= $request->projectname;
        $qrBasicInfo->folder_name=$request->folderinput; 
        $qrBasicInfo->start_date= $request->startdate;
        $qrBasicInfo->end_date= $request->enddate;
        $qrBasicInfo->usage_type= $request->usage;
        $qrBasicInfo->remarks= $request->remarks;
        $qrBasicInfo->save(); 
         return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function previewApp($code)
    {
        $qrBasicInfo = QrBasicInfo::where('project_code', $code)->first(); 
        if($qrBasicInfo){
            $user = User::findOrFail($qrBasicInfo->userid); 

            if (Gate::forUser($user)->denies('scan', $qrBasicInfo)) {
                abort(403, 'Scan limit reached! Please upgrade your plan.');
            }
            $qrCode = Appstoreqr::where('code',$code)->first();  
    
            return view('app-preview')->with(['qrCode'=>$qrCode]);
        }
        else{
            return view('qr-error')->with('message', 'QR Code does not exist.');
        }
    
    }
    public function editUrlQrcode($code){

        $url = Urlqr::leftJoin('qr_basic_info','qr_basic_info.project_code','=','urlcode.code')
        ->where('urlcode.code',$code)->first(); 
        return view('url-edit')->with(['url'=>$url]);
    }
    public function updateUrlQrcode(Request $request,$code){
        $request->validate([
            'qrurl' => 'required',
            'projectname' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'folderinput'=>'required'
        ]);
         $app = Urlqr::where('code',$code)->first();
         $app->qrtype= $request->qroption;
         $app->qrurl=$request->qrurl;
         $app->save();
 
         $qrBasicInfo = QrBasicInfo::where('project_code',$code)->first();
         $qrBasicInfo->project_name= $request->projectname;
         $qrBasicInfo->folder_name=$request->folderinput; 
         $qrBasicInfo->start_date= $request->startdate;
         $qrBasicInfo->end_date= $request->enddate;
         $qrBasicInfo->usage_type= $request->usage;
         $qrBasicInfo->remarks= $request->remarks;
         $qrBasicInfo->save(); 
         return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function previewUrl($code)
    {
        $qrBasicInfo = QrBasicInfo::where('project_code', $code)->first(); 
        if($qrBasicInfo){
            $user = User::findOrFail($qrBasicInfo->userid); 

            if (Gate::forUser($user)->denies('scan', $qrBasicInfo)) {
                abort(403, 'Scan limit reached! Please upgrade your plan.');
            }
            $qrCode = Urlqr::where('code',$code)->first();  
    
            return view('url-preview')->with(['qrCode'=>$qrCode]);
        }
        else{
            return view('qr-error')->with('message', 'QR Code does not exist.');
        }
        
    }
    public function editVcardQrcode($code){

        $vcard = VCardqr::leftJoin('qr_basic_info','qr_basic_info.project_code','=','vcard.code')
        ->where('vcard.code',$code)->first(); 
        return view('vcard-edit')->with(['vcard'=>$vcard]);
    }
    public function updateVcardQrcode(Request $request,$code){
        $request->validate([
            'contactimg'=>'nullable|file|mimes:jpeg,png,jpg',
            'first_name'=> 'required',
            'last_name'=> 'required',
            'mobile'=> 'required',
            'email'=> 'required',
            'projectname' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'folderinput'=>'required'
        ]);

        $vcard = VCardqr::where('code',$code)->first();
         if ($request->hasFile('contactimg')) {
            if ($vcard->contactimg && Storage::disk('public')->exists($vcard->contactimg)) {  
                Storage::disk('public')->delete($vcard->contactimg);
            }
            $file = $request->file('contactimg');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('images', $fileName, 'public');
            $vcard->contactimg = $filePath;

        }
 
 
        $vcard->qrtype= $request->qroption;
        $vcard->first_name= $request->first_name;
        $vcard->last_name= $request->last_name;
        $vcard->mobile= $request->mobile;
        $vcard->email= $request->email;
        $vcard->company= $request->company;
        $vcard->street= $request->street;
        $vcard->website= $request->website;
        $vcard->city= $request->city;
        $vcard->zip= $request->zip;
        $vcard->state= $request->state;
        $vcard->country= $request->country;
        $vcard->save();
 
        $qrBasicInfo = QrBasicInfo::where('project_code',$code)->first();
        $qrBasicInfo->project_name= $request->projectname;
        $qrBasicInfo->folder_name=$request->folderinput; 
        $qrBasicInfo->start_date= $request->startdate;
        $qrBasicInfo->end_date= $request->enddate;
        $qrBasicInfo->usage_type= $request->usage;
        $qrBasicInfo->remarks= $request->remarks;
        $qrBasicInfo->save(); 
         return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function previewVcard($code)
    {
        $qrBasicInfo = QrBasicInfo::where('project_code', $code)->first(); 
        if($qrBasicInfo){

            $user = User::findOrFail($qrBasicInfo->userid); 

            if (Gate::forUser($user)->denies('scan', $qrBasicInfo)) {
                abort(403, 'Scan limit reached! Please upgrade your plan.');
            }
            $qrCode = VCardqr::where('code',$code)->first();  
    
            return view('vcard-preview')->with(['qrCode'=>$qrCode]);
        }
        else{
            return view('qr-error')->with('message', 'QR Code does not exist.');
        }
       
    }
    public function downloadVcard($code){

        $qrCode = VCardqr::where('code',$code)->first(); 

        $fullName = trim($qrCode->first_name . ' ' . $qrCode->last_name);
        $displayName = !empty($fullName) ? $fullName : $qrCode->company;

        $vcard = "BEGIN:VCARD\n";
        $vcard .= "VERSION:3.0\n";
        $vcard .= "N:" . ($qrCode->last_name ?? '') . ";" . ($qrCode->first_name ?? '') . ";;;\n"; // Structured name
        $vcard .= "FN:$displayName\n"; 
        $vcard .= "TEL:$qrCode->mobile\n";
        $vcard .= "EMAIL:$qrCode->email\n";
        $vcard .= "URL:$qrCode->website\n";
        $vcard .= "PHOTO;TYPE=JPEG;VALUE=URL:storage('app/public/'.$qrCode->contactimg)\n"; // Profile Picture
        $vcard .= "END:VCARD";
    
        return response($vcard)
            ->header('Content-Type', 'text/vcard')
            ->header('Content-Disposition', 'attachment; filename="contact.vcf"');
    }
    public function editSocialQrcode($code){

        $social = SocialMediaqr::leftJoin('qr_basic_info','qr_basic_info.project_code','=','socmedqr.code')
        ->where('socmedqr.code',$code)->first();  
        return view('socialmedia-edit')->with(['social'=>$social]);
    }
    public function updateSocialQrcode(Request $request,$code){
        $request->validate([
             'projectname' => 'required',
             'startdate' => 'required|date',
             'enddate' => 'required|date',
             'folderinput'=>'required'
         ]);
      
         $social = SocialMediaqr::where('code',$code)->first();
         $social->qrtype= $request->qroption;
         $social->whtext = $request->whtext;
         $social->whurl= $request->whturl;
         $social->fbtext= $request->fbtext;
         $social->fburl= $request->fburl;
         $social->ybtext= $request->yutext;
         $social->yturl= $request->yturl;
         $social->insurl= $request->insurl;
         $social->instext= $request->instext;
         $social->wchurl= $request->wchurl;
         $social->wchtext= $request->wchtext;
         $social->tikurl= $request->tikturl;
         $social->tiktext= $request->tiktext;
         $social->tiktext= $request->tiktext;
         $social->dyurl=  $request->dyurl;
         $social->dytext=  $request->dytext;
         $social->telurl=  $request->telurl;
         $social->teltext=  $request->teltext;
         $social->snpurl=  $request->snpurl;
         $social->snptext= $request->snptext;
         $social->save();
  
          $qrBasicInfo = QrBasicInfo::where('project_code',$code)->first();
          $qrBasicInfo->project_name= $request->projectname;
          $qrBasicInfo->folder_name=$request->folderinput; 
          $qrBasicInfo->start_date= $request->startdate;
          $qrBasicInfo->end_date= $request->enddate;
          $qrBasicInfo->usage_type= $request->usage;
          $qrBasicInfo->remarks= $request->remarks;
          $qrBasicInfo->save(); 
         return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function previewSocial($code)
    {
        $qrBasicInfo = QrBasicInfo::where('project_code', $code)->first(); 

        if($qrBasicInfo){

            $user = User::findOrFail($qrBasicInfo->userid); 

            if (Gate::forUser($user)->denies('scan', $qrBasicInfo)) {
                abort(403, 'Scan limit reached! Please upgrade your plan.');
            }
            
            $qrCode = SocialMediaqr::where('code',$code)->first();  
    
            return view('social-preview')->with(['qrCode'=>$qrCode]);
        }
        else{
            return view('qr-error')->with('message', 'QR Code does not exist.');
        }
    }
    public function myqrcodelist(Request $request)
    {
        $userId = Auth::user()->id; 

        $folders = QrBasicInfo::select(
            'folder_name as name',
            DB::raw('COUNT(*) AS count'),
        )
        ->where('userid', $userId)
        ->groupBy('folder_name')
        ->orderBy('created_At', 'DESC')
        ->get();

        $tables = [
            'urlcode', 'btcqr', 'apkqr', 'emailqr', 'imageqr', 'mp3qr', 'pdfqr', 'smsqr',
            'vcard', 'videoqr', 'wifiqr','socmedqr'
        ];

        $query = null;

        foreach ($tables as $table) {
            $subQuery = DB::table($table)
                ->select('id', 'url', 'code', 'qrtype', 'created_at as date', 'userid', 'editstatus')
                ->whereNull('deleted_at');
                if ($query === null) {
                    $query = $subQuery->where('userid', $userId);
                } else {
                    $query->unionAll($subQuery->where('userid', $userId));
                }
          
        }

       if ($query !== null) {
            $results = $query->orderBy('date', 'DESC')->get(); 
        } else {
            $results = collect(); 
        }
        
        $qrCodes = [];

        foreach ($results as $row) {
            if (!isset($row->code)) {
                continue;
            }

            $projectName = QrBasicInfo::where('userid', $userId)
                ->where('project_code',$row->code)
                ->select('project_name','qrtable')
                ->first(); 

            unset($row->qrimage);
            
            $row->projectname = $projectName->project_name ?? '';

            $row->qrtable = $projectName->qrtable;

            $qrCodes[] = (array) $row;
        }  
       return view('my-qr-code',compact('folders','qrCodes'));
    }
    public function folder_details(Request $request){
        $userid = Auth::user()->id; 
        $folder_name = $request->folder_name;   

        $qrCodes = [];

        $projectCodes = QrBasicInfo::where('folder_name', $folder_name)
        ->where('userid', $userid)
        ->pluck('project_code') 
        ->toArray();
        if (empty($projectCodes)) {
            return response()->json([]);
        }  
        $tables = [
            'urlcode', 'btcqr', 'apkqr', 'emailqr', 'imageqr', 'mp3qr', 'pdfqr', 'smsqr',
            'vcard', 'videoqr', 'wifiqr','socmedqr'
        ];

        $combinedResults = collect();

        foreach ($tables as $table) {
            $results = DB::table($table)
                ->select('id', 'url', 'code', 'qrtype', 'created_at as date', 'userid')
                ->where('userid', $userid)
                ->whereIn('code', $projectCodes)
                ->get();
    
            $combinedResults = $combinedResults->merge($results);
        }
        $combinedResults = $combinedResults->sortByDesc('date')->values();

        foreach ($combinedResults as $item) {
            $projectName = DB::table('qr_basic_info')
                ->where('project_code', $item->code)
                ->select('project_name','qrtable')
                ->first(); 
    
            $item->projectname =  $projectName->project_name ?? '';

            $item->qrtable = $projectName->qrtable;

            $qrCodes[] = $item;
        }

        return response()->json($qrCodes);
    }
    
    public function previewSms($code)
    {
        $qrBasicInfo = QrBasicInfo::where('project_code', $code)->first(); 

        if($qrBasicInfo){

            $user = User::findOrFail($qrBasicInfo->userid); 

            if (Gate::forUser($user)->denies('scan', $qrBasicInfo)) {
                abort(403, 'Scan limit reached! Please upgrade your plan.');
            }
            $qrCode = Sms::where('code',$code)->first();  
    
            return view('sms-preview')->with(['qrCode'=>$qrCode]);
        }
        else{
            return view('qr-error')->with('message', 'QR Code does not exist.');
        }
    
    }
    public function countryStatistics(Request $request)
    {
        $code = $request->code;
    
        if (!$code) {
            return response()->json(['error' => 'Invalid QR code.'], 400);
        }
    
        // Get IP and user agent details
        $ip_address = $request->ip() ?? $request->ip;
        $device_type = $request->header('User-Agent') ?? 'unknown_device'; 
        $screen_width = $request->input('screen_width', 'unknown_width');
        $screen_height = $request->input('screen_height', 'unknown_height');
        $fingerprint = $request->input('fingerprint', 'unknown_fingerprint');
        
        $session_id = session()->getId() ?? $request->session_id;
    
        // Unique device identifier: combining fingerprint with other attributes
        $device_identifier = hash('sha256', $ip_address . $device_type . $screen_width . $screen_height . $session_id . $fingerprint);
    
        // Retrieve QR code based on project code
        $qrCode = QrBasicInfo::where('project_code', $code)->first();
        if (!$qrCode) {
            return response()->json(['error' => 'QR code not found.'], 404);
        }
    
        // Get city and country or set defaults
        $city = $request->input('city', 'Unknown');
        $country = $request->input('country', 'Unknown');

        // Check if this device has already scanned
        $existingScan = Scan::where('qr_code_id', $code)
        ->where('device_identifier', $device_identifier)
        ->first();
        // If first-time scan from this device
        if (!$existingScan) {

            $qrCode->increment('total_scans');
            $qrCode->increment('unique_scans');

            Scan::create([
                'qr_code_id' => $code,
                'user_agent' => $device_type,
                'device_identifier' => $device_identifier,
            ]);
            // Update or insert scan statistics
            ScanStatistics::updateOrInsert(
                ['code' => $code, 'city' => $city, 'country' => $country],
                ['scan_count' => \DB::raw('scan_count + 1'), 'created_at' => now(), 'updated_at' => now()]
            );
            \Log::info('New unique scan recorded', ['qr_code_id' => $code, 'device_identifier' => $device_identifier]);
            return response()->json(['message' => 'New unique scan recorded.'], 200);
        } else {
        // Increment total scans
        $qrCode->increment('total_scans');

        // Increment scan count for existing scan statistics
        ScanStatistics::where('code', $code)
            ->where('city', $city)
            ->where('country', $country)
            ->increment('scan_count');

        \Log::info('Scan count updated', ['qr_code_id' => $code, 'device_identifier' => $device_identifier]);
        return response()->json(['message' => 'Scan count updated.'], 200);
    }
}
   public function deleteQrcode(Request $request){

        try {
            DB::beginTransaction();

            $table = $request->table;

            QrBasicInfo::where('project_code', $request->code)->delete();

            Scan::where('qr_code_id', $request->code)->delete();

            ScanStatistics::where('code', $request->code)->delete();

            DB::table($table)->where('code', $request->code)->update(['deleted_at' => Carbon::now()]);

            DB::commit();

            return response()->json(['success' => true, 'message' => 'QR Code deleted successfully.']);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to delete records: ' . $e->getMessage()], 500);
        }
   }
   

}
