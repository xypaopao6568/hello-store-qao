@extends('pages.layouts.app')
@section('title', $title)
@section('content')
    <section class="breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-page">
                        <h4>{{ $title }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">

                    @if ($order->status)
                        <div class="alert alert-info">
                            <h4>{{ trans('page.order_status') }}: <b> {!! trans(config('status.order')[$order->status]) !!} </b></h4>
                        </div>
                    @endif

                </div>
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">{{ trans('page.product') }}</th>
                                    <th>{{ trans('page.price') }}</th>
                                    <th>{{ trans('page.quantity') }}</th>
                                    <th>{{ trans('page.total') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($order->products) && $order->products->count() > 0)
                                    @foreach ($order->products as $item)
                                        <tr class="row-product">
                                            <td class="shoping__cart__item">
                                                <img src="{{ url($item->product->image) }}" alt="">
                                                <h5>{{ $item->product_name }}</h5>
                                            </td>
                                            <td class="shoping__cart__price">
                                                {{ $item->product_price > 0 ? number_format($item->product_price) : 0 }}
                                                {{ trans('page.currency') }}
                                            </td>
                                            <td class="shoping__cart__quantity">
                                                <b>{{ $item->quantity }}</b>
                                            </td>
                                            <td class="shoping__cart__total">
                                                {{ $item->total ? number_format($item->total * $item->quantity) : 0 }}
                                                {{ trans('page.currency') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                                <tr class="row-product my-3">
                                    <td class="shoping__product"></td>
                                    <td>
                                        <h4><b class="text-danger">TỔNG</b></h4>
                                    </td>
                                    <td>
                                        <h4><b
                                                class="text-danger">{{ number_format($order->products()->sum('quantity')) }}</b>
                                        </h4>
                                    </td>
                                    <td>
                                        <h4><b class="text-danger">{{ number_format($order->sub_total) }}
                                                {{ trans('page.currency') }}</b></h4>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            @if (isset($order->address) && $order->address)
                                <h4>{{ trans('page.address') }}</h4>
                                <ul>
                                    <li>Tên người nhận: <b class="float-right">{{ $order->address->customer_name }}</b>
                                    </li>
                                    <li>Số điện thoại: <b class="float-right">{{ $order->address->phone }}</b></li>
                                    @if ($order->address->email)
                                        <li>Email: <b class="float-right">{{ $order->address->email }}</b></li>
                                    @endif
                                    <li>Địa chỉ: <b class="float-right">{{ $order->address->address }},
                                            {{ $order->address->ward }}, {{ $order->address->district }},
                                            {{ $order->address->province }}</b></li>
                                </ul>
                            @else
                                <div class="alert alert-warning">
                                    {{ trans('page.address_removed') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6 col-xs-12">
                            @if ($order->payment)
                                <h4>{{ trans('page.payment') }}</h4>
                                <ul>
                                    <li>Phương thức thanh toán: <b class="float-right">{!! trans(config('payment.name')[$order->payment->payment]) !!}</b></li>
                                    <li>Số tiền: <b class="float-right">{{ $order->payment->price }}</b></li>
                                    <li>Ghi chú: <b class="float-right">{{ $order->payment->info }}</b></li>
                                    <li>Trạng Thái: <b class="float-right">
                                            @if ($order->payment->status == 0)
                                                Đã Thanh Toán
                                            @else
                                                Chờ xác nhận
                                            @endif
                                        </b></li>
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row my-3">
                <div class="col-md-12 text-center">
                    <a class="site-btn" href="{{ route('my-order') }}">{{ trans('page.my_order') }}</a>
                </div>
            </div>
        </div>
    </section>
    @include('pages.layouts.sub_footer')
@endsection
