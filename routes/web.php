<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\NotificationController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\ImageController;
use App\Http\Controllers\Dashboard\BlogController;
use App\Http\Controllers\Dashboard\BlogCategoryController;
use App\Http\Controllers\Dashboard\MemberController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\DashboardoController;
use App\Http\Controllers\Dashboard\BoardController;
use App\Http\Controllers\Dashboard\BoardItemController;
use App\Http\Controllers\Dashboard\PostsController;
use App\Http\Controllers\Dashboard\LocationController;
use App\Http\Controllers\Dashboard\PagesController;
use App\Http\Controllers\Dashboard\SocialMediaController;
use App\Http\Controllers\Dashboard\WebpageController;

use App\Http\Middleware\CheckIfLogin;
use App\Http\Middleware\CheckLanguage;

use App\Http\Controllers\Pages\BlogController as PublicBlogController;
use App\Http\Controllers\Pages\PublicImageController;
use App\Http\Controllers\Pages\GujaratController;
use App\Http\Controllers\Pages\PagesController as PublicPagesController;
use App\Http\Controllers\Pages\FormController;
use App\Http\Controllers\Pages\HomeController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\Auth\InstagramController;

Route::middleware([CheckLanguage::class])->group(function () {
    Route::get('/', [HomeController::class, 'show'])->name('home');    
    Route::get('/test', function () {
        return view('test');
    });
    Route::get('/google', function () {
        return view('google');
    });
    Route::get('login', [LoginController::class, 'authenticate'])->name('login');
    Route::get('contact-us', [FormController::class, 'show'])->name('form.contact');
    Route::get('blogs', [PublicBlogController::class, 'index'])->name('pages.blog.list');
    Route::get('blog-on-{slug}', [PublicBlogController::class, 'category'])->name('pages.blog.category.detail');
    Route::get('blog/{slug}', [PublicBlogController::class, 'view'])->name('pages.blog.detail');

    Route::get('image/{slug}', [PublicImageController::class, 'view'])->name('pages.image.detail');
    Route::post('image/save', [PublicImageController::class, 'store'])->name('pages.image.detail.save');

    Route::get('gujarat', [GujaratController::class, 'index'])->name('pages.gujarat');
    Route::get('gujarat/{slug}', [GujaratController::class, 'district'])->name('pages.gujarat.district');

    Route::get('p/{slug}', [PublicPagesController::class, 'view'])->name('p.pages');
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

Route::middleware([CheckIfLogin::class, CheckLanguage::class])->group(function () {
    Route::get('dashboard', [DashboardoController::class, 'index'])->name('dashboard');

    Route::get('dashboard/notification', [NotificationController::class, 'index'])->name('dashboard.notification');
    Route::get('dashboard/notification/action/{action}', [NotificationController::class, 'action'])->name('dashboard.notification.action');

    Route::get('dashboard/profile', [ProfileController::class, 'show'])->name('dashboard.profile');
    Route::get('dashboard/profile/edit', [ProfileController::class, 'index'])->name('dashboard.profile.edit');
    Route::post('dashboard/profile/edit', [ProfileController::class, 'store'])->name('dashboard.profile.edit.post');

    Route::get('dashboard/contact', [ContactController::class, 'index'])->name('dashboard.contact');
    
    Route::get('dashboard/image', [ImageController::class, 'index'])->name('dashboard.image');
    Route::get('dashboard/image/create', [ImageController::class, 'create'])->name('dashboard.image.create');
    Route::get('dashboard/image/edit/{id}', [ImageController::class, 'edit'])->name('dashboard.image.edit');
    Route::post('dashboard/image/edit/{id}', [ImageController::class, 'store'])->name('dashboard.image.edit.post');
    Route::post('dashboard/image/update/{id}', [ImageController::class, 'update'])->name('dashboard.image.update.post');
    Route::post('dashboard/image/upload/{id}', [ImageController::class, 'upload'])->name('dashboard.image.image.post');
    Route::get('dashboard/image/view/{id}', [ImageController::class, 'view'])->name('dashboard.image.view');
    Route::get('dashboard/image/delete/{id}', [ImageController::class, 'delete'])->name('dashboard.image.delete');
    Route::get('dashboard/image/copy/{id}', [ImageController::class, 'copy'])->name('dashboard.image.copy');

    Route::get('dashboard/blog', [BlogController::class, 'index'])->name('dashboard.blog');
    Route::get('dashboard/blog/create', [BlogController::class, 'create'])->name('dashboard.blog.create');
    Route::get('dashboard/blog/edit/{id}', [BlogController::class, 'edit'])->name('dashboard.blog.edit');
    Route::post('dashboard/blog/edit/{id}', [BlogController::class, 'store'])->name('dashboard.blog.edit.post');
    Route::get('dashboard/blog/view/{id}', [BlogController::class, 'view'])->name('dashboard.blog.view');
    Route::get('dashboard/blog/delete/{id}', [BlogController::class, 'delete'])->name('dashboard.blog.delete');

    Route::get('dashboard/pages', [PagesController::class, 'index'])->name('dashboard.pages');
    Route::get('dashboard/pages/create', [PagesController::class, 'create'])->name('dashboard.pages.create');
    Route::get('dashboard/pages/edit/{id}', [PagesController::class, 'edit'])->name('dashboard.pages.edit');
    Route::post('dashboard/pages/edit/{id}', [PagesController::class, 'store'])->name('dashboard.pages.edit.post');
    Route::get('dashboard/pages/view/{id}', [PagesController::class, 'view'])->name('dashboard.pages.view');
    Route::get('dashboard/pages/delete/{id}', [PagesController::class, 'delete'])->name('dashboard.pages.delete');

    Route::get('dashboard/location', [LocationController::class, 'index'])->name('dashboard.location');
    Route::get('dashboard/location/create', [LocationController::class, 'create'])->name('dashboard.location.create');
    Route::get('dashboard/location/edit/{id}', [LocationController::class, 'edit'])->name('dashboard.location.edit');
    Route::post('dashboard/location/edit/{id}', [LocationController::class, 'store'])->name('dashboard.location.edit.post');
    Route::get('dashboard/location/view/{id}', [LocationController::class, 'view'])->name('dashboard.location.view');
    Route::get('dashboard/location/delete/{id}', [LocationController::class, 'delete'])->name('dashboard.location.delete');

    Route::get('dashboard/posts', [PostsController::class, 'index'])->name('dashboard.posts');
    Route::get('dashboard/posts/create', [PostsController::class, 'create'])->name('dashboard.posts.create');
    Route::get('dashboard/posts/edit/{id}', [PostsController::class, 'edit'])->name('dashboard.posts.edit');
    Route::post('dashboard/posts/edit/{id}', [PostsController::class, 'store'])->name('dashboard.posts.edit.post');
    Route::get('dashboard/posts/view/{id}', [PostsController::class, 'view'])->name('dashboard.posts.view');
    Route::get('dashboard/posts/delete/{id}', [PostsController::class, 'delete'])->name('dashboard.posts.delete');

    Route::get('dashboard/blog-category', [BlogCategoryController::class, 'index'])->name('dashboard.blog.category');
    Route::get('dashboard/blog-category/create', [BlogCategoryController::class, 'create'])->name('dashboard.blog.category.create');
    Route::get('dashboard/blog-category/edit/{id}', [BlogCategoryController::class, 'edit'])->name('dashboard.blog.category.edit');
    Route::post('dashboard/blog-category/edit/{id}', [BlogCategoryController::class, 'store'])->name('dashboard.blog.category.edit.post');
    Route::get('dashboard/blog-category/view/{id}', [BlogCategoryController::class, 'view'])->name('dashboard.blog.category.view');
    Route::get('dashboard/blog-category/delete/{id}', [BlogCategoryController::class, 'delete'])->name('dashboard.blog.category.delete');

    Route::get('dashboard/board', [BoardController::class, 'index'])->name('dashboard.board');
    Route::get('dashboard/board/create', [BoardController::class, 'create'])->name('dashboard.board.create');
    Route::get('dashboard/board/edit/{id}', [BoardController::class, 'edit'])->name('dashboard.board.edit');
    Route::post('dashboard/board/edit/{id}', [BoardController::class, 'store'])->name('dashboard.board.edit.post');
    Route::get('dashboard/board/delete/{id}', [BoardController::class, 'delete'])->name('dashboard.board.delete');
    Route::get('dashboard/board/{id}', [BoardController::class, 'view'])->name('dashboard.board.items');
    Route::get('dashboard/board/add-item/{id}', [BoardController::class, 'view'])->name('dashboard.board.items.add');
    Route::post('dashboard/work-item/edit', [BoardItemController::class, 'updateItem'])->name('dashboard.work_item.edit.post');

    Route::get('dashboard/member', [MemberController::class, 'index'])->name('dashboard.member');
    Route::get('dashboard/member/import', [MemberController::class, 'import'])->name('dashboard.member.import');
    Route::post('dashboard/member/import', [MemberController::class, 'import_file'])->name('dashboard.member.import.post');
    Route::post('dashboard/member/add', [MemberController::class, 'store'])->name('dashboard.member.add');  

    Route::get('dashboard/user', [UserController::class, 'index'])->name('dashboard.user');
    Route::post('dashboard/user/create', [UserController::class, 'store'])->name('dashboard.user.create');
    Route::get('dashboard/user/edit/{id}', [UserController::class, 'edit'])->name('dashboard.user.edit');
    Route::post('dashboard/user/edit/{id}', [UserController::class, 'store'])->name('dashboard.user.edit.post');
    Route::get('dashboard/user/view/{id}', [UserController::class, 'view'])->name('dashboard.user.view');
    Route::post('dashboard/user/access/{id}', [UserController::class, 'access'])->name('dashboard.user.access');
    Route::get('dashboard/user/delete/{id}', [UserController::class, 'delete'])->name('dashboard.user.delete');

    Route::get('dashboard/webpage', [WebpageController::class, 'index'])->name('dashboard.webpage');
    Route::post('dashboard/webpage/create', [WebpageController::class, 'store'])->name('dashboard.webpage.create');
    Route::get('dashboard/webpage/delete/{id}', [WebpageController::class, 'delete'])->name('dashboard.webpage.delete');
    Route::get('dashboard/webpage/restore/{id}', [WebpageController::class, 'restore'])->name('dashboard.webpage.restore');
    Route::get('dashboard/webpage/edit/{id}/{section?}', [WebpageController::class, 'edit'])->name('dashboard.webpage.edit');
    //Route::post('dashboard/webpage/section-edit/{id}', [WebpageController::class, 'store_edit'])->name('dashboard.webpage.edit.section.post');
    Route::get('dashboard/webpage/delete-sub/{id}/{section}/{sub_id}', [WebpageController::class, 'delete_main'])->name('dashboard.webpage.delete.main');
    Route::post('dashboard/webpage/edit/{id}', [WebpageController::class, 'store_edit'])->name('dashboard.webpage.edit.post');
    Route::get('dashboard/webpage/refresh/{id}', [WebpageController::class, 'refresh'])->name('dashboard.webpage.refresh');

    Route::get('dashboard/social-media', [SocialMediaController::class, 'index'])->name('dashboard.social');
    Route::get('dashboard/social-media/view/{id}', [SocialMediaController::class, 'view'])->name('dashboard.social.view');
    Route::get('dashboard/social-media/detail/{id}', [SocialMediaController::class, 'detail'])->name('dashboard.social.detail');
    Route::get('dashboard/social-media/delete/{id}', [SocialMediaController::class, 'delete'])->name('dashboard.social.delete');
    Route::get('dashboard/social-media/restore/{id}', [SocialMediaController::class, 'restore'])->name('dashboard.social.restore');
    Route::get('dashboard/social-media/edit/{id}/{section?}', [SocialMediaController::class, 'edit'])->name('dashboard.social.edit');
    Route::get('instagram/handle-login-callback', [SocialMediaController::class, 'handleInstagramAfterLoginCallback'])->name('instagram.login.callback');
});

Route::post('login', [LoginController::class, 'login'])->name('login.post');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('contact-us', [FormController::class, 'store'])->name('form.contact.post');
Route::get('google/redirect', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');
Route::get('instagram/handle-callback', [InstagramController::class, 'handleInstagramCallback'])->name('instagram.callback');
Route::post('instagram/handle-callback', [InstagramController::class, 'handleInstagramCallbackPost'])->name('instagram.callback.post');
Route::get('instagram/handle-deauthorize-callback', [InstagramController::class, 'handleInstagramDeauthorizeCallback'])->name('instagram.deauthorize.callback');
Route::get('instagram/handle-deletion-callback', [InstagramController::class, 'handleInstagramDeletionCallback'])->name('instagram.deletion.callback');