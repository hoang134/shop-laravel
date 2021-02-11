@extends('backend.layouts.app')
@section('title-admin', __('labels.post.label'))
@section('main-content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('labels.post.label')</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home.index')}}"><i class="fa fa-dashboard"></i>@lang('labels.general.home')</a></li>
            <li>@lang('labels.post.label')</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <div class="btn-group mg-r-10 float-right">
                    <a href="{{route('posts.create')}}" class="btn btn-success btn-sm">
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
                            <th>@lang('labels.post.description')</th>
                            <th>@lang('labels.general.status')</th>
                            <th>@lang('labels.general.action')</th>
                        </tr>
                    </thead>

                    <tbody>
                    @php $i = 1 @endphp
                        @foreach($posts as $post)
                            <tr>
                                <td class="text-height">{{ $i }}</td>
                                <td><p class="text-space"><span class="content-space" data-toggle="tooltip" title="{{$post->title}}">{{$post->title}}</span></p></td>
                                <td>{{ $post->url_post }}</td>
                                <td><img src="{!! !empty($post->url_image) ? $post->url_image : secure_asset('frontend/img/image_default.jpg') !!}" alt="" width="150" height="100"></td>
                                <td>{{ $post->description }}</td>
                                <td>{{ getStatus($post->status) }}</td>
                                <td>
                                    @can('update', $post)
                                        <a href="{{route('posts.edit', $post->id)}}" class="btn btn-xs btn-success mg-t-5"><i class="fa fa-edit"></i></a>
                                    @endcan
                                    @can('delete', $post)
                                        @if($post->status != \App\Helpers\Constant::STATUS_DELETED)
                                            <a href="{{route('posts.delete', $post->id)}}"  class="btn btn-xs btn-danger option-delete-modal mg-l-5 mg-t-5"><i class="fa fa-trash"></i></a>
                                        @endif
                                    @endcan
                                    @can('restore', $post)
                                        @if($post->status == \App\Helpers\Constant::STATUS_DELETED)
                                            <a href="{{route('posts.restore', $post->id)}}"  class="btn btn-xs btn-danger option-restore-modal mg-l-5 mg-t-5"><i class="fa fa-refresh"></i></a>
                                        @endif
                                    @endcan
                                </td>
                            </tr>
                            @php $i++ @endphp
                        @endforeach
                    </tbody>
                    <tr>
                        <td colspan="7">
                            {!! renderPaginate($posts, $query = '') !!}
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
