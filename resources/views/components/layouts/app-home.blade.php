<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    {{--
    <link rel="icon" href="{{ asset('assets/images/apple.svg') }}" type="image/x-icon"> --}}
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <title>{{ $title ?? 'Apple' }}</title>
    <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-PXR3KT4F');
        </script>
    <!-- End Google Tag Manager -->
    <!-- End Google Tag Manager -->
    @if (App::isLocale('ar'))
        <link rel="stylesheet" href="{{ asset('assets/css/rtl.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/contact.css') }}">
    @endif
    @stack('css')
    @livewireStyles
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src=https://www.googletagmanager.com/ns.html?id=GTM-PXR3KT4F height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
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
                            <!-- <img src="{{ asset('assets/images/nav-logo.svg') }}" alt="logo" /> -->
                            <a class="navbar-custom-logo" href="{{ url('/') }}">
                    <img src="{{ asset('assets/images/nav-logo.svg') }}" alt="logo">
                </a>
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
                                            authUser() != null ? authUser()->organization->translate('name') : ''
                                            }}</a>
                                        <a href="{{ route('user.orders.index') }}">Order Tracking </a>
                                        <a href="{{ route('user.logout') }}">@lang('app.logout')</a>
                                    </div>
                                </div>
                            </li>
                            <li class="cart-link">
                                <a class="{{ Route::is('carts.index') ? 'active' : '' }}"
                                    href="{{ route('carts.index') }}">
                                    <span>{{ auth()->user()->cart()->count() }}</span>
                                    <img src="{{ asset('assets/images/cart.png') }}" width="30" height="30" />
                                </a>
                            </li>
                            {{-- AUTH MAIN WEB GUARD END --}}

                            {{-- IF AUTH GURAD REGISTER STEP START --}}
                            @elseif (RegisterStepCheck())
                            <li>
                                <div class="custom-dropdown">
                                    <button class="dropbtn">@lang('app.profile')</button>
                                    <div id="myDropdown" class="dropdown-content">
                                        <a href="{{ route('user.register.otp') }}">Verify OTP</a>
                                        <a href="{{ route('user.logout') }}">@lang('app.logout')</a>
                                    </div>
                                </div>
                            </li>
                            {{-- IF AUTH GURAD REGISTER STEP END --}}
                            {{-- IF AUTH GURAD WEB FOR NEW PASSWORD STEP START --}}
                            @elseif (authCheck() && authUser()->forgot_password_otp != '' &&
                            authUser()->is_forgot_password_otp_verfied == 1 && authUser()->otp_verified == 0)
                            <li>
                                <div class="custom-dropdown">
                                    <button class="dropbtn">@lang('app.profile')</button>
                                    <div id="myDropdown" class="dropdown-content">
                                        <a href="{{ route('user.forgotpassword.new') }}">Update passowrd</a>
                                        <a href="{{ route('user.logout') }}">@lang('app.logout')</a>
                                    </div>
                                </div>
                            </li>
                            {{-- IF AUTH GURAD WEB FOR NEW PASSWORD STEP END --}}
                            @elseif (authCheck() && authUser()->otp_verified ==0 && authUser()->otp != '')
                            <li>
                                <div class="custom-dropdown">
                                    <button class="dropbtn">@lang('app.profile')</button>
                                    <div id="myDropdown" class="dropdown-content">
                                        <a href="{{ route('user.login.otp') }}">Login OTP</a>
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
    <div id="spinner">
        <div class="spinner-appear"></div>
    </div>

    {{ $slot }}


    <!-- Start Footer -->
    <footer class="footer">
        <div>
            <div class="container">
                <div class="footer-content">
                    <div class="footer-logo">
                        <img src="{{ asset('assets/images/logo.svg') }}" alt="logo" class="footer_logo_img" />
                        <ul class="footer-socialMedia">
                            <li>
                                <a href="https://www.linkedin.com/" target="_blank">
                                    <img src="{{ asset('assets/images/linkedin.png') }}" alt="linkedin"/>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/" target="_blank">
                                    <img  src="{{ asset('assets/images/Twitter.png') }}" alt="twitter"/>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/" target="_blank">
                                    <img src="{{ asset('assets/images/instagram.svg') }}" alt="instagram"/>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com/" target="_blank">
                                    <img src="{{ asset('assets/images/facebook.svg') }}" alt="facebook"/>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-ContactUs">
                        <p class="footer-title">@lang('app.contact_us_u')</p>
                        <ul>
                            <li>
                                <span>@lang('app.customer_supports') :</span>
                                @if (App::isLocale('ar'))
                                <p>@lang('app.tel') 0600 525 11 966+</p>
                                <p>@lang('app.mob') 093 719 552 966+</p>
                                @else
                                <p>@lang('app.tel') +966 11 525 0600</p>
                                <p>@lang('app.mob') +966 552 719 093</p>
                                @endif
                            </li>
                            <li>@lang('app.address')</li>
                            <li>edu@jawraa.com</li>
                        </ul>
                    </div>
                    <div class="footer-category">
                        <p class="footer-title">@lang('app.top_categories')</p>
                        <ul>
                            @forelse(\App\Models\Category::where('name_en','!=','All')->get() as $category)
                            <li>   <a href="{{route('products',$category->id)}}">{{$category->name_en}}</a></li>
                            @empty
                            @endforelse
                            <a href="{{route('products','all')}}">
                                <li>@lang('app.browse_all_product')
                                    <img src="{{ asset('assets/images/ArrowRight.svg') }}" alt="right" class="ar-arrow"/>
                                </li>
                            </a>
                        </ul>
                    </div>
                    <div class="footer-QuickLinks">
                        <p class="footer-title">@lang('app.quick_links')</p>
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
                            <li {{ Route::is('website.learnandbuy') ? 'active' : '' }}><a
                                    href="{{ route('website.learnandbuy') }}">@lang('app.learn_and_buy')</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="Copyright">
                <span>Copyright © 2024 Jawraa Apple Reseller. All rights reserved.</span>
            </div>
        </div>
    </footer>
    <!-- End Footer -->


    @livewireScripts
    <script src="{{ asset('assets/js/mian.js') }}"></script>
    <script src="{{ asset('assets/js/contact.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/select.js') }}"></script> --}}
    @stack('js')

</body>

</html>
