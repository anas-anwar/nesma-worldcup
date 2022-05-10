<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stadium;

class StadiumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stadiums = Stadium::with('Team')->with('Images')->get();
        return response()->json($stadiums);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stadium = new Stadium();
        $stadium->name = $request['name'];
        $stadium->description = $request['description'];
        $stadium->phone = $request['phone'];
        $stadium->capacity = $request['capacity'];
        $stadium->address = $request['address'];
        $stadium->longtude = $request['longtude'];
        $stadium->lattude = $request['lattude'];
        $stadium->images_id = $request['images_id'];
        $result = $stadium->save();

        if ($result){
            $status = true;
            $info = "Stadium Added Successfully";
            $data = $result;
        }else{
            $status = false;
            $info = "Stadium didn't Add Successfully";
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
        $stadium = Stadium::with('Team')->with('Images')->FindOrFail($id);
        return response()->json($stadium);
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
        $stadium = Stadium::with('Team')->with('Images')->FindOrFail($id);

        $stadium->name = $request['name'];
        $stadium->description = $request['description'];
        $stadium->phone = $request['phone'];
        $stadium->capacity = $request['capacity'];
        $stadium->address = $request['address'];
        $stadium->longtude = $request['longtude'];
        $stadium->lattude = $request['lattude'];
        $stadium->images_id = $request['images_id'];
        $result = $stadium->save();

        if ($result){
            $status = true;
            $info = "Stadium Updated Successfully";
            $data = $result;
        }else{
            $status = false;
            $info = "Stadium didn't Update Successfully";
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
        $result = Stadium::findOrFail($id)->delete();
        return response()->json([
            'success'=> true,
            'result'=> $result
        ]);
    }
}
