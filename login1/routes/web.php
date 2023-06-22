<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[PageController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('home');
        Route::resource('posts', PostController::class);
        Route::resource('categories', CategoryController::class);// gli do il nome della tabella, categories
        Route::resource('tags', TagController::class);
        Route::get('orderby/{direction}', [PostController::class, 'orderby'])->name('orderby');
        Route::get('category-posts}', [PostController::class, 'categoryPosts'])->name('category_posts');
        Route::get('tag-posts}', [PostController::class, 'tagsPosts'])->name('tags_posts');

});

require __DIR__.'/auth.php';