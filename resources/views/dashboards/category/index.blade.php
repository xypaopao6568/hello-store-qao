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
                                <h4 class="m-1 text-primary">DANH SÁCH DANH MỤC</h4>
                            </b>
                            <div id="add-category" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Thêm Danh Mục</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>
                                        <div class="modal-body ld-over" id="add-form">
                                            <div class="ld ld-ring ld-spin"></div>
                                            <form action="" method="post">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group fill">
                                                            <label for="category_name">Tên Danh Mục</label>
                                                            <input type="text" name="name" class="form-control"
                                                                id="category_name" aria-describedby="Tên danh mục"
                                                                placeholder="Tên danh mục">
                                                            <small id="category_name" class="form-text text-muted"></small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="category_description">Mô Tả</label>
                                                            <textarea class="form-control" id="category_description" rows="3"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="category_description">Mô Tả</label>
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
                                data-target="#add-category"><i class="fas fa-plus"></i><span class="ripple ripple-animate"
                                    style="height: 174.078px; width: 174.078px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(255, 255, 255); opacity: 0.4; top: -66.031px; left: -0.359125px;"></span></button>
                        </div>
                    </div>
                    <div class="row d-flex flex-direction-row p-1">
                        <div class="col-md-12 col-12">
                            <div class="d-md-flex flex-direction-row justify-content-end w-100">
                                <div class="mx-md-2 col-xs-12">
                                    <div class="d-flex flex-row align-items-center">
                                        <b style="min-width: 100px; white-space: nowrap;">Sắp Xếp Theo</b>
                                        <select name="sort" id="sort" data-type="category"
                                            data-content="table-content" data-route-data="{{ route('category') }}"
                                            class="sort form-control">
                                            {{-- <option value=""></option> --}}
                                            <option value="id" data-sort="asc"
                                                {{ Session::has('sort-category') && Session::get('sort-category') == 'id' && Session::get('sort-categories') == 'asc' ? 'selected' : '' }}>
                                                ID nhỏ -> lớn</option>
                                            <option value="id" data-sort="desc"
                                                {{ Session::has('sort-category') && Session::get('sort-category') == 'id' && Session::get('sort-categories') == 'desc' ? 'selected' : '' }}>
                                                ID lớn -> nhỏ</option>
                                            <option value="name" data-sort="asc"
                                                {{ Session::has('sort-category') && Session::get('sort-category') == 'name' && Session::get('sort-categories') == 'asc' ? 'selected' : '' }}>
                                                Tên A-Z</option>
                                            <option value="name" data-sort="desc"
                                                {{ Session::has('sort-category') && Session::get('sort-category') == 'name' && Session::get('sort-categories') == 'desc' ? 'selected' : '' }}>
                                                Tên Z-A</option>
                                            <option value="created_at" data-sort="asc"
                                                {{ Session::has('sort-category') && Session::get('sort-category') == 'created_at' && Session::get('sort-categories') == 'asc' ? 'selected' : '' }}>
                                                Cũ nhất</option>
                                            <option value="created_at" data-sort="desc"
                                                {{ Session::has('sort-category') && Session::get('sort-category') == 'created_at' && Session::get('sort-categories') == 'desc' ? 'selected' : '' }}>
                                                Mới nhất</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mx-md-2 col-xs-12">
                                    <div class="d-flex flex-row align-items-center">
                                        <b style="min-width: 100px; white-space: nowrap;">Số Dòng</b>
                                        <select name="limit" id="limit" data-route-data="{{ route('category') }}"
                                            class="limit form-control">
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
                                            data-route="{{ route('search-category') }}">
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
                                                    id="delete-all" data-route="{{ route('delete-categories') }}"
                                                    data-route-data="{{ route('category') }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                    <div class="ld ld-ring ld-spin"></div>
                                                </button>
                                            </th>
                                            <th>Tên Danh Mục</th>
                                            <th>Hình Ảnh</th>
                                            <th>Chi Tiết</th>
                                            <th>Trạng Thái</th>
                                            <th>Thao Tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($lists))
                                            @foreach ($lists as $item)
                                                <tr class="view-list">
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
                                                                Link: <a target="_blank"
                                                                    href="{{ url('category/' . $item->slug) }}">{{ url('category/' . $item->slug) }}</a>
                                                            </li>
                                                            <li>
                                                                Số lượng sản phẩm:
                                                                <b>{{ $item->products()->count('id') }}</b>
                                                                <a
                                                                    href="{{ route('view-category-products', ['id' => $item->id]) }}">Xem</a>
                                                            </li>
                                                            <li>
                                                                Mô tả: {{ $item->description }}
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        @if ($item->status == 1)
                                                            <button type="button"
                                                                class="btn-change btn btn-success has-ripple ld-over"
                                                                data-id="{{ $item->id }}" data-status="1"
                                                                data-route="{{ route('change-category') }}">
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
                                                                data-route="{{ route('change-category') }}">
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
                                                            class="btn btn-icon btn-success btn-view ld-over"
                                                            data-id="{{ $item->id }}"
                                                            data-route="{{ route('view-category') }}"
                                                            data-route-data="{{ route('category') }}">
                                                            <i class="fas fa-eye"></i>
                                                            <div class="ld ld-ring ld-spin"></div>
                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-icon btn-success btn-edit ld-over"
                                                            data-id="{{ $item->id }}"
                                                            data-route="{{ route('edit-category') }}"
                                                            data-route-data="{{ route('category') }}">
                                                            <i class="fas fa-pencil-alt"></i>
                                                            <div class="ld ld-ring ld-spin"></div>
                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-icon btn-danger btn-delete ld-over"
                                                            data-id="{{ $item->id }}"
                                                            data-route="{{ route('delete-category') }}"
                                                            data-route-data="{{ route('category') }}">
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
    <div id="EditModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModelTitle">Thông Tin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="EditModalBody">

                </div>
                <div class="modal-footer d-flex justify-content-center p-2">
                    <button type="button" class="btn btn-secondary btn-cancel" data-dismiss="modal">Đóng</button>
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
            window.location.href = '{{ route('edit-category') }}/' + id;
        })
        $(".btn-view").click(function() {
            _this = $(this);
            _this.addClass('running');
            id = _this.data('id');
            window.location.href = '{{ route('view-category') }}/' + id;
        })
        $("#add").click(function() {
            toastr.clear()
            let name = $("#category_name").val();
            let description = $("#category_description").val();
            if (name == '') {
                toastr.error('Chưa nhập tên danh mục!');
            }
            if (name != '') {
                $('#add-form').addClass('running');
                resize.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function(img) {
                    let _token = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: "{{ route('add-category') }}",
                        type: "POST",
                        data: {
                            _token: _token,
                            name: name,
                            description: description,
                            image: img
                        },
                        success: function(data) {
                            $('#add-form').removeClass('running');
                            if (data.status == 1) {
                                toastr.clear()
                                toastr.success(data.msg);
                                $("#add-category").modal('hide');
                                $("#table-body").addClass('running');
                                $.ajax({
                                    url: '{{ route('category') }}',
                                    type: "GET",
                                    data: {
                                        ajax: true,
                                        page: {{ request()->get('page') ? request()->get('page') : 1 }},
                                    },
                                    success: function(data) {
                                        $("#table-body").removeClass('running');
                                        $("#table-content").html(data);
                                    }
                                });
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
                            toastr.error("Lỗi! Không thể thêm danh mục.");
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
        var resize2 = $('#upload-edit').croppie({
            enableExif: true,
            enableOrientation: true,
            viewport: {
                width: 300,
                height: 300,
                type: 'square' //square
            },
            boundary: {
                width: 350,
                height: 350
            }
        });
        $('#image-edit').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                resize2.croppie('bind', {
                    url: e.target.result
                }).then(function() {});
            }
            reader.readAsDataURL(this.files[0]);
        });
    </script>
@endsection
