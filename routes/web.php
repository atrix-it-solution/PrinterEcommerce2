<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\dashboardSettings\SettingsController;
use App\Http\Controllers\media\MediaController;

use App\Http\Controllers\Product\ProductCategoryController;
use App\Http\Controllers\Product\ProductController;

use App\Http\Controllers\Blog\BlogCategoryController;
use App\Http\Controllers\Blog\BlogController;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\MyAccountController;

use App\Http\Controllers\authentications\LoginController;
use App\Http\Controllers\authentications\RegisterController;
use App\Http\Controllers\authentications\LoginRegisterController;

use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

// Category routes
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');


// Authentication Routes - ADD THESE GET ROUTES
Route::get('/login-register', [LoginRegisterController::class, 'index'])->name('login.register');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/shop', [ShopController::class, 'index'])->name('shop');

// Cart Routes
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/cart/count', [CartController::class, 'getCartData'])->name('cart.data');

// Wishlist Routes
Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
Route::post('/wishlist/remove', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');
Route::post('/wishlist/toggle', [WishlistController::class, 'toggleWishlist'])->name('wishlist.toggle');
Route::get('/wishlist', [WishlistController::class, 'viewWishlist'])->name('wishlist.view');
Route::get('/wishlist/count', [WishlistController::class, 'getWishlistData'])->name('wishlist.data');
Route::post('/wishlist/check', [WishlistController::class, 'checkWishlist'])->name('wishlist.check');


Route::get('/blog', [BlogController::class, 'frontendIndex'])->name('frontend.blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'frontendShow'])->name('frontend.blog.single');

Route::get('/about', function () {
    return view('pages.frontend.about');
});

Route::get('/portfolio', function () {
    return view('pages.frontend.portfolio');
});
Route::get('/portfolio-details', function () {
    return view('pages.frontend.portfolio-details');
});
Route::get('/team', function () {
    return view('pages.frontend.team');
});
Route::get('pricing', function () {
    return view('pages.frontend.pricing');
});
Route::get('testimonials', function () {
    return view('pages.frontend.testimonials');
});
Route::get('terms', function () {
    return view('pages.frontend.terms');
});
Route::get('privacy-policy', function () {
    return view('pages.frontend.privacy-policy');
});
Route::get('terms-and-conditions', function () {
    return view('pages.frontend.terms-and-conditions');
});

Route::get('contact', function () {
    return view('pages.frontend.contact');
});
Route::get('edit-account', function () {
    return view('pages.frontend.edit-account');
});
Route::get('edit-address', function () {
    return view('pages.frontend.edit-address');
});
Route::get('faq', function () {
    return view('pages.frontend.faq');
});
Route::get('forgot-password', function () {
    return view('pages.frontend.forgot-password');
});

Route::get('privacy-policy', function () {
    return view('pages.frontend.privacy-policy');
});
Route::get('terms-and-conditions', function () {
    return view('pages.frontend.terms-and-conditions');
});
Route::get('view-order', function () {
    return view('pages.frontend.view-order');
});

Route::get('billing-address', function () {
    return view('pages.frontend.billing-address');
});
Route::get('shipping-address', function () {
    return view('pages.frontend.shipping-address');
});

Route::get('/login', function () {
    return redirect('/login-register');
});

Route::get('/register', function () {
    return redirect('/login-register');
});
// Dashboard Routes
Route::middleware(['auth', 'admin'])->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/productcategories', ProductCategoryController::class);
    Route::resource('/products', ProductController::class);
    Route::resource('/blogcategories', BlogCategoryController::class);
    Route::resource('/blogs', BlogController::class);
    
    // Settings Routes with more descriptive names
    Route::get('/settings', [SettingsController::class, 'index'])->name('dashboard.settings.index');
    Route::post('/settings/update', [SettingsController::class, 'update'])->name('dashboard.settings.update');
    Route::delete('/settings/remove-image/{type}', [SettingsController::class, 'removeImage'])->name('dashboard.settings.removeImage');
});
// Media API Routes - For the media manager (JSON responses)
Route::prefix('api')->middleware(['auth'])->group(function () {
    Route::get('/media', [MediaController::class, 'getImages'])->name('api.media.getImages');
    Route::post('/media/upload', [MediaController::class, 'store'])->name('api.media.store');
    Route::delete('/media/{media}', [MediaController::class, 'destroy'])->name('api.media.destroy');
});

// Regular media management page routes (HTML responses)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/media', [MediaController::class, 'index'])->name('media.index');
    Route::get('/media/create', [MediaController::class, 'create'])->name('media.create');
    Route::get('/media/{media}/edit', [MediaController::class, 'edit'])->name('media.edit');
    Route::put('/media/{media}', [MediaController::class, 'update'])->name('media.update');
});

