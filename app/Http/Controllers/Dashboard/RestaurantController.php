<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\ResturentDatatable;
use App\Http\Controllers\Controller;
use App\Models\EntityService;
use App\Models\Image;
use App\Models\Restaurant;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Psy\Readline\Hoa\Console;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ResturentDatatable $resturents)
    {
        return $resturents->render('dashboard.Resturent.index', ['title' => 'Resturents Page']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.Resturent.create');
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
            'phone' => 'required',
            // 'rate' => 'required|max:10|min:1|numeric',
            'latitude' => 'required|between:-90.000000,90.000000',
            'longtude' => 'required|between:-180.000000,180.000000',
            'address' => 'required|string',
           // 'menu_url' => 'required',
            'open' => 'required',
            'close' => 'required|after:open',
            'rate' => 'required|min:0|max:5'
        ]);

        $resturent = new Restaurant();
        $resturent->name = $request['name'];
        $resturent->phone = $request['phone'];
        $resturent->rate =  $request['rate'];
        $resturent->latitude = $request['latitude'];
        $resturent->longtude = $request['longtude'];
        $resturent->address = $request['address'];
        $resturent->menu_url = $request['menu_url'];
        $resturent->hour_open = $request['open'];
        $resturent->hour_close = $request['close'];

        // $resturent->services = $request['services'];
       // $resturent->services = "wifi";
        $result = $resturent->save();

        return redirect('resturents')->with('add_status', $result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resturent = Restaurant::with('images')->with('services.service')->findOrFail($id);
        $resturent_services = [];
      
            $resturent_services = $resturent->services()->paginate(10);
           
            // return $resturent->services;
       
        // return $resturent_services;
        $images = $resturent->images()->paginate(10);
        return view('dashboard.Resturent.show', ['resturent' => $resturent, 'resturent_services' => $resturent_services, 'images' => $images]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resturent = Restaurant::findOrFail($id);
        return view('dashboard.Resturent.edit', ['resturent' => $resturent]);
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
            'phone' => 'required',
            // 'rate' => 'required|max:10|min:1|numeric',
            'latitude' => 'required|numeric|between:-90.000000,90.000000',
            'longtude' => 'required|numeric|between:-180.000000,180.000000',
            'address' => 'required|string',
           // 'menu_url' => 'required',
            'open' => 'required',
            'close' => 'required|after:open',
            'rate'=>'required|min:0|max:5'

            // 'services' => 'required'
        ]);

        $resturent = Restaurant::findOrfail($id);
        $resturent->name = $request['name'];
        $resturent->phone = $request['phone'];
        $resturent->rate = $request['rate'];
        $resturent->latitude = $request['latitude'];
        $resturent->longtude = $request['longtude'];
        $resturent->address = $request['address'];
        $resturent->menu_url = $request['menu_url'];
        $resturent->hour_open = $request['open'];
        $resturent->hour_close = $request['close'];

        // $resturent->services = $request['services'];
        //$resturent->services = "wifi";
        $result = $resturent->save();

        return redirect('resturents')->with('add_status', $result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //////////////////destroy/////////////////////////////////////////////////////////////
    public function destroy($id)
    {
        $resturent = Restaurant::findOrFail($id);
        foreach ($resturent->images as $image) {
            Storage::disk('local')->delete('public/RestaurantsImages/' . $image->name);
            $resturent->images()->delete();
        }
        $resturent->delete();
        return response()->json([
            'success' => true,
        ]);
    }
    //////////////////View Add images/////////////////////////////////////////////
    public function addImages($id)
    {
        $resturent = Restaurant::findOrFail($id);
        $images = $resturent->images;
        // return $images;
        return view('dashboard.Resturent.addImages', ['images' => $images, 'resturent' => $resturent]);
    }



    public function storeImages(Request $request, $id)
    {
        $resturent = Restaurant::findOrFail($id);

        $request->validate([
            'images' => 'required',
        ]);

        $result = null;
        if ($request->hasFile('images')) {
            foreach ($request->images as $image) {

                $path = 'public/RestaurantsImages/';
                $name = time() + rand(1, 10000000000) . '.' . $image->getClientOriginalExtension();
                Storage::disk('local')->put($path . $name, file_get_contents($image));
                Storage::disk('local')->exists($path . $name);
                $image = new Image();
                $image->image_url = "storage/RestaurantsImages/" . $name;
                $image->name = $name;
                $image->model_type = "App\Models\Restaurant";
                $image->model_id = $id;
                $result = $image->save();
            }
        }



        if ($result != null) {
            $status = true;
            $message = "Images Added to Restrent Successfully";
            $data = $result;
        } else {
            $status = false;
            $message = "Images didn't Add to Restrent Successfully";
            $data = $result;
        }
        return redirect()->route('resturents.show', [$id])->with(['status' => $status]);
    }
    ///////////////////////////////////Delete Image///////////////////

    public function deleteImage($id)
    {
        //return $id;
        $image = Image::findOrFail($id);

        Storage::disk('local')->delete('public/RestaurantsImages/' . $image->name);
        $image->delete();

        return response()->json([
            "status" => true,
            "message" => "The image has been deleted"
        ]);
    }

    // ---------------------- Service for restaurant ----------------------

    public function addServicese(Request $request, $id)
    {
        $resturent = Restaurant::findOrFail($id);
        $restaurant_services = [];
        // foreach ($resturent->services as $services) {
        //     $restaurant_services = $services->service;
        // }

        $restaurant_services = $resturent->services;
        $services = Service::all();
        // return ($services);
        return view('dashboard.Resturent.addService', compact('resturent', 'restaurant_services', 'services'));
    }
    public function storeServicese(Request $request, $id)
    {
        $restaurant = Restaurant::with('services')->findOrFail($id);
        $restaurant_services = $restaurant->services;
        // return $restaurant_services;
        $services = $request->services;
        // $result = '';
        foreach ($services as $service) {
            if ($restaurant_services) {
                foreach ($restaurant_services as $restaurant_service) {
                    $restaurant_service->delete();
                }
            }
            $entity_service = new EntityService();
            $entity_service->service_id = $service;
            $entity_service->model_type = 'App\Models\Restaurant';
            $entity_service->model_id = $id;
            $result = $entity_service->save();
        }

        return redirect()->route('resturents.show', $id)->with('status', $result);
    }

    public function deleteServicese($id)
    {
        EntityService::findOrFail($id)->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
