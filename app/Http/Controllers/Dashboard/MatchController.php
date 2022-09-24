<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\MatchDatatable;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\MatchModel;
use App\Models\Player;
use App\Models\Round;
use App\Models\Stadium;
use App\Models\Team;
use App\Models\TypeOfEvent;
use App\Models\User;
use App\Notifications\NewEventNotification;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MatchDatatable $matches)
    {
       // return Carbon::now();
        return $matches->render('dashboard.Matche.index', ['title' => 'Matches Page']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teams = Team::all();
        $stadiums = Stadium::all();
        $rounds = Round::all();
        return view(
            'dashboard.Matche.create',
            [
                "title" => 'Create Matche',
                'teams' => $teams,
                'stadiums' => $stadiums,
                'rounds' => $rounds
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                "date_time" => 'required',
                
                'stadium_id' => 'required',
                'localteam_id' => 'required',
                'visitorteam_id' => 'required|different:localteam_id',
                'round_id' => 'required'

            ]
        );
    // $date=  date_create_from_format('Y-m-d H:i:s', $request->date_time);
    //  $date=DateTime::createFromFormat('Y-m-d H:i:s', $request->date_time);
    //   return  var_dump($date) ;
    $request->merge([
        'second'=> 0 
    ]);
    //return $request->all();
        $matche = new MatchModel();
        $matche->date_time=$request->date_time;
        $matche->localteam_id=$request->localteam_id;
        $matche->stadium_id=$request->stadium_id;
        $matche->visitorteam_id=$request->visitorteam_id;
        $matche->round_id=$request->round_id;
       
        $result=$matche->save();
        //User::find(1)->notify(new NewEventNotification(new Event()));
        return;
        return redirect()->route('matches.index')->with(['add_status' => $result]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $matche = MatchModel::with(['round', 'localTeam', 'visitorTeam', 'stadium', 'event'])->findOrFail($id);
        $events = $matche->event;
        
        return view('dashboard.Matche.show', [
            'matche' => $matche,
            'events' => $events
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $matche = MatchModel::with(['round', 'localTeam', 'visitorTeam', 'stadium'])->findOrFail($id);
        $teams = Team::all();
        $stadiums = Stadium::all();
        $rounds = Round::all();
        $date_time=(new Carbon($matche->date_time))->format('Y-m-d H:i:s');
        return view('dashboard.Matche.edit', [
            'matche' => $matche,
            'teams' => $teams,
            'stadiums' => $stadiums,
            'rounds' => $rounds,
            'date_time'=>$date_time
        ]);
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
        $request->validate(
            [
                "date_time" => 'required',
                
                'stadium_id' => 'required',
                'localteam_id' => 'required',
                'visitorteam_id' => 'required|different:localteam_id',
                'round_id' => 'required'

            ]
        );
        $matche = MatchModel::with(['round', 'localTeam', 'visitorTeam', 'stadium'])->findOrFail($id);
        $date_time=(new Carbon($request->date_time))->format('Y-m-d H:i:s');
        $matche->date_time=$date_time;
        $matche->localteam_id=$request->localteam_id;
        $matche->stadium_id=$request->stadium_id;
        $matche->visitorteam_id=$request->visitorteam_id;
        $matche->round_id=$request->round_id;
        $result=$matche->update();
// return $matche;
        return redirect()->route('matches.index')->with(['add_status' => $result]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $matche = MatchModel::findOrFail($id);
        $matche->delete();
        return response()->json([
            'success' => true,
        ]);
    }

    //////////////////////////////////////////////event//////////////////////////

    public function addEvent($id)
    {
        $matche = MatchModel::with(['event', 'round', 'localTeam', 'visitorTeam', 'stadium'])->findOrFail($id);
        $player_local = $matche->localTeam->Players;
        $player_visitor = $matche->visitorTeam->Players;
        $type_of_events = TypeOfEvent::all();
        $user = User::where('type', '=', 'admin')->get();
        // $user->notify();

        return view('dashboard.Matche.addEvent', [
            'matche' => $matche,
            'player_local' => $player_local,
            'player_visitor' => $player_visitor,
            'type_of_events' => $type_of_events
        ]);
    }

    public function storeEvent(Request $request, $id)
    {
        $matche = MatchModel::with(['event', 'round', 'localTeam', 'visitorTeam', 'stadium'])->findOrFail($id);

        $request->validate([
            "minute" => 'required',
            'player1_id' => 'required',
            'player2_id' => 'Different:player1_id',
            'type_of_events_id' => 'required',


        ]);
        $player = Player::findOrFail($request->player1_id);
        $request->merge([
            "team_id" => $player->team_id,
            "match_id" => $id
        ]);
        $result = Event::create($request->all());
        return redirect()->route('matches.show', $id)->with(["status" => $result]);
    }

    public function editEvent($id)
    {
        // return $id;
        $event = Event::with(['Teams', 'Players', 'TypeOfEvents'])->findOrFail($id);
        $matche = $event->Matches;
        $player_local = $matche->localTeam->Players;
        $player_visitor = $matche->visitorTeam->Players;
        $type_of_events = TypeOfEvent::all();
        // return $images;
        return view('dashboard.Matche.editEvent', [
            'event' => $event,
            'player_local' => $player_local,
            'player_visitor' => $player_visitor,
            'type_of_events' => $type_of_events
        ]);
    }
    public function updateEvent(Request $request, $id)
    {
        $event = Event::with(['Teams', 'Players', 'TypeOfEvents'])->findOrFail($id);
        $matche = $event->Matches;

        $request->validate([
            "minute" => 'required',
            'player1_id' => 'required',
            'player2_id' => 'Different:player1_id',
            'type_of_events_id' => 'required',


        ]);
        $player = Player::findOrFail($request->player1_id);
        $request->merge([
            "team_id" => $player->team_id,
            "match_id" => $matche->id
        ]);
        $result = $event->update($request->all());
        return redirect()->route('matches.show',$matche->id)->with(["status" => $result]);
    }

    public function deleteEvent($id)
    {
        $event = Event::findOrFail($id);

        $event->delete();
        return response()->json([
            'success' => true,
        ]);
    }
}
