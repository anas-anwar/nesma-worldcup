<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
class HotelController extends Controller
{
    public function index(){
        $hotels  = Hotel::with('Images')->with('Services')->get();
        return response()->json([
            'status' => 200,
            'message' => 'Show Hotels',
            'data' => $hotels,
        ]);
    }
    public function show($id){
        $hotel  = Hotel::with('Services')->with('Room')->with('Images')->findOrFail($id);
        return response()->json([
            'status' => 200,
            'message' => 'Show Hotel' . $hotel->id,
            'data' => $hotel,
        ]);
    }
}
