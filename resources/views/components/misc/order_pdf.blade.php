<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'JAAR Platform' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        {{--@font-face {--}}
        {{--    font-family: 'SF-Hello';--}}
        {{--    src: url("{{ asset('fonts/SF-Hello.ttc') }}") format('truetype');--}}
        {{--    font-weight: 400;--}}
        {{--    font-style: normal;--}}
        {{--}--}}
       @font-face {
                            font-family: "SFHello";
                            src: url(" {{asset('fonts/SFHello-Regular.ttf')}} ");
                        }
    </style>

    <style>
        body {
            font-family: 'SF-Hello', sans-serif;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('css/pdf.css') }}">
    <title>print report</title>


</head>

<body style="font-family:SFHello ,'San Francisco' !important;">
<main>
    <div class=" ">
        <!-- Start Header -->
        <div class="header">
            <div class="container">
                <div class="navbar">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                     <div class="navbar-logo">
                        <img width="250px" src="{{ asset('images/logo.png') }}" alt="logo" />
                    </div>
                                </td>
                                <td>
                                      <div>
                        <p class="invoice">Inovice : <span class=" ">#{{$order->order_number}}</span></p>
                        <p class="invoice"> Date :  <span class=" ">{{\Carbon\Carbon::parse($order->created_at)->format('d/m/Y')}}</span></p>
                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>


                </div>
                <div class="bill">
                    <table>
                        <tbody>
                            <tr>
                                <td  >
                                    <div class="">
                        <P class="title"> Customer Information </P>
                        <div class="bill_padding">
                        <p class="invoice">Name : <span>{{$order->addresses()->first()?->fname}} {{$order->addresses()->first()?->lname}}</span></p>
                            <p class="invoice ">E-mail : <span>{{$user->email}}</span></p>
                            <p class="invoice">Phone : <span>{{$order->addresses()->first()?->phone}}</span> </p>
                            <p class="invoice">user type : <span>{{$user->user_type}}</span></p>
                              @if($order->addresses()->first()->type == 'home')
                            @php
                                $address = $order->addresses()->with(['city','region'])
                            @endphp

                            <p class="invoice mb-0">Region :
                                <span>{{$order->addresses()->first()->region()->first()->name_en}}</span>
                            </p>
                            <p class="invoice mb-0">City :
                                <span>{{$order->addresses()?->first()->city()->first()->name_en}}</span>
                            </p>
                            <p class="invoice mb-0">Districts :
                                <span>{{$order->addresses()->first()?->distracts}}</span>
                            </p>
                            <p class="invoice mb-0">Zip code :
                                <span>{{$order->addresses()->first()->zip_code}}</span>
                            </p>
                        @endif
                            <p></p>
                        </div>
                    </div>
                                </td>
                                <td>
                                                        <div class="  ">
                        <P class=" title"> organization Information </P>
                        <div class="bill_padding">
                            <p class="invoice">name : <span>{{$orgnization->name_en}}</span> </p>
                            <p class="invoice">region : <span>{{$orgnization->region()->first()?->name_en}}</span></p>
                            <p class="invoice">city : <span>{{$orgnization->city()->first()?->name_en}}</span> </p>
                            <p class="invoice">address : <span>{{$orgnization->address}}</span></p>
                        </div>
                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
        <!-- End Header -->
        <div class="container content">
            <table class="table table-responsive-md table-bordered table-striped">
                <thead>
                <tr>
                <th class="w-250px"><strong>Item</strong></th>
                <th><strong>Unit Price</strong></th>
                <th><strong>Quantity</strong></th>
                <th><strong>unit discount</strong></th>
                <th><strong>total discount</strong></th>
                <th><strong> vat</strong></th>
                <th><strong>total after discount and vat</strong></th>
                </tr>
                </thead>
                <tbody>
                @forelse($order->items as $item)
                    @if($item->product != '')
                        <tr>
                         <td class="font-bold">{{$item->product?->title_en}}</td>
                        <td>{{$item->price  /  $item->quantity}}</td> 
                        <td>{{$item->quantity}}</td>
                        <td class="font-bold">{{$item->discount  / $item->quantity}}</td>
                        <td class="font-bold">{{$item->discount}}</td>
                        <td>{{$item->vat}}</td> 
                        <td>{{$item->total}}</td> 
                        </tr>
                    @endif
                @empty
                @endforelse
                </tbody>
            </table>
            <p class="invoice_summary"><strong>Invoice summary</strong> </p>
            <div class="invoice_qr">
                <table>
                    <tbody>
                        <tr>
                            <td>

                <!--<div class=" ">-->
                    <table class="table  ">
 
                    <!--        <tbody>-->
                    <!--<tr>-->
                    <!--    <td class="font-bold"> Total price before discount</td>-->
                    <!--    <td class="bg_stripped">{{$order->items?->sum('price')}} SAR</td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                    <!--    <td class="font-bold"> discount</td>   -->
                    <!--    <td class="bg_stripped">{{$order->items?->sum('discount')}} SAR</td> -->
                    <!--</tr>-->
                    <!--<tr>-->
                    <!--    <td class="font-bold">Vat </td>-->
                    <!--    <td class="bg_stripped">{{($order->items?->sum('vat')) + ($order->total - $order->items?->sum('total'))}}</td>-->
                    <!--</tr> -->
                    
                    <!--@if($order->addresses()->first()->type == 'home')-->
                    <!--        <tr>-->
                    <!--            <td class="font-bold"> delivery</td>  -->
                                <!--<td>{{$orgnization->delivery_price}} SAR</td> -->
                    <!--            <td class="bg_stripped">{{$order->total - $order->items?->sum('total') - 0.14}} SAR</td> -->
                    <!--        </tr>-->
                    <!--@endif-->
                     

                    <!--<tr>-->
                    <!--    <td class="font-bold"> Total</td>-->
                    <!--    <td class="bg_stripped">{{$order->total}} SAR</td>-->
                    <!--</tr>-->


                    <!--</tbody>-->
                    
                    <tbody>
                    <tr>
                        <td class="font-bold"> Total price before discount</td>
                        <td class="bg_stripped">{{$order->items?->sum('price')}} SAR</td>
                    </tr>
                    <tr>
                        <td class="font-bold"> discount</td>
                        <td class="bg_stripped">{{$order->items?->sum('discount')}} SAR</td>
                    </tr>
                    <tr>
                        <td class="font-bold">Vat </td>
                        <td class="bg_stripped">{{number_format($order->items?->sum('vat'),2)}}</td>
                    </tr> 

                    @if($order->addresses()->first()->type == 'home')
                            <tr>
                                <td class="font-bold"> delivery</td>
                                <td class="bg_stripped">{{$order->order_details['delivery_cost'] ?? 0}} SAR</td>
                            </tr>
                    @endif 

                    <tr>
                        <td class="font-bold"> Total</td>
                        <td class="bg_stripped">{{$order->total}} SAR</td>
                    </tr>


                    </tbody>
                    </table>
                <!--</div>-->
                            </td>
                            <td style=" text-align: right;">
                                   <img class="qr" src="{{$qr}}" alt="QR Code">

                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

    </div>

    <div class="footer ">
        <div class="copyright container">


            <!---->
                        <table class=" footer_contact">
            <tr>
                <td  class="py-2">
                    <p class="span fw-bold">Website : </p>
                    <p class="span">www.edu.jawraa.com/apple</p>
                </td>
                <td class="py-2">
                    <p class="span fw-bold">Email : </p>
                    <p class="span">edu@jawraa.com</p>
                </td>

            </tr>
            <tr>
                <td  colSpan="2" class="py-2">
                        <p class="fw-bold span">   Customer Supports : </p>
                        <p class="span">
                            <p class="span">Tel +966 11 525 0600</p>  -
                            <p class="span">Mob +966 552 719 093</p>
                        </p>
                </td>

            </tr>
            </table>
            <!--<p>Copyright © Designed &amp; Developed by Apple 2023</p>-->
        </div>
    </div>
</main>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
      
     function captureScreenAndGeneratePDF() {
    const { jsPDF } = window.jspdf;

    // Create a new jsPDF instance
    const pdf = new jsPDF('p', 'mm', 'a4'); // Specify A4 size

    // Define the HTML content you want to convert to PDF
    const htmlContent = document.documentElement.outerHTML;

    // Convert HTML to PDF
    pdf.html(htmlContent, {
        callback: function(pdf) {
            // Save the generated PDF
            pdf.save('invoice.pdf');
        }
    });
}

// Run the captureScreenAndGeneratePDF function when the document loads
document.addEventListener("DOMContentLoaded", function() {
    captureScreenAndGeneratePDF();
});

                
    </script>
</body>

</html>
