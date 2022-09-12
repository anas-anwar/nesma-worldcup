<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\DB;
use App\Models\Favorite;

class RestaurantController extends Controller
{
    private $mainModel = "Restaurant";
    public function index(Request $request){
        $limit = 4;
        $restaurants  = Restaurant::with(['images','services.service'])->limit($limit)->offset($request['page'] * $limit)->get();
        return response()->json([
            'status' => true,
            'message' => 'Show Restaurants',
            'data' => $restaurants,
        ]);
    }
    public function show(Request $request, $id){
        $restaurant  = Restaurant::with(['images','services.service'])->findOrFail($id);
        $restaurant["is_favorit"] = Favorite::where([
            'account_id' => $request->account_id,
            'favoritable_type' => 'App\Models\\' . $this->mainModel,
            'favoritable_id' => $id,
            ])->first()? true : false;
        return response()->json([
            'status' => true,
            'message' => 'Show Restaurant ' . $restaurant->id,
            'data' => $restaurant,
        ]);
    }


    public function search(Request $request){
        //return($request->key);
       $resturent=Restaurant::with(['images','services.service'])->when($request->name,function($query,$value){
           $query->where('name','LIKE',"%$value%"); })
     ->get();
       
           return response()->json([
               'status'=>true,
               'mesage'=>'Succsess',
               'data'=>$resturent
           ]);
     
   
    }


 public function nearResturents(Request $request) {
     $request->validate([
      'latitude' =>'required',
      'longtude'=>'required'
     ]);
 
 $lat = $request->latitude;
$lon = $request->longtude;
    $restorants = Restaurant::with('images')->select(
        "restaurants.id","restaurants.name","restaurants.rate","restaurants.hour_open","restaurants.latitude","restaurants.longtude","restaurants.address",DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
    * cos(radians(restaurants.latitude)) 
    * cos(radians(restaurants.longtude) - radians(" . $lon . ")) 
    + sin(radians(" .$lat. ")) 
    * sin(radians(restaurants.latitude))) AS distance"))->orderBy('distance','asc')->get();
// $data = DB::table("restaurants")
// ->join('images', function ($join) {
//     $join->on('images.model_id', '=', 'restaurants.id')
//          ->where('images.model_type', '=', "App\Models\Restaurant");})
//     ->select("restaurants.id","restaurants.name","restaurants.rate","restaurants.hour_open","restaurants.latitude","restaurants.longtude","restaurants.address","images.image_url","images.name as image_name"
//         ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
//         * cos(radians(restaurants.latitude)) 
//         * cos(radians(restaurants.longtude) - radians(" . $lon . ")) 
//         + sin(radians(" .$lat. ")) 
//         * sin(radians(restaurants.latitude))) AS distance"))
//         ->orderBy('distance','asc')
//        // ->groupBy("restaurants.id")
//         ->get();


return response()->json([
    'status'=>true,
    'mesage'=>'Succsess',
    'data'=>$restorants
]);
}
}
