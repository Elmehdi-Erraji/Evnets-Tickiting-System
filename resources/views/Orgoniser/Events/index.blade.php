@extends('layouts.main')

@section('content')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"> </a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                            <li class="breadcrumb-item active">Welcome!</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Welcome!</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-xxl-3 col-sm-6">
                <div class="card widget-flat text-bg-success">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-calendar-line widget-icon"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="Projects">Events</h6>
                        <h2 class="my-2">{{$eventsCount}}</h2>
                    </div>
                </div>
            </div>
           
            <div class="col-xxl-3 col-sm-6">
                <div class="card widget-flat text-bg-warning">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-ticket-line widget-icon"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="Projects">Tickets</h6>
                        <h2 class="my-2">5</h2>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <!-- Todo-->
                <div class="card">
                    <div class="card-body p-0">
                        <div class="p-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <a href="{{route('event.create')}}" class="btn btn-primary" id="addButton" style="width: 30%">Add An Event</a>
                                </div>

                            </div>
                        </div>

                        <div id="yearly-sales-collapse" class="collapse show">
                            <div class="table-responsive">
                                <table class="table table-nowrap table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Location</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Booking_Status</th>
                                            <th>Reservations</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody">
                                        @foreach ($events as $event)
                                            <tr>
                                                <td>{{ $event->id }}</td>
                                                <td>
                                                    @if ($event->getFirstMedia('events'))
                                                        <img src="{{ asset($event->getFirstMedia('events')->getUrl()) }}" class="rounded-circle" alt="Event Image" width="50">
                                                    @else
                                                        No image
                                                    @endif
                                                </td>
                                                <td>{{ Str::limit($event->title, 30) }}</td>
                                                <td>{{ $event->category->name }}</td>
                                                <td>{{ $event->location }}</td>
                                                <td>{{ date('d/m/Y', strtotime($event->date)) }}</td>
                                                <td>
                                                    @if ($event->status === 0)
                                                        <span class="badge bg-info-subtle text-info">Pending</span>
                                                    @elseif ($event->status === 1)
                                                        <span class="badge bg-warning-subtle text-warning">Active</span>
                                                    @elseif ($event->status === 2)
                                                        <span class="badge bg-pink-subtle text-pink">Banned</span>
                                                    @else
                                                        <span class="badge bg-warning">Unknown Status</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($event->booking_status === 0)
                                                        <span class="badge bg-info-subtle text-info">Automatic</span>
                                                    @elseif ($event->booking_status === 1)
                                                        <span class="badge bg-warning-subtle text-warning">Manual</span>
                                                  
                                                    @else
                                                        <span class="badge bg-warning">Unknown Status</span>
                                                    @endif
                                                </td>

                                                <td>{{ $event->reservationsCount }}</td>
                                                <td>
                                                    <a href="{{ route('event.edit', $event->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                    <a href="{{ route('event.show', $event->id) }}" class="btn btn-sm btn-success">View Details</a>
                                
                                                    <form action="{{ route('event.destroy', $event->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger delete-btn">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
                                
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection

