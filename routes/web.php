<?php

use App\Http\Controllers\HashController;
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
Route::middleware(['throttle:web'])->group(function () {
    Route::post('hash/build', [HashController::class, 'build'])->name('hash/build');
});

Route::get('hash/generated/{number?}', [HashController::class, 'generated'])->name('hash/generated');