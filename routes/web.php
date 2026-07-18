<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\NotificationController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\ImageController;
use App\Http\Controllers\Dashboard\BlogController;
use App\Http\Controllers\Dashboard\BlogCategoryController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\DashboardoController;
use App\Http\Controllers\Dashboard\PostsController;
use App\Http\Controllers\Dashboard\LocationController;
use App\Http\Controllers\Dashboard\BusinessController as DashboardBusinessController;
use App\Http\Controllers\Dashboard\PagesController;
use App\Http\Controllers\Dashboard\TemplateController;
use App\Http\Controllers\Dashboard\SocialMediaController;
use App\Http\Middleware\CheckIfLogin;
use App\Http\Middleware\CheckLanguage;

use App\Http\Controllers\Pages\BlogController as PublicBlogController;
use App\Http\Controllers\Pages\PublicImageController;
use App\Http\Controllers\Pages\CoolImageController;
use App\Http\Controllers\Pages\PagesController as PublicPagesController;
use App\Http\Controllers\Pages\FormController;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Pages\MarketingController;
use App\Http\Controllers\Pages\CitiesController;
use App\Http\Controllers\Pages\NewsController;
use App\Http\Controllers\Pages\AiPromptsController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\Auth\InstagramController;

use App\Http\Controllers\Api\V1\BlogController as ApiBlogController;
use App\Http\Controllers\Dashboard\PostSetController as DashboardPostSetController;
use App\Http\Controllers\Pages\BusinessController;
use App\Http\Controllers\Pages\PostSetController;
use App\Http\Controllers\RssFeedController;

if (app()->environment('local')) {
    Route::get('dev/errors', function () {
        return response()->view('errors.preview-index');
    })->name('dev.errors');

    Route::get('dev/errors/{code}', function (string $code) {
        $allowed = ['403', '404', '419', '429', '500', '503'];
        abort_unless(in_array($code, $allowed, true), 404);

        return response()->view('errors.' . $code, [], (int) $code);
    })->where('code', '403|404|419|429|500|503')->name('dev.errors.show');
}

Route::middleware([CheckLanguage::class])->group(function () {
    Route::get('/', [HomeController::class, 'show'])->name('home');    
    Route::get('login', [LoginController::class, 'authenticate'])->name('login');
    Route::get('contact-us', [FormController::class, 'show'])->name('form.contact');

    Route::get('services', [MarketingController::class, 'servicesHub'])->name('pages.services');
    Route::get('services/{slug}', [MarketingController::class, 'servicesShow'])->name('pages.services.show');
    Route::get('technology', [MarketingController::class, 'technologyHub'])->name('pages.technology');
    Route::get('technology/{slug}', [MarketingController::class, 'technologyShow'])->name('pages.technology.show');
    Route::get('capabilities', fn () => redirect()->route('pages.services', [], 301));
    Route::get('capabilities/{slug}', function (string $slug) {
        $map = [
            'mvp-development' => 'mvp-development',
            'admin-dashboards' => 'admin-dashboards',
            'business-websites' => 'websites',
            'system-integrations' => 'system-integrations',
            'product-redesign' => 'product-redesign',
        ];

        if (isset($map[$slug])) {
            return redirect()->route('pages.services.show', ['slug' => $map[$slug]], 301);
        }

        return redirect()->route('pages.services', [], 301);
    });
    Route::get('about', [MarketingController::class, 'about'])->name('pages.about');
    Route::get('how-we-work', [MarketingController::class, 'howWeWork'])->name('pages.how-we-work');
    Route::get('industries', [MarketingController::class, 'industries'])->name('pages.industries');
    Route::get('industries/{slug}', [MarketingController::class, 'industriesShow'])->name('pages.industries.show');
    Route::get('engagements', fn () => redirect()->route('pages.services', [], 301));
    Route::get('faq', [MarketingController::class, 'faq'])->name('pages.faq');
    Route::get('careers', [MarketingController::class, 'careers'])->name('pages.careers');
    Route::get('work', [MarketingController::class, 'workHub'])->name('pages.work');
    Route::get('work/{slug}', [MarketingController::class, 'workShow'])->name('pages.work.show');

    Route::get('blogs', [PublicBlogController::class, 'index'])->name('pages.blog.list');
    Route::get('blog-on-{slug}', [PublicBlogController::class, 'category'])->name('pages.blog.category.detail');
    Route::get('blog/{slug}', [PublicBlogController::class, 'view'])->name('pages.blog.detail');

    Route::get('news', [NewsController::class, 'index'])->name('pages.news.list');
    Route::get('news/{slug}', [NewsController::class, 'view'])->name('pages.news.detail');

    Route::get('cities', [CitiesController::class, 'index'])->name('pages.cities.list');
    Route::get('ai-prompts', [AiPromptsController::class, 'index'])->name('pages.ai_prompts.list');
    Route::get('ai-prompts/{slug}', [AiPromptsController::class, 'category'])->name('pages.ai_prompts.category');
    Route::get('ai-prompt/{slug}', [AiPromptsController::class, 'show'])->name('pages.ai_prompts.detail');
    Route::post('ai-prompts/copy/{uniqueId}', [AiPromptsController::class, 'copy'])->name('pages.ai_prompts.copy');
    Route::post('ai-prompt/{slug}/comment', [AiPromptsController::class, 'storeComment'])->name('pages.ai_prompts.comment.store');
    Route::get('city/generate-image', [CitiesController::class, 'generate']);
    Route::get('city/{slug}', [CitiesController::class, 'view'])->name('pages.cities.detail');
    Route::get('city/{slug}/{category}', [CitiesController::class, 'category_businesses_list'])->name('pages.cities.businesses.list');

    Route::get('image-editor/{slug}', [PublicImageController::class, 'try'])->name('pages.image.editor.detail');
    Route::post('image-editor/{slug}', [PublicImageController::class, 'store'])->name('pages.image.editor.post');
    Route::get('image/{slug}', [PublicImageController::class, 'view'])->name('pages.image.detail');

    Route::get('cool-image/{slug}', [CoolImageController::class, 'view'])->name('pages.image.cool');
    Route::get('news-image/{slug}', [CoolImageController::class, 'news'])->name('pages.image.news');
    Route::get('city-business-category-image/{slug}', [CoolImageController::class, 'category'])->name('pages.image.category');
    Route::get('post-image/{slug}', [CoolImageController::class, 'postset'])->name('pages.image.postset');
    Route::get('post-main/{slug}', [CoolImageController::class, 'postmain'])->name('pages.image.postmain');

    // Route::get('gujarat', [GujaratController::class, 'index'])->name('pages.gujarat');
    // Route::get('gujarat/{slug}', [GujaratController::class, 'district'])->name('pages.gujarat.district');

    Route::get('p/{slug}', [PublicPagesController::class, 'view'])->name('p.pages');

    // Resume Builder removed — soft-deprecate with redirects (route names kept for legacy links)
    Route::get('resume-builder', fn () => redirect()->route('form.contact', [], 301))->name('pages.resume.list');
    Route::post('resume-builder', fn () => redirect()->route('form.contact', [], 301))->name('pages.resume.post');
    Route::get('resume-builder/{token}', fn () => redirect()->route('form.contact', [], 301))->name('pages.resume.builder');
    Route::post('resume-builder/{token}', fn () => redirect()->route('form.contact', [], 301))->name('pages.resume.builder.post');
    Route::get('generate-resume/{token}', fn () => redirect()->route('form.contact', [], 301))->name('pages.resume.builder.generate');

    Route::get('news-post', [PostSetController::class, 'index'])->name('pages.postset.list');
    Route::post('news-post', [PostSetController::class, 'post'])->name('pages.postset.post');
    Route::post('news-post/add-business', [PostSetController::class, 'add'])->name('pages.postset.business.add');
    Route::get('news-post/{slug}', [PostSetController::class, 'generator'])->name('pages.postset.post.generator');

    Route::get('business', [BusinessController::class, 'business'])->name('pages.business');
    Route::get('business/add', [BusinessController::class, 'add'])->name('pages.business.add');
    Route::post('business/add', [BusinessController::class, 'store'])->name('pages.business.store');
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

Route::get('rss/{slug}', [RssFeedController::class, 'view'])->name('rss.feed');

Route::middleware([CheckIfLogin::class, CheckLanguage::class])->group(function () {
    Route::get('dashboard', [DashboardoController::class, 'index'])->name('dashboard');

    Route::get('dashboard/notification', [NotificationController::class, 'index'])->name('dashboard.notification');
    Route::get('dashboard/notification/action/{action}', [NotificationController::class, 'action'])->name('dashboard.notification.action');

    Route::get('dashboard/profile', [ProfileController::class, 'show'])->name('dashboard.profile');
    Route::get('dashboard/profile/edit', [ProfileController::class, 'index'])->name('dashboard.profile.edit');
    Route::post('dashboard/profile/edit', [ProfileController::class, 'store'])->name('dashboard.profile.edit.post');

    Route::get('dashboard/contact', [ContactController::class, 'index'])->name('dashboard.contact');

    Route::get('dashboard/business', [DashboardBusinessController::class, 'index'])->name('dashboard.business');
    Route::get('dashboard/business/view/{id}', [DashboardBusinessController::class, 'view'])->name('dashboard.business.view');
    Route::get('dashboard/business/approve/{id}', [DashboardBusinessController::class, 'approve'])->name('dashboard.business.approve');
    Route::get('dashboard/business/reject/{id}', [DashboardBusinessController::class, 'reject'])->name('dashboard.business.reject');
    
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

    Route::get('dashboard/postset', [DashboardPostSetController::class, 'index'])->name('dashboard.postset');
    Route::get('dashboard/postset/create', [DashboardPostSetController::class, 'create'])->name('dashboard.postset.create');
    Route::post('dashboard/postset/create', [DashboardPostSetController::class, 'smallStore'])->name('dashboard.postset.add.post');  
    Route::get('dashboard/postset/edit/{id}', [DashboardPostSetController::class, 'edit'])->name('dashboard.postset.edit');
    Route::get('dashboard/postset/publish/{id}', [DashboardPostSetController::class, 'publish'])->name('dashboard.postset.publish');
    Route::post('dashboard/postset/edit/{id}', [DashboardPostSetController::class, 'store'])->name('dashboard.postset.edit.post');
    Route::get('dashboard/postset/list/{id}', [DashboardPostSetController::class, 'list'])->name('dashboard.postset.list');
    Route::get('dashboard/postset/delete/{id}', [DashboardPostSetController::class, 'delete'])->name('dashboard.postset.delete');
    Route::get('dashboard/postset/restore/{id}', [DashboardPostSetController::class, 'restore'])->name('dashboard.postset.restore');

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

    Route::get('dashboard/user', [UserController::class, 'index'])->name('dashboard.user');
    Route::post('dashboard/user/create', [UserController::class, 'store'])->name('dashboard.user.create');
    Route::get('dashboard/user/edit/{id}', [UserController::class, 'edit'])->name('dashboard.user.edit');
    Route::post('dashboard/user/edit/{id}', [UserController::class, 'store'])->name('dashboard.user.edit.post');
    Route::get('dashboard/user/view/{id}', [UserController::class, 'view'])->name('dashboard.user.view');
    Route::post('dashboard/user/access/{id}', [UserController::class, 'access'])->name('dashboard.user.access');
    Route::get('dashboard/user/delete/{id}', [UserController::class, 'delete'])->name('dashboard.user.delete');

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
