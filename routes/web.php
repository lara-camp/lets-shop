<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\Category\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Mail\MailController;
use App\Http\Controllers\Backend\Page\HotSlideController;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Shared\OAuthController;
use Inertia\Inertia;
use App\Http\Controllers\Backend\Product\ProductController;
use App\Http\Controllers\Backend\Product\DetailController;
use App\Http\Controllers\Backend\Product\ProductImageController;
use App\Http\Controllers\Backend\Product\ProductDetailController;
use App\Http\Controllers\Backend\AdminChatController;
use App\Http\Controllers\Backend\Page\BannerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Language Route
Route::get('lang/{lang}', function ($lang) {
    App::setLocale($lang);
    session()->put('locale', $lang);

    return redirect()->back();
});

// OAuth Routes
Route::get("/oauth2/google", [OAuthController::class, 'redirectToGoogle'])->name('oauth.google');
Route::get("/oauth2/google/callback", [OAuthController::class, 'handleGoogleCallback'])
    ->name('oauth.google.callback');

Route::get("/test", function () {
    return Inertia::render("Test");
});

// Guest Routes
Route::get("/", [PageController::class, "home"])->name("page.home");
Route::get("/details/{product:slug}", [PageController::class, 'detail'])->name('page.detail');
Route::get("/shop", [PageController::class, "shop"])->name("page.shop");
Route::get("/category/{category}", [PageController::class, "category"])->name("page.category");
Route::get("/product/{product}", [PageController::class, "detail"])->name("page.detail");
Route::get("/flashsale", [PageController::class, "flashsale"])->name("page.flashsale");
Route::get("/contact", [PageController::class, "contact"])->name("page.contact");


// Admin Routes
Route::get("dashboard/login", [AuthController::class, "loginView"])->name("admin.loginView");
Route::post("/dashboard/login", [AuthController::class, "login"])->name('admin.login');

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'isAdmin']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Product Routes
    Route::resource('products', ProductController::class)->except('update');
    Route::post('products/{product}', [ProductController::class, 'updateProduct'])
        ->name('products.update');
    Route::delete('product-details/{productDetail}', [ProductDetailController::class, 'destroy'])
        ->name('product-detail.destroy');
    Route::resource('product-images', ProductImageController::class);
    Route::resource('details', DetailController::class);

    // Category Routes
    Route::resource('categories', CategoryController::class)->except('create', 'edit');
    Route::delete('category/image/{id}', [CategoryController::class, 'destroyImage'])
        ->name('categoryImage.destroy');

    // Chat Routes
    Route::get('chat', [AdminChatController::class, 'view'])->name('admin-chat.view');
    Route::resource('categories', CategoryController::class)->except('show', 'create');
    Route::resource('hot-slide', HotSlideController::class);
    Route::post('hotslide/{id}', [HotSlideController::class, 'customUpdate'])->name('hotslide.update');
    Route::post('hotslide-isShow/{id}', [HotSlideController::class, 'isShow'])->name('hotSlide.isShow');
    Route::resource('banner', BannerController::class);
    Route::controller(MailController::class)->name('mail.')->group(function () {
        Route::get('/mail', 'index')->name('index');
        Route::post('/mail', 'store')->name('store');
        Route::post('/sub-mail', 'sendSub')->name('sendSub');
    });
});
