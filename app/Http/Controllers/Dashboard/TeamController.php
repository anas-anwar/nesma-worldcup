<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\PlayerDatatable;
use App\DataTables\TeamDatatable;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Player;
use App\Models\Stadium;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\Match_;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TeamDatatable $teams)
    {
        return $teams->render('dashboard.Team.index', ['title'=> 'Team Page']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stadiums=Stadium::all();
        $groups=Group::all();
        return view('dashboard.Team.create',[
            'stadiums'=>$stadiums,
            'groups'=>$groups
        ]);
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
            [ "name"=>"required|string",
              "stadium_id"=>"nullable",
              "logo"=>"required|image",
              'shirt_color'=>"required|string",
              "group_id"=>"required",
              "flag"=>'required|image'

            ]
            );

            
            if ($request->hasFile('logo')) {
                $image=$request->logo;
               
                $path = 'public/Teams/Logo/';
                $logo = time() + rand(1, 10000000000) . '.' . $image->getClientOriginalExtension();
                Storage::disk('local')->put($path . $logo, file_get_contents($image));
                Storage::disk('local')->exists($path . $logo);
               
            }
            if ($request->hasFile('flag')) {
                $image_f=$request->flag;
               
                $path = 'public/Teams/Flags/';
                $flag = time() + rand(1, 10000000000) . '.' . $image_f->getClientOriginalExtension();
                Storage::disk('local')->put($path . $flag, file_get_contents($image_f));
                Storage::disk('local')->exists($path . $flag);
               
            }



    $team=new Team();
    $team->name=$request->name;
    $team->stadium_id=$request->stadium_id;
    $team->shirt_color=$request->shirt_color;
    $team->group_id=$request->group_id;
   // return $logo;
    $team->logo=$logo;
    $team->flag_url=$flag;
    
    $result=$team->save();
    return redirect('teams')->with('add_status', $result);
   


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team = team::with(['group','stadium'])->findOrFail($id);
       $players=$team->Players;
        // dd($stadium);
        return view('dashboard.Team.show', ['title'=> 'Team Page','team'=>$team,'players'=>$players]);    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team = team::with(['group','stadium'])->findOrFail($id);
        $stadiums=Stadium::all();
        $groups=Group::all();
        // dd($stadium);
        return view('dashboard.Team.edit', ['team' => $team,
        'stadiums'=>$stadiums,
        'groups'=>$groups]);
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
        $team=Team::with(['group','stadium'])->findOrFail($id);
        $request->validate(
            [ "name"=>"required|string",
              "stadium_id"=>"nullable",
              "logo"=>"image|nullable",
              'shirt_color'=>"required|string",
              "group_id"=>"required",
              "flag"=>'image|nullable'

            ]
            );

           $image=null;
            if ($request->hasFile('logo')) {
                $image=$request->logo;
               
                $path = 'public/Teams/Logo/';
                $logo = time() + rand(1, 10000000000) . '.' . $image->getClientOriginalExtension();
                Storage::disk('local')->put($path . $logo, file_get_contents($image));
                Storage::disk('local')->exists($path . $logo);
               
            }
              if($image !=null ){
                    Storage::disk('local')->delete('public/Teams/Logo/'.$team->logo);
                    $team->logo=$logo;
                                   }
               $image_f=null;
            if ($request->hasFile('flag')) {
                $image_f=$request->flag;
               
                $path = 'public/Teams/Flags/';
                $flag = time() + rand(1, 10000000000) . '.' . $image_f->getClientOriginalExtension();
                Storage::disk('local')->put($path . $flag, file_get_contents($image_f));
                Storage::disk('local')->exists($path . $flag);
               
            }

            if($image_f !=null ){
                Storage::disk('local')->delete('public/Teams/Flags/'.$team->flag_url);
                $team->flag_url=$flag;
            }

   
    $team->name=$request->name;
    $team->stadium_id=$request->stadium_id;
    $team->shirt_color=$request->shirt_color;
    $team->group_id=$request->group_id;
   // return $logo;
   
    
    $result=$team->save();
    return redirect('teams')->with('add_status', $result);    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team= Team::findOrFail($id);
        Storage::disk('local')->delete('public/Teams/Logo/'.$team->logo);
        Storage::disk('local')->delete('public/Teams/Flags/'.$team->flag_url);
        $team->delete();
        return response()->json([
             'success'=> true,
         ]);
    }


    /////////////////////////////////////////////////////////// Player///////////////////////
    public function addPlayer($id){
        $team= Team::with('players')->findOrFail($id);
       
        // return $images;
         return view('dashboard.Team.addPlayers',['team'=>$team]);
    
     }
     public function storePlayer(Request $request,$id){
        
         $request->validate(
             ["name"=>"required|string",
             "nationality"=>"required|string",
             "birthdate"=>"required|date",
             "height"=>"required|numeric|min:150|max:220",
             "weight"=>"required|numeric|min:50|max:120",

             ]
             );
$request->merge(['team_id'=>$id]);
$result=Player::create($request->all());
return redirect()->route('teams.show',$id)->with(["status"=>$result]);
     }

     public function editPlayer($id){
        // return $id;
        $player= Player::findOrFail($id);
       
        // return $images;
         return view('dashboard.Team.editPlayer',['player'=>$player]);
    
     }
     public function updatePlayer(Request $request,$id){
         $player=Player::with('team')->findOrFail($id);
        $request->validate(
            ["name"=>"required|string",
            "nationality"=>"required|string",
            "birthdate"=>"required|date",
            "height"=>"required|numeric|min:150|max:220",
            "weight"=>"required|numeric|min:50|max:120",

            ]
            );
$request->merge(['team_id'=>$player->team->id]);
$result=Player::create($request->all());
return redirect()->route('teams.show',$player->team->id)->with(["status"=>$result]);
    }
    public function deletePlayer($id)
    {
        $player= Player::findOrFail($id);
        
        $player->delete();
        return response()->json([
             'success'=> true,
         ]);
    }

   


}
