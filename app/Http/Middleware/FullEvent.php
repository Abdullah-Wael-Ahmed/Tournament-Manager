<?php

namespace App\Http\Middleware;

use App\Models\Event;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class FullEvent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->team_id){
            $event = Event::where('id','=',$request->id)->withCount('teamParticipations')->first();
        if ($event){
            if($event->team_participations_count >= 5){
                return redirect()->route('home')->with([
                    'error' => 'This event is already has reached the maximum amount of team participations'
                ]);
            }
        }
        }else{
            $event = Event::where('id','=',$request->id)->withCount('participations')->first();
            if ($event){
                if($event->participations_count >= 20){
                    return redirect()->route('home')->with([
                        'error' => 'This event is already has reached the maximum amount of participations'
                    ]);
                }
            }
        }
        return $next($request);
    }
}
