@extends('layouts.app')

@section('title', 'Teachers')

@section('Content')
    <div class="container-fluid mt-5">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a href="{{ route('dashboard.teacher') }}" class="nav-link active oxygen text-decoration-none"
                    style="color:black">Teachers</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard.event') }}" class="nav-link oxygen text-decoration-none"
                    style="color:black">Events</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard.team') }}" class="nav-link oxygen text-decoration-none"
                    style="color:black">Teams</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard.user') }}" class="nav-link oxygen text-decoration-none"
                    style="color:black">Users</a>
            </li>
        </ul>
    </div>
    <div class="container-fluid">

        <table class="table mt-1 table-striped">
            <tr>
                <th class="oxygen">ID</th>
                <th class="oxygen">Name</th>
                <th class="oxygen">Email</th>
                <th class="oxygen">N.o events</th>
                <th class="oxygen">Action</th>
            </tr>
            @forelse ($teachers as $teacher)
                <tr>
                    <td class="oxygen">{{ $teacher->id }}</td>
                    <td class="oxygen">{{ $teacher->name }}</td>
                    <td class="oxygen">{{ $teacher->email }}</td>
                    <td class="oxygen">{{ $teacher->events_count }}</td>
                    <td class="oxygen">
                        <form style="padding:0px;margin:0px" action="{{ route('teacher.delete') }}" method="POST">@csrf
                            <input type="number" name="id" value="{{ $teacher->id }}" class="d-none"> <input
                                type="submit" class="btn btn-danger" value="Delete"></form>
                    </td>
                </tr>
            @empty
            <tr>
                <td class="oxygen" colspan="5">No teachers</td>
            </tr>
            @endforelse

        </table>
        <a href="{{ route('teacher.add') }}" class="btn oxygen mt-3" style="background-color: #ffbd16">Add a Teacher</a>
    </div>
@endsection
