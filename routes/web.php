<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Public\PostController as PublicPostController;
use Illuminate\Support\Facades\Route;

/*
    Public Routes
*/
Route::get('/', [PublicPostController::class, 'index'])->name('public.home');
Route::get('/posts/{slug}', [PublicPostController::class, 'show'])->name('public.posts.show');

/*
    Admin Routes (Auth + Permissions)
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', fn () => redirect()->route('admin.dashboard'))->name('dashboard');

    // Admin dashboard
    Route::middleware(['permission:posts.view'])->group(function () {
        Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
    });

    // Posts
     Route::middleware(['permission:posts.view'])->group(function () {
        Route::get('/admin/posts', [PostController::class, 'index'])->name('posts.index');

        Route::get('/admin/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

        Route::put('/admin/posts/{post}', [PostController::class, 'update'])->name('posts.update');

        Route::delete('/admin/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    });

    Route::middleware(['permission:posts.create'])->group(function () {
        Route::get('/admin/posts/create', [PostController::class, 'create'])->name('posts.create');

        Route::post('/admin/posts', [PostController::class, 'store'])->name('posts.store');
    });

    // Media Library
    Route::middleware(['permission:media.view'])->group(function () {
        Route::get('/admin/media', [MediaController::class, 'index'])->name('admin.media.index');

        // TinyMCE image upload uses this
        Route::post('/admin/uploads/images', [UploadController::class, 'image'])
            ->name('admin.uploads.images');
    });

    Route::middleware(['permission:media.delete'])->group(function () {
        Route::delete('/admin/media', [MediaController::class, 'destroy'])->name('admin.media.destroy');
    });
});

require __DIR__ . '/auth.php';
require __DIR__ . '/profile.php';
