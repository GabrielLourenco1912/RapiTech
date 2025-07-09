<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register_dev', [RegisteredUserController::class, 'create_dev'])
        ->name('register_dev');

    Route::post('register_dev', [RegisteredUserController::class, 'store'])
        ->name('register_dev_post');


    Route::get('register_cliente', [RegisteredUserController::class, 'create_cliente'])
        ->name('register_cliente');

    Route::post('register_cliente', [RegisteredUserController::class, 'store'])
        ->name('register_cliente_post');

    Route::get('login_admin', [AuthenticatedSessionController::class, 'create_admin'])
        ->name('login_admin');

    Route::post('login_admin', [AuthenticatedSessionController::class, 'store']);

    Route::get('login_dev', [AuthenticatedSessionController::class, 'create_dev'])
        ->name('login_dev');

    Route::post('login_dev', [AuthenticatedSessionController::class, 'store']);

    Route::get('login_cliente', [AuthenticatedSessionController::class, 'create_cliente'])
        ->name('login_cliente');

    Route::post('login_cliente', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
