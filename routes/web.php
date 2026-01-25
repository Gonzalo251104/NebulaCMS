<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Public\PostController as PublicPostController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\MediaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('public.home');

Route::get('/', [PublicPostController::class, 'index'])->name('public.home');

Route::get('/posts/{slug}', [PublicPostController::class, 'show'])->name('public.posts.show');

Route::get('/admin/media', [MediaController::class, 'index'])->name('admin.media.index');

Route::delete('/admin/media', [MediaController::class, 'destroy'])->name('admin.media.destroy');

Route::middleware(['auth', 'role:admin|editor'])->group(function () {
    Route::get('/dashboard', fn () => redirect()->route('admin.dashboard'))->name('dashboard');
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/admin/posts', PostController::class);
    Route::post('/admin/uploads/images', [UploadController::class, 'image'])
        ->name('admin.uploads.images');
});

require __DIR__.'/auth.php';
require __DIR__.'/profile.php';
