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
                        <li class="breadcrumb-item"><a href="{{ route('product') }}"><i class="fas fa-archive"></i> Slide
                            </a></li>
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
                            <h4 class="m-1 text-primary">UPDATE SLIDE</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body table-border-style">
                    <form action="{{ route('update-sliders', ['id' => $slider->id]) }}" method="post" class="ld-over"
                        id="edit-form" enctype="multipart/form-data">
                        @csrf
                        <div class="ld ld-ring ld-spin"></div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group fill">
                                    <label for="title">Tiêu đề</label>
                                    <input type="text" id="title" name="title" value="{{ $slider->title }}"
                                        class="form-control" aria-describedby="Tên sản phẩm" placeholder="Tên sản phẩm">
                                    <small class="form-text text-muted"></small>
                                </div>
                                <div class="form-group fill">
                                    <label for="sub_title">Tiêu đề con</label>
                                    <input type="text" id="sub_title" name="sub_title" value="{{ $slider->sub_title }}"
                                        class="form-control" aria-describedby="Tên sản phẩm" placeholder="Tên sản phẩm">
                                    <small class="form-text text-muted"></small>
                                </div>
                                <div class="form-group fill">
                                    <label for="category_id">Tên danh mục</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        @if ($category)
                                            @foreach ($category as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == $slider->category_id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group fill">
                                    <label for="link">Link</label>
                                    <input type="text" id="link" name="link" value="{{ $slider->link }}"
                                        class="form-control" aria-describedby="Tên sản phẩm" placeholder="Tên sản phẩm">
                                    <small class="form-text text-muted"></small>
                                </div>

                            </div>
                            <div class="col-md-5">
                                <div class="col-12">
                                    <h6 class="text-center"><b>Ảnh Chính</b></h6>
                                </div>
                                <div class="col-12 text-center ld-over" id="image-main">
                                    <div class="ld ld-ring ld-spin"></div>
                                    <div id="image-main-content" class="shadow" style="overflow: hidden; width: 100%;">
                                        <img src="{{ url($slider->image) }}" alt="" class="w-100" id="demo-image">
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
                        <div class="modal-footer d-flex justify-content-center p-2">
                            <button type="submit" class="btn btn-primary btn-submit">Update</button>
                        </div>
                    </form>
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
                            {{-- <div id="demo-image-main"></div> --}}
                            <img src="" alt="" id="demo-image-main">
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
                    <button type="button" class="btn btn-primary btn-upload-image-main" id="btn_update">Lưu</button>
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
                let id = {{ $slider->id }};
                $.ajax({
                    url: "{{ route('edit_image_slide') }}",
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
                                url: "{{ route('ajax_image_slider_main') }}",
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
                url: '{{ url($slider->image) }}'
            }).then(function() {});
        });
    </script>
@endsection
