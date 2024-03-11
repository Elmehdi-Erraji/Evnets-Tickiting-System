
@extends('.layouts.main')

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
                    <h4 class="page-title">Update an event here </h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title">Update an event</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form action="{{ route('event.update', $event->id) }}" method="POST" id="editEventForm" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Event Title" value="{{ $event->title }}">
                                        @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Event Description">{{ $event->description }}</textarea>
                                        @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                
                                    <div class="mb-3">
                                        <label for="date" class="form-label">Date</label>
                                        <input type="date" id="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ $event->date ? \Carbon\Carbon::parse($event->date)->format('Y-m-d') : '' }}">
                                        @error('date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                
                                    <div class="mb-3">
                                        <label for="location" class="form-label">Location</label>
                                        <input type="text" id="location" class="form-control @error('location') is-invalid @enderror" name="location" placeholder="Event Location" value="{{ $event->location }}">
                                        @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                
                                    <div class="mb-3">
                                        <label for="NumberOfSeats" class="form-label">Number of Seats</label>
                                        <input type="number" id="NumberOfSeats" class="form-control @error('seats') is-invalid @enderror" name="NumberOfSeats" placeholder="Number of Seats" value="{{ $event->NumberOfSeats }}">
                                        @error('NumberOfSeats')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Category</label>
                                        <select class="form-select @error('category') is-invalid @enderror" id="category" name="category_id">
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $event->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="booking_status" class="form-label">Booking Status</label>
                                        <select class="form-select" id="booking_status" name="booking_status">
                                            <option value="0" {{ $event->booking_status == 0 ? 'selected' : '' }}>Automatic</option>
                                            <option value="1" {{ $event->booking_status == 1 ? 'selected' : '' }}>Manual</option>
                                        </select>
                                    </div>
                                
                                    <div class="mb-3">
                                        <label for="event" class="form-label">Event Image</label>
                                        <input type="file" class="form-control @error('event') is-invalid @enderror" id="event" name="event">
                                        @error('event')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                                
                                
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

