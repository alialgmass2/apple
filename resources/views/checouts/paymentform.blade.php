@extends('checouts.app-organization')
@section('content')
    <script>
        var wpwlOptions = {
            style: "card"
        }
    </script>
    <script  src="https://eu-test.oppwa.com/v1/paymentWidgets.js?checkoutId={{$id}}"></script>




        <div class="breadcrumb-container">
            <div class="container">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                     aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><img src="{{ asset('assets/images/home.svg') }}"
                                                                     class="icon" alt="" />
                                Home</a></li>
                        <li class="breadcrumb-item"><a href="#">
                                Shopping Cart</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </nav>
            </div>
        </div>
<form action="" class="paymentWidgets" data-brands="{{$methods}}"></form>


@stop
