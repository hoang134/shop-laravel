@extends('frontend.layouts.app')
@section('title-frontend', __('labels.cart.label'))
@section('main-content')
    <section class="content">
        <div class="container">
            <div class="breadcrumbs-order">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="row">
                        <div class="breadcrumbs col-sm-12 col-md-6 col-lg-6">
                            <ul>
                                <li><a href="/">{{ __('labels.home') }}</a></li>
                                <li><a href="javascript:void(0)">/</a></li>
                                <li><a class="active" href="/">{{ __('labels.cart.label') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="category-product">
                <div class="col-12 title-more">
                    <div class="page-catelogy-title">
                        <div class="page-catelogy-title-left">
                            <h1>{{ __('labels.cart.label') }}</h1>
                        </div>
                    </div>
                </div>
                <div class="list-product list-cart">
                    @if (!empty($arrData))
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="table-list col-sm-12 col-md-8 col-lg-8">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>{{ __('labels.cart.sp') }}</th>
                                            <th>{{ __('labels.cart.price') }}</th>
                                            <th>{{ __('labels.cart.quantity') }}</th>
                                            <th>{{ __('labels.cart.total_item') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($arrData as $item)
                                        <tr class="product_{{ $item['product']->id }}">
                                            <td>
                                                <span onclick="deleteCart({{ $item['product']->id }})" class="delete-product"><i class="fa fa-trash"></i></span>
                                                <img src="{{ $item['product']->url_image }}" />
                                                <span>{{ $item['product']->name }}</span>
                                            </td>
                                            <td><p class="box-price">{{ formatMoney($item['product']->price) }}<span>₫</span></p></td>
                                            <td><input class="change_quantity" data-id="{{ $item['product']->id }}" type="text" value="{{ $item['quantity'] }}" /></td>
                                            <td><p class="box-price price_{{ $item['product']->id }}">{{ formatMoney($item['total']) }}<span>₫</span></p></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="continue-update">
                                    <a class="continue" href="/"><i class="fa fa-arrow-left"></i> {{ __('labels.cart.continue') }}</a>
                                    <a class="update_cart" href="{{ route('orders.cart') }}">{{ __('labels.cart.update_cart') }}</a>
                                </div>
                            </div>
                            <div class="table-total col-sm-12 col-md-4 col-lg-4">
                                <table>
                                    <thead>
                                        <tr>
                                            <th colspan="2">{{ __('labels.cart.total_all') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ __('labels.cart.total') }}</td>
                                            <td><p class="box-price" id="totalAll">{{ formatMoney($totalAll) }}<span>₫</span></p></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a class="cart-payment" href="{{ route('orders.checkout') }}">{{ __('labels.cart.payment') }}</a>
                            </div>
                        </div>
                    </div>
                    @else
                        <p>{{__('labels.cart.empty_cart')}}</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        var routes = {
            delete_product: '{{ route('orders.delete-product') }}',
            change_quantity: '{{ route('orders.change-quantity') }}',
        };
    </script>
@endsection
