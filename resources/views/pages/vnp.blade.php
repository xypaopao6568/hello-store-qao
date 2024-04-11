@extends('pages.layouts.app')
@section('title', 'Trang Chủ')
@section('content')
    <div class="col-lg-3">
        <div class="header__cart">
            <a class="my-cart1"></i> <span class="count_cart"></span></a>
        </div>
    </div>
    <div id="vnp" class="ws-over close">
        <div class="ws-container">

            <div class="ws-modal_vpn">
                <div>
                    <div class="close-modal"></div>
                    <div class="ws-title">Mã QR</div>
                    <div class="ws-body">
                        {{ $qrCode }}
                    </div>
                </div>
                <div>
                    <div id="vpn_qr">

                        <div class="flex flex-wrap -mx-3 mb-6">
                            @foreach ($product->products as $item)
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="grid-first-name">
                                        Tên sản phẩm
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded   leading-tight focus:outline-none focus:bg-white"
                                        id="grid-first-name" type="text" value="{{ $item->product_name }}">
                                </div>
                            @endforeach

                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-last-name">
                                    Tổng số tiền
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded   leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-last-name" type="text" value="{{ $product->total }}">
                            </div>

                            <div class="w-full md:w-1/2 px-3 mt-3    md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-first-name">
                                    Địa chỉ
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded   leading-tight focus:outline-none focus:bg-white"
                                    id="grid-first-name" type="text"
                                    value="{{ $product->address->province }} / {{ $product->address->district }} / {{ $product->address->ward }}">
                            </div>
                            <div class="w-full md:w-1/2 px-3 mt-3    md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-first-name">
                                    Số điện thoại
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded   leading-tight focus:outline-none focus:bg-white"
                                    id="grid-first-name" type="text" value="{{ $product->address->phone }}">
                            </div>
                            <div class="w-full md:w-1/2 px-3 mt-3    md:mb-0">
                                <a href="{{ route('check-out') }}" class="">Qoay
                                    lại</a>

                            </div>
                        </div>


                    </div>
                </div>


            </div>

        </div>
    </div>
@endsection
@section('script')
    <script>
        // Tìm phần tử có class "my-cart1"
        var myCartElement = document.querySelector('.my-cart1');

        // Tạo sự kiện nhấn chuột giả lập
        var clickEvent = new MouseEvent('click', {
            bubbles: true,
            cancelable: true,
            view: window
        });

        // Kích hoạt sự kiện click trên phần tử "my-cart1"
        myCartElement.dispatchEvent(clickEvent);
    </script>
@endsection
