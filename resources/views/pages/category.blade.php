@extends('pages.layouts.app')
@section('title', $title )
@section('content')
    <section class="breadcrumb-section set-bg" data-setbg="{{url($category->image)}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ $category->name }}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('home') }}">{{ trans('page.home') }}</a>
                            <span>{{ $category->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-page">
                        <h4>{{ trans('page.list_product') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="list-product">
        <div class="container">
            <div class="row my-5">
                @if (isset($products) && $products->count() > 0)
                    @foreach ($products as $item)
                        {{--                            {{ dd($item->product) }}--}}
                        <div
                            class="col-lg-3 col-md-4 col-sm-6">
                            @include('pages.layouts.product', ['item'=>$item->product])
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    @include('pages.layouts.sub_footer')
@endsection
