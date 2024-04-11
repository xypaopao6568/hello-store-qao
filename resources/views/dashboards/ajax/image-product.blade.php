<div class="row my-2">
    @foreach ($product->images as $item)
    <div class="col-md-2 col-sm-4 col-xs-4 col-6 my-2 text-center">
        <img src="{{ url($item->url) }}" alt="" class="w-100 border shadow">
        <button style="margin-top: -20px;" type="button" class="btn btn-icon btn-danger btn-delete-image ld-over" data-id="{{ $item->id }}">
            <i class="fas fa-trash-alt"></i>
            <div class="ld ld-ring ld-spin"></div>
        </button>
    </div>
    @endforeach
</div>
<script>
    $(".btn-delete-image").click(function(){
        _this = $(this);
        _this.addClass('running');
        id_image = _this.data('id');
        $('#DeleteImage').modal('show');
        _this.removeClass('running');
    })
</script>
