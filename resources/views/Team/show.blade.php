@extends('layouts.app')

@section('title', $team->name)

@section('Content')
    <div class="container mt-5 m-auto">
        <div class="d-flex justify-content-between">
            <div style="font-size: 4rem" class="oxygen">{{ $team->name }}</div>
            @if ($team->id == Auth::user()->team_id)
                <form action="{{ route('team.leave') }}" method="POST">
                    @csrf
                    <input type="submit" class="btn btn-danger oxygen" value="Leave Team">
                </form>
            @endif
        </div>
        <div class="row mt-5">
            <div class="col-12 col-lg-4">
                @if ($team->id == Auth::user()->team_id)
                    <form action="{{ route('team.key') }}" method="POST" class="form">
                        @csrf
                        <div class="mb-3">
                            <div class="d-flex align-items-center">
                                <div style="font-size:2rem" class="oxygen">Team Key</div>
                                <!-- Button trigger modal -->
                                <button type="button" class="ms-2"
                                    style="border: none;background-color:#FFFEF6;padding:0px;margin:0px;font-size:20px"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fa-solid fa-circle-question" style="color: #000000;"></i>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5 oxygen" id="exampleModalLabel">Team Key</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body oxygen">
                                                To invite other people to join the team, use the team key. <br> <br>
                                                Give this key to any other people you would want to invite, and they will be
                                                able to enter with ease. <br> <br>
                                                You may easily change this key by clicking the blue regeneration button if
                                                you have given it to the wrong individual.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary oxygen"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mt-4">
                                <div for="" class="form-label oxygen  p-2"
                                    style="background-color:#D9D9D9;border-radius:25px;">
                                    {{ $team->team_key }}
                                    <button type="submit" style="background:none;border:none;:margin: 0px">
                                        <i class="fa-solid fa-arrows-rotate p-2"
                                            style="background-color: #1456FF;border-radius:25px;color:white"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                @endif
                <div class="mt-4 mb-3">
                    <div class="oxygen" style="font-size: 2rem">Members</div>
                    <div class="w-75 p-4 mt-3"
                        style="background-color: #F5F5F5; border-radius:12.5px; box-shadow:3px 3px 2px 2px lightgrey">
                        @forelse ($team->users as $user)
                            <div class="d-flex mb-3 align-items-center">
                                <img class="me-2 rounded-circle" style="box-shadow: 1px 4px 20px 2px lightgrey"
                                    width="40" height="40"
                                    src="{{ asset("assets/images/profilePics/$user->photo") }}">
                                <div class="oxygen">{{ $user->name }}</div>
                            </div>

                        @empty

                            <div class="d-flex mb-3 align-items-center">
                                <div class="oxygen">
                                    This team doesn't have any members :/
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="oxygen" style="font-size: 2rem">Participations</div>
                <div class="w-75 p-4 mb-3"
                    style="background-color: #F5F5F5; border-radius:12.5px; box-shadow:3px 3px 2px 2px lightgrey">
                    <table class="table table-borderless">
                        <tr>
                            <td class="oxygen" style="background: none;color:#828282">Event</td>
                            <td class="oxygen" style="background: none;color:#828282">Score</td>
                        </tr>
                        @forelse ($events as $event)
                            <tr>
                                <td class="oxygen" style="background: none">{{ $event->event->name }}</td>
                                <td class="oxygen" style="background: none">{{ $event->score }} Pts</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="oxygen" style="background: none">This team hasn't participated in any events yet
                                </td>
                            </tr>
                        @endforelse
                    </table>
                </div>
                @if ($events != [])
                    <div class="oxygen" style="font-size:2rem">Total Score : {{ $team->team_participations_sum_score ?? 0 }}
                        Pts <i class="fa-solid fa-star" style="color:#ffbd16"></i></div>
                @endif

            </div>
        </div>
    </div>

@endsection
