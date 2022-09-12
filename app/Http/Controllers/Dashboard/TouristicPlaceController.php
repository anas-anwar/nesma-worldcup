<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\TouristicPlaceDatatable;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\TouristicPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TouristicPlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TouristicPlaceDatatable $touristic_place)
    {
        return $touristic_place->render('dashboard.TouristicPlace.index', ['title' => 'Touristic Places Page']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.TouristicPlace.create');
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
            'phone' => 'required',
            'latitude' => 'required|between:-90.000000,90.000000',
            'longtude' => 'required|between:-180.000000,180.000000',
            'url' => 'required|string',
        ]);

        $touristic_place = new TouristicPlace();
        $touristic_place->name = $request['name'];
        $touristic_place->city = $request['city'];
        $touristic_place->address = $request['address'];
        $touristic_place->phone = $request['phone'];
        $touristic_place->latitude = $request['latitude'];
        $touristic_place->longtude = $request['longtude'];
        $touristic_place->url = $request['url'];

        $result = $touristic_place->save();

        return redirect('touristicplaces')->with('add_status', $result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $touristic_place = TouristicPlace::with('images')->findOrFail($id);
        $images = $touristic_place->images()->paginate(10);
        return view('dashboard.TouristicPlace.show', ['touristic_place' => $touristic_place, 'images' => $images]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $touristic_place = TouristicPlace::with('images')->findOrFail($id);
        return view('dashboard.TouristicPlace.edit', ['touristic_place' => $touristic_place]);
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
            'phone' => 'required',
            'latitude' => 'required|between:-90.000000,90.000000',
            'longtude' => 'required|between:-180.000000,180.000000',
            'url' => 'required|string',
        ]);

        $touristic_place = TouristicPlace::with('images')->findOrFail($id);

        $touristic_place->name = $request['name'];
        $touristic_place->city = $request['city'];
        $touristic_place->address = $request['address'];
        $touristic_place->phone = $request['phone'];
        $touristic_place->latitude = $request['latitude'];
        $touristic_place->longtude = $request['longtude'];
        $touristic_place->url = $request['url'];

        $result = $touristic_place->save();

        return redirect('touristicplaces')->with('add_status', $result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $touristic_place = TouristicPlace::findOrFail($id);
        foreach ($touristic_place->images as $image) {
            Storage::disk('local')->delete('public/TouristicPlaceImages/' . $image->name);
            $touristic_place->images()->delete();
        }
        $touristic_place->delete();
        return response()->json([
            'success' => true,
        ]);
    }

    //////////////////View Add images/////////////////////////////////////////////
    public function addImages($id)
    {
        $touristic_place = TouristicPlace::findOrFail($id);
        $images = $touristic_place->images;
        // return $images;
        return view('dashboard.TouristicPlace.addImage', ['images' => $images, 'touristic_place' => $touristic_place]);
    }



    public function storeImages(Request $request, $id)
    {
        $touristic_place = TouristicPlace::findOrFail($id);

        $request->validate([
            'images' => 'required',
        ]);

        $result = null;
        if ($request->hasFile('images')) {
            foreach ($request->images as $image) {

                $path = 'public/TouristicPlaceImages/';
                $name = time() + rand(1, 10000000000) . '.' . $image->getClientOriginalExtension();
                Storage::disk('local')->put($path . $name, file_get_contents($image));
                Storage::disk('local')->exists($path . $name);
                $image = new Image();
                $image->image_url = "storage/TouristicPlaceImages/" . $name;
                $image->name = $name;
                $image->model_type = "App\Models\TouristicPlace";
                $image->model_id = $id;
                $result = $image->save();
            }
        }

        if ($result != null) {
            $status = true;
            $message = "Images Added to Touristic Place Successfully";
            $data = $result;
        } else {
            $status = false;
            $message = "Images didn't Add to Touristic Place Successfully";
            $data = $result;
        }
        return redirect()->route('touristicplaces.show', [$id])->with(['status' => $status]);
    }
    ///////////////////////////////////Delete Image///////////////////

    public function deleteImage($id)
    {
        //return $id;
        $image = Image::findOrFail($id);

        Storage::disk('local')->delete('public/TouristicPlaceImages/' . $image->name);
        $image->delete();

        return response()->json([
            "status" => true,
            "message" => "The image has been deleted"
        ]);
    }
}
