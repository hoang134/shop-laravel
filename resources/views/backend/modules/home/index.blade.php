@extends('backend.layouts.app')
@section('title-admin', __('labels.general.home'))
@section('main-content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('labels.general.home')</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home.index')}}"><i class="fa fa-dashboard"></i>@lang('labels.general.home')</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-body">
                <div class="col-md-12 mg-t-10">
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="statistical_order order_new">
                            <h5>@lang('labels.general.order_new')</h5>
                            <p>{{$orderNew}}</p>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="statistical_order order_process">
                            <h5>@lang('labels.general.order_process')</h5>
                            <p>{{$orderProcess}}</p>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="statistical_order order_success">
                            <h5>@lang('labels.general.order_success')</h5>
                            <p>{{$orderSuccess}}</p>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <div class="statistical_order order_cancel">
                            <h5>@lang('labels.general.order_cancel')</h5>
                            <p>{{$orderClose}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
