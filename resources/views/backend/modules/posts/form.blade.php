<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
    <div class="col-md-12">
        <div class="form-group {{ $errors->first('title') ? 'has-error' : '' }} ">
            <label for="title" class="control-label default">@lang('labels.post.title')<sup class="title-sup">(*)</sup></label>
            <input id="title" type="text" class="form-control"  placeholder="@lang('labels.post.title')" name="title" value="{{old('title', isset($post->title) ? $post->title : '')}}">
            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('title') }}</p></span>
        </div>

        <div class="form-group {{ $errors->first('url_image') ? 'has-error' : '' }} ">
            <label for="image" class=" control-label default">@lang('labels.post.image')</label>
            <input type="file" id="image" class="form-control" name="url_image">
            @if(isset($post->url_image))
                <img src="{{ $post->url_image }}" alt="" width="100px" style="margin-top: 0.1em">
            @endif
            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('image') }}</p></span>
        </div>

        <div class="form-group {{ $errors->first('description') ? 'has-error' : '' }} ">
            <label for="description" class="control-label default">@lang('labels.post.description')</label>
            <textarea rows="5" id="description" type="text" class="form-control"
                      placeholder="@lang('labels.post.description')" name="description"
            >{{old('description', isset($post->description) ? $post->description : '')}}</textarea>
            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('description') }}</p></span>
        </div>

        <div class="form-group {{ $errors->first('content') ? 'has-error' : '' }}">
            <label for="content" class="control-label ">@lang('labels.post.content')</label>
            <textarea name="content" style="resize:vertical" class="form-control" id="content">{{ old('content', isset($post->content) ? $post->content : '') }}</textarea>
            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('content') }}</p></span>
            <script>
                ckeditor(content);
            </script>
        </div>

    </div>

    <div class="col-md-12">
        <div class="form-group">
            <div class="col-sm-12 text-center">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <a href="{{ route('posts.index') }}"  class="btn btn-danger with-btn mg-r-5"><i class="fa fa-fw fa-reply-all"></i>@lang('labels.general.back')</a>
                <button type="submit" class="btn btn-primary with-btn"><i class="fa fa-save"></i> @lang('labels.general.save')</button>
            </div>
        </div>
    </div>
</form>
