@extends('layouts.main')

@section('content')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="profile-bg-picture" style="background-image: url('{{ asset('assets/images/bg-profile.jpg') }}')">
                    <span class="picture-bg-overlay"></span>
                    <!-- overlay -->
                </div>
                <!-- meta -->
                <div class="profile-user-box">
                    <div class="row">
                        <div class="col-sm-6">
                            @if ($user->getFirstMedia('avatars'))
                                <div class="profile-user-img"><img src="{{ $user->getFirstMedia('avatars')->getUrl() }}" alt="" class="avatar-lg rounded-circle"></div>
                            @else
                                <i class="ri-account-circle-line fs-18 align-middle me-1"></i>
                            @endif

                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex justify-content-end align-items-center gap-2">
                               <br>
                               

                            </div>
                        </div>
                    </div>
                </div>
                <!--/ meta -->
            </div>
        </div>



        <div class="row">
            <div class="col-sm-12">
                <div class="card p-0">
                    <div class="card-body p-0">
                        <div class="profile-content">
                            <ul class="nav nav-underline nav-justified gap-0">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" data-bs-target="#aboutme" type="button" role="tab" aria-controls="home" aria-selected="true" href="#aboutme">User Informations</a></li>
                            </ul>

                            <div class="tab-content m-0 p-4">
                                <div class="tab-pane active" id="aboutme" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                    <div class="profile-desk">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h2 class="text-uppercase fs-24 text-dark">{{ $user->name }} {{ $user->last_name }}</h2>
                                                <div class="designation mb-4">{{ $user->profession }}</div>
                                                <div class="mt-4">
                                                    <h4 class="fs-20 text-dark">Contact Information</h4>
                                                    <p class="text-muted fs-16"><strong>Email:</strong> <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
                                                    <p class="text-muted fs-16"><strong>Phone:</strong> <a href="tel:{{ $user->phone }}">{{ $user->phone }}</a></p>

                                                </div>
                                                <div class="mt-4">
                                                    <h4 class="fs-20 text-dark">About Me</h4>
                                                    <p class="text-muted fs-16">{{ $userProfile?->motivation ?? 'Motivation not added yet.' }}</p>

                                                </div>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                @if ( $user->getFirstMedia('cvs'))
                                                <a href="{{ $user->getFirstMedia('cvs')->getUrl() }}" class="btn btn-primary" download>Download CV</a>
                                                 @else
                                                 <h4>No Resume Yet</h4>
                                                @endif
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
