<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $restaurants  = Restaurant::with('Images')->get();
        return response()->json([
            'status' => true,
            'message' => 'Show Restaurants',
            'data' => $restaurants,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required',
            'rate' => 'required|max:10|min:1|numeric',
            'hour_open' => 'required',
            'hour_close' => 'required',
            'latitude' => 'required|numeric|min:-90|max:90',
            'longtude' => 'required|numeric|min:-180|max:180',
            'address' => 'required|string',
            'services' => 'required'
        ]);

        $restaurant = new Restaurant();
        $restaurant->name = $request['name'];
        $restaurant->phone = $request['phone'];
        $restaurant->rate = $request['rate'];
        $restaurant->hour_open = $request['hour_open'];
        $restaurant->hour_close = $request['hour_close'];
        $restaurant->latitude = $request['latitude'];
        $restaurant->longtude = $request['longtude'];
        $restaurant->address = $request['address'];
        $restaurant->address = $request['services'];
        $result = $restaurant->save();

        if ($result){
            $status = true;
            $info = "Restaurant Added Successfully";
            $data = $result;
        }else{
            $status = false;
            $info = "Restaurant didn't Add Successfully";
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
    public function show($id){
        $restaurant  = Restaurant::with('Images')->findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Show Restaurant ' . $restaurant->id,
            'data' => $restaurant,
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $request->validate([
            'name' => 'required|string',
            'phone' => 'required',
            'rate' => 'required|max:10|min:1|numeric',
            'hour_open' => 'required',
            'hour_close' => 'required',
            'latitude' => 'required|numeric|min:-90|max:90',
            'longtude' => 'required|numeric|min:-180|max:180',
            'address' => 'required|string',
            'services' => 'required'
        ]);

        $restaurant  = Restaurant::with('Images')->findOrFail($id);
        
        $restaurant->name = $request['name'];
        $restaurant->phone = $request['phone'];
        $restaurant->rate = $request['rate'];
        $restaurant->hour_open = $request['hour_open'];
        $restaurant->hour_close = $request['hour_close'];
        $restaurant->latitude = $request['latitude'];
        $restaurant->longtude = $request['longtude'];
        $restaurant->address = $request['address'];
        $restaurant->address = $request['services'];
        $result = $restaurant->save();

        if ($result){
            $status = true;
            $info = "Restaurant Updated Successfully";
            $data = $result;
        }else{
            $status = false;
            $info = "Restaurant didn't Update Successfully";
            $data = false;
        }
        return response()->json([
            'status' => $status, 
            'info' => $info, 
            'data' => $data
        ]);
    }


    public function add_image(Request $request, $id){
        $request->validate([
            'url' => 'required',
        ]);

        if($request->hasFile('url')){
            $image = $request->file('url');
            $path = 'public/RestaurantsImages/';
            $name = time()+rand(1, 10000000000) . '.' . $image->getClientOriginalExtension();
            Storage::disk('local')->put($path.$name , file_get_contents($image));
            Storage::disk('local')->exists($path.$name);
        };

        $image = new Image();
        $image->image_url = $path.$name;
        $image->name = $name;
        $image->model_type = "App\Models\Restaurant";
        $image->model_id = $id;
        $result = $image->save();

        if ($result){
            $status = true;
            $message = "Images Added to Restaurant Successfully";
            $data = $result;
        }else{
            $status = false;
            $message = "Images didn't Add to Restaurant Successfully";
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
    public function destroy($id){
        $result = Restaurant::findOrFail($id)->delete();
        return response()->json([
            'status'=> true,
            'message' => 'Restaurant deleted Successfully',
            'data'=> $result
        ]);
    }
}
