<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\TeamController;
use App\Models\Event;
use App\Models\Participation;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/events',function(){
    return response()->json(
        User::findorfail(2)->load([
            'team' => fn($q) => $q->with('users')
        ])
    );
});

Route::get('/team',[TeamController::class,'api']);
