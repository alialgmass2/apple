<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'JAAR Platform' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
          
    <!--<link rel="stylesheet" href="{{ asset('css/all.min.css') }}">-->
    <link rel="stylesheet" href="{{ asset('css/invoice.css') }}">
    <title>print report</title>
  
</head>

<body>
<main>
    {{ $slot }}
    <div class="footer ">
        <div class="copyright container">
            <div class=" footer_contact">
                <div class="d-flex ">
                    <p class="fw-bold">Website : </p>
                    <p>www.edu.jawraa.com/apple</p>
                </div>
                <div class="d-flex ">
                    <p class="fw-bold">Email : </p>
                    <p>edu@jawraa.com</p>
                </div>
                <div class="d-flex ">
                     <p class="fw-bold">   Customer Supports : </p>
                        <p >
                            <span>Tel +966 11 525 0600</span> <span>  -  </span>
                            <span>Mob +966 552 719 093</span>
                        </p>
                </div>

          
            </div>
            <!--<p>Copyright © Designed &amp; Developed by Apple 2023</p>-->
        </div>
    </div>
</main>

</body>

</html>
