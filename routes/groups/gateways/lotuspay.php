<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Gateway\LotusPayController;

Route::prefix('lotuspay')
    ->group(function () {
        Route::post('qrcode-pix', [LotusPayController::class, 'getQRCodePix']);
        Route::any('callback', [LotusPayController::class, 'callbackMethod']);
        Route::post('consult-status-transaction', [LotusPayController::class, 'consultStatusTransactionPix']);

        Route::get('withdrawal/{id}/{action}', [LotusPayController::class, 'withdrawalFromModal'])->name('lotuspay.withdrawal');
        Route::get('cancelwithdrawal/{id}/{action}', [LotusPayController::class, 'cancelWithdrawalFromModal'])->name('lotuspay.cancelwithdrawal');
        
        Route::get('test-connection', [LotusPayController::class, 'testConnection'])->name('lotuspay.test');
    });