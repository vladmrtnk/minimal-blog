<?php

use App\Http\Controllers\Dashboard\Blog\CategoryController;
use App\Http\Controllers\Dashboard\Blog\PostController;
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
    return view('welcome');
});

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::group(['prefix' => 'blog'], function () {
        Route::resource('categories', CategoryController::class)->names('dashboard.blog.categories');
        Route::resource('posts', PostController::class)->names('dashboard.blog.posts');
    });


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require __DIR__ . '/auth.php';
