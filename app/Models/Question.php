<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function choices(){
        return $this->hasMany(Choice::class);
    }

    public function event(){
        return $this->belongsTo(Event::class);
    }

    protected $fillable = [
        'question',
        'score',
        'event_id',
        'correct_choice'
    ];
}
