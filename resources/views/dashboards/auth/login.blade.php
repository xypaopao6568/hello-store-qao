<!DOCTYPE html>
<html lang="en">

<head>

    <title>Đăng Nhập</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
    <link rel="icon" href="{{ url('lg.png') }}" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="{{ url('admin/css/style.css') }}">
</head>

<div class="auth-wrapper">
    <div class="auth-content">
        <div class="card">
            <div class="row align-items-center text-center">
                <div class="col-md-12">
                    <div class="card-body">
                        <form action="{{ route('dashboards-login') }}" method="post">
                            @csrf
                            <img src="{{ url('logo.png') }}" alt="" class="img-fluid mb-4">
                            <h4 class="mb-3 f-w-400">Đăng Nhập</h4>
                            @if ($errors->all())
                                <div class="col-md-12 mb-2">
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-sm alert-danger" role="alert">
                                            {{ $error }}
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <div class="form-group mb-3">
                                <label class="floating-label" for="Email">Email address</label>
                                <input type="text" name="email" value="{{ old('email') }}" class="form-control"
                                    id="Email" placeholder="">
                            </div>
                            <div class="form-group mb-4">
                                <label class="floating-label" for="Password">Password</label>
                                <input type="password" name="password" value="{{ old('password') }}"
                                    class="form-control" id="Password" placeholder="">
                            </div>
                            <div class="custom-control custom-checkbox text-left mb-4 mt-2">
                                <input type="checkbox" name="remember" value="{{ old('remember') }}"
                                    class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Ghi nhớ đăng nhập.</label>
                            </div>
                            <button class="btn btn-block btn-primary mb-4" type="submit">Đăng Nhập</button>
                            <p class="mb-2 text-muted">Quên mật khẩu? <a href="auth-reset-password.html"
                                    class="f-w-400">Đặt lại</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ url('admin/js/vendor-all.min.js') }}"></script>
<script src="{{ url('admin/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ url('admin/js/ripple.js') }}"></script>
<script src="{{ url('admin/js/pcoded.min.js') }}"></script>
</body>

</html>
