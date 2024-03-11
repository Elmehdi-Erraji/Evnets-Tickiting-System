<!DOCTYPE html>
<html lang="en" class="h-100">
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, shrink-to-fit=9">
    
        <!-- Favicon Icon -->
        <link rel="icon" type="image/png" href="{{ asset('images/fav1.png') }}">
        
        <!-- Stylesheets -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <link href="{{ asset('vendor/unicons-2.0.1/css/unicons.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
        <link href="{{ asset('css/night-mode.css') }}" rel="stylesheet">
        
        <!-- Vendor Stylesheets -->
        <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/OwlCarousel/assets/owl.carousel.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/OwlCarousel/assets/owl.theme.default.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    </head>
   
    
  

<body class="d-flex flex-column h-100">
	
    <div class="invoice clearfix">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-lg-8 col-md-10">
                    <div class="invoice-header justify-content-between">
                        <div class="invoice-header-logo">
                            <a href="{{route('home')}}"><img src="{{ asset('images/in-logo.png') }}" alt="invoice-logo"></a>
                            
                        </div>
                        <div class="invoice-header-text">
                            <a href="#" id="downloadPdfLink" class="download-link">Download Ticket</a>
                        </div>
                    </div>
                    <div class="invoice-body">
                        <div class="invoice_footer">
                            <div class="cut-line">
                                <i class="fa-solid fa-scissors"></i>
                            </div>
                            <div class="main-card">
                                <div class="row g-0">
                                    <div class="col-lg-7">
                                        <div class="event-order-dt p-4">
                                            <div class="event-thumbnail-img">
                                                <img src="{{ asset('images/event-imgs/img-7.jpg') }}" alt="">
                                            </div>
                                            <div class="event-order-dt-content">
                                                <h5>{{ $reservation->first()->title }}</h5>
                                                <span>{{ \Carbon\Carbon::parse($reservation->first()->date)->format('D, M j, Y h:i A') }}</span>
                                                <div class="buyer-name">{{ $reservation->first()->fullName }}</div>
                                                <div class="booking-total-tickets">
                                                    <i class="fa-solid fa-ticket rotate-icon">{{ $reservation->first()->code }}</i>
                                                    <span class="booking-count-tickets mx-2">{{ $reservation->pivot->num_tickets }}</span>x Ticket
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="QR-dt p-4">
                                            <ul class="QR-counter-type">
                                            </ul>
                                            <div class="QR-scanner">
                                                <img src="{{ asset('images/qr.png') }}" alt="QR-Ticket-Scanner">
                                            </div>
                                            <p>Powered by EVENTO</p>
                                            {{ $reservation->pivot->code }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cut-line">
                                <i class="fa-solid fa-scissors"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	
	
	<script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/OwlCarousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/night-mode.js') }}"></script>

</body>
</html>