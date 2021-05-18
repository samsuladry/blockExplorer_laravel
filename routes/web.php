<?php

use App\Http\Controllers\BlockController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/viewTransaction', function () {
    return view('viewTransaction');
});

Route::get('/', [BlockController::class, 'main'])->name('main');
Route::get('/pages', [BlockController::class, 'prevMain'])->name('main.prev');
// Route::get('/{prevPage}', [BlockController::class, 'prevPage'])->name('main.previous');
// Route::post('/', [BlockController::class, 'prevPage'])->name('main.previous');
Route::get('/viewBlock/{blockHash}', [BlockController::class, 'viewBlock'])->name('viewBlock');
Route::get('/viewTransaction', [BlockController::class, 'viewTxn'])->name('viewTransaction');
