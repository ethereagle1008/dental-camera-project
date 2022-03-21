<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="loading semi-dark-layout" data-layout="semi-dark-layout" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <title>山大企画</title>
    <link rel="apple-touch-icon" href="{{asset('/')}}images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/')}}images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}vendors/css/extensions/toastr.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}css/colors.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}css/components.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}css/pages/dashboard-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}css/plugins/charts/chart-apex.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}css/plugins/extensions/ext-component-toastr.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}css/style.css">
    <!-- END: Custom CSS-->
</head>
<!--begin::Body-->
<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

<!--begin::Main-->
<!--begin::Header-->
@include('admin.layouts.header')
<!--end::Header-->

<!--begin::Main Menu-->
@include('admin.layouts.navbar')

<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            {{ $slot }}
        </div>
    </div>
</div>
<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

@include('admin.layouts.footer')

<!-- BEGIN: Vendor JS-->
<script src="{{asset('/')}}vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('/')}}vendors/js/charts/apexcharts.min.js"></script>
<script src="{{asset('/')}}vendors/js/extensions/toastr.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('/')}}js/core/app-menu.js"></script>
<script src="{{asset('/')}}js/core/app.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{asset('/')}}js/scripts/pages/dashboard-ecommerce.js"></script>
<!-- END: Page JS-->

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>
</body>
<!-- END: Body-->

</html>
