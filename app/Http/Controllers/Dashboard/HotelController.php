<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Image;
use App\Models\Room;
use App\DataTables\HotelDatatable;
use App\Models\EntityService;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HotelDatatable $hotels)
    {
        $rooms = Room::get();
        return $hotels->render('dashboard.Hotel.index', ['title' => 'Hotels Page', 'rooms' => $rooms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.Hotel.create');
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
            // 'rate' => 'required|max:10|min:1|numeric',
            'latitude' => 'required|numeric|min:-90|max:90',
            'longtude' => 'required|numeric|min:-180|max:180',
            'address' => 'required|string',
            'hotel_url' => 'required',
            'rate' => 'required|min:0|max:5'
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
        //$hotel->services = $request['services'];
        $result = $hotel->save();

        return redirect()->route('hotels.index')->with('add_status', $result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hotel = Hotel::with(['images', 'rooms', 'services.service'])->findOrFail($id);
        // foreach ($hotel->services as $services) {
        //     $hotel_services = $services->service->paginate(10);
        //   // return $hotel->services;
        // }
        $hotel_services = $hotel->services()->paginate(10);
       // return $hotel_services;
        $images = $hotel->images()->paginate(10);
        $rooms = $hotel->rooms()->paginate(5);
        return view('dashboard.Hotel.show', compact('hotel', 'images', 'hotel_services', 'rooms'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hotel = Hotel::findOrFail($id);
        return view('dashboard.Hotel.edit', ['hotel' => $hotel]);
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
            // 'rate' => 'required|max:10|min:1|numeric',
            'latitude' => 'required|numeric|min:-90|max:90',
            'longtude' => 'required|numeric|min:-180|max:180',
            'address' => 'required|string',
            'hotel_url' => 'required',
            // 'services' => 'required'
            'rate' => 'required|min:0|max:5'
        ]);

        $hotel = Hotel::findOrFail($id);

        $hotel->name = $request['name'];
        $hotel->description = $request['description'];
        $hotel->phone = $request['phone'];
        $hotel->rate = $request['rate'];
        $hotel->latitude = $request['latitude'];
        $hotel->longtude = $request['longtude'];
        $hotel->address = $request['address'];
        $hotel->hotel_url = $request['hotel_url'];
        // $hotel->hotel_url = 'WIFI, Delevary';
        $result = $hotel->save();

        return redirect('hotels')->with('add_status', $result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Hotel::findOrFail($id)->delete();
        return response()->json([
            'success' => true,
        ]);
    }

    // ---------------------- Image for Hotel ----------------------
    public function addImages($id)
    {
        $hotel = Hotel::findOrFail($id);
        $images = $hotel->images;
        return view('dashboard.Hotel.addImage', ['images' => $images, 'hotel' => $hotel]);
    }

    public function storeImages(Request $request, $id)
    {
        // $hotel= Hotel::findOrFail($id);
        $request->validate([
            'images' => 'required',
        ]);

        $result = null;
        if ($request->hasFile('images')) {
            foreach ($request->images as $image) {
                $path = 'public/HotelsImages/';
                $name = time() + rand(1, 10000000000) . '.' . $image->getClientOriginalExtension();
                Storage::disk('local')->put($path . $name, file_get_contents($image));
                Storage::disk('local')->exists($path . $name);
                $image = new Image();
                $image->image_url = "storage/HotelsImages/" . $name;
                $image->name = $name;
                $image->model_type = "App\Models\Hotel";
                $image->model_id = $id;
                $result = $image->save();
            }
        }
        return redirect()->route('hotels.show', $id)->with('status', $result);
    }

    public function deleteImage($id)
    {
        $image = Image::findOrFail($id);
        Storage::disk('local')->delete('public/HotelsImages/' . $image->name);
        $image->delete();

        return response()->json([
            "status" => true,
            "message" => "The image has been deleted"
        ]);
    }
    // ---------------------- End Image for Hotel ----------------------

    // ---------------------- Room for Hotel ----------------------

    public function add_room(Request $request, $id)
    {
        $hotel = Hotel::with('rooms')->findOrFail($id);
        return view('dashboard.Hotel.addRoom', compact('hotel'));
    }
    public function store_room(Request $request, $id)
    {
        $hotel = Hotel::with('rooms')->findOrFail($id);

        $request->validate([
            'type' => 'required',
            'price' => 'required|numeric|min:1|max:100000',
            'url' => 'required',
        ]);

        $request->merge([
            'hotel_id' => $id
        ]);

        $result = Room::create($request->all());

        return redirect()->route('hotels.show', $hotel->id)->with('status', $result);
    }

    public function edit_room(Request $request, $id)
    {
        $room = Room::findOrFail($id);
        return view('dashboard.Hotel.editRoom', compact('room'));
    }

    public function update_room(Request $request, $id)
    {
        $room = Room::with('Hotels')->findOrFail($id);

        $request->validate([
            'type' => 'required',
            'price' => 'required|numeric|min:1|max:100000',
            'url' => 'required',
        ]);

        $room->type = $request['type'];
        $room->price = $request['price'];
        $room->url = $request['url'];
        // $room->hotel_id = $room->Hotels->id;
        $result = $room->save();

        return redirect()->route('hotels.show', $room->Hotels->id)->with('status', $result);
    }

    public function delete_room($id)
    {
        Room::findOrFail($id)->delete();

        return response()->json([
            'success' => true,
        ]);
    }
    // ---------------------- Room for Hotel ----------------------

    // ---------------------- Service for Hotel ----------------------

    public function add_service(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($id);
        // foreach ($hotel->services as $services) {
        //     $hotel_services = $services->service;
        // }
        $hotel_services = $hotel->services;
        $services = Service::all();
        // return ($services);
        return view('dashboard.Hotel.addService', compact('hotel', 'hotel_services', 'services'));
    }
    public function store_service(Request $request, $id)
    {
        $hotel = Hotel::with('services')->findOrFail($id);
        $hotel_services = $hotel->services;
        $services = $request->services;
        // $result = '';
        foreach ($services as $service) {
            if ($hotel_services) {
                foreach ($hotel_services as $hotel_service) {
                   
                        $hotel_service->delete();

                  
                }
            }
            $entity_service = new EntityService();
            $entity_service->service_id = $service;
            $entity_service->model_type = 'App\Models\Hotel';
            $entity_service->model_id = $id;
            $result = $entity_service->save();
        }

        return redirect()->route('hotels.show', $id)->with('status', $result);
    }

    public function delete_service($id)
    {
        EntityService::findOrFail($id)->Delete();

        return response()->json([
            'success' => true,
        ]);
    }
    // ---------------------- Room for Hotel ----------------------

}
