
<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <p class="welcome-msg">Welcome to Wolmart Store message or remove it!</p>
            </div>
            <div class="header-right">
                <div class="dropdown">
                    <a href="#currency">USD</a>
                    <div class="dropdown-box">
                        <a href="#USD">USD</a>
                        <a href="#EUR">EUR</a>
                    </div>
                </div>
                <!-- End of DropDown Menu -->

                <div class="dropdown">
                    <a href="#language">
                        <img src="{{ asset('user/images/flags/eng.png') }}" alt="ENG Flag" width="14"
                            height="8" class="dropdown-image" /> ENG
                    </a>
                    <div class="dropdown-box">
                        <a href="#ENG">
                            <img src="{{ asset('user/images/flags/eng.png') }}" alt="ENG Flag" width="14" height="8"
                                class="dropdown-image" />
                            ENG
                        </a>
                        <a href="#FRA">
                            <img src="{{ asset('user/images/flags/fra.png') }}" alt="FRA Flag" width="14" height="8"
                                class="dropdown-image" />
                            FRA
                        </a>
                    </div>
                </div> 
                <span class="divider d-lg-show"></span>
                <a href="blog.html" class="d-lg-show">Blog</a>
                <a href="contact-us.html" class="d-lg-show">Contact Us</a>
                <a href="my-account.html" class="d-lg-show">My Account</a>
                <a href="javascript:void(0);" class="d-lg-show login sign-in"><i class="w-icon-account"></i>Sign In</a>
                <span class="delimiter d-lg-show">/</span>
                <a href="#" class="ml-0 d-lg-show login register">Register</a>
            </div>
        </div>
    </div> 
    <div class="header-middle">
        <div class="container">
            <div class="header-left mr-md-4">
                <a href="#" class="mobile-menu-toggle  w-icon-hamburger">
                </a>
                <a href="{{ url('/') }}" class="logo ml-lg-0">
                    <img src="{{ asset('user/images/logo.png') }}" alt="logo" width="144" height="45" />
                </a>
                <form method="get" action="{{route('product.search')}}" class="header-search hs-expanded hs-round d-none d-md-flex input-wrapper">
                    <div class="select-box">
                        <select id="category" name="category">
                            <option value="">All Categories</option>
                            @foreach(getCategory() as $key=>$category) 
                                <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                            @endforeach 
                        </select>
                    </div>
                    <input type="text" class="form-control" name="name" id="headerSearch"
                        placeholder="Search in..." required />
                    <button class="btn btn-search" type="submit"><i class="w-icon-search"></i></button>
                </form>
            </div>
            <div class="header-right ml-4">
                <div class="header-call d-xs-show d-lg-flex align-items-center">
                    <a href="tel:#" class="w-icon-call"></a>
                    <div class="call-info d-lg-show">
                        <h4 class="chat font-weight-normal font-size-md text-normal ls-normal text-light mb-0">
                            <a href="mailto:#" class="text-capitalize">Live Chat</a> or :</h4>
                        <a href="tel:#" class="phone-number font-weight-bolder ls-50">0(800)123-456</a>
                    </div>
                </div>
                <a class="wishlist label-down link d-xs-show" href="wishlist.html">
                    <i class="w-icon-heart"></i>
                    <span class="wishlist-label d-lg-show">Wishlist</span>
                </a>
                <a class="compare label-down link d-xs-show" href="compare.html">
                    <i class="w-icon-compare"></i>
                    <span class="compare-label d-lg-show">Compare</span>
                </a>
                <div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2">
                    <div class="cart-overlay"></div>
                    <a href="#" class="cart-toggle label-down link">
                        <i class="w-icon-cart">
                            <span class="cart-count">0</span>
                        </i>
                        <span class="cart-label">Cart</span>
                    </a>
                    <div class="dropdown-box">
                        <div class="cart-header">
                            <span>Shopping Cart</span>
                            <a href="javascript:void(0);" class="btn-close">Close<i class="w-icon-long-arrow-right"></i></a>
                        </div> 
                        <div class="products">
                            <div class="product product-cart">
                                <div class="product-detail">
                                    <a href="product-default.html" class="product-name">Beige knitted
                                        elas<br>tic
                                        runner shoes</a>
                                    <div class="price-box">
                                        <span class="product-quantity">1</span>
                                        <span class="product-price">$25.68</span>
                                    </div>
                                </div>
                                <figure class="product-media">
                                    <a href="product-default.html">
                                        <img src="{{ asset('user/images/cart/product-1.jpg') }}" alt="product" height="84"
                                            width="94" />
                                    </a>
                                </figure>
                                <button class="btn btn-link btn-close">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div> 
                        </div>
                        <div class="cart-total">
                            <label>Subtotal:</label>
                            <span class="price">$58.67</span>
                        </div>
                        <div class="cart-action">
                            <a href="{{ route('cart') }}" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
                            <a href="{{ route('checkout') }}" class="btn btn-primary  btn-rounded">Checkout</a>
                        </div>
                    </div>
                    <!-- End of Dropdown Box -->
                </div>
            </div>
        </div>
    </div>
    <!-- End of Header Middle -->

    <div class="header-bottom sticky-content fix-top sticky-header">
        <div class="container">
            <div class="inner-wrap">
                <div class="header-left">
                    <div class="dropdown category-dropdown has-border hide" data-visible="false">
                        <a href="#" class="category-toggle" role="button" aria-haspopup="true" aria-expanded="false" data-display="static" title="Browse Categories">
                            <i class="w-icon-category"></i>
                            <span>Browse Categories</span>
                        </a>
                        <div class="dropdown-box">
                            <ul class="menu vertical-menu category-menu">
                                @foreach(getCategory() as $item)
                                    <li>
                                        <a href="{{ route('category.product',array('id' => $item['id'], 'slug' => Str::slug($item['slug'])))}}">
                                            <i class="w-icon-home"></i> {{ $item['name'] }}
                                        </a>
                                        @if(count($item['subCategory'])) 
                                            <ul class="megamenu">
                                                @foreach($item['subCategory'] as $key=> $sitem)
                                                    @if($key < 2)
                                                        <li>
                                                            <h4 class="menu-title">{{ $sitem['name'] }}</h4>
                                                            @if(count($sitem['brands']))
                                                                <hr class="divider">
                                                                <ul>
                                                                    @foreach($sitem['brands'] as $bkey=>$bitem)
                                                                        @if($bkey < 10)
                                                                            <li><a href="{{ route('brand.product',array('id' => $bitem['id'], 'slug' => Str::slug($bitem['slug'])))}}">{{ $bitem['name'] }}</a></li>
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                            @endif 
                                                        </li> 
                                                    @endif
                                                @endforeach
                                                <li>
                                                    <div class="menu-banner banner-fixed menu-banner3">
                                                        <figure>
                                                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" width="235" height="461" />
                                                        </figure> 
                                                    </div>
                                                </li>
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                                <li>
                                    <a href="{{ route('category') }}"
                                        class="font-weight-bold text-primary text-uppercase ls-25">
                                        View All Categories<i class="w-icon-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div> 
                    <nav class="main-nav">
                        @php
                            $segment = request()->segment(1);
                        @endphp
                        <ul class="menu active-underline">
                            <li class="@if(Request::is('/')) active @endif">
                                <a href="{{ url('/') }}">Home</a>
                            </li> 
                            <li class="@if($segment == 'category') active @endif" >
                                <a href="{{ route('category') }}">Category</a>
                                <ul>
                                    @foreach(getCategory() as $item)
                                        <li><a href="{{ route('category.product',array('id' => $item['id'], 'slug' => Str::slug($item['slug'])))}}">{{ $item['name'] }}</a></li> 
                                    @endforeach
                                </ul>
                            </li>
                            <li class="@if($segment == 'product') active @endif">
                                <a href="{{ route('product') }}">Products</a>
                                <ul> 
                                    <li><a href="{{ route('product.fecture') }}">Featured Products</a></li>
                                    <li><a href="{{ route('product.classifieds') }}">Classifieds Products</a></li>
                                </ul>
                            </li> 
                            <li class="@if($segment == 'brand') active @endif" >
                                <a href="{{ route('all.brand') }}">All Brand</a>
                            </li>
                            <li class="@if($segment == 'blog') active @endif">
                                <a href="{{ route('blogs') }}">Blogs</a>
                                <ul>
                                    @foreach(getCategory() as $item)
                                        <li><a href="{{ route('category.product',array('id' => $item['id'], 'slug' => Str::slug($item['slug'])))}}">{{ $item['name'] }}</a></li> 
                                    @endforeach
                                </ul>
                            </li>
                            <li class="@if(Request::is('contact-us')) active @endif">
                                <a href="{{ route('contact-us') }}">Contact Us</a>
                            </li>    
                            <!-- <li>
                                <a href="about-us.html">Pages</a>
                                <ul>

                                    <li><a href="about-us.html">About Us</a></li>
                                    <li><a href="become-a-vendor.html">Become A Vendor</a></li>
                                    <li><a href="contact-us.html">Contact Us</a></li>
                                    <li><a href="faq.html">FAQs</a></li>
                                    <li><a href="error-404.html">Error 404</a></li>
                                    <li><a href="coming-soon.html">Coming Soon</a></li>
                                    <li><a href="wishlist.html">Wishlist</a></li>
                                    <li><a href="cart.html">Cart</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="my-account.html">My Account</a></li>
                                    <li><a href="compare.html">Compare</a></li>
                                </ul>
                            </li>  -->
                        </ul>
                    </nav>
                </div>
                <div class="header-right">
                    <a href="#" class="d-xl-show"><i class="w-icon-map-marker mr-1"></i>Track Order</a>
                    <a href="#"><i class="w-icon-sale"></i>Daily Deals</a>
                </div>
            </div>
        </div>
    </div>
</header>