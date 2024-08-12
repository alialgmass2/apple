<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'DEFAULT TITLE' }}</title>
    <meta name="_token" content="{!! csrf_token() !!}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">

    {{-- <style>
        @import url("https://fonts.googleapis.com/css2?family=Istok+Web:wght@400;700&display=swap");

        * {
            margin: 0;
            padding: 0;
            font-family: "Istok Web", sans-serif;
        }

        .cart {
            padding: 5px;
            width: 80px;
            height: 40px;
            background: #191919;
            border-radius: 20px;
            float: right;
            color: #0dcaf0;
        }

        .card {
            position: relative;
            width: 320px;
            height: 480px;
            background: #191919;
            border-radius: 20px;
            overflow: hidden;
        }

        .card::before {
            content: "";
            position: absolute;
            top: -50%;
            width: 100%;
            height: 100%;
            background: #ffce00;
            transform: skewY(345deg);
            transition: 0.5s;
        }

        .card:hover::before {
            top: -70%;
            transform: skewY(390deg);
        }

        .card::after {
            content: "CORSAIR";
            position: absolute;
            bottom: 0;
            left: 0;
            font-weight: 600;
            font-size: 6em;
            color: rgba(0, 0, 0, 0.1);
        }

        .card .imgBox {
            position: relative;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 20px;
            z-index: 1;
        }

        /*
        .card .imgBox img {
            max-width: 100%;

            transition: .5s;
        }

        .card:hover .imgBox img {
            max-width: 50%;

        }
        */
        .card .contentBox {
            position: relative;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;

            z-index: 2;
        }

        .card .contentBox h3 {
            font-size: 18px;
            color: white;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .card .contentBox .price {
            font-size: 24px;
            color: white;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .card .contentBox .buy {
            position: relative;
            top: 100px;
            opacity: 0;
            padding: 10px 30px;
            margin-top: 15px;
            color: #000000;
            text-decoration: none;
            background: #ffce00;
            border-radius: 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.5s;
        }

        .card:hover .contentBox .buy {
            top: 0;
            opacity: 1;
        }

        .mouse {
            height: 300px;
            width: auto;
        }
    </style> --}}

    {{-- @livewireStyles--}}
    @if (App::isLocale('ar'))
    <link rel="stylesheet" href="{{ asset('assets/css/rtl.css') }}">
    @endif
</head>

<body class="bg-dark">
    <!-- Start Header -->
    {{-- <nav class="header bg-navbar-orignization">
        <div class="container-custom">
            <div class="navbar-custom">
                <div class="navbar-custom-logo">
                    <img src="{{ asset('assets/images/nav-logo.svg') }}" alt="logo" />
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
                                    href="{{ route('website.learnandbuy') }}">Learn &
                                    buy</a></li>
                            <li>
                                @if (authCheck())
                                <a class="nav-link " href="{{ route('user.logout') }}">Logout</a>
                                @else
                                <a class="{{ Route::is('user.login') ? 'active' : '' }}"
                                    href="{{ route('user.login') }}">Sign in</a>
                                @endif
                            </li>
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
    </nav> --}}
    <!-- End Header -->
    {{--<a href="{{route('carts.index')}}">
        <div class="cart">cart {{auth()->user()->cart()->count()}}</div>
    </a>--}}
    <nav class="header">
        <div class="container-custom">
            <div class="navbar-custom">
                <div class="navbar-custom-logo">
                    <a href="{{route('user.organization.organizations')}}">
                        <img src="{{ asset('assets/images/nav-logo.svg') }}" alt="logo" />
                    </a>
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
                                    href="{{ route('website.studentsandparents') }}">@lang('app.students_and_parents')</a></li>
                            <li><a class="{{ Route::is('website.educationdeployment') ? 'active' : '' }}"
                                    href="{{ route('website.educationdeployment') }}">@lang('app.education_deployment')</a></li>
                            <li><a class="{{ Route::is('website.learnandbuy') ? 'active' : '' }}"
                                    href="{{ route('website.learnandbuy') }}">@lang('app.learn_and_buy')</a></li>
                            @if(authUser() != null)
                                <li>
                                    <div class="custom-dropdown">
                                        <button class="dropbtn">@lang('app.profile')</button>
                                        <div id="myDropdown" class="dropdown-content">
                                            <a href="{{ route('user.organization.organizations') }}">{{
                                            authUser() != null ? authUser()->organization->translate('name') : ''
                                            }}</a>
                                            <a href="{{ route('user.dashboard') }}">@lang('app.dashboard')</a>
                                            <a href="{{ route('user.logout') }}">@lang('app.logout')</a>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            <li class="cart-link">
                                <a class="{{ Route::is('carts.index') ? 'active' : '' }}"
                                    href="{{ route('carts.index') }}">
                                    <span>{{auth()->user() != null ? auth()->user()->cart()->count() : ''}}</span>
                                    <img src="{{ asset('assets/images/cart.png') }}" width="16" height="16" alt="" />
                                </a>
                            </li>
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
    @yield('content')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $('.add_cart_form').on('submit',function (e){
            e.preventDefault();
            let
                html        = '',
                submit_btn  = $(this).data('product');
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: {product:submit_btn},
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                success: function (response){
                    if (response.status === 'success'){
                        html = response.poppAction;
                    }
                    Swal.fire({
                            title: response.message,
                            text: response.message,
                            showCloseButton: true,
                            icon: response.status === 0 ? "error" : "success",
                            html: html,
                            showConfirmButton: response.status === 0 ? true : false,
                    })
                    $('.cart-link span').html(response.count)
                },
                error: function (response){
                    console.log(response);
                }
            });
        })
    </script>
@include('livewire/website/components/footer')

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('js')
    {{-- <script src="{{ asset('js/script.js') }}"> </script> --}}
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
    <script>
              @if(Session::has('message'))
Swal.fire({
title: "{{ ucfirst(Session::get('icon') ?? "success")}}",
text: "{{Session::get('message') ?? 'success'}}",
icon: "{{Session::get('icon') ?? "success"}}"
});
        // swal("{{Session::get('message') ?? 'success'}}");

        @endif
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
</body>

</html>
