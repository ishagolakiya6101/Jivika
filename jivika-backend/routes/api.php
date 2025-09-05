<?php

use App\Http\Admin\Address\Controllers\AddressController;
use App\Http\Admin\Category\Controllers\CategoryController;
use App\Http\Admin\Discount\Controllers\DiscountController;
use App\Http\Admin\Payment\Controller\PaymentController;
use App\Http\Admin\Service\Controllers\ServiceController;
use App\http\Admin\Service\Controllers\ServicePackageController;
use App\Http\Admin\ServiceProvider\Cotrollers\ServiceProviderController;
use App\Http\Admin\User\Controllers\UserController;
use App\Http\Front\Booking\Controllers\BookingController;
use App\Http\Front\Cart\Controllers\CartController;
use App\Http\Front\Order\Controllers\OrderController;
use App\Http\Testimonial\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [UserController::class, 'register'])->name('user.register');
Route::post('profile', [UserController::class, 'profile'])->name('user.profile');
Route::post('changePassword', [UserController::class, 'changePassword'])->name('user.changePassword');
Route::post('sendotp', [UserController::class, 'sendOtp'])->name('user.sendotp');
Route::get('providers', [ServiceProviderController::class, 'providerlist']);
Route::post('provider/login', [ServiceProviderController::class, 'login']);
Route::get('provider/forgot_password', [ServiceProviderController::class, 'sendResetLinkEmail']);
Route::post('provider/reset', [ServiceProviderController::class, 'reset']);
Route::get('forgot_password', [UserController::class, 'sendResetLinkEmail']);
Route::post('reset', [UserController::class, 'reset']);
Route::post('login', [UserController::class, 'login'])->name('api.login');
Route::get('/login/google', [UserController::class, 'loginWithGoogle']);
Route::get('/login/facebook', [UserController::class, 'loginWithFacebook']);
Route::get('/facebook/callback', [UserController::class, 'loginWithFacebookCallback']);
Route::get('/google/callback', [UserController::class, 'loginWithGoogleCallback']);
Route::get('category', [CategoryController::class, 'show']);
Route::get('services', [ServiceController::class, 'show']);
Route::get('serviceDetail', [ServiceController::class, 'serviceDetail']);
Route::get('testimonials', [TestimonialController::class, 'testimonialList']);
Route::get('paymentCallback', [PaymentController::class, 'paymentCallback'])->name('paymentCallback');
Route::post('nearByProviders', [ServiceProviderController::class, 'getNearbyLocations']);

Route::group(['middleware' => ['auth:web', 'jwt.auth']], function () {

    Route::post('provider_time', [ServiceProviderController::class, 'timeSlot'])->name('provider_time');
    Route::get('timeSlots', [BookingController::class, 'timeSlot'])->name('timeSlot');
    Route::post('address/store', [AddressController::class, 'create']);
    Route::post('address/delete', [AddressController::class, 'delete']);
    Route::get('address', [AddressController::class, 'index']);
    // Route::get('profile', [UserController::class, 'profile'])->name('api.profile');
    Route::get('packages', [ServicePackageController::class, 'show']);
    Route::get('discount', [DiscountController::class, 'show']);
    Route::get('discount/detail', [DiscountController::class, 'discount_details']);
    Route::post('add_cart', [CartController::class, 'addCart']);
    Route::get('cart_item_list', [CartController::class, 'itemList']);
    Route::get('order_list', [OrderController::class, 'orderList']);
    Route::post('cancel_order', [OrderController::class, 'cancelOrder']);
    Route::post('remove_from_cart', [CartController::class, 'removefromCart']);
    Route::get('/bookings', [BookingController::class, 'bookings']);
    Route::get('createOrder', [PaymentController::class, 'createOrder']);
    Route::get('OrderDetail', [PaymentController::class, 'OrderDetail']);
});
Route::group(['prefix' => 'provider/', 'middleware' => ['auth:service_provider', 'jwt.auth']], function () {
    // Route::get('/bookings', [BookingController::class, 'bookings']);
});
