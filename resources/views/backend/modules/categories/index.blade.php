@extends('backend.layouts.app')
@section('title-admin', __('labels.category.label'))
@section('main-content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('labels.category.label')</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home.index')}}"><i class="fa fa-dashboard"></i>@lang('labels.general.home')</a></li>
            <li>@lang('labels.category.label')</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <div class="btn-group mg-r-10 float-right">
                    <a href="{{route('categories.create')}}" class="btn btn-success btn-sm">
                        <i class="fa fa-save"></i> @lang('labels.general.create_new')
                    </a>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('labels.category.name')</th>
                            <th>@lang('labels.category.parent')</th>
                            <th>@lang('labels.category.url')</th>
                            <th style="max-width: 200px">@lang('labels.category.description')</th>
                            <th>@lang('labels.category.home')</th>
                            <th>@lang('labels.general.status')</th>
                            <th>@lang('labels.general.action')</th>
                        </tr>
                    </thead>

                    <tbody>
                    @php $i = 1 @endphp
                        @foreach($categories as $category)
                            <tr>
                                <td class="text-height">{{ $i }}</td>
                                <td><p class="text-space"><span class="content-space" data-toggle="tooltip" title="{{$category->name}}">{{$category->name}}</span></p></td>
                                <td>{!! !empty($category->parentCategory) ? $category->parentCategory->name : '' !!}</td>
                                <td>{{ $category->url_category}}</td>
                                <td style="max-width: 200px">{{ $category->description }}</td>
                                <td>{{ getStatus($category->show_home) }}</td>
                                <td>{{ getStatus($category->status) }}</td>
                                <td>
                                    @can('update', $category)
                                        <a href="{{route('categories.edit', $category->id)}}" class="btn btn-xs btn-success mg-t-5"><i class="fa fa-edit"></i></a>
                                    @endcan
                                    @can('delete', $category)
                                        @if($category->status != \App\Helpers\Constant::STATUS_DELETED)
                                            <a href="{{route('categories.delete', $category->id)}}"  class="btn btn-xs btn-danger option-delete-modal mg-l-5 mg-t-5"><i class="fa fa-trash"></i></a>
                                        @endif
                                    @endcan
                                    @can('restore', $category)
                                        @if($category->status == \App\Helpers\Constant::STATUS_DELETED)
                                            <a href="{{route('categories.restore', $category->id)}}"  class="btn btn-xs btn-danger option-restore-modal mg-l-5 mg-t-5"><i class="fa fa-refresh"></i></a>
                                        @endif
                                    @endcan
                                </td>
                            </tr>
                            @php $i++ @endphp
                        @endforeach
                    </tbody>
                    <tr>
                        <td colspan="7">
                            {!! renderPaginate($categories, $query = '') !!}
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
