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
                                <li><a href="/">{{ __('labels.home') }}</a></li>
                                <li><a href="javascript:void(0)">/</a></li>
                                <li><a class="active" href="/">{{ __('labels.checkout.label') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="category-product">
                <div class="col-12 title-more">
                    <div class="page-catelogy-title">
                        <div class="page-catelogy-title-left">
                            <h1>{{ __('labels.checkout.label') }}</h1>
                        </div>
                    </div>
                </div>
                <div class="list-product page-checkout">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-sm-12 col-md-7 col-lg-7">
                                <div class="form-payment">
                                    <h1 class="title-checkout">{{ __('labels.checkout.info_customer') }}</h1>
                                    <form id="info" action="{{ route('orders.checkout') }}" method="post">
                                        @csrf
                                        <div class="form-item">
                                            <p>{{ __('labels.checkout.fullname') }}<span>*</span></p>
                                            <input type="text" name="name" value="{{ old('name') }}"/>
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        </div>
                                        <div class="form-item">
                                            <p>{{ __('labels.checkout.address') }}<span>*</span></p>
                                            <input type="text" name="address" value="{{ old('address') }}"/>
                                            <span class="text-danger">{{ $errors->first('address') }}</span>
                                        </div>
                                        <div class="form-item">
                                            <p>{{ __('labels.checkout.phone') }}<span>*</span></p>
                                            <input type="text" name="phone" value="{{ old('phone') }}"/>
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        </div>
                                        <div class="form-item">
                                            <p>{{ __('labels.checkout.email') }}</p>
                                            <input type="text" name="email" value="{{ old('email') }}"/>
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        </div>
                                        <div class="form-item">
                                            <p>{{ __('labels.checkout.content') }}</p>
                                            <textarea name="content">{{ old('content') }}</textarea>
                                            <span class="text-danger">{{ $errors->first('content') }}</span>
                                        </div>
                                        <input type="hidden" name="payment_id" value="{{ old('payment_id', \App\Models\Order::PAYMENT_COD) }}">
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-5 col-lg-5">
                                <div class="order-payment list-cart">
                                    <h2 class="title-checkout">{{ __('labels.checkout.info_order') }}</h2>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>{{ __('labels.cart.sp') }}</th>
                                                <th>{{ __('labels.cart.total') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($session as $item)
                                            <tr>
                                                <td><p>{{ $item['product']->name }} <span>x {{ $item['quantity'] }}</span></p></td>
                                                <td><p class="box-price">{{ formatMoney($item['total']) }}<span>₫</span></p></td>
                                            </tr>
                                        @endforeach

                                        <tr class="tr-total">
                                            <td><p>{{ __('labels.cart.total') }}</p></td>
                                            <td><p class="box-price">{{ formatMoney($session->sum('total')) }}<span>₫</span></p></td>
                                        </tr>

                                        </tbody>
                                    </table>
                                    <div class="two-payment">
                                        <div class="">
                                            <input type="radio" name="payment" id="bank"
                                                   value="{{ \App\Models\Order::PAYMENT_TRANSFER }}" {{ old('payment') == \App\Models\Order::PAYMENT_TRANSFER ? 'checked' : '' }}>
                                            <label for="bank">{{ __('labels.checkout.bank') }}</label>
                                        </div>
                                        <div class="">
                                            <input type="radio" name="payment" id="cod"
                                                   value="{{ \App\Models\Order::PAYMENT_COD }}" {{ old('payment') != \App\Models\Order::PAYMENT_TRANSFER ? 'checked' : '' }}>
                                            <label for="cod">{{ __('labels.checkout.cod') }}</label>
                                        </div>
                                    </div>
                                    <button id="submit" class="btn-order" type="button">{{ __('labels.checkout.order') }}</button>
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
        $(function () {
            var infoForm = $('#info');

            $(document).on('change click', 'input[name=payment]', function () {
                let payment = $(this).val();
                infoForm.find('input[name=payment_id]').val(payment);
            });

            $('#submit').click(function (e) {
                e.preventDefault();
                infoForm.submit();
            });
        });
    </script>
@endsection
