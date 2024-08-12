<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'JAAR Platform' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    @stack('css')
    @livewireStyles
</head>

<body>
    <!-- Start Header -->
    <nav class="header bg-navbar-orignization">
        <div class="container-custom">
            <div class="navbar">

                <div class="navbar-logo">
                    <a href="{{ url('/') }}"><img src="{{ asset('assets/images/nav-logo.svg') }}" alt="logo" /></a>
                </div>
                <div class="mob-overlay"></div>

                <div class="sidebar-wrapper">
                    <div class="sidebar-container">
                        <p>Main Menu</p>
                        <div id="burgerBtn"></div>
                        <ul>
                            <li><a class="{{ Route::is('website.welcome') ? 'active' : '' }}"
                                    href="{{ url('/') }}">Home</a>
                            </li>
                            <li><a class="{{ Route::is('website.leadership') ? 'active' : '' }}"
                                    href="{{ route('website.leadership') }}">Leadership</a></li>
                            <li><a class="{{ Route::is('website.educators') ? 'active' : '' }}"
                                    href="{{ route('website.educators') }}">Educators</a></li>
                            <li><a class="{{ Route::is('website.studentsandparents') ? 'active' : '' }}"
                                    href="{{ route('website.studentsandparents') }}">Students & Parents</a></li>
                            <li><a class="{{ Route::is('website.educationdeployment') ? 'active' : '' }}"
                                    href="{{ route('website.educationdeployment') }}">Education Deployment</a></li>
                            <li><a class="{{ Route::is('website.learnandbuy') ? 'active' : '' }}"
                                    href="{{ route('website.learnandbuy') }}">Learn & buy</a></li>
                            <li>
                                @if (authCheck())
                                <a href="{{ route('user.logout') }}">Logout</a>
                                @else
                                <a class="{{ Route::is('user.login') ? 'active' : '' }}"
                                    href="{{ route('user.login') }}">Sign in</a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>

                <button class="navbar-toggler" type="button" id="sidebar_toggler"
                    style="background-color: transparent; height: 53px; cursor: pointer;">
                    <svg xmlns="{{ asset('assets/images/menu.svg') }}" fill="#FFFFFF" height="30" width="30"
                        viewBox="0 0 448 512" id="menuIcon">
                        <path
                            d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>
    <!-- End Header -->
    {{ $slot }}


    @livewire('website.components.footer')

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('js')
    {{-- <script src="{{ asset('js/script.js') }}"> </script> --}}
    <script>
        function handleToggleModal() {
                Livewire.dispatch('open-modal');
            }
    </script>
</body>

</html>
