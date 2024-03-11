@extends('layouts.app2')

@section('title', 'Home')

@section('content')

<div class="wrapper">
    <div class="hero-banner">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-8 col-md-10">
                    <div class="hero-banner-content">
                        <h2>Discover Events For All The Things You Love</h2>
                        <div class="search-form main-form">
                            <form action="{{route('home')}}" class="serach-form-area">
                                <div class="row g-3">
                                    <div class="col-lg-10 col-md-12">
                                        <div class="form-group search-category">
                                            <input id="searchInput" type="text" name="searchKey" class="form-control" placeholder="Search Event..." style="height: 50px;">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-12">
                                        <button type="submit"  class="main-btn btn-hover w-100">Find</button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="explore-events p-80">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="event-filter-items">
                        <div class="featured-controls">
                            <div class="controls">
                                <button type="button" class="control" onclick="filterByCategory('')">All</button>
                                @foreach ($catigories as $category)
                                <button class="control" onclick="filterByCategory('{{ $category->id }}')">{{ $category->name }}</button>
                                @endforeach
                            </div>
                        </div>
                        <div class="row" data-ref="event-filter-content">
                            @foreach ($events as $event)
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mix sports concert volunteer arts events gallery-item" data-ref="mixitup-target" data-category="{{$event->category_id}}">
                                <div class="main-card mt-4">
                                    <div class="event-thumbnail">
                                        <a href="{{ route('eventDetails', $event->id) }}" class="thumbnail-img">
                                            @if ($event->getFirstMedia('events'))
                                            <a href="{{ route('eventDetails', $event->id) }}" class="thumbnail-img">
                                                <img src="{{ $event->getFirstMedia('events')->getUrl() }}" alt="">
                                            </a>
                                            @endif
                                        </a>
                                    </div>
                                    <input type="hidden" value="{{$event->category_id}}">
                                    <div class="event-content">
                                        <a href="{{ route('eventDetails', $event->id) }}" class="event-title">{{$event->title}}</a>
                                        <div class="duration-price-remaining">
                                            <div class="publish-date">
                                                <span><i class="fa-solid fa-calendar-day me-2"></i>{{date('d/m/Y', strtotime($event->date))}}</span>
                                            </div>
                                            <span class="remaining"><i class="fa-solid fa-ticket fa-rotate-90"></i>{{$event->NumberOfSeats}} Remaining</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div id="not-found-message" style="display: none; text-align: center; width: 100%; font-size: 204px;">
                               <h1>Not Found</h1>
                            </div>
                        </div>
                        <div class="pagination-container mt-4">
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    {{ $events->links() }}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<script src="{{ asset('js/search.js') }}"></script>
{{-- <script>
    var searchInput = document.getElementById("searchInput");

    var cards = document.querySelectorAll(".events");

    searchInput.addEventListener("input", function() {
        var searchTerm = searchInput.value.toLowerCase();

        cards.forEach(function(card) {
            var cardText = card.textContent.toLowerCase();
            if (cardText.includes(searchTerm)) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    });
</script>

<script>
    $(document).ready(function() {

        $('.control').on('click', function(e) {
            e.preventDefault();

            var category = $(this).data('filter'); 

            $.ajax({
                url: '/events/filter',
                type: 'GET',
                data: {
                    category: category
                },
                success: function(data) {
                    $('#filtered-events').html(data);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script> --}}
@endsection