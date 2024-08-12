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
<style>
    body{
        background:#fff;
        }
        input,
        select {
        border-radius: unset !important;
        width: 460px !important;
        height: 56px !important;
        }
</style>
</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row h-100 ">
                <div class="col-lg-4 col-md-12 col-sm-12 mx-auto align-self-center">
                    <div class="login-form">
                        <div class="d-flex justify-content-center align-items-center">
                            <a href="{{ url('/') }}" class="brand-logo text-center mb-3">
                                <img src="{{ asset('images/logo.png') }}" alt="" />
                            </a>
                        </div>
                        <div class="text-center d-flex justify-content-center flex-column align-items-center">
                            <h3 class="title mb-3">Administration</h3>
                            <p>Sign in to your Apple education account</p>
                        </div>
                        <form class="login-form" action="{{ route('admin.login.submit') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <input type="email" name="email" class="form-control form-control"
                                    placeholder="Email">
                                @error('email')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4 position-relative">
                                <input type="password" name="password" placeholder="Password" id="dlab-password"
                                    class="form-control form-control">
                                <span class="show-pass eye">

                                    <i class="fa fa-eye-slash"></i>
                                    <i class="fa fa-eye"></i>

                                </span>
                                @error('password')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4 position-relative">
                                    <button type="submit" class="btn btn-sm btn-outline-dark d-block form-login-submit w-100">Sign In</button>

                            </div>

                            <div class="mb-3"></div>

                        </form>
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
