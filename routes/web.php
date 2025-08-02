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
use App\Http\Controllers\Dashboard\TemplateController;
use App\Http\Controllers\Dashboard\SocialMediaController;
use App\Http\Controllers\Dashboard\WebpageController;
use App\Http\Controllers\Dashboard\WebpageAnalyticsController;
use App\Http\Controllers\Dashboard\CardsController;
use App\Http\Controllers\Dashboard\CardsCategoryController;

use App\Http\Middleware\CheckIfLogin;
use App\Http\Middleware\CheckLanguage;

use App\Http\Controllers\Pages\BlogController as PublicBlogController;
use App\Http\Controllers\Pages\PublicImageController;
use App\Http\Controllers\Pages\CoolImageController;
use App\Http\Controllers\Pages\PagesController as PublicPagesController;
use App\Http\Controllers\Pages\FormController;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Pages\CitiesController;
use App\Http\Controllers\Pages\NewsController;
use App\Http\Controllers\Pages\CardsController as PublicCardsController;
use App\Http\Controllers\Pages\ResumeBuilderController;
use App\Http\Controllers\Pages\ResumeController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\Auth\InstagramController;

use App\Http\Controllers\Api\V1\BlogController as ApiBlogController;
use App\Http\Controllers\Pages\GujjuMeController;

Route::middleware([CheckLanguage::class])->group(function () {
    Route::get('/', [HomeController::class, 'show'])->name('home');    
    Route::get('login', [LoginController::class, 'authenticate'])->name('login');
    Route::get('contact-us', [FormController::class, 'show'])->name('form.contact');
    Route::get('blogs', [PublicBlogController::class, 'index'])->name('pages.blog.list');
    Route::get('blog-on-{slug}', [PublicBlogController::class, 'category'])->name('pages.blog.category.detail');
    Route::get('blog/{slug}', [PublicBlogController::class, 'view'])->name('pages.blog.detail');

    Route::get('cards', [PublicCardsController::class, 'index'])->name('pages.card.list');
    Route::get('cards/{slug}', [PublicCardsController::class, 'category'])->name('pages.card.category.detail');
    Route::get('card/{slug}', [PublicCardsController::class, 'view'])->name('pages.card.detail');

    Route::get('news', [NewsController::class, 'index'])->name('pages.news.list');
    Route::get('news/{slug}', [NewsController::class, 'view'])->name('pages.news.detail');

    Route::get('cities', [CitiesController::class, 'index'])->name('pages.cities.list');
    Route::get('city/generate-image', [CitiesController::class, 'generate']);
    Route::get('city/{slug}', [CitiesController::class, 'view'])->name('pages.cities.detail');
    Route::get('city/{slug}/{category}', [CitiesController::class, 'category_businesses_list'])->name('pages.cities.businesses.list');

    Route::get('image-editor/{slug}', [PublicImageController::class, 'try'])->name('pages.image.editor.detail');
    Route::get('image/{slug}', [PublicImageController::class, 'view'])->name('pages.image.detail');
    Route::get('cool-image/{slug}', [CoolImageController::class, 'view'])->name('pages.image.cool');
    Route::get('news-image/{slug}', [CoolImageController::class, 'news'])->name('pages.image.news');
    Route::get('city-business-category-image/{slug}', [CoolImageController::class, 'category'])->name('pages.image.category');

    // Route::get('gujarat', [GujaratController::class, 'index'])->name('pages.gujarat');
    // Route::get('gujarat/{slug}', [GujaratController::class, 'district'])->name('pages.gujarat.district');

    Route::get('p/{slug}', [PublicPagesController::class, 'view'])->name('p.pages');

    Route::get('resume-builder', [ResumeController::class, 'index'])->name('pages.resume.list');
    Route::post('resume-builder', [ResumeController::class, 'post'])->name('pages.resume.post');
    Route::get('resume-builder/{token}', [ResumeController::class, 'builder'])->name('pages.resume.builder');
    Route::post('resume-builder/{token}', [ResumeController::class, 'process'])->name('pages.resume.builder.post');
    Route::get('generate-resume/{token}', [ResumeBuilderController::class, 'generate'])->name('pages.resume.builder.generate');

    Route::get('link-page-builder', [GujjuMeController::class, 'index'])->name('pages.link.index');
    Route::post('link-page-builder', [GujjuMeController::class, 'post'])->name('pages.link.post');
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
    Route::get('dashboard/image/data/{id}', [ImageController::class, 'data'])->name('dashboard.image.data');
    Route::get('dashboard/image/data/create/{id}', [ImageController::class, 'createData'])->name('dashboard.image.data.create');
    Route::get('dashboard/image/delete/{id}', [ImageController::class, 'delete'])->name('dashboard.image.delete');
    Route::get('dashboard/image/data/delete/{id}/{image_id}', [ImageController::class, 'deleteData'])->name('dashboard.image.data.delete');
    Route::get('dashboard/image/data/edit/{id}/{image_id}', [ImageController::class, 'editData'])->name('dashboard.image.data.edit');
    Route::post('dashboard/image/data/edit/{id}/{image_id}', [ImageController::class, 'storeData'])->name('dashboard.image.data.edit.post');
    Route::get('dashboard/image/copy/{id}', [ImageController::class, 'copy'])->name('dashboard.image.copy');

    Route::get('dashboard/blog', [BlogController::class, 'index'])->name('dashboard.blog');
    Route::get('dashboard/blog/create', [BlogController::class, 'create'])->name('dashboard.blog.create');
    Route::get('dashboard/blog/edit/{id}', [BlogController::class, 'edit'])->name('dashboard.blog.edit');
    Route::post('dashboard/blog/edit/{id}', [BlogController::class, 'store'])->name('dashboard.blog.edit.post');
    Route::get('dashboard/blog/view/{id}', [BlogController::class, 'view'])->name('dashboard.blog.view');
    Route::get('dashboard/blog/delete/{id}', [BlogController::class, 'delete'])->name('dashboard.blog.delete');
    Route::get('dashboard/blog/restore/{id}', [BlogController::class, 'restore'])->name('dashboard.blog.restore');

    Route::get('dashboard/card', [CardsController::class, 'index'])->name('dashboard.card');
    Route::get('dashboard/card/create', [CardsController::class, 'create'])->name('dashboard.card.create');
    Route::get('dashboard/card/edit/{id}', [CardsController::class, 'edit'])->name('dashboard.card.edit');
    Route::post('dashboard/card/edit/{id}', [CardsController::class, 'store'])->name('dashboard.card.edit.post');
    Route::get('dashboard/card/delete/{id}', [CardsController::class, 'delete'])->name('dashboard.card.delete');
    Route::get('dashboard/card/restore/{id}', [CardsController::class, 'restore'])->name('dashboard.card.restore');

    Route::get('dashboard/card-order', [CardsController::class, 'test'])->name('dashboard.card.order');

    Route::get('dashboard/card-category', [CardsCategoryController::class, 'index'])->name('dashboard.card.category');
    Route::get('dashboard/card-category/create', [CardsCategoryController::class, 'create'])->name('dashboard.card.category.create');
    Route::get('dashboard/card-category/edit/{id}', [CardsCategoryController::class, 'edit'])->name('dashboard.card.category.edit');
    Route::post('dashboard/card-category/edit/{id}', [CardsCategoryController::class, 'store'])->name('dashboard.card.category.edit.post');
    Route::get('dashboard/card-category/delete/{id}', [CardsCategoryController::class, 'delete'])->name('dashboard.card.category.delete');
    Route::get('dashboard/card-category/restore/{id}', [CardsCategoryController::class, 'restore'])->name('dashboard.card.category.restore');

    Route::get('dashboard/pages', [PagesController::class, 'index'])->name('dashboard.pages');
    Route::get('dashboard/pages/create', [PagesController::class, 'create'])->name('dashboard.pages.create');
    Route::get('dashboard/pages/edit/{id}', [PagesController::class, 'edit'])->name('dashboard.pages.edit');
    Route::post('dashboard/pages/edit/{id}', [PagesController::class, 'store'])->name('dashboard.pages.edit.post');
    Route::get('dashboard/pages/view/{id}', [PagesController::class, 'view'])->name('dashboard.pages.view');
    Route::get('dashboard/pages/delete/{id}', [PagesController::class, 'delete'])->name('dashboard.pages.delete');

    Route::get('dashboard/template', [TemplateController::class, 'index'])->name('dashboard.template');
    Route::get('dashboard/template/create', [TemplateController::class, 'create'])->name('dashboard.template.create');
    Route::get('dashboard/template/edit/{id}', [TemplateController::class, 'edit'])->name('dashboard.template.edit');
    Route::post('dashboard/template/edit/{id}', [TemplateController::class, 'store'])->name('dashboard.template.edit.post');
    Route::get('dashboard/template/view/{id}', [TemplateController::class, 'view'])->name('dashboard.template.view');
    Route::get('dashboard/template/delete/{id}', [TemplateController::class, 'delete'])->name('dashboard.template.delete');
    Route::get('dashboard/template/form/{id}', [TemplateController::class, 'form'])->name('dashboard.template.form');
    Route::post('dashboard/template/form/{id}', [TemplateController::class, 'store_form'])->name('dashboard.template.form.post');
    Route::get('dashboard/template/generated/{id}', [TemplateController::class, 'generatedPages'])->name('dashboard.template.generated');

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
    Route::get('dashboard/webpage/analytics/{id}', [WebpageAnalyticsController::class, 'index'])->name('dashboard.webpage.analytics');
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


Route::prefix('api/v1')->group(function () {
    Route::apiResource('blog', ApiBlogController::class);
});
