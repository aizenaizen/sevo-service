<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/quote', [PageController::class, 'quote'])->name('quote');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'create'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'store'])->name('login.store');

    Route::middleware('admin.auth')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'destroy'])->name('logout');
        Route::redirect('/', '/admin/pages')->name('dashboard');
        Route::view('/pages', 'admin.pages.index')->name('pages.index');
        Route::view('/posts', 'admin.posts.index')->name('posts.index');
        Route::view('/categories', 'admin.categories.index')->name('categories.index');
    });
});

// Catch-all for CMS-managed custom pages. Must stay last so it never
// shadows the named routes above (home/services/quote/blog/admin).
Route::get('/{page:slug}', [PageController::class, 'showCustom'])->name('page.show');
