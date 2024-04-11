<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="#"><img src="{{ url('images/logo.png') }}" alt="" style="max-height: 60px"></a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            <li><a href="{{ route('my-wish') }}"><i class="fa fa-heart"></i> <span
                        class="count_wish">{{ isset($wishes) ? count($wishes) : 0 }}</span></a></li>
            <li><a href="{{ route('my-cart') }}"><i class="fa fa-shopping-bag"></i> <span
                        class="count_cart">{{ isset($carts) ? count($carts) : 0 }}</span></a></li>
        </ul>
        <div class="header__cart__price">item: <span class="sum__cart">0</span> {{ trans('page.currency') }}</div>
    </div>
    <div class="humberger__menu__widget">
        {{-- <div class="header__top__right__language">
            <img src="img/language.png" alt="">
            <div>English</div>
            <span class="arrow_carrot-down"></span>
            <ul>
                <li><a href="#">Spanis</a></li>
                <li><a href="#">English</a></li>
            </ul>
        </div> --}}
        <div class="header__top__right__auth">
            @if (Auth::user())
                <div class="col-md-12 p-0">
                    <x-jet-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}
                                        <i class="fa fa-angle-down ml-2"></i>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ trans('page.menu_user') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ trans('page.user_profile') }}
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ route('my-order') }}">
                                {{ trans('page.user_order') }}
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ route('my-address') }}">
                                {{ trans('page.user_address') }}
                            </x-jet-dropdown-link>
                            @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('manager') || Auth::user()->hasRole('staff'))
                                <x-jet-dropdown-link href="{{ route('dashboards') }}">
                                    {{ trans('page.user_dashboads') }}
                                </x-jet-dropdown-link>
                            @endif

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ trans('page.user_logout') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            @else
                <a href="{{ route('login') }}"><i class="fa fa-user"></i> Đăng Nhập</a>
            @endif

        </div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="active"><a href="{{ route('home') }}">Trang Chủ</a></li>
            <li><a href="{{ route('shop') }}">Mua Sắm</a></li>
            <li><a href="{{ route('contact') }}">Liên Hệ</a></li>
        </ul>

    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-pinterest-p"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> hotro@winshop.site</li>
            <li>Free ship cho đơn hàng từ 500.000 đồng</li>
        </ul>
    </div>
</div>
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> hotro@winshop.site</li>
                            <li>Free ship cho đơn hàng từ 500.000 đồng</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="https://www.facebook.com/WinShopsVN"><i class="fa fa-facebook"></i></a>
                            <a href="https://www.instagram.com/winshopsvn"><i class="fa fa-instagram"></i></a>
                            <a href="https://twitter.com/winshopsvn"><i class="fa fa-twitter"></i></a>
                            <a href="https://www.pinterest.com/winshopsvn"><i class="fa fa-pinterest-p"></i></a>
                        </div>
                        {{-- <div class="header__top__right__language">
                            <img src="img/language.png" alt="">
                            <div>English</div>
                            <span class="arrow_carrot-down"></span>
                            <ul>
                                <li><a href="{{ route('change.locale', ['lang' => 'vi']) }}">Tiếng Việt</a></li>
                                <li><a href="{{ route('change.locale', ['lang' => 'en']) }}">English</a></li>
                            </ul>
                        </div> --}}
                        <div class="header__top__right__auth">
                            @if (Auth::user())
                                <div class="ml-3 relative">
                                    <x-jet-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                <button class="">
                                                    <img class="h-8 w-8 rounded-full object-cover"
                                                        src="{{ Auth::user()->profile_photo_url }}"
                                                        alt="{{ Auth::user()->name }}" />
                                                </button>
                                            @else
                                                <span class="inline-flex rounded-md">
                                                    <button type="button"
                                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                        <i class="fa fa-user mr-1"></i>{{ Auth::user()->name }}
                                                        <i class="fa fa-angle-down ml-2"></i>
                                                    </button>
                                                </span>
                                            @endif
                                        </x-slot>

                                        <x-slot name="content">
                                            <!-- Account Management -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ trans('page.menu_user') }}
                                            </div>

                                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                                {{ trans('page.user_profile') }}
                                            </x-jet-dropdown-link>
                                            <x-jet-dropdown-link href="{{ route('my-order') }}">
                                                {{ trans('page.user_order') }}
                                            </x-jet-dropdown-link>
                                            <x-jet-dropdown-link href="{{ route('my-address') }}">
                                                {{ trans('page.user_address') }}
                                            </x-jet-dropdown-link>
                                            @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('manager') || Auth::user()->hasRole('staff'))
                                                <x-jet-dropdown-link href="{{ route('dashboards') }}">
                                                    {{ trans('page.user_dashboads') }}
                                                </x-jet-dropdown-link>
                                            @endif

                                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                                    {{ __('API Tokens') }}
                                                </x-jet-dropdown-link>
                                            @endif

                                            <div class="border-t border-gray-100"></div>

                                            <!-- Authentication -->
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf

                                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                    {{ trans('page.user_logout') }}
                                                </x-jet-dropdown-link>
                                            </form>
                                        </x-slot>
                                    </x-jet-dropdown>
                                </div>
                            @else
                                <span class="inline-flex rounded-md">
                                    <a href="{{ route('login') }}" type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <i class="fa fa-user mr-1"></i>Đăng Nhập
                                    </a>
                                </span>
                                <a href="{{ route('login') }}">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="main-menu">
        <div class="container header__conten">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="{{ route('home') }}"><img src="{{ url('images/logo.png') }}" alt=""
                                style="max-height: 60px"></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="{{ route('home') }}">Trang Chủ</a></li>
                            <li><a href="{{ route('shop') }}">Mua Sắm</a></li>
                            <li><a href="{{ route('contact') }}">Liên Hệ</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="javascript:void(0)" class="my-wish"><i class="fa fa-heart"></i> <span
                                        class="count_wish">{{ Auth::user()? Auth::user()->wish()->count(): 0 }}</span></a>
                            </li>
                            <li><a href="javascript:void(0)" class="my-cart"><i class="fa fa-shopping-bag"></i> <span
                                        class="count_cart">{{ Auth::user()? Auth::user()->cart()->sum('quantity'): 0 }}</span></a>
                            </li>
                        </ul>
                        <div class="header__cart__price">Tổng: <span class="sum__cart">0</span>
                            {{ trans('page.currency') }}</div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </div>
</header>
<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Danh Mục</span>
                    </div>
                    <ul>
                        @foreach (\App\Models\Categories::all() as $item)
                            <li>
                                <a href="{{ url('category/' . $item->slug) }}">{{ $item->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="{{ route('search') }}" method="get">
                            @csrf
                            <div class="hero__search__categories" style="padding: 0;">
                                <select name="search_key" id="address-select" class="form-control w-100 border-0"
                                    style="height: 48px;">
                                    <span class="arrow_carrot-down"></span>
                                    <option value="all" selected>{{ trans('page.search_all') }}</option>
                                    <option value="pro">{{ trans('page.search_product') }}</option>
                                    <option value="cat">{{ trans('page.search_category') }}</option>
                                </select>
                            </div>
                            <input type="text" placeholder="{{ trans('page.what_you_need') }}" name="query">
                            <button type="submit" class="site-btn">{{ trans('page.search') }}</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+84389898989</h5>
                            <span>Hỗ trợ 24/7</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
