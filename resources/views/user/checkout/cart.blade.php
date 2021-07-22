@extends('layouts.master')
@section('title','Cart')
@section('content') 
	<main class="main cart"> 
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb shop-breadcrumb bb-no">
                    <li class="passed"><a href="{{ url('/') }}">Home</a></li>
                    <li class="active"><a href="{{ route('cart') }}">Shopping Cart</a></li>
                    <li><a href="javascript:void(0);">Checkout</a></li> 
                </ul>
            </div>
        </nav> 
        <div class="page-content">
            <div class="container" id="view-cart">
                @include('user.checkout.cart-table')
            </div>
        </div>
        <!-- End of PageContent -->
    </main>
@endsection