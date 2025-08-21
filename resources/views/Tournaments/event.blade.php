@extends('layouts.app')

@section('title', $event->name)

@section('Style')
    
    <style>
        .choice{
            width:15%
        }
        @media only screen and (max-width:768px){
            .choice{
                width: 25%;
            }
        }
    </style>

@endsection

@section('Content')

    <div class="container mt-5">
        <h1 class="oxygen">{{ $event->name }}</h1>
        <form action="/event/{{$event->id}}" method="post" class="ms-4 mt-5 position-relative">
            @csrf
            @foreach ($event->questions as $question)
                <div class="container mb-5">
                    <h5 class="oxygen mb-3">
                        {{ $question->question }}
                        <span class="ms-2 btn" style="background-color:#ffbd16;box-shadow:2px 2px 5px 1px grey">{{$question->score}} Pts</span>
                    </h5>
                    
                    @foreach ($question->choices as $choice)
                    <div class="container mb-3">
                        <div class="p-2 choice" style="background-color:#F5F5F5;border-radius:3px;box-shadow:2px 2px 1px 1px lightgrey">
                            <input type="radio" class=" form-check-input" name="{{ $question->id }}" value="{{$choice->id}}">
                            <label for="" class="oxygen ms-2" style="color:grey">{{ $choice->choice }}</label> <br>
                            
                        </div>
                    </div>
                    @endforeach
                </div>
            @endforeach
            @auth
            <input type="submit" class=" position-absolute btn oxygen" style="bottom: 0px;right: 20px;background-color:#ffbd16">
            @endauth
        </form>
    </div>
@endsection
