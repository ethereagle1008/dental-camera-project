<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
<head>
    <meta charset="utf-8"/>
    <title>山大企画</title>
    <meta name="description"
          content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <!--end::Fonts-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{asset('/')}}plugins/global/plugins.bundlef552.css?v=7.1.8" rel="stylesheet" type="text/css"/>
    <link href="{{asset('/')}}plugins/custom/prismjs/prismjs.bundlef552.css?v=7.1.8" rel="stylesheet" type="text/css"/>
    <link href="{{asset('/')}}css/style.bundlef552.css?v=7.1.8" rel="stylesheet" type="text/css"/>
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="{{asset('/')}}css/themes/layout/header/base/lightf552.css?v=7.1.8" rel="stylesheet" type="text/css"/>
    <link href="{{asset('/')}}css/themes/layout/header/menu/lightf552.css?v=7.1.8" rel="stylesheet" type="text/css"/>
    <link href="{{asset('/')}}css/themes/layout/brand/darkf552.css?v=7.1.8" rel="stylesheet" type="text/css"/>
    <link href="{{asset('/')}}css/themes/layout/aside/darkf552.css?v=7.1.8" rel="stylesheet" type="text/css"/>
    <!--end::Layout Themes-->
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{asset('/')}}plugins/custom/fullcalendar/fullcalendar.bundlef552.css?v=7.1.8" rel="stylesheet" type="text/css"/>
    <!--end::Page Vendors Styles-->

    <script src="{{asset('/')}}js/jquery.min.js"></script>
    <script src="{{asset('/')}}js/jquery.appear.min.js"></script>
    <script src="{{asset('/')}}js/jquery.easing.min.js"></script>
    <script src="{{asset('/')}}js/jquery.cookie.min.js"></script>
    <script src="{{ asset('js/jquery.validate.js') }}"></script>
</head>
<!--begin::Body-->
<body id="kt_body"
      class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP" height="0" width="0"
            style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<!--begin::Main-->
<!--begin::Header Mobile-->
@include('admin.layouts.mobile-header')
<!--end::Header Mobile-->

<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">
        <!--begin::Aside-->
        @include('admin.layouts.navbar')
        <!--end::Aside-->
        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            <!--begin::Header-->
            @include('admin.layouts.header')
            <!--end::Header-->
            <!--begin::Content-->
            {{ $slot }}
            <!--end::Content-->
            <!--begin::Footer-->
            @include('admin.layouts.footer')
            <!--end::Footer-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Main-->

<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
<!--begin::Global Config(global config for global JS scripts)-->
<script>
    var KTAppSettings = {
        "breakpoints": {"sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400},
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#3699FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#E4E6EF",
                    "dark": "#181C32"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1F0FF",
                    "secondary": "#EBEDF3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#3F4254",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#EBEDF3",
                "gray-300": "#E4E6EF",
                "gray-400": "#D1D3E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#7E8299",
                "gray-700": "#5E6278",
                "gray-800": "#3F4254",
                "gray-900": "#181C32"
            }
        },
        "font-family": "Poppins"
    };
</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{asset('/')}}plugins/global/plugins.bundlef552.js?v=7.1.8"></script>
<script src="{{asset('/')}}plugins/custom/prismjs/prismjs.bundlef552.js?v=7.1.8"></script>
<script src="{{asset('/')}}js/scripts.bundlef552.js?v=7.1.8"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Vendors(used by this page)-->
<script src="{{asset('/')}}plugins/custom/fullcalendar/fullcalendar.bundlef552.js?v=7.1.8"></script>
<script src="{{asset('/')}}js/list-datatablef552.js?v=7.1.8"></script>
{{--<script src="{{asset('/')}}js/add-userf552.js?v=7.1.8"></script>--}}
<script src="{{asset('/')}}plugins/custom/datatables/datatables.bundlef552.js?v=7.1.8"></script>
<script src="{{asset('/')}}js/basicf552.js?v=7.1.8"></script>
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
<script src="{{asset('/')}}js/widgetsf552.js?v=7.1.8"></script>
<!--end::Page Scripts-->
<script src="{{asset('/')}}js/admin.js"></script>
<script>
    let token = '{{csrf_token()}}';
</script>
</body>
</html>
