@if (isset($item) && $item != null)
    <div class="featured__item shadow">
        <div class="featured__item__pic set-bg" data-setbg="{{ url($item->image) }}">
            <div data-id="{{ $item->id }}" class="wish @if (Auth::user() &&
                    \App\Models\Wish::where('user_id', Auth::user()->id)->where('product_id', $item->id)->first()) active @endif"
                data-bs-toggle="tooltip" data-bs-placement="top" title="like">
                <div class="noloading active">
                    <i class="fa fa-heart"></i>
                </div>
                <div class="onloading"></div>
            </div>
            <div class="add-to-cart" data-id="{{ $item->id }}" data-name="{{ $item->name }}">
                <div class="noloading active">
                    <i class="fa fa-shopping-cart mr-2"></i>
                    {{ trans('page.add_to_cart') }}
                </div>
                <div class="onloading"></div>
            </div>
        </div>
        <div class="featured__item__text">
            <h6><a href="{{ route('product-detail', $item->slug) }}" class="product-title">{{ $item->name }}</a></h6>
            <h5>{{ number_format($item->cost_price) }} {{ trans('page.unit_currency') }}</h5>
        </div>
    </div>
@endif
