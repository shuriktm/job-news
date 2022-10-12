<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');
Route::get('/news/{category:slug}', [App\Http\Controllers\HomeController::class, 'category'])
    ->name('home.category');
Route::get('/news/{category:slug}/{post:slug}', [App\Http\Controllers\HomeController::class, 'post'])
    ->name('home.post');

Auth::routes([
    'register' => false,
    'verify' => false,
]);

Route::middleware(['auth'])
    ->prefix('manager')->group(function () {
        Route::get('/', [App\Http\Controllers\ManagerController::class, 'index'])
            ->name('manager');

        Route::get('/categories/archive', [CategoryController::class, 'archive'])
            ->name('categories.archive');
        Route::post('/categories/restore/{id}', [CategoryController::class, 'restore'])
            ->name('categories.restore');
        Route::resource('categories', CategoryController::class)->except([
            'show',
        ]);

        Route::get('/posts/archive', [PostController::class, 'archive'])
            ->name('posts.archive');
        Route::post('/posts/restore/{id}', [PostController::class, 'restore'])
            ->name('posts.restore');
        Route::resource('posts', PostController::class)->except([
            'show',
        ]);
    });
