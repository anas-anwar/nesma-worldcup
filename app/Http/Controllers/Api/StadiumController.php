<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stadium;

class StadiumController extends Controller
{
    public function index(){
        $stadiums  = Stadium::with('Images')->get();
        return response()->json($stadiums);
    }
    public function show($id){
        $stadium  = Stadium::with('Images')->findOrFail($id);
        return response()->json($stadium);
    }
}

