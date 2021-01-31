@extends('backend.layouts.app')
@section('title-admin', __('labels.setting.label'))
@section('main-content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('labels.setting.label')</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home.index')}}"><i class="fa fa-dashboard"></i>@lang('labels.general.home')</a></li>
            <li><a href="{{ route('settings.index') }}">@lang('labels.setting.label')</a></li>
        </ol>
    </section>
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-body">
                <div class="col-md-12 mg-t-10">
                    <form class="form-horizontal" action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group {{ $errors->first('logo') ? 'has-error' : '' }} ">
                                            <label for="inputEmail3" class=" control-label default">{{ __('labels.setting.logo') }}</label>
                                            <input type="file" id="logo" class="form-control" name="logo">
                                            @if(!empty($setting->logo))
                                                <img src="{{ $setting->logo }}" alt="" width="100px" style="margin-top: 0.1em">
                                            @endif

                                            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('logo') }}</p></span>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-5">
                                        <div class="form-group {{ $errors->first('logo_mobile') ? 'has-error' : '' }} ">
                                            <label for="inputEmail3" class=" control-label default">{{ __('labels.setting.logo_mobile') }}</label>
                                            <input type="file" id="logo_mobile" class="form-control" name="logo_mobile">
                                            @if(!empty($setting->logo_mobile))
                                                <img src="{{ $setting->logo_mobile }}" alt="" width="100px" style="margin-top: 0.1em">
                                            @endif

                                            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('logo') }}</p></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->first('company') ? 'has-error' : '' }} ">
                                    <label for="inputEmail3" class=" control-label default">{{ __('labels.setting.company') }}</label>
                                    <input name="company" id="company" class="form-control" value="{{old('company', isset($setting->company) ? $setting->company : '')}}" />
                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('company') }}</p></span>
                                </div>

                                <div class="form-group {{ $errors->first('address') ? 'has-error' : '' }} ">
                                    <label for="inputEmail3" class=" control-label default">{{ __('labels.setting.address') }}</label>
                                    <input name="address" id="address" class="form-control" value="{{old('address', isset($setting->address) ? $setting->address : '')}}" />
                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('address') }}</p></span>
                                </div>

                                <div class="form-group {{ $errors->first('hotline') ? 'has-error' : '' }} ">
                                    <label for="inputEmail3" class=" control-label default">{{ __('labels.setting.hotline') }}</label>
                                    <input name="hotline" id="hotline" class="form-control" value="{{old('hotline', isset($setting->hotline) ? $setting->hotline : '')}}" />
                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('hotline') }}</p></span>
                                </div>

                                <div class="form-group {{ $errors->first('phone') ? 'has-error' : '' }} ">
                                    <label for="inputEmail3" class=" control-label default">{{ __('labels.setting.phone') }}</label>
                                    <input name="phone" id="phone" class="form-control" value="{{old('phone', isset($setting->phone) ? $setting->phone : '')}}" />
                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('phone') }}</p></span>
                                </div>

                                <div class="form-group {{ $errors->first('email') ? 'has-error' : '' }} ">
                                    <label for="inputEmail3" class=" control-label default">{{ __('labels.setting.email') }}</label>
                                    <input name="email" id="email" class="form-control" value="{{old('email', isset($setting->email) ? $setting->email : '')}}" />
                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('email') }}</p></span>
                                </div>

                                <div class="form-group {{ $errors->first('facebook_url') ? 'has-error' : '' }} ">
                                    <label for="inputEmail3" class=" control-label default">{{ __('labels.setting.facebook_url') }}</label>
                                    <input name="facebook_url" id="facebook_url" class="form-control" value="{{old('facebook_url', isset($setting->facebook_url) ? $setting->facebook_url : '')}}" />
                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('facebook_url') }}</p></span>
                                </div>

                                <div class="form-group {{ $errors->first('information_services') ? 'has-error' : '' }} ">
                                    <label for="inputEmail3" class=" control-label default">{{ __('labels.setting.information_services') }}</label>
                                    <textarea name="information_services" id="information_services" class="form-control" cols="30" rows="10">{{old('information_services', isset($setting->information_services) ? $setting->information_services : '')}}</textarea>
                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('information_services') }}</p></span>
                                    <script>
                                        ckeditor(information_services);
                                    </script>
                                </div>

                                <div class="form-group {{ $errors->first('information_bank') ? 'has-error' : '' }} ">
                                    <label for="inputEmail3" class=" control-label default">{{ __('labels.setting.information_bank') }}</label>
                                    <textarea name="information_bank" id="information_bank" class="form-control" cols="30" rows="10">{{old('information_bank', isset($setting->information_bank) ? $setting->information_bank : '')}}</textarea>
                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('information_bank') }}</p></span>
                                    <script>
                                        ckeditor(information_bank);
                                    </script>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-sm-12 text-center">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <a href="{{ route('home.index') }}"  class="btn btn-danger with-btn mg-r-5"><i class="fa fa-fw fa-reply-all"></i>@lang('labels.general.back')</a>
                                        <button type="submit" class="btn btn-primary with-btn"><i class="fa fa-save"></i> @lang('labels.general.save') </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- /.box -->
    </section>
@endsection
