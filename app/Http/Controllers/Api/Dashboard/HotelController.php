<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\HotelRequests;
use App\Models\Hotel;
use App\Models\Image;
use App\Models\Room;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotels  = Hotel::with('Images')->get();
        return response()->json([
            'status' => true,
            'message' => 'Show Hotels',
            'data' => $hotels,
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
            'rate' => 'required|max:10|min:1|numeric',
            'latitude' => 'required|numeric|min:-90|max:90',
            'longtude' => 'required|numeric|min:-180|max:180',
            'address' => 'required|string',
            'hotel_url' => 'required',
            'services' => 'required'
        ]);

        $hotel = new Hotel();
        $hotel->name = $request['name'];
        $hotel->description = $request['description'];
        $hotel->phone = $request['phone'];
        $hotel->rate = $request['rate'];
        $hotel->latitude = $request['latitude'];
        $hotel->longtude = $request['longtude'];
        $hotel->address = $request['address'];
        $hotel->hotel_url = $request['hotel_url'];
        $hotel->services = $request['services'];
        $result = $hotel->save();

        if ($result) {
            $status = true;
            $message = "Hotel Added Successfully";
            $data = $result;
        } else {
            $status = false;
            $message = "Hotel didn't Add Successfully";
            $data = false;
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
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
        $hotel = Hotel::with(['images', 'rooms'])->findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Show Hotel' . $hotel->id,
            'data' => $hotel,
        ]);
    }


    public function add_image(Request $request, $id)
    {
        $request->validate([
            'fileName' => 'required',
        ]);

        if ($request->hasFile('fileName')) {
            $image = $request->file('fileName');
            $path = 'public/HotelsImages/';
            $name = time() + rand(1, 10000000000) . '.' . $image->getClientOriginalExtension();
            Storage::disk('local')->put($path . $name, file_get_contents($image));
            Storage::disk('local')->exists($path . $name);
        };

        $image = new Image();
        $image->image_url = "storage/HotelsImages/" . $name;
        $image->name = $name;
        $image->model_type = "App\Models\Hotel";
        $image->model_id = $id;
        $result = $image->save();

        if ($result) {
            $status = true;
            $message = "Images Added to Hotel Successfully";
            $data = $result;
        } else {
            $status = false;
            $message = "Images didn't Add to Hotel Successfully";
            $data = $result;
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ]);
    }

    public function add_room(Request $request, $id)
    {

        $request->validate([
            'type' => 'required|string',
            'price' => 'required|numeric|min:1|max:100000',
            'url' => 'required',
        ]);

        // $Rooms = Room::where("hotel_id",$id)->get();
        // foreach($Rooms as $Room){
        //     if($Room->type == $request['type']){
        //         if($Room->hotel_id == $id){
        //             $result = false;
        //             $message = 'This room already exists';
        //         }else{
        //             $room = new Room();
        //             $room->type = $request['type'];
        //             $room->price = $request['price'];
        //             $room->url = $request['url'];
        //             $room->hotel_id = $id;
        //             $result = $room->save();
        //         }
        //     }else{
        //         $result = false;
        //         $message = "Rooms didn't Add to Hotel Successfully";
        //     }
        // }
        $room = new Room();
        $room->type = $request['type'];
        $room->price = $request['price'];
        $room->url = $request['url'];
        $room->hotel_id = $id;
        $result = $room->save();

        if ($result) {
            $status = true;
            $message = "Rooms Added to Hotel Successfully";
            $data = $result;
        } else {
            $status = false;
            $message = "Rooms didn't Add to Hotel Successfully";
            $data = $result;
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
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
            'rate' => 'required|max:10|min:1|numeric',
            'latitude' => 'required|numeric|min:-90|max:90',
            'longtude' => 'required|numeric|min:-180|max:180',
            'address' => 'required|string',
            'hotel_url' => 'required',
            'services' => 'required'
        ]);

        $hotel = Hotel::with('Images')->findOrFail($id);

        $hotel->name = $request['name'];
        $hotel->description = $request['description'];
        $hotel->phone = $request['phone'];
        $hotel->rate = $request['rate'];
        $hotel->latitude = $request['latitude'];
        $hotel->longtude = $request['longtude'];
        $hotel->address = $request['address'];
        $hotel->hotel_url = $request['hotel_url'];
        $hotel->hotel_url = $request['services'];
        $result = $hotel->save();

        if ($result) {
            $status = true;
            $message = "Hotel Updated Successfully";
            $data = $result;
        } else {
            $status = false;
            $message = "Hotel didn't Update Successfully";
            $data = false;
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
        $result = Hotel::findOrFail($id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Hotel deleted Successfully',
            'data' => $result
        ]);
    }
}
