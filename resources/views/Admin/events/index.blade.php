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
                                            <th>Organizer Name</th>
                                            <th>Description</th>
                                            <th>Category</th>
                                            <th>Location</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Booking_Status</th>
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
                                                <td>{{ Str::limit($event->title ,50) }}</td>
                                                <td>{{ $event->user->fullName }}</td>
                                                <td>{{ Str::limit($event->description ,80) }}</td>
                                                <td>{{ $event->category->name }}</td>
                                                <td>{{ $event->location }}</td>
                                                <td>{{  date('d/m/Y', strtotime($event->date))  }}</td>
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
                                                <td>
                                                    @if ($event->trashed())
                                                        <form action="{{ route('events.restore', $event->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-sm btn-success">Restore</button>
                                                        </form>
                                                        <form action="{{ route('events.forceDelete', $event->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">Delete Permanently</button>
                                                        </form>
                                                    @else
                                                        <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                        <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-success">View Details</a>
                                                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger delete-btn">Delete</button>
                                                        </form>
                                                    @endif
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

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection

