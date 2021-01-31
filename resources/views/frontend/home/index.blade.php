@extends('frontend.layouts.app')
@section('title-frontend', __('labels.home_frontend'))
@section('main-content')
<section class="content page-home">
    <div class="container">
        <!-- Default box -->
        <div class="slider-post">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-12 col-md-8">
                        <div id="carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @if(count($slides))
                                    @foreach($slides as $i => $slide)
                                        <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                                            <a href="{{ $slide->url_link }}">
                                                <img class="d-block w-100" src="{{ $slide->url_image }}" alt="Slide {{ $i + 1 }}">
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="/frontend/img/image_default.jpg" alt="No Image">
                                    </div>
                                @endif
                            </div>
                            <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                    <div class="title-more pb-2">
                        <div class="catelogy-title">
                            <div class="catelogy-title-left">
                                <a href="" class="">Tin tức</a>
                            </div>
                        </div>
                    </div>
                    @if(count($posts))
                        <div class="sidebar-post">
                            <ul>
                                @foreach($posts as $post)
                                    <li>
                                        <a href="{{ route('post', $post->url_post) }}">
                                            <div class="sb-imge">
                                                <img src="{{ $post->url_image }}" />
                                            </div>
                                            <div class="sb-title-price">
                                                <span>{{ $post->title }}</span>
                                            </div>
                                            <div class="font-italic">
                                                <small>{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y - H:i') }}</small>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div class="text-center w-100 p-3">Không có tin mới</div>
                    @endif
                </div>
                </div>
            </div>
        </div>

        <div class="banner">
            <div class="col-12">
                <div class="row">
                    @if(count($banners))
                        @foreach($banners as $banner)
                            <div class="col-md-6 col-sm-12">
                                <a href="{{ $banner->url_link }}" title="{{ $banner->title }}" target="_blank">
                                    <img class="d-block w-100" src="{{ $banner->url_image }}" alt="{{ $banner->title }}">
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="category-product">
            <div class="col-12 title-more">
                <div class="catelogy-title">
                    <div class="catelogy-title-left">
                        <h3><a href="javascript:void(0)">Sản phẩm mới</a></h3>
                    </div>
                    <div class="catelogy-title-right">
                    </div>
                </div>
            </div>
            <div class="list-product">
                <div class="col-lg-12">
                    <div class="row">
                        @foreach($newProducts as $product)
                        <div class="col-item">
                            <div class="item-product">
                                <div class="box-image">
                                    <a href="/product/{{ $product->url_product }}">
                                        <img src="{{ $product->url_image ? $product->url_image : '/frontend/img/image_default.jpg' }}" />
                                    </a>
                                </div>
                                <div class="box-title-price">
                                    <a class="box-title" href="/product/{{ $product->url_product }}">{{ $product->name }}</a>
                                    <p class="box-price">{{ formatMoney($product->price) }}<span>₫</span></p>
                                    <div class="add-to-cart-button">
                                        <button type="button" data-product-id="{{ $product->id }}">@lang('labels.general.add_to_cart')</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        @if(count($categories))
            @foreach($categories as $category)
                @php $products = $category->randomProducts(10) @endphp
                <div class="category-product">
                    <div class="col-12 title-more">
                        <div class="catelogy-title">
                            <div class="catelogy-title-left">
                                <h3><a href="/category/{{ $category->url_category }}">{{ $category->name }}</a></h3>
                            </div>
                            <div class="catelogy-title-right">
                                <a href="/category/{{ $category->url_category }}" target="blank"> Xem tất cả <i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="list-product">
                        <div class="col-lg-12">
                            <div class="row">
                                @foreach($products as $product)
                                    <div class="col-item">
                                        <div class="item-product">
                                            <div class="box-image">
                                                <a href="/product/{{ $product->url_product }}">
                                                    <img src="{{ $product->url_image }}" />
                                                </a>
                                            </div>
                                            <div class="box-title-price">
                                                <a class="box-title" href="/product/{{ $product->url_product }}">{{ $product->name }}</a>
                                                <p class="box-price">{{ formatMoney($product->price) }}<span>₫</span></p>
                                                <div class="add-to-cart-button">
                                                    <button type="button" data-product-id="{{ $product->id }}">@lang('labels.general.add_to_cart')</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</section>
@endsection
