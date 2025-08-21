<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'teacher_id',
        'completed'
    ];

    public function questions(){
        return $this->hasMany(Question::class);
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }

    public function participations(){
        return $this->hasMany(Participation::class);
    }

    public function teamParticipations(){
        return $this->hasMany(TeamParticipation::class);
    }

    public function scopeEventWithQuestions(Builder $query,int $id, $completed = null) : Builder|QueryBuilder{
        if(!$completed){
            return $query->where('id','=',$id)
            ->where('completed','=',1)
            ->select('id','teacher_id','name','category')
            ->with([
                'questions' => fn($q) => $q->select('id','event_id','question','score','correct_choice')->with('choices:question_id,choice,id')
            ]);
        }else{
            return $query->where('id','=',$id)
            ->select('id','teacher_id','name','category')
            ->with([
                'questions' => fn($q) => $q->select('id','event_id','question','score','correct_choice')->with('choices:question_id,choice,id')
            ]);
        }
    }

    public function scopeGetEvents(Builder $query) : Builder|QueryBuilder{
        return $query->select('id','teacher_id','name','category')
        ->where('completed','=',1)
        ->withCount([
            'participations',
            'teamParticipations'
            ])
        ->withSum('questions','score')
        ->with('teacher:id,name');
    }
}
