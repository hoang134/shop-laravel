@extends('backend.layouts.app')
@section('title-admin', __('labels.product.label'))
@section('style')
    <link rel="stylesheet" href="/backend/fileupload/css/jquery.fileupload.css">
    <link rel="stylesheet" href="/backend/fileupload/css/jquery.fileupload-ui.css">
    <link rel="stylesheet" href="/backend/bower_components/jquery-ui/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/backend/css/lightgallery.css">
    <link rel="stylesheet" href="/backend/css/product/add.css">
@endsection
@section('main-content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('labels.product.label')</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home.index')}}"><i class="fa fa-dashboard"></i>@lang('labels.general.home')</a></li>
            <li><a href="{{ route('products.index') }}">@lang('labels.product.label')</a></li>
            <li>@lang('labels.general.create_new')</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-body">
                <div class="col-md-12 mg-t-10">
                    @include('backend.modules.products.form')
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
    <script src="/backend/fileupload/js/vendor/jquery.ui.widget.js"></script>
    <script src="/backend/fileupload/js/jquery.iframe-transport.js"></script>
    <script src="/backend/fileupload/js/jquery.fileupload.js"></script>
    <script src="/backend/fileupload/js/jquery.fileupload-process.js"></script>
    <script src="/backend/fileupload/js/jquery.fileupload-validate.js"></script>
    <script src="/backend/bower_components/jquery-ui/jquery-ui.js"></script>
    <script src="/backend/js/lightgallery.min.js"></script>
    <script>
        var urlAddImage = '{{ route('products.add-image') }}';
    </script>
    <script src="/backend/js/product/add.js"></script>
@endsection
