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
use App\Http\Controllers\ProductVariantsController;

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

Route::get('/', function () {
    return view('frontend.pages.Index');
});

// Frontend Route
Route::get('/', [HomeController::class, 'index']);
Route::get('/shop', [ShopController::class, 'shop'])->name('shop');



Route::get('admin/login', [AuthController::class, 'login_admin'])->name('admin.login');
Route::post('admin/login', [AuthController::class, 'Auth_login_admin']);
Route::get('admin/logout', [AuthController::class, 'logout_admin'])->name('admin.logout');

Route::namespace('App\Http\Controllers')->group(
    function () {
        Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::get('/get-sub-categories/{category_id}', [ProductController::class, 'getSubCategories'])->name('getSubCategories');
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