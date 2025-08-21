@extends('layouts.app')

@section('title','Events')

@section('Content')
<div class="container-fluid mt-5">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a href="{{route('dashboard.teacher')}}" class="nav-link oxygen text-decoration-none" style="color:black">Teachers</a>
        </li>
        <li class="nav-item">
            <a href="{{route('dashboard.event')}}" class="nav-link active oxygen text-decoration-none" style="color:black">Events</a>
        </li>
        <li class="nav-item">
            <a href="{{route('dashboard.team')}}" class="nav-link oxygen text-decoration-none" style="color:black">Teams</a>
        </li>
        <li class="nav-item">
            <a href="{{route('dashboard.user')}}" class="nav-link oxygen text-decoration-none" style="color:black">Users</a>
        </li>
    </ul>
</div>
    <div class="container-fluid">
        
        <table class="table mt-1 table-striped">
            <tr>
                <th class="oxygen">ID</th>
                <th class="oxygen">Name</th>
                <th class="oxygen">Category</th>
                <th class="oxygen">Status</th>
                <th class="oxygen">Teacher</th>
                <th class="oxygen">Total Score</th>
                <th class="oxygen">N.o questions</th>
                <th class="oxygen">N.o participations</th>
                <th class="oxygen">N.o team participations</th>
                <th class="oxygen">Action</th>
            </tr>
            @forelse ($events as $event)
            <tr>
                <td class="oxygen">{{$event->id}}</td>
                <td class="oxygen">{{$event->name}}</td>
                <td class="oxygen">{{$event->category}}</td>
                <td class="oxygen">{{$event->completed?'published':'pending'}}</td>
                <td class="oxygen">{{$event->teacher->name}}</td>
                <td class="oxygen">{{$event->questions_sum_score}}</td>
                <td class="oxygen">{{$event->questions_count}}</td>
                <td class="oxygen">{{$event->participations_count}}</td>
                <td class="oxygen">{{$event->team_participations_count}}</td>
                <td class="oxygen"><form style="padding:0px;margin:0px" action="{{route('event.delete')}}" method="POST">@csrf <input type="number" name="id" value="{{$event->id}}" class="d-none"> <input type="submit" class="btn btn-danger" value="Delete"></form></td>
            </tr>    
            @empty
                <tr>
                    <td class="oxygen" colspan="10">No Events</td>
                </tr>
            @endforelse
            
        </table>
    </div>
@endsection