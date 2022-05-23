<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
class HotelController extends Controller
{
    public function index(){
        $hotels  = Hotel::with('Images')->get();
        return response()->json([
            'status' => true,
            'message' => 'Show Hotels',
            'data' => $hotels,
        ]);
    }
    public function show($id){
        $hotel  = Hotel::with('Room')->with('Images')->findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Show Hotel' . $hotel->id,
            'data' => $hotel,
        ]);
    }
}
