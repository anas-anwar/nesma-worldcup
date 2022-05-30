<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
class HotelController extends Controller
{
    public function index(Request $request){

        $limit = 4;
        $hotels  = Hotel::with('images')->limit($limit)->offset($request['page'] * $limit)->get();
        return response()->json([
            'status' => true,
            'message' => 'Show Hotels',
            'data' => $hotels,
        ]);
    }
    public function show( $id){
        $hotel  = Hotel::with('rooms')->with('images')->findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Show Hotel' . $hotel->id,
            'data' => $hotel,
        ]);
    }
}
