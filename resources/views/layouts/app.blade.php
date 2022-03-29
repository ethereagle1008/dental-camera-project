<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <link rel="stylesheet" href="{{asset('/')}}css/bootstrap.min.css">
        <link rel="stylesheet" href="{{asset('/')}}vendor/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="{{asset('/')}}vendor/simple-line-icons/css/simple-line-icons.min.css">
        <link href="{{asset('/')}}plugins/global/plugins.bundlef552.css?v=7.1.8" rel="stylesheet" type="text/css"/>
        <link href="{{asset('/')}}plugins/custom/prismjs/prismjs.bundlef552.css?v=7.1.8" rel="stylesheet" type="text/css"/>
        <link href="{{asset('/')}}css/style.bundlef552.css?v=7.1.8" rel="stylesheet" type="text/css"/>
        <link href="{{asset('/')}}css/themes/layout/header/base/lightf552.css?v=7.1.8"
              rel="stylesheet" type="text/css"/>
        <link href="{{asset('/')}}css/themes/layout/header/menu/lightf552.css?v=7.1.8"
              rel="stylesheet" type="text/css"/>
        <link href="{{asset('/')}}css/themes/layout/brand/darkf552.css?v=7.1.8" rel="stylesheet"
              type="text/css"/>
        <link href="{{asset('/')}}css/themes/layout/aside/darkf552.css?v=7.1.8" rel="stylesheet"
              type="text/css"/>
        <link rel="stylesheet" href="{{asset('/')}}css/theme.css">
        <link rel="stylesheet" href="{{asset('/')}}css/theme-elements.css">
        <link rel="stylesheet" href="{{asset('/')}}css/theme-blog.css">
        <link rel="stylesheet" href="{{asset('/')}}css/theme-shop.css">
        <link rel="stylesheet" href="{{asset('/')}}css/default.css">
        <link rel="stylesheet" href="{{asset('/')}}css/custom.css">

        <style>
            .header-effect-shrink{
                height: 50px !important;
            }
        </style>

        <script src="{{asset('/')}}js/jquery.min.js"></script>
        <script src="{{asset('/')}}js/jquery.appear.min.js"></script>
        <script src="{{asset('/')}}js/jquery.easing.min.js"></script>
        <script src="{{asset('/')}}js/jquery.cookie.min.js"></script>
    </head>
    <body class="font-sans antialiased">
        @include('layouts.header')
        <div role="main" class="main mt-4">
            {{ $slot }}
        </div>

        <script src="{{asset('/')}}vendor/calendar/moment.js"></script>
        <script src="{{asset('/')}}js/popper.min.js"></script>
        <script src="{{asset('/')}}js/bootstrap.min.js"></script>
        <script src="{{asset('/')}}js/common.min.js"></script>
        <script src="{{asset('/')}}js/jquery.validate.min.js"></script>
        <script src="{{asset('/')}}js/jquery.easypiechart.min.js"></script>
        <script src="{{asset('/')}}js/jquery.gmap.min.js"></script>
        <script src="{{asset('/')}}js/owl.carousel.min.js"></script>
        <script src="{{asset('/')}}js/theme.js"></script>
        <script src="{{asset('/')}}js/theme.init.js"></script>
        <script src="{{asset('/')}}plugins/global/plugins.bundlef552.js?v=7.1.8"></script>
        <script src="{{asset('/')}}plugins/custom/prismjs/prismjs.bundlef552.js?v=7.1.8"></script>
{{--        <script src="{{asset('/')}}js/scripts.bundlef552.js?v=7.1.8"></script>--}}
        <!--end::Global Theme Bundle-->
        <!--begin::Page Scripts(used by this page)-->
        <script src="{{asset('/')}}js/pages/features/miscellaneous/sweetalert2f552.js?v=7.1.8"></script>
        <script>
            let token = '{{csrf_token()}}';
            $(document).ready(function() {
                var interval = setInterval(function() {
                    var momentNow = moment();
                    $('#current_time').html(momentNow.format('hh:mm'));
                }, 100);
            });
        </script>
    </body>
</html>
