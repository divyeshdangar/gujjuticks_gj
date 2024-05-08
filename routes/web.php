<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\NotificationController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\ImageController;
use App\Http\Controllers\Dashboard\BlogController;
use App\Http\Middleware\CheckIfLogin;
use App\Http\Controllers\Pages\FormController;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Auth\GoogleLoginController;

Route::get('/', [HomeController::class, 'show'])->name('home');

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

    Route::get('dashboard/contact', [ContactController::class, 'index'])->name('dashboard.contact');
    
    Route::get('dashboard/image', [ImageController::class, 'index'])->name('dashboard.image');
    Route::get('dashboard/image/edit/{id}', [ImageController::class, 'edit'])->name('dashboard.image.edit');
    Route::get('dashboard/image/view/{id}', [ImageController::class, 'view'])->name('dashboard.image.view');
    Route::get('dashboard/image/delete/{id}', [ImageController::class, 'delete'])->name('dashboard.image.delete');

    Route::get('dashboard/blog', [BlogController::class, 'index'])->name('dashboard.blog');
    Route::get('dashboard/blog/edit/{id}', [BlogController::class, 'edit'])->name('dashboard.blog.edit');
    Route::post('dashboard/blog/edit/{id}', [BlogController::class, 'store'])->name('dashboard.blog.edit.post');
    Route::get('dashboard/blog/view/{id}', [BlogController::class, 'view'])->name('dashboard.blog.view');
    Route::get('dashboard/blog/delete/{id}', [BlogController::class, 'delete'])->name('dashboard.blog.delete');

});


Route::get('login', [LoginController::class, 'authenticate'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('contact-us', [FormController::class, 'show'])->name('form.contact');
Route::post('contact-us', [FormController::class, 'store'])->name('form.contact.post');

Route::get('google/redirect', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');
