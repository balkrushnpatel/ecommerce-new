<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    @if(Request::is('/') || Request::is('home'))
        <title>Welcome To {{ getSetting('system_title') }}</title> 
    @else
	   <title>@yield('title') | {{ getSetting('system_title') }}</title> 
    @endif
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Wolmart eCommmerce Marketplace HTML Template">
    <meta name="author" content="D-THEMES">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('uploads/favicon/'.getSetting('favicon_image')) }}">

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

    @if(!empty(request()->segment(1)))
        <link rel="stylesheet" type="text/css" href="{{ asset('user/css/style.min.css') }}"> 
    @else
        <link rel="stylesheet" type="text/css" href="{{ asset('user/css/demo1.min.css') }}">
    @endif
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/jquery-ui.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/custom.css') }}">
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
    @stack('stylesheets')
</head> 
@php
    $class = 'home';
    if(Request::is('about-us')){
        $class = 'about-us';
    }
    if(Request::is('user/my-account')){
        $class = 'my-account';
    }
     if(Request::is('product/compare')){
        $class = 'compare-page';
    }
@endphp
<body class="{{ $class }}">
    <div class="page-wrapper">
 		@include('layouts.userpartials.header')  
	 	<main class="main"> 
	    	@yield('content')
	    </main>
	    @include('layouts.userpartials.footer') 
	</div>
	@include('layouts.userpartials.sticty-footer') 
	@include('layouts.userpartials.mobile-menu') 
	@include('layouts.userpartials.product-popup') 
	@include('layouts.userpartials.footer-script') 
     @stack('scripts')
</body>
</html>
