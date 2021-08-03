@extends('layouts.master')
@section('content')
<main class="main">
    <section class="intro-section">
        <div class="owl-carousel owl-theme owl-nav-inner owl-dot-inner owl-nav-lg animation-slider gutter-no row cols-1"
            data-owl-options="{
            'nav': false,
            'dots': true,
            'items': 1,
            'responsive': {
                '1600': {
                    'nav': true,
                    'dots': false
                }   
            }
        }">
           @foreach($sliders as $slider)
            <div class="banner banner-fixed intro-slide intro-slide1"
               style="background-image: url({{asset('/uploads/slider/'.$slider->id.'/'.$slider->image)}}">
                <div class="container">
                    <div class="banner-content y-50 text-right">
                        <h4 class="banner-title font-weight-bolder ls-25 lh-1 slide-animate"
                            data-animation-options="{
                            'name': 'fadeInRightShorter',
                            'duration': '1s',
                            'delay': '.4s'
                        }">
                            {!!$slider->text!!}
                        </h4>
                        <a href="#"
                            class="btn btn-dark btn-outline btn-rounded btn-icon-right slide-animate"
                            data-animation-options="{
                            'name': 'fadeInRightShorter',
                            'duration': '1s',
                            'delay': '.8s'
                        }">{{$slider->link}}<i class="w-icon-long-arrow-right"></i></a>

                    </div>
                    <!-- End of .banner-content -->
                </div>
                <!-- End of .container -->
            </div>
            <!-- End of .intro-slide1 -->
            @endforeach
        </div>
        <!-- End of .owl-carousel -->
    </section> 
    <div class="container">
        <div class="owl-carousel owl-theme row cols-md-4 cols-sm-3 cols-1icon-box-wrapper appear-animate br-sm mt-6 mb-6"
            data-owl-options="{
            'nav': false,
            'dots': false,
            'loop': false,
            'responsive': {
                '0': {
                    'items': 1
                },
                '576': {
                    'items': 2
                },
                '768': {
                    'items': 3
                },
                '992': {
                    'items': 3
                },
                '1200': {
                    'items': 4
                }
            }
        }">
            <div class="icon-box icon-box-side icon-box-primary">
                <span class="icon-box-icon icon-shipping">
                    <i class="w-icon-truck"></i>
                </span>
                <div class="icon-box-content">
                    <h4 class="icon-box-title font-weight-bold mb-1">Free Shipping & Returns</h4>
                    <p class="text-default">For all orders over $99</p>
                </div>
            </div>
            <div class="icon-box icon-box-side icon-box-primary">
                <span class="icon-box-icon icon-payment">
                    <i class="w-icon-bag"></i>
                </span>
                <div class="icon-box-content">
                    <h4 class="icon-box-title font-weight-bold mb-1">Secure Payment</h4>
                    <p class="text-default">We ensure secure payment</p>
                </div>
            </div>
            <div class="icon-box icon-box-side icon-box-primary icon-box-money">
                <span class="icon-box-icon icon-money">
                    <i class="w-icon-money"></i>
                </span>
                <div class="icon-box-content">
                    <h4 class="icon-box-title font-weight-bold mb-1">Money Back Guarantee</h4>
                    <p class="text-default">Any back within 30 days</p>
                </div>
            </div>
            <div class="icon-box icon-box-side icon-box-primary icon-box-chat">
                <span class="icon-box-icon icon-chat">
                    <i class="w-icon-chat"></i>
                </span>
                <div class="icon-box-content">
                    <h4 class="icon-box-title font-weight-bold mb-1">Customer Support</h4>
                    <p class="text-default">Call or email us 24/7</p>
                </div>
            </div>
        </div>
        <!-- End of Iocn Box Wrapper -->

        <div class="row category-banner-wrapper appear-animate pt-6 pb-8">
            <div class="col-md-6 mb-4">
                <div class="banner banner-fixed br-xs">
                    <figure>
                        <img src="{{ asset('user/images/demos/demo1/categories/1-1.jpg') }}" alt="Category Banner"
                            width="610" height="160" style="background-color: #ecedec;" />
                    </figure>
                    <div class="banner-content y-50 mt-0">
                        <h5 class="banner-subtitle font-weight-normal text-dark">Get up to <span
                                class="text-secondary font-weight-bolder text-uppercase ls-25">20% Off</span>
                        </h5>
                        <h3 class="banner-title text-uppercase">Sports Outfits<br><span
                                class="font-weight-normal text-capitalize">Collection</span>
                        </h3>
                        <div class="banner-price-info font-weight-normal">Starting at <span
                                class="text-secondary  font-weight-bolder">$170.00</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="banner banner-fixed br-xs">
                    <figure>
                        <img src="{{ asset('user/images/demos/demo1/categories/1-2.jpg') }}" alt="Category Banner"
                            width="610" height="160" style="background-color: #636363;" />
                    </figure>
                    <div class="banner-content y-50 mt-0">
                        <h5 class="banner-subtitle font-weight-normal text-capitalize">New Arrivals</h5>
                        <h3 class="banner-title text-white text-uppercase">Accessories<br><span
                                class="font-weight-normal text-capitalize">Collection</span></h3>
                        <div class="banner-price-info text-white font-weight-normal text-capitalize">Only From
                            <span class="text-secondary font-weight-bolder">$90.00</span></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Category Banner Wrapper -->
        @if(count($todayDeal) > 0)
            <div class="row deals-wrapper appear-animate mb-8">
                <div class="col-lg-9 mb-4">
                    <div class="single-product h-100 br-sm">
                        <h4 class="title-sm title-underline font-weight-bolder ls-normal">Deals Hot Of The Day</h4>
                        <div class="owl-carousel owl-theme owl-nav-top owl-nav-lg row cols-1 gutter-no"
                            data-owl-options="{
                            'nav': true,
                            'dots': false,
                            'margin': 20,
                            'items': 1
                        }">
                            @foreach($todayDeal as $product)
                                <div class="product product-single row">
                                    <div class="col-md-6">
                                        <div class="product-gallery product-gallery-vertical mb-0">
                                            @php
                                                $images = fileView($product,'no','multi','jpg','img');
                                            @endphp
                                            <div class="product-single-carousel owl-carousel owl-theme owl-nav-inner row cols-1 gutter-no">
                                                @foreach($images as $img)
                                                    <figure class="product-image">
                                                        <img src="{{  $img }}" data-zoom-image="{{  $img }}"
                                                            alt="{{ $product->name }}" width="800" height="900">
                                                    </figure>
                                                @endforeach
                                            </div>
                                            <div class="product-thumbs-wrap">
                                                <div class="product-thumbs">
                                                    @foreach($images as $key=>$img)
                                                        <div class="product-thumb {{ ($key == 0)?'active':'' }}">
                                                            <img src="{{ $img }}" alt="{{ $product->name }}" width="60" height="68" />
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="product-label-group">
                                                <label class="product-label label-discount">25% Off</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="product-details scrollable">
                                            <h2 class="product-title mb-1">
                                                <a href="{{ $product->productSlug() }}">{{ $product->name }}</a>
                                            </h2>
                                            <hr class="product-divider">
                                            <div class="product-price">
                                                <ins class="new-price ls-50">{!! $product->productPrice() !!} -
                                                    $180.00
                                                </ins>
                                            </div>
                                            <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width: 80%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                                <a href="#" class="rating-reviews">(3 Reviews)</a>
                                            </div>
                                            <div class="product-variation-price">
                                                <span></span>
                                            </div>
                                            <div class="product-form pt-4">
                                                <div class="product-qty-form mb-2 mr-2">
                                                    <div class="input-group">
                                                        <input class="quantity form-control" type="number" min="1" max="{{ $product->qty}}" name="qty" id="product_qty_{{$product->id}}" value="1" readonly>
                                                        <button class="quantity-plus w-icon-plus" data-id="{{ $product->id}}" data-btn="+"></button>
                                                        <button class="quantity-minus w-icon-minus" data-id="{{ $product->id}}" data-btn="-"></button>
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary btn-cart" data-id="{{ $product->id}}">
                                                    <i class="w-icon-cart"></i>
                                                    <span>Add to Cart</span>
                                                </button>
                                            </div> 
                                            <div class="social-links-wrapper mt-1">
                                                @include('user.product.social-link',$product);
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-4">
                    <div class="widget widget-products widget-products-bordered h-100">
                        <div class="widget-body br-sm h-100">
                            <h4 class="title-sm title-underline font-weight-bolder ls-normal mb-2">Top 20 Best Seller</h4>
                            <div class="owl-carousel owl-theme owl-nav-top row cols-lg-1 cols-md-3"
                                data-owl-options="{
                                'nav': true,
                                'dots': false,
                                'margin': 20,
                                'responsive': {
                                    '0': {
                                        'items': 1
                                    },
                                    '576': {
                                        'items': 2
                                    },
                                    '768': {
                                        'items': 3
                                    },
                                    '992': {
                                        'items': 1
                                    }
                                }
                            }">
                                <div class="product-widget-wrap">
                                    <div class="product product-widget bb-no">
                                        <figure class="product-media">
                                            <a href="product-default.html">
                                                <img src="{{ asset('user/images/demos/demo1/products/2-1.jpg') }}" alt="Product"
                                                    width="105" height="118" />
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h4 class="product-name">
                                                <a href="product-default.html">Kitchen Cooker</a>
                                            </h4>
                                            <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width: 60%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <ins class="new-price">$150.60</ins>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product product-widget bb-no">
                                        <figure class="product-media">
                                            <a href="product-default.html">
                                                <img src="{{ asset('user/images/demos/demo1/products/2-2.jpg') }}" alt="Product"
                                                    width="105" height="118" />
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h4 class="product-name">
                                                <a href="product-default.html">Professional Pixel Camera</a>
                                            </h4>
                                            <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width: 60%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <ins class="new-price">$215.68</ins><del
                                                    class="old-price">$230.45</del>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product product-widget">
                                        <figure class="product-media">
                                            <a href="product-default.html">
                                                <img src="{{ asset('user/images/demos/demo1/products/2-3.jpg') }}" alt="Product"
                                                    width="105" height="118" />
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h4 class="product-name">
                                                <a href="product-default.html">Sport Women’s Wear</a>
                                            </h4>
                                            <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width: 60%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <ins class="new-price">$220.20</ins><del
                                                    class="old-price">$300.62</del>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-widget-wrap">
                                    <div class="product product-widget bb-no">
                                        <figure class="product-media">
                                            <a href="product-default.html">
                                                <img src="{{ asset('user/images/demos/demo1/products/2-4.jpg') }}" alt="Product"
                                                    width="105" height="118" />
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h4 class="product-name">
                                                <a href="product-default.html">Latest Speaker</a>
                                            </h4>
                                            <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width: 60%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <ins class="new-price">$250.68</ins>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product product-widget bb-no">
                                        <figure class="product-media">
                                            <a href="product-default.html">
                                                <img src="{{ asset('user/images/demos/demo1/products/2-5.jpg') }}" alt="Product"
                                                    width="105" height="118" />
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h4 class="product-name">
                                                <a href="product-default.html">Men's Black Wrist Watch</a>
                                            </h4>
                                            <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width: 100%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <ins class="new-price">$135.60</ins><del
                                                    class="old-price">$155.70</del>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product product-widget">
                                        <figure class="product-media">
                                            <a href="product-default.html">
                                                <img src="{{ asset('user/images/demos/demo1/products/2-6.jpg') }}" alt="Product"
                                                    width="105" height="118" />
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h4 class="product-name">
                                                <a href="product-default.html">Wash Machine</a>
                                            </h4>
                                            <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width: 100%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <ins class="new-price">$215.68</ins>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-widget-wrap">
                                    <div class="product product-widget bb-no">
                                        <figure class="product-media">
                                            <a href="product-default.html">
                                                <img src="{{ asset('user/images/demos/demo1/products/2-7.jpg') }}" alt="Product"
                                                    width="105" height="118" />
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h4 class="product-name">
                                                <a href="product-default.html">Security Guard</a>
                                            </h4>
                                            <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width: 100%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <ins class="new-price">$320.00</ins>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product product-widget bb-no">
                                        <figure class="product-media">
                                            <a href="product-default.html">
                                                <img src="{{ asset('user/images/demos/demo1/products/2-8.jpg') }}" alt="Product"
                                                    width="105" height="118" />
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h4 class="product-name">
                                                <a href="product-default.html">Apple Super Notecom</a>
                                            </h4>
                                            <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width: 100%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <ins class="new-price">$243.30</ins><del
                                                    class="old-price">$253.50</del>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product product-widget">
                                        <figure class="product-media">
                                            <a href="product-default.html">
                                                <img src="{{ asset('user/images/demos/demo1/products/2-9.jpg') }}" alt="Product"
                                                    width="105" height="118" />
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h4 class="product-name">
                                                <a href="product-default.html">HD Television</a>
                                            </h4>
                                            <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width: 60%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <ins class="new-price">$450.68</ins><del
                                                    class="old-price">$500.00</del>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- End of Deals Wrapper -->
    </div>

    <section class="category-section top-category bg-grey pt-10 pb-10 appear-animate">
        <div class="container pb-2">
            <h2 class="title justify-content-center pt-1 ls-normal mb-5">Top Categories Of The Month</h2>
            <div class="owl-carousel owl-theme row cols-lg-6 cols-md-5 cols-sm-3 cols-2" data-owl-options="{
                'nav': false,
                'dots': false,
                'margin': 20,
                'responsive': {
                    '0': {
                        'items': 2
                    },
                    '576': {
                        'items': 3
                    },
                    '768': {
                        'items': 5
                    },
                    '992': {
                        'items': 6
                    }
                }
            }"> @foreach($categories as $category)
                <div class="category category-classic category-absolute overlay-zoom br-xs">
                    <a href="#" class="category-media">
                        <img src="{{asset('/uploads/category/'.$category->image)}} " alt="Category" width="130"
                            height="130">
                    </a>
                    <div class="category-content">
                        <h4 class="category-name">{{$category->name}}</h4>
                        <a href="#" class="btn btn-primary btn-link btn-underline">Shop
                            Now</a>
                    </div>
                </div>
                 @endforeach
            </div>
        </div>
    </section> 

    <div class="container">
        <h2 class="title justify-content-center ls-normal mb-4 mt-10 pt-1 appear-animate">Popular Departments
        </h2>
        <div class="tab tab-nav-boxed tab-nav-outline appear-animate">
            <ul class="nav nav-tabs justify-content-center" role="tablist">
                <li class="nav-item mr-2 mb-2">
                    <a class="nav-link active br-sm font-size-md ls-normal" href="#new-arrival">New arrivals</a>
                </li>
                <li class="nav-item mr-2 mb-2">
                    <a class="nav-link br-sm font-size-md ls-normal" href="#most-popular">most popular</a>
                </li>
                <li class="nav-item mr-0 mb-2">
                    <a class="nav-link br-sm font-size-md ls-normal" href="#featured-product">Featured</a>
                </li>
            </ul>
        </div>
        <!-- End of Tab -->
        <div class="tab-content product-wrapper appear-animate">
            <div class="tab-pane active pt-4" id="new-arrival">
                <div class="row cols-xl-5 cols-md-4 cols-sm-3 cols-2">
                    @foreach($newArrival as $product)
                        @include('user.product.product-box',$product)  
                    @endforeach 
                </div>
            </div>
            <!-- End of Tab Pane -->
           
            <!-- End of Tab Pane -->
            <div class="tab-pane pt-4" id="most-popular">
                <div class="row cols-xl-5 cols-md-4 cols-sm-3 cols-2">
                     @foreach($mostPopular as $product)
                        @include('user.product.product-box',$product)  
                    @endforeach 
                </div>
            </div>
            <!-- End of Tab Pane -->
            <div class="tab-pane pt-4" id="featured-product"> 
                <div class="row cols-xl-5 cols-md-4 cols-sm-3 cols-2">
                    @foreach($featuredProduct as $product)
                        @include('user.product.product-box',$product)  
                    @endforeach 
                </div>
            </div>
            <!-- End of Tab Pane -->
        </div>
        <!-- End of Tab Content -->
        <!-- End of Category Cosmetic Lifestyle -->
        @foreach($banners as $key=>$banner)
            @if($key < 2)
                @if($key == 0)
                    <div class="row category-cosmetic-lifestyle appear-animate mb-5">
                @endif
                <div class="col-md-6 mb-4">
                    <div class="banner banner-fixed category-banner-1 br-xs">
                        <figure>
                            <img src="{{asset('uploads/banner/'.$banner->id.'/'.$banner->image)}}" alt="Category Banner"
                                width="610" height="200" style="background-color: #3B4B48;" />
                        </figure>
                        <div class="banner-content y-50 pt-1">
                            <h5 class="banner-subtitle font-weight-bold text-uppercase">{{$banner->banner_name}}</h5>
                            <h3 class="banner-title font-weight-bolder text-capitalize text-white">{{$banner->text}}</h3>
                            <a href="shop-banner-sidebar.html"
                                class="btn btn-white btn-link btn-underline btn-icon-right">{{$banner->btn_name}}<i
                                    class="w-icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                @if($key == 1 || (count($banners) == 1))
                    </div>
                @endif
            @else
                <div class="banner banner-fashion appear-animate br-sm mb-9" style="background-image: url({{asset('uploads/banner/'.$banner->id.'/'.$banner->image)}});
                    background-color: #383839;">
                    <div class="banner-content align-items-center">
                        <div class="content-left d-flex align-items-center mb-3">
                            <hr class="banner-divider bg-white mt-0 mb-0 mr-8">
                        </div>
                        <div class="content-right d-flex align-items-center flex-1 flex-wrap">
                            <div class="banner-info mb-0 mr-auto pr-4 mb-3">
                                <h3 class="banner-title text-white font-weight-bolder text-uppercase ls-25">{{$banner->banner_name}}</h3>
                                <p class="text-white mb-0">{{$banner->text}}
                                </p>
                            </div>
                            <a href="shop-banner-sidebar.html"
                                class="btn btn-white btn-outline btn-rounded btn-icon-right mb-3">{{$banner->btn_name}}<i
                                    class="w-icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
        <!-- End of Banner Fashion -->
        @foreach($home_category as $item)
        <div class="product-wrapper-1 appear-animate mb-7">
            <div class="title-link-wrapper pb-1 mb-4">
                <h2 class="title ls-normal mb-0">{{$item['name']}}</h2>
                <a href="{{ route('category.product',array('id' => $item['id'], 'slug' => Str::slug($item['slug'])))}}" class="font-size-normal font-weight-bold ls-25 mb-0">More
                    Products<i class="w-icon-long-arrow-right"></i></a>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-4 mb-4">
                    <div class="banner h-100 br-sm" style="background-image: url({{asset('uploads/banner/'.$item['banner']['id'].'/'.$item['banner']['image'])}}); 
                                background-color: #ebeced;" >
                        <div class="banner-content content-top">
                            <h5 class="banner-subtitle font-weight-normal mb-2">{{$item['banner']['banner_name']}}</h5>
                            <hr class="banner-divider bg-dark mb-2">
                            <h3 class="banner-title font-weight-bolder text-uppercase ls-25">
                                Trending <br> <span class="font-weight-normal text-capitalize">{{$item['banner']['text']}}</span>
                            </h3>
                            <a href="shop-banner-sidebar.html"
                                class="btn btn-dark btn-outline btn-rounded btn-sm">{{$item['banner']['btn_name']}}</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-sm-8">
                    <div class="owl-carousel owl-theme row cols-xl-4 cols-lg-3 cols-2" data-owl-options="{
                        'nav': false,
                        'dots': true,
                        'margin': 20,
                        'responsive': {
                            '0': {
                                'items': 2
                            },
                            '576': {
                                'items': 2
                            },
                            '992': {
                                'items': 3
                            },
                            '1200': {
                                'items': 4
                            }
                        }
                    }"> 
                    @if(!empty($item['product']) && count($item['product']))
                        @foreach($item['product'] as $pitem)
                            <div class="product-col">
                                <div class="product-wrap product text-center">
                                    <figure class="product-media">
                                        <a href="{{ $product->productSlug() }}">
                                            {!! fileView($pitem,'thumb','no','jpg','img') !!}  
                                        </a>
                                        <div class="product-action-vertical">
                                            <a href="#" class="btn-product-icon btn-cart w-icon-cart" onclick="to_cart({{ $product->id}})" title="Add to cart"></a>
                                            <a href="#" class="btn-product-icon btn-wishlist w-icon-heart{{ !empty($product->wishlist->product_id) && ($product->wishlist->product_id == $product->id)?'-full':'' }}" onclick="to_wishlist({{ $product->id}})" title="Add to wishlist"></a> 
                                            <a href="#" class="btn-product-icon btn-compare w-icon-compare" onclick="to_compare({{ $product->id}})" title="Add to Compare" data-product={{ $product->id}}></a>
                                        </div>
                                    </figure>
                                    <div class="product-details">
                                        <h4 class="product-name"><a href="{{ $pitem->productSlug() }}">{{$pitem['name']}}</a></h4>
                                        <div class="ratings-container">
                                            <div class="ratings-full">
                                                <span class="ratings" style="width: 100%;"></span>
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                            <a href="{{ $pitem->productSlug() }}" class="rating-reviews">(5 reviews)</a>
                                        </div>
                                        <div class="product-price">
                                            <ins class="new-price">{{$pitem['price']}}</ins>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    </div>
                    <!-- End of Produts -->
                </div>
            </div>
        </div>
        @endforeach
        <!-- End of Product Wrapper 1 -->

        <h2 class="title title-underline mb-4 ls-normal appear-animate">Top Brands</h2>
        <div class="owl-carousel owl-theme brands-wrapper mb-9 row gutter-no cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2 appear-animate"
            data-owl-options="{
            'nav': false,
            'dots': false,
            'margin': 0,
            'responsive': {
                '0': {
                    'items': 2
                },
                '576': {
                    'items': 3
                },
                '768': {
                    'items': 4
                },
                '992': {
                    'items': 5
                },
                '1200': {
                    'items': 6
                }
            }
        }"> @foreach($brands as $brand)
            <div class="brand-col">
                <figure class="brand-wrapper">
                    <img src="{{asset('/uploads/brand/'.$brand->image)}} " alt="Brand" width="410" height="186" />
                </figure>
            </div>
            @endforeach
        </div>
        <!-- End of Brands Wrapper -->

        <div class="post-wrapper appear-animate mb-4">
            <div class="title-link-wrapper pb-1 mb-4">
                <h2 class="title ls-normal mb-0">From Our Blog</h2>
                <a href="{{route('blogs')}}" class="font-weight-bold font-size-normal">View All Articles</a>
            </div>
            <div class="owl-carousel owl-theme row cols-lg-4 cols-md-3 cols-sm-2 cols-1" data-owl-options="{
                'items': 4,
                'nav': false,
                'dots': true,
                'loop': false,
                'margin': 20,
                'responsive': {
                    '0': {
                        'items': 1
                    },
                    '576': {
                        'items': 2
                    },
                    '768': {
                        'items': 3
                    },
                    '992': {
                        'items': 4,
                        'dots': false
                    }
                }
            }"> 
            @foreach($blogs as $blog)
                <div class="post text-center overlay-zoom">
                    <figure class="post-media br-sm">
                        <a href="#">
                            <img src="{{asset('/uploads/blog/'.$blog->id.'/'.$blog->image)}} " alt="Post" width="280" height="180"
                                style="background-color: #4b6e91;" />
                        </a>
                    </figure>
                    <div class="post-details">
                        <div class="post-meta">
                            by <a href="#" class="post-author">{{$blog->author}}</a>
                            - <a href="#" class="post-date mr-0">{{$blog->created_at}}</a>
                        </div>
                        <h4 class="post-title"><a href="{{route('blogs.detail',array('id' => $blog->id, 'slug' => Str::slug($blog->slug)))}}">{{$blog->title}}</a>
                        </h4>
                        <a href="{{route('blogs.detail',array('id' => $blog->id, 'slug' => Str::slug($blog->slug)))}}" class="btn btn-link btn-dark btn-underline">Read More<i
                                class="w-icon-long-arrow-right"></i></a>
                    </div>
                </div>
            @endforeach    
            </div>
        </div>
        <!-- Post Wrapper -->

        <h2 class="title title-underline mb-4 ls-normal appear-animate">Recent Views</h2>
        <div class="owl-carousel owl-theme owl-shadow-carousel appear-animate row cols-xl-8 cols-lg-6 cols-md-4 cols-2 pb-2 mb-10"
            data-owl-options="{
            'nav': false,
            'dots': true,
            'margin': 20,
            'responsive': {
                '0': {
                    'items': 2
                },
                '576': {
                    'items': 3
                },
                '768': {
                    'items': 5
                },
                '992': {
                    'items': 6
                },
                '1200': {
                    'items': 8,
                    'dots': false
                }
            }
        }">
            @foreach($views as $item)
            <div class="product-wrap mb-0">
                <div class="product text-center product-absolute">
                    <a href="{{ $item->productSlug() }}">
            {!! fileView($item,'thumb','no','jpg','img') !!}  
        </a>
                    <h4 class="product-name">
                        <a  href="{{ $item->productSlug() }}">{{$item->name}}</a>
                    </h4>
                </div>
            </div>
            @endforeach
        </div>
        <!-- End of Reviewed Producs -->
    </div>
    <!--End of Catainer -->
</main>
@endsection