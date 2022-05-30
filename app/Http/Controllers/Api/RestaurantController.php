<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index(Request $request){
        $limit = 4;
        $restaurants  = Restaurant::with('images')->limit($limit)->offset($request['page'] * $limit)->get();
        return response()->json([
            'status' => true,
            'message' => 'Show Restaurants',
            'data' => $restaurants,
        ]);
    }
    public function show($id){
        $restaurant  = Restaurant::with('images')->findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Show Restaurant ' . $restaurant->id,
            'data' => $restaurant,
        ]);
    }

}
