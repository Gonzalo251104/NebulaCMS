<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('public.home');

Route::middleware(['auth', 'role:admin|editor'])->group(function () {
    Route::get('/dashboard', fn () => redirect()->route('admin.dashboard'))->name('dashboard');
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/admin/posts', PostController::class);
});

require __DIR__.'/auth.php';
require __DIR__.'/profile.php';
