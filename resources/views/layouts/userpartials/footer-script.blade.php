<script type="text/javascript">
	var HOST_URL = "/";
	var APP_URL = "{{ url('/') }}"; 
	window.addEventListener('load',function() {
        setTimeout(function() {
           $('#alert-message').fadeOut('slow');
        }, 3000);
    });
</script>
<script src="{{ asset('user/vendor/jquery/jquery.min.js') }}"></script>
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
<script src="{{ asset('user/js/main.min.js') }}"></script>
<script src="{{ asset('user/js/bow.min.js') }}"></script>