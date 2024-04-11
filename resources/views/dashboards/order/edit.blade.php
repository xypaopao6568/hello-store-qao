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
                        <li class="breadcrumb-item"><a href="{{ route('product') }}"><i class="fas fa-archive"></i> Sản
                                phẩm</a></li>
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
                    <div class="row">
                        <div class="col-12 text-center">
                            <h4 class="m-1 text-primary">SỬA SẢN PHẨM</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body table-border-style">
                    <form action="" method="post" class="ld-over" id="edit-form">
                        <div class="ld ld-ring ld-spin"></div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group fill">
                                    <label for="name">Tên sản phẩm</label>
                                    <input type="text" name="name" value="{{ $product->name }}" class="form-control"
                                        id="name" aria-describedby="Tên sản phẩm" placeholder="Tên sản phẩm">
                                    <small class="form-text text-muted"></small>
                                </div>
                                <div class="form-group fill">
                                    <label for="cost_price">Giá sản phẩm</label>
                                    <input type="number" name="cost_price" value="{{ $product->cost_price }}"
                                        class="form-control" id="cost_price" aria-describedby="Giá sản phẩm"
                                        placeholder="Giá sản phẩm">
                                    <small class="form-text text-muted">Giá mặc định</small>
                                </div>
                                <div class="form-group fill">
                                    <label for="sale_price">Giá khuyễn mãi</label>
                                    <input type="number" name="sale_price" value="{{ $product->sale_price }}"
                                        class="form-control" id="sale_price" aria-describedby="Giá khuyến mãi"
                                        placeholder="Giá khuyến mãi">
                                    <small class="form-text text-muted">Bỏ trống nếu không dùng</small>
                                </div>
                                <div class="form-group fill">
                                    <label for="unit">Đơn vị tính</label>
                                    <input type="text" name="unit" value="{{ $product->unit }}" class="form-control"
                                        id="unit" aria-describedby="Đơn vị tính" placeholder="Đơn vị tính">
                                    <small class="form-text text-muted"></small>
                                </div>
                                <div class="form-group fill">
                                    <label for="count">Số lượng</label>
                                    <input type="number" name="count" value="{{ $product->count }}" class="form-control"
                                        id="count" aria-describedby="Số lượng" placeholder="Số lượng">
                                    <small class="form-text text-muted"></small>
                                </div>
                                <div class="form-group">
                                    <label for="description">Mô Tả</label>
                                    <textarea class="form-control" id="description" rows="3">{{ $product->description }}</textarea>
                                </div>
                                {{--                                <div class="form-group row"> --}}
                                {{--                                    <label class="col-md-2 col-form-label">Trạng thái</label> --}}
                                {{--                                    <div class="col-md-10"> --}}
                                {{--                                        <div class="mt-2 custom-control custom-radio custom-control-inline"> --}}
                                {{--                                            <input type="radio" id="active" name="status" value="true" class="custom-control-input" {{ $product->status=='1'?'checked':'' }}> --}}
                                {{--                                            <label class="custom-control-label" for="active">Kinh doanh</label> --}}
                                {{--                                        </div> --}}
                                {{--                                        <div class="custom-control ml-2 custom-radio custom-control-inline row"> --}}
                                {{--                                            <input type="radio" id="deactive" name="status" value="false" class="custom-control-input" {{ $product->status=='0'?'checked':'' }}> --}}
                                {{--                                            <label class="custom-control-label" for="deactive">Ngừng kinh doanh</label> --}}
                                {{--                                        </div> --}}
                                {{--                                    </div> --}}
                                {{--                                </div> --}}

                            </div>
                            <div class="col-md-5">
                                <div class="col-12">
                                    <h6 class="text-center"><b>Ảnh Chính</b></h6>
                                </div>
                                <div class="col-12 text-center ld-over" id="image-main">
                                    <div class="ld ld-ring ld-spin"></div>
                                    <div id="image-main-content" class="shadow" style="overflow: hidden; width: 100%;">
                                        <img src="{{ url($product->image) }}" alt="" class="w-100">
                                    </div>
                                    <button type="button" style="margin-top: -20px;"
                                        class="btn btn-icon btn-success btn-edit-image-main ld-over">
                                        <i class="fas fa-pencil-alt"></i>
                                        <div class="ld ld-ring ld-spin"></div>
                                    </button>
                                </div>
                                <div class="col-12 text-center my-2">

                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <label><strong>Danh Mục</strong></label>
                            </div>
                            <div class="col-12">
                                <div class="row m-2">
                                    @foreach ($categories as $item)
                                        <div class="col-md-3 col-6 col-xs-6 icheck-primary d-inline">
                                            <input class="icheck" name="category_id[]" value="{{ $item->id }}"
                                                type="checkbox" id="check-{{ $item->id }}"
                                                {{ in_array($item->id, $product->categories->pluck('category_id')->toArray()) ? 'checked' : '' }}>
                                            <label for="check-{{ $item->id }}"><b>{{ $item->name }}</b></label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label><strong>Thông tin sản phẩm</strong></label>
                                    <textarea class="summernote" id="info" rows="10" name="description">{{ $product->info }}</textarea>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 d-flex align-items-center justify-content-between">
                                <div class="float-left">
                                    <h5><b>Ảnh sản phẩm</b></h5>
                                </div>
                                <div class="float-right">
                                    <div id="add-product" class="modal fade" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalCenterTitle" style="display: none;"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Thêm Sản Phẩm
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body ld-over" id="add-image-form">
                                                    <div class="ld ld-ring ld-spin"></div>
                                                    <form action="" method="post">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group fill">
                                                                    <div class="col-12 text-center">
                                                                        <div id="demo-image-product"></div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="product_description">Hình Ảnh</label>
                                                                        <div class="custom-file">
                                                                            <input type="file"
                                                                                class="custom-file-input"
                                                                                id="upload-image-product"
                                                                                accept="image/*">
                                                                            <label class="custom-file-label"
                                                                                for="image">Choose file...</label>
                                                                            <div class="invalid-feedback"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer d-flex justify-content-center p-2">
                                                    <button type="button" id="add-image"
                                                        class="btn  btn-primary">Thêm</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-icon has-ripple float-right"
                                        data-toggle="modal" data-target="#add-product"><i class="fas fa-plus"></i><span
                                            class="ripple ripple-animate"
                                            style="height: 174.078px; width: 174.078px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(255, 255, 255); opacity: 0.4; top: -66.031px; left: -0.359125px;"></span></button>
                                </div>
                            </div>
                            <div class="col-12 ld-over" id="anh-san-pham">
                                <div class="ld ld-ring ld-spin"></div>
                                <div id="danh-sach-anh-san-pham">
                                    <div class="row my-2">
                                        @foreach ($product->images as $item)
                                            <div class="col-md-2 col-sm-4 col-xs-4 col-6 my-2 text-center">
                                                <img src="{{ url($item->url) }}" alt=""
                                                    class="w-100 border shadow">
                                                <button style="margin-top: -20px;" type="button"
                                                    class="btn btn-icon btn-danger btn-delete-image ld-over"
                                                    data-id="{{ $item->id }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                    <div class="ld ld-ring ld-spin"></div>
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-light bg-primary navbar-bottom d-flex align-items-center">
        <div class="row my-0 d-flex align-items-center">
            <label class="my-0 mx-4">Trạng thái</label>
            <label class="switch my-0">
                <input type="checkbox" name="status" id="status" value="1"
                    {{ $product->status == 1 ? 'checked' : '' }}>
                <span class="slider round"></span>
            </label>
        </div>
        <div class="btn btn-light btn-submit mx-4 ld-over">Lưu<div class="ld ld-ring ld-spin"></div>
        </div>
    </nav>
    <div id="DeleteImage" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModelTitle">Xác Nhận</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0" id="DeleteModalBody">Bạn có chắc chắn muốn xóa ảnh này không?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn  btn-secondary btn-cancel" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn  btn-primary btn-action">Xóa</button>
                </div>
            </div>
        </div>
    </div>
    <div id="EditImageMain" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sửa Ảnh Chính</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body ld-over" id="EditImageMainBody">
                    <div class="ld ld-ring ld-spin"></div>
                    <div class="form-group fill">
                        <div class="col-12 text-center">
                            <div id="demo-image-main"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="product_image">Hình Ảnh</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="edit-image-main" accept="image/*">
                            <label class="custom-file-label" for="image">Choose file...</label>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-around p-2">
                    <button type="button" class="btn  btn-secondary btn-cancel" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary btn-upload-image-main">Lưu</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        //List Image
        let _this = '';
        let id_image = '';

        var resize_add = $('#demo-image-product').croppie({
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
        $('#upload-image-product').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                resize_add.croppie('bind', {
                    url: e.target.result
                }).then(function() {});
            }
            reader.readAsDataURL(this.files[0]);
        });
        $("#add-image").click(function() {
            $('#add-image-form').addClass('running');
            resize_add.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(img) {
                let _token = $('meta[name="csrf-token"]').attr('content');
                let id = {{ $product->id }};
                $.ajax({
                    url: "{{ route('add-image-product') }}",
                    type: "POST",
                    data: {
                        _token: _token,
                        id: id,
                        image: img
                    },
                    success: function(data) {
                        $('#add-image-form').removeClass('running');
                        $("#add-product").modal('hide');
                        if (data == 1) {
                            toastr.clear()
                            toastr.success('Thêm thành công!');
                            $("#anh-san-pham").addClass('running');
                            $.ajax({
                                url: "{{ route('ajax-image-product') }}",
                                type: "POST",
                                data: {
                                    _token: _token,
                                    id: id,
                                },
                                success: function(data) {
                                    $("#anh-san-pham").removeClass('running');
                                    $("#danh-sach-anh-san-pham").html(data);
                                }
                            });
                        } else {
                            toastr.clear()
                            toastr.error('Sửa thất bại!');
                        }
                    }
                });
            });
        })
        $(".btn-delete-image").click(function() {
            _this = $(this);
            _this.addClass('running');
            id_image = _this.data('id');
            $('#DeleteImage').modal('show');
            _this.removeClass('running');
        })
        $(".btn-cancel").click(function() {
            _this.removeClass('running');
        })
        $(".close").click(function() {
            _this.removeClass('running');
        })
        $(".btn-action").click(function() {
            _this.addClass('running');
            $('#DeleteImage').modal('toggle');
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ route('delete-image-product') }}",
                type: "POST",
                data: {
                    _token: _token,
                    id: id_image,
                },
                success: function(data) {
                    $(this).removeClass('running');
                    $("#add-product").modal('hide');
                    if (data == 1) {
                        _this.removeClass('running');
                        toastr.clear()
                        toastr.success('Xóa thành công!');
                        $("#anh-san-pham").addClass('running');
                        let id = {{ $product->id }};
                        $.ajax({
                            url: "{{ route('ajax-image-product') }}",
                            type: "POST",
                            data: {
                                _token: _token,
                                id: id,
                            },
                            success: function(data) {
                                $("#anh-san-pham").removeClass('running');
                                $("#danh-sach-anh-san-pham").html(data);
                            }
                        });
                    } else {
                        _this.removeClass('running');
                        toastr.clear()
                        toastr.error('Xóa thất bại!');
                    }
                },
                error: function() {
                    _this.removeClass('running');
                    toastr.clear()
                    toastr.error('Xóa thất bại!');
                }
            });
        })
        //End List Image

        // Image Main
        $(".btn-edit-image-main").click(function() {
            _thiss = $(this);
            _thiss.addClass('running');
            $('#EditImageMain').modal('show');
            _thiss.removeClass('running');
        });
        $(".btn-upload-image-main").click(function() {
            $("#EditImageMainBody").addClass('running');
            resize_main.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(img) {
                let _token = $('meta[name="csrf-token"]').attr('content');
                let id = {{ $product->id }};
                $.ajax({
                    url: "{{ route('edit-image-product') }}",
                    type: "POST",
                    data: {
                        _token: _token,
                        id: id,
                        image: img
                    },
                    success: function(data) {
                        $("#EditImageMainBody").removeClass('running');
                        _thiss.removeClass('running');
                        $('#EditImageMain').modal('hide');
                        if (data == 1) {
                            toastr.clear()
                            toastr.success('Sửa thành công!');
                            $("#image-main").addClass('running');
                            $.ajax({
                                url: "{{ route('ajax-image-product-main') }}",
                                type: "POST",
                                data: {
                                    _token: _token,
                                    id: id,
                                },
                                success: function(data) {
                                    $("#image-main").removeClass('running');
                                    $("#image-main-content").html(data);
                                }
                            });
                        } else {
                            toastr.clear()
                            toastr.error('Sửa thất bại!');
                            $("#image-main").removeClass('running');
                        }
                    }
                });
            });
        })
        var resize_main = $('#demo-image-main').croppie({
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

        $('#edit-image-main').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                resize_main.croppie('bind', {
                    url: e.target.result
                }).then(function() {});
            }
            reader.readAsDataURL(this.files[0]);
        });

        // End Image Main
        $('.btn-old').on('click', function() {
            resize2.croppie('bind', {
                // url: e.target.result
                url: '{{ url($product->image) }}'
            }).then(function() {});
        });
        $(".btn-submit").click(function(e) {

            var _this = $(this);
            if (_this.hasClass('running')) {
                e.preventDefault();
            } else {
                let id = {{ $product->id }};
                let name = $("#name").val();
                let cost_price = $("#cost_price").val();
                let sale_price = $("#sale_price").val();
                let description = $("#description").val();
                let unit = $("#unit").val();
                let info = $("#info").val();
                let count = $("#count").val();
                let status = 0;
                let categories = [];
                $('input.icheck[name ="category_id[]"]:checkbox:checked').each(function() {
                    categories.push($(this).val());
                });
                if ($('#status').is(':checked')) {
                    status = 1;
                }
                if (name == '') {
                    toastr.error('Chưa nhập tên Sản Phẩm!');
                }
                if (name != '') {
                    _this.addClass('running');
                    setTimeout(() => {
                        console.log("World!");
                    }, 2000);
                    let _token = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: "{{ route('edit-product') }}",
                        type: "POST",
                        data: {
                            _token: _token,
                            id: id,
                            name: name,
                            cost_price: cost_price,
                            sale_price: sale_price,
                            unit: unit,
                            info: info,
                            description: description,
                            status: status,
                            count: count,
                            categories: categories
                        },
                        success: function(data) {
                            _this.removeClass('running');
                            if (data.status == 1) {
                                toastr.clear()
                                toastr.success(data.msg);
                                // location.reload();
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
                            $('#edit-form').removeClass('running');
                            toastr.clear()
                            toastr.error("Lỗi! Không thể thêm sản phẩm.");
                        }
                    });
                }
            }

        });
    </script>
@endsection
