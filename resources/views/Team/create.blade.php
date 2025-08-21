@extends('layouts.app')

@section('title', 'Create a team')

@section('Style')
    <style>
        

        .form-control:focus {
            border-color: lightgrey;
            box-shadow: 0 0 0 0.25rem rgba(0, 0, 0, 0.25);
        }

        .teamForm {
            width: 40%
        }

        @media only screen and (max-width:768px) {
            .teamForm {
                width: 75%
            }
        }
    </style>
@endsection
@section('Content')
    <div class="container d-flex align-item-center " style="margin-top: 150px">
        <form action="{{route('team.insert')}}" method="POST" class="form m-auto p-4 teamForm position-relative"
            style="background-color: #F5F5F5;border-radius : 12.5px;box-shadow:6px 6px 10px 0px lightgrey"
            >
            @csrf
            <h1 class="oxygen">Create a Team!</h1>
            <div style="width:90%" class="mt-4 m-auto d-grid">
                <div class="row">
                    <div class="col">
                        <div class="mb-5">
                            <label for="name" class="form-label oxygen">Team Name</label>
                            <input type="text" name="name" id="name" class="form-control oxygen"
                                style="background-color: #D9D9D9;border-radius:50px" value='{{old('name')}}' />
                            <small id="helpId" class="name-danger">@error('name'){{$message}}@enderror</small>
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="d-flex justify-content-between align-items-center">
                        <input type="submit" class="btn w-25 oxygen position-absolute" style="border:none;border-radius:50px;background-color:#ffbd16;bottom:20px;right:10px;">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
