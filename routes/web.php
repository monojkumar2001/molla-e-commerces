<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\SubSubCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ShopController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Frontend\ProductController as ProductFront;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/clear-cache', function () {
    Artisan::call('route:clear');
    Artisan::call('optimize');
    Artisan::call('config:cache');
    Artisan::call('view:cache');
    return "Cache cleared and optimizations done successfully.";
});



Route::get('admin/login', [AuthController::class, 'login_admin'])->name('admin.login');
Route::post('admin/login', [AuthController::class, 'Auth_login_admin']);
Route::get('admin/logout', [AuthController::class, 'logout_admin'])->name('admin.logout');



Route::namespace('App\Http\Controllers')->group(
    function () {
        Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::get('/get-sub-categories/{category_id}', [ProductController::class, 'getSubCategories'])->name('getSubCategories');
            Route::post('/product_image_sortable', [ProductController::class, 'productImageSortable'])->name('product_image_sortable');
            Route::get('/get-sub-sub-categories/{sub_category_id}', [ProductController::class, 'getSubSubCategories'])->name('getSubSubCategories');
            Route::get('/get-sub-categories/{category_id}', [SubSubCategoryController::class, 'getSubCategories'])->name('getSubCategories');


            Route::resource('/admin_list', 'AdminController');
            Route::resource('/slider', 'SliderController');
            Route::resource('/category', 'CategoryController');
            Route::resource('/sub_category', 'SubCategoryController');
            Route::resource('/sub_sub_category', 'SubSubCategoryController');
            Route::resource('/brand', 'BrandController');
            Route::resource('/color', 'ColorController');
            Route::resource('/product', 'ProductController');
        });
    }
);




// Frontend Route
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/{slug}', [ProductFront::class, 'getSingleProduct'])->name('frontend.product.show');
Route::get('/{category}/{subcategory?}/{sub_sub_category?}', [ProductFront::class, 'getCategory'])->name('frontend.product.list');
Route::post('/get_filter_product', [ProductFront::class, 'getFilterProduct'])->name('get_filter_product');