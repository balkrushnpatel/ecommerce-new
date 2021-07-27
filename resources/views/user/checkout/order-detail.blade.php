@extends('layouts.master')
@section('title','Order Detail')
@section('content') 
	<main class="main order"> 
	    <nav class="breadcrumb-nav">
	        <div class="container">
	            <ul class="breadcrumb shop-breadcrumb bb-no">
	                <li class="passed"><a href="{{ url('/') }}">Home</a></li>
	                <li class="active">
	                	<a href="javascript:void(0);">Order Complete</a>
	                </li>
	            </ul>
	        </div>
	    </nav>
	    <!-- End of Breadcrumb -->

	    <!-- Start of PageContent -->
	    <div class="page-content mb-10 pb-2">
	        <div class="container"> 
	            <div class="order-success text-center font-weight-bolder text-dark">
	                <i class="fas fa-check"></i>
	                Thank you. Your order has been received.
	            </div>  
	            @include('user.checkout.order-info',$order)
	            <a href="{{ route('user.acount') }}" class="btn btn-dark btn-rounded btn-icon-left btn-back mt-6"><i class="w-icon-long-arrow-left"></i>Back To List</a>
	        </div>
	    </div>
	    <!-- End of PageContent -->
	</main>
@endsection