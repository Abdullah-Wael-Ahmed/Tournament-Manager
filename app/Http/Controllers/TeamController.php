<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamParticipation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TeamController extends Controller
{

    public function __construct()
    {
        $this->middleware([
            'authControl',
            'userOnly',
        ]);

        $this->middleware('notInATeam')->only([
            'create',
            'insert',
            'join',
            'joinFunc'
        ]);
        $this->middleware('inATeam')->only([
            'show',
            'leave',
            'regenerateKey' 
        ]);
    }

    public function create()
    {
        return view('Team.create');
    }

    public function join(){
        return view('Team.join');
    }

    public function insert(Request $req)
    {
        $req->validate([
            'name' => 'required'
        ]);

        $uniqueKey = strtoupper(substr(sha1(microtime()), rand(0, 5), 20));
        $uniqueKey  = implode("-", str_split($uniqueKey, 5));

        $team = Team::create([
            'name' => $req->name,
            'team_key' => $uniqueKey
        ]);

        User::findorfail(Auth::user()->id)->update([
            'team_id' => $team->id
        ]);

        return redirect()->route('home');
    }

    public function show($id = null){
        if($id){
            return view('Team.show',[
                'team' => Team::withSum('teamParticipations','score')->teamWithMembers($id),
                'events' => TeamParticipation::where('team_id','=',$id)->with('event:id,name')->get()
            ]);
        }
        return view('Team.show',[
            'team' => Team::withSum('teamParticipations','score')->teamWithMembers(Auth::user()->team_id),
            'events' => TeamParticipation::where('team_id','=',Auth::user()->team_id)->with('event:id,name')->get()
        ]);
    }

    

    public function joinFunc(Request $req){
        $req->validate([
            'key' => 'required'
        ]);

        $team = Team::where('team_key','=',$req->key)->withCount('users')->first();

        if(!$team){
            throw ValidationException::withMessages([
                'key' => "This team doesn't exist"
            ]);
        }
        if($team->users_count >= 4){
            throw ValidationException::withMessages([
                'key' => "Team is full"
            ]);
        }

        User::findorfail(Auth::user()->id)->update([
            'team_id' => $team->id
        ]);

        return redirect()->route('team.profile');
    }

    public function regenerateKey(Request $req){
        $uniqueKey = strtoupper(substr(sha1(microtime()), rand(0, 5), 20));
        $uniqueKey  = implode("-", str_split($uniqueKey, 5));

        Team::findorfail(Auth::user()->team_id)->update([
            "team_key" => $uniqueKey
        ]);

        return redirect()->route('team.profile');
    }

    public function leave(Request $req){
        User::findorfail(Auth::user()->id)->update([
            'team_id' => null
        ]);

        return redirect()->route('home');
    }
}

