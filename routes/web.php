<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
});

Route::get('/dashboard', function () {
    return view('pages/dashboard/home');
})-> name('dashboard');




Route::get('login', [LoginController::class, 'authenticate'])-> name('login');
Route::get('logout', [LoginController::class, 'logout'])-> name('logout');

Route::get('/google/redirect', [App\Http\Controllers\Auth\GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [App\Http\Controllers\Auth\GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');
