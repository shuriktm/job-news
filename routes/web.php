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
});

Auth::routes([
    'register' => false,
    'verify' => false,
]);

Route::prefix('manager')->group(function () {
    Route::get('/', [App\Http\Controllers\ManagerController::class, 'index'])
        ->name('manager');

    Route::resource('categories', CategoryController::class);
    Route::resource('posts', PostController::class);
});
