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

Route::post('/login', [Api\AuthController::class, 'login']);
Route::post('/signup', [Api\AuthController::class, 'signup']);

// Route::middleware('auth:sanctum')->group(function () {
    Route::post('/remove_account', [Api\AuthController::class, 'remove_account']);
// });
//-------------------------------- Dashboard --------------------------------
// Route::middleware('auth:sanctum')->group(function () {
//------------------------ Hotel ------------------------     
Route::get('/dashboard/hotels', [Api\Dashboard\HotelController::class, 'index']);
Route::Post('/dashboard/add/hotel', [Api\Dashboard\HotelController::class, 'store']);
Route::put('/dashboard/edit/hotel/{id}', [App\Http\Controllers\Api\Dashboard\HotelController::class, 'update']);
Route::Post('/dashboard/add_room/hotel/{id}', [App\Http\Controllers\Api\Dashboard\HotelController::class, 'add_room']);
Route::Post('/dashboard/add_image/hotel/{id}', [App\Http\Controllers\Api\Dashboard\HotelController::class, 'add_image']);
Route::get('/dashboard/show/hotel/{id}', [App\Http\Controllers\Api\Dashboard\HotelController::class, 'show']);
Route::delete('/dashboard/destroy/hotel/{id}', [App\Http\Controllers\Api\Dashboard\HotelController::class, 'destroy']);

//------------------------ Restaurant ------------------------
Route::get('/dashboard/restaurants', [App\Http\Controllers\Api\Dashboard\RestaurantController::class, 'index']);
Route::Post('/dashboard/add/restaurant', [App\Http\Controllers\Api\Dashboard\RestaurantController::class, 'store']);
Route::put('/dashboard/edit/restaurant/{id}', [App\Http\Controllers\Api\Dashboard\RestaurantController::class, 'update']);
Route::Post('/dashboard/add_image/restaurant/{id}', [App\Http\Controllers\Api\Dashboard\RestaurantController::class, 'add_image']);
Route::get('/dashboard/show/restaurant/{id}', [App\Http\Controllers\Api\Dashboard\RestaurantController::class, 'show']);
Route::delete('/dashboard/destroy/restaurant/{id}', [App\Http\Controllers\Api\Dashboard\RestaurantController::class, 'destroy']);

//------------------------ Team ------------------------
Route::get('/dashboard/teams', [App\Http\Controllers\Api\Dashboard\TeamController::class, 'index']);
Route::Post('/dashboard/add/team', [App\Http\Controllers\Api\Dashboard\TeamController::class, 'store']);
Route::put('/dashboard/edit/team/{id}', [App\Http\Controllers\Api\Dashboard\TeamController::class, 'update']);
Route::get('/dashboard/show/team/{id}', [App\Http\Controllers\Api\Dashboard\TeamController::class, 'show']);
Route::delete('/dashboard/destroy/team/{id}', [App\Http\Controllers\Api\Dashboard\TeamController::class, 'destroy']);

//------------------------ Match ------------------------

// Route::Post('/dashboard/add/match', [App\Http\Controllers\Api\Dashboard\AllMatchController::class, 'store']);
// Route::put('/dashboard/edit/match/{id}', [App\Http\Controllers\Api\Dashboard\AllMatchController::class, 'update']);
// Route::get('/dashboard/show/match/{id}', [App\Http\Controllers\Api\Dashboard\AllMatchController::class, 'show']);
// Route::delete('/dashboard/destroy/match/{id}', [App\Http\Controllers\Api\Dashboard\AllMatchController::class, 'destroy']);


//------------------------ Stadium ------------------------
Route::get('/dashboard/stadiums', [App\Http\Controllers\Api\Dashboard\StadiumController::class, 'index']);
Route::Post('/dashboard/add/stadium', [App\Http\Controllers\Api\Dashboard\StadiumController::class, 'store']);
Route::put('/dashboard/edit/stadium/{id}', [App\Http\Controllers\Api\Dashboard\StadiumController::class, 'update']);
Route::get('/dashboard/show/stadium/{id}', [App\Http\Controllers\Api\Dashboard\StadiumController::class, 'show']);
Route::Post('/dashboard/add_image/stadium/{id}', [App\Http\Controllers\Api\Dashboard\StadiumController::class, 'add_image']);
Route::delete('/dashboard/destroy/stadium/{id}', [App\Http\Controllers\Api\Dashboard\StadiumController::class, 'destroy']);

///  LOGOUT
Route::post('/logout', [Api\AuthController::class, 'logout']);


// });
//-------------------------------- Mobile --------------------------------
Route::get('/Home', [App\Http\Controllers\Api\HomeController::class, 'index']);
Route::get('/accounts', [App\Http\Controllers\Api\HomeController::class, 'accounts']);
Route::post('/create_account', [App\Http\Controllers\Api\HomeController::class, 'create_account']);
Route::post('/Home/voting/{match_id}/{account_id}', [App\Http\Controllers\Api\HomeController::class, 'voting']);


Route::get('/allmatches', [App\Http\Controllers\Api\AllMatchesController::class, 'index']);
Route::get('/live_matches', [App\Http\Controllers\Api\MatchController::class, 'index']);
Route::get('/match/{id}/{account_id}', [App\Http\Controllers\Api\MatchController::class, 'show']);

Route::get('/stadiums', [App\Http\Controllers\Api\StadiumController::class, 'index']);
Route::get('/stadium/{id}', [App\Http\Controllers\Api\StadiumController::class, 'show']);

Route::get('/hotels', [App\Http\Controllers\Api\HotelController::class, 'index']);
Route::get('/hotel/{id}', [App\Http\Controllers\Api\HotelController::class, 'show']);
Route::post('/hotels/search', [App\Http\Controllers\Api\HotelController::class, 'search']);
Route::post('/hotels/nearHotels', [App\Http\Controllers\Api\HotelController::class, 'nearHotels']);

Route::get('/restaurants', [App\Http\Controllers\Api\RestaurantController::class, 'index']);
Route::get('/restaurant/{id}', [App\Http\Controllers\Api\RestaurantController::class, 'show']);
Route::post('/restaurants/serach', [App\Http\Controllers\Api\RestaurantController::class, 'search']);
Route::post('/restaurants/nearResturents', [App\Http\Controllers\Api\RestaurantController::class, 'nearResturents']);

Route::get('/medical_centers', [App\Http\Controllers\Api\MedicalCenterController::class, 'index']);
Route::get('/medical_center/{id}', [App\Http\Controllers\Api\MedicalCenterController::class, 'show']);
Route::post('/medical_centers/search', [App\Http\Controllers\Api\MedicalCenterController::class, 'search']);
Route::post('/medical_centers/nearMedicalCenters', [App\Http\Controllers\Api\MedicalCenterController::class, 'nearMedicalCenters']);


Route::get('/metro_stations', [App\Http\Controllers\Api\MetroStationController::class, 'index']);
Route::get('/metro_station/{id}', [App\Http\Controllers\Api\MetroStationController::class, 'show']);
Route::post('/metro_stations/search', [App\Http\Controllers\Api\MetroStationController::class, 'search']);
Route::post('/metro_stations/nearMetroStations', [App\Http\Controllers\Api\MetroStationController::class, 'nearMetroStations']);


Route::get('/touristic_places', [App\Http\Controllers\Api\TouristicPlaceController::class, 'index']);
Route::get('/touristic_place/{id}', [App\Http\Controllers\Api\TouristicPlaceController::class, 'show']);
Route::post('/touristic_places/search', [App\Http\Controllers\Api\TouristicPlaceController::class, 'search']);
Route::post('/touristic_places/nearTouristicPlaces', [App\Http\Controllers\Api\TouristicPlaceController::class, 'nearTouristicPlaces']);

Route::get('/myfavorits', [App\Http\Controllers\Api\FavoriteController::class, 'index']);
Route::post('/favorit', [App\Http\Controllers\Api\FavoriteController::class, 'add_remove']);
