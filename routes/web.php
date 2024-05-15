<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/forgot-password', function () {
    return 123;
});

//Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetPasswordForm'])->name('password.reset');

Route::get('/reset-password/{token}', function ($token) {
    return ['token' => $token];
})->name('password.reset');