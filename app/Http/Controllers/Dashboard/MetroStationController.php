<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\MetroStationDatatable;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\MetroStation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MetroStationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MetroStationDatatable $metro_station)
    {
        return $metro_station->render('dashboard.MetroStation.index', ['title' => 'Metro Stations Page']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.MetroStation.create');
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
            'city' => 'required|string',
            'address' => 'required|string',
            'latitude' => 'required|between:-90.000000,90.000000',
            'longtude' => 'required|between:-180.000000,180.000000',
            'url' => 'required|string',
        ]);

        $metro_station = new MetroStation();
        $metro_station->name = $request['name'];
        $metro_station->city = $request['city'];
        $metro_station->address = $request['address'];
        $metro_station->latitude = $request['latitude'];
        $metro_station->longtude = $request['longtude'];
        $metro_station->url = $request['url'];

        $result = $metro_station->save();

        return redirect('metrostations')->with('add_status', $result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $metro_station = MetroStation::with('images')->findOrFail($id);
        $images = $metro_station->images()->paginate(10);
        return view('dashboard.MetroStation.show', ['metro_station' => $metro_station, 'images' => $images]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $metro_station = MetroStation::with('images')->findOrFail($id);
        return view('dashboard.MetroStation.edit', ['metro_station' => $metro_station]);
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
            'city' => 'required|string',
            'address' => 'required|string',
            'latitude' => 'required|between:-90.000000,90.000000',
            'longtude' => 'required|between:-180.000000,180.000000',
            'url' => 'required|string',
        ]);

        $metro_station = MetroStation::with('images')->findOrFail($id);

        $metro_station->name = $request['name'];
        $metro_station->city = $request['city'];
        $metro_station->address = $request['address'];
        $metro_station->latitude = $request['latitude'];
        $metro_station->longtude = $request['longtude'];
        $metro_station->url = $request['url'];

        $result = $metro_station->save();

        return redirect('metrostations')->with('add_status', $result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $metro_station = MetroStation::findOrFail($id);
        foreach ($metro_station->images as $image) {
            Storage::disk('local')->delete('public/MetroStationImages/' . $image->name);
            $metro_station->images()->delete();
        }
        $metro_station->delete();
        return response()->json([
            'success' => true,
        ]);
    }

    //////////////////View Add images/////////////////////////////////////////////
    public function addImages($id)
    {
        $metro_station = MetroStation::findOrFail($id);
        $images = $metro_station->images;
        // return $images;
        return view('dashboard.MetroStation.addImage', ['images' => $images, 'metro_station' => $metro_station]);
    }



    public function storeImages(Request $request, $id)
    {
        $metro_station = MetroStation::findOrFail($id);

        $request->validate([
            'images' => 'required',
        ]);

        $result = null;
        if ($request->hasFile('images')) {
            foreach ($request->images as $image) {

                $path = 'public/MetroStationImages/';
                $name = time() + rand(1, 10000000000) . '.' . $image->getClientOriginalExtension();
                Storage::disk('local')->put($path . $name, file_get_contents($image));
                Storage::disk('local')->exists($path . $name);
                $image = new Image();
                $image->image_url = "storage/MetroStationImages/" . $name;
                $image->name = $name;
                $image->model_type = "App\Models\MetroStation";
                $image->model_id = $id;
                $result = $image->save();
            }
        }

        if ($result != null) {
            $status = true;
            $message = "Images Added to Metro Station Successfully";
            $data = $result;
        } else {
            $status = false;
            $message = "Images didn't Add to Metro Station Successfully";
            $data = $result;
        }
        return redirect()->route('metrostations.show', [$id])->with(['status' => $status]);
    }
    ///////////////////////////////////Delete Image///////////////////

    public function deleteImage($id)
    {
        //return $id;
        $image = Image::findOrFail($id);

        Storage::disk('local')->delete('public/MetroStationImages/' . $image->name);
        $image->delete();

        return response()->json([
            "status" => true,
            "message" => "The image has been deleted"
        ]);
    }
}
