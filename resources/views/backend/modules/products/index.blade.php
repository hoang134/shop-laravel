@extends('backend.layouts.app')
@section('title-admin', __('labels.product.label'))
@section('main-content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('labels.product.label')</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home.index')}}"><i class="fa fa-dashboard"></i>@lang('labels.general.home')</a></li>
            <li>@lang('labels.product.label')</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <div class="btn-group mg-r-10 float-right">
                    <a href="{{route('products.create')}}" class="btn btn-success btn-sm">
                        <i class="fa fa-save"></i> @lang('labels.general.create_new')
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="form-search">
                    <span class="title-saerch">Tìm kiếm sản phẩm</span>
                    <input placeholder="@lang('labels.product.name')" name="name" id="product_name" type="text" />
                    <button class="btn-search-product" type="button">Tìm kiếm</button>
                </div>

                <table id="listProducts" class="table table-striped table-bordered table-hover datatable">
                    <thead>
                        <tr>
                            <th>@lang('labels.product.name')</th>
                            <th>@lang('labels.product.url')</th>
                            <th>@lang('labels.product.image')</th>
                            <th>@lang('labels.product.quantity')</th>
                            <th>@lang('labels.general.status')</th>
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
            get_data_product: '{{ route('products.get-data-product') }}',
        };
    </script>
    <script src="/backend/js/product/product.js"></script>
@endsection
