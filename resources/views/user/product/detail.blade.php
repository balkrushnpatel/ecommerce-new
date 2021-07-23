@extends('layouts.master')
@section('content') 
	@if(count($products) == 1)
		@foreach($products as $item)
			@section('title',$item->name) 
			<main class="main mb-10 pb-1"> 
		        <nav class="breadcrumb-nav container">
		            <ul class="breadcrumb bb-no">
		                <li><a href="{{ url('/') }}">Home</a></li>
		                <li><a href="{{ route('product') }}">Product</a></li>
		                <li>{{ $item->name }}</li>
		            </ul> 
		        </nav> 
		        <div class="page-content">
		            <div class="container">
		                <div class="row gutter-lg">
		                    <div class="main-content">
		                        <div class="product product-single row">
		                            <div class="col-md-6 mb-6">
		                                <div class="product-gallery product-gallery-sticky">
		                                    <div class="product-single-carousel owl-carousel owl-theme owl-nav-inner row cols-1 gutter-no">
		                                    	@php
	                                                $images = fileView($item,'no','multi','jpg','img');
	                                            @endphp
	                                            @foreach($images as $img)
                                                    <figure class="product-image">
                                                        <img src="{{  $img }}" data-zoom-image="{{  $img }}" alt="{{ $item->name }}" width="800" height="900">
                                                    </figure>
                                                @endforeach 
		                                    </div>
		                                    <div class="product-thumbs-wrap">
		                                        <div class="product-thumbs row cols-4 gutter-sm">
		                                            @foreach($images as $key=>$img)
                                                        <div class="product-thumb {{ ($key == 0)?'active':'' }}">
                                                            <img src="{{ $img }}" alt="{{ $item->name }}" width="60" height="68" />
                                                        </div>
                                                    @endforeach
		                                        </div>
		                                        <button class="thumb-up disabled"><i class="w-icon-angle-left"></i></button>
		                                        <button class="thumb-down disabled"><i class="w-icon-angle-right"></i></button>
		                                    </div>
		                                </div>
		                            </div>
		                            <div class="col-md-6 mb-4 mb-md-6">
		                                <div class="product-details" data-sticky-options="{'minWidth': 767}">
		                                    <h2 class="product-title">{{ $item->name }}</h2>
		                                    <div class="product-bm-wrapper">
		                                    	@if(!empty($item->brand))
			                                        <figure class="brand">
			                                        	@php 
			                                        		$brand = $item->brand;
			                                        	@endphp
			                                            <img src="{{ asset('uploads/brand/'.$brand->image) }} " alt="{{ $brand->name }}" width="102" height="48" />
			                                        </figure>
			                                    @endif
		                                        <div class="product-meta">
		                                            <div class="product-categories">
		                                                Category: <span class="product-category">
		                                                	<a href="{{ route('category.product',array('id' => $item->categories->id, 'slug' => Str::slug($item->categories->slug)))}}">{{ $item->categories->name }}</a>
		                                                </span>
		                                            </div>
		                                            <div class="product-sku">
		                                                SKU: <span>MS46891340</span>
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <hr class="product-divider">
		                                    <div class="product-price">
		                                    	<ins class="new-price">{!! $item->productPrice() !!} / {{ $item->unit }} </ins> 
		                                    </div>
		                                    <div class="ratings-container">
		                                        <div class="ratings-full">
		                                            <span class="ratings" style="width: 80%;"></span>
		                                            <span class="tooltiptext tooltip-top"></span>
		                                        </div>
		                                        <a href="#product-tab-reviews" class="rating-reviews scroll-to">(3 Reviews)</a>
		                                    </div> 
		                                    <hr class="product-divider"> 
		                                    @if(!empty($item->color))
			                                    <div class="product-form product-variation-form product-color-swatch">
			                                        <label>Color:</label>
			                                        <div class="d-flex align-items-center product-variations">
			                                        	@foreach(json_decode($item->color) as $clr)
			                                            	<a href="javascript:void(0)" class="color cust-color" data-color="{{ $clr }}" style="background-color: {{ $clr }}"></a>
			                                            @endforeach
			                                        </div>
			                                    </div>
			                                @endif
			                                @if(!empty($item->option))
			                                	@php
			                                		$option = json_decode($item->option); 
			                                	@endphp
			                                	@foreach($option as $opt) 
				                                    <div class="product-form product-variation-form product-size-swatch">
				                                        <label class="mb-1">{{ $opt->title }}:</label>
				                                        <div class="flex-wrap d-flex align-items-center product-variations">
				                                        	@if($opt->choice != 'text')
					                                        	@php 
				                                        			$choice = explode(',',$opt->option); 
				                                        		@endphp
				                                        		@if($opt->choice =='single')
				                                        			<select name="option" id="option">
				                                        				@foreach($choice as $choic)
						                                        			<option value="{{ $choic }}">{{ $choic }}</option>
						                                        		@endforeach
				                                        			</select>
					                                        	@endif
				                                        		@if($opt->choice =='multi')
				                                        			<div class="toolbox">
				                                        			<div class="toolbox-item toolbox-sort select-box text-dark">
					                                        			<select name="option[]" id="option" multiple class="form-control">
					                                        				@foreach($choice as $choic)
							                                        			<option value="{{ $choic }}">{{ $choic }}</option>
							                                        		@endforeach
					                                        			</select>
				                                        			</div>
				                                        			</div>
					                                        	@endif
				                                        		@if($opt->choice =='radio')
				                                        			@foreach($choice as $choic)
				                                        				<input type="radio" name="option" value="{{ $choic }}"class="size ml-2"><span class="product-option"> {{ $choic }}</span>
				                                        			@endforeach
					                                        	@endif
				                                        		@if($opt->choice =='checkbox')
				                                        			@foreach($choice as $choic)
				                                        				<input type="checkbox" name="option[]" value="{{ $choic }}"> 
				                                        				<span class="product-option"> {{ $choic }}</span>
				                                        			@endforeach
					                                        	@endif
					                                        @else
					                                        	<input type="text" name="option" class="form-control">
			                                				@endif  
				                                        </div> 
				                                    </div>
				                                @endforeach
			                                @endif 
		                                    <div class="fix-bottom product-sticky-content sticky-content">
		                                        <div class="product-form container">
		                                            <div class="product-qty-form">
		                                                <div class="input-group">
		                                                    <input class="quantity form-control" type="number" min="1" max="{{ $item->qty}}" name="qty" id="product_qty_{{$item->id}}"  value="1">
		                                                    <button class="quantity-plus w-icon-plus" data-btn="+" data-id="{{ $item->id}}"></button>
                                                        	<button class="quantity-minus w-icon-minus" data-btn="-" data-id="{{ $item->id}}"></button>
		                                                </div>
		                                            </div>
		                                            <button class="btn btn-primary btn-cart" data-id="{{ $item->id}}">
		                                                <i class="w-icon-cart"></i>
		                                                <span>Add to Cart</span>
		                                            </button>
		                                        </div>
		                                    </div>

		                                    <div class="social-links-wrapper">
		                                        @include('user.product.social-link');
		                                    </div>
		                                </div>
		                            </div>
		                        </div> 
		                        <div class="tab tab-nav-boxed tab-nav-underline product-tabs">
		                            <ul class="nav nav-tabs" role="tablist">
		                                <li class="nav-item">
		                                    <a href="#product-tab-description" class="nav-link active">Description</a>
		                                </li>
		                                <li class="nav-item">
		                                    <a href="#product-tab-specification" class="nav-link">Specification</a>
		                                </li>
		                                <li class="nav-item">
		                                    <a href="#product-tab-vendor" class="nav-link">Shipment Info</a>
		                                </li>
		                                <li class="nav-item">
		                                    <a href="#product-tab-reviews" class="nav-link">Customer Reviews (3)</a>
		                                </li> 
		                            </ul>
		                            <div class="tab-content">
		                                <div class="tab-pane active" id="product-tab-description">
		                                    <div class="row mb-4">
		                                        <div class="col-md-12 mb-5">
		                                            {!! $item->description !!}
		                                        </div> 
		                                    </div>
		                                    <div class="row cols-md-3">
		                                        <div class="mb-3">
		                                            <h5 class="sub-title font-weight-bold"><span class="mr-3">1.</span>Free
		                                                Shipping &amp; Return</h5>
		                                            <p class="detail pl-5">We offer free shipping for products on orders
		                                                above 50$ and offer free delivery for all orders in US.</p>
		                                        </div>
		                                        <div class="mb-3">
		                                            <h5 class="sub-title font-weight-bold"><span>2.</span>Free and Easy
		                                                Returns</h5>
		                                            <p class="detail pl-5">We guarantee our products and you could get back
		                                                all of your money anytime you want in 30 days.</p>
		                                        </div>
		                                        <div class="mb-3">
		                                            <h5 class="sub-title font-weight-bold"><span>3.</span>Special Financing
		                                            </h5>
		                                            <p class="detail pl-5">Get 20%-50% off items over 50$ for a month or
		                                                over 250$ for a year with our special credit card.</p>
		                                        </div>
		                                    </div>
		                                </div>
		                                <div class="tab-pane" id="product-tab-specification">
		                                    <ul class="list-none">
		                                        <li>
		                                            <label>Model</label>
		                                            <p>Skysuite 320</p>
		                                        </li>
		                                        <li>
		                                            <label>Color</label>
		                                            <p>Black</p>
		                                        </li>
		                                        <li>
		                                            <label>Size</label>
		                                            <p>Large, Small</p>
		                                        </li>
		                                        <li>
		                                            <label>Guarantee Time</label>
		                                            <p>3 Months</p>
		                                        </li>
		                                    </ul>
		                                </div>
		                                <div class="tab-pane" id="product-tab-vendor">
		                                    <div class="row mb-3">
		                                        <div class="col-md-6 mb-4">
		                                            <figure class="vendor-banner br-sm">
		                                                <img src="{{ asset('user/images/products/vendor-banner.jpg') }} "
		                                                    alt="Vendor Banner" width="610" height="295"
		                                                    style="background-color: #353B55;" />
		                                            </figure>
		                                        </div>
		                                        <div class="col-md-6 pl-2 pl-md-6 mb-4">
		                                            <div class="vendor-user">
		                                                <figure class="vendor-logo mr-4">
		                                                    <a href="#">
		                                                        <img src="{{ asset('user/images/products/vendor-logo.jpg') }} " alt="Vendor Logo" width="80" height="80" />
		                                                    </a>
		                                                </figure>
		                                                <div>
		                                                    <div class="vendor-name"><a href="#">Jone Doe</a></div>
		                                                    <div class="ratings-container">
		                                                        <div class="ratings-full">
		                                                            <span class="ratings" style="width: 90%;"></span>
		                                                            <span class="tooltiptext tooltip-top"></span>
		                                                        </div>
		                                                        <a href="#" class="rating-reviews">(32 Reviews)</a>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <ul class="vendor-info list-style-none">
		                                                <li class="store-name">
		                                                    <label>Store Name:</label>
		                                                    <span class="detail">OAIO Store</span>
		                                                </li>
		                                                <li class="store-address">
		                                                    <label>Address:</label>
		                                                    <span class="detail">Steven Street, El Carjon, CA 92020, United
		                                                        States (US)</span>
		                                                </li>
		                                                <li class="store-phone">
		                                                    <label>Phone:</label>
		                                                    <a href="#tel:">1234567890</a>
		                                                </li>
		                                            </ul>
		                                            <a href="vendor-dokan-store.html"
		                                                class="btn btn-dark btn-link btn-underline btn-icon-right">Visit
		                                                Store<i class="w-icon-long-arrow-right"></i></a>
		                                        </div>
		                                    </div>
		                                    <p class="mb-5"><strong class="text-dark">L</strong>orem ipsum dolor sit amet,
		                                        consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
		                                        dolore magna aliqua.
		                                        Venenatis tellus in metus vulputate eu scelerisque felis. Vel pretium
		                                        lectus quam id leo in vitae turpis massa. Nunc id cursus metus aliquam.
		                                        Libero id faucibus nisl tincidunt eget. Aliquam id diam maecenas ultricies
		                                        mi eget mauris. Volutpat ac tincidunt vitae semper quis lectus. Vestibulum
		                                        mattis ullamcorper velit sed. A arcu cursus vitae congue mauris.
		                                    </p>
		                                    <p class="mb-2"><strong class="text-dark">A</strong> arcu cursus vitae congue
		                                        mauris. Sagittis id consectetur purus
		                                        ut. Tellus rutrum tellus pellentesque eu tincidunt tortor aliquam nulla.
		                                        Diam in
		                                        arcu cursus euismod quis. Eget sit amet tellus cras adipiscing enim eu. In
		                                        fermentum et sollicitudin ac orci phasellus. A condimentum vitae sapien
		                                        pellentesque
		                                        habitant morbi tristique senectus et. In dictum non consectetur a erat. Nunc
		                                        scelerisque viverra mauris in aliquam sem fringilla.</p>
		                                </div>
		                                <div class="tab-pane" id="product-tab-reviews">
		                                    <div class="row mb-4">
		                                        <div class="col-xl-4 col-lg-5 mb-4">
		                                            <ul class="comments list-style-none">
	                                                    <!-- <li class="comment">
	                                                        <div class="comment-body">
	                                                            <figure class="comment-avatar">
	                                                                <img src="{{ asset('user/images/agents/1-100x100.png') }}"
	                                                                    alt="Commenter Avatar" width="90" height="90">
	                                                            </figure>
	                                                            <div class="comment-content">
	                                                                <h4 class="comment-author">
	                                                                    <a href="#">John Doe</a>
	                                                                    <span class="comment-date">March 22, 2021 at
	                                                                        1:54 pm</span>
	                                                                </h4>
	                                                                <div class="ratings-container comment-rating">
	                                                                    <div class="ratings-full">
	                                                                        <span class="ratings"
	                                                                            style="width: 60%;"></span>
	                                                                        <span
	                                                                            class="tooltiptext tooltip-top"></span>
	                                                                    </div>
	                                                                </div>
	                                                                <p>pellentesque habitant morbi tristique senectus
	                                                                    et. In dictum non consectetur a erat.
	                                                                    Nunc ultrices eros in cursus turpis massa
	                                                                    tincidunt ante in nibh mauris cursus mattis.
	                                                                    Cras ornare arcu dui vivamus arcu felis bibendum
	                                                                    ut tristique.</p>
	                                                                <div class="comment-action">
	                                                                    <a href="#"
	                                                                        class="btn btn-secondary btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
	                                                                        <i class="far fa-thumbs-up"></i>Helpful (1)
	                                                                    </a>
	                                                                    <a href="#"
	                                                                        class="btn btn-dark btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
	                                                                        <i class="far fa-thumbs-down"></i>Unhelpful
	                                                                        (0)
	                                                                    </a>
	                                                                    <div class="review-image">
	                                                                        <a href="#">
	                                                                            <figure>
	                                                                                <img src="{{ asset('user/images/products/default/review-img-1.jpg') }} "
	                                                                                    width="60" height="60"
	                                                                                    alt="Attachment image of John Doe's review on Electronics Black Wrist Watch"
	                                                                                    data-zoom-image="{{ asset('user/images/products/default/review-img-1-800x900.jpg') }} " />
	                                                                            </figure>
	                                                                        </a>
	                                                                    </div>
	                                                                </div>
	                                                            </div>
	                                                        </div>
	                                                    </li>  -->
	                                                </ul>
		                                        </div>
		                                        @if(!empty(auth()->user()->id))
			                                        <div class="col-xl-8 col-lg-7 mb-4">
			                                            <div class="review-form-wrapper">
			                                                <h3 class="title tab-pane-title font-weight-bold mb-1">Submit Your Review</h3>
			                                                <p class="mb-3">Your email address will not be published. Required fields are marked *</p>
		                                				
			                                                <form action="#" method="POST" class="review-form">
			                                                    <div class="rating-form">
			                                                        <label for="rating">Your Rating Of This Product :</label>
			                                                        <span class="rating-stars">
			                                                            <a class="star-1" href="javascript:void(0);">1</a>
			                                                            <a class="star-2" href="javascript:void(0);">2</a>
			                                                            <a class="star-3" href="javascript:void(0);">3</a>
			                                                            <a class="star-4" href="javascript:void(0);">4</a>
			                                                            <a class="star-5" href="javascript:void(0);">5</a>
			                                                        </span>
			                                                        <select name="rating" id="rating" required=""
			                                                            style="display: none;">
			                                                            <option value="">Rate…</option>
			                                                            <option value="5">Perfect</option>
			                                                            <option value="4">Good</option>
			                                                            <option value="3">Average</option>
			                                                            <option value="2">Not that bad</option>
			                                                            <option value="1">Very poor</option>
			                                                        </select>
			                                                    </div>
			                                                    <textarea cols="30" rows="6"
			                                                        placeholder="Write Your Review Here..." class="form-control" id="review"></textarea>
			                                                    <div class="row gutter-md">
			                                                        <div class="col-md-6">
			                                                            <input type="text" class="form-control" placeholder="Your Name" id="author" value="{{ auth()->user()->name }}" readonly>
			                                                        </div>
			                                                        <div class="col-md-6">
			                                                            <input type="text" class="form-control" placeholder="Your Email" id="email_1" value="{{ auth()->user()->email }}" readonly>
			                                                        </div>
			                                                    </div>
			                                                    <div class="form-group">
			                                                        <input type="checkbox" class="custom-checkbox"
			                                                            id="save-checkbox">
			                                                        <label for="save-checkbox">Save my name, email, and website  in this browser for the next time I comment.</label>
			                                                    </div>
			                                                    <button type="submit" class="btn btn-dark">Submit Review</button>
			                                                </form>
			                                            </div>
			                                        </div>
			                                	@endif
			                                </div> 
		                                </div>
		                            </div>
		                        </div> 
		                        <section class="related-product-section">
		                            <div class="title-link-wrapper mb-4">
		                                <h4 class="title">Related Products</h4>
		                                <a href="{{ route('category.product',array('id' => $item->categories->id, 'slug' => Str::slug($item->categories->slug)))}}" class="btn btn-dark btn-link btn-slide-right btn-icon-right">More Products<i class="w-icon-long-arrow-right"></i></a>
		                            </div>
		                            <div class="owl-carousel owl-theme row cols-lg-3 cols-md-4 cols-sm-3 cols-2" data-owl-options="{
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
		                                        'items': 4
		                                    },
		                                    '992': {
		                                        'items': 3
		                                    }
		                                }
		                            }">
		                                @foreach($reletedProduct as $product)
					                        @include('user.product.product-box',$product)  
					                    @endforeach 
		                            </div>
		                        </section>
		                    </div>
		                    <!-- End of Main Content -->
		                    <aside class="sidebar product-sidebar sidebar-fixed right-sidebar sticky-sidebar-wrapper">
		                        <div class="sidebar-overlay"></div>
		                        <a class="sidebar-close" href="#"><i class="close-icon"></i></a>
		                        <a href="#" class="sidebar-toggle d-flex d-lg-none"><i class="fas fa-chevron-left"></i></a>
		                        <div class="sidebar-content scrollable">
		                            <div class="sticky-sidebar">
		                                <div class="widget widget-icon-box mb-6">
		                                    <div class="icon-box icon-box-side">
		                                        <span class="icon-box-icon text-dark">
		                                            <i class="w-icon-truck"></i>
		                                        </span>
		                                        <div class="icon-box-content">
		                                            <h4 class="icon-box-title">Free Shipping & Returns</h4>
		                                            <p>For all orders over $99</p>
		                                        </div>
		                                    </div>
		                                    <div class="icon-box icon-box-side">
		                                        <span class="icon-box-icon text-dark">
		                                            <i class="w-icon-bag"></i>
		                                        </span>
		                                        <div class="icon-box-content">
		                                            <h4 class="icon-box-title">Secure Payment</h4>
		                                            <p>We ensure secure payment</p>
		                                        </div>
		                                    </div>
		                                    <div class="icon-box icon-box-side">
		                                        <span class="icon-box-icon text-dark">
		                                            <i class="w-icon-money"></i>
		                                        </span>
		                                        <div class="icon-box-content">
		                                            <h4 class="icon-box-title">Money Back Guarantee</h4>
		                                            <p>Any back within 30 days</p>
		                                        </div>
		                                    </div>
		                                </div>
		                                <!-- End of Widget Icon Box -->

		                                <div class="widget widget-banner mb-9">
		                                    <div class="banner banner-fixed br-sm">
		                                        <figure>
		                                            <img src="{{ asset('user/images/shop/banner3.jpg') }} " alt="Banner" width="266" height="220" style="background-color: #1D2D44;" />
		                                        </figure>
		                                        <div class="banner-content">
		                                            <div class="banner-price-info font-weight-bolder text-white lh-1 ls-25"> 40<sup class="font-weight-bold">%</sup><sub class="font-weight-bold text-uppercase ls-25">Off</sub>
		                                            </div>
		                                            <h4  class="banner-subtitle text-white font-weight-bolder text-uppercase mb-0">
		                                                Ultimate Sale</h4>
		                                        </div>
		                                    </div>
		                                </div>  
		                            </div>
		                        </div>
		                    </aside>
		                    <!-- End of Sidebar -->
		                </div>
		            </div>
		        </div> 
		    </main>
		@endforeach
	@else
		<script>window.location = "/product";</script>
	@endif
@endsection