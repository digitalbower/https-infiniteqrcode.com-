<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use App\Http\Controllers\PaymentController;



Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/createqrcode', [HomeController::class, 'createqrcode'])->name('createqrcode');
Route::get('/url', [HomeController::class, 'url'])->name('url');
Route::get('/wifi', [HomeController::class, 'wifi'])->name('wifi');
Route::get('/vcard', [HomeController::class, 'vcard'])->name('vcard');
Route::get('/video', [HomeController::class, 'video'])->name('video');
Route::get('/sms', [HomeController::class, 'sms'])->name('sms');
Route::get('/email', [HomeController::class, 'email'])->name('email');
Route::get('/image', [HomeController::class, 'image'])->name('image');
Route::get('/pdf', [HomeController::class, 'pdf'])->name('pdf');
Route::get('/bitcoin', [HomeController::class, 'bitcoin'])->name('bitcoin'); 
Route::get('/mp3', [HomeController::class, 'mp3'])->name('mp3');       
Route::get('/appstore', [HomeController::class, 'appstore'])->name('appstore');    
Route::get('/socialmedia', [HomeController::class, 'socialmedia'])->name('socialmedia');
Route::get('/analytics', [HomeController::class, 'analytics'])->name('analytics');
Route::get('/my-qr-code', [HomeController::class, 'myqrcode'])->name('myqrcode');
Route::get('/upgrade', [HomeController::class, 'upgrade'])->name('upgrade');
Route::get('/plandetails', [HomeController::class, 'plandetails'])->name('plandetails');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/text', [HomeController::class, 'text'])->name('text');
Route::get('/Pdf', [HomeController::class, 'Pdf'])->name('Pdf');
Route::get('/facebook', [HomeController::class, 'facebook'])->name('facebook');
Route::get('/subscription', [HomeController::class, 'subscription'])->name('subscription');
Route::get('/signin', [HomeController::class, 'signin'])->name('signin');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('/upgrade', [HomeController::class, 'upgrade'])->name('upgrade');

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
Route::post('profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
Route::post('password-reset', [ProfileController::class, 'password_reset'])->name('password-reset');

Route::get('/qrcode', [HomeController::class, 'index'])->name('qrcode.index');
Route::post('/qrstore', [HomeController::class, 'qrstore'])->name('qrstore');
Route::get('/mysms', [HomeController::class, 'mysms'])->name('mysms');
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

