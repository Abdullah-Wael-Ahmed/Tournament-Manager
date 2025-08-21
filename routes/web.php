<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(EventController::class)->group(function(){
    Route::get('/','index')->name('home');
    Route::get('/event/{id}','show')->name('tourament.event');
    Route::post('/event/{id}','calculateScore')->name('event.calculateScore');
    Route::get('/{id}/event','viewEvent')->name('view.event')->where('id','[0-9]+');
    Route::get('/teacher/events','teacherEvents')->name('teacher.events');
    Route::get('/add','add')->name('event.add');
    Route::post('/add','insert')->name('event.insert');
    Route::get('/add/question','questionForm')->name('event.questionForm');
    Route::post('/add/question','question')->name('event.question');
    Route::post('/add/publish','publish')->name('event.publish');
    Route::get('/leaderBoard','leaderBoard')->name('leaderBoard');
});

Route::controller(AdminController::class)->group(function(){
    Route::get('/add/teacher','teacherAdd')->name('teacher.add');
    Route::post('/add/teacher','teacherCreate')->name('teacher.create');
    Route::get('/dashboard/teacher','dashboardTeacher')->name('dashboard.teacher');
    Route::get('/dashboard/event','dashboardEvent')->name('dashboard.event');
    Route::get('/dashboard/team','dashboardTeam')->name('dashboard.team');
    Route::get('/dashboard/user','dashboardUser')->name('dashboard.user');
    Route::post('/dashboard/teacher/delete','deleteTeacher')->name('teacher.delete');
    Route::post('/dashboard/event/delete','deleteEvent')->name('event.delete');
    Route::post('/dashboard/team/delete','deleteTeam')->name('team.delete');
    Route::post('/dashboard/user/delete','deleteUser')->name('user.delete');
});

Route::controller(AuthController::class)->group(function(){
    Route::get('/sign-up','signUp')->name('user.sign_up');
    Route::get('/sign-in','signIn')->name('user.sign_in');
    Route::post('/sign-in','logIn')->name('user.logIn');
    Route::post('/sign-out','logOut')->name('user.logOut')->middleware('authControl');
    Route::post('/sign-up','register')->name('user.register');
    Route::get('/profile/{id?}','profile')->name('user.profile')->middleware('authControl');
});

Route::controller(TeamController::class)->group(function(){
    Route::get('/create/team','create')->name('team.create');
    Route::post('/create/team','insert')->name('team.insert');
    Route::get('/team{id?}','show')->name('team.profile');
    Route::get('/team/join','join')->name('team.join');
    Route::post('/team/join','joinFunc')->name('team.joinFunc');
    Route::post('/team/key','regenerateKey')->name('team.key');
    Route::post('/team/leave','leave')->name('team.leave');
});

Route::post('/asd',function(Request $req){
    return response()->json($req);
});