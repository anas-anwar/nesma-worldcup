<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MedicalCenter;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicalCenterController extends Controller
{
    private $mainModel = "MedicalCenter";
    public function index(Request $request)
    {
        $limit = 4;
        $medical_centers = MedicalCenter::with('images',)->limit($limit)->offset($request['page'] * $limit)->get();

        return response()->json([
            'status' => true,
            'message' => 'Show Medical Centers',
            'data' => $medical_centers,
        ]);
    }

    public function show(Request $request, $id)
    {
        $medical_center = MedicalCenter::with('images')->findOrFail($id);
        $medical_center["is_favorit"] = Favorite::where([
            'account_id' => $request->account_id,
            'favoritable_type' => 'App\Models\\' . $this->mainModel,
            'favoritable_id' => $id,
            ])->first()? true : false;
        return response()->json([
            'status' => true,
            'message' => 'Show Medical Center',
            'data' => $medical_center,
        ]);
    }

    public function search(Request $request){
        $medical=MedicalCenter::with(['images'])->when($request->name,function($query,$value){
            $query->where('name','LIKE',"%$value%"); })->get();
      
           return response()->json([
               'status'=>true,
               'mesage'=>'Succsess',
               'data'=>$medical
           ]);
    }

    public function nearMedicalCenters(Request $request) {
        // return $request->latitude;
        $request->validate([
            'latitude' =>'required',
            'longtude'=>'required'
           ]);
       
       $lat = $request->latitude;
      $lon = $request->longtude;
          $medical_centers = MedicalCenter::with('images')->select(
              "medical_centers.id","medical_centers.name","medical_centers.city","medical_centers.address","medical_centers.phone","medical_centers.open_time","medical_centers.close_time","medical_centers.latitude","medical_centers.longtude","medical_centers.url", DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
          * cos(radians(medical_centers.latitude)) 
          * cos(radians(medical_centers.longtude) - radians(" . $lon . ")) 
          + sin(radians(" .$lat. ")) 
          * sin(radians(medical_centers.latitude))) AS distance"))->orderBy('distance','asc')->get();

      return response()->json([
          'status'=>true,
          'mesage'=>'Succsess',
          'data'=>$medical_centers
      ]);
      }
}



