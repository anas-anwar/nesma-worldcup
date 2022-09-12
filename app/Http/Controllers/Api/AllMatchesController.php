<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MatchModel;
use Carbon\Carbon;
class AllMatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       //$date=(new Carbon($current_time_c))->format('Y-m-d H:i:s');
        $limit = 4;

        $matches = MatchModel::
        with([ 'localTeam', 'visitorTeam','round'])
     // with([ 'localTeam', 'visitorTeam','winnerTeam','event'])
        ->orderBy('date_time','asc')
        ->get();
        foreach($matches as $key => $match){
            $matches[$key]["status"] = "";
                $date_s = Carbon::createFromFormat('Y-m-d  H:i:s',$match->date_time);
                $date_e = $date_s->addMinutes(90);
                $current_time = Carbon::now();
       
                $matches[$key]["status"] = ($date_s->lt($current_time) ? "0" : 
        ($date_e->gt($current_time) ? "2" : "1"));
           
        }
        $matches = $matches->groupBy(function($data) {
            return $data->date_time->format('Y-m-d');
        });

        return response()->json([
            'status' => true,
            'message' => 'Show Matches',
            'data' => $matches,
           
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
}
