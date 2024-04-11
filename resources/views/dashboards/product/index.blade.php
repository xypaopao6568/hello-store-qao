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
                                <h4 class="m-1 text-primary">DANH SÁCH SẢN PHẨM</h4>
                            </b>
                            <div id="add-product" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Thêm Sản Phẩm</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>
                                        <div class="modal-body ld-over" id="add-form">
                                            <div class="ld ld-ring ld-spin"></div>
                                            <form action="" method="post">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group fill">
                                                            <label for="product_name">Tên sản phẩm</label>
                                                            <input type="text" name="name" class="form-control"
                                                                id="product_name" aria-describedby="Tên sản phẩm"
                                                                placeholder="Tên sản phẩm">
                                                            <small id="product_name" class="form-text text-muted"></small>
                                                        </div>
                                                        <div class="form-group fill">
                                                            <label for="product_price">Giá sản phẩm</label>
                                                            <input type="number" name="price" value="0"
                                                                class="form-control" id="product_price"
                                                                aria-describedby="Giá sản phẩm" placeholder="Giá sản phẩm">
                                                            <small class="form-text text-muted"></small>
                                                        </div>
                                                        <div class="form-group fill">
                                                            <label for="product_unit">Đơn vị tính</label>
                                                            <input type="text" name="unit" class="form-control"
                                                                id="product_unit" aria-describedby="Đơn vị tính"
                                                                placeholder="Đơn vị tính">
                                                            <small class="form-text text-muted"></small>
                                                        </div>
                                                        <div class="form-group fill">
                                                            <label for="product_count">Số lượng</label>
                                                            <input type="number" name="count" value="0"
                                                                class="form-control" id="product_count"
                                                                aria-describedby="Số lượng" placeholder="Số lượng">
                                                            <small class="form-text text-muted"></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="product_description">Mô tả</label>
                                                            <textarea class="form-control" id="product_description" rows="3"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="product_description">Hình ảnh</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input"
                                                                    id="image" accept="image/*">
                                                                <label class="custom-file-label" for="image">Choose
                                                                    file...</label>
                                                                <div class="invalid-feedback"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group fill">
                                                            <div class="col-12 text-center">
                                                                <div id="upload-demo"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-center p-2">
                                            <button type="button" id="add" class="btn  btn-primary">Thêm</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                        <select name="sort" id="sort" data-type="product"
                                            data-content="table-content" data-route-data="{{ route('product') }}"
                                            class="sort form-control">
                                            {{-- <option value=""></option> --}}
                                            <option value="id" data-sort="asc"
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
                                        </select>
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
                                            data-route="{{ route('search-product') }}">
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
                                                <button type="button" class="btn btn-sm btn-danger ld-over"
                                                    id="delete-all" data-route="{{ route('delete-products') }}"
                                                    data-route-data="{{ route('product') }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                    <div class="ld ld-ring ld-spin"></div>
                                                </button>
                                            </th>
                                            <th>Tên Sản Phẩm</th>
                                            <th>Hình Ảnh</th>
                                            <th>Chi Tiết</th>
                                            <th>Trạng Thái</th>
                                            <th>Thao Tác</th>
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
                                                        <b>{{ $item->name }}</b>
                                                    </td>
                                                    <td>
                                                        <img class="shadow" src="{{ url($item->image) }}" alt=""
                                                            width="80px" height="80px">
                                                    </td>
                                                    <td style="white-space: normal;">
                                                        <ul class="mb-0 pl-2">
                                                            <li>
                                                                Link: <b><a target="_blank"
                                                                        href="{{ url('product/' . $item->slug) }}">{{ url('product/' . $item->slug) }}</a></b>
                                                            </li>
                                                            <li>
                                                                Giá bán: <b>{{ number_format($item->cost_price) }}</b>
                                                            </li>
                                                            <li>
                                                                Giá khuyến mãi:
                                                                <b>{{ number_format($item->sale_price) }}</b>
                                                            </li>
                                                            <li>
                                                                Đơn vị tính: <b>{{ $item->unit }}</b>
                                                            </li>
                                                            <li>
                                                                Số lượng: <b>{{ number_format($item->count) }}</b>
                                                            </li>
                                                            <li>
                                                                Danh mục:
                                                                @foreach ($item->categories as $items)
                                                                    <b
                                                                        class="text-primary">{{ $items->category->name }}</b>,
                                                                @endforeach
                                                            </li>
                                                            <li>
                                                                Mô tả: <b>{{ $item->description }}</b>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        @if ($item->status == 1)
                                                            <button type="button"
                                                                class="btn-change btn btn-success has-ripple ld-over"
                                                                data-id="{{ $item->id }}" data-status="1"
                                                                data-route="{{ route('change-product') }}">
                                                                <div class="ld ld-ring ld-spin"></div>
                                                                <b><i class="feather mr-2 icon-check-circle"></i>Hoạt
                                                                    động</b>
                                                                <span class="ripple ripple-animate"
                                                                    style="height: 112.828px; width: 112.828px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(255, 255, 255); opacity: 0.4; top: -26.781px; left: 12.6565px;"></span>
                                                            </button>
                                                        @else
                                                            <button type="button"
                                                                class="btn-change btn btn-secondary has-ripple ld-over"
                                                                data-id="{{ $item->id }}" data-status="0"
                                                                data-route="{{ route('change-product') }}">
                                                                <div class="ld ld-ring ld-spin"></div>
                                                                <b><i class="feather mr-2 icon-slash"></i>Ngưng hoạt
                                                                    động</b>
                                                                <span class="ripple ripple-animate"
                                                                    style="height: 112.828px; width: 112.828px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(255, 255, 255); opacity: 0.4; top: -26.781px; left: 12.6565px;"></span>
                                                            </button>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-icon btn-primary btn-view ld-over"
                                                            data-id="{{ $item->id }}">
                                                            <i class="fas fa-eye"></i>
                                                            <div class="ld ld-ring ld-spin"></div>
                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-icon btn-success btn-edit ld-over"
                                                            data-id="{{ $item->id }}">
                                                            <i class="fas fa-pencil-alt"></i>
                                                            <div class="ld ld-ring ld-spin"></div>
                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-icon btn-danger btn-delete ld-over"
                                                            data-id="{{ $item->id }}"
                                                            data-route="{{ route('delete-product') }}"
                                                            data-route-data="{{ route('product') }}">
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
    <script>
        $(".btn-edit").click(function() {
            _this = $(this);
            _this.addClass('running');
            id = _this.data('id');
            window.location.href = '{{ route('edit-product') }}/' + id;
        })
        $("#add").click(function() {
            toastr.clear()
            let name = $("#product_name").val();
            let description = $("#product_description").val();
            let price = $("#product_price").val();
            let unit = $("#product_unit").val();
            let count = $("#product_count").val();
            if (name == '') {
                toastr.error('Chưa nhập tên sản phẩm!');
            }
            if (name != '') {
                $('#add-form').addClass('running');
                resize.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function(img) {
                    let _token = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: "{{ route('add-product') }}",
                        type: "POST",
                        data: {
                            _token: _token,
                            name: name,
                            description: description,
                            image: img,
                            cost_price: price,
                            unit: unit,
                            count: count
                        },
                        success: function(data) {
                            $('#add-form').removeClass('running');
                            if (data.status == 1) {
                                toastr.clear()
                                toastr.success(data.msg);
                                console.log(data.id)
                                window.location.href = '{{ route('edit-product') }}/' + data
                                    .id;
                            }
                            if (data.status == -1) {
                                toastr.clear()
                                toastr.error(data.msg);
                            }
                            if (data.status == 0) {
                                toastr.clear()
                                let errors = data.errors;
                                $.each(errors, function(index, value) {
                                    toastr.error(value);
                                });
                            }
                        },
                        error: function(data) {
                            $('#add-form').removeClass('running');
                            toastr.clear()
                            toastr.error("Lỗi! Không thể thêm sản phẩm.");
                        }
                    });
                });
            }
        });
        var resize = $('#upload-demo').croppie({
            enableExif: true,
            enableOrientation: true,
            viewport: {
                width: 600,
                height: 600,
                type: 'square' //square
            },
            boundary: {
                width: 650,
                height: 650
            }
        });
        $('#image').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                resize.croppie('bind', {
                    url: e.target.result
                }).then(function() {});
            }
            reader.readAsDataURL(this.files[0]);
        });
    </script>
@endsection
