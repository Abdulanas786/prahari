<?php

use App\Http\Controllers\API\Prahari\AuthController;
use App\Http\Controllers\API\Prahari\ProfileController;
use App\Http\Controllers\API\Prahari\CaseController;
use App\Http\Controllers\API\Prahari\ChallanController;
use App\Http\Controllers\API\Prahari\DashboardController;
use App\Http\Controllers\API\Prahari\PaymentController;

Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/verify-signup-otp', [AuthController::class, 'verifySignupOtp']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/verify-login-otp', [AuthController::class, 'verifyLoginOtp']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    // Dashboard
    Route::get('/dashboard-stats', [DashboardController::class, 'stats']);
    Route::get('/recent-cases', [DashboardController::class, 'recentCases']);
    Route::get('/recent-challans', [DashboardController::class, 'recentChallans']);

    // Profile
    Route::get('/profile', [ProfileController::class, 'profile']);
    Route::get('/profile-summary',[ProfileController::class, 'profileSummary']);
    Route::get('/profile/settings', [ProfileController::class, 'getSettings']);
    Route::post('/profile/update', [ProfileController::class, 'update']);
    Route::post('/settings/update', [ProfileController::class, 'updateSettings']);

    // Cases
    Route::post('/cases', [CaseController::class, 'store']);
    Route::get('/cases/list', [CaseController::class, 'index']);
    Route::get('/cases/details/{id}', [CaseController::class, 'show']);
    Route::put('/cases/{id}', [CaseController::class, 'update']);

    // Challans
    Route::post('/challans', [ChallanController::class, 'store']);
    Route::get('/challans/list', [ChallanController::class, 'index']);
    Route::put('/challans/{id}', [ChallanController::class, 'updateStatus']);

    // Wallet
    Route::get('/wallet-balance', [PaymentController::class, 'balance']);
    Route::get('/wallet-transactions', [PaymentController::class, 'transactionList']);
    Route::get('/payments/details/{id}', [PaymentController::class, 'paymentDetails']);
    Route::get('/transactions', [PaymentController::class, 'transactions']);
    Route::post('/withdraw-request', [PaymentController::class, 'requestWithdraw']);
});