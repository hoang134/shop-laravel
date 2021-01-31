<header class="header-area">

    <!-- Top Header Area -->
    <div class="top-header-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="top-header-content d-flex align-items-center justify-content-between">
                        <!-- Logo -->
                        <div class="logo">
                            <a href="{{ route('home') }}"><img src="{{ $setting->logo ? $setting->logo : '' }}" alt=""></a>
                        </div>
                        <div class="search-form d-flex align-items-center">
                            <div class="search-form">
                                <form action="{{ route('search') }}" method="get">
                                    <input type="text" name="keyword" placeholder="@lang('labels.general.enter_name_product')" value="{{ request()->keyword ?? '' }}" />
                                    @if(request()->sort)
                                        <input type="hidden" name="sort" value="{{ request()->sort }}">
                                    @endif
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </div>

                        <div class="hotline d-flex align-items-center">
                            <img class="icon-phone" src="{{ asset('frontend/img/core-img/icon-phone.png') }}">
                            <div class="sdt">
                                <a href="tel:{{ $setting->hotline }}">{{ $setting->hotline }}</a>
                                <a href="tel:{{ $setting->phone }}">{{ $setting->phone }}</a>
                            </div>
                        </div>
                        <div class="cart d-flex align-items-center">
                            <a class="count-cart" href="javascript:void(0)">
                                <span>Giỏ hàng / </span>
                                <span class="cart-price">{{ $cart ? count($cart) : 0 }}</span>
                                <i class="fa fa-shopping-cart"></i>
                            </a>
                            <div class="btn-cart-checkout">
                                <ul>
                                    <li><a href="{{ route('orders.cart') }}">@lang('labels.cart.label')</a></li>
                                    <li><a href="{{ route('orders.checkout') }}">@lang('labels.checkout.label')</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar Area -->
    <div class="newspaper-main-menu" id="stickyMenu">
        <div class="classy-nav-container breakpoint-off">
            <div class="container">
                <nav class="classy-navbar justify-content-between" id="newspaperNav">
                    <div class="logo">
                        <a href="{{ route('home') }}"><img src="{{ $setting->logo_mobile ? $setting->logo_mobile : '' }}" alt=""></a>
                    </div>
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>
                    <div class="classy-menu">
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>
                        <div class="classynav">
                            <div class="search-form">
                                <form action="{{ route('search') }}" method="get">
                                    <input type="text" name="keyword" placeholder="@lang('labels.general.enter_name_product')" />
                                    @if(request()->sort)
                                        <input type="hidden" name="sort" value="{{ request()->sort }}">
                                    @endif
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                            <ul>
                                <li><a href="/" class="business">Trang chủ</a></li>
                                @foreach($menus as $menu)
                                    <li>
                                        <a href="/{{ $menu->url_menu }}" class="reason">{{ $menu->name }}</a>
                                        @if($menu->childMenu->count())
                                            <ul class="dropdown">
                                                @foreach($menu->childMenu as $child)
                                                    <li class="dropdown-item"><a href="/{{ $child->url_menu }}">{{ $child->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
