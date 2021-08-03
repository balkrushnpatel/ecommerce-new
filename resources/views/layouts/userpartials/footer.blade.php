<footer class="footer appear-animate" data-animation-options="{
            'name': 'fadeIn'
        }">
    <div class="footer-newsletter bg-primary">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-5 col-lg-6">
                    <div class="icon-box icon-box-side text-white">
                        <div class="icon-box-icon d-inline-flex">
                            <i class="w-icon-envelop3"></i>
                        </div>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title text-white text-uppercase font-weight-bold">Subscribe To
                                Our Newsletter</h4>
                            <p class="text-white">Get all the latest information on Events, Sales and Offers.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6 col-md-9 mt-4 mt-lg-0 ">
                    <form action="#" method="get"
                        class="input-wrapper input-wrapper-inline input-wrapper-rounded">
                        <input type="email" class="form-control mr-2 bg-white" name="email" id="email"
                            placeholder="Your E-mail Address" />
                        <button class="btn btn-dark btn-rounded" type="submit">Subscribe<i
                                class="w-icon-long-arrow-right"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="footer-top">
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="widget widget-about">
                        <a href="{{ url('/') }}" class="logo-footer">
                            <img  src="{{ asset('uploads/logo/'.getSetting('logo_image')) }} " alt="logo-footer" width="144"
                                height="45" />
                        </a>
                        <div class="widget-body">
                            <p class="widget-about-title">Got Question? Call us 24/7</p>
                            <a href="#" class="widget-about-call">{{ getSetting('contact_phone') }}</a>
                            <p class="widget-about-desc">Register now to get updates on pronot get up icons
                                & coupons ster now toon.
                            </p>

                            <div class="social-icons social-icons-colored">
                                @if(!empty(getSetting('facebook_link')))
                                    <a href="{{ getSetting('facebook_link') }}" class="social-icon social-facebook w-icon-facebook"></a>
                                @endif
                                @if(!empty(getSetting('twitter_link')))
                                    <a href="{{ getSetting('twitter_link') }}" class="social-icon social-twitter w-icon-twitter"></a>
                                @endif
                                @if(!empty(getSetting('instagram_link')))
                                    <a href="{{ getSetting('instagram_link') }}" class="social-icon social-instagram w-icon-instagram"></a>
                                @endif
                                @if(!empty(getSetting('youtube_link')))
                                    <a href="{{ getSetting('youtube_link') }}" class="social-icon social-youtube w-icon-youtube"></a>
                                @endif
                                @if(!empty(getSetting('pinterest_link')))
                                    <a href="{{ getSetting('pinterest_link') }}" class="social-icon social-pinterest w-icon-pinterest"></a>
                                @endif
                                @if(!empty(getSetting('skype_link')))
                                    <a href="{{ getSetting('skype_link') }}" class="social-icon social-twitter fab fa-skype"></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h3 class="widget-title">Company</h3>
                        <ul class="widget-body">
                            <li><a href="{{ route('about-us') }}">About Us</a></li> 
                            <li><a href="{{ route('contact-us') }}">Contact Us</a></li> 
                            <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('term-condition') }}">Term & Condirion</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h4 class="widget-title">My Account</h4>
                        <ul class="widget-body">
                            <li><a href="#">Track My Order</a></li>
                            <li><a href="cart.html">View Cart</a></li>
                            <li><a href="{{ route('login') }}">Sign In</a></li> 
                            <li><a href="#">My Wishlist</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h4 class="widget-title">Customer Service</h4>
                        <ul class="widget-body">
                            <li><a href="#">Money-back guarantee!</a></li>
                            <li><a href="#">Product Returns</a></li> 
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-middle">
            <div class="widget widget-category">
                @foreach(getCategory() as $item)
                    <div class="category-box">
                        <h6 class="category-name">{{ $item['name'] }}</h6>
                        @foreach($item['subCategory'] as $sitem)
                            <a href="{{ route('subcategory.product',array('id' => $sitem['id'], 'slug' => Str::slug($sitem['slug'])))}}">{{ $sitem['name'] }}</a>
                        @endforeach
                        <!-- <a href="#">View All</a> -->
                    </div> 
                @endforeach
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-left">
                <p class="copyright">Copyright © {{ date('Y') }} {{ config('app.name') }}. All Rights Reserved.</p>
            </div>
            <div class="footer-right">
                <span class="payment-label mr-lg-8">We're using safe payment for</span>
                <figure class="payment">
                    <img src="{{ asset('user/images/payment.png') }}" alt="payment" width="159" height="25" />
                </figure>
            </div>
        </div>
    </div>
</footer>