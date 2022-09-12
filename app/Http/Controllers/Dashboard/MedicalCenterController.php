<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\MedicalCenterDatatable;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\MedicalCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MedicalCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MedicalCenterDatatable $medical)
    {
        return $medical->render('dashboard.MedicalCenter.index', ['title' => 'Medical Centers Page']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.MedicalCenter.create');
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
            'open_time' => 'required',
            'close_time' => 'required|after:open',
            'latitude' => 'required|between:-90.000000,90.000000',
            'longtude' => 'required|between:-180.000000,180.000000',
            'url' => 'required|string',
        ]);

        $medical_center = new MedicalCenter();
        $medical_center->name = $request['name'];
        $medical_center->city = $request['city'];
        $medical_center->address = $request['address'];
        $medical_center->phone = $request['phone'];
        $medical_center->open_time = $request['open_time'];
        $medical_center->close_time = $request['close_time'];
        $medical_center->latitude = $request['latitude'];
        $medical_center->longtude = $request['longtude'];
        $medical_center->url = $request['url'];

        $result = $medical_center->save();

        return redirect('medicalcenters')->with('add_status', $result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medical_center = MedicalCenter::with('images')->findOrFail($id);
        $images = $medical_center->images()->paginate(10);
        return view('dashboard.MedicalCenter.show', ['medical_center' => $medical_center, 'images' => $images]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $medical_center = MedicalCenter::with('images')->findOrFail($id);
        return view('dashboard.MedicalCenter.edit', ['medical_center' => $medical_center]);
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
            'open_time' => 'required',
            'close_time' => 'required|after:open',
            'latitude' => 'required|between:-90.000000,90.000000',
            'longtude' => 'required|between:-180.000000,180.000000',
            'url' => 'required|string',
        ]);

        $medical_center = MedicalCenter::with('images')->findOrFail($id);

        $medical_center->name = $request['name'];
        $medical_center->city = $request['city'];
        $medical_center->address = $request['address'];
        $medical_center->phone = $request['phone'];
        $medical_center->open_time = $request['open_time'];
        $medical_center->close_time = $request['close_time'];
        $medical_center->latitude = $request['latitude'];
        $medical_center->longtude = $request['longtude'];
        $medical_center->url = $request['url'];

        $result = $medical_center->save();

        return redirect('medicalcenters')->with('add_status', $result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medical_center = MedicalCenter::findOrFail($id);
        foreach ($medical_center->images as $image) {
            Storage::disk('local')->delete('public/MedicalCenterImages/' . $image->name);
            $medical_center->images()->delete();
        }
        $medical_center->delete();
        return response()->json([
            'success' => true,
        ]);
    }

    //////////////////View Add images/////////////////////////////////////////////
    public function addImages($id)
    {
        $medical_center = MedicalCenter::findOrFail($id);
        $images = $medical_center->images;
        // return $images;
        return view('dashboard.MedicalCenter.addImage', ['images' => $images, 'medical_center' => $medical_center]);
    }



    public function storeImages(Request $request, $id)
    {
        $medical_center = MedicalCenter::findOrFail($id);

        $request->validate([
            'images' => 'required',
        ]);

        $result = null;
        if ($request->hasFile('images')) {
            foreach ($request->images as $image) {

                $path = 'public/MedicalCenterImages/';
                $name = time() + rand(1, 10000000000) . '.' . $image->getClientOriginalExtension();
                Storage::disk('local')->put($path . $name, file_get_contents($image));
                Storage::disk('local')->exists($path . $name);
                $image = new Image();
                $image->image_url = "storage/MedicalCenterImages/" . $name;
                $image->name = $name;
                $image->model_type = "App\Models\MedicalCenter";
                $image->model_id = $id;
                $result = $image->save();
            }
        }

        if ($result != null) {
            $status = true;
            $message = "Images Added to Medical Center Successfully";
            $data = $result;
        } else {
            $status = false;
            $message = "Images didn't Add to Medical Center Successfully";
            $data = $result;
        }
        return redirect()->route('medicalcenters.show', [$id])->with(['status' => $status]);
    }
    ///////////////////////////////////Delete Image///////////////////

    public function deleteImage($id)
    {
        //return $id;
        $image = Image::findOrFail($id);

        Storage::disk('local')->delete('public/MedicalCenterImages/' . $image->name);
        $image->delete();

        return response()->json([
            "status" => true,
            "message" => "The image has been deleted"
        ]);
    }
}
