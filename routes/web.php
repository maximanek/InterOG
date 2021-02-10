<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CsvController;
use App\Http\Controllers\PrintController;

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
})->middleware('auth');

Route::get('/old/allegro', [App\Http\Controllers\CsvController::class, 'indexAllegro'])->middleware('auth');
Route::post('/old/allegro', [App\Http\Controllers\CsvController::class, 'AllegroUpload'])->name('allegro.upload')->middleware('auth');
Route::get('/old/allegro/allegro_table', [App\Http\Controllers\CsvController::class, 'AllegroGetData'])->name('allegro.download')->middleware('auth');
Route::post('/old/allegro/allegro_table', [App\Http\Controllers\CsvController::class, 'AllegroDropTable'])->name('allegro.truncate')->middleware('auth');

Route::get('/old/shop', [App\Http\Controllers\CsvController::class, 'indexShop'])->middleware('auth');
Route::post('/old/shop', [App\Http\Controllers\CsvController::class, 'shopUpload'])->name('shop.upload')->middleware('auth');
Route::get('/old/shop_table', [App\Http\Controllers\CsvController::class, 'shopGetData'])->name('shop.download')->middleware('auth');


Route::get('/old/print', [App\Http\Controllers\PrintController::class, 'printAllegroTables'])->name('allegro.print')->middleware('auth');

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

