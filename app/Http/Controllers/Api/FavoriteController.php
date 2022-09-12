<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Stadium;
use App\Models\Hotel;
use App\Models\MetroStation;
use App\Models\TouristicPlace;
use App\Models\MedicalCenter;
use App\Models\Restaurant;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FavoriteController extends Controller
{
    public  function Index(Request $request){
       $favorites = Favorite::where('account_id' , $request->account_id)->get();
        $hotels = Hotel::with(['images','services.service'])->find($favorites->where('favoritable_type','App\Models\Hotel')->pluck('favoritable_id'));
        $restorants = Restaurant::with(['images','services.service'])->find($favorites->where('favoritable_type','App\Models\Restaurant')->pluck('favoritable_id'));
        $medicalCenter = MedicalCenter::with(['images'])->find($favorites->where('favoritable_type','App\Models\MedicalCenter')->pluck('favoritable_id'));
        $toristPlaces = TouristicPlace::with(['images'])->find($favorites->where('favoritable_type','App\Models\TouristicPlace')->pluck('favoritable_id'));
        
       return response()->json([
        'status' => true,
        'message' => 'Show Favorites',
        'data' => 
       
         [
          "hotels"=> $hotels,
          "restorants" => $restorants,
          "medicalCenter"=> $medicalCenter,
          "toristPlaces"=> $toristPlaces
        ], 
    ]);  
    }


    public function add_remove(Request  $request){

      $validator = Validator::make($request->all(), [
        'account_id' => 'required|integer|exists:accounts,id',
        'favoritable_type' => 'required|string|in:Restaurant,MedicalCenter,Hotel,TouristicPlace',
       ]);

       if ($validator->fails()) {
        return response()->json([
         'status' => false,
         'message' => 'fails',
         'data' => $validator->errors(), 
        ]); 
       }
       $object = false;
       switch ($request->favoritable_type) {
        case "Restaurant":
            $object = Restaurant::find($request->favoritable_id);
            break;
        case "MedicalCenter":
            $object = MedicalCenter::find($request->favoritable_id);
            break;
        case "Hotel":
            $object = Hotel::find($request->favoritable_id);
            break;
        case "TouristicPlace":
            $object = TouristicPlace::find($request->favoritable_id);
            break;

    }
    if(!$object){
        return response()->json([
          'status' => false,
          'message' => $request->favoritable_type . ' not found',
      ]); 
    }
    

      $fav = Favorite::where([
        'account_id' => $request->account_id,
        'favoritable_type' => 'App\Models\\' . $request->favoritable_type,
        'favoritable_id' => $request->favoritable_id,
        ])->first();
       
      if($fav){
          $fav->delete();
          return response()->json([
            'status' => true,
            'message' => 'successfully Deleted',
            'data' => [], 
        ]);  
       } 


       else{

        try {
          $fav = Favorite::create(
            [
              'account_id' => $request->account_id,
              'favoritable_type' => 'App\Models\\' . $request->favoritable_type,
             'favoritable_id' => $request->favoritable_id ,
            ]
        );
        return response()->json([
          'status' => true,
          'message' => 'successfully Added',
          'data' => $fav, 
      ]);  

        } catch (\Exception $e) {}
        return response()->json([
          'status' => false,
          'message' => $e->getMessage(),
          'data' => [], 
      ]);  
        }


    }



}
