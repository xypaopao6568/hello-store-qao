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
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>{{ trans('page.address_id') }}</th>
                                    <th>{{ trans('page.address_name') }}</th>
                                    <th>{{ trans('page.address_detail') }}</th>
                                    <th>
                                        <div class="float-right btn btn-sm btn-info" id="btn-add-address">
                                            {!! trans('page.add_address') !!}</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($address) && $address->count() > 0)
                                    @foreach ($address as $item)
                                        <tr>
                                            <td>
                                                {{ $item->id }}
                                            </td>
                                            <td>
                                                {{ $item->name }}
                                            </td>
                                            <td>
                                                <ul class="text-left">
                                                    <li>Địa chỉ: <b>{{ $item->address }}, {{ $item->ward }}
                                                            , {{ $item->district }}, {{ $item->province }}</b>
                                                    </li>
                                                    <li>
                                                        Điện thoại: <b>{{ $item->phone }}</b>
                                                    </li>
                                                    <li>
                                                        Email: <b>{{ $item->email ? $item->email : '' }}</b>
                                                    </li>
                                                </ul>

                                            </td>
                                            <td>

                                                <div class="float-right mx-1 btn btn-sm btn-danger btn-delete-address"
                                                    data-id="{{ $item->id }}">{{ trans('page.delete_address') }}</div>
                                                {{--                                            <a class="float-right mx-1 btn btn-info btn-sm" href="{{ route('show-order', ['id'=>$item->id]) }}">{{ trans('page.view_order') }}</a> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="address" class="ws-over close">
        <div class="ws-container">
            <div class="ws-modal">
                <div class="close-modal"></div>
                <div class="ws-title">NHẬP THÔNG TIN NHẬN HÀNG</div>
                <div class="ws-body">
                    <div class="ws-loading close">
                        <img src="{{ url('images/loading.gif') }}" alt="" width="40px" height="40px">
                    </div>
                    <div id="address-content">
                        <div class="checkout__input mt-2">
                            <p>Tên hiển thị<span>*</span></p>
                            <input type="text" name="name" class="required">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Tên người nhận<span>*</span></p>
                                    <input type="text" name="customer_name" class="required">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Số điện thoại người nhận<span>*</span></p>
                                    <input type="number" name="phone" class="required">
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input row">
                            <div class="col-lg-4">
                                <p>Tỉnh<span>*</span></p>
                                <select name="province" class="form-control vn-select vn-province required"></select>
                            </div>
                            <div class="col-lg-4">
                                <p>Huyện<span>*</span></p>
                                <select name="district" class="form-control vn-select vn-district required"></select>
                            </div>
                            <div class="col-lg-4">
                                <p>Xã<span>*</span></p>
                                <select name="ward" class="form-control vn-select vn-ward required"></select>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Địa chỉ nhà<span>*</span></p>
                            <input type="text" name="address" class="required">
                            <i>(Tổ, xóm, ngõ, ngách, số nhà...)</i>
                        </div>
                        <div class="checkout__input">
                            <p>Email người nhận</p>
                            <input type="email" name="email">
                        </div>
                        <div class="checkout__input">
                            <button type="submit" id="add_address" class="site-btn" name="add">Thêm</button>

                            <p class="my-2"><span class="text-danger">* </span>Mục bắt buộc</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.layouts.sub_footer')
@endsection
@section('script')
    <script>
        $('.btn-delete-address').click(function() {
            var _this = $(this);
            var id = _this.data('id');
            if (id) {
                Swal.fire({
                    icon: 'question',
                    title: '{{ trans('page.alert_delete_address') }}',
                    showCancelButton: true,
                    confirmButtonText: `{{ trans('page.button_delete_address') }}`,
                    cancelButtonText: `{{ trans('page.button_cancel') }}`,
                    confirmButtonColor: 'rgba(144,43,43,0.91)',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('delete-address') }}',
                            type: "POST",
                            data: {
                                _token: _token,
                                id: id
                            },
                            success: function(data) {
                                if (data.status == 1) {
                                    if (data.msg) {
                                        toastr.clear();
                                        toastr.success(data.msg);
                                    }
                                } else {
                                    if (data.msg) {
                                        toastr.clear();
                                        toastr.error(data.msg);
                                    } else {
                                        toastr.clear();
                                        toastr.error('{{ trans('page.has_error') }}');
                                    }
                                }
                                location.reload();
                            },
                            error: function(data) {
                                toastr.clear();
                                toastr.error('{{ trans('page.has_error') }}');
                            }
                        });
                    }
                })

            }

        });
    </script>
    <script src="{{ url('js/vietnam/selector.js') }}"></script>
    <script>
        var localpicker = new LocalPicker({
            province: "province",
            district: "district",
            ward: "ward"
        });
        $('#address .close-modal').click(function() {
            ad_loading($('#address').find('.ws-loading'), false)
        });
        $('#add_address').click(function(e) {
            if ($('#address').find('.ws-loading').hasClass('close')) {
                ad_loading($('#address').find('.ws-loading'))
                var check = 1;
                $('#address-content input, #address-content select').each(function() {
                    if (($(this).val() == '' || $(this).val() == null) && $(this).hasClass('required')) {
                        var tb = '';
                        if ($(this).attr("name") === 'name') {
                            tb = 'Chưa nhập tên hiển thị!';
                        } else if ($(this).attr("name") === 'customer_name') {
                            tb = 'Chưa nhập tên người nhận!';
                        } else if ($(this).attr("name") === 'phone') {
                            tb = 'Chưa nhập số điện thoại người nhận!';
                        } else if ($(this).attr("name") === 'address') {
                            tb = 'Chưa nhập địa chỉ nhà!';
                        } else if ($(this).attr("name") === 'province') {
                            tb = 'Chưa chọn tỉnh/thành phố!';
                        } else if ($(this).attr("name") === 'district') {
                            tb = 'Chưa chọn quận/huyện!';
                        } else if ($(this).attr("name") === 'ward') {
                            tb = 'Chưa chọn xã/phường/thị trấn!';
                        }
                        if (tb !== '') {
                            toastr.clear();
                            toastr.error(tb);
                        }

                        ad_loading($('#address').find('.ws-loading'))
                        $(this).focus();
                        check = 0;
                        return false;
                    }
                });
                if (check) {
                    var name = $('#address-content input[name="name"]').val();
                    var customer_name = $('#address-content input[name="customer_name"]').val();
                    var phone = $('#address-content input[name="phone"]').val();
                    var address = $('#address-content input[name="address"]').val();
                    var email = $('#address-content input[name="email"]').val();

                    var province = $('#address-content .vn-province option:selected').text();
                    var district = $('#address-content .vn-district option:selected').text();
                    var ward = $('#address-content .vn-ward option:selected').text();
                    console.log(province);
                    console.log(district);
                    console.log(ward);
                    console.log(name);

                    $.ajax({
                        url: "{{ route('add-address') }}",
                        type: "POST",
                        data: {
                            _token: _token,
                            name: name,
                            customer_name: customer_name,
                            phone: phone,
                            address: address,
                            email: email,
                            province: province,
                            district: district,
                            ward: ward
                        },
                        success: function(data) {
                            ad_loading($('#address').find('.ws-loading'))
                            if (data.status == 1) {
                                ad_reset();
                                if (data.msg) {
                                    toastr.clear();
                                    toastr.success(data.msg);
                                }
                                location.reload();
                            } else {
                                if (data.error) {
                                    toastr.clear();
                                    toastr.error(data.error);
                                }

                            }
                        },
                        error: function(data) {
                            ad_loading($('#address').find('.ws-loading'))
                            toastr.clear();
                            toastr.error('{{ trans('alert.has_error') }}');
                        }
                    });
                }

            }

            return false;
        });

        $('#btn-add-address').click(function() {
            ad_loading($('#address').find('.ws-loading'), false)
            $('#address').removeClass('close');
            $('#address').addClass('open');
        });

        function ad_reset() {
            $('#address-content input, #address-content select').each(function() {
                $(this).val(null);
            });
        }

        function ad_loading(_this, stt = '') {

            if (_this.hasClass('close')) {
                $('#address-content').hide();
                _this.removeClass('close');
                _this.addClass('open');
            } else {
                $('#address-content').show();
                _this.removeClass('open');
                _this.addClass('close');
            }
            if (stt == false) {
                $('#address-content').show();
                _this.removeClass('open');
                _this.addClass('close');
            }
        }
    </script>

@endsection
