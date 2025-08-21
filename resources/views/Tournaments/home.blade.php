@extends('layouts.app')

@section('title','Events')

@section('Content')

@if (session()->has('score'))
    <div class="alert alert-dismissible alert-success container mt-5">
        You got a score of {{session('score')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
    
@if (session()->has('error'))
    <div class="alert alert-dismissible alert-danger container mt-5">
        {{session('error')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<h1 class="oxygen ms-5 mt-5" >Ongoing Events</h1>
    <div class="container d-grid mt-5">
        <div class="row">
            @foreach ($events as $event)
            <div class="col-12 col-md-6 col-lg-4 mb-5">
                    
                <div class="p-3 position-relative" style="background-color:#F5F5F5;border-radius:5px;box-shadow:3px 3px 3px 3px lightgrey">
                    <div class="d-flex mx-1 justify-content-between">
                        <div class="oxygen" style="font-size: 24px">{{$event->name}}</div>
                        <div class="oxygen" style="font-size: 24px">
                            <div class="d-flex">
                                <div class="d-flex align-items-center me-1 align-items-center">
                                    <div class="oxygen">    
                                        {{$event->participations_count}}
                                    </div>
                                    <i class="fa-solid fa-user ms-2"></i>
                                </div>
                                <div class="mx-2" style="border-left: 2px solid grey;height:35px;border-radius:5px"></div>
                                <div class="d-flex ms-1 align-items-center">
                                    <div class="oxygen">    
                                        {{$event->team_participations_count}}
                                    </div>
                                    <i class="fa-solid fa-users ms-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mx-2 oxygen mt-1" style="color: grey;font-size:14px">
                        Teacher : {{$event->teacher->name}} <br>
                        Total score : {{$event->questions_sum_score}} Pts <br>
                        Category : {{$event->category}}
                    </div>
                    <a href="
                    @auth
                    {{route('tourament.event',$event->id)}}
                    @endauth
                    @if (Auth('admin')->check()||Auth('teacher')->check())
                        {{route('view.event',$event->id)}}
                    @endif
                    " class="btn position-absolute oxygen" style="bottom: 10px;right:10px;background-color:#ffbd16;border-radius:25px;font-size:18px">
                        @auth
                        Join
                        @endauth
                        @if (Auth('admin')->check()||Auth('teacher')->check())
                            view
                        @endif
                        <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

@endsection