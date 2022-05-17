<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MatchModel;

class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matches = MatchModel::with('Rounds')->with('Stadiums')->with('LocalTeam')->with('VisitorTeam')->get();
        return response()->json([
            'status' => 200,
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
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'start' => 'required|time',
            'end' => 'required|time',
            'round_id' => 'required',
            'stadium_id' => 'required',
            'localteam_id' => 'required',
            'visitorteam_id' => 'required',
        ]);
        
        $match = new MatchModel();
        $match->date = $request['date'];
        $match->start = $request['start'];
        $match->end = $request['end'];
        $match->round_id = $request['round_id'];
        $match->stadium_id = $request['stadium_id'];
        $match->localteam_id = $request['localteam_id'];
        $match->visitorteam_id = $request['visitorteam_id'];
        $result = $match->save();

        if ($result){
            $status = true;
            $message = "Match Added Successfully";
            $data = $result;
        }else{
            $status = false;
            $message = "Match didn't Add Successfully";
            $data = false;
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $match = MatchModel::with('Rounds')->with('Stadiums')->with('LocalTeam')->with('VisitorTeam')->findOrFail($id);
        return response()->json([
            'status' => 200,
            'message' => 'Show Match '. $match->id,
            'data' => $match,
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'start' => 'required|time',
            'end' => 'required|time',
            'round_id' => 'required',
            'stadium_id' => 'required',
            'localteam_id' => 'required',
            'visitorteam_id' => 'required',
        ]);

        $match = MatchModel::with('Rounds')->with('Stadiums')->with('LocalTeam')->with('VisitorTeam')->findOrFail($id);
        
        $match->date = $request['date'];
        $match->start = $request['start'];
        $match->end = $request['end'];
        $match->round_id = $request['round_id'];
        $match->stadium_id = $request['stadium_id'];
        $match->localteam_id = $request['localteam_id'];
        $match->visitorteam_id = $request['visitorteam_id'];
        $result = $match->save();

        if ($result){
            $status = true;
            $message = "Match Updated Successfully";
            $data = $result;
        }else{
            $status = false;
            $message = "Match didn't Update Successfully";
            $data = false;
        }
        return response()->json([
            'status' => $status, 
            'message' => $message, 
            'data' => $data]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = MatchModel::findOrFail($id)->delete();
        return response()->json([
            'status'=> true,
            'message' => 'Match deleted Successfully',
            'data'=> $result
        ]);
    }
}
