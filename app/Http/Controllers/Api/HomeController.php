<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountOdd;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\MatchModel;
use App\Models\Restaurant;
use App\Models\Stadium;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){

        $current_time = Carbon::now();

        $Next_match = MatchModel::with('Rounds')
                                ->with('Stadiums')
                                ->with('LocalTeam')
                                ->with('VisitorTeam')
                                ->where('date', '>' ,$current_time->toDateString())
                                ->orWhere(function ($query) use ($current_time){
                                    $query->where('date', '=' ,$current_time->toDateString());
                                    $query->where('start', '<=' ,$current_time->toTimeString());
                                    $query->where('end', '>=' , $current_time->toTimeString());
                                })
                                ->orderBy('date', 'asc')
                                ->orderBy('start', 'asc')
                                ->first();

        $top_ten_hotels  = Hotel::orderBy('rate', 'desc')
                    ->take(10)
                    ->select('name', 'rate', 'description', 'address')
                    ->get();

        $top_ten_restaurants = Restaurant::with('Images')
                    ->orderBy('rate', 'desc')
                    ->take(10)
                    ->select('name', 'rate', 'hour_open', 'hour_close', 'address')
                    ->get();

        $top_ten_stadiums = Stadium::with('Team')->with('Images')
                    ->orderBy('created_at', 'desc')
                    ->take(10)
                    ->select('name', 'description', 'address')
                    ->get();


        return response()->json([
            'status' => true,
            'message' => 'Home Page',
            'data' => [
                'Next_match' => $Next_match,
                'Top 10 Hotels' => $top_ten_hotels,
                'Top 10 Restaurants' => $top_ten_restaurants,
                'Top 10 Stadiums' => $top_ten_stadiums,
            ],
        ]);
    }

    public function voting(Request $request, $match_id, $account_id){

        $request->validate([
            'name' => 'required',
            'team_id' => 'required',
        ]);

        $account_odd = new AccountOdd();
        $account_odd->name = $request['name'];
        $account_odd->match_id = $match_id;
        $account_odd->account_id = $account_id;
        $account_odd->vote = $request['team_id'];

        $result = $account_odd->save();

        if ($result){
            $status = true;
            $message = "Odd added Successfully";
            $data = $result;
        }else{
            $status = false;
            $message = "Odd didn't add Successfully";
            $data = false;
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ]);
    }

}
