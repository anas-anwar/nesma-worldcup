<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::with('MatchRelation')->with('LineUp')->with('LineUp.Matches')->with('Event')->with('Players')->with('Stadium')->with('Groups')->get();
        return response()->json($teams);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $team = new Team();
        $team->name = $request['name'];
        $team->logo = $request['logo'];
        $team->shirtcolor = $request['shirtcolor'];
        $team->player_id = $request['player_id'];
        $team->stadium_id = $request['stadium_id'];
        $team->group_id = $request['group_id'];
        $result = $team->save();

        if ($result){
            $status = true;
            $info = "Team Added Successfully";
            $data = $result;
        }else{
            $status = false;
            $info = "Team didn't Add Successfully";
            $data = false;
        }
        return response()->json([
            'status' => $status, 
            'info' => $info, 
            'data' => $data]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team = Team::with('MatchRelation')->with('LineUp')->with('LineUp.Matches')->with('Event')->with('Players')->with('Stadium')->with('Groups')->findORFail($id);
        return response()->json($team);
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
        $team = Team::with('MatchRelation')->with('LineUp')->with('LineUp.Matches')->with('Event')->with('Players')->with('Stadium')->with('Groups')->findORFail($id);

        $team->name = $request['name'];
        $team->logo = $request['logo'];
        $team->shirtcolor = $request['shirtcolor'];
        $team->player_id = $request['player_id'];
        $team->stadium_id = $request['stadium_id'];
        $team->group_id = $request['group_id'];
        $result = $team->save();
        
        if ($result){
            $status = true;
            $info = "Team Updated Successfully";
            $data = $result;
        }else{
            $status = false;
            $info = "Team didn't Update Successfully";
            $data = false;
        }
        return response()->json([
            'status' => $status, 
            'info' => $info, 
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
        $result = Team::findOrFail($id)->delete();
        return response()->json([
            'success'=> true,
            'result'=> $result
        ]);
    }
}
