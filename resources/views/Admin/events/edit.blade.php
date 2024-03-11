
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
                    <h4 class="page-title">edit a user here </h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">Edit user</h4>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form action="{{ route('events.update', $event->id) }}" method="POST" id="updateEventForm">
                                    @csrf
                                    @method('PUT')
                                
                                    <div class="mb-3">
                                        <label for="event_status" class="form-label">Status</label>
                                        <select class="form-select" id="event_status" name="status">
                                            <option value="0" {{ $event->status == 0 ? 'selected' : '' }}>Pending</option>
                                            <option value="1" {{ $event->status == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="2" {{ $event->status == 2 ? 'selected' : '' }}>Banned</option>
                                        </select>
                                    </div>
                                
                                    <div class="mb-3">
                                        <button type="submit" id="submitButton" class="btn btn-primary" name="updateEvent">Submit</button>
                                        <a href="{{ route('events.index') }}" class="btn btn-secondary">Go Back</a>
                                    </div>
                                </form>
                              
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection

