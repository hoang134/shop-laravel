@extends('backend.layouts.app')
@section('title-admin','Steps')
@section('main-content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Steps</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home.index')}}"><i class="fa fa-dashboard"></i>ホーム</a></li>
            <li><a href="#">Steps</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-body">
                <div class="col-md-12 mg-t-10">
                    @include('backend.modules.steps.form')
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