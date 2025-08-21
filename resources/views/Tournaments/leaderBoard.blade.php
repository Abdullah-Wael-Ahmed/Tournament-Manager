@extends('layouts.app')

@section('title','LeaderBoard')

@section('Style')

<style>
    ::-webkit-scrollbar {
    width: 3px; /* Width of the scrollbar */
}

::-webkit-scrollbar-track {
    background: rgb(255, 255, 255,0); /* Background color of the scrollbar track */
}

::-webkit-scrollbar-thumb {
    background: #000000; /* Color of the scrollbar thumb */
    border-radius: 5px; /* Radius of the scrollbar thumb */
}

::-webkit-scrollbar-thumb:hover {
    background: #555; /* Color of the scrollbar thumb on hover */
}
</style>

@endsection

@section('Content')

<div class="container mt-5">
    <div class="users mb-3">
        <h1 class="oxygen">Users</h1>
        <div class="d-flex flex-column mt-4 ms-5">
            <div class="d-flex w-100 justify-content-between">
                <h3 class="oxygen">Ranking</h3>
                <h3 class="oxygen" style="color:#828282">Score</h3>
            </div>
            <div class="d-flex flex-column mt-3" style="overflow-y: scroll;height:300px">
                @php
                    $counter = 1;
                @endphp
                @forelse ($users as $user)
                <div class="d-flex justify-content-center align-items-center mb-3">
                    <div class="oxygen me-4 d-flex align-items-center justify-content-center" style="background-color:
                    @if($counter == 1)
                    #ffbd16
                    @elseif($counter == 2)
                    #D0D0D0
                    @elseif($counter == 3)
                    #8B5D43
                    @else
                    #000000
                    ;color:white;
                    @endif
                    ;text-align:center;width:50px;height:50px;border-radius:50%;font-size:20px;box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);">{{$counter}}</div>
                    <div class="d-flex w-100 justify-content-between p-3" style="background-color: #F5F5F5;border-radius:12.5px;box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                        <div class="oxygen">{{$user->name}}</div>
                        <div class="oxygen">{{$user->participations_sum_score??0}} Pts</div>
                    </div>
                </div>
                @php
                    $counter++;
                @endphp
                @empty
                <div class="d-flex justify-content-center align-items-center mt-3">No users yet</div>
                @endforelse
            </div>
        </div>
    </div>
    <div class="users mt-5 mb-5">
        <h1 class="oxygen">Teams</h1>
        <div class="d-flex flex-column mt-4 ms-5">
            <div class="d-flex w-100 justify-content-between">
                <h3 class="oxygen">Ranking</h3>
                <h3 class="oxygen" style="color:#828282">Score</h3>
            </div>
            <div class="d-flex flex-column mt-3" style="overflow-y: scroll;height:300px">
                @php
                    $counter = 1;
                @endphp
                @forelse ($teams as $team)
                <div class="d-flex justify-content-center align-items-center mb-3">
                    <div class="oxygen me-4 d-flex align-items-center justify-content-center" style="background-color:
                    @if($counter == 1)
                    #ffbd16
                    @elseif($counter == 2)
                    #D0D0D0
                    @elseif($counter == 3)
                    #8B5D43
                    @else
                    #000000
                    ;color:white;
                    @endif
                    ;text-align:center;width:50px;height:50px;border-radius:50%;font-size:20px;box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);">{{$counter}}</div>
                    <div class="d-flex w-100 justify-content-between p-3" style="background-color: #F5F5F5;border-radius:12.5px;box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                        <div class="oxygen">{{$team->name}}</div>
                        <div class="oxygen">{{$team->team_participations_sum_score??0}} Pts</div>
                    </div>
                </div>
                @php
                    $counter++;
                @endphp
                @empty
                <div class="d-flex justify-content-center align-items-center mt-3 oxygen">No teams yet</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection