<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
class HotelController extends Controller
{
    public function index(){
        $hotels  = Hotel::with('Images')->get();
        return response()->json($hotels);
    }
    public function show($id){
        $hotel  = Hotel::with('Services')->with('Room')->with('Images')->findOrFail($id);
        return response()->json($hotel);
    }
}
