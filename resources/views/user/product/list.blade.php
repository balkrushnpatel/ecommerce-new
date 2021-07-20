@extends('layouts.master')
@section('title','Product')
@section('content')
	<main class="main">
		<!-- Start of Breadcrumb -->
		<nav class="breadcrumb-nav">
		    <div class="container">
		        <ul class="breadcrumb bb-no">
		            <li><a href="{{ url('/') }}">Home</a></li>
		            <li><a href="{{ route('product') }}">Shop</a></li> 
		        </ul>
		    </div>
		</nav> 
		<div class="page-content mb-10">
		    <div class="shop-default-banner shop-boxed-banner banner d-flex align-items-center mb-6"
		        style="background-image: url({{ asset('user/images/shop/banner2.jpg') }}); background-color: #FFC74E;">
		        <div class="container banner-content">
		            <h4 class="banner-subtitle font-weight-bold">Accessories Collection</h4>
		            <h3 class="banner-title text-white text-uppercase font-weight-bolder ls-10">Smart Watches</h3>
		            <a href="shop-banner-sidebar.html" class="btn btn-dark btn-rounded btn-icon-right">Discover
		                Now<i class="w-icon-long-arrow-right"></i></a>
		        </div>
		    </div> 
		    <div class="container-fluid"> 
		        <div class="shop-content"> 
		            <div class="main-content">
		                <nav class="toolbox sticky-toolbox sticky-content fix-top">
		                    <div class="toolbox-left">
		                        <a href="#" class="btn btn-primary btn-outline btn-rounded left-sidebar-toggle 
		                            btn-icon-left"><i class="w-icon-category"></i><span>Filters</span></a>
		                        <div class="toolbox-item toolbox-sort select-box text-dark">
		                            <label>Sort By :</label>
		                            <select name="orderby" class="form-control" id="filtter">
		                                <option value="" selected="selected">Default sorting</option>
		                                <option value="popularity">Sort by popularity</option>
		                                <option value="rating">Sort by average rating</option>
		                                <option value="date">Sort by latest</option>
		                                <option value="price-low">Sort by pric: low to high</option>
		                                <option value="price-high">Sort by price: high to low</option>
		                            </select>
		                        </div>
		                    </div>
		                    <div class="toolbox-right"> 
		                        <div class="toolbox-item toolbox-layout">
		                            <a href="javascript:void(0);" class="icon-mode-grid btn-layout shop-layout active" data-id="box-view">
		                                <i class="w-icon-grid"></i>
		                            </a>
		                            <a href="javascript:void(0);"  data-id="single-box-view" class="icon-mode-list btn-layout  shop-layout">
		                                <i class="w-icon-list"></i>
		                            </a>
		                        </div>
		                    </div>
		                </nav>
		                <div id="product-list-wrap">
		                	@include('user.product.product-list')
		                </div> 
		            </div> 
		            @include('user.product.filtter')   
		        </div> 
		    </div>
		</div> 
	</main>
@endsection