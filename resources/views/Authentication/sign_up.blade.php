@extends('layouts.app')

@section('title', 'Sign Up')

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
            width: 50%
        }

        .cont{
            margin-top: 50px
        }

        @media only screen and (max-width:768px) {
            form {
                width: 75%
            }
            .cont{
                margin-top:50px
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
    <div class="container d-flex align-item-center mb-5 cont">
        <form action="{{route('user.register')}}" method="POST" class="form m-auto p-4"
            style="background-color: #F5F5F5;border-radius : 12.5px;box-shadow:6px 6px 10px 0px lightgrey"
            enctype="multipart/form-data">
            @csrf
            <h1 class="oxygen">Sign up</h1>
            <div style="width:90%" class="mt-5 m-auto d-grid">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="firstName" class="form-label oxygen">First Name</label>
                            <input type="text" name="firstName" id="firstName" class="form-control oxygen"
                                style="background-color: #D9D9D9;border-radius:50px" value='{{old('firstName')}}' />
                            <small id="helpId" class="oxygen text-danger">@error('firstName'){{$message}}@enderror</small>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="lastName" class="form-label oxygen">Last Name</label>
                            <input type="text" name="lastName" id="lastName" class="form-control oxygen"
                                style="background-color: #D9D9D9;border-radius:50px" value='{{old('lastName')}}' />
                            <small id="helpId" class="oxygen text-danger">@error('lastName'){{$message}}@enderror</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-9">
                        <div class="mb-3">
                            <label for="email" class="form-label oxygen">Email</label>
                            <input type="email" name="email" id="email" class="form-control oxygen"
                                style="background-color: #D9D9D9;border-radius:50px" value='{{old('email')}}' />
                            <small id="helpId" class="oxygen text-danger">@error('email'){{$message}}@enderror</small>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="mb-3">
                            <label for="gender" class="form-label oxygen">gender</label>
                            <select name="gender" id="gender" class="form-control form-select oxygen"
                                style="background-color: #D9D9D9;border-radius:50px">
                                <option value="0" hidden selected></option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                            </select>
                            <small id="helpId" class="oxygen text-danger">@error('gender'){{$message}}@enderror</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="password" class="form-label oxygen">Password</label>
                            <input type="password" name="password" id="password" class="form-control oxygen"
                                style="background-color: #D9D9D9;border-radius:50px" />
                            <small id="helpId" class="oxygen text-danger">@error('password'){{$message}}@enderror</small>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="passwordRepeat" class="form-label oxygen">Password repeat</label>
                            <input type="password" name="passwordRepeat" id="passwordRepeat" class="form-control oxygen"
                                style="background-color: #D9D9D9;border-radius:50px" />
                            <small id="helpId" class="oxygen text-danger">@error('passwordRepeat'){{$message}}@enderror</small>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 mt-2">
                    <div class="d-flex align-items-center">
                        <div class="oxygen me-3" style="font-size:20px">Photo</div>
                        <label for="photo" class="custom-file-upload">
                            <input type="file" name="photo" id="photo">
                            <div style="border-radius: 50%;background-color:#D9D9D9;width:40px;height:40px" class="d-flex p-2 align-content-center justify-content-center">
                                <i class="fa-solid fa-upload" style="font-size: 20px"></i>
                            </div>
                            <small class="text-danger">@error('photo'){{$message}}@enderror</small>
                        </label>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="oxygen" style="color:grey;">Already have an account? <a class=" text-decoration-none" href="{{route('user.sign_in')}}" style="color:#D79B00">Sign in</a></div>
                        <input type="submit" class="btn w-25 oxygen" style="border:none;border-radius:50px;background-color:#ffbd16">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
