<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::get('/inscription', [RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('register');

Route::post('/inscription', [RegisteredUserController::class, 'store'])
                ->middleware('guest');

Route::get('/connexion', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');

Route::post('/connexion', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest');

Route::get('/mot-de-passe/oubli', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request');

Route::post('/mot-de-passe/oubli', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::get('/mot-de-passe/changement', [ChangePasswordController::class, 'show'])
                ->middleware('auth')
                ->name('password.change');

Route::post('/mot-de-passe/changement', [ChangePasswordController::class, 'store'])
                ->middleware('auth')
                ->name('password.set');

Route::get('/mot-de-passe/reinitialisation/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset');

Route::post('/mot-de-passe/reinitialisation', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.update');

Route::get('/email/verifier', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth')
                ->name('verification.notice');

Route::get('/email/verifier/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/notification-de-verification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/mot-de-passe/confirmation', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth')
                ->name('password.confirm');

Route::post('/mot-de-passe/confirmation', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth');

Route::post('/deconnexion', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');



Route::redirect('/register', '/inscription');
Route::redirect('/login', '/connexion');
Route::redirect('/logout', '/deconnexion');
Route::redirect('/forgot-password', '/mot-de-passe/oubli');
Route::redirect('/reset-password', '/mot-de-passe/reinitialisation');
Route::redirect('/confirm-password', '/mot-de-passe/confirmation');
Route::redirect('/verify-email', '/email/verifier');
Route::redirect('/email/verification-notification', '/email/notification-de-verification');
