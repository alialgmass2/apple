<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{@csrf_token()}}">
    <title>{{ $title ?? 'JAAR Platform' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/spinner.css') }}">
    <link rel="stylesheet" href="{{ asset('css/organization.css') }}">
    @if (App::isLocale('ar'))
    <link rel="stylesheet" href="{{ asset('assets/css/rtl.css') }}">
    @endif
    @stack('css')
    @livewireStyles
</head>

<body>
    <!-- Start Header -->
    <nav class="header bg-navbar-orignization">
        <div class="container-custom">
            <div class="navbar-custom">
                <div class="navbar-custom-logo">
                    <a href="{{route('user.organization.organizations')}}"><img src="{{ asset('assets/images/nav-logo.svg') }}" alt="logo" /></a>
                </div>
                <div class="mob-overlay"></div>

                <div class="sidebar-wrapper">
                    <div class="sidebar-container">
                        <!-- <p>Main Menu</p> -->
                        <div class="sidebar-container-header container-custom">
                            <img src="{{ asset('assets/images/nav-logo.svg') }}" alt="logo" />
                            <div id="burgerBtn">
                                <img src="{{ asset('assets/images/close-icon.svg') }}" alt="" srcset="">
                            </div>
                        </div>
                        <ul>
                            <li><a class="{{ Route::is('website.welcome') ? 'active' : '' }}"
                                    href="{{ url('/') }}">@lang('app.home')</a>
                            </li>
                            <li><a class="{{ Route::is('website.leadership') ? 'active' : '' }}"
                                    href="{{ route('website.leadership') }}">@lang('app.leadership')</a></li>
                            <li><a class="{{ Route::is('website.educators') ? 'active' : '' }}"
                                    href="{{ route('website.educators') }}">@lang('app.educators')</a></li>
                            <li><a class="{{ Route::is('website.studentsandparents') ? 'active' : '' }}"
                                    href="{{ route('website.studentsandparents') }}">@lang('app.students_and_parents')</a>
                            </li>
                            <li><a class="{{ Route::is('website.educationdeployment') ? 'active' : '' }}"
                                    href="{{ route('website.educationdeployment') }}">@lang('app.education_deployment')</a>
                            </li>
                            <li><a class="{{ Route::is('website.learnandbuy') ? 'active' : '' }}"
                                    href="{{ route('website.learnandbuy') }}">@lang('app.learn_and_buy')</a></li>

                            @if (authUser() != null && authUser()->otp_verified)
                            <li>
                                <div class="custom-dropdown">
                                    <button class="dropbtn">@lang('app.profile')</button>
                                    <div id="myDropdown" class="dropdown-content">
                                        <a href="{{ route('user.organization.organizations') }}">{{
                                           authUser() != null ? authUser()->organization->translate('name') : '' }}</a>
                                        <a href="{{ route('user.orders.index') }}"> Order tracking </a>
                                        <a href="{{ route('user.logout') }}">@lang('app.logout')</a>
                                    </div>
                                </div>
                            </li>
                            <li class="cart-link">
                                @livewire('user.components.cart-icon')
                                {{-- <a class="{{ Route::is('carts.index') ? 'active' : '' }}"
                                    href="{{ route('carts.index') }}">
                                    <span>{{auth()->user()->cart()->count()}}</span>
                                    <img src="{{ asset('assets/images/cart.png') }}" width="16" height="16" alt="" />
                                </a> --}}
                            </li>
                            @else
                            <li class="cart-link">
                                @livewire('user.components.cart-icon')
                                {{-- <a class="{{ Route::is('carts.index') ? 'active' : '' }}"
                                    href="{{ route('carts.index') }}">
                                    <span>{{auth()->user()->cart()->count()}}</span>
                                    <img src="{{ asset('assets/images/cart.png') }}" width="16" height="16" alt="" />
                                </a> --}}
                            </li>
                            <li>
                                <a class="{{ Route::is('user.login') ? 'active' : '' }}"
                                    href="{{ route('user.login') }}">@lang('app.sign_in')</a>
                            </li>
                            @endif
                            {{-- <li>
                                @if (App::isLocale('en'));
                                <a class="" href="{{ route('website.localize',['ar']) }}">@lang('app.arabic')</a>
                                @else
                                <a class="" href="{{ route('website.localize',['en']) }}">@lang('app.english')</a>
                                @endif
                            </li> --}}
                            {{-- <li>
                                @if (authCheck())
                                <a class="nav-link " href="#">Logout</a>
                                @else
                                <a class="{{ Route::is('user.login') ? 'active' : '' }}"
                                    href="{{ route('user.login') }}">Sign in</a>
                                @endif
                            </li> --}}
                        </ul>
                    </div>
                </div>

                <button class="navbar-toggler-custom" type="button" id="sidebar_toggler"
                    style="background-color: transparent; height: 53px; cursor: pointer;border: none;">
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
 <div id="spinner">
        <div class="spinner-appear"></div>
    </div>
    <div id="page">
    {{ $slot }}
</div>

    @livewire('website.components.footer')

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    
    <script src="{{ asset('assets/js/mian.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="{{ asset('js/script.js') }}"> </script> --}}
    <script>
        function handleToggleModal() {
                Livewire.dispatch('open-modal');
            }
            document.addEventListener("click", function (event) {
            var sidebarToggler = document.getElementById("sidebar_toggler");
            var burgerBtn = document
            .getElementById("burgerBtn")
            .getElementsByTagName("img")[0];
            var mobOverlay = document.querySelector(".mob-overlay");
            var sidebarWrapper = document.querySelector(".sidebar-wrapper");
            var body = document.body;

            if (event.target === sidebarToggler || event.target.closest("#menuIcon")) {
            sidebarWrapper.classList.add("sidebar-show");
            mobOverlay.classList.add("active");
            body.classList.add("overflow__hidden");
            } else if (event.target === burgerBtn) {
            sidebarWrapper.classList.remove("sidebar-show");
            mobOverlay.classList.remove("active");
            body.classList.remove("overflow__hidden");
            } else if (event.target === mobOverlay) {
            sidebarWrapper.classList.remove("sidebar-show");
            mobOverlay.classList.remove("active");
            }
            });
    </script>
    @stack('js')
</body>

</html>
