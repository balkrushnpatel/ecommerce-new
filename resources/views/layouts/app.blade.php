0<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.partials.head')
    @stack('stylesheets')
</head>
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading"> 
    @include('layouts.partials.header-mobile') 
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">
            @include('layouts.partials.sidebar') 
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                @include('layouts.partials.header') 
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content"> 
                    <div class="container">
                       <p>@include('partials._flash')</p>
                    </div>
                    @yield('content')
                </div>
            </div>
        </div>
        <!--end::Page--> 
    </div>
    <!-- begin::User Panel-->
     @include('layouts.partials.user-profile-sidebar') 
    <!-- end::User Panel-->
   
    @include('layouts.partials.footer')
    @include('layouts.partials.footer-scripts')
    @stack('scripts')
</html>
</body>