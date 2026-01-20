<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Public\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('public.home');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', fn () => redirect()->route('admin.dashboard'))->name('dashboard');
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
});

require __DIR__.'/auth.php';
require __DIR__.'/profile.php';
