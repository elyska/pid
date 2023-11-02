<?php

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
    return view('welcome', [
        "locations" => []
    ]);
});
Route::post('/update-data', [App\Http\Controllers\GeneralController::class, 'updateData'])->name('update-data');
Route::get('/open-now', [App\Http\Controllers\GeneralController::class, 'openNow'])->name('open-now');
Route::post('/open-at', [App\Http\Controllers\GeneralController::class, 'openAt'])->name('open-at');

Route::get('/open-at', function () {
    return view('welcome', [
        "locations" => []
    ]);
});
Route::get('/all', [App\Http\Controllers\GeneralController::class, 'allLocations'])->name('all');
