<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Backend\AdminAuthController;
use Illuminate\Support\Facades\App;

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

// Guest Routes
Route::get('lang/{lang}', function ($lang) {
    App::setLocale($lang);
    session()->put('locale', $lang);
    return redirect()->back();
});
Route::get("/", [PageController::class, "home"])->name("page.home");
Route::get("/shop", [PageController::class, "shop"])->name("page.shop");
Route::get("/category/{category}", [PageController::class, "category"])->name("page.category");
Route::get("/product/{product}", [PageController::class, "detail"])->name("page.detail");
Route::get("/flashsale", [PageController::class, "flashsale"])->name("page.flashsale");
Route::get("/contact", [PageController::class, "contact"])->name("page.contact");

Route::prefix('dashboard')->group(function () {
    Route::get("/login", [AdminAuthController::class, "loginView"])->name("admin.login");
    Route::post("/login", [AdminAuthController::class, "login"]);
});
