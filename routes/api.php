<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\Auth\AuthController as UserAuthController;
use App\Http\Controllers\Admin\Auth\AuthController as AdminAuthController;
use App\Http\Controllers\User\Auth\ResetPasswordController as UserResetPasswordController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController as AdminResetPasswordController;

// Public routes
Route::post('/login', [UserAuthController::class, 'login'])->name('api.login');
Route::post('/register', [UserAuthController::class, 'register'])->name('api.register');
Route::post('/forgot-password', [UserResetPasswordController::class, 'forgotPassword'])->name('api.forgotpassword');
Route::post('/reset-password', [UserResetPasswordController::class, 'resetPassword'])->name('api.resetpassword');

// Protected routes
Route::group(['middleware' => ['auth:sanctum', 'user']], function () {
    Route::get('/logout', [UserAuthController::class, 'logout']);
    Route::get('/profile', [UserAuthController::class, 'profile']);
});

Route::post('/admin/register', [AdminAuthController::class, 'register'])->name('api.admin.register');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('api.admin.login');


// Protected routes
Route::group(['middleware' => ['auth:sanctum', 'admin']], function () {
    Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('api.admin.logout');    
    Route::get('/admin/profile', [AdminAuthController::class, 'profile']);
    Route::post('/admin/change-password', [AdminResetPasswordController::class, 'changePassword'])->name('api.admin.changepassword');
});
