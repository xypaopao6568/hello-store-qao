<div class="row my-2">
    <div class="col-4">Tên Danh Mục:</div>
    <div class="col-8"><b>{{ $product->name }}</b></div>
</div>
<div class="row my-2">
    <div class="col-4">Mô Tả:</div>
    <div class="col-8"><b>{{ $product->description }}</b></div>
</div>
{{-- <div class="row my-2">
    <div class="col-4">Link:</div>
    <div class="col-8"><b><a target="_blank"
                href="{{ url('category/' . $category->slug) }}">{{ url('category/' . $category->slug) }}</a></b></div>
</div> --}}
<div class="row my-2 d-flex align-items-center">
    <div class="col-4">Ảnh:</div>
    <div class="col-8"><img src="{{ url($product->image) }}" alt="" width="150px" height="150px"></div>
</div>
