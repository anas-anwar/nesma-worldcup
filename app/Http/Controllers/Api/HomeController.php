<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountOdd;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Image;
use App\Models\MatchModel;
use App\Models\Restaurant;
use App\Models\Stadium;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {

        $current_time_c = Carbon::now();
        $current_time = (new Carbon($current_time_c))->format('Y-m-d H:i:s');

        $Next_match = MatchModel::with(['round', 'localTeam', 'visitorTeam', 'winnerTeam', 'stadium', 'event'])
            ->where('date_time', '>', $current_time)
            ->orderBy('date_time', 'asc')
            ->first();

        $top_ten_hotels  = Hotel::addSelect('id', 'name', 'rate', 'description', 'address', 'longtude', 'latitude')
            ->with('images')
            ->orderBy('rate', 'desc')
            ->take(4)
            ->get();

        $top_ten_restaurants = Restaurant::addSelect('id', 'name', 'rate', 'hour_open', 'hour_close', 'address', 'longtude', 'latitude')
            ->with('images')
            ->orderBy('rate', 'desc')
            ->take(4)
            ->get();

        $top_ten_stadiums = Stadium::addSelect('id', 'name', 'description', 'address', 'longtude', 'latitude')
            ->with(['images'])
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();


        return response()->json([
            'status' => true,
            'message' => 'Home Page',
            'data' => [
                'next_match' => $Next_match,
                'hotels' => $top_ten_hotels,
                'restaurants' => $top_ten_restaurants,
                'stadiums' => $top_ten_stadiums,
            ],
        ]);
    }
    public function create_account(Request $request)
    {
        $udid = $request['udid'];
        $device_token = $request['device_token'];
        $account = Account::where('UDID', $udid)->first();
        if (empty($account)) {
            $new_account = new Account();
            $new_account->udid = $udid;
            $new_account->device_token = $device_token;
            $new_account->save();
            $message = 'Added Account Successfully';
            $data = $new_account->id;
        } else {
            $account->device_token = $device_token;
            $account->save();
            $message = 'Account exists';
            $data = $account->id;
        }


        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => [
                'account_id' => $data
            ]
        ]);
    }

    public function voting(Request $request, $match_id, $account_id)
    {
        $account_odd = AccountOdd::with('Accounts')->where('account_id', $account_id)->where('match_id', $match_id)->first();
        $match = MatchModel::find($match_id);
        $result = true;
        if (empty($account_odd)) {
            $account_odd = new AccountOdd();
            $account_odd->match_id = $match_id;
            $account_odd->account_id = $account_id;
            $account_odd->vote = $request['team_id'];
            $result = $account_odd->save();
        }
        // $account_odds = AccountOdd::where('match_id', $match_id)->GroupBy('vote')->select('vote', DB::raw('count(*) as total'))->get();
        $statistics = AccountOdd::where('match_id', $match_id)->select( DB::raw('sum( case when vote = ' . $match->localteam_id . ' then 1 else 0 end) as localteam'), DB::raw('sum( case when vote = ' . $match->visitorteam_id . ' then 1 else 0 end) as visitorteam'),DB::raw('sum( case when vote IS NULL then 1 else 0 end) as equal'))
            ->GroupBy('match_id')->first();
        // $sum = 0;
        // foreach ($account_odds as $account_odd) {
        //     $sum = $sum + $account_odd->total;
        // }

        // foreach ($account_odds as $odd) {
        //     $result[] = [
        //         'team_id' => $odd->vote,
        //         'Voting' => ($odd->total * 100) / $sum . '%',
        //     ];
        // }
        $account_odd->sum = $statistics->localteam + $statistics->visitorteam + $statistics->equal;
        $account_odd->equal = $statistics->equal * 100 / $account_odd->sum;
        $account_odd->localteam = $statistics->localteam * 100 / $account_odd->sum;
        $account_odd->visitorteam = $statistics->visitorteam * 100 / $account_odd->sum;

        $account_odd->match_id = (int) $account_odd->match_id;
        $account_odd->account_id = (int) $account_id;
        $account_odd->vote = (int) $account_odd->vote;

        if ($result) {
            $status = true;
            $message = "Odd added Successfully";
            $data = $account_odd;
        } else {
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


    public function accounts()
    {
        $account = Account::get();
        $account_odd = AccountOdd::get();
        return response()->json([
            'Accounts' => $account,
            'Account Odds' => $account_odd,
        ]);
    }
    //  public function search(Request $request){
    //      $hotel=Hotel::when($request->name,function($query,$value){
    //          $query->where('name','LIKE',"%$value%");

    //      })->get();
    //     if(count($hotel)){
    //         return response()->json([
    //             'status'=>true,
    //             'data'=>$hotel
    //         ]);
    //     }
    //     return response()->json([
    //         'status'=>false,
    //         'message'=>"there is no data "
    //     ]);
    //  }
    // public function nearPlaces(Request $reques){
    // $lat =;
    // $lon = YOUR_CURRENT_LONGITUDE;

    //     $data = DB::table("users")
    //         ->select("users.id"
    //             ,DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
    //             * cos(radians(users.lat)) 
    //             * cos(radians(users.lon) - radians(" . $lon . ")) 
    //             + sin(radians(" .$lat. ")) 
    //             * sin(radians(users.lat))) AS distance"))
    //             ->groupBy("users.id")
    //             ->get();

    //   dd($data);
    // }

}
