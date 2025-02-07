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

Route::get('/myqrcodelist', [MyQRCodeController::class, 'myqrcodelist'])->name('myqrcodelist'); //My OR Codes 
Route::post('/folder_details', [MyQRCodeController::class, 'folder_details'])->name('folder_details'); //Folders Details in My QR Code

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

