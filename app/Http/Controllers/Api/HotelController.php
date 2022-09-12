<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Models\Hotel;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
    private $mainModel = "Hotel";

    public function index(Request $request){

        $limit = 4;
        $hotels  = Hotel::with(['images','services.service'])->limit($limit)->offset($request['page'] * $limit)->get();
        return response()->json([
            'status' => true,
            'message' => 'Show Hotels',
            'data' => $hotels,
        ]);
    }
    public function show(Request $request, $id){
        $hotel  = Hotel::with('rooms')->with(['images','services.service'])->findOrFail($id);
        $hotel["is_favorit"] = Favorite::where([
            'account_id' => $request->account_id,
            'favoritable_type' => 'App\Models\\' . $this->mainModel,
            'favoritable_id' => $id,
            ])->first()? true : false;
        return response()->json([
            'status' => true,
            'message' => 'Show Hotel' . $hotel->id,
            'data' => $hotel,
        ]);
    }



    public function search(Request $request){
        $hotel=Hotel::with(['images','services.service'])->when($request->name,function($query,$value){
            $query->where('name','LIKE',"%$value%"); })
      ->get();
    
           return response()->json([
               'status'=>true,
               'mesage'=>'Succsess',
               'data'=>$hotel
           ]);
     
    }


    public function nearHotels(Request $request) {
        $request->validate([
         'latitude' =>'required',
         'longtude'=>'required'
        ]);
    
    $lat = $request->latitude;
   $lon = $request->longtude;
   $hotels = Hotel::with('images')->select(
    "hotels.id","hotels.name","hotels.description","hotels.rate","hotels.latitude","hotels.longtude","hotels.address",DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
    * cos(radians(hotels.latitude)) 
    * cos(radians(hotels.longtude) - radians(" . $lon . ")) 
    + sin(radians(" .$lat. ")) 
    * sin(radians(hotels.latitude))) AS distance"))->orderBy('distance','asc')->get();
//    $data=DB::table("hotels")
//    ->join('images', function ($join) {
//     $join->on('images.model_id', '=', 'hotels.id')
//          ->where('images.model_type', '=', "App\Models\Hotel");})
//          ->select("*"
//            ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
//            * cos(radians(hotels.latitude)) 
//            * cos(radians(hotels.longtude) - radians(" . $lon . ")) 
//            + sin(radians(" .$lat. ")) 
//            * sin(radians(hotels.latitude))) AS distance"))
//             ->orderBy('distance','asc')
//           // ->groupBy("hotels.id")
//            ->get();
   
   
   return response()->json([
       'status'=>true,
       'mesage'=>'Succsess',
       'data'=>$hotels
   ]);
   }
}
