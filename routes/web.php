<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\OtpController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// OTP Routes
Route::get('/otp', function () {
    return view('auth.otp');
})->name('otp');

Route::post('/otp', [OtpController::class, 'verifyOtp'])->name('password.otp');
Route::post('/resend-otp', [OtpController::class, 'resendOtp'])->name('password.resend-otp');
