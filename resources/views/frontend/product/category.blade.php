@extends('frontend.layouts.app')
@section('title-frontend', __('labels.home_frontend'))
@section('main-content')
    <section class="content">
        <div class="container">
            <div class="breadcrumbs-order">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="row">
                        <div class="breadcrumbs col-sm-12 col-md-6 col-lg-6">
                            <ul>
                                <li><a href="/">@lang('labels.general.home')</a></li>
                                <li><a href="javascript:void(0)">/</a></li>
                                <li><a class="active" href="{{ route('category', $category->url_category) }}">{{ $category->name }}</a></li>
                            </ul>
                        </div>
                        <div class="order-category col-sm-12 col-md-6 col-lg-6">
                            <select id="sort">
                                <option {{ isset(request()->sort) ? request()->sort == 'default' ? 'selected' : '' : '' }} data-href="{{ route('category', ['link' => $category->url_category, 'sort' => 'default']) }}">@lang('labels.sort.default')</option>
                                <option {{ isset(request()->sort) ? request()->sort == 'asc' ? 'selected' : '' : '' }} data-href="{{ route('category', ['link' => $category->url_category, 'sort' => 'asc']) }}">@lang('labels.sort.low_to_high')</option>
                                <option {{ isset(request()->sort) ? request()->sort == 'desc' ? 'selected' : '' : '' }} data-href="{{ route('category', ['link' => $category->url_category, 'sort' => 'desc']) }}">@lang('labels.sort.high_to_low')</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="category-product">
                <div class="col-12 title-more">
                    <div class="page-catelogy-title">
                        <div class="page-catelogy-title-left">
                            <h1>{{ $category->name }}</h1>
                        </div>
                        <div class="page-catelogy-title-right">

                        </div>
                    </div>
                </div>
                <div class="des-cate col-12">
                    <p>{{ $category->description }}</p>
                </div>
                <div class="list-product">
                    <div class="col-lg-12">
                        <div class="row">

                            @if($products->isEmpty())
                                <p>@lang('labels.general.have_not_product')</p>
                            @else
                                @foreach($products as $product)
                                    <div class="col-item">
                                        <div class="item-product">
                                            <div class="box-image">
                                                <a href="{{ route('product', $product->url_product) }}">
                                                    <img src="{{ $product->url_image }}" />
                                                </a>
                                            </div>
                                            <div class="box-title-price">
                                                <a class="box-title" href="{{ route('product', $product->url_product) }}">{{ $product->name }}</a>
                                                <p class="box-price">{{ formatMoney($product->price) }}<span>₫</span></p>
                                                <div class="add-to-cart-button">
                                                    <button type="button" data-product-id="{{ $product->id }}">@lang('labels.general.add_to_cart')</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>
                <div class="pagination-product">
                    <div class="col-lg-12">
                        <div class="row">
                            {{ $products->appends(request()->input())->links('frontend.pagination.default') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $('#sort').on('change', function (e) {
            let optionSelected = $("option:selected", this);
            let href = optionSelected.data('href');
            window.location.href = href;
        });
    </script>
@endsection
