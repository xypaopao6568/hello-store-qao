@extends('pages.layouts.app')
@section('title', 'Trang Chủ')
@section('content')
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('user_/image/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Winshop</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item ">
                            <h4>Danh Mục</h4>
                            <ul>
                                <li class="active" data-filter="*">All</li>
                                @foreach ($categories as $item)
                                    <li data-filter=".{{ $item->slug }}"> <a
                                            href="{{ url('category/' . $item->slug) }}">{{ $item->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Sản Phẩm Mới</h4>
                                <div class="latest-product__slider owl-carousel">
                                    @php
                                        $featured_products_array = $featured_products->toArray();
                                        $chunks = array_chunk($featured_products_array, 2);
                                    @endphp

                                    @foreach ($chunks as $chunk)
                                        <div class="latest-prdouct__slider__item">
                                            @foreach ($chunk as $item)
                                                <div class="latest-product__item">
                                                    <div class="latest-product__item__pic">
                                                        <img src="{{ $item['image'] }}" alt="">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6>{{ $item['name'] }}</h6>
                                                        <span>{{ $item['cost_price'] }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="featured spad col-lg-9 col-md-7">
                    <div class="container ">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title">
                                    <h2>{{ trans('page.product_new') }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row  product__discount__slider owl-carousel">
                            @if ($featured_products)
                                @foreach ($featured_products as $item)
                                    <div
                                        class="col-lg-4 col-md-4 col-sm-6 mix @foreach ($item->categories as $items) {{ $items->category->slug }} @endforeach product__discount__item">
                                        @include('pages.layouts.product', ['product' => $item])
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </div>
                </section>
                <div class="filter__item">
                    <div class="row">
                        <div class="col-lg-4 col-md-5">
                            <div class="filter__sort">
                                <span>Sort By</span>
                                <select>
                                    <option value="0">Default</option>
                                    <option value="0">Default</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="filter__found">
                                <h6><span>{{ $product_count }}</span> Products found</h6>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <div class="filter__option">
                                <span class="icon_grid-2x2"></span>
                                <span class="icon_ul"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-7 col-sm-7">
                        <div class="product__item">
                            <div class="row ">
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
                            <div class="row featured__filter ">
                                @if ($featured_products)
                                    @foreach ($featured_products as $item)
                                        <div
                                            class="col-lg-3 col-md-4 col-sm-6 mix @foreach ($item->categories as $items) {{ $items->category->slug }} @endforeach">
                                            @include('pages.layouts.product', ['product' => $item])
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>

            </div>
        </div>
        </div>
    </section>
@endsection
