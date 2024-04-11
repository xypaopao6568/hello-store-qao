<nav class="pcoded-navbar menu-light ">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div ">

            <div class="">
                <div class="main-menu-header" id="more-details" style="cursor: pointer;">
                    <img class="img-radius"
                        src="{{ url(Auth::user()->profile_photo_path ? Auth::user()->profile_photo_path : 'admin/images/user/avatar.jpg') }}"
                        alt="{{ Auth::user()->name }}">
                    <div class="user-details">
                        <div>{{ Auth::user()->name }} <i class="fa fa-caret-down"></i></div>
                    </div>
                </div>
                <div class="collapse" id="nav-user-link">
                    <ul class="nav pcoded-inner-navbar ">
                        <li class="nav-item">
                            <a href="index.html" class="nav-link "><span class="pcoded-micon"><i
                                        class="feather icon-user m-r-5"></i></span><span class="pcoded-mtext">Thông Tin
                                    Tài Khoản</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="index.html" class="nav-link "><span class="pcoded-micon"><i
                                        class="feather icon-settings m-r-5"></i></span><span class="pcoded-mtext">Cài
                                    Đặt</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboards-logout') }}" class="nav-link "><span class="pcoded-micon"><i
                                        class="feather icon-log-out m-r-5"></i></span><span class="pcoded-mtext">Đăng
                                    Xuất</span></a>
                        </li>
                    </ul>
                </div>
            </div>

            <ul class="nav pcoded-inner-navbar ">

                <li class="nav-item">
                    <a href="{{ route('dashboards') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="fas fa-tachometer-alt"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>SHOP</label>
                </li>
                
                    <li class="nav-item">
                        <a href="{{ route('slide') }}" class="nav-link "><span class="pcoded-micon"><i
                                    class="fas fa-sliders-h"></i></span><span class="pcoded-mtext">Slide</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('category') }}" class="nav-link "><span class="pcoded-micon">
                            <i class="fas fa-list-ul"></i></span><span class="pcoded-mtext">Danh Mục</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('product') }}" class="nav-link "><span class="pcoded-micon"><i
                                    class="fas fa-archive"></i></span><span class="pcoded-mtext">Sản Phẩm</span></a>
                    </li>
                
                <li class="nav-item">
                    <a href="{{ route('order') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="fas fa-file-invoice"></i></span><span class="pcoded-mtext">Đơn Hàng</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="fas fa-users"></i></span><span class="pcoded-mtext">Người Dùng</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('payment') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="fas fa-credit-card"></i></span><span class="pcoded-mtext">Thanh Toán</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('config') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="fas fa-cogs"></i></span><span class="pcoded-mtext">Cài Đặt</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
