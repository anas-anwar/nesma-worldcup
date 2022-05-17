<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MatchModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MatchController extends Controller
{
    public function index(){

        $current_time = Carbon::now();

        $Live_match = MatchModel::with('LineUp')->with('LineUp.Teams')->with('LineUp.Players')
                ->with('Event')->with('Event.Teams')->with('Event.TypeOfEvents')
                ->with('Rounds')
                ->with('LocalTeam')
                ->with('VisitorTeam')
                ->with('Stadiums')
                ->where(function ($query) use ($current_time){
                    $query->where('date', $current_time->toDateString());
                    $query->where('start', '<=' ,$current_time->toTimeString());
                    $query->where('end', '>=' , $current_time->toTimeString());
                })
                ->get();
        
        return response()->json([
            'status' => 200,
            'message' => 'Show Matches',
            'data' => [
                'Live Matches' => $Live_match
            ],
        ]);
    }

    public function show($id){
        $match = MatchModel::with('LineUp')->with('Event')->with('Rounds')->with('LocalTeams')->with('VisitorTeam')->with('Stadiums')->findOrFail($id);
        return response()->json([
            'status' => 200,
            'message' => 'Show Match' . $match->id,
            'data' => $match,
        ]);
    }
}