<?php

use App\Http\Testimonial\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;
Route::group(['prefix'=>'admin/'], function (){
Route::middleware(['web'])->group(function () {
    Route::middleware(['middleware'=>'auth:admin'])->group(function(){
        Route::resource('testimonials',TestimonialController::class);
    });
});
});
