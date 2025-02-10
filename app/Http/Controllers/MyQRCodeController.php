<?php

namespace App\Http\Controllers;

use App\Models\Appstoreqr;
use App\Models\Bitcoinqr;
use App\Models\Emailqr;
use App\Models\Imageqr;
use App\Models\MP3qr;
use App\Models\Pdfqr;
use App\Models\QrBasicInfo;
use App\Models\Sms;
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
use Twilio\Rest\Video;

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
 
         $url = $data."redirects/email?id=". $projectCode; 
          // Save in DB
         Emailqr::create([
             'code' => $projectCode,
             'qrtype' => $request->qroption,
             'email'=>$request->email,
             'subject'=>$request->subject,
             'message'=>$request->message,
             'url'=>$url,
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
             'url'=>$url,
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
 
         $url = $data."redirects/wifi?id=". $projectCode; 
          // Save in DB
         Wifiqr::create([
             'code' => $projectCode,
             'qrtype' => $request->qroption,
             'ssid'=>$request->ssid,
             'password'=>$request->password,
             'enctype'=>$request->enctype,
             'url'=>$url,
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
             'url'=>$url,
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
 
        $url = $data."redirects/bitcoin?id=". $projectCode; 

          // Save in DB
         Bitcoinqr::create([
             'code' => $projectCode,
             'qrtype' => $request->qroption,
             'currency'=>$request->currency,
             'quantity'=>$request->quantity,
             'btcaddr'=>$request->btcaddr,
             'btcnetwrk'=>$request->btcnetwrk,
             'url'=>$url,
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
             'url'=>$url,
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

        $url = $data."redirects/pdf?id=". $projectCode; 

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
            'url'=>$url ,
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
            'url'=>$url ,
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

        $url = $data."redirects/mp3?id=". $projectCode; 

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
            'url'=>$url,
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
            'url'=>$url,
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

        $url = $data."redirects/image?id=". $projectCode; 

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
            'url'=>$url ,
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
            'url'=>$url,
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

        $url = $data."redirects/video?id=". $projectCode; 

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
            'url'=>$url ,
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
            'url'=>$url,
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

         $url = $data."redirects/app?id=". $projectCode; 
 
          // Save in DB
          Appstoreqr::create([
             'code' => $projectCode,
             'qrtype' => $request->qroption,
             'appurl'=>$request->appurl,
             'playstoreurl'=>$request->playstoreurl,
             'windowsurl'=>$request->windowsurl,
             'Huawei'=>$request->Huawei,
             'url'=>$url,
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
             'url'=>$url,
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

         $url = $data."redirects/url?id=". $projectCode; 
 
          // Save in DB
          Urlqr::create([
             'code' => $projectCode,
             'qrtype' => $request->qroption,
             'qrurl'=>$request->qrurl,
             'url'=>$url,
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
             'url'=>$url,
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

         $url = $data."redirects/vcard?id=". $projectCode; 

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
            'url'=>$url,
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
             'url'=>$url,
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

         $url = $data."redirects/social?id=". $projectCode; 
 
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
            'url'=>$url,
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
             'url'=>$url,
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
            'usage' => 'required',
            'folderinput'=>'required'
        ]);

         // Generate QR Code and save to storage
         $data = 'https://infiniteqrcode.com/';
 
         $projectCode = $code;
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
 
         $url = $data."redirects/email?id=". $projectCode; 
          // Save in DB
        $email = Emailqr::where('code',$code)->first();
        $email->code= $projectCode;
        $email->qrtype= $request->qroption;
        $email->email=$request->email;
        $email->subject=$request->subject;
        $email->message=$request->message;
        $email->url=$url;
        $email->qrimage=$qrCodePath;
        $email->userid= Auth::user()->id ?? 'Guest'; // Store user ID or 'Guest'
        $email->save();

        $qrBasicInfo = QrBasicInfo::where('project_code',$code)->first();
        $qrBasicInfo->project_code= $projectCode;
        $qrBasicInfo->project_name= $request->projectname;
        $qrBasicInfo->folder_name=$request->folderinput; 
        $qrBasicInfo->qrtype=$request->qroption;
        $qrBasicInfo->start_date= $request->startdate;
        $qrBasicInfo->end_date= $request->enddate;
        $qrBasicInfo->usage_type= $request->usage;
        $qrBasicInfo->remarks= $request->remarks;
        $qrBasicInfo->url=$url;
        $qrBasicInfo->userid= Auth::user()->id ?? 'Guest'; // Store user ID or 'Guest'
        $qrBasicInfo->qrtable= 'emailqr'; 
        $qrBasicInfo->total_scans= 0;
        $qrBasicInfo->unique_scans= 0;
        $qrBasicInfo->created_At= now();
        $qrBasicInfo->save(); 
          
         return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
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
            'usage' => 'required',
            'folderinput'=>'required'
        ]);
         // Generate QR Code and save to storage
         $data = 'https://infiniteqrcode.com/';
 
         $projectCode = $code;
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
        $sms = Sms::where('code',$code)->first();
        $sms->code= $projectCode;
        $sms->qrtype= $request->qroption;
        $sms->qrsms=$request->sms;
        $sms->countrycode=$request->countrycode;
        $sms->phonenumber=$request->phone;
        $sms->url=$url;
        $sms->qrimage=$qrCodePath;
        $sms->userid= Auth::user()->id ?? 'Guest'; // Store user ID or 'Guest'
        $sms->save();

        $qrBasicInfo = QrBasicInfo::where('project_code',$code)->first();
        $qrBasicInfo->project_code= $projectCode;
        $qrBasicInfo->project_name= $request->projectname;
        $qrBasicInfo->folder_name=$request->folderinput; 
        $qrBasicInfo->qrtype=$request->qroption;
        $qrBasicInfo->start_date= $request->startdate;
        $qrBasicInfo->end_date= $request->enddate;
        $qrBasicInfo->usage_type= $request->usage;
        $qrBasicInfo->remarks= $request->remarks;
        $qrBasicInfo->url=$url;
        $qrBasicInfo->userid= Auth::user()->id ?? 'Guest'; // Store user ID or 'Guest'
        $qrBasicInfo->qrtable= 'smsqr'; 
        $qrBasicInfo->total_scans= 0;
        $qrBasicInfo->unique_scans= 0;
        $qrBasicInfo->created_At= now();
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
            'usage' => 'required',
            'folderinput'=>'required'
        ]);

         // Generate QR Code and save to storage
         $data = 'https://infiniteqrcode.com/';
 
         $projectCode = $code;
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

         $url = $data."redirects/bitcoin?id=". $projectCode; 

          // Save in DB
        $wifi = Wifiqr::where('code',$code)->first();
        $wifi->code= $projectCode;
        $wifi->qrtype= $request->qroption;
        $wifi->ssid=$request->ssid;
        $wifi->password=$request->password;
        $wifi->enctype=$request->enctype;
        $wifi->url=$url;
        $wifi->qrimage=$qrCodePath;
        $wifi->userid= Auth::user()->id ?? 'Guest'; // Store user ID or 'Guest'
        $wifi->save();

        $qrBasicInfo = QrBasicInfo::where('project_code',$code)->first();
        $qrBasicInfo->project_code= $projectCode;
        $qrBasicInfo->project_name= $request->projectname;
        $qrBasicInfo->folder_name=$request->folderinput; 
        $qrBasicInfo->qrtype=$request->qroption;
        $qrBasicInfo->start_date= $request->startdate;
        $qrBasicInfo->end_date= $request->enddate;
        $qrBasicInfo->usage_type= $request->usage;
        $qrBasicInfo->remarks= $request->remarks;
        $qrBasicInfo->url=$url;
        $qrBasicInfo->userid= Auth::user()->id ?? 'Guest'; // Store user ID or 'Guest'
        $qrBasicInfo->qrtable= 'wifiqr'; 
        $qrBasicInfo->total_scans= 0;
        $qrBasicInfo->unique_scans= 0;
        $qrBasicInfo->created_At= now();
        $qrBasicInfo->save(); 
          
        return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
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
            'usage' => 'required',
            'folderinput'=>'required'
        ]);

         // Generate QR Code and save to storage
         $data = 'https://infiniteqrcode.com/';
 
         $projectCode = $code;
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
 
        $url = $data."redirects/bitcoin?id=". $projectCode; 

          // Save in DB
          $bitcoin = Bitcoinqr::where('code',$code)->first();
          $bitcoin->code= $projectCode;
          $bitcoin->qrtype= $request->qroption;
          $bitcoin->currency=$request->currency;
          $bitcoin->quantity=$request->quantity;
          $bitcoin->btcaddr=$request->btcaddr;
          $bitcoin->btcnetwrk=$request->btcnetwrk;
          $bitcoin->url=$url;
          $bitcoin->qrimage=$qrCodePath;
          $bitcoin->userid= Auth::user()->id ?? 'Guest'; // Store user ID or 'Guest'
          $bitcoin->save();
  
          $qrBasicInfo = QrBasicInfo::where('project_code',$code)->first();
          $qrBasicInfo->project_code= $projectCode;
          $qrBasicInfo->project_name= $request->projectname;
          $qrBasicInfo->folder_name=$request->folderinput; 
          $qrBasicInfo->qrtype=$request->qroption;
          $qrBasicInfo->start_date= $request->startdate;
          $qrBasicInfo->end_date= $request->enddate;
          $qrBasicInfo->usage_type= $request->usage;
          $qrBasicInfo->remarks= $request->remarks;
          $qrBasicInfo->url=$url;
          $qrBasicInfo->userid= Auth::user()->id ?? 'Guest'; // Store user ID or 'Guest'
          $qrBasicInfo->qrtable= 'btcqr'; 
          $qrBasicInfo->total_scans= 0;
          $qrBasicInfo->unique_scans= 0;
          $qrBasicInfo->created_At= now();
          $qrBasicInfo->save(); 
 
         return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function editPdfQrcode($code){

        $pdf = Pdfqr::leftJoin('qr_basic_info','qr_basic_info.project_code','=','pdfqr.code')
        ->where('pdfqr.code',$code)->first(); 
        return view('pdf-edit')->with(['pdf'=>$pdf]);
    }
    public function updatePdfQrcode(Request $request,$code){
    
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
 
        $projectCode = $code;
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

        $url = $data."redirects/pdf?id=". $projectCode; 


        if ($request->file('pdfpath')) {
            $file = $request->file('pdfpath');
            $fileName = time() . '.' . $file->getClientOriginalExtension(); 
            $filePath = $file->storeAs('pdfs', $fileName, 'public');
        }
          // Save in DB
          $pdf = Pdfqr::where('code',$code)->first();
          $pdf->code= $projectCode;
          $pdf->qrtype= $request->qroption;
          $pdf->pdfpath=$filePath;
          $pdf->url=$url;
          $pdf->qrimage=$qrCodePath;
          $pdf->userid= Auth::user()->id ?? 'Guest'; // Store user ID or 'Guest'
          $pdf->save();
  
          $qrBasicInfo = QrBasicInfo::where('project_code',$code)->first();
          $qrBasicInfo->project_code= $projectCode;
          $qrBasicInfo->project_name= $request->projectname;
          $qrBasicInfo->folder_name=$request->folderinput; 
          $qrBasicInfo->qrtype=$request->qroption;
          $qrBasicInfo->start_date= $request->startdate;
          $qrBasicInfo->end_date= $request->enddate;
          $qrBasicInfo->usage_type= $request->usage;
          $qrBasicInfo->remarks= $request->remarks;
          $qrBasicInfo->url=$url;
          $qrBasicInfo->userid= Auth::user()->id ?? 'Guest'; // Store user ID or 'Guest'
          $qrBasicInfo->qrtable= 'pdfqr'; 
          $qrBasicInfo->total_scans= 0;
          $qrBasicInfo->unique_scans= 0;
          $qrBasicInfo->created_At= now();
          $qrBasicInfo->save(); 
        return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function editMp3Qrcode($code){

        $mp3 = MP3qr::leftJoin('qr_basic_info','qr_basic_info.project_code','=','mp3qr.code')
        ->where('mp3qr.code',$code)->first(); 
        return view('mp3-edit')->with(['mp3'=>$mp3]);
    }
    public function updateMp3Qrcode(Request $request,$code){
    
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
 
        $projectCode = $code;
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

        $url = $data."redirects/mp3?id=". $projectCode; 

        // Store the file
        if ($request->hasFile('mp3path')) {
            $file = $request->file('mp3path');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('mp3s', $fileName, 'public');

        }
       
        // Save in DB
        $mp3 = MP3qr::where('code',$code)->first();
        $mp3->code= $projectCode;
        $mp3->qrtype= $request->qroption;
        $mp3->qrtext = $request->qrtext;
        $mp3->mp3path=$filePath;
        $mp3->url=$url;
        $mp3->qrimage=$qrCodePath;
        $mp3->userid= Auth::user()->id ?? 'Guest'; // Store user ID or 'Guest'
        $mp3->save();

        $qrBasicInfo = QrBasicInfo::where('project_code',$code)->first();
        $qrBasicInfo->project_code= $projectCode;
        $qrBasicInfo->project_name= $request->projectname;
        $qrBasicInfo->folder_name=$request->folderinput; 
        $qrBasicInfo->qrtype=$request->qroption;
        $qrBasicInfo->start_date= $request->startdate;
        $qrBasicInfo->end_date= $request->enddate;
        $qrBasicInfo->usage_type= $request->usage;
        $qrBasicInfo->remarks= $request->remarks;
        $qrBasicInfo->url=$url;
        $qrBasicInfo->userid= Auth::user()->id ?? 'Guest'; // Store user ID or 'Guest'
        $qrBasicInfo->qrtable= 'mp3qr'; 
        $qrBasicInfo->total_scans= 0;
        $qrBasicInfo->unique_scans= 0;
        $qrBasicInfo->created_At= now();
        $qrBasicInfo->save(); 
        return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function editImageQrcode($code){

        $image = Imageqr::leftJoin('qr_basic_info','qr_basic_info.project_code','=','imageqr.code')
        ->where('imageqr.code',$code)->first(); 
        return view('image-edit')->with(['image'=>$image]);
    }
    public function updateImageQrcode(Request $request,$code){
    
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
 
        $projectCode =$code;
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

        $url = $data."redirects/image?id=". $projectCode; 

        // Store the file
        if ($request->hasFile('imagepath')) {
            $file = $request->file('imagepath');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('images', $fileName, 'public');

        }
        // Save in DB
        $img = Imageqr::where('code',$code)->first();
        $img->code= $projectCode;
        $img->qrtype= $request->qroption;
        $img->imagepath=$filePath;
        $img->url=$url;
        $img->qrimage=$qrCodePath;
        $img->userid= Auth::user()->id ?? 'Guest'; // Store user ID or 'Guest'
        $img->save();

        $qrBasicInfo = QrBasicInfo::where('project_code',$code)->first();
        $qrBasicInfo->project_code= $projectCode;
        $qrBasicInfo->project_name= $request->projectname;
        $qrBasicInfo->folder_name=$request->folderinput; 
        $qrBasicInfo->qrtype=$request->qroption;
        $qrBasicInfo->start_date= $request->startdate;
        $qrBasicInfo->end_date= $request->enddate;
        $qrBasicInfo->usage_type= $request->usage;
        $qrBasicInfo->remarks= $request->remarks;
        $qrBasicInfo->url=$url;
        $qrBasicInfo->userid= Auth::user()->id ?? 'Guest'; // Store user ID or 'Guest'
        $qrBasicInfo->qrtable= 'imageqr'; 
        $qrBasicInfo->total_scans= 0;
        $qrBasicInfo->unique_scans= 0;
        $qrBasicInfo->created_At= now();
        $qrBasicInfo->save(); 

        return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function editVideoQrcode($code){

        $video = Videoqr::leftJoin('qr_basic_info','qr_basic_info.project_code','=','videoqr.code')
        ->where('videoqr.code',$code)->first(); 
        return view('video-edit')->with(['video'=>$video]);
    }
    public function updateVideoQrcode(Request $request,$code){
    
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
 
        $projectCode = $code;
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

        $url = $data."redirects/video?id=". $projectCode; 

        // Store the file
        if ($request->hasFile('videopath')) {
            $file = $request->file('videopath');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('videos', $fileName, 'public');

        }
        // Save in DB
        $video = Videoqr::where('code',$code)->first();
        $video->code= $projectCode;
        $video->qrtype= $request->qroption;
        $video->videopath=$filePath;
        $video->url=$url;
        $video->qrimage=$qrCodePath;
        $video->userid= Auth::user()->id ?? 'Guest'; // Store user ID or 'Guest'
        $video->save();

        $qrBasicInfo = QrBasicInfo::where('project_code',$code)->first();
        $qrBasicInfo->project_code= $projectCode;
        $qrBasicInfo->project_name= $request->projectname;
        $qrBasicInfo->folder_name=$request->folderinput; 
        $qrBasicInfo->qrtype=$request->qroption;
        $qrBasicInfo->start_date= $request->startdate;
        $qrBasicInfo->end_date= $request->enddate;
        $qrBasicInfo->usage_type= $request->usage;
        $qrBasicInfo->remarks= $request->remarks;
        $qrBasicInfo->url=$url;
        $qrBasicInfo->userid= Auth::user()->id ?? 'Guest'; // Store user ID or 'Guest'
        $qrBasicInfo->qrtable= 'videoqr'; 
        $qrBasicInfo->total_scans= 0;
        $qrBasicInfo->unique_scans= 0;
        $qrBasicInfo->created_At= now();
        $qrBasicInfo->save(); 
        return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function editAppstoreQrcode($code){

        $app = Appstoreqr::leftJoin('qr_basic_info','qr_basic_info.project_code','=','apkqr.code')
        ->where('apkqr.code',$code)->first(); 
        return view('appstore-edit')->with(['app'=>$app]);
    }
    public function updateAppstoreQrcode(Request $request,$code){
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
 
         $projectCode = $code;
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

         $url = $data."redirects/app?id=". $projectCode; 
        // Save in DB
        $app = Appstoreqr::where('code',$code)->first();
        $app->code= $projectCode;
        $app->qrtype= $request->qroption;
        $app->appurl=$request->appurl;
        $app->playstoreurl=$request->playstoreurl;
        $app->windowsurl=$request->windowsurl;
        $app->Huawei=$request->Huawei;
        $app->url=$url;
        $app->qrimage=$qrCodePath;
        $app->userid= Auth::user()->id ?? 'Guest'; // Store user ID or 'Guest'
        $app->save();

        $qrBasicInfo = QrBasicInfo::where('project_code',$code)->first();
        $qrBasicInfo->project_code= $projectCode;
        $qrBasicInfo->project_name= $request->projectname;
        $qrBasicInfo->folder_name=$request->folderinput; 
        $qrBasicInfo->qrtype=$request->qroption;
        $qrBasicInfo->start_date= $request->startdate;
        $qrBasicInfo->end_date= $request->enddate;
        $qrBasicInfo->usage_type= $request->usage;
        $qrBasicInfo->remarks= $request->remarks;
        $qrBasicInfo->url=$url;
        $qrBasicInfo->userid= Auth::user()->id ?? 'Guest'; // Store user ID or 'Guest'
        $qrBasicInfo->qrtable= 'apkqr'; 
        $qrBasicInfo->total_scans= 0;
        $qrBasicInfo->unique_scans= 0;
        $qrBasicInfo->created_At= now();
        $qrBasicInfo->save(); 
         return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
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
            'usage' => 'required',
            'folderinput'=>'required'
        ]);

         // Generate QR Code and save to storage
         $data = 'https://infiniteqrcode.com/';
 
         $projectCode = $code;
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

         $url = $data."redirects/url?id=". $projectCode; 
 
         $app = Urlqr::where('code',$code)->first();
         $app->code= $projectCode;
         $app->qrtype= $request->qroption;
         $app->qrurl=$request->qrurl;
         $app->url=$url;
         $app->qrimage=$qrCodePath;
         $app->userid= Auth::user()->id ?? 'Guest'; // Store user ID or 'Guest'
         $app->save();
 
         $qrBasicInfo = QrBasicInfo::where('project_code',$code)->first();
         $qrBasicInfo->project_code= $projectCode;
         $qrBasicInfo->project_name= $request->projectname;
         $qrBasicInfo->folder_name=$request->folderinput; 
         $qrBasicInfo->qrtype=$request->qroption;
         $qrBasicInfo->start_date= $request->startdate;
         $qrBasicInfo->end_date= $request->enddate;
         $qrBasicInfo->usage_type= $request->usage;
         $qrBasicInfo->remarks= $request->remarks;
         $qrBasicInfo->url=$url;
         $qrBasicInfo->userid= Auth::user()->id ?? 'Guest'; // Store user ID or 'Guest'
         $qrBasicInfo->qrtable= 'urlcode'; 
         $qrBasicInfo->total_scans= 0;
         $qrBasicInfo->unique_scans= 0;
         $qrBasicInfo->created_At= now();
         $qrBasicInfo->save(); 
         return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function editVcardQrcode($code){

        $vcard = VCardqr::leftJoin('qr_basic_info','qr_basic_info.project_code','=','vcard.code')
        ->where('vcard.code',$code)->first(); 
        return view('vcard-edit')->with(['vcard'=>$vcard]);
    }
    public function updateVcardQrcode(Request $request,$code){
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
 
         $projectCode = $code;
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

         $url = $data."redirects/vcard?id=". $projectCode; 

         if ($request->hasFile('contactimg')) {
            $file = $request->file('contactimg');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('contact_images', $fileName, 'public');

        }
 
 
        $vcard = VCardqr::where('code',$code)->first();
        $vcard->code= $projectCode;
        $vcard->qrtype= $request->qroption;
        $vcard->contactimg = $filePath;
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
        $vcard->url=$url;
        $vcard->qrimage=$qrCodePath;
        $vcard->userid= Auth::user()->id ?? 'Guest'; // Store user ID or 'Guest'
        $vcard->save();
 
         $qrBasicInfo = QrBasicInfo::where('project_code',$code)->first();
         $qrBasicInfo->project_code= $projectCode;
         $qrBasicInfo->project_name= $request->projectname;
         $qrBasicInfo->folder_name=$request->folderinput; 
         $qrBasicInfo->qrtype=$request->qroption;
         $qrBasicInfo->start_date= $request->startdate;
         $qrBasicInfo->end_date= $request->enddate;
         $qrBasicInfo->usage_type= $request->usage;
         $qrBasicInfo->remarks= $request->remarks;
         $qrBasicInfo->url=$url;
         $qrBasicInfo->userid= Auth::user()->id ?? 'Guest'; // Store user ID or 'Guest'
         $qrBasicInfo->qrtable= 'vcard'; 
         $qrBasicInfo->total_scans= 0;
         $qrBasicInfo->unique_scans= 0;
         $qrBasicInfo->created_At= now();
         $qrBasicInfo->save(); 
 
         return redirect()->route('myqrcodelist')->with('success', 'QR Code Generated Successfully');
    }
    public function editSocialQrcode($code){

        $social = SocialMediaqr::leftJoin('qr_basic_info','qr_basic_info.project_code','=','socmedqr.code')
        ->where('socmedqr.code',$code)->first(); 
        return view('social-edit')->with(['social'=>$social]);
    }
    public function updateSocialQrcode(Request $request,$code){
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
 
         $projectCode = $code;
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

         $url = $data."redirects/social?id=". $projectCode; 
 
       
         $social = SocialMediaqr::where('code',$code)->first();
         $social->code= $projectCode;
         $social->qrtype= $request->qroption;
         $social->whtext = $request->whtext;
         $social->whurl= $request->whurl;
         $social->fbtext= $request->fbtext;
         $social->fburl= $request->fburl;
         $social->ybtext= $request->ybtext;
         $social->yturl= $request->yturl;
         $social->insurl= $request->insurl;
         $social->instext= $request->instext;
         $social->wchurl= $request->wchurl;
         $social->wchtext= $request->wchtext;
         $social->tikurl= $request->tikurl;
         $social->tiktext= $request->tiktext;
         $social->tiktext= $request->tiktext;
         $social->dyurl=  $request->dyurl;
         $social->dytext=  $request->dytext;
         $social->telurl=  $request->telurl;
         $social->teltext=  $request->teltext;
         $social->snpurl=  $request->snpurl;
         $social->snptext= $request->snptext;
         $social->url=$url;
         $social->qrimage=$qrCodePath;
         $social->userid= Auth::user()->id ?? 'Guest'; // Store user ID or 'Guest'
         $social->save();
  
          $qrBasicInfo = QrBasicInfo::where('project_code',$code)->first();
          $qrBasicInfo->project_code= $projectCode;
          $qrBasicInfo->project_name= $request->projectname;
          $qrBasicInfo->folder_name=$request->folderinput; 
          $qrBasicInfo->qrtype=$request->qroption;
          $qrBasicInfo->start_date= $request->startdate;
          $qrBasicInfo->end_date= $request->enddate;
          $qrBasicInfo->usage_type= $request->usage;
          $qrBasicInfo->remarks= $request->remarks;
          $qrBasicInfo->url=$url;
          $qrBasicInfo->userid= Auth::user()->id ?? 'Guest'; // Store user ID or 'Guest'
          $qrBasicInfo->qrtable= 'socmedqr'; 
          $qrBasicInfo->total_scans= 0;
          $qrBasicInfo->unique_scans= 0;
          $qrBasicInfo->created_At= now();
          $qrBasicInfo->save(); 
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
