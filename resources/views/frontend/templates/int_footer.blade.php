<footer class="footer-area">
    <!-- Main Footer Area -->
    <div class="main-footer-area">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="footer-widget-area">
                        <div class="footer-logo">
                            <p class="title-widget">{{ $setting->company ?? '' }}</p>
                            <div class="address">
                                <p>@lang('labels.setting.address'): {{ $setting->address ?? '' }}</p>
                                <p>@lang('labels.setting.hotline'): <a href="tel:{{ $setting->hotline ?? '' }}">{{ $setting->hotline ?? '' }}</a></p>
                                <p>@lang('labels.setting.phone'): <a href="tel:{{ $setting->phone ?? '' }}">{{ $setting->phone ?? '' }}</a></p>
                                <p>@lang('labels.setting.email'): <a href="mailto:{{ $setting->email ?? '' }}">{{ $setting->email ?? '' }}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="footer-widget-area">
                        <p class="title-widget">THông tin chung</p>
                        <ul class="list-page">
                            @if($pages)
                                @foreach($pages as $page)
                                    <li><a href="{{ route('page', $page->url_page ?? '') }}">{{ $page->title ?? '' }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="footer-widget-area">
                        <p class="title-widget">Đăng ký nhận tin khuyến mại</p>
                        <div class="email-sale">
                            <p>Để không bỏ lỡ cơ hội mua sắm giá rẻ nào</p>
                            <form action="" method="">
                                <input type="text" name="" placeholder="Địa chỉ email" />
                                <button type="submit">Đăng ký</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="footer-widget-area">
                        <p class="title-widget">Liên kết facebook</p>
                        <div class="page-fb">
                        <div id="fb-root"></div>
                        <div class="fb-page" data-href="{{ $setting->facebook_url ?? '' }}" data-tabs="timeline" data-width="250px" data-height="250px" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false">
                            <blockquote cite="{{ $setting->facebook_url ?? '' }}" class="fb-xfbml-parse-ignore">
                                <a href="{{ $setting->facebook_url ?? '' }}">{{ $setting->company ?? '' }}</a>
                            </blockquote>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bottom Footer Area -->
    <div class="bottom-footer-area">
        <div class="container h-100">
            <div class="h-100 align-items-center">
                <div class="col-12">
                    <div class="row">
                        <p>
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> <a style="color: #fff" href="/" target="_blank">{{ $setting->company ?? '' }}</a>. All rights reserved.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="call-zalo">
        <a data-animate="fadeInDown" rel="noopener noreferrer" href="http://zalo.me/{{ $setting->hotline ?? '' }}" target="_blank" data-animated="true">
            <img class="zalo" src="{{ asset('frontend/img/core-img/icon-zalo.png') }}">
        </a>
    </div>
    <div class="call-phone">
        <a data-animate="fadeInDown" rel="noopener noreferrer" href="tel:{{ $setting->hotline ?? '' }}" data-animated="true">
            <img class="zalo" src="{{ asset('frontend/img/core-img/icon-phone.png') }}">
        </a>
    </div>
</footer>
