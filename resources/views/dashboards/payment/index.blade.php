@extends('dashboards.layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">{{ $title }}</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboards') }}"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active text-light"><b>{{ $title }}</b></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row pb-3">
                        <div class="col-md-12 col-12 text-center position-relative">
                            <b>
                                <h4 class="m-1 text-primary">DANH SÁCH PAYMENT</h4>
                            </b>
                            <button type="button" class="btn btn-primary btn-icon has-ripple"
                                style="z-index: 1000; position: absolute; right: 15px; top: 0;" data-toggle="modal"
                                data-target="#add-product"><i class="fas fa-plus"></i><span class="ripple ripple-animate"
                                    style="height: 174.078px; width: 174.078px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(255, 255, 255); opacity: 0.4; top: -66.031px; left: -0.359125px;"></span></button>
                        </div>
                    </div>
                    <div class="row d-flex flex-direction-row p-1">
                        <div class="col-md-12 col-12">
                            <div class="d-md-flex flex-direction-row justify-content-end w-100">
                                <div class="mx-md-2 col-xs-12">
                                    <div class="d-flex flex-row align-items-center">
                                        <b style="min-width: 100px; white-space: nowrap;">Sắp Xếp Theo</b>
                                        {{-- <select name="sort" id="sort" data-type="product"
                                            data-content="table-content" data-route-data="{{ route('product') }}"
                                            class="sort form-control">
                                            {{-- <option value=""></option> --}}
                                        {{-- <option value="id" data-sort="asc"
                                            {{ Session::has('sort-product') && Session::get('sort-product') == 'id' && Session::get('sort-products') == 'asc' ? 'selected' : '' }}>
                                            ID tăng</option>
                                        <option value="id" data-sort="desc"
                                            {{ Session::has('sort-product') && Session::get('sort-product') == 'id' && Session::get('sort-products') == 'desc' ? 'selected' : '' }}>
                                            ID giảm</option>
                                        <option value="name" data-sort="asc"
                                            {{ Session::has('sort-product') && Session::get('sort-product') == 'name' && Session::get('sort-products') == 'asc' ? 'selected' : '' }}>
                                            Tên A-Z</option>
                                        <option value="name" data-sort="desc"
                                            {{ Session::has('sort-product') && Session::get('sort-product') == 'name' && Session::get('sort-products') == 'desc' ? 'selected' : '' }}>
                                            Tên Z-A</option>
                                        <option value="cost_price" data-sort="asc"
                                            {{ Session::has('sort-product') && Session::get('sort-product') == 'cost_price' && Session::get('sort-products') == 'asc' ? 'selected' : '' }}>
                                            Giá tăng</option>
                                        <option value="cost_price" data-sort="desc"
                                            {{ Session::has('sort-product') && Session::get('sort-product') == 'cost_price' && Session::get('sort-products') == 'desc' ? 'selected' : '' }}>
                                            Giá giảm</option>
                                        <option value="count" data-sort="asc"
                                            {{ Session::has('sort-product') && Session::get('sort-product') == 'count' && Session::get('sort-products') == 'asc' ? 'selected' : '' }}>
                                            Số lượng tăng </option>
                                        <option value="count" data-sort="desc"
                                            {{ Session::has('sort-product') && Session::get('sort-product') == 'count' && Session::get('sort-products') == 'desc' ? 'selected' : '' }}>
                                            Số lượng giảm</option>
                                        <option value="created_at" data-sort="asc"
                                            {{ Session::has('sort-product') && Session::get('sort-product') == 'created_at' && Session::get('sort-products') == 'asc' ? 'selected' : '' }}>
                                            Cũ nhất</option>
                                        <option value="created_at" data-sort="desc"
                                            {{ Session::has('sort-product') && Session::get('sort-product') == 'created_at' && Session::get('sort-products') == 'desc' ? 'selected' : '' }}>
                                            Mới nhất</option>
                                        </select> --}}
                                    </div>
                                </div>
                                <div class="mx-md-2 col-xs-12">
                                    <div class="d-flex flex-row align-items-center">
                                        <b style="min-width: 100px; white-space: nowrap;">Số Dòng</b>
                                        <select name="limit" id="limit" data-route-data="{{ route('product') }}"
                                            class="limit form-control">
                                            <option value="10" {{ !Session::has('limit') ? 'selected' : '' }}>
                                            </option>
                                            <option value="5"
                                                {{ Session::has('limit') && Session::get('limit') == 5 ? 'selected' : '' }}>
                                                5
                                            </option>
                                            <option value="10"
                                                {{ Session::has('limit') && Session::get('limit') == 10 ? 'selected' : '' }}>
                                                10
                                            </option>
                                            <option value="20"
                                                {{ Session::has('limit') && Session::get('limit') == 20 ? 'selected' : '' }}>
                                                20
                                            </option>
                                            <option value="30"
                                                {{ Session::has('limit') && Session::get('limit') == 30 ? 'selected' : '' }}>
                                                30
                                            </option>
                                            <option value="40"
                                                {{ Session::has('limit') && Session::get('limit') == 40 ? 'selected' : '' }}>
                                                40
                                            </option>
                                            <option value="50"
                                                {{ Session::has('limit') && Session::get('limit') == 50 ? 'selected' : '' }}>
                                                50
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mx-md-2 col-xs-12">
                                    <div class="d-flex flex-row align-items-center">
                                        <b style="min-width: 100px; white-space: nowrap;">Tìm kiếm:</b>
                                        <input type="text" value="" class="form-control search-table"
                                            data-route="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="table-body" class="ld-over">
                    <div class="ld ld-ring ld-spin"></div>
                    <div id="table-content">
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th class="d-flex align-items-center">
                                                <div class="icheck-primary d-inline">
                                                    <input class="icheck" type="checkbox" id="check-all">
                                                    <label for="check-all"><b></b></label>
                                                </div>
                                                <button type="button" class="btn btn-sm btn-danger ld-over" id="delete-all"
                                                    data-route="" data-route-data="">
                                                    <i class="fas fa-trash-alt"></i>
                                                    <div class="ld ld-ring ld-spin"></div>
                                                </button>
                                            </th>
                                            <th>User</th>
                                            <th>Payment</th>
                                            <th>Info</th>
                                            <th>Price</th>
                                            <th>Trạng Thái</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($lists))
                                            @foreach ($lists as $item)
                                                <tr>
                                                    <td>
                                                        <div class="icheck-primary d-inline">
                                                            <input class="icheck ichecks" name="id[]"
                                                                value="{{ $item->id }}" type="checkbox"
                                                                id="check-{{ $item->id }}">
                                                            <label
                                                                for="check-{{ $item->id }}"><b>{{ $item->id }}</b></label>
                                                        </div>
                                                    </td>
                                                    <td style="white-space: normal; max-width: 300px;">
                                                        <b>{{ $item->User->name }}</b>
                                                    </td>
                                                    <td style="white-space: normal; max-width: 300px;">
                                                        <b>{{ $item->payment }}</b>
                                                    </td>

                                                    <td style="white-space: normal; max-width: 300px;">
                                                        <b>{{ $item->info }}</b>
                                                    </td>
                                                    <td style="white-space: normal; max-width: 300px;">
                                                        <b>{{ $item->price }}</b>
                                                    </td>
                                                    <td>
                                                        @if ($item->status == 1)
                                                            <button type="button"
                                                                class="btn-change-Payment btn btn-success has-ripple ld-over"
                                                                data-id="{{ $item->id }}" data-status="1"
                                                                data-route="{{ route('change-payment') }}">
                                                                <div class="ld ld-ring ld-spin"></div>
                                                                <b><i class="feather mr-2 icon-check-circle"></i>Chờ xác
                                                                    nhận</b>
                                                                <span class="ripple ripple-animate"
                                                                    style="height: 112.828px; width: 112.828px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(255, 255, 255); opacity: 0.4; top: -26.781px; left: 12.6565px;"></span>
                                                            </button>
                                                        @else
                                                            <button type="button"
                                                                class="btn-change-Payment btn btn-secondary has-ripple ld-over"
                                                                data-id="{{ $item->id }}" data-status="0"
                                                                data-route="{{ route('change-payment') }}">
                                                                <div class="ld ld-ring ld-spin"></div>
                                                                <b><i class="feather mr-2 icon-slash"></i>Đã xác nhận</b>
                                                                <span class="ripple ripple-animate"
                                                                    style="height: 112.828px; width: 112.828px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(255, 255, 255); opacity: 0.4; top: -26.781px; left: 12.6565px;"></span>
                                                            </button>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-icon btn-success btn-edit ld-over"
                                                            data-id="{{ $item->id }}">
                                                            <i class="fas fa-pencil-alt"></i>
                                                            <div class="ld ld-ring ld-spin"></div>
                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-icon btn-danger action_delete ld-over"
                                                            data-url="{{ route('delete-user', ['id' => $item->id]) }}">
                                                            <i class="fas fa-trash-alt"></i>
                                                            <div class="ld ld-ring ld-spin"></div>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row my-2">
                                <div class="col-md-12">
                                    {{ $lists->links('pagination.custom') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/ajax/user_ajax.js') }}"></script>
    <script>
        $(".btn-change-Payment").click(function() {
            _this = $(this);
            id = _this.data('id');
            status = _this.data('status');
            if (status == 0) {
                status = 1;
            } else {
                status = 0;
            }
            route = _this.data('route');
            _this.addClass('running');
            $.ajax({
                url: route,
                type: "POST",
                data: {
                    _token: _token,
                    id: id,
                    status: status
                },
                success: function(data) {
                    if (data == '1') {
                        toastr.clear();
                        toastr.success('Thay đổi thành công!');
                        _this.removeClass('running');
                        _this.data('status', status);
                        if (status == 1) {
                            _this.addClass("btn-success");
                            _this.removeClass("btn-secondary");
                            _this.find('b').html(
                                '<i class="feather mr-2 icon-check-circle"></i>Chờ xác nhận');
                        } else {
                            _this.addClass("btn-secondary");
                            _this.removeClass("btn-success");
                            _this.find('b').html(
                                '<i class="feather mr-2 icon-slash"></i>Đã xác nhận');
                        }
                    } else {
                        _this.removeClass('running');
                        toastr.clear();
                        toastr.error('Thay đổi thất bại!');
                    }
                },
                error: function() {
                    toastr.clear();
                    toastr.error('Thay đổi gặp lỗi!');
                }
            });

        })
    </script>
@endsection
