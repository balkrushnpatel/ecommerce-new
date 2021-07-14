<!DOCTYPE html>
<html>
<head>
    @include('layouts.partials.head')
    @stack('stylesheets')
</head>
<body>
    <div class="wrapper">
        @include('layouts.partials.header')
        @include('layouts.partials.nav')
        <div class="container-fluid page-body-wrapper">
            @yield('content')
        </div>
        @include('layouts.partials.footer')
    </div>
    @include('layouts.partials.footer-scripts')
    @stack('scripts')
</body>
</html>