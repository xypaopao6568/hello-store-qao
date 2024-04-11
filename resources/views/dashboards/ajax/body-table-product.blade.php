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
                                id="delete-all"
                                data-route="{{ route('delete-products') }}"
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
                                    <input class="icheck ichecks" name="id[]" value="{{ $item->id }}" type="checkbox" id="check-{{ $item->id }}">
                                    <label for="check-{{ $item->id }}"><b>{{ $item->id }}</b></label>
                                </div>
                            </td>
                            <td style="white-space: normal; max-width: 300px;">
                                <b>{{ $item->name }}</b>
                            </td>
                            <td>
                                <img class="shadow" src="{{ url($item->image) }}" alt="" width="80px" height="80px">
                            </td>
                            <td style="white-space: normal;">
                                <ul class="mb-0 pl-2">
                                    <li>
                                        Link: <b><a target="_blank" href="{{ url('product/'.$item->slug) }}">{{ url('product/'.$item->slug) }}</a></b>
                                    </li>
                                    <li>
                                        Giá bán: <b>{{ number_format($item->cost_price) }}</b>
                                    </li>
                                    <li>
                                        Giá khuyến mãi: <b>{{ number_format($item->sale_price) }}</b>
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
                                        <b class="text-primary">{{ $items->category->name }}</b>,
                                    @endforeach
                                    </li>
                                    <li>
                                        Mô tả: <b>{{ $item->description }}</b>
                                    </li>
                                </ul>
                            </td>
                            <td>
                                @if ($item->status==1)
                                    <button type="button" class="btn-change btn btn-success has-ripple ld-over" data-id="{{ $item->id }}" data-status="1" data-route="{{ route('change-product') }}">
                                        <div class="ld ld-ring ld-spin"></div>
                                        <b><i class="feather mr-2 icon-check-circle"></i>Hoạt động</b>
                                        <span class="ripple ripple-animate" style="height: 112.828px; width: 112.828px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(255, 255, 255); opacity: 0.4; top: -26.781px; left: 12.6565px;"></span>
                                    </button>
                                @else
                                    <button type="button" class="btn-change btn btn-secondary has-ripple ld-over" data-id="{{ $item->id }}" data-status="0" data-route="{{ route('change-product') }}">
                                        <div class="ld ld-ring ld-spin"></div>
                                        <b><i class="feather mr-2 icon-slash"></i>Ngưng hoạt động</b>
                                        <span class="ripple ripple-animate" style="height: 112.828px; width: 112.828px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(255, 255, 255); opacity: 0.4; top: -26.781px; left: 12.6565px;"></span>
                                    </button>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-icon btn-primary btn-view ld-over" data-id="{{ $item->id }}">
                                    <i class="fas fa-eye"></i>
                                    <div class="ld ld-ring ld-spin"></div>
                                </button>
                                <button type="button" class="btn btn-icon btn-success btn-edit ld-over" data-id="{{ $item->id }}">
                                    <i class="fas fa-pencil-alt"></i>
                                    <div class="ld ld-ring ld-spin"></div>
                                </button>
                                <button type="button" class="btn btn-icon btn-danger btn-delete ld-over" data-id="{{ $item->id }}" data-route="{{ route('delete-product') }}" data-route-data="{{ route('product') }}">
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
<script>
    $(".btn-change").click(function(){
        _this = $(this);
        id = _this.data('id');
        status = _this.data('status');
        if(status==0){
            status = 1;
        }else{
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
            success: function (data) {
                if(data == '1'){
                    toastr.clear();
                    toastr.success('Thay đổi thành công!');
                    _this.removeClass('running');
                    _this.data('status', status);
                    if(status==1){
                        _this.addClass("btn-success");
                        _this.removeClass("btn-secondary");
                        _this.find('b').html('<i class="feather mr-2 icon-check-circle"></i>Hoạt động');
                    }else{
                        _this.addClass("btn-secondary");
                        _this.removeClass("btn-success");
                        _this.find('b').html('<i class="feather mr-2 icon-slash"></i>Ngưng hoạt động');
                    }
                }
                else{
                    _this.removeClass('running');
                    toastr.clear();
                    toastr.error('Thay đổi thất bại!');
                }
            },
            error: function(){
                toastr.clear();
                toastr.error('Thay đổi gặp lỗi!');
            }
        });

    })
    $(".btn-edit").click(function(){
        _this = $(this);
        _this.addClass('running');
        id = _this.data('id');
        window.location.href = '{{ route("edit-product") }}/'+id;
    })
    $(".btn-delete").click(function(){
        let id = $(this).data('id');
        let route = $(this).data('route');
        let route_data = $(this).data('route_data');
        Swal.fire({
            title: '',
            text: 'Xác nhận xoá?',
            icon: 'question',
            showCancelButton: true,
            showConfirmButton: true,
            cancelButtonText: "Huỷ",
            confirmButtonText: "Xoá",
            focusConfirm: false,
            preConfirm: () => {
                $.ajax({
                    url: route,
                    type: "POST",
                    data: {
                        _token: _token,
                        id: id,
                    },
                    success: function (data) {
                        if(data == '1'){
                            toastr.clear();
                            toastr.success('Xóa thành công!');
                            $("#table-body").addClass('running');
                            $.ajax({
                                url: route_data,
                                type: "GET",
                                data: {
                                    ajax: true,
                                    page: {{ request()->get('page')?request()->get('page'):1 }},
                                },
                                success: function (data) {
                                    $("#table-body").removeClass('running');
                                    $("#table-content").html(data);
                                }
                            });
                        }
                        else{
                            toastr.clear();
                            toastr.error('Xóa gặp lỗi!');
                        }
                    },
                    error: function(){
                        toastr.clear();
                        toastr.error('Xóa gặp lỗi!');
                    }
                });
            }
        })
    })
    check = false;
    $("#select-all").on('click', function(){
        $(".icheck").prop('checked', !check);
        check = !check;
    });
    $("#check-all").on('click', function(){
        if($("#check-all:checked").length==1){
            $(".ichecks").prop('checked', true);
        }else{
            $(".ichecks").prop('checked', false);
        }
    });
    $(".ichecks").on('click', function(){
        $("#check-all").prop('checked', false);
        let check = true;
        let cb = $(".ichecks").length;
        let cbc = $(".ichecks:checked").length;
        if(cb==cbc){
            $("#check-all").prop('checked', true);
        }
    });
    $("#delete-all").click(function(){
        let id = [];
        let route = $(this).data('route');
        let route_data = $(this).data('route-data');
        $('input.icheck[name ="id[]"]:checkbox:checked').each(function() {
            id.push($(this).val());
        });
        if(id.length>0){
            Swal.fire({
                title: '',
                text: 'Xác nhận xoá mục đã chọn?',
                icon: 'question',
                showCancelButton: true,
                showConfirmButton: true,
                cancelButtonText: "Huỷ",
                confirmButtonText: "Xoá",
                focusConfirm: false,
                preConfirm: () => {
                    $.ajax({
                        url: route,
                        type: "POST",
                        data: {
                            _token: _token,
                            ids: id,
                        },
                        success: function (data) {
                            if(data == '1'){
                                check = !check;
                                toastr.clear();
                                toastr.success('Xóa thành công!');
                                $("#table-body").addClass('running');
                                $.ajax({
                                    url: route_data,
                                    type: "GET",
                                    data: {
                                        ajax: true,
                                        page: {{ request()->get('page')?request()->get('page'):1 }},
                                    },
                                    success: function (data) {
                                        $("#table-body").removeClass('running');
                                        $("#table-content").html(data);
                                    }
                                });
                            }
                            else{
                                toastr.clear();
                                toastr.error('Xóa gặp lỗi!');
                            }
                        },
                        error: function(){
                            toastr.clear();
                            toastr.error('Xóa gặp lỗi!');
                        }
                    });
                }
            })
        }else{
            toastr.clear();
            toastr.error('Không có mục nào được chọn!');
        }

    })
</script>
