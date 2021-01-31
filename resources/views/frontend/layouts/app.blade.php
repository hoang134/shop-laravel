<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title-frontend', 'Đồ gia dụng')</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('public/frontend/img/core-img/favicon.ico')}}">
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{!! asset('frontend/css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/font-awesome/css/font-awesome.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/css/toastr.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/style.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/main.css') !!}">
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v8.0&appId=341743773458266&autoLogAppEvents=1" nonce="7m2YsU7X"></script>
</head>

<body>
<!-- ##### Header Area Start ##### -->
@include('frontend.templates.int_header')
<!-- ##### Header Area End ##### -->

<div class="content-wrapper">
    @yield('main-content')
</div>

<!-- ##### Footer Area Start ##### -->
@include('frontend.templates.int_footer')
<!-- ##### Footer Area Start ##### -->

<div class="overlay zoom-image"></div>
<!-- ##### Footer Area Start ##### -->

<!-- ##### All Javascript Files ##### -->
<!-- jQuery-2.2.4 js -->
<script src="{{ asset('frontend/js/jquery/jquery-2.2.4.min.js') }}"></script>
<!-- Popper js -->
<script src="{{ asset('frontend/js/bootstrap/popper.min.js') }}"></script>
<!-- Bootstrap js -->
<script src="{{ asset('frontend/js/bootstrap/bootstrap.min.js') }}"></script>
<!-- All Plugins js -->
<script src="{{ asset('frontend/js/plugins/plugins.js') }}"></script>
<!-- toastr js -->
<script src="{{ asset('frontend/js/plugins/toastr.min.js') }}"></script>
<!-- Active js -->
<script src="{{ asset('frontend/js/active.js') }}"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    var add_to_cart = '{{ route('orders.add-to-cart') }}';
</script>
<script src="{{ asset('frontend/js/main.js') }}"></script>
@yield('script')
</body>

</html>
