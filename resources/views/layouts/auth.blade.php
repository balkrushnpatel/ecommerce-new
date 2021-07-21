<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>@yield('title') | {{ getSetting('system_title') }}</title> 
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Wolmart eCommmerce Marketplace HTML Template">
    <meta name="author" content="D-THEMES">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('user/images/icons/favicon.png') }}">

    <link rel="preload" href="{{ asset('user/vendor/fontawesome-free/webfonts/fa-regular-400.woff2') }}" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="{{ asset('user/vendor/fontawesome-free/webfonts/fa-solid-900.woff2') }}" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="{{ asset('user/vendor/fontawesome-free/webfonts/fa-brands-400.woff2') }}" as="font" type="font/woff2"
            crossorigin="anonymous">
    <link rel="preload" href="{{ asset('user/fonts/wolmart87d5.ttf?png09e') }}" as="font" type="font/ttf" crossorigin="anonymous">

    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('user/vendor/fontawesome-free/css/all.min.css') }}">

    <!-- Plugins CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('user/vendor/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/vendor/animate/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/vendor/magnific-popup/magnific-popup.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/vendor/nouislider/nouislider.min.css') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> 
 
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/style.min.css') }}"> 
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/jquery-ui.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/custom.css') }}">
</head>  
<body>
    <div class="page-wrapper"> 
        <main class="main"> 
            @yield('content')
        </main>
    </div>  
    <script>
        var HOST_URL = "/";
        var APP_URL = "{{ url('/') }}"; 
        window.addEventListener('load',function() {         
            setTimeout(function() {
               $('#alert-message').fadeOut('slow');
            }, 3000);
        });
    </script>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
    <!--end::Global Config-->
    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js')}}"></script>
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/select2.js')}}"></script>
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script> 
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>  
    <script src="{{ asset('assets/js/pages/features/miscellaneous/toastr.js?v=7.2.8')}}"></script>  
    <script src="{{ asset('assets/js/custom.js')}}"></script> 
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.2.0/js/bootstrap-colorpicker.js"></script>
     <script src="{{ asset('assets/js/pages/custom/wizard/wizard-3.js')}}"></script>
     <script src="{{ asset('assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js')}}"></script>
     <script src="{{ asset('assets/js/pages/crud/forms/editors/ckeditor-classic.js')}}"></script>
     <script src="{{ asset('assets/js/pages/crud/forms/widgets/tagify.js')}}"></script>
     <script src="{{ asset('assets/js/pages/widgets.js')}}"></script>
     <script src="{{ asset('assets/js/pages/custom/profile/profile.js')}}"></script>

    <!--end::Global Theme Bundle--> 
</body>
</html>
