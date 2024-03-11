@extends('layouts.main')

@section('content')


<style>
    .event-details {
    display: inline-block;
    margin-right: 10px;
}

.event-seats, .event-reservations, .event-left-seats {
    font-weight: bold;
    background-color: #17a2b8; 
    color: #ffffff; 
    padding: 5px 10px; 
    border-radius: 5px; 
    margin-right: 5px;
}
</style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-sm-12">
                <!-- Overlay -->
                <div class="profile-bg-picture" style="background-image:url('{{ $event->getFirstMediaUrl('events') }}')">
                    <span class="picture-bg-overlay"></span>
                </div>
                <!-- Meta -->
                <div class="profile-user-box">
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- User Image -->
                            <div class="profile-user-img">
                                @if ($event->user->getFirstMedia('avatars'))
                                    <img src="{{ $event->user->getFirstMedia('avatars')->getUrl() }}" alt="" class="avatar-lg rounded-circle">
                                @else
                                    <i class="ri-account-circle-line fs-18 align-middle me-1"></i>
                                @endif
                            </div>
                            <div class="mt-4">
                                <h4 class="fs-20 text-dark">{{ $event->user->fullName }}</h4>
                                <p class="text-muted fs-16"><strong>Email:</strong> <a href="mailto:{{ $event->user->email }}">{{ $event->user->email }}</a></p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- Edit Profile and Delete Account Buttons -->
                            <div class="d-flex justify-content-end align-items-center gap-2">
                                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-info">
                                    <i class="ri-settings-2-line align-text-bottom me-1 fs-16 lh-1"></i>
                                    Edit Event
                                </a>
                                <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-soft-danger" onclick="return confirm('Are you sure you want to delete this event?')">
                                        <i class="ri-delete-bin-line align-text-bottom me-1 fs-16 lh-1"></i>
                                        Delete Event
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal for Delete Account -->
                <div id="login-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <!-- Modal Content -->
                </div>
            </div>
        </div>
    
        <!-- Event Information -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card p-0">
                    <div class="card-body p-0">
                        <div class="profile-content">
                            <ul class="nav nav-underline nav-justified gap-0">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" data-bs-target="#aboutme" type="button" role="tab" aria-controls="home" aria-selected="true" href="#aboutme">Event Details</a></li>
                            </ul>
        
                            <div class="tab-content m-0 p-4">
                                <div class="tab-pane active" id="aboutme" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                    <div class="profile-desk">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h2 class="text-uppercase fs-24 text-dark">{{ $event->title }}</h2>
                                                <div class="mt-4">
                                                    <h4 class="fs-20 text-dark">Category: <span class="event-details">{{ $event->category->name }}</span></h4>
                                                    <p class="font-weight-bold">Description: <span class="event-details">{{ $event->description }}</span></p>
                                                    <p class="font-weight-bold">Location: <span class="event-details">{{ $event->location }}</span></p>
                                                    <p class="font-weight-bold">Date: <span class="event-details">{{ \Carbon\Carbon::parse($event->date)->format('D, M j, Y h:i A') }}</span></p>
                                                    <p class="font-weight-bold">Number of Seats: <span class="event-seats badge badge-info">{{ $event->NumberOfSeats }}</span></p>
                                                    <p class="font-weight-bold">Number of Reservations: <span class="event-reservations badge badge-info">10</span></p> 
                                                    <p class="font-weight-bold">Number of Left Seats: <span class="event-left-seats badge badge-info">5</span></p>
                                                </div>
                                            </div>
                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- end page title -->
    </div>
    
@endsection
