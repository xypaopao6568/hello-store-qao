@extends('pages.layouts.app')
@section('title', 'Trang Chủ')
{{-- @section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
@endsection --}}
@section('content')
    <section>
        <div class="container mt-5">
            <div id="slider" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach ($slide as $key => $slides)
                        <li data-target="#slider" data-slide-to="{{ $key }}" class="{{ $key === 0 ? 'active' : '' }}">
                        </li>
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    @foreach ($slide as $key => $slides)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                            <img src="{{ $slides->image }}" class="d-block w-100" alt="">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>{{ $slides->title }}</h5>
                                <h5>{{ $slides->sub_title }}</h5>
                            </div>
                        </div>
                    @endforeach
                </div>

                <a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#slider" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>
    <!-- Categories Section Begin -->
    <section class="categories featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="section-title">
                        <h2>{{ trans('page.list_category') }}</h2>
                    </div>
                    <div class="categories__slider owl-carousel">
                        @if (isset($categories))
                            @foreach ($categories as $item)
                                <div class="col-lg-3 my-3">
                                    <div class="categories__item shadow set-bg" data-setbg="{{ url($item->image) }}">
                                        <h5><a class="shadow"
                                                href="{{ url('category/' . $item->slug) }}">{{ $item->name }}</a></h5>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>{{ trans('page.product_new') }}</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            @if (isset($categories))
                                @foreach ($categories as $item)
                                    <li data-filter=".{{ $item->slug }}">{{ $item->name }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row featured__filter">
                @if ($featured_products)
                    @foreach ($featured_products as $item)
                        <div
                            class="col-lg-3 col-md-4 col-sm-6 mix @foreach ($item->categories as $items) {{ $items->category->slug }} @endforeach">
                            @include('pages.layouts.product', ['item' => $item])
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </section>

@endsection
@section('script')
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
@endsection
