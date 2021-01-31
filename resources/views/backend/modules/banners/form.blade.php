<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
    <div class="col-md-12">
        <div class="form-group {{ $errors->first('title') ? 'has-error' : '' }} ">
            <label for="title" class="control-label default">@lang('labels.post.title')<sup class="title-sup">(*)</sup></label>
            <input id="title" type="text" class="form-control"  placeholder="@lang('labels.post.title')" name="title" value="{{old('title', isset($banner->title) ? $banner->title : '')}}">
            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('title') }}</p></span>
        </div>

        <div class="form-group {{ $errors->first('url_link') ? 'has-error' : '' }} ">
            <label for="title" class="control-label default">@lang('labels.banner.url_link')</label>
            <input id="title" type="text" class="form-control"  placeholder="@lang('labels.banner.url_link')" name="url_link" value="{{old('url_link', isset($banner->url_link) ? $banner->url_link : '')}}">
            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('url_link') }}</p></span>
        </div>

        <div class="form-group {{ $errors->first('url_image') ? 'has-error' : '' }} ">
            <label for="image" class=" control-label default">@lang('labels.post.image')<sup class="title-sup">(*)</sup></label>
            <input type="file" id="image" class="form-control" name="url_image">
            @if(isset($banner->url_image))
                <img src="{{ $banner->url_image }}" alt="" width="100px" style="margin-top: 0.1em">
            @endif
            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('image') }}</p></span>
        </div>

        <div class="form-group {{ $errors->first('position') ? 'has-error' : '' }} ">
            <label for="title" class="control-label default">@lang('labels.banner.position')<sup class="title-sup">(*)</sup></label>
            <select class="form-control" name="position">
                <option value="{{ Constant::POSITION_SLIDER }}" {{ isset($banner->position) ? $banner->position == Constant::POSITION_SLIDER ? 'selected' : '' : '' }}>{{__('labels.banner.slider')}}</option>
                <option value="{{ Constant::POSITION_BANNER }}" {{ isset($banner->position) ? $banner->position == Constant::POSITION_BANNER ? 'selected' : '' : '' }}>{{__('labels.banner.label')}}</option>
            </select>
            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('position') }}</p></span>
        </div>

        <div class="form-group {{ $errors->first('status') ? 'has-error' : '' }} ">
            <label class="control-label default">@lang('labels.general.status')</label>
            <div class="radio">
                <label for="status_active" class="col-md-2">
                    <input
                        id="status_active"
                        value="{{Constant::STATUS_ACTIVE}}"
                        {{old('status', isset($banner->status) ? $banner->status : Constant::STATUS_ACTIVE) === Constant::STATUS_ACTIVE ? 'checked' : ''}}
                        name="status"
                        type="radio"
                    >@lang('labels.general.status_active')
                </label>
                <label for="status_inactive" class="col-md-2">
                    <input
                        id="status_inactive"
                        value="{{Constant::STATUS_ACTIVE}}"
                        {{old('status', isset($banner->status) ? $banner->status : Constant::STATUS_ACTIVE) === Constant::STATUS_INACTIVE ? 'checked' : ''}}
                        name="status"
                        type="radio"
                    >@lang('labels.general.status_inactive')
                </label>
            </div>
            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('status') }}</p></span>
        </div>

    </div>

    <div class="col-md-12">
        <div class="form-group">
            <div class="col-sm-12 text-center">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <a href="{{ route('banners.index') }}"  class="btn btn-danger with-btn mg-r-5"><i class="fa fa-fw fa-reply-all"></i>@lang('labels.general.back')</a>
                <button type="submit" class="btn btn-primary with-btn"><i class="fa fa-save"></i> @lang('labels.general.save')</button>
            </div>
        </div>
    </div>
</form>
