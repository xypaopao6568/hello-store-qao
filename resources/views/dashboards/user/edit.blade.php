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
                        <li class="breadcrumb-item"><a href="{{ route('product') }}"><i class="fas fa-archive"></i> User</a>
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
                    <div class="row">
                        <div class="col-12 text-center">
                            <h4 class="m-1 text-primary">SỬA USER</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body table-border-style">
                    <form action="{{ route('update-user', ['id' => $user->id]) }}" method="post" class="ld-over"
                        id="edit-form">
                        @csrf
                        <div class="ld ld-ring ld-spin"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group fill">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" value="{{ $user->name }}" class="form-control"
                                        id="name" aria-describedby="Tên sản phẩm" placeholder="Tên user">
                                    <small class="form-text text-muted"></small>
                                </div>
                                <div class="form-group fill">
                                    <label for="cost_price">Email</label>
                                    <input type="email" name="email" value="{{ $user->email }}" class="form-control"
                                        id="email" aria-describedby="Giá sản phẩm" placeholder="Nhập email">
                                    <small class="form-text text-muted">Giá mặc định</small>
                                </div>
                                <div class="form-group fill">
                                    <label for="sale_price">Password</label>
                                    <input type="text" name="password" value="{{ $user->password }}" class="form-control"
                                        id="password" aria-describedby="Giá khuyến mãi" placeholder="Password">
                                </div>
                                <div class="form-group fill">
                                    <label for="product_price">Role</label>
                                    <select name="role" id="role" class="col-md-6">
                                        @foreach ($role as $item)
                                            <option value="{{ $item->name }}">{{ $item->name }}
                                            </option>
                                        @endforeach
                                        <small class="form-text text-muted"></small>
                                    </select>
                                </div>

                            </div>

                        </div>
                        <hr>
                        <nav class="navbar navbar-light bg-primary navbar-bottom d-flex align-items-center">
                            <div class="row my-0 d-flex align-items-center">
                                <label class="my-0 mx-4">Trạng thái</label>
                                <label class="switch my-0">
                                    <input type="checkbox" name="status" id="status" value="1"
                                        {{ $user->status == 1 ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <button class="btn btn-light btn-submit mx-4 ld-over" type="submit">Lưu<div
                                    class="ld ld-ring ld-spin"></div>
                            </button>
                        </nav>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('script')

@endsection
