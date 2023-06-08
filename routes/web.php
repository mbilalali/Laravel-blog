<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('home', [PostController::class, 'blogs']);
Route::get('blogs', [PostController::class, 'blogs']);

Route::get('blogs/{type}/{slug}', [PostController::class, 'blogs'])->name('categoryTagPost');
//Route::get('blogs/{type}/{categorySlug}', [PostController::class, 'blogs'])->name('categoryPost');

Route::get('show', [PostController::class, 'show']);


Route::get('single/{id}', [PostController::class, 'single']);
//Route::get('single/{id}', [PostController::class, 'viewComment']);
Route::post('single/{id}', [PostController::class, 'addComment']);
Route::post('single/{id}', [PostController::class, 'addReply']);
Route::get('single/remove/{id}', [PostController::class, 'removeReply']);

Auth::routes();

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('logout', [PostController::class, 'logout']);



Route::group(['middleware'=>['auth']], function () {
    Route::get('write', [PostController::class, 'add']);
    Route::post('write',[PostController::class,'write']);

    Route::get('edit/{id}', [PostController::class, 'editview']);
    Route::post('edit/{id}',[PostController::class,'edit'])->name('editpost');
});

