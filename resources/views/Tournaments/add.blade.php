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

        <form id="form" method="post" action="{{ route('event.insert') }}">
            @csrf
            <div class="mb-3">
                <div class="row">
                    <div class="col-8">
                        <label for="eventName" class="form-label oxygen">Event Name</label>
                        <input type="text" name="eventName" id="eventName" class="form-control oxygen" placeholder=""
                        aria-describedby="helpId" value="{{old('eventName')}}" />
                        <small id="helpId" class="text-danger oxygen">@error('eventName'){{$message}}@enderror</small>
                    </div>
                    <div class="col-4">
                        <label for="eventCategory" class="form-label oxygen">Event Category</label>
                        <input type="text" name="eventCategory" id="eventCategory" class="form-control oxygen" placeholder=""
                        aria-describedby="helpId" value="{{old('eventCategory')}}" />
                        <small id="helpId" class="text-danger oxygen">@error('eventCategory'){{$message}}@enderror</small>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <button type="submit" id="addQst" class="btn btn-primary oxygen">Add a question</button>
            </div>
        </form>
    </div>
@endsection
