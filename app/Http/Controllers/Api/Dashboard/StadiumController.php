<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Stadium;
use Illuminate\Support\Facades\Storage;

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
        return response()->json([
            'status' => 200,
            'message' => 'Show Stadiums',
            'data' => $stadiums,
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
            'description' => 'required',
            'phone' => 'required',
            'capacity' => 'required|numeric',
            'address' => 'required|string',
            'lattude' => 'required|numeric|min:-90|max:90',
            'longtude' => 'required|numeric|min:-180|max:180',
        ]);

        $stadium = new Stadium();
        $stadium->name = $request['name'];
        $stadium->description = $request['description'];
        $stadium->phone = $request['phone'];
        $stadium->capacity = $request['capacity'];
        $stadium->address = $request['address'];
        $stadium->longtude = $request['longtude'];
        $stadium->lattude = $request['lattude'];
        $result = $stadium->save();

        if ($result){
            $status = true;
            $message = "Stadium Added Successfully";
            $data = $result;
        }else{
            $status = false;
            $message = "Stadium didn't Add Successfully";
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
        $stadium = Stadium::with('Team')->with('Images')->FindOrFail($id);
        return response()->json([
            'status' => 200,
            'message' => 'Show Stadium ' . $stadium->id,
            'data' => $stadium,
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
            'description' => 'required',
            'phone' => 'required',
            'capacity' => 'required',
            'address' => 'required|string',
            'lattude' => 'required|numeric|min:-90|max:90',
            'longtude' => 'required|numeric|min:-180|max:180',
        ]);

        $stadium = Stadium::with('Team')->with('Images')->FindOrFail($id);

        $stadium->name = $request['name'];
        $stadium->description = $request['description'];
        $stadium->phone = $request['phone'];
        $stadium->capacity = $request['capacity'];
        $stadium->address = $request['address'];
        $stadium->longtude = $request['longtude'];
        $stadium->lattude = $request['lattude'];
        $result = $stadium->save();

        if ($result){
            $status = true;
            $message = "Stadium Updated Successfully";
            $data = $result;
        }else{
            $status = false;
            $message = "Stadium didn't Update Successfully";
            $data = false;
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ]);

    }

    public function add_image(Request $request, $id){
        $request->validate([
            'url' => 'required',
        ]);

        if($request->hasFile('url')){
            $image = $request->file('url');
            $path = 'public/StadiumsImages/';
            $name = time()+rand(1, 10000000000) . '.' . $image->getClientOriginalExtension();
            Storage::disk('local')->put($path.$name , file_get_contents($image));
            Storage::disk('local')->exists($path.$name);
        };

        $image = new Image();
        $image->url = $path.$name;
        $image->file_name = $name;
        $image->model_type = "App\Models\Stadium";
        $image->model_id = $id;
        $result = $image->save();

        if ($result){
            $status = 200;
            $message = "Images Added to Stadium Successfully";
            $data = $result;
        }else{
            $status = false;
            $message = "Images didn't Add to Stadium Successfully";
            $data = $result;
        }
        return response()->json([
            'status' => $status, 
            'message' => $message, 
            'data' => $data
        ]);
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
            'status'=> true,
            'message' => 'Stadium deleted Successfully',
            'data'=> $result
        ]);
    }
}
