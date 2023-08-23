<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TravelController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('happy_travel', TravelController::class);

Route::get('/search', [TravelController::class, 'search'])->name('travel.search');

Route::middleware(['auth'])->group(function () {
    Route::get('/travel/{id}', 'TravelController@show')->name('travel.show');
});


