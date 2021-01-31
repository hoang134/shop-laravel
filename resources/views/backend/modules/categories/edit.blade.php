@extends('backend.layouts.app')
@section('title-admin', __('labels.category.label'))
@section('main-content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('labels.category.label')</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home.index')}}"><i class="fa fa-dashboard"></i>@lang('labels.general.home')</a></li>
            <li><a href="{{ route('categories.index') }}">@lang('labels.category.label')</a></li>
            <li>@lang('labels.general.edit')</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <div class="btn-group mg-r-10 float-right">
                    <a href="{{route('categories.index')}}" class="btn btn-success btn-sm">
                        <i class="fa fa-fw fa-list"></i> @lang('labels.general.list')
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12 mg-t-10">
                    @include('backend.modules.categories.form')
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
