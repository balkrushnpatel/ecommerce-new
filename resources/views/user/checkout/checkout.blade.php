@extends('layouts.master')
@section('title','Checkout')
@section('content') 
	<main class="main checkout"> 
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb shop-breadcrumb bb-no">
                    <li class="passed"><a href="{{ url('/') }}">Home</a></li>
                    <li class="passed"><a href="{{ route('cart') }}">Shopping Cart</a></li>
                    <li class="active"><a href="javascript:void(0);">Checkout</a></li>
                </ul>
            </div>
        </nav> 
        <div class="page-content">
            <div class="container">
                <form class="form checkout-form" action="{{ route('order.place') }}" method="post">
                	@csrf
                    <div class="row mb-9">
                        <div class="col-lg-7 pr-lg-4 mb-4">
                            <h3 class="title billing-title text-uppercase ls-10 pt-1 pb-3 mb-0">
                                Billing Details
                            </h3>
                            <div class="row gutter-sm">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>First name *</label>
                                        <input type="text" class="form-control form-control-md" name="shipping_info[first_name]" value="{{ auth()->user()->first_name }}" required>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>Last name *</label>
                                        <input type="text" class="form-control form-control-md" name="shipping_info[last_name]" value="{{ auth()->user()->last_name }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row gutter-sm">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>Email Id</label>
                                		<input type="text" class="form-control form-control-md" name="shipping_info[email]" readonly value="{{ auth()->user()->email }}">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>Mobile No *</label>
                                        <input type="text" class="form-control form-control-md number" name="shipping_info[mobile_no]" value="{{ auth()->user()->mobile_no }}" required>
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label>Country / Region *</label>
                                <input type="text" class="form-control form-control-md" name="shipping_info[country]" value="" required>
                            </div>
                            <div class="form-group">
                                <label>Street address *</label>
                                <input type="text" placeholder="House number and street name" class="form-control form-control-md mb-2" name="shipping_info[address]" required>
                                <input type="text" placeholder="Apartment, suite, unit, etc. (optional)" class="form-control form-control-md" name="shipping_info[address_2]">
                            </div>
                            <div class="row gutter-sm">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Town / City *</label>
                                        <input type="text" class="form-control form-control-md" name="shipping_info[town]" required>
                                    </div>
                                    <div class="form-group">
                                        <label>ZIP *</label>
                                        <input type="text" class="form-control form-control-md" name="shipping_info[zip]" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>State *</label>
                                        <input type="text" class="form-control form-control-md" name="shipping_info[state]" value="" required>
                                    </div> 
                                </div>
                            </div> 
                            <div class="form-group checkbox-toggle pb-2">
                                <input type="checkbox" class="custom-checkbox" id="shipping-toggle"
                                    name="shipping-toggle" value="1">
                                <label for="shipping-toggle">Ship to a different address?</label>
                            </div>
                            <div class="checkbox-content">
                                <div class="row gutter-sm">
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>First name *</label>
                                            <input type="text" class="form-control form-control-md ship_diff_address" name="shipping_info[ship_first_name]" value="">
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>Last name *</label>
                                            <input type="text" class="form-control form-control-md ship_diff_address" name="shipping_info[ship_last_name]" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row gutter-sm">
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>Email Id *</label>
                                            <input type="text" class="form-control form-control-md ship_diff_address" name="shipping_info[ship_email_id]" value="">
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="form-group">
                                            <label>Mobile No *</label>
                                            <input type="text" class="form-control form-control-md ship_diff_address number" name="shipping_info[ship_mobile_no]" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"> 
                                    <label>Country / Region *</label>
                                	<input type="text" class="form-control form-control-md ship_diff_address" name="shipping_info[ship_country]" value="">
                                </div>
                                <div class="form-group">
                                    <label>Street address *</label>
                                    <input type="text" placeholder="House number and street name" class="form-control form-control-md ship_diff_address mb-2" name="shipping_info[ship_address]" value="">
                                    <input type="text" placeholder="Apartment, suite, unit, etc. (optional)" class="form-control form-control-md" name="shipping_info[ship_address_2]" value="">
                                </div>
                                <div class="row gutter-sm">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Town / City *</label>
                                            <input type="text" class="form-control form-control-md ship_diff_address" name="shipping_info[ship_town]" value="">
                                        </div>
                                        <div class="form-group">
                                            <label>Postcode *</label>
                                            <input type="text" class="form-control form-control-md ship_diff_address number" name="shipping_info[ship_zip]">
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <label for="order-notes">Order notes (optional)</label>
                                <textarea class="form-control mb-0" id="order-notes" name="order_notes" cols="30"rows="4" placeholder="Notes about your order, e.g special notes for delivery"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-5 mb-4 sticky-sidebar-wrapper">
                            <div class="order-summary-wrapper sticky-sidebar">
                                <h3 class="title text-uppercase ls-10">Your Order</h3>
                                <div class="order-summary">
                                    <table class="order-table">
                                        <thead>
                                            <tr>
                                                <th colspan="2">
                                                    <b>Product</b>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@if(!empty(Session::get('cart')))
    											@foreach(Session::get('cart') as $cart)
		                                            <tr class="bb-no">
		                                                <td class="product-name">{{ $cart['name'] }}<i class="fas fa-times"></i> <span class="product-quantity">{{ $cart['quantity'] }}</span></td>
		                                                <td class="product-total"><i class="fa fa-inr"></i> {{ $cart['total_price'] }}</td>
		                                            </tr> 
		                                        @endforeach
		                                    @endif
                                            <tr class="cart-subtotal bb-no">
                                                <td>
                                                    <b>Subtotal</b>
                                                </td>
                                                <td>
                                                    <b><i class="fa fa-inr"></i> {{ Session::get('total') }}</b>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr class="shipping-methods">
                                                <td colspan="2" class="text-left">
                                                    <h4 class="title title-simple bb-no mb-1 pb-0 pt-3">Shipping
                                                    </h4>
                                                    <ul id="shipping-method" class="mb-4">
                                                    	@php
                                                    		$freeShipping = '';
                                                    		$paidShipping = '';
                                                    		if(Session::get('shipping_cost') == '0'){
                                                    			$freeShipping = 'checked';
                                                    		}else{
                                                    			$paidShipping = 'checked';
                                                    		}
                                                    	@endphp
                                                        <li>
                                                            <div class="custom-radio">
                                                                <input type="radio" id="free-shipping"
                                                                    class="custom-control-input" name="shipping" disabled {{ $freeShipping }}>
                                                                <label for="free-shipping" class="custom-control-label color-dark">Free Shipping</label>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="custom-radio">
                                                                <input type="radio" id="flat-rate"class="custom-control-input" name="shipping" disabled {{ $paidShipping }}>
                                                                <label for="flat-rate" class="custom-control-label color-dark">Flat rate: <i class="fa fa-inr"></i> {{ getSetting('shipment_cost') }}</label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr class="order-total">
                                                <td>
                                                    <b>Discount</b>
                                                </td>
                                                <td>
                                                    <b>
                                                    	@if(Session::get('discount_type') == 1)
                                                    		<i class="fa fa-inr"></i> {{ Session::get('discount') }}
                                                    	@else
                                                    		<i class="fas fa-percent"></i> {{ Session::get('discount') }}
                                                    	@endif
                                                    </b>
                                                </td>
                                            </tr>
                                            <tr class="order-total">
                                                <th>
                                                    <b>Final Total</b>
                                                </th>
                                                <td>
                                                    <b><i class="fa fa-inr"></i> {{ Session::get('final_total') }}</b></b>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>

                                    <div class="payment-methods" id="payment_method">
                                        <h4 class="title font-weight-bold ls-25 pb-0 mb-1">Payment Methods</h4>
                                        <div class="accordion payment-accordion">
                                            <!-- <div class="card">
                                                <div class="card-header">
                                                    <a href="#cash-on-delivery" class="collapse">Direct Bank Transfor</a>
                                                </div>
                                                <div id="cash-on-delivery" class="card-body expanded">
                                                    <p class="mb-0">
                                                        Make your payment directly into our bank account. 
                                                        Please use your Order ID as the payment reference. 
                                                        Your order will not be shipped until the funds have cleared in our account.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header">
                                                    <a href="#payment" class="expand">Check Payments</a>
                                                </div>
                                                <div id="payment" class="card-body collapsed">
                                                    <p class="mb-0">
                                                        Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.
                                                    </p>
                                                </div>
                                            </div> -->
                                            <div class="card">
                                                <div class="card-header">
                                                    <a href="#delivery" class="expand">Cash on delivery</a>
                                                </div>
                                                <div id="delivery" class="card-body collapsed">
                                                    <p class="mb-0"> Pay with cash upon delivery.
                                                    </p>
                                                </div>
                                            </div>
                                            <!-- <div class="card p-relative">
                                                <div class="card-header">
                                                    <a href="#paypal" class="expand">Paypal</a>
                                                </div>
                                                <a href="https://www.paypal.com/us/webapps/mpp/paypal-popup" class="text-primary paypal-que" 
                                                    onclick="javascript:window.open('https://www.paypal.com/us/webapps/mpp/paypal-popup','WIPaypal',
                                                    'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); 
                                                    return false;">What is PayPal?
                                                </a>
                                                <div id="paypal" class="card-body collapsed">
                                                    <p class="mb-0">
                                                        Pay via PayPal, you can pay with your credit cart if you
                                                        don't have a PayPal account.
                                                    </p>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>

                                    <div class="form-group place-order pt-6">
                                        <button type="submit" class="btn btn-dark btn-block btn-rounded">Place Order</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div> 
    </main>
@endsection