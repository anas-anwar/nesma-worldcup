<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TouristicPlace;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TouristicPlaceController extends Controller
{
    private $mainModel = "TouristicPlace";
    public function index(Request $request)
    {
        $limit = 4;
        $touristic_places = TouristicPlace::with('images')->limit($limit)->offset($request['page'] * $limit)->get();

        return response()->json([
            'status' => true,
            'message' => 'Show Touristic Places',
            'data' => $touristic_places,
        ]);
    }

    public function show(Request $request, $id)
    {
        $touristic_place = TouristicPlace::with('images')->findOrFail($id);
        $touristic_place["is_favorit"] = Favorite::where([
            'account_id' => $request->account_id,
            'favoritable_type' => 'App\Models\\' . $this->mainModel,
            'favoritable_id' => $id,
            ])->first()? true : false;
        return response()->json([
            'status' => true,
            'message' => 'Show Touristic Place',
            'data' => $touristic_place,
        ]);
    }
    public function search(Request $request){
        $tourist=TouristicPlace::with(['images'])->when($request->name,function($query,$value){
            $query->where('name','LIKE',"%$value%"); })
      ->get();
    
           return response()->json([
               'status'=>true,
               'mesage'=>'Succsess',
               'data'=>$tourist
           ]);
    }

    public function nearTouristicPlaces(Request $request) {
        $request->validate([
         'latitude' =>'required',
         'longtude'=>'required'
        ]);
    
    $lat = $request->latitude;
    $lon = $request->longtude;
       $touristic_places = TouristicPlace::with('images')->select(
           "touristic_places.id","touristic_places.name","touristic_places.city","touristic_places.address","touristic_places.phone","touristic_places.latitude","touristic_places.longtude","touristic_places.url",DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
       * cos(radians(touristic_places.latitude)) 
       * cos(radians(touristic_places.longtude) - radians(" . $lon . ")) 
       + sin(radians(" .$lat. ")) 
       * sin(radians(touristic_places.latitude))) AS distance"))->orderBy('distance','asc')->get();

   return response()->json([
       'status'=>true,
       'mesage'=>'Succsess',
       'data'=>$touristic_places
   ]);
   }

}
