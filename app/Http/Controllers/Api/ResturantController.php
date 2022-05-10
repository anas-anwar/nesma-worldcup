<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index(){
        $restaurants  = Restaurant::with('Services')->with('Images')->get();
        return response()->json($restaurants);
    }
    public function show($id){
        $restaurant  = Restaurant::with('Services')->with('Images')->findOrFail($id);
        return response()->json($restaurant);
    }
}
