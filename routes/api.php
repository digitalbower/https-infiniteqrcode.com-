<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StripController;

Route::middleware(['web'])->group(function () {
    Route::post('/stripe/create-payment-intent', [StripController::class, 'createSetupIntent']);
    Route::post('/stripe/subscribe', [StripController::class, 'subscribe']);
    Route::post('/stripe/save-paymentcard', [StripController::class, 'savePaymentCard']);
    Route::post('/stripe/payment-details', [StripController::class, 'getCustomerPaymentMethods']);
    Route::post('/stripe/update-default-card', [StripController::class, 'updateDefaultCard']);

});
