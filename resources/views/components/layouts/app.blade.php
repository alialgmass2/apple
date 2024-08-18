<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'JAAR Platform ' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    @if (App::isLocale('ar'))
        <link rel="stylesheet" href="{{ asset('assets/css/rtl.css') }}">
    @endif
    @stack('css')
    @livewireStyles
</head>

<body class="bg-dark">
<!-- Start Header -->
<nav class="header">
    <div class="container-custom">
        <div class="navbar-custom">
            <div class="navbar-custom-logo">
                <a href="{{route('website.welcome')}}"><img src="{{ asset('assets/images/nav-logo.svg') }}" alt="logo" /></a>
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
                               href="{{ url('/') }}">@lang('app.home')</a></li>
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
                        @if (authUser() != null && authUser()->otp_verified && authUser()->forgot_password_otp == '')
                            <li>
                                <div class="custom-dropdown">
                                    <button class="dropbtn">@lang('app.profile')</button>
                                    <div id="myDropdown" class="dropdown-content">
                                        <a href="{{ route('user.organization.organizations') }}">{{
                                            authUser() != null ? authUser()->organization->getFile('banner') : ''
                                            }}</a>
                                        <a href="{{ route('user.dashboard') }}">@lang('app.dashboard')</a>
                                        <a href="{{ route('user.logout') }}">@lang('app.logout')</a>
                                    </div>
                                </div>
                            </li>
                            {{-- AUTH MAIN WEB GUARD END --}}

                            {{-- IF AUTH GURAD REGISTER START --}}
                        @elseif (RegisterStepCheck())
                            <li>
                                <div class="custom-dropdown">
                                    <button class="dropbtn">@lang('app.profile')</button>
                                    <div id="myDropdown" class="dropdown-content">
                                        <a href="{{ route('user.register.otp') }}">@lang('app.verify_otp')</a>
                                        <a href="{{ route('user.logout') }}">@lang('app.logout')</a>
                                    </div>
                                </div>
                            </li>
                            {{-- IF AUTH GURAD REGISTER END --}}
                        @elseif (authUser() != null&& authUser()->otp_verified ==0 && authUser()->otp != '')
                            <li>
                                <div class="custom-dropdown">
                                    <button class="dropbtn">@lang('app.profile')</button>
                                    <div id="myDropdown" class="dropdown-content">
                                        <a href="{{ route('user.login.otp') }}">@lang('app.login_otp')</a>
                                        <a href="{{ route('user.logout') }}">@lang('app.logout')</a>
                                    </div>
                                </div>
                            </li>
                        @elseif (authCheck() && authUser()->forgot_password_otp != '' &&
                        authUser()->is_forgot_password_otp_verfied == 0 &&
                        authUser()->otp_verified == 0)
                            <li>
                                <div class="custom-dropdown">
                                    <button class="dropbtn">@lang('app.profile')</button>
                                    <div id="myDropdown" class="dropdown-content">
                                        <a
                                            href="{{ route('user.forgotpassword.otp') }}">@lang('app.forgot_password')</a>
                                        <a href="{{ route('user.logout') }}">@lang('app.logout')</a>
                                    </div>
                                </div>
                            </li>
                        @elseif (authUser() != null && authUser()->forgot_password_otp != '' &&
                        authUser()->is_forgot_password_otp_verfied == 1 &&
                        authUser()->otp_verified == 0)
                            <li>
                                <div class="custom-dropdown">
                                    <button class="dropbtn">@lang('app.profile')</button>
                                    <div id="myDropdown" class="dropdown-content">
                                        <a
                                            href="{{ route('user.forgotpassword.new') }}">@lang('app.enter_new_password')</a>
                                        <a href="{{ route('user.logout') }}">@lang('app.logout')</a>
                                    </div>
                                </div>
                            </li>
                        @else
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
                            <a class="nav-link " href="{{ route('user.logout') }}">Logout</a>
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
<script src="{{ asset('js/main.js') }}"> </script>
</body>

</html>
