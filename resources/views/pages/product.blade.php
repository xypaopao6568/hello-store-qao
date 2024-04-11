@extends('pages.layouts.app')
@section('title', $title)
@section('content')
    <section class="breadcrumb-section set-bg" data-setbg="{{ url($product->image) }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Snack Package</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <a href="./index.html">Snack</a>
                            <span>Snack Package</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large" src="{{ url($product->image) }}" alt="">
                        </div>
                        @if (sizeof($product->images) > 0)
                            <div class="product__details__pic__slider owl-carousel">
                                @foreach ($product->images as $item)
                                    <img data-imgbigurl="{{ url($item->url) }}" src="{{ url($item->url) }}" alt="">
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="product__details__text">
                        <h3>{{ $product->name }}</h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>({{ $product->reviews ? $product->reviews->count() : 0 }}
                                {{ trans('page.reviews') }})</span>
                        </div>
                        @if ($product->sale_price > 0)
                            <div class="product__details__price">
                                <stroke>{{ number_format($product->cost_price) }} {{ trans('page.unit_currency') }}</stroke>
                            </div>
                            <div class="product__details__price">{{ number_format($product->sale_price) }}
                                {{ trans('page.unit_currency') }}</div>
                        @else
                            <div class="product__details__price">{{ number_format($product->cost_price) }}
                                {{ trans('page.unit_currency') }}</div>
                        @endif
                        <p>{{ $product->description }}</p>
                        <div class="row-action">
                            <div class="product__details__quantity">
                                <div class="quantity">
                                    <div class="pro-qty pro-page">
                                        <input type="text" id="quantity" value="1">
                                    </div>
                                </div>
                            </div>
                            <div id="add_to_cart" data-id="{{ $product->id }}" class="primary-btn">
                                <i class="fa fa-shopping-cart mr-2"></i>
                                {{ trans('page.add_to_cart') }}
                                <div class="onloading"></div>
                            </div>
                            <a id="add_to_wish" data-id="{{ $product->id }}"
                                class="heart-icon @if (Auth::user() &&
                                        \App\Models\Wish::where('user_id', Auth::user()->id)->where('product_id', $product->id)->first() != null) active @endif">
                                <span class="icon_heart_alt"></span>
                                <div class="onloading"></div>
                            </a>
                        </div>
                        <ul>
                            <li>
                                <b>{{ trans('page.product_type') }}</b>
                                <span>
                                    @if (isset($product->categories) && $product->categories->count() > 0)
                                        @foreach ($product->categories as $cat)
                                            <a href="{{ url('category/' . $cat->category->slug) }}"
                                                class="mr-1 badge bg-success">{{ $cat->category->name }}</a>
                                        @endforeach
                                    @else
                                        <span class="bg-warning p-1">{{ trans('page.no_category') }}</span>
                                    @endif
                                </span>
                            </li>
                            <li>
                                <b>{{ trans('page.product_shipping') }}</b>
                                <span>01 day shipping. <samp>Free pickup today</samp></span>
                            </li>
                            <li><b>{{ trans('page.product_unit') }}</b> <span>{{ $product->unit }}</span></li>
                            <li><b>{{ trans('page.product_count') }}</b> <span>{{ $product->count }}</span></li>
                            <li><b>{{ trans('page.product_share_on') }}</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            {{--                            <li class="nav-item"> --}}
                            {{--                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab" --}}
                            {{--                                   aria-selected="true">{{ trans('page.product_description') }}</a> --}}
                            {{--                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">{{ trans('page.product_infomation') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">{{ trans('page.product_reviews') }} <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            {{--                            <div class="tab-pane active" id="tabs-1" role="tabpanel"> --}}
                            {{--                                <div class="product__details__tab__desc"> --}}
                            {{--                                    <h6>{{ trans('page.product_description') }}</h6> --}}
                            {{--                                    {{$product->description}} --}}
                            {{--                                </div> --}}
                            {{--                            </div> --}}
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>{{ trans('page.product_infomation') }}</h6>
                                    {!! $product->info ? $product->info : '' !!}
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>{{ trans('page.product_reviews') }}</h6>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>{{ trans('page.related_product') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @if ($related)
                    @foreach ($related as $item)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            @include('pages.layouts.product', ['product' => $item])
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    @include('pages.layouts.sub_footer')
@endsection
