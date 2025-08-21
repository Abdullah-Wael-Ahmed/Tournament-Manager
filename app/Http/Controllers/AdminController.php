<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Teacher;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function __construct()
    {  
        $this->middleware('admin');
    }

    public function teacherAdd(){
        return view('admin.teacherAdd');
    }

    public function teacherCreate(Request $req){
        $req->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'gender' => 'in:1,2|required',
            'photo' => 'sometimes|file|mimes:png,jpg,jpeg|max:15360',
            'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,16}$/',
            'email' => 'required|email|unique:users,email|unique:admins,email|unique:teachers,email',
        ],[
            'regex' => 'password must be from 8 to 16 chacters long and contain atleast a lowercase, uppercase, special character and a number'
        ]);

        if($req->password !== $req->passwordRepeat){
            throw ValidationException::withMessages([
                'passwordRepeat' => 'Passwords do not match'
            ]);
        }

        $imageName = 'defaultPFP.png';

        if ($req->has('photo')){
            $image = $req->photo;
            $imageName = time()."_".$image->getClientOriginalName();
            $image->move(public_path('assets/images/profilePics'),$imageName);
        }

        Teacher::create([
            'name' => $req->firstName . " " . $req->lastName,
            'email' => $req->email,
            'gender' => $req->gender,
            'password' => Hash::make($req->password),
            'photo' => $imageName
        ]);
        return redirect()->route('home');
    }
    
    public function dashboardTeacher(){
        return view('admin.teacherDashboard',[
            'teachers' => Teacher::select('id','name','email')->withCount('events')->get()
        ]);
    }

    public function dashboardEvent(){
        return view('admin.eventDashboard',[
            'events' => Event::select('id','name','category','completed','teacher_id')
            ->with('teacher:id,name')
            ->withSum('questions','score')
            ->withCount([
                'questions',
                'participations',
                'teamParticipations'
            ])
            ->get()
        ]);
    }

    public function dashboardTeam(){
        return view('admin.teamDashboard',[
            'teams' => Team::select('id','name')
            ->withCount([
                'teamParticipations',
                'users'
            ])
            ->withSum('teamParticipations','score')
            ->get()
        ]);
    }
    public function dashboardUser(){
        return view('admin.userDashboard',[
            'users' => User::select('id','name','email','team_id')
            ->withCount([
                'participations'
            ])
            ->withSum('participations','score')
            ->with('team:id,name')
            ->get()
        ]);
        
    }

    public function deleteTeacher(Request $req){
        $req->validate([
            "id" => "required"
        ]);

        Teacher::findorfail($req->id)->delete();

        return redirect()->route('dashboard.teacher');
    }

    public function deleteEvent(Request $req){
        $req->validate([
            'id' => 'required'
        ]);

        Event::findorfail($req->id)->delete();

        return redirect()->route('dashboard.event');
    }

    public function deleteTeam(Request $req){
        $req->validate([
            'id' => 'required'
        ]);

        Team::findorfail($req->id)->delete();

        return redirect()->route('dashboard.team');
    }
    public function deleteUser(Request $req){
        $req->validate([
            'id' => 'required'
        ]);

        User::findorfail($req->id)->delete();

        return redirect()->route('dashboard.user');
    }
}
