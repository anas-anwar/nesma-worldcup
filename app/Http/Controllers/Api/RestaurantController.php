<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index(){
        $restaurants  = Restaurant::with('Images')->with('Services')->get();
        return response()->json([
            'status' => 200,
            'message' => 'Show Restaurants',
            'data' => $restaurants,
        ]);
    }
    public function show($id){
        $restaurant  = Restaurant::with('Images')->with('Services')->findOrFail($id);
        return response()->json([
            'status' => 200,
            'message' => 'Show Restaurant ' . $restaurant->id,
            'data' => $restaurant,
        ]);
    }

}
