<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PictureController;
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
   return redirect('/login');
});

Auth::routes();

Route::resource('albums', AlbumController::class)->middleware('auth');

Route::controller(PictureController::class)->group(function () {
   
   Route::get('picture/{id}', 'index')->name('picture.index');
   Route::get('picture/upload/{id}', 'create');
   Route::post('picture/store', 'store');

})->middleware('auth');


Route::get('album/delete/{id}', [AlbumController::class,'delete'])->middleware('albumCheck');
Route::get('album/forcedelete/{id}', [AlbumController::class,'forcedelete']);
Route::get('album/delete_option/{id}', [AlbumController::class,'deleteOptions']);
Route::post('album/change_album', [AlbumController::class,'changeAlbum']);
