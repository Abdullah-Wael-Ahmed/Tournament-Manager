<?php

namespace App\Http\Middleware;

use App\Models\Participation;
use App\Models\TeamParticipation;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class participationOnce
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->team_id) {
            $part = TeamParticipation::where("team_id", '=', Auth::user()->team_id)
                ->where('event_id', '=', $request->id)
                ->first();

            if ($part) {
                return redirect()->route('home')->with([
                    'error' => 'Your team has already particpated in this event'
                ]);
            }
        } else {

            $part = Participation::where("user_id", '=', Auth::user()->id)
                ->where('event_id', '=', $request->id)
                ->first();

            if ($part) {
                return redirect()->route('home')->with([
                    'error' => 'You have already particpated in this event'
                ]);
            }
        }

        return $next($request);
    }
}
