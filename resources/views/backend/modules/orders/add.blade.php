@extends('backend.layouts.app')
@section('title-admin', __('labels.order.label'))
@section('style')
    <link rel="stylesheet" href="{!! secure_asset('backend/bower_components/jquery-ui/themes/base/jquery-ui.css') !!}">
@endsection
@section('main-content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('labels.order.label')</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home.index')}}"><i class="fa fa-dashboard"></i>@lang('labels.general.home')</a></li>
            <li><a href="{{ route('orders.index') }}">@lang('labels.order.label')</a></li>
            <li>@lang('labels.general.create_new')</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-body">
                <div class="col-md-12 mg-t-10">
                    <form action="" method="post">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <h3 class="title">@lang('labels.customer.label')</h3>
                        </div>
                        <div class="row">
                            <input id="customerId" type="hidden" name="id">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }} ">
                                    <label for="name" class="control-label default">@lang('labels.customer.name')<sup class="text-danger">(*)</sup></label>
                                    <input id="name" type="text" class="form-control" placeholder="@lang('labels.customer.name')" name="name" value="{{old('name', isset($order->customer->name) ? $order->customer->name : '')}}" required>
                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('name') }}</p></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->first('address') ? 'has-error' : '' }} ">
                                    <label for="address" class="control-label default">@lang('labels.customer.address')</label>
                                    <input id="address" type="text" class="form-control" placeholder="@lang('labels.customer.address')" name="address" value="{{old('address', isset($order->customer->address) ? $order->customer->address : '')}}">
                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('address') }}</p></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->first('phone') ? 'has-error' : '' }} ">
                                    <label for="phone" class="control-label default">@lang('labels.customer.phone')<sup class="text-danger">(*)</sup></label>
                                    <input id="phone" type="text" class="form-control" placeholder="@lang('labels.customer.phone')" name="phone" value="{{old('phone', isset($order->customer->phone) ? $order->customer->phone : '')}}" required>
                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('phone') }}</p></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->first('email') ? 'has-error' : '' }} ">
                                    <label for="email" class="control-label default">@lang('labels.customer.email')</label>
                                    <input id="email" type="text" class="form-control" placeholder="@lang('labels.customer.email')" name="email" value="{{old('email', isset($order->customer->email) ? $order->customer->email : '')}}">
                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('email') }}</p></span>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button id="btnEditCustomer" type="button" class="btn btn-xs btn-warning invisible" title="@lang('labels.order.reset')">
                                    <i class="fa fa-fw fa-power-off"></i>
                                </button>
                            </div>
                        </div>

                        <div class="row">
                            <h3 class="title">@lang('labels.product.label')</h3>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th width="30%">@lang('labels.product.name')</th>
                                <th width="20%">@lang('labels.product.image')</th>
                                <th width="20%">@lang('labels.product.quantity')</th>
                                <th width="20%">@lang('labels.product.price')</th>
                                <th width="10%"></th>
                            </tr>
                            </thead>

                            <tbody>
                                <tr class="product" data-index="0">
                                    <input class="id" type="hidden" name="products[0][product_id]">
                                    <input class="price" type="hidden" name="products[0][price]">
                                    <td class="name">
                                        <input type="text" class="form-control" placeholder="@lang('labels.product.name')" required>
                                    </td>
                                    <td class="image">
                                        <!-- image -->
                                    </td>
                                    <td class="quantity">
                                        <input type="number" name="products[0][quantity]" value="1" class="form-control" placeholder="@lang('labels.product.quantity')" required min="1">
                                    </td>
                                    <td class="price"></td>
                                    <td class="action">
                                        <div class="text-center">
                                            <button type="button" class="btnEdit btn btn-xs btn-warning" title="@lang('labels.order.reset')">
                                                <i class="fa fa-fw fa-power-off"></i>
                                            </button>
                                            <button type="button" class="btnRemove btn btn-xs btn-danger" title="@lang('labels.order.remove')">
                                                <i class="fa fa-fw fa-minus"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <tr>
                                <td colspan="5">
                                    <div class="clearfix">
                                        <div class="float-right">
                                            <button type="button" class="btnAdd btn btn-xs btn-success" title="@lang('labels.order.add_product')">
                                                <i class="fa fa-fw fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>

                        <div class="row">
                            <h3 class="title">@lang('labels.order.total_price'): <span id="totalPrice"></span></h3>
                        </div>

                        <div class="row">
                            <h3 class="title">@lang('labels.order.payment_method')</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->first('payment_id') ? 'has-error' : '' }} ">
                                    <label for="payment_id" class="control-label default">@lang('labels.order.payment_method')<sup class="text-danger">(*)</sup></label>
                                    <select id="payment_id" class="form-control" name="payment_id">
                                        @foreach(Constant::PAYMENT_METHOD as $key => $payment)
                                            <option value="{{ $payment }}"
                                                {{old('payment_id', isset($order->payment_id) ? $order->payment_id : '') == $payment ? 'selected' : ''}}
                                            >{{ __('labels.order.payment_method_' . $key) }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('payment_id') }}</p></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-sm-12 text-center">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <a href="{{ route('orders.index') }}"  class="btn btn-danger with-btn mg-r-5"><i class="fa fa-fw fa-reply-all"></i>@lang('labels.general.back')</a>
                                    <button type="submit" class="btn btn-primary with-btn"><i class="fa fa-save"></i> @lang('labels.general.save')</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">

            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
@section('script')
    <script src="{!! secure_asset('backend/bower_components/jquery-ui/jquery-ui.js') !!}"></script>
    <script>
        var urlSearch = {
            customers: '{{ route('customers.search') }}',
            products: '{{ route('products.search') }}',
        };
    </script>
    <script src="{!! secure_asset('backend/js/order/add.js') !!}"></script>
@endsection
