<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use App\Models\Event;
use App\Models\Participation;
use App\Models\Question;
use App\Models\Team;
use App\Models\TeamParticipation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    public function __construct()
    {
        $this->middleware('authControl');
        $this->middleware([
                'userOnly',
                'participatedOnce',
                'fullEvent'
            ])->only([
            'show',
            'calculateScore'
        ]);

        $this->middleware([
            'higherAuth'
        ])->only([
            'viewEvent',
        ]);

        $this->middleware([
            'teacher'
        ])->only([
            'add',
            'teacherEvents'
        ]);
    }

    public function questionForm(){
        return view('Tournaments.question');
    }

    public function leaderBoard(){
        return view('Tournaments.leaderBoard',[
            'users' => User::select('id','name')
            ->withSum('participations','score')
            ->orderBy('participations_sum_score','desc')
            ->take(10)
            ->get(),
            'teams' => Team::select('id','name')
            ->withSum('teamParticipations','score')
            ->orderBy('team_participations_sum_score','desc')
            ->take(10)
            ->get()
        ]);
    }

    public function publish(Request $req){
        $req->validate([
            'question' => 'required',
            'score' => 'required',
            'choice1' => 'required',
            'choice2' => 'required',
            'choice3' => 'required',
            'choice4' => 'required',
            'correct' => 'required|in:1,2,3,4',
        ]);
        $this->addQuestion($req);
        Event::findorfail(session('eventId'))->update([
            'completed' => 1
        ]);
        session()->forget('eventId');
        return redirect()->route('teacher.events');
    }

    public function question(Request $req){
        $req->validate([
            'question' => 'required',
            'score' => 'required',
            'choice1' => 'required',
            'choice2' => 'required',
            'choice3' => 'required',
            'choice4' => 'required',
            'correct' => 'required|in:1,2,3,4',
        ]);
        $this->addQuestion($req);
        return view('Tournaments.question');
    }

    private function addQuestion(Request $req){
        
    $question = Question::create([
        'question' => $req->question,
        'score' => $req->score,
        'event_id' => session('eventId'),
    ]);
    $choice1 = Choice::create([
        'choice' => $req->choice1,
        'question_id' => $question->id
    ]);
    $choice2 = Choice::create([
        'choice' => $req->choice2,
        'question_id' => $question->id
    ]);
    $choice3 = Choice::create([
        'choice' => $req->choice3,
        'question_id' => $question->id
    ]);
    $choice4 = Choice::create([
        'choice' => $req->choice4,
        'question_id' => $question->id
    ]);

    if ($req->correct == 1){
        $question->update([
            'correct_choice' => $choice1->id
        ]);
    }else if($req->correct == 2){
        $question->update([
            'correct_choice' => $choice2->id
        ]);
    }
    else if($req->correct == 3){
        $question->update([
            'correct_choice' => $choice3->id
        ]);
    }
    else if($req->correct == 4){
        $question->update([
            'correct_choice' => $choice4->id
        ]);
    }

    }

    public function insert(Request $req){
        $req->validate([
            'eventName' => 'required',
            'eventCategory' => 'required'
        ]);

        $event = Event::create([
            'name' => $req->eventName,
            'category' => $req->eventCategory,
            'teacher_id' => Auth('teacher')->user()->id
        ]);
        
        session(['eventId'=>$event->id]);

        return redirect()->route('event.questionForm');

    }

    public function add(){
        return view('Tournaments.add');
    }

    public function teacherEvents(){
        return view('Tournaments.show',[
            'events' => Event::where('teacher_id','=',Auth('teacher')->user()->id)
            ->withCount([
                'participations',
                'teamParticipations'
            ])
            ->withSum('questions','score')
            ->get(),
        ]);
    }

    public function viewEvent($id){
        if (Auth('teacher')->check()){
            $event = Event::findorfail($id);
            if($event->teacher_id == Auth('teacher')->user()->id){
                return view('Tournaments.event',[
                    'event' => Event::eventWithQuestions($id,1)->first()
                ]);
            }
        }
        return view('Tournaments.event',[
            'event' => Event::eventWithQuestions($id)->first()
        ]);
    }

    public function index()
    {
        return view('Tournaments.home', [
            'events' => Event::getEvents()->get()
        ]);
    }

    public function show($id)
    {
        $event = Event::findorfail($id);
        return view('Tournaments.event', [
            'event' => Event::eventWithQuestions($id)->first()
        ]);
    }

    public function calculateScore(Request $req)
    {
        $score = 0;
        $event = Event::eventWithQuestions($req->id)->first();
        foreach($event->questions as $question){
            $solvedQuestion = $req[$question->id]??null;
            if($solvedQuestion){
                if($question->correct_choice == $solvedQuestion) $score += $question->score;
            }
        }

        if(Auth::user()->team_id){
            TeamParticipation::insert([
                'team_id' => Auth::user()->team_id,
                'event_id' => $req->id,
                'score' => $score
            ]);
        }else{   
            Participation::insert([
                'user_id' => Auth::user()->id,
                'event_id' => $req->id,
                'score' => $score
            ]);
        }
            
        return redirect()->route('home')->with([
            'score' => $score
        ]);
    }
}
