<?php

use App\Http\Controllers\User\FilterController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->name('user.')->group(function () {

        //     Route::get('/login', 'App\Livewire\Website\Auth\Login')->name('login')
        //     ->middleware(['guest.registerstep','guest.user']);
    Route::get('clear-cache', function (\Illuminate\Http\Request $request){
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        return redirect(url()->previous());
    })->name('clear-cache');
    Route::get('/login', 'App\Livewire\Website\Auth\Login')->name('login')->middleware('handle.register.otp')->middleware('website.localize');

    /*=============================================
    =       AUTH USER Section            =
    =============================================*/
    Route::middleware(['auth','website.localize'])->group(function () {
        Route::get('/finish', 'App\Livewire\Website\Auth\Finish')->name('register.finish');
        // DASHBOARD
        // Route::get('/dashboard', 'App\Livewire\User\Dashboard')->name('dashboard');
        Route::redirect('/dashboard', '/user/orders')->name('dashboard');
//        Route::view('/dashboard/invoice/{order_id}','livewire.user.organization.invoice.print' )->name('invoice.print');
        Route::get('/dashboard/invoice/{order}','App\Livewire\Website\Components\Invoice' )->name('invoice.print');
//        Route::get('/dashboard/invoice/{order}',function ($order){ return orderPdf($order) ;})->name('invoice.print');

        // PRODFILE
        Route::get('/profile', 'App\Livewire\User\Orders\Index')->name('profile.show');
        // Notification START
        Route::get('/notification', 'App\Livewire\User\Components\Notification')->name('notification');
        // Notification END
        // LOGOUT
        // Route::any('/logout', [UserController::class, 'logout'])->name('logout');
        // ORGANIZATIONS START
        Route::get('/organizations', 'App\Livewire\User\Organization\Organization\Organizations')->name('organization.organizations');
        Route::get('/organizations/product/{productId}', 'App\Livewire\User\Organization\Product\Product')->name('organization.product');
        Route::get('/organizations/offer', 'App\Livewire\User\Organization\Offer\OfferList')->name('organization.offer-list');
        Route::get('/organizations/offer_details/{offerId}', 'App\Livewire\User\Organization\Offer\OfferDetails')->name('organization.offer-details');
        Route::get('/organizations/course/{courseId}', 'App\Livewire\User\Organization\Course\Course')->name('organization.course');
        // ORGANIZATIONS END
        // ORDERS START
        Route::get('/order', 'App\Livewire\User\Order\Index')->name('order.index');
        Route::get('/order/{orderId}', 'App\Livewire\User\Order\Show')->name('order.show');
        Route::get('/forgot-password-new-aa', 'App\Livewire\Website\Auth\ForgotPasswordNew')->name('forgotpassworda.new')->middleware('website.localize');
// ORDERS END
// ORDERS START
        Route::get('/orders', 'App\Livewire\User\Orders\Index')->name('orders.index');
        Route::get('/orders/{order}', 'App\Livewire\User\Orders\Show')->name('orders.show');
// ORDERS END

// CARTS START
        Route::get('/carts', 'App\Livewire\User\Organization\Cart\Carts')->name('organization.carts');
// CARTS END
// CHECKOUTS START
        Route::get('/checkouts', 'App\Livewire\User\Organization\Checkout\Checkouts')->name('organization.checkouts');
// CHECKOUTS END
// FILTER START
        Route::get('/citiesbyregion/{region}', [FilterController::class, 'citiesByRegion'])->name('citiesbyregion');
// FILTER END

    });
    /* ====  End of AUTH USER==== */

    /*=============================================
    =       AUTH WEB ONLY SAME USER WITHOUT TOKEN VERIFICATION Section            =
    =============================================*/

    // LOGIN OTP
    Route::get('/login/otp', 'App\Livewire\Website\Auth\LoginOtp')->name('login.otp')->middleware('website.localize');
    // FORGOT PASSWORD OTP
    Route::get('/forgot-password/otp', 'App\Livewire\Website\Auth\ForgotPasswordOtp')
    ->name('forgotpassword.otp')->middleware('website.localize');
    // FORGOT PASSWORD NEW
    Route::get('/forgot-password-new', 'App\Livewire\Website\Auth\ForgotPasswordNew')->name('forgotpassword.new')->middleware('website.localize');
//    Route::get('/f', function (){
//        return 'ds';
//    })->name('fo')->middleware('website.localize');
    // LOGOUT
    Route::any('/logout', [UserController::class, 'logout'])->name('logout');

    /* ====  End of AUTH WEB ONLY SAME USER WITHOUT TOKEN VERIFICATION==== */

/*=============================================
=       ONLY AUTH IN GUARD REGISTER STEP Section            =
=============================================*/
// REGISTER OTP
    Route::get('/register-otp', 'App\Livewire\Website\Auth\RegisterOtp')->name('register.otp')->middleware('website.localize');
/* ====  End of ONLY AUTH IN GUARD REGISTER STEP==== */

});
