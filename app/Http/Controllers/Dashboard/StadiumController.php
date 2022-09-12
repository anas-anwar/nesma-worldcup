<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\StadiumDatatable;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Stadium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Psy\Readline\Hoa\Console;

class StadiumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(stadiumDatatable $stadiums)
    {
        return $stadiums->render('dashboard.Stadium.index', ['title'=> 'Stadiums Page']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.Stadium.create');
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
            'description'=>'required|string',
            'phone' => 'required',
            // 'rate' => 'required|max:10|min:1|numeric',
            'latitude' => 'required|numeric|min:-90|max:90',
            'longtude' => 'required|numeric|min:-180|max:180',
            'address' => 'required|string',
            'capacity' => 'required|numeric',
           
        ]);

        $stadium = new Stadium();
        $stadium->name = $request['name'];
        $stadium->phone = $request['phone'];
        $stadium->latitude = $request['latitude'];
        $stadium->longtude = $request['longtude'];
        $stadium->address = $request['address'];
        $stadium->capacity = $request['capacity'];
       
        $stadium->description = $request['description'];

        // $stadium->services = $request['services'];
        //$stadium->services = "wifi";
        $result = $stadium->save();

        return redirect('stadiums')->with('add_status', $result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stadium = Stadium::with('images')->findOrFail($id);
        $images=$stadium->images()->paginate(10);
        // dd($stadium);
        return view('dashboard.Stadium.show', ['stadium' => $stadium,'images'=>$images]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stadium = Stadium::findOrFail($id);
        return view('dashboard.Stadium.edit', ['stadium' => $stadium]);



        
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
            'description'=>'required|string',
            'phone' => 'required',
            // 'rate' => 'required|max:10|min:1|numeric',
            'latitude' => 'required|numeric|min:-90|max:90',
            'longtude' => 'required|numeric|min:-180|max:180',
            'address' => 'required|string',
            'capacity' => 'required|numeric',
        ]);

        $stadium = Stadium::findOrfail($id);
        $stadium->name = $request['name'];
        $stadium->phone = $request['phone'];
        $stadium->latitude = $request['latitude'];
        $stadium->longtude = $request['longtude'];
        $stadium->address = $request['address'];
        $stadium->capacity = $request['capacity'];
       
        $stadium->description = $request['description'];

        // $stadium->services = $request['services'];
       // $stadium->services = "wifi";
        $result = $stadium->save();

        return redirect('stadiums')->with('add_status', $result);
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
       $stadium= Stadium::findOrFail($id);
       foreach($stadium->images as $image){
        Storage::disk('local')->delete('public/StadiumsImages/'.$image->name);
           $stadium->images()->delete();
       }
$stadium->delete();
        return response()->json([
            'success'=> true,
        ]);
    }
//////////////////View Add images/////////////////////////////////////////////
 public function addImages($id){
    $stadium= Stadium::findOrFail($id);
     $images =$stadium->images;
    // return $images;
     return view('dashboard.Stadium.addImages',['images'=>$images,'stadium'=>$stadium]);

 }



public function storeImages(Request $request,$id){
    $stadium= Stadium::findOrFail($id);
  
    $request->validate([
        'images' => 'required',
    ]);
    
$result=null;
    if ($request->hasFile('images')) {
        foreach($request->images as $image){
       
        $path = 'public/StadiumsImages/';
        $name = time() + rand(1, 10000000000) . '.' . $image->getClientOriginalExtension();
        Storage::disk('local')->put($path . $name, file_get_contents($image));
        Storage::disk('local')->exists($path . $name);
        $image = new Image();
        $image->image_url = "storage/StadiumsImages/" . $name;
        $image->name = $name;
        $image->model_type = "App\Models\Stadium";
        $image->model_id = $id;
        $result = $image->save();
    }
}

  

    if ($result!=null) {
        $status = true;
        $message = "Images Added to Restrent Successfully";
        $data = $result;
    } else {
        $status = false;
        $message = "Images didn't Add to Restrent Successfully";
        $data = $result;
    }
    return redirect()->route('stadiums.show',[$id])->with(['status'=>$status]) ;
}
 ///////////////////////////////////Delete Image///////////////////

 public function deleteImage($id){
    //return $id;
     $image =Image::findOrFail($id);

     Storage::disk('local')->delete('public/StadiumsImages/'.$image->name);
     $image->delete();

return response()->json([
    "status"=>true,
    "message"=>"The image has been deleted"
]);
 }
}
