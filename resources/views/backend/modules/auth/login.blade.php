<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title-admin','Admin')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" type="image/x-icon" href="{!! secure_asset('backend/dist/img/avatar5.png')!!}" />
    <link rel="stylesheet" href="{!! secure_asset('backend/css/all.min.css?v='.randString(18)) !!}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">{{ __('labels.login.index') }}</p>

        @if (Session::has('danger') && ($message = Session::get('danger')))
            <div class="alert alert-danger alert-dismissible">
                <p><i class="icon fa fa-ban"></i>{!! $message !!}</p>
            </div>
        @endif

        <form action="" method="POST">
            <div class="form-group has-feedback {{ $errors->first('username') ? 'has-error' : '' }}">
                <input type="text" name="username" class="form-control" placeholder="{{ __('labels.login.username') }}">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('username') }}</p></span>
            </div>
            <div class="form-group has-feedback {{ $errors->first('password') ? 'has-error' : '' }}">
                <input type="password" name="password" class="form-control" placeholder="{{ __('labels.login.password') }}">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('password') }}</p></span>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-6 margin-auto-div">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('labels.login.btn.login') }}</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <!-- /.social-auth-links -->
        <div class="row">
            <div class="col-sm-12 mg-t-20">
            </div>
        </div>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<script src="{!! secure_asset('backend/bower_components/jquery/dist/jquery.min.js') !!}"></script>
<script>
    setTimeout(function(){
        jQuery('.alert').slideUp(2000);
    }, 3000);
</script>
</body>
</html>
