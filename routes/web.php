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
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Website\Api\CartController;
use App\Http\Controllers\Website\Api\OrderController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\ProductDetailController;
use App\Http\Controllers\Website\RatingReviewController;
use App\Http\Controllers\Website\Api\ShopController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


//routes for admin
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.post-login');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->name('admin.')->middleware("auth:admin")->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('profile', [ProfileController::class, 'index'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

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

    Route::get('review', [ReviewController::class, 'index'])->name('review.index');
    Route::put('review/{id}/toggle-status', [ReviewController::class, 'updateStatus'])->name('review.update-status');
    Route::get('review/get-all', [ReviewController::class, 'getAllReviews'])->name('review.get-all');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Website Routes
Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('website.home');

Route::prefix('product')->group(function () {

    Route::get('{product:slug}/', [ProductDetailController::class, 'index'])->name('product.detail');

    Route::get('{product_id}/user-review', [RatingReviewController::class, 'checkIfReviewExists'])->middleware('auth:web');

    Route::resource('{product_id}/review', RatingReviewController::class)->middleware('auth:web');

    Route::post('/add-to-cart', [CartController::class, 'addToCart']);
});

Route::prefix('shop')->group(function () {

    Route::view('/', 'website/pages/shop');

    Route::get('get-categories', [ShopController::class, 'getCategories'])->name('shop.categories');

    Route::get('get-products', [ShopController::class, 'getProducts']);

    Route::view('cart', 'website/pages/cart');

    Route::get('cart-items', [CartController::class, 'getCartItems']);

    Route::delete('cart-item/{id}', [CartController::class, 'removeFromCart']);

    Route::view('checkout', 'website/pages/checkout')->middleware('auth:web');
});

Route::prefix('checkout')->group(function () {

    Route::post('/', [OrderController::class, 'store'])->middleware('auth:web')->name('checkout.store');

});
