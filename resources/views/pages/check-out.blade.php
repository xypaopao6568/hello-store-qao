@extends('pages.layouts.app')
@section('title', $title )
@section('content')
    <section class="breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-page">
                        <h4>{{ trans('page.shoping_cart') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout Section Begin -->
    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                            <tr>
                                <th class="shoping__product">{{ trans('page.product') }}</th>
                                <th>{{ trans('page.price') }}</th>
                                <th>{{ trans('page.quantity') }}</th>
                                <th>{{ trans('page.total') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(isset($carts) && $carts->count()>0)
                                    @foreach($carts as $item)
                                        <tr class="row-product">
                                            <td class="shoping__cart__item">
                                                <img src="{{ url($item->product->image) }}" alt="">
                                                <h5>{{ $item->product->name }}</h5>
                                            </td>
                                            <td class="shoping__cart__price">
                                                {{ $item->product->sale_price > 0 ? number_format($item->product->sale_price) : number_format($item->product->cost_price) }} {{ trans('page.currency') }}
                                            </td>
                                            <td class="shoping__cart__quantity">
                                                <div class="quantity">
                                                    <div class="pro-qty" data-id-cart="{{ $item->id }}">
                                                        <input type="text" value="{{ $item->quantity }}">
                                                    </div>
                                                    <div class="onloading"></div>
                                                </div>
                                            </td>
                                            <td class="shoping__cart__total">
                                                {{ $item->product->sale_price > 0 ? number_format($item->product->sale_price * $item->quantity) : number_format($item->product->cost_price * $item->quantity) }} {{ trans('page.currency') }}
                                            </td>
                                            <td class="shoping__cart__item__close">
                                                <div class="remove_product" data-id="{{ $item->id }}">
                                                    <i class="fa fa-times" style="color: #aaaaaa"></i>
                                                </div>
                                                <div class="onloading"></div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">
                                            <div class="alert alert-danger text-center w-100">
                                                {{ trans('page.cart_empty') }}
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{ route('home') }}" class="primary-btn cart-btn">{{ trans('page.continue_shopping') }}</a>
                        <a href="{{ url()->current() }}" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            {{ trans('page.update_cart') }}</a>
                    </div>
                </div>
                @if(isset($carts) && $carts->count()>0)
{{--                <div class="col-lg-6">--}}
{{--                    <div class="shoping__continue">--}}
{{--                        <div class="shoping__discount">--}}
{{--                            <h5>Discount Codes</h5>--}}
{{--                            <form action="#">--}}
{{--                                <input type="text" placeholder="Enter your coupon code">--}}
{{--                                <button type="submit" class="site-btn">APPLY COUPON</button>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>{{ trans('page.cart_total') }}</h5>
                        <ul>
                            <li>{{ trans('page.sub_total') }} <span> <b class="sum__cart">0</b> {{ trans('page.currency') }}</span></li>
                            <li>{{ trans('page.total') }} <span> <b class="sum__order sum__cart">0</b> {{ trans('page.currency') }}</span></li>
                        </ul>
                        <a href="{{ route('proccess-check-out') }}" class="primary-btn">{{ trans('page.process_check_out') }}</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    @include('pages.layouts.sub_footer')
@endsection
