<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function events(){
        return $this->hasMany(Event::class);
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'photo'
    ];
}
