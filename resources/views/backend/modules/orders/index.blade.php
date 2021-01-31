@extends('backend.layouts.app')
@section('title-admin', __('labels.order.label'))
@section('main-content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('labels.order.label')</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home.index')}}"><i class="fa fa-dashboard"></i>@lang('labels.general.home')</a></li>
            <li>@lang('labels.order.label')</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <div class="btn-group mg-r-10 float-right">
                    <a href="{{route('orders.create')}}" class="btn btn-success btn-sm">
                        <i class="fa fa-save"></i> @lang('labels.general.create_new')
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="form-search">
                    <span class="title-saerch">Tìm kiếm đơn hàng</span>
                    <input placeholder="@lang('labels.order.code')" name="code" id="order_name" type="text" />
                    <input placeholder="@lang('labels.order.name_customer')" name="name_customer" id="order_customer" type="text" />
                    <input placeholder="@lang('labels.order.phone')" name="phone" id="order_phone" type="text" />
                    <button class="btn-search-product" type="button">Tìm kiếm</button>
                </div>
                <table id="listOrders" class="table table-striped table-bordered table-hover datatable">
                    <thead>
                        <tr>
                            <th>@lang('labels.order.code')</th>
                            <th>@lang('labels.order.name_customer')</th>
                            <th>@lang('labels.order.phone')</th>
                            <th>@lang('labels.order.create')</th>
                            <th>@lang('labels.order.status')</th>
                            <th>@lang('labels.general.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
@section('script')
    <script>
        var routes = {
            get_data_order: '{{ route('orders.get-data-order') }}',
        };
    </script>
    <script src="/backend/js/order/index.js"></script>
@endsection
