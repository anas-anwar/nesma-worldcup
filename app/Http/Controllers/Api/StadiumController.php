<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stadium;

class StadiumController extends Controller
{
    public function index(Request $request){
        $limit = 4;
        $stadiums  = Stadium::with('images')->limit($limit)->offset($request['page'] * $limit)->get();
        return response()->json([
            'status' => true,
            'message' => 'Show stadium',
            'data' => $stadiums,
        ]);
    }
    public function show($id){
        $stadium  = Stadium::with('images')->findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Show Stadium ' . $stadium->id,
            'data' => $stadium,
        ]);
    }
}

