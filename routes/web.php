<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



//======================= Admin Part ===================
Route::group(['prefix' => 'admin'], function(){
    Route::get('/', [App\Http\Controllers\Admin\LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/', [App\Http\Controllers\Admin\LoginController::class, 'login']);
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');

    //========================== Slider Route =================
    Route::resource('/slider', App\Http\Controllers\Admin\SliderController::class);
    Route::get('/slider/active/{id}', [App\Http\Controllers\Admin\SliderController::class, 'Active'])->name('slider.active');
    Route::get('/slider/inactive/{id}', [App\Http\Controllers\Admin\SliderController::class, 'Inactive'])->name('slider.inactive');
    //========================== End Slider Route ==============

    //========================== Brand Route =================
    Route::resource('/brand', App\Http\Controllers\Admin\BrandController::class);
    Route::get('/brand/active/{id}', [App\Http\Controllers\Admin\BrandController::class, 'Active'])->name('brand.active');
    Route::get('/brand/inactive/{id}', [App\Http\Controllers\Admin\BrandController::class, 'Inactive'])->name('brand.inactive');
    //========================== End Brand Route ==============

    //========================== Category Route =================
    Route::resource('/category', App\Http\Controllers\Admin\CategoryController::class);
    Route::get('/category/active/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'Active'])->name('category.active');
    Route::get('/category/inactive/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'Inactive'])->name('category.inactive');
    //========================== End Category Route ==============

    //========================== Subcategory Route ===============
    Route::resource('/subcategory', App\Http\Controllers\Admin\SubcategoryController::class);
    Route::get('/subcategory/active/{id}', [App\Http\Controllers\Admin\SubcategoryController::class, 'Active'])->name('subcategory.active');
    Route::get('/subcategory/inactive/{id}', [App\Http\Controllers\Admin\SubcategoryController::class, 'Inactive'])->name('subcategory.inactive');
    //========================== End Category Route ==============

    //========================== Coupon Route =================
    Route::resource('/coupon', App\Http\Controllers\Admin\CouponController::class);
    Route::get('/coupon/active/{id}', [App\Http\Controllers\Admin\CouponController::class, 'Active'])->name('coupon.active');
    Route::get('/coupon/inactive/{id}', [App\Http\Controllers\Admin\CouponController::class, 'Inactive'])->name('coupon.inactive');
    //========================== End Coupon Route ==============

    //========================== Product Route =================
    Route::resource('/product', App\Http\Controllers\Admin\ProductController::class);
    Route::get('/product/active/{id}', [App\Http\Controllers\Admin\ProductController::class, 'Active'])->name('product.active');
    Route::get('/product/inactive/{id}', [App\Http\Controllers\Admin\ProductController::class, 'Inactive'])->name('product.inactive');
    //========================== End Product Route ==============

});


//====================== Website route =========================
Route::get('/', [App\Http\Controllers\FrontendController::class, 'index'])->name('website');

//======================= All product route ======================
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('allproduct');

//====================== Cart route ============================
Route::post('/cart/add/{id}', [App\Http\Controllers\CartController::class, 'Addcart'])->name('add.cart');
Route::get('/cart', [App\Http\Controllers\CartController::class, 'showCart'])->name('show.cart');
Route::get('/cart/destroy/{id}', [App\Http\Controllers\CartController::class, 'destroyCart'])->name('destroy.cart');
Route::post('/cart/update/{id}', [App\Http\Controllers\CartController::class, 'Updatecart'])->name('update.cart');
Route::post('/coupon', [App\Http\Controllers\CartController::class, 'Applycoupon'])->name('coupon.apply');
Route::get('/coupon/delete', [App\Http\Controllers\CartController::class, 'delete'])->name('coupon.destroy');
//====================== End Cart route ============================

//====================== Start wishlist route ============================
Route::get('/wishlist/add/{id}', [App\Http\Controllers\WishlistController::class, 'Addwishlist'])->name('add.wishlist');
Route::get('/wishlist', [App\Http\Controllers\WishlistController::class, 'showWishlist'])->name('show.wishlist');
Route::get('/wishlist/destroy/{id}', [App\Http\Controllers\WishlistController::class, 'destroyWishlist'])->name('destroy.wishlist');