<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BannerImageController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//routes for admin
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.post-login');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->name('admin.')->middleware("auth:admin")->group(function() {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('profile', [ProfileController::class, 'index'])->name('profile.show');

    Route::get('product-category/get-all', [ProductCategoryController::class, 'getAllCategories'])->name('product-category.get-all');
    Route::put('product-category/{id}/toggle-status-or-featured', [ProductCategoryController::class, 'updateStatusOrFeatured'])->name('brand.update-status-or-featured');
    Route::resource('/product-category', ProductCategoryController::class);

    Route::get('brand/get-all', [BrandController::class, 'getAllBrands'])->name('brand.get-all');
    Route::put('brand/{id}/toggle-is_featured', [BrandController::class, 'updateIsFeatured'])->name('brand.update-is_featured');
    Route::resource('/brand', BrandController::class);

    Route::get('product/get-all', [ProductController::class, 'getAllProducts'])->name('product.get-all');
    Route::resource('/product', ProductController::class);

    Route::get('page/get-all', [PageController::class, 'getAllPages'])->name('page.get-all');
    Route::resource('/page', PageController::class);

    Route::get('banner/get-all', [BannerController::class, 'getAllBanners'])->name('banner.get-all');
    Route::resource('/banner', BannerController::class);

    Route::post('banner/{banner_id}/banner-image', [BannerImageController::class, 'store'])->name('banner.banner-image.store');
    Route::delete('banner/{banner_id}/banner-image/{banner_image_id}', [BannerImageController::class, 'destroy'])->name('banner.banner-image.delete');

});

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
