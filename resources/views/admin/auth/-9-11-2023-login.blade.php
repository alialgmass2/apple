<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <!-- All Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignLab">
    <meta name="robots" content="">
    <meta name="keywords"
        content="bootstrap admin, card, clean, credit card, dashboard template, elegant, invoice, modern, money, transaction, Transfer money, user interface, wallet">
    <meta name="description"
        content="Dompet is a clean-coded, responsive HTML template that can be easily customised to fit the needs of various credit card and invoice, modern, creative, Transfer money, and other businesses.">
    <meta property="og:title" content="Dompet - Payment Admin Dashboard Bootstrap Template">
    <meta property="og:description"
        content="Dompet is a clean-coded, responsive HTML template that can be easily customised to fit the needs of various credit card and invoice, modern, creative, Transfer money, and other businesses.">
    <meta property="og:image" content="https://dompet.dexignlab.com/xhtml/social-image.png">
    <meta name="format-detection" content="telephone=no">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <!-- Page Title Here -->
    <title>Admin | Dashboard</title>



    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row h-100">
                <div class="col-lg-6 col-md-12 col-sm-12 mx-auto align-self-center">
                    <div class="login-form">
                        <div class="d-flex justify-content-center align-items-center">
                            <a href="{{ url('/') }}" class="brand-logo text-center mb-4">
                                <img src="{{ asset('images/logo.png') }}" alt="" />
                                {{-- <h2 class="fw-bold"><span class="logo-1">COOL</span> <span class="logo-2">SHOWER</span>
                                </h2> --}}
                            </a>
                        </div>
                        <div class="text-center">
                            <h3 class="title">Sign In</h3>
                        </div>
                        <form action="{{ route('admin.login.submit') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="mb-1 text-dark">Email</label>
                                <input type="email" name="email" class="form-control form-control"
                                    value="admin@mail.com">
                                @error('email')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4 position-relative">
                                <label class="mb-1 text-dark">Password</label>
                                <input type="password" name="password" id="dlab-password"
                                    class="form-control form-control" value="123456">
                                <span class="show-pass eye">

                                    <i class="fa fa-eye-slash"></i>
                                    <i class="fa fa-eye"></i>

                                </span>
                                @error('password')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-row d-flex justify-content-between mt-4 mb-2">
                            </div>
                            <div class="text-center mb-4">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>

                            <div class="mb-3"></div>

                        </form>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="pages-left h-100">
                        <div class="login-content">
                            {{-- <a href="index.html"><img src="{{ asset('images/logo-full.png') }}" class="mb-3"
                                    alt=""></a> --}}

                            {{-- <p>Your true value is determined by how much more you give in value than you take in
                                payment. ...</p> --}}
                        </div>
                        <div class="login-media text-center">
                            <img src="{{ asset('images/admin-login.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/dlabnav-init.js') }}"></script>

</body>

</html>
