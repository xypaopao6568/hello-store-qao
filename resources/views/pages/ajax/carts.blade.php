@if(isset($carts) && $carts->count() > 0)
    <div class="col-md-12 px-0">
        <div class="checkout__order">
            <div class="checkout__order__products">
                <span class="cart_name">{{ trans('page.product') }}</span>
                {{--                <span class="cart_qty">{{ trans('carts.quantity') }}</span>--}}
                {{--                <span class="cart_qty">{{ trans('carts.price') }}</span>--}}
                <span class="cart_total">{{ trans('page.total') }}</span>
            </div>
            <ul class="cart_product_list">
                @foreach($carts as $item)
                    <li>
                        <span class="cart_name">
                            <img src="{{ url($item->product->image) }}" alt="" width="50px" height="50px">
                            {{ $item->product->name }}
                        </span>
                        {{--                        <span class="cart_qty"><input type="number" value="{{ $item->quantity }}" style="width: 70px"></span>--}}
                        {{--                        <span class="cart_qty">{{ number_format($item->product->sale_price?$item->product->sale_price:$item->product->cost_price) }}</span>--}}
                        {{--                        <span class="cart_total">{{ number_format((int)$item->quantity*(int)($item->product->sale_price?$item->product->sale_price:$item->product->cost_price)) }} {{ trans('page.currency') }}</span>--}}
                        <span class="cart_total">
                            {{ number_format($item->quantity) }} x {{ number_format(($item->product->sale_price?$item->product->sale_price:$item->product->cost_price)) }} {{ trans('page.currency') }}
                        </span>
                    </li>
                @endforeach
            </ul>
            <div class="checkout__order__subtotal">{{ trans('page.sub_total') }}
                <span>{{ number_format($sub_total) }} {{ trans('page.currency') }}</span></div>
            <div class="checkout__order__total">{{ trans('page.total') }}
                <span>{{ number_format($sub_total) }} {{ trans('page.currency') }}</span></div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('check-out') }}" class="site-btn">{{ trans('page.pay_order') }}</a>
            </div>

        </div>
    </div>
@elseif(isset($carts) && $carts->count() == 0)
    <div class="col-md-12 px-0">
        <div class="alert alert-info my-2">
            <h5>{{ trans('page.cart_empty') }}</h5>
        </div>
    </div>
@else
    <div class="col-md-12 px-0">
        <div class="alert alert-danger my-2">
            <h5>{{ trans('page.must_login') }}</h5>
        </div>
    </div>

@endif
