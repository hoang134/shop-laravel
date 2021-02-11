@extends('backend.layouts.app')
@section('title-admin', __('labels.banner.label'))
@section('main-content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('labels.post.label')</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home.index')}}"><i class="fa fa-dashboard"></i>@lang('labels.general.home')</a></li>
            <li>@lang('labels.banner.label')</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <div class="btn-group mg-r-10 float-right">
                    <a href="{{route('banners.create')}}" class="btn btn-success btn-sm">
                        <i class="fa fa-save"></i> @lang('labels.general.create_new')
                    </a>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('labels.post.title')</th>
                            <th>@lang('labels.post.url')</th>
                            <th>@lang('labels.post.image')</th>
                            <th>@lang('labels.banner.position')</th>
                            <th>@lang('labels.general.status')</th>
                            <th>@lang('labels.general.action')</th>
                        </tr>
                    </thead>

                    <tbody>
                    @php $i = 1 @endphp
                        @foreach($banners as $banner)
                            <tr>
                                <td class="text-height">{{ $i }}</td>
                                <td><p class="text-space"><span class="content-space" data-toggle="tooltip" title="{{$banner->title}}">{{$banner->title}}</span></p></td>
                                <td>{{ $banner->url_link }}</td>
                                <td><img src="{!! !empty($banner->url_image) ? $banner->url_image : secure_asset('frontend/img/image_default.jpg') !!}" alt="" width="150" height="100"></td>
                                <td>{{ getPosition($banner->position) }}</td>
                                <td>{{ getStatus($banner->status) }}</td>
                                <td>
                                    <a href="{{route('banners.edit', $banner->id)}}" class="btn btn-xs btn-success mg-t-5"><i class="fa fa-edit"></i></a>
                                    @if($banner->status != \App\Helpers\Constant::STATUS_DELETED)
                                        <a href="{{route('banners.delete', $banner->id)}}"  class="btn btn-xs btn-danger option-delete-modal mg-l-5 mg-t-5"><i class="fa fa-trash"></i></a>
                                    @endif
                                    @if($banner->status == \App\Helpers\Constant::STATUS_DELETED)
                                        <a href="{{route('banners.restore', $banner->id)}}"  class="btn btn-xs btn-danger option-restore-modal mg-l-5 mg-t-5"><i class="fa fa-refresh"></i></a>
                                    @endif
                                </td>
                            </tr>
                            @php $i++ @endphp
                        @endforeach
                    </tbody>
                    <tr>
                        <td colspan="7">
                            {!! renderPaginate($banners, $query = '') !!}
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
