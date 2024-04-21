<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\NotificationController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Middleware\CheckIfLogin;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/test', function () {
    return view('test');
});

Route::get('language/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'hi', 'gj'])) {
        abort(400);
    } else {
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
})->name('language');

Route::middleware([CheckIfLogin::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('pages/dashboard/home');
    })->name('dashboard');
    Route::get('user/notification', [NotificationController::class, 'index'])->name('user.notification.list');

    Route::get('user/profile', [ProfileController::class, 'show'])->name('user.profile');
    Route::get('user/profile/edit', [ProfileController::class, 'index'])->name('user.profile.edit');
    Route::post('user/profile/edit', [ProfileController::class, 'store'])->name('user.profile.edit.post');

});


Route::get('login', [LoginController::class, 'authenticate'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/google/redirect', [App\Http\Controllers\Auth\GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [App\Http\Controllers\Auth\GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');
