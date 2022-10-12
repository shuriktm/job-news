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

Route::get('/', function () {
    return view('home');
})->name('home');

Auth::routes([
    'register' => false,
    'verify' => false,
]);

Route::middleware(['auth'])
    ->prefix('manager')->group(function () {
        Route::get('/', [App\Http\Controllers\ManagerController::class, 'index'])
            ->name('manager');

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
