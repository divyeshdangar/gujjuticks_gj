<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Dashboard\NotificationController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\ImageController;
use App\Http\Controllers\Dashboard\BlogController;
use App\Http\Controllers\Dashboard\MemberController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Pages\BlogController as PublicBlogController;

use App\Http\Controllers\Dashboard\BoardController;
use App\Http\Controllers\Dashboard\BoardItemController;

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
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('dashboard/notification', [NotificationController::class, 'index'])->name('dashboard.notification');
    Route::get('dashboard/notification/action/{action}', [NotificationController::class, 'action'])->name('dashboard.notification.action');

    Route::get('user/profile', [ProfileController::class, 'show'])->name('user.profile');
    Route::get('user/profile/edit', [ProfileController::class, 'index'])->name('user.profile.edit');
    Route::post('user/profile/edit', [ProfileController::class, 'store'])->name('user.profile.edit.post');

    Route::get('dashboard/contact', [ContactController::class, 'index'])->name('dashboard.contact');
    
    Route::get('dashboard/image', [ImageController::class, 'index'])->name('dashboard.image');
    Route::get('dashboard/image/edit/{id}', [ImageController::class, 'edit'])->name('dashboard.image.edit');
    Route::get('dashboard/image/view/{id}', [ImageController::class, 'view'])->name('dashboard.image.view');
    Route::get('dashboard/image/delete/{id}', [ImageController::class, 'delete'])->name('dashboard.image.delete');

    Route::get('dashboard/blog', [BlogController::class, 'index'])->name('dashboard.blog');
    Route::get('dashboard/blog/create', [BlogController::class, 'create'])->name('dashboard.blog.create');
    Route::get('dashboard/blog/edit/{id}', [BlogController::class, 'edit'])->name('dashboard.blog.edit');
    Route::post('dashboard/blog/edit/{id}', [BlogController::class, 'store'])->name('dashboard.blog.edit.post');
    Route::get('dashboard/blog/view/{id}', [BlogController::class, 'view'])->name('dashboard.blog.view');
    Route::get('dashboard/blog/delete/{id}', [BlogController::class, 'delete'])->name('dashboard.blog.delete');

    Route::get('dashboard/board', [BoardController::class, 'index'])->name('dashboard.board');
    Route::get('dashboard/board/create', [BoardController::class, 'create'])->name('dashboard.board.create');
    Route::get('dashboard/board/edit/{id}', [BoardController::class, 'edit'])->name('dashboard.board.edit');
    Route::post('dashboard/board/edit/{id}', [BoardController::class, 'store'])->name('dashboard.board.edit.post');
    Route::get('dashboard/board/delete/{id}', [BoardController::class, 'delete'])->name('dashboard.board.delete');
    Route::get('dashboard/board/{id}', [BoardController::class, 'view'])->name('dashboard.board.items');

    Route::post('dashboard/work-item/edit', [BoardItemController::class, 'updateItem'])->name('dashboard.work_item.edit.post');

    Route::get('dashboard/member', [MemberController::class, 'index'])->name('dashboard.member');
    Route::post('dashboard/member/add', [MemberController::class, 'store'])->name('dashboard.member.create');
});


Route::get('login', [LoginController::class, 'authenticate'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('contact-us', [FormController::class, 'show'])->name('form.contact');
Route::post('contact-us', [FormController::class, 'store'])->name('form.contact.post');

Route::get('blogs', [PublicBlogController::class, 'index'])->name('pages.blog.list');
Route::get('blog/{slug}', [PublicBlogController::class, 'view'])->name('pages.blog.detail');

Route::get('google/redirect', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');
