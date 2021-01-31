@extends('backend.layouts.app')
@section('title-admin','Step')
@section('main-content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Step</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home.index')}}"><i class="fa fa-dashboard"></i>ホーム</a></li>
            <li><a href="#">Step</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <div class="btn-group mg-r-10 float-right">
                    <a href="{{route('steps.create')}}" class="btn btn-success btn-sm">
                        <i class="fa fa-save"></i> 新規作成
                    </a>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Step</th>
                            <th>タイトル </th>
                            <th>本文</th>
                            <th >ロケーション</th>
                            <th>アクション</th>
                        </tr>
                    </thead>

                    <tbody>
                    @php $i = $steps->firstItem() @endphp
                    @foreach($steps as $step)
                        <tr>
                            <td class="text-height">{{ $i }}</td>
                            <td>{{ $step->step }}</td>
                            <td style="width: 300px"><p class="text-space"><span class="content-space" data-toggle="tooltip" title="{{$step->title}}">{{$step->title}}</span></p></td>
                            <td style="width: 500px">{!! $step->content !!}</td>
                            <td>{{ $step->location }}</td>
                            <td>
                                <a href="{{route('steps.edit', $step->id)}}" class="btn btn-xs btn-success mg-t-5"><i class="fa fa-edit"></i></a>
                                <a href="{{route('steps.delete', $step->id)}}"  class="btn btn-xs btn-danger option-delete-modal mg-l-5 mg-t-5"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @php $i++ @endphp
                    @endforeach
                    </tbody>
                    <tr>
                        <td colspan="6">
                            {!! renderPaginate($steps, $query = '') !!}
                        </td>
                    </tr>
                </table>
            </div>
            <!-- /.box-body -->
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection