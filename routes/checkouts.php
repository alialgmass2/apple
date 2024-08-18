<?php

use App\Http\Controllers\checkouts\carts\CartController;
use App\Http\Controllers\checkouts\CheckoutController;
use App\Http\Controllers\checkouts\orders\OrderController;
use Illuminate\Support\Facades\Route;

Route::resource('carts', CartController::class)->only(['index', 'update', 'destroy','store'])->middleware('website.localize');
Route::get('cart/destroyAll', [CartController::class, 'destroyAll'])->name('carts.destroyAll')->middleware('website.localize');
Route::resource('checouts', CheckoutController::class)->except(['show', 'index', 'destroy', 'update'])->middleware('website.localize');
Route::get('checout/checkPaymentStatus', [CheckoutController::class, 'checkPaymentStatus'])->name('checouts.checkPaymentStatus')->middleware('website.localize');
Route::get('checout/order', [OrderController::class, 'index'])->name('checout.order.index');
Route::get('checout/order/{order}', [OrderController::class, 'show'])->name('checout.order.show');

Route::get('TabbySuccess',[CheckoutController::class,'storeTabby'])->name('checout.TabbySuccess');
Route::get('cancelTabby',[CheckoutController::class,'cancelTabby'])->name('checout.cancelTabby');
Route::get('failureTabby',[CheckoutController::class,'failureTabby'])->name('checout.failureTabby');

Route::any('getWebHock',[CheckoutController::class,'getWebHock'])->withoutMiddleware(['csrf','auth'])->name('checout.getWebHock');
Route::any('getWebHockHyperPay',[CheckoutController::class,'getWebHockHyperPay'])->withoutMiddleware(['csrf','auth'])->name('checout.getWebHockHyperPay');