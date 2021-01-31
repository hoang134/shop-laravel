<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
    <div class="col-md-12">
        <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }} ">
            <label for="name" class="control-label default">@lang('labels.user.name')<sup class="text-danger">(*)</sup></label>
            <input id="name" type="text" class="form-control"  placeholder="@lang('labels.user.name')" name="name" value="{{old('name', isset($user->name) ? $user->name : '')}}">
            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('name') }}</p></span>
        </div>

        <div class="form-group {{ $errors->first('username') ? 'has-error' : '' }} ">
            <label for="username" class="control-label default">@lang('labels.user.username')<sup class="text-danger">(*)</sup></label>
            <input id="username" type="text" class="form-control"  placeholder="@lang('labels.user.username')" name="username" value="{{old('username', isset($user->username) ? $user->username : '')}}">
            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('username') }}</p></span>
        </div>

        <div class="form-group {{ $errors->first('email') ? 'has-error' : '' }} ">
            <label for="email" class="control-label default">@lang('labels.user.email')<sup class="text-danger">(*)</sup></label>
            <input id="email" type="email" class="form-control"  placeholder="@lang('labels.user.email')" name="email" value="{{old('email', isset($user->email) ? $user->email : '')}}">
            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('email') }}</p></span>
        </div>

        <div class="form-group {{ $errors->first('password') ? 'has-error' : '' }} ">
            <label for="password" class="control-label default">@lang('labels.user.password')@if(!isset($user))<sup class="text-danger">(*)</sup>@endif</label>
            <input id="password" type="{{ isset($user) ? 'hidden' : 'password' }}" class="form-control"  placeholder="@lang('labels.user.password')" name="password" {{ isset($user) ? 'disabled' : '' }}>
            @if(isset($user))
                <button id="changePassword" class="btn btn-success" type="button">@lang('labels.user.change_password')</button>
            @endif
            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('password') }}</p></span>
        </div>

    </div>

    <div class="col-md-12">
        <div class="form-group">
            <div class="col-sm-12 text-center">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @if(isset($user))
                    <input type="hidden" name="password_check" value="1">
                @endif
                <a href="{{ route('users.index') }}"  class="btn btn-danger with-btn mg-r-5"><i class="fa fa-fw fa-reply-all"></i>@lang('labels.general.back')</a>
                <button type="submit" class="btn btn-primary with-btn"><i class="fa fa-save"></i> @lang('labels.general.save')</button>
            </div>
        </div>
    </div>
</form>
