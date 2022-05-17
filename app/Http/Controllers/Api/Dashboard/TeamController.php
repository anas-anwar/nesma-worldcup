<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::with('LineUp')->with('Event')->with('Stadium')->with('Groups')->get();
        return response()->json([
            'status' => 200,
            'message' => 'Show Teams',
            'data' => $teams,
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
            'name' => 'required|string',
            'logo' => 'required',
            'shirtcolor' => 'required',
            'stadium_id' => 'required',
            'group_id' => 'required',
        ]);

        if($request->hasFile('logo')){
            $image = $request->file('logo');
            $path = 'public/TeamLogoImages/';
            $name = time()+rand(1, 10000000000) . '.' . $image->getClientOriginalExtension();
            Storage::disk('local')->put($path.$name , file_get_contents($image));
            Storage::disk('local')->exists($path.$name);
        };

        $team = new Team();
        $team->name = $request['name'];
        $team->logo = $path.$name;
        $team->shirtcolor = $request['shirtcolor'];
        $team->stadium_id = $request['stadium_id'];
        $team->group_id = $request['group_id'];
        $result = $team->save();

        if ($result){
            $status = true;
            $message = "Team Added Successfully";
            $data = $result;
        }else{
            $status = false;
            $message = "Team didn't Add Successfully";
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
        $team = Team::with('LineUp')->with('Event')->with('Stadium')->with('Groups')->findOrFail($id);
        return response()->json([
            'status' => 200,
            'message' => 'Show Team ' . $team->id,
            'data' => $team,
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
            'name' => 'required|string',
            'logo' => 'required',
            'shirtcolor' => 'required',
            'stadium_id' => 'required',
            'group_id' => 'required',
        ]);

        if($request->hasFile('logo')){
            $image = $request->file('logo');
            $path = 'public/TeamLogoImages/';
            $name = time()+rand(1, 10000000000) . '.' . $image->getClientOriginalExtension();
            Storage::disk('local')->put($path.$name , file_get_contents($image));
            Storage::disk('local')->exists($path.$name);
        };

        $team = Team::with('LineUp')->with('Event')->with('Stadium')->with('Groups')->findOrFail($id);

        $team->name = $request['name'];
        $team->logo = $path.$name;
        $team->shirtcolor = $request['shirtcolor'];
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
            'status'=> true,
            'message' => 'Team deleted Successfully',
            'data'=> $result
        ]);
    }
}
