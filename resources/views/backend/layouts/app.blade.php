<!DOCTYPE html>
<html style="height: auto; min-height: 100%;">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title-admin', 'Admin')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{!! secure_asset('backend/dist/img/avatar5.png')!!}" />
    <link rel="stylesheet" href="{!! secure_asset('backend/bower_components/bootstrap/dist/css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="{!! secure_asset('backend/font-awesome/css/font-awesome.min.css') !!}">
    <link rel="stylesheet" href="{!! secure_asset('backend/bower_components/Ionicons/css/ionicons.min.css') !!}">
    <link rel="stylesheet" href="{!! secure_asset('backend/dist/css/AdminLTE.css') !!}">
    <link rel="stylesheet" href="{!! secure_asset('backend/dist/css/skins/_all-skins.min.css') !!}">
    <link rel="stylesheet" href="{!! secure_asset('backend/plugins/iCheck/flat/blue.css') !!}">
    <link rel="stylesheet" href="{!! secure_asset('backend/plugins/jquery-confirm/dist/jquery-confirm.min.css') !!}">
    <link rel="stylesheet" href="{!! secure_asset('backend/css/margin_padding_style.css') !!}">
    <link rel="stylesheet" href="{!! secure_asset('backend/css/main_style.css') !!}">
    <link rel="stylesheet" href="{!! secure_asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css') !!}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script src="{!! secure_asset('backend/ckeditor/ckeditor.js') !!}"></script>
    <script src="{!! secure_asset('backend/ckfinder/ckfinder.js') !!}"></script>
    <script src="{!! secure_asset('backend/js/func_ckfinder.js') !!}"></script>
    <script>
        var baseURL = "{!! url('/')!!}"
    </script>
    @yield('style')
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        @include('backend.templates.int_message')
        <header class="main-header">
            @include('backend.templates.int_header')
        </header>

        <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
            @include('backend.templates.int_sidebar')
        </aside>

        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="min-height: 612px;">
            @yield('main-content')
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.1.0
            </div>
            <strong>Copyright &copy; Snow</strong>
        </footer>
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->
    <script src="{!! secure_asset('backend/bower_components/jquery/dist/jquery.min.js') !!}"></script>
    <script src="{!! secure_asset('backend/bower_components/bootstrap/dist/js/bootstrap.min.js') !!}"></script>
    <script src="{!! secure_asset('backend/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') !!}"></script>
    <script src="{!! secure_asset('backend/bower_components/fastclick/lib/fastclick.js') !!}"></script>
    <script src="{!! secure_asset('backend/dist/js/adminlte.js') !!}"></script>
    <script src="{!! secure_asset('backend/plugins/iCheck/icheck.min.js') !!}"></script>
    <script src="{!! secure_asset('backend/js/checkbox.js') !!}"></script>
    <script src="{!! secure_asset('backend/dist/js/demo.js') !!}"></script>
    <script src="{!! secure_asset('backend/plugins/jquery-confirm/dist/jquery-confirm.min.js') !!}"></script>
    <script src="{!! secure_asset('backend/js/setting_js_datatable.js') !!}"></script>
    <script src="{!! secure_asset('backend/js/main.js') !!}"></script>
    <script src="{!! secure_asset('backend/plugins/datatables/jquery.dataTables.js') !!}"></script>
    <script src="{!! secure_asset('backend/js/datatables-config.js') !!}"></script>
    <script src="{!! secure_asset('backend/js/jquery-sortable.js') !!}"></script>
    @yield('script')
    <style>
        @media only screen and (max-width: 768px) {
            .content .box-body table {
                min-width: 680px;
            }
        }
    </style>
</body>
</html>
