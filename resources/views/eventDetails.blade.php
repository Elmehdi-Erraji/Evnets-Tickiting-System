@extends('layouts.app2')

@section('title', 'Home')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="wrapper">
    <div class="breadcrumb-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-10">
                    <div class="barren-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Explore Events</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Venue Event Detail View</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="event-dt-block p-80">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="event-top-dts">
                        <div class="event-top-date">
                            <span class="event-month">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</span>
                            <span class="event-date">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</span>

                        </div>
                        <div class="event-top-dt">
                            <h3 class="event-main-title">{{$event->title}}</h3>
                            <div class="event-top-info-status">
                                <span class="event-type-name"><i class="fa-solid fa-location-dot"></i>{{$event->location}}</span>
                                <span class="event-type-name details-hr">Starts on <span class="ev-event-date">{{ \Carbon\Carbon::parse($event->date)->format('D, M j, Y h:i A') }}</span></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-7 col-md-12">
                    <div class="main-event-dt">
                        <div class="event-img">
                            @if ($event->getFirstMedia('events'))
                            <a href="{{ route('eventDetails', $event->id) }}" class="thumbnail-img">
                                <img src="{{ $event->getFirstMedia('events')->getUrl() }}" alt="">
                            </a>
                         @endif	
                        </div>
                       
                        <div class="main-event-content">
                            <h4>About This Event</h4>
                            <p>{{$event->description}}</p>
                        </div>							
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 col-md-12">
                    <div class="main-card event-right-dt">
                        <div class="bp-title">
                            <h4>Event Details</h4>
                        </div>
                        <div class="event-dt-right-group mt-5">
                            <div class="event-dt-right-icon">
                                <i class="fa-solid fa-circle-user"></i>
                            </div>
                            <div class="event-dt-right-content">
                                <h4>Organised by</h4>
                                <h5>{{$event->user->fullName}}</h5>
                            </div>
                        </div>
                        <div class="event-dt-right-group">
                            <div class="event-dt-right-icon">
                                <i class="fa-solid fa-calendar-day"></i>
                            </div>
                            <div class="event-dt-right-content">
                                <h4>Date and Time</h4>
                                <h5>{{ \Carbon\Carbon::parse($event->date)->format('D, M j, Y h:i A') }}</h5>
                                
                            </div>
                        </div>
                        <div class="event-dt-right-group">
                            <div class="event-dt-right-icon">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div class="event-dt-right-content">
                                <h4>Location</h4>
                                <h5 class="mb-0">{{$event->location}}</h5>
                            </div>
                        </div>
                        <form action="{{route('reservations.store')}}" method="POST">
                            @csrf <!-- Don't forget the CSRF token for security -->
                            
                            <input type="hidden" name="event_id" value="{{$event->id}}">
                            <div class="select-tickets-block">
                                <h6>Select Tickets</h6>
                                <div class="select-ticket-action">
                                    <div class="ticket-price">
                                        <span class="remaining" style="font-size: 15px;">
                                            <i class="fa-solid fa-ticket fa-rotate-90 fa-2xl"></i>
                                            {{ $event->NumberOfSeats }} Remaining
                                        </span>
                                    </div>
                                    <div class="quantity">
                                        <div class="counter">
                                            <span class="down" onclick='decreaseCount(event, this)'>-</span>
                                            <input type="text" name="num_tickets" value="0">
                                            <span class="up" onclick='increaseCount(event, this)'>+</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="booking-btn">
                                @if(Auth::check())
                                <button type="submit" class="main-btn btn-hover w-100">Book Now</button>
                            @else
                                <a href="{{ route('login') }}" class="main-btn btn-hover w-100">Login to Book</a>
                            @endif                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
     @if (Session::has('success'))
        <script>
            console.log("SweetAlert initialization script executed!");
            Swal.fire("Success", "{{ Session::get('success') }}", 'success');
        </script>
    @endif
    
    @if (Session::has('error'))                           
    <script>
        console.log("SweetAlert initialization script executed!");
        Swal.fire("Error", "{{ Session::get('error') }}", 'error');
    </script>
@endif
@endsection