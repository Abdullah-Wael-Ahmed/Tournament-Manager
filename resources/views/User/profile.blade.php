@extends('layouts.app')

@section('title', $user->name)

@section('Content')
    <div class="container mt-5">
        <div class="flex flex-row">
            <img class="me-2 rounded-circle" style="box-shadow: 1px 4px 20px 2px lightgrey" width="180" height="180"
                src="{{ asset("assets/images/profilePics/$user->photo") }}">
            <div class="d-inline ms-5 oxygen" style="font-size:32px">{{ $user->name }}</div>
        </div>
        <div class="row mt-5">
            <div class="col-12 col-lg-4 mb-5">
                @if ($events != 'none')
                    
                <h4 class=" oxygen">Total Points</h4>
                <div class="flex mt-3">
                    <div class="oxygen d-inline" style="font-size:18px">{{$user->participations_sum_score??0}} Pts <i class="fa-solid fa-star" style="color:#FFD977"></i></div>
                </div>
                @endif
                @if ($team != 'none')
                    
                
                <h4 class="mt-4 oxygen mt-5">Current Team</h4>
                <div class="flex mt-3 ms-2 p-2 w-75"
                    style="background-color:#F5F5F5;border-radius:12.5px;box-shadow:3px 3px 2px 2px lightgrey">
                    <h4 class="ms-3">{{$team->name}}</h4>
                    @foreach ($team->users as $user) 
                    <div class="flex ms-3 mt-3">
                        <img class="me-2 rounded-circle" style="box-shadow: 1px 4px 20px 2px lightgrey" width="40"
                            height="40" src="{{ asset("assets/images/profilePics/$user->photo") }}">
                        <div class="d-inline oxygen">{{ $user->name }}</div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            @if ($events != 'none')
            <div class="col-12 col-lg-8">         
                <h4 class="oxygen">Events</h4>
                <div class="flex mt-4 p-3 w-50"
                    style="background-color:#F5F5F5;border-radius:12.5px;box-shadow:3px 3px 2px 2px lightgrey">
                    <div class="d-flex justify-content-between">
                        <p class="oxygen" style="color:grey">Event</p>
                        <p class="oxygen" style="color:grey">Score</p>
                    </div>
                    @forelse ($events as $event)
                    <div class="d-flex mt-3 justify-content-between">
                        <p class="oxygen">{{$event->event->name}}</p>
                        <p class="oxygen">{{$event->score}}</p>
                    </div>
                    @empty
                        <div class="oxygen">User hasn't Participated in any events yet</div>
                    @endforelse
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
