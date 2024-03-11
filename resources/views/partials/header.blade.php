<header class="header">
    <div class="header-inner">
        <nav class="navbar navbar-expand-lg bg-barren barren-head navbar fixed-top justify-content-sm-start pt-0 pb-0">
            <div class="container">	
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon">
                        <i class="fa-solid fa-bars"></i>
                    </span>
                </button>
                <a class="navbar-brand order-1 order-lg-0 ml-lg-0 ml-2 me-auto" href="{{route('home')}}">
                    <div class="res-main-logo">
                        <img src="images/logo-icon.svg" alt="">
                    </div>
                    <div class="main-logo" id="logo">
                        <img src="images/logo.png" alt="">
                        <img class="logo-inverse" src="images/logo.png" alt="">
                    </div>
                </a>
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <div class="offcanvas-logo" id="offcanvasNavbarLabel">
                            <img src="images/logo-icon.svg" alt="">
                        </div>
                        <button type="button" class="close-btn" data-bs-dismiss="offcanvas" aria-label="Close">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="offcanvas-top-area">
                            <div class="create-bg">
                                <a href="create.html" class="offcanvas-create-btn">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <span>Create Event</span>
                                </a>
                            </div>
                        </div>							
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe_5">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " aria-current="page" href="{{route('home')}}">Explore Events</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="#">Pricing</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#">Contact Us</a>
                            </li> 
                            
                            <li class="nav-item">
                                <a class="nav-link" href="#">Blog</a>
                            </li>
                           
                        
                           
                        </ul>
                    </div>
                   
                </div>
                <div class="right-header order-2">
                    <ul class="align-self-stretch">
                        @guest
                        <li>
                            <a href="{{ route('login') }}" class="create-btn btn-hover">
                                <span>Log in</span>
                            </a>
                            <a href="{{ route('register') }}" class="create-btn btn-hover">
                                <span>Register</span>
                            </a>
                        </li>
                    @endguest
                    
                    @auth
                    @if(Auth::check() && Auth::user()->roles()->first()->name == 'orgonizer')

                    <li>
                        <a href="{{ route('event.create') }}" class="create-btn btn-hover"><span>Create Event</span></a>
                    </li>
                       
                    @endif
                    @if(Auth::check() && Auth::user()->roles()->first()->name == 'client')

                    <li>
                        <a href="{{ route('event.create') }}" class="create-btn btn-hover"><span>Become an Orgonizer</span></a>
                    </li>
                       
                    @endif
                        <li class="dropdown account-dropdown">
                            <a href="#" class="account-link" role="button" id="accountClick" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-expanded="false">
                                @if (Auth::user()->getFirstMedia('avatars'))
                                <img src="{{ Auth::user()->getFirstMedia('avatars')->getUrl() }}" alt="">
                                @else
                                <i class="fas fa-user-circle"></i>
                                @endif
                                <i class="fas fa-caret-down arrow-icon"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-account dropdown-menu-end" aria-labelledby="accountClick">
                                <li>
                                    <div class="dropdown-account-header">
                                        <div class="account-holder-avatar">
                                            @if (Auth::user()->getFirstMedia('avatars'))
                                            <img src="{{ Auth::user()->getFirstMedia('avatars')->getUrl() }}" alt="">
                                            @else
                                            <i class="fas fa-user-circle"></i>
                                            @endif
                                        </div>
                                        <h5>{{ Auth::user()->name }}</h5>
                                        <p>{{ Auth::user()->email }}</p>
                                    </div>
                                </li>
                                <li class="profile-link">
                                    <a href="{{route('profile.index')}}" class="link-item">My Profile</a>
                                    <a href="{{ route('logout') }}" class="link-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                       
                    </ul>
                </div>
            </div>
        </nav>
        <div class="overlay"></div>
    </div>
</header>