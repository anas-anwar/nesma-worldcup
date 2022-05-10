<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $restaurants  = Restaurant::with('Services')->with('Images')->get();
        return response()->json($restaurants);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $restaurant = new Restaurant();
        $restaurant->name = $request['name'];
        $restaurant->phone = $request['phone'];
        $restaurant->rate = $request['rate'];
        $restaurant->hour_open = $request['hour_open'];
        $restaurant->hour_close = $request['hour_close'];
        $restaurant->lattude = $request['lattude'];
        $restaurant->longtude = $request['longtude'];
        $restaurant->address = $request['address'];
        $restaurant->services_id = $request['services_id'];
        $restaurant->images_id = $request['images_id'];
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
        $restaurant  = Restaurant::with('Services')->with('Images')->findOrFail($id);
        return response()->json($restaurant);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $restaurant  = Restaurant::with('Services')->with('Images')->findOrFail($id);
        
        $restaurant->name = $request['name'];
        $restaurant->phone = $request['phone'];
        $restaurant->rate = $request['rate'];
        $restaurant->hour_open = $request['hour_open'];
        $restaurant->hour_close = $request['hour_close'];
        $restaurant->lattude = $request['lattude'];
        $restaurant->longtude = $request['longtude'];
        $restaurant->address = $request['address'];
        $restaurant->services_id = $request['services_id'];
        $restaurant->images_id = $request['images_id'];
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
            'data' => $data]);
    }

    public function add_services($id){
        $restaurant = Restaurant::with('Services')->with('Images')->findOrFail($id);

        $services = $request['services_id'];
        $restaurant->services_id = $services;
        $result = $restaurant->save();

        if ($result){
            $status = true;
            $info = "Services Added to Restaurant Successfully";
            $data = $result;
        }else{
            $status = false;
            $info = "Services didn't Add to Restaurant Successfully";
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
    public function destroy($id){
        $result = Restaurant::findOrFail($id)->delete();
        return response()->json([
            'success'=> true,
            'result'=> $result
        ]);
    }
}
