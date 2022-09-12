<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountOdd;
use Illuminate\Http\Request;
use App\Models\MatchModel;
use App\Models\Player;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MatchController extends Controller
{
    public function index()
    {

        $current_time_c = Carbon::now();
        $current_time = (new Carbon($current_time_c))->format('Y-m-d H:i:s');

        $Live_match = MatchModel::
            //  with('LineUp')
            // ->with('LineUp.Teams')
            //  ->with('LineUp.Players')
            with("visitorTeam")
            ->with('winnerTeam')
            ->with('visitorTeam')
            ->with('localTeam')
            ->with('Event')
            ->with('Event.Players')
            ->with('Event.TypeOfEvents')
            ->with('round')
            ->with('stadium')

            ->where(function ($query) use ($current_time) {

                $query->where('date_time', '<=', $current_time);
            })
            ->get();




        return response()->json([
            'status' => true,
            'message' => 'Show Matches',
            'data' => [
                'Live Matches' => $Live_match
            ],
        ]);
    }

    public function show($id, $account_id)
    {
        $account_odd = AccountOdd::with('Accounts')->where('account_id', $account_id)->where('match_id', $id)->first();
        $match = MatchModel::find($id);
        // return ($account_odd);
        if (!empty($account_odd)) {
            $statistics = AccountOdd::where('match_id', $id)->select( DB::raw('sum( case when vote = ' . $match->localteam_id . ' then 1 else 0 end) as localteam'), DB::raw('sum( case when vote = ' . $match->visitorteam_id . ' then 1 else 0 end) as visitorteam'),DB::raw('sum( case when vote IS NULL then 1 else 0 end) as equal'))
            ->GroupBy('match_id')->first();
            

            $account_odd->sum = $statistics->localteam + $statistics->visitorteam + $statistics->equal;
            $account_odd->equal = $statistics->equal * 100 / $account_odd->sum;
            $account_odd->localteam = $statistics->localteam * 100 / $account_odd->sum;
            $account_odd->visitorteam = $statistics->visitorteam * 100 / $account_odd->sum;
            $result = true;
        } else {
            // $account_odd 
            $result = false;
        }
        $match = MatchModel::with(['event', 'event.Players', 'event.Playerassesst', 'event.TypeOfEvents'])->findOrFail($id);
        $event = $match->event->toArray();

        $data = array();
        foreach ($event as $value) {
            //  return response()->json($value['type_of_events']['name']);  
            $data[] = [
                'type_of_event_id' => $value['type_of_events_id'],
                'team_id' => $value['team_id'],
                'type_of_events' => $value['type_of_events']['name'],
                'minute' => $value['minute'],
                'extra_minute' => $value['extra_minute'],
                'player_1_name' => $value['players']['name'],
                'playerassesst' => $value['playerassesst'] ? $value['playerassesst']['name'] : null,
            ];
            //  return response()->json($value);  
        }

        // $data=json_encode($data);
        //return response()->json($data);  
        return response()->json(
            [
                'status' => 200,
                'message' => 'Show Match' . $match->id,
                'data' => [
                    'id' => $match->id,
                    // 'result' => $result,
                    "date_time" => (new Carbon($match->date_time))->format('Y-m-d H:i:s'),
                    "local_team_id" => $match->localTeam->id,
                    "local_team_name" => $match->localTeam->name,
                    "local_team_logo" => $match->localTeam->logo,
                    "visitor_team_id" => $match->visitorTeam->id,
                    "visitor_team_name" => $match->visitorTeam->name,
                    "vistor_team_logo" => $match->visitorTeam->logo,
                    "winner_team_name" => $match->winnerTeam,
                    'localteam_score' => $match->localteam_score,
                    'visitorteam_score' => $match->visitorteam_score,
                    'localteam_pen_score' => $match->localteam_pen_score,
                    'visitorteam_pen_score' => $match->visitorteam_pen_score,
                    'ht_score' => $match->ht_score,
                    'ft_score' => $match->et_score,
                    'et_score' => $match->ft_score,
                    'ps_score' => $match->ps_score,
                    'status' => $match->status,
                    'round' => $match->round,
                    'stadium' => $match->stadium()->with('images')->first(),
                    "events" => $data,
                    "voting" => $result,
                    "account_odd" => $account_odd
                ]
            ]
        );
    }
}
