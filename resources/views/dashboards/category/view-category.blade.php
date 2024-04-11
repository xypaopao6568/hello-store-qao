@extends('dashboards.layouts.app')
@section('title', 'Dashboard')
@section('content')
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
                                data-route="{{ route('delete-products') }}" data-route-data="{{ route('product') }}">
                                <i class="fas fa-trash-alt"></i>
                                <div class="ld ld-ring ld-spin"></div>
                            </button>
                        </th>
                        <th>Tên Danh Mục</th>
                        <th>Hình Ảnh</th>
                        <th>Chi Tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($category))
                        <tr>
                            <td>
                                <div class="icheck-primary d-inline">
                                    <input class="icheck ichecks" name="id[]" value="{{ $category->id }}" type="checkbox"
                                        id="check-{{ $category->id }}">
                                    <label for="check-{{ $category->id }}"><b>{{ $category->id }}</b></label>
                                </div>
                            </td>
                            <td style="white-space: normal; max-width: 300px;">
                                <b>{{ $category->name }}</b>
                            </td>
                            <td>
                                <img class="shadow" src="{{ url($category->image) }}" alt="" width="80px"
                                    height="80px">
                            </td>
                            <td style="white-space: normal;">
                                <ul class="mb-0 pl-2">
                                    <li>
                                        Link: <b><a target="_blank"
                                                href="{{ url('category/' . $category->slug) }}">{{ url('category/' . $category->slug) }}</a></b>
                                    </li>
                                    <li>
                                        Đơn vị tính: <b>{{ $category->name_en }}</b>
                                    </li>


                                    <li>
                                        Mô tả: <b>{{ $category->description }}</b>
                                    </li>
                                </ul>
                            </td>

                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="modal-footer d-flex justify-content-center p-2">
            <a href="{{ route('category') }}" class="btn  btn-primary">Qoay lại trang chủ</a>
        </div>
    </div>

@endsection
@section('script')
    <script>
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
        $("#btn_update").on("change", function() {
            let file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $("#demo-image").attr("src", e.target.result);
                    $("#demo-image").show();
                }
                reader.readAsDataURL(file);
            } else {
                $("#demo-image").hide();
            }
        });
        // $('#upload-image-product').on('change', function() {
        //     var reader = new FileReader();
        //     reader.onload = function(e) {
        //         resize_add.croppie('bind', {
        //             url: e.target.result
        //         }).then(function() {});
        //     }
        //     reader.readAsDataURL(this.files[0]);
        // });
        // $(".btn-delete-image").click(function() {
        //     _this = $(this);
        //     _this.addClass('running');
        //     id_image = _this.data('id');
        //     $('#DeleteImage').modal('show');
        //     _this.removeClass('running');
        // })
        // $(".btn-cancel").click(function() {
        //     _this.removeClass('running');
        // })
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
                        let id = {{ $category->id }};
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
                url: '{{ url($category->image) }}'
            }).then(function() {});
        });
    </script>
@endsection
