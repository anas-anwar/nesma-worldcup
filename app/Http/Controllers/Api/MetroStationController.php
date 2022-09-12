<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MetroStation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MetroStationController extends Controller
{
    public function index(Request $request)
    {
        $limit = 4;
        $metro_stations = MetroStation::with('images')->limit($limit)->offset($request['page'] * $limit)->get();

        return response()->json([
            'status' => true,
            'message' => 'Show Metro Stations',
            'data' => $metro_stations,
        ]);
    }

    public function show($id)
    {
        $metro_station = MetroStation::with('images')->findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'Show Metro Station',
            'data' => $metro_station,
        ]);
    }
    public function search(Request $request){
        $metro=MetroStation::with(['images'])->when($request->name,function($query,$value){
            $query->where('name','LIKE',"%$value%"); })
      ->get();
    
           return response()->json([
               'status'=>true,
               'mesage'=>'Succsess',
               'data'=>$metro
           ]);
     
    }

    public function nearMetroStations(Request $request) {
        $request->validate([
            'latitude' =>'required',
            'longtude'=>'required'
           ]);
       
       $lat = $request->latitude;
      $lon = $request->longtude;
          $metro_stations = MetroStation::with('images')->select(
              "metro_stations.id","metro_stations.name","metro_stations.city","metro_stations.address","metro_stations.latitude","metro_stations.longtude","metro_stations.url", DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
          * cos(radians(metro_stations.latitude)) 
          * cos(radians(metro_stations.longtude) - radians(" . $lon . ")) 
          + sin(radians(" .$lat. ")) 
          * sin(radians(metro_stations.latitude))) AS distance"))->orderBy('distance','asc')->get();

      return response()->json([
          'status'=>true,
          'mesage'=>'Succsess',
          'data'=>$metro_stations
      ]);
      }
   
}
