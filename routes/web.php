<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CsvController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\HomeController;
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

Route::middleware('auth')->group(function(){

    Route::get('/old/allegro', [CsvController::class, 'indexAllegro'])->name('allegro.index');
    Route::post('/old/allegro', [CsvController::class, 'AllegroUpload'])->name('allegro.upload');
    Route::get('/old/allegro/allegro_table', [CsvController::class, 'AllegroGetData'])->name('allegro.download');
    Route::post('/old/allegro/allegro_table', [CsvController::class, 'AllegroDropTable'])->name('allegro.truncate');

    Route::get('/old/shop', [CsvController::class, 'indexShop'])->name('shop.index');
    Route::post('/old/shop', [CsvController::class, 'shopUpload'])->name('shop.upload');
    Route::get('/old/shop_table', [CsvController::class, 'shopGetData'])->name('shop.download');

    Route::get('/old/print', [PrintController::class, 'printAllegroTables'])->name('allegro.print');

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/home', [HomeController::class, 'index'])->name( 'home');

    Route::get('/api/orders',[ApiController::class,'getCodeToken'])->name('api.orders');

});


Auth::routes();
