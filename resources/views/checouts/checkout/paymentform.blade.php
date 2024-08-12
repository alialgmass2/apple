@extends('checouts.app-organization')
@section('content')
    <div class="new-container bg-danger">
        {{-- BREADCRUMB START --}}
        <div class="breadcrumb-container d-flex flex-column justify-content-start align-items-start">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                 aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.organization.organizations') }}">
                        <!-- <img  src="{{ asset('assets/images/home.svg') }}" class="icon" alt="@lang('app.alt_image')"/> -->
                        <i class="fa-solid fa-house"></i>
                            @lang('app.home')</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('carts.index') }}">@lang('app.shopping_cart')</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('app.checkout')</li>
                </ol>
            </nav>
            <div class="title">
                <h3>@lang('app.billing_information')</h3>
            </div>
        </div>
        <script>
            var wpwlOptions = {
                style: "card"
            }
            </script>
  <style>
            .wpwl-form-card {
                background-color: #000000e3 ;
            }

            .wpwl-label{
                color: white;
                margin-bottom: 5px;
            }
            .wpwl-control{     background: rgba(246, 246, 246, 0.07) !important;}
            input[disabled]{
                background-color: transparent !important;
            }

            select{
                color: white;
                min-width: 100px;
            }
            .wpwl-button-pay {
                background-color: #f2c343 ;
                border-color: #f2c343 ;
            }
            .bg-danger{
                background-color: rgba(2,2,2, 0) !important;
            }
            input{

                color: white !important;
            }
            .wpwl-form-card{
                box-shadow: none !important;
            }
            /* .wpwl-control {
                background: rgba(246, 246, 246, 0.07) !important;
                color: white !important;
            } */
            .wpwl-control { 
    background: white !important;
    color: black !important;
    height:34px !important;
    border-radius:10px !important;
}
            select{
                color: white;
                padding: 5px !important;
                height: max-content;
            }
            .wpwl-form {  margin: 30px auto !important;}
            #threedsChallengeRedirect{display: flex;
                justify-content: center;}
            #threedsChallengeRedirect > iframe{height: 500px !important;
                width: 450px !important;}
            visa-styling .container {
                padding: 0;
                display: flex;
                flex-direction: column;
                gap: 15px;
            }
            .visa-styling #CredentialValidateInput {
                margin-bottom: 10px;
            }
            #Body1{
                font-family: SF Hello;}
            #InputAction{font-family: SF Hello;}
            .footer{
                font-family: SF Hello;}
            .visa-row{    font-family: SF Hello;}
            .visa-styling #ValidateButton {
                font-family: SF Hello;}
            #threedsChallengeRedirect{
                margin-top: 30px;}
            .threeds-two{    padding: 0px 20px;
            }
            #contentBlock-text{color: #193ab0;}
            #contentBlock-maskedpan{color: #193ab0;}
            .visa-styling label[for=CredentialValidateInput] {
                margin-bottom: 7px;}
                wpwl-control {
    background: rgba(246, 246, 246, 0.07) !important;
}
        </style>
        <script async src="https://eu-prod.oppwa.com/v1/paymentWidgets.js?checkoutId={{$id}}"></script>
        <script>
        
        // document.addEventListener('DOMContentLoaded', function() {
//  var iframes = document.querySelectorAll('.wpwl-control-iframe');
 
// console.log(iframes)
// });
        
// Wait for 20 seconds before selecting all iframes with the specified class name
setTimeout(function() {
    var iframe = document.querySelector('.wpwl-target');    
    // var iframeDoc=iframe.contentWindow.document;
        // let mainBody=iframeDoc.querySelector('.vsc-initialized')
        // let threedsChallengeRedirect=mainBody.querySelector('#threedsChallengeRedirect')
    
         
iframe.style.maxWidth='450px';
iframe.style.display='block'; 
       
}, 10000); // 10 seconds in milliseconds

 
     
        </script>
        <form  action="" class="paymentWidgets" data-brands="{{$methods}}"></form>
    </div>
@endsection