<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'team_key'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function teamParticipations(){
        return $this->hasMany(TeamParticipation::class);
    }

    public function scopeTeamWithMembers(Builder $query, int $id){
        return $query->findOrFail($id)
        ->load([
            'users' => fn($q) => $q->select('id','team_id','name','photo')
        ]);
    }
}
