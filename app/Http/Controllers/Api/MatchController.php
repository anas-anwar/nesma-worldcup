<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MatchModel;
use Carbon\Carbon;

class MatchController extends Controller
{
    public function index(){
        $matches = MatchModel::with('LineUp')->with('Event')->with('Rounds')->with('LocalTeams')->with('VisitorTeam')->with('Stadiums')->get();
        
        return response()->json($matches);
    }

    public function show(){
        $matches = MatchModel::with('LineUp')->with('Event')->with('Rounds')->with('LocalTeams')->with('VisitorTeam')->with('Stadiums')->get();
        return response()->json($matches);
    }
}
