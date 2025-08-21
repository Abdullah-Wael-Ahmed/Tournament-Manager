<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamParticipation extends Model
{
    use HasFactory;

    public function team(){
        return $this->belongsTo(Team::class);
    }
    public function event(){
        return $this->belongsTo(Event::class);
    }
}
