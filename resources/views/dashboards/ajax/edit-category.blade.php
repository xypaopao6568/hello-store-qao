<form action="" method="post" class="ld-over" id="edit-form">
    <div class="ld ld-ring ld-spin"></div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group fill">
                <label for="category_name_edit">Tên Danh Mục</label>
                <input type="text" name="name" value="{{ $category->name }}" class="form-control" id="category_name_edit" aria-describedby="Tên danh mục" placeholder="Tên danh mục">
                <small id="category_name_edit" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="category_description_edit">Mô Tả</label>
                <textarea class="form-control" id="category_description_edit" rows="3">{{ $category->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="category_image">Hình Ảnh</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image-edit" accept="image/*">
                    <label class="custom-file-label" for="image">Choose file...</label>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="btn btn-info my-2 btn-old">Dùng ảnh cũ</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group fill">
                <div class="col-12 text-center">
                    <div id="upload-edit"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <div class="btn btn-primary btn-submit">Sửa</div>
        </div>
    </div>
</form>
<script>
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

    resize2.croppie('bind',{
        // url: e.target.result
        url: '{{ url($category->image) }}'
    }).then(function(){});

    $('#image-edit').on('change', function () {
        var reader = new FileReader();
            reader.onload = function (e) {
            resize2.croppie('bind',{
                url: e.target.result
            }).then(function(){});
        }
        reader.readAsDataURL(this.files[0]);
    });
    $('.btn-old').on('click', function () {
        resize2.croppie('bind',{
            // url: e.target.result
            url: '{{ url($category->image) }}'
        }).then(function(){});
    });
    $(".btn-submit").click(function(){
        let id = {{ $category->id }};
        let name = $("#category_name_edit").val();
        let description = $("#category_description_edit").val();
        if(name==''){
            toastr.error('Chưa nhập tên danh mục!');
        }
        if(name!=''){
            $('#edit-form').addClass('running');
            resize2.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (img) {
                let _token   = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{route('edit-category')}}",
                    type: "POST",
                    data: {
                        _token: _token,
                        id: id,
                        name: name,
                        description: description,
                        image:img
                    },
                    success: function (data) {
                        $('#edit-form').removeClass('running');
                        if(data.status==1){
                            toastr.clear()
                            toastr.success(data.msg);
                            location.reload();
                        }
                        if(data.status==-1){
                            toastr.clear()
                            toastr.error(data.msg);
                        }
                        if(data.status==0){
                            toastr.clear()
                            let errors = data.errors;
                            $.each(errors, function(index, value) {
                                toastr.error(value);
                            });
                        }
                    },
                    error: function (data) {
                        $('#edit-form').removeClass('running');
                        toastr.clear()
                        toastr.error("Lỗi! Không thể sửas danh mục.");
                    }
                });
            });
        }
    });
</script>
