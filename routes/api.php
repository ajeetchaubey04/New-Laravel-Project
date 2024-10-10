<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\Client\Auth\AuthController;
use App\Http\Controllers\Api\V1\Client\ApiController;

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

Route::prefix('v1')->group(function () {
    Route::post('notification',            [ApiController::class, 'notification']);

    Route::prefix('auth')->group(function () {

        Route::post('login',                    [AuthController::class, 'login']);
        Route::post('send-verification-code',   [AuthController::class, 'sendVerificationCode']);
        Route::post('verify-code',              [AuthController::class, 'verifyCode']);
        Route::post('register',                 [AuthController::class, 'register']);
        Route::post('forgot-password',          [AuthController::class, 'forgotPassword']);
        
    });

    Route::prefix('client')->group(function () {

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('change-password', [AuthController::class, 'changePassword']);
            Route::get('my-details', [AuthController::class, 'myDeatils']);
        });

        Route::middleware(['auth:sanctum', 'ability:client:sales-person'])->group(function () {
            Route::post('send-request',         [ApiController::class, 'sendRequest']);
            Route::post('add-images',           [ApiController::class, 'uploadImages']);
            Route::get('my-requests',           [ApiController::class, 'myRequests']);
            Route::post('buy-now',              [ApiController::class, 'buyNow']);
            Route::get('banks-list',            [ApiController::class, 'banksList']);
            Route::get('finance-types',         [ApiController::class, 'financeList']);
            Route::get('processing-fees',       [ApiController::class, 'processingFees']);
        });

        Route::middleware(['auth:sanctum', 'ability:client:customer'])->group(function () {
            Route::post('update-address',                   [ApiController::class, 'updateAddress']);
            Route::get('my-emi-details',                    [ApiController::class, 'myEmiDetails']);
            Route::get('my-support-tickets',                [ApiController::class, 'supportTicketList']);
            Route::get('my-support-ticket/{id}',            [ApiController::class, 'supportMessages']);
            Route::post('add-support-ticket',               [ApiController::class, 'supportTicketCreate']);
            Route::post('add-support-ticket-message',       [ApiController::class, 'supportTicketMessageCreate']);
            Route::get('is-app-installed-active',           [ApiController::class, 'isAppInstalledActive']);
        });
    });
});
