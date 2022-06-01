<?php

use App\Http\Controllers\Dashboard\HotelController;
use App\Http\Controllers\Dashboard\RestaurantController;
use App\Http\Controllers\Dashboard\TeamController;
use App\Http\Controllers\Dashboard\MatchController;
use App\Http\Controllers\Dashboard\StadiumController;
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

    //------------------------ Hotel ------------------------     
Route::resource('hotels', HotelController::class);
// Route::Post('/dash/add/hotel', [HotelController::class, 'store']);
// Route::put('/dash/edit/hotel/{id}', [HotelController::class, 'update']);
// Route::get('/dash/show/hotel/{id}', [HotelController::class, 'show']);
// Route::delete('/dash/destroy/hotel/{id}', [HotelController::class, 'destroy']);
Route::Post('add_room/hotel/{id}', [HotelController::class, 'add_room']);
Route::Post('add_image/hotel/{id}', [HotelController::class, 'add_image']);

// //------------------------ Restaurant ------------------------
// Route::get('/dash/restaurants', [RestaurantController::class, 'index']);
// Route::Post('/dash/add/restaurant', [RestaurantController::class, 'store']);
// Route::put('/dash/edit/restaurant/{id}', [RestaurantController::class, 'update']);
// Route::Post('/dash/add_image/restaurant/{id}', [RestaurantController::class, 'add_image']);
// Route::get('/dash/show/restaurant/{id}', [RestaurantController::class, 'show']);
// Route::delete('/dash/destroy/restaurant/{id}', [RestaurantController::class, 'destroy']);

// //------------------------ Team ------------------------
// Route::get('/dash/teams', [TeamController::class, 'index']);
// Route::Post('/dash/add/team', [TeamController::class, 'store']);
// Route::put('/dash/edit/team/{id}', [TeamController::class, 'update']);
// Route::get('/dash/show/team/{id}', [TeamController::class, 'show']);
// Route::delete('/dash/destroy/team/{id}', [TeamController::class, 'destroy']);

// //------------------------ Match ------------------------
// Route::get('/dash/matches', [MatchController::class, 'index']);
// Route::Post('/dash/add/match', [MatchController::class, 'store']);
// Route::put('/dash/edit/match/{id}', [MatchController::class, 'update']);
// Route::get('/dash/show/match/{id}', [MatchController::class, 'show']);
// Route::delete('/dash/destroy/match/{id}', [MatchController::class, 'destroy']);


// //------------------------ Stadium ------------------------
// Route::get('/dash/stadiums', [StadiumController::class, 'index']);
// Route::Post('/dash/add/stadium', [StadiumController::class, 'store']);
// Route::put('/dash/edit/stadium/{id}', [StadiumController::class, 'update']);
// Route::get('/dash/show/stadium/{id}', [StadiumController::class, 'show']);
// Route::Post('/dash/add_image/stadium/{id}', [StadiumController::class, 'add_image']);
// Route::delete('/dash/destroy/stadium/{id}', [StadiumController::class, 'destroy']);


});
