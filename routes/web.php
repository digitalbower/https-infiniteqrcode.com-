<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MyQRCodeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PdfQrCodeController;
use App\Http\Controllers\SubscriptionController;

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/createqrcode', [HomeController::class, 'createqrcode'])->name('createqrcode');
Route::get('/url', [HomeController::class, 'url'])->name('url');
Route::get('/wi-fi', [HomeController::class, 'wifi'])->name('wifi');
Route::get('/vcard', [HomeController::class, 'vcard'])->name('vcard');
Route::get('/video', [HomeController::class, 'video'])->name('video');
Route::get('/sms', [HomeController::class, 'sms'])->name('sms');
Route::get('/email', [HomeController::class, 'email'])->name('email');
Route::get('/image', [HomeController::class, 'image'])->name('image');
Route::get('/pdf', [HomeController::class, 'pdf'])->name('pdf');
Route::get('/bitcoin', [HomeController::class, 'bitcoin'])->name('bitcoin'); 
Route::get('/mp3', [HomeController::class, 'mp3'])->name('mp3');       
Route::get('/app-stores', [HomeController::class, 'appstore'])->name('appstore');    
Route::get('/social-media', [HomeController::class, 'socialmedia'])->name('socialmedia');
Route::get('/analytics', [HomeController::class, 'analytics'])->name('analytics');
Route::get('/plandetails', [HomeController::class, 'plandetails'])->name('plandetails');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/text', [HomeController::class, 'text'])->name('text');
Route::get('/Pdf', [HomeController::class, 'Pdf'])->name('Pdf');
Route::get('/facebook', [HomeController::class, 'facebook'])->name('facebook');
Route::get('/signin', [HomeController::class, 'signin'])->name('signin');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');


Route::get('/subscription', [SubscriptionController::class, 'subscription'])->name('subscription'); // Subscription 
Route::get('/upgrade', [SubscriptionController::class, 'upgrade'])->name('upgrade'); //Upgrade

//Create QR code 
Route::post('create-emailqr',[MyQRCodeController::class, 'createEmailQrcode'])->name('create-emailqr');  
Route::get('edit-emailqr/{id}',[MyQRCodeController::class, 'editEmailQrcode'])->name('edit-emailqr');  
Route::post('update-emailqr/{id}',[MyQRCodeController::class, 'updateEmailQrcode'])->name('update-emailqr');  
Route::get('edit-smsqr/{code}',[MyQRCodeController::class, 'editSmsQrcode'])->name('edit-smsqr');  
Route::post('update-smsqr/{code}',[MyQRCodeController::class, 'updateSmsQrcode'])->name('update-smsqr'); 
Route::post('create-wifiqr',[MyQRCodeController::class, 'createWifiQrcode'])->name('create-wifiqr');  
Route::get('edit-wifiqr/{code}',[MyQRCodeController::class, 'editWifiQrcode'])->name('edit-wifiqr');  
Route::post('update-wifiqr/{code}',[MyQRCodeController::class, 'updateWifiQrcode'])->name('update-wifiqr'); 
Route::post('create-bitcoinqr',[MyQRCodeController::class, 'createBitcoinQrcode'])->name('create-bitcoinqr');  
Route::get('edit-bitcoinqr/{code}',[MyQRCodeController::class, 'editBitcoinQrcode'])->name('edit-bitcoinqr');  
Route::post('update-bitcoinqr/{code}',[MyQRCodeController::class, 'updateBitcoinQrcode'])->name('update-bitcoinqr');  
Route::post('create-pdfqr',[MyQRCodeController::class, 'createPdfQrcode'])->name('create-pdfqr');  
Route::get('edit-pdfqr/{code}',[MyQRCodeController::class, 'editPdfQrcode'])->name('edit-pdfqr');  
Route::post('update-pdfqr/{code}',[MyQRCodeController::class, 'updatePdfQrcode'])->name('update-pdfqr');  
Route::post('create-mp3qr',[MyQRCodeController::class, 'createMp3Qrcode'])->name('create-mp3qr'); 
Route::get('edit-mp3qr/{code}',[MyQRCodeController::class, 'editMp3Qrcode'])->name('edit-mp3qr');  
Route::post('update-mp3qr/{code}',[MyQRCodeController::class, 'updateMp3Qrcode'])->name('update-mp3qr');  
Route::post('create-imageqr',[MyQRCodeController::class, 'createImageQrcode'])->name('create-imageqr'); 
Route::get('edit-imageqr/{code}',[MyQRCodeController::class, 'editImageQrcode'])->name('edit-imageqr');  
Route::post('update-imageqr/{code}',[MyQRCodeController::class, 'updateImageQrcode'])->name('update-imageqr');  
Route::post('create-videoqr',[MyQRCodeController::class, 'createVideoQrcode'])->name('create-videoqr'); 
Route::get('edit-videoqr/{code}',[MyQRCodeController::class, 'editVideoQrcode'])->name('edit-videoqr');  
Route::post('update-videoqr/{code}',[MyQRCodeController::class, 'updateVideoQrcode'])->name('update-videoqr');  
Route::post('create-appqr',[MyQRCodeController::class, 'createAppstoreQrcode'])->name('create-appqr'); 
Route::get('edit-appqr/{code}',[MyQRCodeController::class, 'editAppstoreQrcode'])->name('edit-appqr');  
Route::post('update-appqr/{code}',[MyQRCodeController::class, 'updateAppstoreQrcode'])->name('update-appqr');  
Route::post('create-urlqr',[MyQRCodeController::class, 'createUrlQrcode'])->name('create-urlqr'); 
Route::get('edit-urlqr/{code}',[MyQRCodeController::class, 'editUrlQrcode'])->name('edit-urlqr');  
Route::post('update-urlqr/{code}',[MyQRCodeController::class, 'updateUrlQrcode'])->name('update-urlqr');  
Route::post('create-vcardqr',[MyQRCodeController::class, 'createVcardQrcode'])->name('create-vcardqr'); 
Route::get('edit-vcardqr/{code}',[MyQRCodeController::class, 'editVcardQrcode'])->name('edit-vcardqr');  
Route::post('update-vcardqr/{code}',[MyQRCodeController::class, 'updateVcardQrcode'])->name('update-vcardqr');  
Route::post('create-socialqr',[MyQRCodeController::class, 'createSocialQrcode'])->name('create-socialqr');
Route::get('edit-socialqr/{code}',[MyQRCodeController::class, 'editSocialQrcode'])->name('edit-socialqr');  
Route::post('update-socialqr/{code}',[MyQRCodeController::class, 'updateSocialQrcode'])->name('update-socialqr');   




Route::get('/myqrcodelist', [MyQRCodeController::class, 'myqrcodelist'])->name('myqrcodelist'); //My OR Codes List 
Route::post('/folder_details', [MyQRCodeController::class, 'folder_details'])->name('folder_details'); //Folders Details in My QR Code

//Profile
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
Route::post('profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
Route::post('password-reset', [ProfileController::class, 'password_reset'])->name('password-reset');
Route::post('delete-account', [ProfileController::class, 'delete_account'])->name('delete-account');

Route::get('/qrcode', [HomeController::class, 'qrcode'])->name('qrcode');


Route::post('/myqrcode', [HomeController::class, 'myqrcode'])->name('myqrcode');
Route::get('/mysms/{id}', [HomeController::class, 'mysms'])->name('mysms');



Route::get('/qrcode/create', [HomeController::class, 'create'])->name('qrcode.create');
Route::post('/qrcode/store', [HomeController::class, 'store'])->name('qrcode.store');
Route::get('/qrcode/list', [HomeController::class, 'list'])->name('qrcode.list');
Route::get('/qrcode/{id}', [HomeController::class, 'show'])->name('qrcode.show');


Route::get('/scan-qr', function (Request $request) {
    $data = json_decode($request->get('data'), true);
    return view('qr-view', ['data' => $data]);
});


Route::get('/payment', 'PaymentController@showPaymentForm')->name('payment.form');
Route::post('/process-payment', 'PaymentController@processPayment')->name('process.payment');
Route::get('/payment/success', function () {
    return 'Payment Successful!';
})->name('payment.success');
Route::get('/payment/failure', function () {
    return 'Payment Failed!';
})->name('payment.failure');

Route::get('/payment/success', function () {
    return view('payment-success');
})->name('payment.success');

Route::get('/payment/failure', function () {
    return view('payment-failure');
})->name('payment.failure');

