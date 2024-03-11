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
       
        <div class="row">
            <div class="col-sm-12">
             
                <div class="profile-bg-picture" style="background-image:url('{{ $event->getFirstMediaUrl('events') }}')">
                    <span class="picture-bg-overlay"></span>
                </div>
              
                <div class="profile-user-box">
                    <div class="row">
                        <div class="col-sm-6">
                           
                        </div>
                        <div class="col-sm-6">
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
                <div class="card shadow-sm mb-4"> <!-- Added shadow for depth -->
                    <div class="card-body">
                        <div class="profile-content">
                            <ul class="nav nav-pills nav-underline nav-justified mb-4"> <!-- Improved navigation appearance -->
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#aboutme" type="button" role="tab" aria-controls="home" aria-selected="true" href="#aboutme">Event Details</a>
                                </li>
                            </ul>
                
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="aboutme" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="profile-desk">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h2 class="text-uppercase fs-5 fw-bold text-primary mb-3">{{ $event->title }}</h2> <!-- Enhanced title -->
                                                <div>
                                                    <p class="mb-2"><strong>Category:</strong> <span class="text-muted">{{ $event->category->name }}</span></p>
                                                    <p class="mb-2"><strong>Description:</strong> <span class="text-muted">{{ $event->description }}</span></p>
                                                    <p class="mb-2"><strong>Location:</strong> <span class="text-muted">{{ $event->location }}</span></p>
                                                    <p class="mb-2"><strong>Date:</strong> <span class="text-muted">{{ \Carbon\Carbon::parse($event->date)->format('D, M j, Y h:i A') }}</span></p>
                                                    <p class="mb-2"><strong>Number of Seats:</strong> <span class="badge bg-primary">{{ $event->NumberOfSeats }}</span></p>
                                                    <p class="mb-2"><strong>Number of Reservations:</strong> <span class="badge bg-success">{{$reservationsCount}}</span></p> 
                                                    <p><strong>Number of Left Seats:</strong> <span class="badge bg-warning text-dark">{{$event->NumberOfSeats - $reservationsCount}}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <h2 class="text-uppercase fs-6 fw-bold text-primary mt-5 mb-3" style="margin-left : 2%">Reservations list</h2> <!-- Consistent styling for subtitles -->
        
                            <div id="yearly-sales-collapse" class="collapse show">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-light"> <!-- Styling for table header -->
                                            <tr>
                                                <th>ID</th>
                                                <th>User Fullname</th>
                                                <th>Number of Tickets</th>
                                                <th>Status</th>
                                                <th>Date of Reservation</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableBody">
                                            @foreach ($reservations as $reservation)
                                                <tr>
                                                    <td>{{ $reservation->id }}</td>
                                                    <td>{{ $reservation->fullName }}</td>
                                                    <td>{{ $reservation->pivot->num_tickets }}</td>
                                                    <td>
                                                        @if ($reservation->pivot->status === '0')
                                                        <span class="badge bg-info-subtle text-info">Pending</span>
                                                        @elseif ($reservation->pivot->status === '1')
                                                            <span class="badge bg-warning-subtle text-warning">Active</span>
                                                        @elseif ($reservation->pivot->status === '2')
                                                            <span class="badge bg-pink-subtle text-pink">Banned</span>
                                                        @else
                                                            <span class="badge bg-warning">Unknown Status</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($reservation->pivot->date_of_reservation)->format('d/m/Y') }}</td> 
                                                    <td>
                                                     
                                                        <a href="{{ route('reservation.accept', ['event' => $reservation->pivot->event_id, 'user' => $reservation->pivot->user_id]) }}" class="btn btn-success btn-sm">Accept</a>
                                                        <a href="{{ route('reservation.deny', ['event' => $event->id, 'user' => $reservation->id]) }}" class="btn btn-danger btn-sm">Deny</a>
                                                       
                                                        <button type="button" class="btn btn-secondary btn-sm" disabled>Delete</button>
                                                        
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
       
    </div>
    
@endsection
