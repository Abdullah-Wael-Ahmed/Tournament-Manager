<!doctype html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/trophy-solid.svg') }}">
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/8c78e594e2.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <style>
        .oxygen {
            font-family: "Oxygen", sans-serif;
            font-weight: 700;
            font-style: normal;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        body{
            background-color: #FFFEF6;
        }
    </style>
    @yield('Style')
</body>
<nav class="navbar navbar-expand-lg" style="background-color: #ffbd16">
    <div class="container-fluid">
        <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center">
            <div style="font-size: 40px">
                <i class="fa-solid fa-trophy"></i>
            </div>
            <div class="mx-2" style="border-left: 4px solid;height:45px;border-radius:5px"></div>
            <div class="oxygen">Tournament<br>Manager</div>
        </a>

        @if (Auth::check() || Auth::guard('admin')->check() || Auth::guard('teacher')->check())

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-row-reverse" id="navbarSupportedContent">
                <form action="{{ route('user.logOut') }}" method="POST">
                    @csrf
                    <input type="submit" value="Log out" class="btn btn-danger">
                </form>
                <a href="{{ route('user.profile') }}" class="text-decoration-none fa-solid fa-circle-user me-3"
                    style="font-size: 40px;color:black"></a>

                <a href="{{route('leaderBoard')}}" class="oxygen text-decoration-none me-3" style="color:black">Leader Board</a>
                @auth
                    @if (Auth::user()->team_id)
                        <a href="{{ route('team.profile') }}" class="me-3 oxygen text-decoration-none"
                            style="color: black">Team</a>
                    @else
                        <a href='{{ route('team.create') }}' class="me-3 oxygen text-decoration-none"
                            style="color: black">Create a team</a>
                        <a href='{{ route('team.join') }}' class="me-3 oxygen text-decoration-none"
                            style="color: black">Join a team</a>
                    @endif
                @endauth

                @if (Auth::guard('admin')->check())
                    <a href='{{route('dashboard.teacher')}}' class="me-3 oxygen text-decoration-none" style="color:black;">Dashboard</a>

                @elseif (Auth::guard('teacher')->check())
                    <a href="{{ route('teacher.events') }}" class="me-3 oxygen text-decoration-none"
                        style="color:black;">Events</a>
                @endif
            </div>


        @endif
    </div>
</nav>
@yield('Content')

</html>
