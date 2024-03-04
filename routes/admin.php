<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\ProfileController;
use Illuminate\Support\Facades\Route;

// Admin Route
Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('profile', [ProfileController::class, 'index'])->name('profile'); // Admin Profile Method
Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update'); // Admin Profile Update
Route::get('change/password', [ProfileController::class, 'changePassword'])->name('change.password'); // Admin Password Change Method
Route::post('password/update', [ProfileController::class, 'updatePassword'])->name('password.update'); // Admin Password Update
