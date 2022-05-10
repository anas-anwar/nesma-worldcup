<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// ------------ Mobile ------------
use App\Http\Controllers\Api\StadiumController;
// use App\Http\Controllers\Api\HotelController;
use App\Http\Controllers\Api\RestaurantController;
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
        //------------------------ Hotel ------------------------     
Route::get('/dashboard/hotels', [App\Http\Controllers\Api\Dashboard\HotelController::class , 'index']);
Route::Post('/dashboard/add/hotel', [App\Http\Controllers\Api\Dashboard\HotelController::class , 'store']);
Route::Post('/dashboard/edit/hotel', [App\Http\Controllers\Api\Dashboard\HotelController::class , 'update']);
Route::Post('/dashboard/add_services/hotel', [App\Http\Controllers\Api\Dashboard\HotelController::class , 'add_services']);
Route::Post('/dashboard/add_rooms/hotel', [App\Http\Controllers\Api\Dashboard\HotelController::class , 'add_rooms']);
Route::get('/dashboard/show/hotel/{id}', [App\Http\Controllers\Api\Dashboard\HotelController::class , 'show']);
Route::delete('/dashboard/destroy/hotel/{id}', [App\Http\Controllers\Api\Dashboard\HotelController::class , 'destroy']);

        //------------------------ Restaurant ------------------------
Route::get('/dashboard/resturant', [App\Http\Controllers\Api\Dashboard\RestaurantController::class , 'index']);
Route::Post('/dashboard/add/resturant', [App\Http\Controllers\Api\Dashboard\RestaurantController::class , 'store']);
Route::Post('/dashboard/edit/resturant', [App\Http\Controllers\Api\Dashboard\RestaurantController::class , 'update']);
Route::Post('/dashboard/add_services/resturant', [App\Http\Controllers\Api\Dashboard\RestaurantController::class , 'add_services']);
Route::get('/dashboard/show/resturant/{id}', [App\Http\Controllers\Api\Dashboard\RestaurantController::class , 'show']);
Route::delete('/dashboard/destroy/resturant/{id}', [App\Http\Controllers\Api\Dashboard\RestaurantController::class , 'destroy']);

        //------------------------ Team ------------------------
Route::get('/dashboard/team', [App\Http\Controllers\Api\Dashboard\TeamController::class , 'index']);
Route::Post('/dashboard/add/team', [App\Http\Controllers\Api\Dashboard\TeamController::class , 'store']);
Route::Post('/dashboard/edit/team', [App\Http\Controllers\Api\Dashboard\TeamController::class , 'update']);
Route::get('/dashboard/show/team/{id}', [App\Http\Controllers\Api\Dashboard\TeamController::class , 'show']);
Route::delete('/dashboard/destroy/team/{id}', [App\Http\Controllers\Api\Dashboard\TeamController::class , 'destroy']);


//-------------------------------- Mobile --------------------------------
Route::get('/stadiums', [App\Http\Controllers\Api\StadiumController::class , 'index']);
Route::get('/stadium/{id}', [App\Http\Controllers\Api\StadiumController::class , 'show']);

Route::get('/hotels', [App\Http\Controllers\Api\HotelController::class , 'index']);
Route::get('/hotel/{id}', [App\Http\Controllers\Api\HotelController::class , 'show']);

Route::get('/restaurants', [App\Http\Controllers\Api\RestaurantController::class , 'index']);
Route::get('/restaurant/{id}', [App\Http\Controllers\Api\RestaurantController::class , 'show']);