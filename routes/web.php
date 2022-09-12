<?php

use App\Http\Controllers\Api\Dashboard\StadiumController as DashboardStadiumController;
use App\Http\Controllers\Dashboard\HotelController;
use App\Http\Controllers\Dashboard\RestaurantController;
use App\Http\Controllers\Dashboard\TeamController;
use App\Http\Controllers\Dashboard\MatchController;
use App\Http\Controllers\Dashboard\MedicalCenterController;
use App\Http\Controllers\Dashboard\MetroStationController;
use App\Http\Controllers\Dashboard\ServiceController;
use App\Http\Controllers\Dashboard\StadiumController;
use App\Http\Controllers\Dashboard\TouristicPlaceController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
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
Route::get('/alogout', function () {
    return Auth::logout();
});

// Route::get('/dashboard', function () {
//     // return view('welcome');
//     return view('dashboard.index');
// });

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dash', function () {
        return view('dashboard.index');
    })->name('dashboard');

    // //------------------------ Restaurant ------------------------
    Route::middleware('auth')->group(
        function () {
            //------------------------ Services ------------------------     
            Route::resource('services', ServiceController::class);

            //------------------------ Hotel ------------------------     
            Route::resource('hotels', HotelController::class);
            //------------------------ Hotel Rooms ------------------------
            Route::get('hotels/room/{id}', [HotelController::class, 'add_room']);
            Route::Post('hotels/room/{id}', [HotelController::class, 'store_room']);
            Route::get('hotels/editroom/{id}', [HotelController::class, 'edit_room']);
            Route::Post('hotels/updateroom/{id}', [HotelController::class, 'update_room']);
            Route::delete('hotels/deleteroom/{id}', [HotelController::class, 'delete_room']);
            //------------------------ Hotel Services ------------------------
            Route::get('hotels/service/{id}', [HotelController::class, 'add_service']);
            Route::Post('hotels/service/{id}', [HotelController::class, 'store_service']);
            Route::delete('hotels/deleteservice/{id}', [HotelController::class, 'delete_service']);
            //------------------------ Hotel Images ------------------------
            Route::get('hotels/addImages/{id}', [HotelController::class, 'addImages']);
            Route::post('hotels/storeImages/{id}', [HotelController::class, 'storeImages']);
            Route::delete('hotels/deleteImage/{id}', [HotelController::class, 'deleteImage']);

            ////////////////////// Restaurant ///////////////////////////////////

            Route::resource('resturents', RestaurantController::class);
            Route::get('resturents/addImages/{id}', [RestaurantController::class, 'addImages'])->name('resturent.addImages');
            Route::post('resturents/storeImages/{id}', [RestaurantController::class, 'storeImages'])->name('resturent.storeImages');
            Route::delete('resturents/deleteImage/{id}', [RestaurantController::class, 'deleteImage'])->name('resturent.deleteImage');
            Route::get('resturents/addServicese/{id}', [RestaurantController::class, 'addServicese'])->name('resturent.addServicese');
            Route::post('resturents/storeServicese/{id}', [RestaurantController::class, 'storeServicese'])->name('resturent.storeServicese');
            Route::delete('resturents/deleteservice/{id}', [RestaurantController::class, 'deleteServicese'])->name('resturent.deleteServicese');

            /////////////////////////stadiums//////////////////////////////////////////////////////////////////////////////////////////////////
            Route::resource('stadiums', StadiumController::class);
            Route::get('stadiums/addImages/{id}', [StadiumController::class, 'addImages'])->name('stadium.addImages');
            Route::post('stadiums/storeImages/{id}', [StadiumController::class, 'storeImages'])->name('stadium.storeImages');
            Route::delete('stadiums/deleteImage/{id}', [StadiumController::class, 'deleteImage'])->name('stadium.deleteImage');
            ////////////////////////////teams//////////////////////////////////////////////////////////////////////////////
            Route::resource('teams', TeamController::class);
            Route::get('teams/addPlayer/{id}', [TeamController::class, 'addPlayer'])->name('team.addPlayer');
            Route::get('teams/editPlayer/{id}', [TeamController::class, 'editPlayer'])->name('team.editPlayer');
            Route::put('teams/updatePlayer/{id}', [TeamController::class, 'UpdatePlayer'])->name('team.updatePlayer');
            Route::post('teams/storePlayer/{id}', [TeamController::class, 'storePlayer'])->name('team.storePlayer');
            Route::delete('teams/deletePlayer/{id}', [TeamController::class, 'deletePlayer'])->name('team.deletePlayer');
            ///////////////////////////matches///////////////////////////////////////////////////////////////////////////
            Route::resource('matches', MatchController::class);

            Route::get('matches/addEvent/{id}', [MatchController::class, 'addEvent'])->name('matche.addEvent');
            Route::post('matches/storeEvent/{id}', [MatchController::class, 'storeEvent'])->name('matche.storeEvent');
            Route::get('matches/editEvent/{id}', [MatchController::class, 'editEvent'])->name('matche.editEvent');
            Route::put('matches/updateEvent/{id}', [MatchController::class, 'updateEvent'])->name('matche.updateEvent');
            Route::delete('matches/deleteEvent/{id}', [MatchController::class, 'deleteEvent'])->name('matche.deleteEvent');

            ////////////////////// MedicalCenters ///////////////////////////////////

            Route::resource('medicalcenters', MedicalCenterController::class);
            Route::get('medicalcenters/addImages/{id}', [MedicalCenterController::class, 'addImages'])->name('medicalcenters.addImages');
            Route::post('medicalcenters/storeImages/{id}', [MedicalCenterController::class, 'storeImages'])->name('medicalcenters.storeImages');
            Route::delete('medicalcenters/deleteImage/{id}', [MedicalCenterController::class, 'deleteImage'])->name('medicalcenters.deleteImage');

            ////////////////////// MetroStation ///////////////////////////////////

            Route::resource('metrostations', MetroStationController::class);
            Route::get('metrostations/addImages/{id}', [MetroStationController::class, 'addImages'])->name('metrostations.addImages');
            Route::post('metrostations/storeImages/{id}', [MetroStationController::class, 'storeImages'])->name('metrostations.storeImages');
            Route::delete('metrostations/deleteImage/{id}', [MetroStationController::class, 'deleteImage'])->name('metrostations.deleteImage');

            ////////////////////// TouristicPlace ///////////////////////////////////

            Route::resource('touristicplaces', TouristicPlaceController::class);
            Route::get('touristicplaces/addImages/{id}', [TouristicPlaceController::class, 'addImages'])->name('touristicplaces.addImages');
            Route::post('touristicplaces/storeImages/{id}', [TouristicPlaceController::class, 'storeImages'])->name('touristicplaces.storeImages');
            Route::delete('touristicplaces/deleteImage/{id}', [TouristicPlaceController::class, 'deleteImage'])->name('touristicplaces.deleteImage');
        }

    );
});
