@extends('pages.layouts.app')
@section('title', 'Trang Chủ')
@section('content')
    <section class="featured spad">
        <div class="container">
            <div class="row featured__filter">
                @if ($results)
                    @foreach ($results as $item)
                        <div
                            class="col-lg-3 col-md-4 col-sm-6 mix @foreach ($item->categories as $items) {{ $items->category->slug }} @endforeach">
                            @include('pages.layouts.product', ['product' => $item])
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </section>
@endsection
