@extends('frontend.layouts.app')
@section('title-frontend', __('labels.home_frontend'))
@section('main-content')
    <section class="content page-product-detail">
        <div class="container">
            <div class="breadcrumbs-order">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="row">
                        <div class="breadcrumbs col-sm-12 col-md-6 col-lg-6">
                            <ul>
                                <li><a href="/">@lang('labels.general.home')</a></li>
                                <li><a href="javascript:void(0)">/</a></li>
                                <li><a href="{{ route('category', $product->category->url_category) }}">{{ $product->category->name }}</a></li>
                                <li><a href="javascript:void(0)">/</a></li>
                                <li><a class="active" href="{{ route('product', $product->url_product) }}">{{ $product->name }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-product">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="row">
                        <div class="image-product col-sm-12 col-md-6 col-lg-6">
                            <div class="image-detail">
                                <img src="{{ $product->url_image }}" />
                            </div>
                        </div>
                        <div class="detail-product col-sm-12 col-md-6 col-lg-6">
                            <h1>{{ $product->name }}</h1>
                            <h2 class="title-hidden">{{ $product->category->name }}</h2>
                            <p class="price box-price">{{ formatMoney($product->price) }}<span>₫</span></p>
                            <div class="des-product">{{ $product->description }}</div>
                            <div class="info-service">{!! $setting->information_services ?? '' !!}</div>
                            <div class="number-add-to-cart">
                                <input type="text" value="1" />
                                <button id="addToCart" data-product-id="{{ $product->id }}" type="button">@lang('labels.general.add_to_cart')</button>
                                <button type="button" class="fast_purchase" data-toggle="modal" data-target="#fastPurchase">@lang('labels.general.fast_order')</button>
                            </div>
                            <div class="list-social">
                                <div id="fb-root"></div>
                                <div class="fb-like" data-href="{{ route('product', $product->url_product) }}" data-width="" data-layout="button" data-action="like" data-size="large" data-share="true"></div>
                            </div>
                        </div>
                        <div class="detail-contact-product col-sm-12 col-md-12 col-lg-12">
                            <ul class="nav nav-tabs">
                                <li><a data-toggle="tab" href="#des_product" class="active">@lang('labels.category.description')</a></li>
                                <li><a data-toggle="tab" href="#info_contact">@lang('labels.general.contact_info')</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="des_product" class="tab-pane in active">{!! $product->content !!}</div>
                                <div id="info_contact" class="tab-pane">{!! $setting->information_bank ?? '' !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="category-product">
                <div class="col-12 title-more">
                    <div class="catelogy-title">
                        <div class="catelogy-title-left">
                            <h3><a href="{{ route('category', $product->category->url_category) }}">@lang('labels.product.same_product')</a></h3>
                        </div>
                        <div class="catelogy-title-right">
                            <a href="{{ route('category', $product->category->url_category) }}" target="blank"> @lang('labels.general.see_more') <i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="list-product">
                    <div class="col-lg-12">
                        <div class="row">

                            @foreach($otherProducts as $item)
                                <div class="col-item">
                                    <div class="item-product">
                                        <div class="box-image">
                                            <a href="{{ route('product', $item->url_product) }}">
                                                <img src="{{ $item->url_image }}" />
                                            </a>
                                        </div>
                                        <div class="box-title-price">
                                            <a class="box-title" href="{{ route('product', $item->url_product) }}">{{ $item->name }}</a>
                                            <p class="box-price">{{ formatMoney($item->price) }}<span>₫</span></p>
                                            <div class="add-to-cart-button">
                                                <button type="button" data-product-id="{{ $item->id }}">@lang('labels.general.add_to_cart')</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>

            <div id="fastPurchase" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>Đặt hàng nhanh</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-info-product">
                                            <img src="{{ $product->url_image }}" />
                                            <p>{{ $product->name }}</p>
                                            <p class="box-price">{{ formatMoney($product->price) }}<span>₫</span></p>
                                            <div class="info-order-fast">
                                                <p>THAM KHẢO CÁCH THỨC MUA HÀNG TRƯỚC KHI TIẾN HÀNH ĐẶT HÀNG . Bạn vui lòng nhập đúng thông tin đặt hàng gồm: Họ tên, SĐT, Email, Địa chỉ để chúng tôi được phục vụ bạn tốt nhất !</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <form action="" method="POST" class="formFastPurchase">
                                            <div class="form-item">
                                                <label>Họ và tên</label>
                                                <input name="name" type="text" />
                                                <span class="text-danger error error_name d-none"></span>
                                            </div>
                                            <div class="form-item">
                                                <label>Số điện thoại</label>
                                                <input name="phone" type="text" />
                                                <span class="text-danger error error_phone d-none"></span>
                                            </div>
                                            <div class="form-item">
                                                <label>Địa chỉ email</label>
                                                <input name="email" type="text" />
                                                <span class="text-danger error error_email d-none"></span>
                                            </div>
                                            <div class="form-item">
                                                <label>Địa chỉ nhận hàng</label>
                                                <input name="address" type="text" />
                                                <span class="text-danger error error_address d-none"></span>
                                            </div>
                                            <div class="form-item">
                                                <label>Số lượng</label>
                                                <input id="form-quantity" name="quantity" type="text" />
                                                <input id="form-product" name="product_id" type="hidden" value="{{ $product->id }}" />
                                                <span class="text-danger error error_quantity d-none"></span>
                                            </div>
                                            <button type="button" id="btnFastPurchase" onclick="orderFastPurchase()">Đặt hàng</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        var routes = {
            order_fast_purchase: '{{ route('orders.order-fast-purchase') }}',
        };

        $(function () {
            $('#addToCart').click(function (e) {
                e.preventDefault();
                let quantity = $(this).siblings('input').val();
                let productId = $(this).data('product-id');
                addToCart(productId, quantity);
            });
        });
    </script>
@endsection
