<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//-------------------------------- Dashboard --------------------------------
Route::middleware('auth:sanctum')->group(function () {
        //------------------------ Hotel ------------------------     
        Route::get('/dashboard/hotels', [Api\Dashboard\HotelController::class , 'index']);
        Route::Post('/dashboard/add/hotel', [Api\Dashboard\HotelController::class , 'store']);
        Route::put('/dashboard/edit/hotel/{id}', [App\Http\Controllers\Api\Dashboard\HotelController::class , 'update']);
        Route::Post('/dashboard/add_room/hotel/{id}', [App\Http\Controllers\Api\Dashboard\HotelController::class , 'add_room']);
        Route::Post('/dashboard/add_image/hotel/{id}', [App\Http\Controllers\Api\Dashboard\HotelController::class , 'add_image']);
        Route::get('/dashboard/show/hotel/{id}', [App\Http\Controllers\Api\Dashboard\HotelController::class , 'show']);
        Route::delete('/dashboard/destroy/hotel/{id}', [App\Http\Controllers\Api\Dashboard\HotelController::class , 'destroy']);

        //------------------------ Restaurant ------------------------
        Route::get('/dashboard/restaurants', [App\Http\Controllers\Api\Dashboard\RestaurantController::class , 'index']);
        Route::Post('/dashboard/add/restaurant', [App\Http\Controllers\Api\Dashboard\RestaurantController::class , 'store']);
        Route::put('/dashboard/edit/restaurant/{id}', [App\Http\Controllers\Api\Dashboard\RestaurantController::class , 'update']);
        Route::Post('/dashboard/add_image/restaurant/{id}', [App\Http\Controllers\Api\Dashboard\RestaurantController::class , 'add_image']);
        Route::get('/dashboard/show/restaurant/{id}', [App\Http\Controllers\Api\Dashboard\RestaurantController::class , 'show']);
        Route::delete('/dashboard/destroy/restaurant/{id}', [App\Http\Controllers\Api\Dashboard\RestaurantController::class , 'destroy']);

        //------------------------ Team ------------------------
        Route::get('/dashboard/teams', [App\Http\Controllers\Api\Dashboard\TeamController::class , 'index']);
        Route::Post('/dashboard/add/team', [App\Http\Controllers\Api\Dashboard\TeamController::class , 'store']);
        Route::put('/dashboard/edit/team/{id}', [App\Http\Controllers\Api\Dashboard\TeamController::class , 'update']);
        Route::get('/dashboard/show/team/{id}', [App\Http\Controllers\Api\Dashboard\TeamController::class , 'show']);
        Route::delete('/dashboard/destroy/team/{id}', [App\Http\Controllers\Api\Dashboard\TeamController::class , 'destroy']);

        //------------------------ Match ------------------------
        Route::get('/dashboard/matches', [App\Http\Controllers\Api\Dashboard\MatchController::class , 'index']);
        Route::Post('/dashboard/add/match', [App\Http\Controllers\Api\Dashboard\MatchController::class , 'store']);
        Route::put('/dashboard/edit/match/{id}', [App\Http\Controllers\Api\Dashboard\MatchController::class , 'update']);
        Route::get('/dashboard/show/match/{id}', [App\Http\Controllers\Api\Dashboard\MatchController::class , 'show']);
        Route::delete('/dashboard/destroy/match/{id}', [App\Http\Controllers\Api\Dashboard\MatchController::class , 'destroy']);


        //------------------------ Stadium ------------------------
        Route::get('/dashboard/stadiums', [App\Http\Controllers\Api\Dashboard\StadiumController::class , 'index']);
        Route::Post('/dashboard/add/stadium', [App\Http\Controllers\Api\Dashboard\StadiumController::class , 'store']);
        Route::put('/dashboard/edit/stadium/{id}', [App\Http\Controllers\Api\Dashboard\StadiumController::class , 'update']);
        Route::get('/dashboard/show/stadium/{id}', [App\Http\Controllers\Api\Dashboard\StadiumController::class , 'show']);
        Route::Post('/dashboard/add_image/stadium/{id}', [App\Http\Controllers\Api\Dashboard\StadiumController::class , 'add_image']);
        Route::delete('/dashboard/destroy/stadium/{id}', [App\Http\Controllers\Api\Dashboard\StadiumController::class , 'destroy']);
});
//-------------------------------- Mobile --------------------------------
Route::get('/Home', [App\Http\Controllers\Api\HomeController::class , 'index']);
Route::post('/Home/voting/{account_id}/{match_id}', [App\Http\Controllers\Api\HomeController::class , 'voting']);

Route::get('/live_matches', [App\Http\Controllers\Api\MatchController::class , 'index']);

Route::get('/stadiums', [App\Http\Controllers\Api\StadiumController::class , 'index']);
Route::get('/stadium/{id}', [App\Http\Controllers\Api\StadiumController::class , 'show']);

Route::get('/hotels', [App\Http\Controllers\Api\HotelController::class , 'index']);
Route::get('/hotel/{id}', [App\Http\Controllers\Api\HotelController::class , 'show']);

Route::get('/restaurants', [App\Http\Controllers\Api\RestaurantController::class , 'index']);
Route::get('/restaurant/{id}', [App\Http\Controllers\Api\RestaurantController::class , 'show']);