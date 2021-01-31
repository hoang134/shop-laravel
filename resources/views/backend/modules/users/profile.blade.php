@extends('backend.layouts.app')
@section('title-admin', __('labels.user.profile'))
@section('main-content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('labels.user.profile')</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home.index')}}"><i class="fa fa-dashboard"></i>@lang('labels.general.home')</a></li>
            <li>@lang('labels.user.profile')</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-body">
                <div class="col-md-12 mg-t-10">
                    @include('backend.modules.users.form')
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
    <script>
        $(function () {
            $('#changePassword').click(function () {
                $(this).addClass('invisible');
                $('#password').prop('type', 'password').prop('disabled', false);
            });
        });
    </script>
@endsection
