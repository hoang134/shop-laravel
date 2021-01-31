<form class="form-horizontal" action="" method="POST">
    <div class="col-md-12">
        <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }} ">
            <label for="name" class="control-label default">@lang('labels.category.name')<sup class="title-sup">(*)</sup></label>
            <input id="name" type="text" class="form-control"  placeholder="@lang('labels.category.name')" name="name" value="{{old('name', isset($category->name) ? $category->name : '')}}">
            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('name') }}</p></span>
        </div>

        <div class="form-group {{ $errors->first('parent_id') ? 'has-error' : '' }} ">
            <label for="parent_id" class="control-label default">@lang('labels.category.parent')</label>
            <select id="parent_id" class="form-control" name="parent_id">
                <option
                    value="{{ Constant::ROOT_CATEGORY }}"
                    {{old('parent_id', isset($category->parent_id) ? $category->parent_id : Constant::ROOT_CATEGORY) === Constant::ROOT_CATEGORY ? 'selected' : ''}}
                >@lang('labels.category.default_option')</option>
                @foreach($parentCats as $cat)
                    <option
                        value="{{ $cat->id }}"
                        {{old('parent_id', isset($category->parent_id) ? $category->parent_id : Constant::ROOT_CATEGORY) === $cat->id ? 'selected' : ''}}
                    >{{ $cat->name}}</option>
                @endforeach
            </select>
            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('parent_id') }}</p></span>
        </div>

        <div class="form-group {{ $errors->first('description') ? 'has-error' : '' }} ">
            <label for="description" class="control-label default">@lang('labels.category.description')</label>
            <textarea rows="5" id="description" type="text" class="form-control"
                placeholder="@lang('labels.category.description')" name="description"
            >{{old('description', isset($category->description) ? $category->description : '')}}</textarea>
            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('description') }}</p></span>
        </div>

        <div class="form-group {{ $errors->first('show_home') ? 'has-error' : '' }} ">
            <label class="control-label default">@lang('labels.category.home')</label>
            <div class="radio">
                <label for="home_active" class="col-md-2">
                    <input
                        id="home_active"
                        value="{{Constant::STATUS_ACTIVE}}"
                        {{old('show_home', isset($category->show_home) ? $category->show_home : Constant::STATUS_ACTIVE) === Constant::STATUS_ACTIVE ? 'checked' : ''}}
                        name="show_home"
                        type="radio"
                    >@lang('labels.category.home_active')
                </label>
                <label for="home_inactive" class="col-md-2">
                    <input
                        id="home_inactive"
                        value="{{Constant::STATUS_INACTIVE}}"
                        {{old('show_home', isset($category->show_home) ? $category->show_home : Constant::STATUS_ACTIVE) === Constant::STATUS_INACTIVE ? 'checked' : ''}}
                        name="show_home"
                        type="radio"
                    >@lang('labels.category.home_inactive')
                </label>
            </div>
            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('show_home') }}</p></span>
        </div>

        <div class="form-group {{ $errors->first('status') ? 'has-error' : '' }} ">
            <label class="control-label default">@lang('labels.general.status')</label>
            <div class="radio">
                <label for="status_active" class="col-md-2">
                    <input
                        id="status_active"
                        value="{{Constant::STATUS_ACTIVE}}"
                        {{old('status', isset($category->status) ? $category->status : Constant::STATUS_ACTIVE) === Constant::STATUS_ACTIVE ? 'checked' : ''}}
                        name="status"
                        type="radio"
                    >@lang('labels.general.status_active')
                </label>
                <label for="status_inactive" class="col-md-2">
                    <input
                        id="status_inactive"
                        value="{{Constant::STATUS_INACTIVE}}"
                        {{old('status', isset($category->status) ? $category->status : Constant::STATUS_ACTIVE) === Constant::STATUS_INACTIVE ? 'checked' : ''}}
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
                <a href="{{ route('categories.index') }}"  class="btn btn-danger with-btn mg-r-5"><i class="fa fa-fw fa-reply-all"></i>@lang('labels.general.back')</a>
                <button type="submit" class="btn btn-primary with-btn"><i class="fa fa-save"></i> @lang('labels.general.save')</button>
            </div>
        </div>
    </div>
</form>
