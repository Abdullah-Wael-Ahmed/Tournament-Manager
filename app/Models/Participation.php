<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function event(){
        return $this->belongsTo(Event::class);
    }

    public function scopeUserParticipations(Builder $qeury,int $id){
        $qeury->where('user_id','=',$id)
        ->select('id','user_id','event_id','score')
        ->with('event:id,name');
    }
}
