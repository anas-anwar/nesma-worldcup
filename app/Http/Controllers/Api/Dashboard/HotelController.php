<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\HotelRequests;
use App\Models\Hotel;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $hotels  = Hotel::with('Services')->with('Room')->with('Images')->get();
        return response()->json($hotels);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $hotel = new Hotel();
        $hotel->name = $request['name'];
        $hotel->description = $request['description'];
        $hotel->phone = $request['phone'];
        $hotel->rate = $request['rate'];
        $hotel->lattude = $request['lattude'];
        $hotel->longtude = $request['longtude'];
        $hotel->address = $request['address'];
        $hotel->hotelurl = $request['hotelurl'];
        $hotel->services_id = $request['services_id'];
        $hotel->images_id = $request['images_id'];
        $result = $hotel->save();

        if ($result){
            $status = true;
            $info = "Hotel Added Successfully";
            $data = $result;
        }else{
            $status = false;
            $info = "Hotel didn't Add Successfully";
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
        // ->with('Images')
        $hotel = Hotel::with('Services')->with('Room')->findOrFail($id);
        return response()->json($hotel);
    }

    public function add_services($id){
        $hotel = Hotel::with('Services')->with('Room')->findOrFail($id);

        $services = $request['services_id'];
        $hotel->services_id = $services;
        $result = $hotel->save();

        if ($result){
            $status = true;
            $info = "Services Added to Hotel Successfully";
            $data = $result;
        }else{
            $status = false;
            $info = "Services didn't Add to Hotel Successfully";
            $data = false;
        }
        return response()->json([
            'status' => $status, 
            'info' => $info, 
            'data' => $data]);

    }

    public function add_rooms($id){
        $hotel = Hotel::with('Services')->with('Room')->findOrFail($id);
        $rooms = $request['rooms'];

        $hotel->room = $rooms;
        $result = $hotel->save();

        if ($result){
            $status = true;
            $info = "Rooms Added to Hotel Successfully";
            $data = $result;
        }else{
            $status = false;
            $info = "Rooms didn't Add to Hotel Successfully";
            $data = false;
        }
        return response()->json([
            'status' => $status, 
            'info' => $info, 
            'data' => $data]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $hotel = Hotel::with('Services')->with('Room')->findOrFail($id);

        $hotel->name = $request['name'];
        $hotel->description = $request['description'];
        $hotel->phone = $request['phone'];
        $hotel->rate = $request['rate'];
        $hotel->lattude = $request['lattude'];
        $hotel->longtude = $request['longtude'];
        $hotel->address = $request['address'];
        $hotel->hotelurl = $request['hotelurl'];
        $hotel->services_id = $request['services_id'];
        $hotel->images_id = $request['images_id'];
        $result = $hotel->save();

        if ($result){
            $status = true;
            $info = "Hotel Updated Successfully";
            $data = $result;
        }else{
            $status = false;
            $info = "Hotel didn't Update Successfully";
            $data = false;
        }

        return response()->json([
            'status' => $status, 
            'info' => $info, 
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
        $result = Hotel::findOrFail($id)->delete();
        return response()->json([
            'success'=> true,
            'result'=> $result
        ]);
    }
}
