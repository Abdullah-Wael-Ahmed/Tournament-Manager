@extends('layouts.app')

@section('title', 'New Event')

@section('Style')
    <style>
        #cont{
            width: 50%
        }
        @media only screen and (max-width:768px){
            #cont{
                width:85%
            }
        }
    </style>
@endsection

@section('Content')
    <div id="cont" class="container mt-5 m-auto">

        <form id="form" method="post" action="{{ route('event.question') }}">
            @csrf
            <div class="mb-3">
                <div class="row">
                    <div class="col-9">
                        <label for="question" class="form-label oxygen">Question</label>
                        <input type="text" name="question" id="question" class="form-control oxygen" placeholder=""
                        aria-describedby="helpId" value="{{old('question')}}" />
                        <small id="helpId" class="text-danger oxygen">@error('question'){{$message}}@enderror</small>
                    </div>
                    <div class="col-3">
                        <label for="score" class="form-label oxygen">Score</label>
                        <input type="number" name="score" id="score" class="form-control oxygen" placeholder=""
                        aria-describedby="helpId" value="{{old('score')}}" />
                        <small id="helpId" class="text-danger oxygen">@error('score'){{$message}}@enderror</small>
                    </div>
                </div>
            </div>
            <div class="mb-3">

                <div class="row">
                    <div class="col-3">
                        <input type="radio" class=" form-check-input" name="correct" value="1">
                        <label for="choice1" class="form-label oxygen">Choice 1</label>
                        <input type="text" name="choice1" id="choice1" class="form-control oxygen" placeholder=""
                        aria-describedby="helpId" value="{{old('choice1')}}" />
                        <small id="helpId" class="text-danger oxygen">@error('choice1'){{$message}}@enderror</small>
                    </div>
                    <div class="col-3">
                        <input type="radio" class=" form-check-input" name="correct" value="2">
                        <label for="choice2" class="form-label oxygen">Choice 2</label>
                        <input type="text" name="choice2" id="choice2" class="form-control oxygen" placeholder=""
                        aria-describedby="helpId" value="{{old('choice2')}}" />
                        <small id="helpId" class="text-danger oxygen">@error('choice2'){{$message}}@enderror</small>
                    </div>
                    <div class="col-3">
                        <input type="radio" class=" form-check-input" name="correct" value="3">
                        <label for="choice3" class="form-label oxygen">Choice 3</label>
                        <input type="text" name="choice3" id="choice3" class="form-control oxygen" placeholder=""
                        aria-describedby="helpId" value="{{old('choice3')}}" />
                        <small id="helpId" class="text-danger oxygen">@error('choice3'){{$message}}@enderror</small>
                    </div>
                    <div class="col-3">
                        <input type="radio" class=" form-check-input" name="correct" value="4">
                        <label for="choice4" class="form-label oxygen">Choice 4</label>
                        <input type="text" name="choice4" id="choice4" class="form-control oxygen" placeholder=""
                        aria-describedby="helpId" value="{{old('choice4')}}" />
                        <small id="helpId" class="text-danger oxygen">@error('choice4'){{$message}}@enderror</small>
                    </div>
                </div>
                @error('correct')<small id="helpId" class="text-danger oxygen">{{$message}}</small>@enderror
            </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" id="addQst" class="btn btn-primary oxygen">Add a question</button>
                    <button id="publish" class="btn oxygen" style="background-color: #ffbd16">Publish</button>
                </div>
            </form>
        </div>

        <script>
            let btn = document.getElementById('publish')
            btn.onclick = function(){
                let form = document.getElementById('form')
                form.setAttribute('action','{{route('event.publish')}}')
                form.submit()
            }
        </script>
        @endsection
