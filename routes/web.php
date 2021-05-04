<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\productManagement\categories\CategoryController;
use App\Http\Controllers\admin\productManagement\orders\OrderController;
use App\Http\Controllers\admin\productManagement\products\ProductController;
use App\Http\Controllers\admin\TwoFactorAuthenticatedSessionController;
use App\Http\Controllers\admin\Profile\UserProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Livewire\Admin\ProductsManagement\Categories\Categories;
use App\Http\Livewire\Admin\ProductsManagement\Products\Products;
use App\Http\Controllers\front\Dashboard;
use App\Http\Controllers\front\AuthController as FrontAuthController;

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

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){ //...

    //login
    Route::get('/admin', function () {
        return view('admin.auth.login');
    })->middleware('guest');
    Route::get('/admin/login',[AuthController::class,'index'])->name('index');
    Route::post('/admin/login',[AuthController::class,'login'])->name('login')->middleware("throttle:6,2");

    //forget password
    Route::get('/ForgetPassword',[AuthController::class,'viewForget'])->name('viewForget');
    Route::post('/ForgetPassword',[AuthController::class,'sendEmailToResetPassword'])->name('sendEmail');
    Route::get('/reset-password/{_token}',[AuthController::class,'viewResetPassword'])->name('viewResetPassword');
    Route::post('/reset-password',[AuthController::class,'changePassword'])->name('changePassword');

//two factor auth
    Route::post('/two-factor-challenge', [TwoFactorAuthenticatedSessionController::class, 'store'])->middleware(array_filter(['guest', 'throttle:6,2']))->name('two-factor.login');


    Route::group(['prefix'=>'admin','middleware' => 'auth'],function(){
        Route::post('/logout',[AuthController::class,'logout'])->name('logout');
        Route::get('/dashboard',[AdminController::class,'index'])->name('admin.index');
        Route::get('/user/profile', [UserProfileController::class, 'show'])->name('profile.show');
        Route::get('/categories', Categories::class);
        Route::get('/category/{category}-{slug}', [CategoryController::class,'show'])->name('category.show');
        Route::get('/products', Products::class);
        Route::get('/product-add', [ProductController::class,'addNewProduct']);
        Route::get('/products-update/{product}-{slug}', [ProductController::class,'updateProduct']);
    });

    Route::name('front.')->group(function(){
        Route::get('/',[Dashboard::class,'dashboard'])->name('dashboard');
        Route::get('/login',[FrontAuthController::class,'loginView'])->name('loginView');
        Route::get('/register',[FrontAuthController::class,'registerView'])->name('registerView');
    });

});
