<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->name('api.v1.')->group(function () {

    Route::prefix('/wallet')->name('wallet.')->group(function () {
        Route::post('/deposit', [\App\Http\Controllers\WalletController::class, 'deposit'])->name('deposit');
        Route::post('/withdraw', [\App\Http\Controllers\WalletController::class, 'withdraw'])->name('withdraw');
    });

});
