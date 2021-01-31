@extends('frontend.layouts.app')
@section('title-frontend', __('labels.home_frontend'))
@php
    $total = (int) $order->orderDetails()->sum('total');
    $total = formatMoney($total);
    $paymentMethod = $order->payment_id == \App\Models\Order::PAYMENT_TRANSFER ? __('labels.checkout.bank') : __('labels.checkout.cod');
@endphp
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
                                <li><a class="active" href="javascript:void(0)">{{ __('labels.checkout.label') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="category-product">
                <div class="col-12 title-more">
                    <div class="page-catelogy-title">
                        <div class="page-catelogy-title-left">
                            <h1>{{ __('labels.success-order.label') }}</h1>
                        </div>
                    </div>
                </div>
                <div class="list-product page-checkout page-success-order">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-sm-12 col-md-7 col-lg-7">
                                <div class="information-bank">
                                    <h2 class="title-checkout">{{ __('labels.success-order.info-payment') }}</h2>
                                    <div class="content-information-bank">{{ $setting->information_bank ?? '' }}</div>
                                </div>
                                <div class="order-payment list-cart">
                                    <h3 class="title-checkout">{{ __('labels.success-order.detail-order') }}</h3>
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>{{ __('labels.cart.sp') }}</th>
                                            <th class="text-right">{{ __('labels.cart.total') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($order->orderDetails as $orderDetail)
                                            <tr>
                                                <td><p>{{ $orderDetail->product->name }} <span>x {{ $orderDetail->quantity }}</span></p></td>
                                                <td class="text-right"><p class="box-price">{{ formatMoney($orderDetail->total) }}<span>₫</span></p></td>
                                            </tr>
                                        @endforeach
                                        <tr class="tr-total">
                                            <td><p>{{ __('labels.success-order.payment') }}</p></td>
                                            <td class="text-right text-bank">
                                                <p>{{ $paymentMethod }}</p>
                                            </td>
                                        </tr>
                                        <tr class="tr-total">
                                            <td><p>{{ __('labels.cart.total') }}</p></td>
                                            <td class="text-right"><p class="box-price">{{ $total }}<span>₫</span></p></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-5 col-lg-5">
                                <div class="order-payment info-order">
                                    <h2 class="title-checkout">{{ __('labels.checkout.info_order') }}</h2>
                                    <div class="content-info-order">
                                        <ul>
                                            <li><p>{{ __('labels.success-order.code_order') }}: <span>{{ $order->code }}</span></p></li>
                                            <li><p>{{ __('labels.success-order.create') }}: <span>{{ $order->created_at }}</span></p></li>
                                            <li><p>{{ __('labels.cart.total') }}: <span class="box-price">{{ $total }}₫</span></p></li>
                                            <li><p>{{ __('labels.success-order.payment') }}: <span>{{ $paymentMethod }}</span></p></li>
                                        </ul>
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
