@extends('layouts.app')

@section('title', 'Sign In')

@section('Style')
    <style>
        body {
            background-color: #FFFEF6;
        }

        .form-control:focus {
            border-color: lightgrey;
            box-shadow: 0 0 0 0.25rem rgba(0, 0, 0, 0.25);
        }

        form {
            width: 40%
        }

        @media only screen and (max-width:768px) {
            form {
                width: 75%
            }
        }

        .custom-file-upload {
            
        }

        .custom-file-upload input[type="file"] {
            display: none;
        }
    </style>
@endsection
@section('Content')
@auth('admin')
{{Auth::guard('admin')->check()}}
@endauth
    <div class="container d-flex align-item-center " style="margin-top: 100px">
        <form action="{{route('user.logIn')}}" method="POST" class="form m-auto p-4"
            style="background-color: #F5F5F5;border-radius : 12.5px;box-shadow:6px 6px 10px 0px lightgrey"
            >
            @csrf
            <h1 class="oxygen">Sign in</h1>
            <div style="width:90%" class="mt-5 m-auto d-grid">
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="email" class="form-label oxygen">Email</label>
                            <input type="email" name="email" id="email" class="form-control oxygen"
                                style="background-color: #D9D9D9;border-radius:50px" value='{{old('email')}}' />
                            <small id="helpId" class="text-danger">@error('email'){{$message}}@enderror</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="password" class="form-label oxygen">Password</label>
                            <input type="password" name="password" id="password" class="form-control oxygen"
                                style="background-color: #D9D9D9;border-radius:50px" />
                            <small id="helpId" class="text-danger">@error('password'){{$message}}@enderror</small>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 mt-2">
                    <div for="remember" class="oxygen d-flex align-items-center">Remember me?
                        <input type="checkbox" value="1" name="remember" id="remember" class="ms-2" style="">
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="oxygen" style="color:grey;">New here? <a class=" text-decoration-none" href="{{route('user.sign_up')}}" style="color:#ffb700">Sign up</a></div>
                        <input type="submit" class="btn w-25 oxygen" style="border:none;border-radius:50px;background-color:#ffbd16">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
