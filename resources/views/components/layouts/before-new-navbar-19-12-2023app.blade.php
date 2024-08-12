<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'DEFAULT TITLE' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    @stack('css')
    @livewireStyles
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo-white.png') }}" alt="Logo" width="30" height="24"
                    class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('website.welcome') ? 'active' : '' }} " aria-current="page" href="{{ url('/') }}">@lang('app.home')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('website.leadership') ? 'active' : '' }} " href="{{ route('website.leadership') }}">Leadership</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('website.educators') ? 'active' : '' }} " href="{{ route('website.educators') }}">Educator</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('website.studentsandparents') ? 'active' : '' }} " href="{{ route('website.studentsandparents') }}">Student & Parents</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('website.educationdeployment') ? 'active' : '' }} " href="{{ route('website.educationdeployment') }}">Education Deployment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('website.learnandbuy') ? 'active' : '' }} " href="{{ route('website.learnandbuy') }}">Learn & Buy</a>
                    </li>
                    <li class="nav-item">
                        @if (authCheck())
                        <a class="nav-link " href="{{ route('user.logout') }}">Logout</a>
                        @else
                        <a class="nav-link {{ Route::is('user.login') ? 'active' : '' }}" href="{{ route('user.login') }}">Sign in</a>
                        @endif
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    {{ $slot }}

    @livewire('website.components.footer')
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    @stack('js')
    {{-- <script src="{{ asset('js/script.js') }}"> </script> --}}
    <script>
        function handleToggleModal() {
            Livewire.dispatch('open-modal');
        }
    </script>
</body>

</html>
