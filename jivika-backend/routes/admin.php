<?php

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
// Auth::routes(['register'=>false,'reset'=>false]);
// Route::get('/', function () {
//     return view('_back.login');
// });
Route::group(['prefix'=>'admin/','namespace' =>'App\Http\Controllers\Admin','name'=>'admin.'], function(){
    Auth::routes(['register'=>false]);
    Route::group(['middleware'=>'auth:admin'],function(){

        Route::get('/dashboard', [App\Http\Admin\Dashboard\Controllers\DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/changepassword', [App\Http\Controllers\Admin\Auth\ChangePasswordController::class, 'changePassword']);
        Route::post('/changepassword', [App\Http\Controllers\Admin\Auth\ChangePasswordController::class, 'changePasswordSave'])->name('admin.changepassword');
        Route::post('settings/update', [App\Http\Admin\Setting\Controllers\SettingController::class, 'update']);
        Route::get('settings', [App\Http\Admin\Setting\Controllers\SettingController::class, 'index']);
        Route::get('users', [App\Http\Admin\AdminUser\Controllers\AdminUserController::class, 'index']);
        Route::get('category', [App\Http\Admin\Category\Controllers\CategoryController::class, 'index']);
        Route::get('category/create', [App\Http\Admin\Category\Controllers\CategoryController::class, 'create']);
        Route::get('services', [App\Http\Admin\Service\Controllers\ServiceController::class, 'index']);
        Route::post('category/destroy', [App\Http\Admin\Category\Controllers\CategoryController::class, 'delete'])->name('category.destroy');
        Route::post('category', [App\Http\Admin\Category\Controllers\CategoryController::class, 'store']);
        Route::get('services/create', [App\Http\Admin\Service\Controllers\ServiceController::class, 'create']);
        Route::post('services', [App\Http\Admin\Service\Controllers\ServiceController::class, 'store']);
        Route::post('services/destroy', [App\Http\Admin\Service\Controllers\ServiceController::class, 'delete'])->name('service.destroy');
        Route::get('discount', [App\Http\Admin\Discount\Controllers\DiscountController::class, 'index']);
        Route::get('discount/create', [App\Http\Admin\Discount\Controllers\DiscountController::class, 'create']);
        Route::post('discount', [App\Http\Admin\Discount\Controllers\DiscountController::class, 'store']);
        Route::post('discount/destroy', [App\Http\Admin\Discount\Controllers\DiscountController::class, 'delete'])->name('discount.destroy');
        Route::post('user/update', [App\Http\Admin\AdminUser\Controllers\AdminUserController::class, 'userUpdate']);
        Route::get('profile', [App\Http\Admin\AdminUser\Controllers\AdminUserController::class, 'userProfile'])->name('admin.profile');
        Route::get('/customers', [App\Http\Admin\User\Controllers\UserController::class, 'index']);
        Route::post('/customers/destroy', [App\Http\Admin\User\Controllers\UserController::class, 'delete'])->name('customer.destroy');
        Route::get('packages', [App\Http\Admin\Service\Controllers\ServicePackageController::class, 'index']);
        Route::get('packages/create', [App\Http\Admin\Service\Controllers\ServicePackageController::class, 'create']);
        Route::post('packages', [App\Http\Admin\Service\Controllers\ServicePackageController::class, 'store']);
        Route::post('packages/destroy', [App\Http\Admin\Service\Controllers\ServicePackageController::class, 'delete'])->name('package.destroy');
        Route::get('orders', [App\Http\Front\Order\Controllers\OrderController::class, 'index']);
        Route::get('bookings', [App\Http\Front\Booking\Controllers\BookingController::class, 'index']);
        Route::post('details', [App\Http\Front\Booking\Controllers\BookingController::class, 'bookingDetails'])->name('bookingDetails');
        Route::get('providers', [App\Http\Admin\ServiceProvider\Cotrollers\ServiceProviderController::class, 'index']);
        Route::post('payment_settings/update', [App\Http\Admin\PaymentSetting\Controllers\PaymentSettingController::class, 'update']);
        Route::get('payment_settings', [App\Http\Admin\PaymentSetting\Controllers\PaymentSettingController::class, 'index']);
    });
});
