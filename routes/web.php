<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;

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
        $posts = Post::orderby('created_at','desc')->get();   
        return view('welcome',compact('posts'));
});
Route::get('/login',[App\Http\Controllers\LoginController::class, 'index']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/add-info', [App\Http\Controllers\HomeController::class, 'info']);
Route::post('/add-info', [App\Http\Controllers\HomeController::class, 'infoPost']);

Route::get('/add-post', [App\Http\Controllers\HomeController::class, 'addPost']);
Route::post('/add-post', [App\Http\Controllers\HomeController::class, 'addPostP']);

Route::get('/post/{id}', [App\Http\Controllers\HomeController::class, 'Post'])->name('post');
Route::get('/like/{id}', [App\Http\Controllers\HomeController::class, 'Like']);
Route::post('/comment', [App\Http\Controllers\HomeController::class, 'Comment'])->name('comment');

Route::get('profile/{id}', [App\Http\Controllers\HomeController::class, 'Profile']);

Route::post('/follow', [App\Http\Controllers\HomeController::class, 'Follow']);
