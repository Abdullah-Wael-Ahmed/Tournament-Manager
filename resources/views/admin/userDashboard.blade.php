@extends('layouts.app')

@section('title','Users')

@section('Content')
<div class="container-fluid mt-5">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a href="{{route('dashboard.teacher')}}" class="nav-link oxygen text-decoration-none" style="color:black">Teachers</a>
        </li>
        <li class="nav-item">
            <a href="{{route('dashboard.event')}}" class="nav-link oxygen text-decoration-none" style="color:black">Events</a>
        </li>
        <li class="nav-item">
            <a href="{{route('dashboard.team')}}" class="nav-link oxygen text-decoration-none" style="color:black">Teams</a>
        </li>
        <li class="nav-item">
            <a href="{{route('dashboard.user')}}" class="nav-link active oxygen text-decoration-none" style="color:black">Users</a>
        </li>
    </ul>
</div>
    <div class="container-fluid">
        
        <table class="table mt-1 table-striped">
            <tr>
                <th class="oxygen">ID</th>
                <th class="oxygen">Name</th>
                <th class="oxygen">Email</th>
                <th class="oxygen">Total Score</th>
                <th class="oxygen">N.o participations</th>
                <th class="oxygen">Team</th>
                <th class="oxygen">Action</th>
            </tr>
            @forelse ($users as $user)
            <tr>
                <td class="oxygen">{{$user->id}}</td>
                <td class="oxygen">{{$user->name}}</td>
                <td class="oxygen">{{$user->email}}</td>
                <td class="oxygen">{{$user->participations_sum_score??0}} Pts</td>
                <td class="oxygen">{{$user->participations_count}}</td>
                <td class="oxygen">{{$user->team->name??null}}</td>
                <td class="oxygen"><form style="padding:0px;margin:0px" action="{{route('user.delete')}}" method="POST">@csrf <input type="number" name="id" value="{{$user->id}}" class="d-none"> <input type="submit" class="btn btn-danger" value="Delete"></form></td>
            </tr>    
            @empty
                <tr>
                    <td class="oxygen" colspan="6">No Teams</td>
                </tr>
            @endforelse
            
        </table>
    </div>
@endsection