<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
    <div class="col-md-12">
        <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }} ">
            <label for="name" class="control-label default">@lang('labels.menu.name')<sup class="title-sup">(*)</sup></label>
            <input id="name" type="text" class="form-control"  placeholder="@lang('labels.menu.name')" name="name" value="{{old('name', isset($menu->name) ? $menu->name : '')}}">
            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('name') }}</p></span>
        </div>

        <div class="form-group {{ $errors->first('url_menu') ? 'has-error' : '' }} ">
            <label for="url_menu" class="control-label default">@lang('labels.menu.url_menu')</label>
            <input id="url_menu" type="text" class="form-control"  placeholder="@lang('labels.menu.url_menu')" name="url_menu" value="{{old('url_menu', isset($menu->url_menu) ? $menu->url_menu : '')}}">
            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('url_menu') }}</p></span>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <div class="col-sm-12 text-center">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <a href="{{ route('menus.index') }}"  class="btn btn-danger with-btn mg-r-5"><i class="fa fa-fw fa-reply-all"></i>@lang('labels.general.back')</a>
                <button type="submit" class="btn btn-primary with-btn"><i class="fa fa-save"></i> @lang('labels.general.save')</button>
            </div>
        </div>
    </div>
</form>
