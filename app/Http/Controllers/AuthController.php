<?php

namespace App\Http\Controllers;

use App\Models\Participation;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except(['logOut','profile']);
    }

    public function signIn(){
        return view('Authentication.sign_in');
    }
    public function signUp(){
        return view('Authentication.sign_up');
    }
    public function logIn(Request $req){
        $req->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if(Auth::guard('admin')->attempt(['email' => $req->email, 'password' => $req->password],$req->remember)){
            $req->session()->regenerate();
            return redirect()->route('home');
        }
        else if (Auth::guard('teacher')->attempt(['email' => $req->email, 'password' => $req->password],$req->remember)){
            $req->session()->regenerate();
            return redirect()->route('home');
        }
        else if(Auth::attempt(['email' => $req->email, 'password' => $req->password],$req->remember)){
            $req->session()->regenerate();
            return redirect()->route('home');
        }

        throw ValidationException::withMessages([
            'email' => 'Email or Password are incorrect'
        ]);
    }

    public function Register(Request $req){
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

        User::insert([
            'name' => $req->firstName . " " . $req->lastName,
            'email' => $req->email,
            'gender' => $req->gender,
            'password' => Hash::make($req->password),
            'photo' => $imageName
        ]);

        Auth::attempt(['email' => $req->email, 'password' => $req->password]);
        $req->session()->regenerate();
        return redirect()->route('home');
    }

    public function logOut(Request $req){
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect()->route('user.sign_in');
    }
    
    public function profile($id = null){
        if ($id){
            return view('User.profile',[
                'user' => User::findorfail($id)->withSum('participations','score'),
                'events' => Participation::userParticipations($id)->get(),
                'team' => $this->teamWithUsers($id)
            ]);
        }else{
            if(Auth::check()){
                return view('User.profile',[
                    'user' =>  User::withSum('participations','score')->findorfail(Auth::user()->id),
                    'events' => Participation::userParticipations(Auth::user()->id)->get(),
                    'team' => $this->teamWithUsers(Auth::user()->id)
                ]);
            }else if (Auth::guard('teacher')->check()){
                return view('User.profile',[
                    'user' => Auth::guard('teacher')->user(),
                    'events' => 'none',
                    'team' => 'none'
                ]);
            }else if (Auth::guard('admin')->check()){
                return view('User.profile',[
                    'user' => Auth::guard('admin')->user(),
                    'events' => 'none',
                    'team' => 'none'
                ]);
            }else{
                abort(404);
            }
        }
    }
    private function teamWithUsers(int $id){
        $user = User::findorfail($id);
        if ($user->team_id){
            return Team::select('id','name')->findorfail($user->team_id)->load([
                'users' => fn($q) => $q->select('id','team_id','name','photo')
            ]);
        }   
        else{
            return 'none';
        }
    }
}