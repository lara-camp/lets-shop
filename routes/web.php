<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Backend\AuthController;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Shared\OAuthController;

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
   return \Inertia\Inertia::render("Test");
});

// Guest Routes
Route::get("/", [PageController::class, "home"])->name("page.home");
Route::get("/shop", [PageController::class, "shop"])->name("page.shop");
Route::get("/category/{category}", [PageController::class, "category"])->name("page.category");
Route::get("/product/{product}", [PageController::class, "detail"])->name("page.detail");
Route::get("/flashsale", [PageController::class, "flashsale"])->name("page.flashsale");
Route::get("/contact", [PageController::class, "contact"])->name("page.contact");


// Admin Routes
Route::prefix('dashboard')->group(function () {
    Route::get("/login", [AuthController::class, "loginView"])->name("admin.login");
    Route::post("/login", [AuthController::class, "login"]);
});
