<script type="text/javascript">
	var HOST_URL = "/";
	var APP_URL = "{{ url('/') }}"; 
	window.addEventListener('load',function() {
        setTimeout(function() {
           $('#alert-message').fadeOut('slow');
        }, 3000);
    }); 
    WebFontConfig = {
        google: { families: ['Poppins:400,500,600,700,800'] }
    };
    ( function ( d ) {
        var wf = d.createElement( 'script' ), s = d.scripts[0];
        wf.src = '{{ asset('user/js/webfont.js') }} ';
        wf.async = true;
        s.parentNode.insertBefore( wf, s );
    } )( document );
</script>
<!-- <script src="{{ asset('user/vendor/jquery/jquery.min.js') }}"></script> -->
<script src="{{ asset('user/js/jquery-1.11.1.min.js') }}"></script >
<script src="{{ asset('user/vendor/nouislider/nouislider.min.js') }}"></script>
<script src="{{ asset('user/vendor/sticky/sticky.min.js') }}"></script>
<script src="{{ asset('user/vendor/jquery.plugin/jquery.plugin.min.js') }}"></script>
<script src="{{ asset('user/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('user/vendor/owl-carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('user/vendor/zoom/jquery.zoom.min.js') }}"></script>
<script src="{{ asset('user/vendor/jquery.countdown/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('user/vendor/isotope/isotope.pkgd.min.js') }}"></script> 
<script src="{{ asset('user/vendor/jquery.count-to/jquery.count-to.min.js') }}"></script> 
<script src="{{ asset('user/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script> 


<!-- Main JS --> 

<script src="{{ asset('user/js/jquery-ui.min.js') }}"></script> 
<script src="{{ asset('user/js/jquery-ui.js') }}"></script> 
<script src="{{ asset('user/js/main.min.js') }}"></script> 
<script src="{{ asset('user/js/bow.min.js') }}"></script> 
<script src="{{ asset('wjs/search.js')}}"></script>
