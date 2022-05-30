<?php

use App\Http\Controllers\Dashboard\HotelController;
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

// Route::get('/dashboard', function () {
//     // return view('welcome');
//     return view('dashboard.index');
// });

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dash', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::get('/dash/hotels', [HotelController::class, 'index']);
});
