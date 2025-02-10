<?php

namespace App\Http\Controllers;

use App\Models\Appstoreqr;
use App\Models\Bitcoinqr;
use App\Models\Emailqr;
use App\Models\Imageqr;
use App\Models\MP3qr;
use App\Models\Pdfqr;
use App\Models\QrBasicInfo;
use App\Models\SocialMediaqr;
use App\Models\Urlqr;
use App\Models\VCardqr;
use App\Models\Videoqr;
use App\Models\Wifiqr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\DB;

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
            'usage' => 'required',
            'folderinput'=>'required'
        ]);

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
         Emailqr::create([
             'code' => $projectCode,
             'qrtype' => $request->qroption,
             'email'=>$request->email,
             'subject'=>$request->subject,
             'message'=>$request->message,
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
             'userid' => Auth::user()->id ?? 'Guest', // Store user ID or 'Guest'
             'qrtable' => 'emailqr', 
             'total_scans' => 0,
             'unique_scans' => 0,
             'created_At' => now(),
         ]);
 
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
            'usage' => 'required',
            'folderinput'=>'required'
        ]);

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
         Wifiqr::create([
             'code' => $projectCode,
             'qrtype' => $request->qroption,
             'ssid'=>$request->ssid,
             'password'=>$request->password,
             'enctype'=>$request->enctype,
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
            'usage' => 'required',
            'folderinput'=>'required'
        ]);

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
         Bitcoinqr::create([
             'code' => $projectCode,
             'qrtype' => $request->qroption,
             'currency'=>$request->currency,
             'quantity'=>$request->quantity,
             'btcaddr'=>$request->btcaddr,
             'btcnetwrk'=>$request->btcnetwrk,
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
            'usage' => 'required',
            'folderinput'=>'required'
        ]);
        
       
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
            'usage' => 'required',
            'folderinput'=>'required'
        ]);
        
       
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
            'imagepath' => 'required|file|mimes:jpeg,png,jpg',
            'projectname' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'usage' => 'required',
            'folderinput'=>'required'
        ]);
        
       
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
            'usage' => 'required',
            'folderinput'=>'required'
        ]);
        
       
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
            'appurl' => 'required',
            'playstoreurl' => 'required',
            'windowsurl' => 'required',
            'Huawei'=>'required',
            'projectname' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'usage' => 'required',
            'folderinput'=>'required'
        ]);

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
          Appstoreqr::create([
             'code' => $projectCode,
             'qrtype' => $request->qroption,
             'appurl'=>$request->appurl,
             'playstoreurl'=>$request->playstoreurl,
             'windowsurl'=>$request->windowsurl,
             'Huawei'=>$request->Huawei,
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
            'usage' => 'required',
            'folderinput'=>'required'
        ]);

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
          Urlqr::create([
             'code' => $projectCode,
             'qrtype' => $request->qroption,
             'qrurl'=>$request->qrurl,
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
             'userid' => Auth::user()->id ?? 'Guest', // Store user ID or 'Guest'
             'qrtable' => 'urlqr', 
             'total_scans' => 0,
             'unique_scans' => 0,
             'created_At' => now(),
         ]);
 
         return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function createVcardQrcode(Request $request){
        $request->validate([
            'contactimg'=>'required|file|mimes:jpeg,png,jpg',
            'first_name'=> 'required',
            'last_name'=> 'required',
            'mobile'=> 'required',
            'email'=> 'required',
            'company'=> 'required',
            'street'=> 'required',
            'website'=> 'required',
            'city'=> 'required',
            'zip'=> 'required',
            'state'=> 'required',
            'country'=> 'required',
            'projectname' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'usage' => 'required',
            'folderinput'=>'required'
        ]);

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

         if ($request->hasFile('contactimg')) {
            $file = $request->file('contactimg');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('contact_images', $fileName, 'public');

        }
 
          // Save in DB
          VCardqr::create([
            'code' => $projectCode,
            'qrtype' => $request->qroption,
            'contactimg'=>$filePath,
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
             'userid' => Auth::user()->id ?? 'Guest', // Store user ID or 'Guest'
             'qrtable' => 'vcardqr', 
             'total_scans' => 0,
             'unique_scans' => 0,
             'created_At' => now(),
         ]);
 
         return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function createSocialQrcode(Request $request){
        $request->validate([
           'whtext'=> 'required',
           'whurl'=> 'required',
           'fbtext'=> 'required',
           'fburl'=> 'required',
           'ybtext'=> 'required',
           'yturl'=> 'required',
           'insurl'=> 'required',
            'instext'=> 'required',
            'wchurl'=> 'required',
            'wchtext'=> 'required',
            'tikurl'=> 'required',
            'tiktext'=> 'required',
            'dyurl'=> 'required',
            'dytext'=> 'required',
            'telurl'=> 'required',
            'teltext'=> 'required',
            'snpurl'=> 'required',
            'snptext'=> 'required',
            'projectname' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'usage' => 'required',
            'folderinput'=>'required'
        ]);

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

         if ($request->hasFile('contactimg')) {
            $file = $request->file('contactimg');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('contact_images', $fileName, 'public');

        }
 
          // Save in DB
          SocialMediaqr::create([
            'code' => $projectCode,
            'qrtype' => $request->qroption,
            'whtext'=> $request->whtext,
            'whurl'=> $request->whurl,
            'fbtext'=> $request->fbtext,
            'fburl'=> $request->fburl,
            'ybtext'=> $request->ybtext,
            'yturl'=> $request->yturl,
            'insurl'=> $request->insurl,
            'instext'=> $request->instext,
            'wchurl'=> $request->wchurl,
            'wchtext'=> $request->wchtext,
            'tikurl'=> $request->tikurl,
            'tiktext'=> $request->tiktext,
            'dyurl'=> $request->dyurl,
            'dytext'=> $request->dytext,
            'telurl'=> $request->telurl,
            'teltext'=> $request->teltext,
            'snpurl'=> $request->snpurl,
            'snptext'=> $request->snptext,
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
             'userid' => Auth::user()->id ?? 'Guest', // Store user ID or 'Guest'
             'qrtable' => 'socmedqr', 
             'total_scans' => 0,
             'unique_scans' => 0,
             'created_At' => now(),
         ]);
 
         return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function myqrcodelist(Request $request)
    {
        $userId = Auth::user()->id; 

        $folders = DB::table('qr_basic_info')
        ->selectRaw('folder_name as name, COUNT(*) AS count, DATE(created_At) AS date')
        ->where('userid', $userId)
        ->groupBy('folder_name', 'date')
        ->orderBy('created_At', 'asc')
        ->get();

        $tables = [
            'urlcode', 'btcqr', 'apkqr', 'dynamicurlcode', 'emailqr', 'epcqr', 'eventqr',
            'facebookqr', 'imageqr', 'mp3qr', 'pdfqr', 'smsqr', 'textqr', 'twitterqr',
            'vcard', 'vcardplus', 'videoqr', 'wifiqr', 'couponqr', 'businessqr',
            'socmedqr', 'ratingqr'
        ];

        $query = null;

        foreach ($tables as $table) {
            $subQuery = DB::table($table)
                ->select('id', 'url', 'code', 'qrtype', 'created_at as date', 'userid', 'editstatus');
                if ($query === null) {
                    $query = $subQuery->where('userid', $userId);
                } else {
                    $query->unionAll($subQuery->where('userid', $userId));
                }
          
        }

       if ($query !== null) {
            $results = $query->get(); 
        } else {
            $results = collect(); 
        }
        
        $qrCodes = [];

        foreach ($results as $row) {
            if (!isset($row->code)) {
                continue;
            }

            $projectName = DB::table('qr_basic_info')
                ->where('userid', $userId)
                ->where('project_code',$row->code)
                ->orderBy('id', 'ASC')
                ->value('project_name');

            unset($row->qrimage);
            
            $row->projectname = $projectName ?? '';

            $qrCodes[] = (array) $row;
        }
       return view('my-qr-code',compact('folders','qrCodes'));
    }
    public function folder_details(Request $request){
        $userid = Auth::user()->id; 
        $folder_name = $request->folder_name;   

        $qrCodes = [];

        $projectCodes = DB::table('qr_basic_info')
        ->where('folder_name', $folder_name)
        ->where('userid', $userid)
        ->pluck('project_code') // Get only project_code column as an array
        ->toArray();
        if (empty($projectCodes)) {
            return response()->json([]);
        }  
        $tables = [
            'urlcode', 'btcqr', 'apkqr', 'dynamicurlcode', 'emailqr', 'epcqr', 'eventqr',
            'facebookqr', 'imageqr', 'mp3qr', 'pdfqr', 'smsqr', 'textqr', 'twitterqr',
            'vcard', 'vcardplus', 'videoqr', 'wifiqr', 'couponqr', 'businessqr',
            'socmedqr', 'ratingqr'
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

        foreach ($combinedResults as $item) {
            $projectName = DB::table('qr_basic_info')
                ->where('project_code', $item->code)
                ->orderBy('created_at', 'asc')
                ->value('project_name');
    
            $item->projectname = $projectName ?? '';
            $qrCodes[] = $item;
        }

        return response()->json($qrCodes);
    }

}
