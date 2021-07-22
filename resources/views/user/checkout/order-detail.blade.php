@extends('layouts.master')
@section('title','Order Detail')
@section('content') 
	<main class="main order"> 
	    <nav class="breadcrumb-nav">
	        <div class="container">
	            <ul class="breadcrumb shop-breadcrumb bb-no">
	                <li class="passed"><a href="{{ url('/') }}">Home</a></li>
	                <li class="active"><a href="javascript:void(0);">Order Complete</a></li>
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
	            <ul class="order-view list-style-none">
	                <li>
	                    <label>Order number</label>
	                    <strong># {{ $order->order_id}}</strong>
	                </li>
	                <li>
	                    <label>Status</label>
	                    <strong>Pending</strong>
	                </li>
	                <li>
	                    <label>Date</label>
	                    <strong>{{ $order->created_at->format('M-d,Y')}}</strong>
	                </li>
	                <li>
	                    <label>Total</label>
	                    <strong><i class="fa fa-inr"></i> {{ $order->grand_total}}</strong>
	                </li>
	                <li>
	                    <label>Payment method</label>
	                    <strong>Cash On Delivery</strong>
	                </li>
	            </ul>
	            <!-- End of Order View -->

	            <div class="order-details-wrapper mb-5">
	                <h4 class="title text-uppercase ls-25 mb-5">Order Details</h4>
	                <table class="order-table">
	                    <thead>
	                        <tr>
	                            <th class="text-dark">Product</th>
	                            <th></th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                        <tr>
	                            <td>
	                                <a href="#">Palm Print Jacket</a>&nbsp;<strong>x 1</strong><br>
	                                Vendor : <a href="#">Vendor 1</a>
	                            </td>
	                            <td>$40.00</td>
	                        </tr>
	                        <tr>
	                            <td>
	                                <a href="#">Brown Backpack</a>&nbsp;<strong>x 1</strong><br>
	                                Vendor : <a href="#">Vendor 1</a>
	                            </td>
	                            <td>$60.00</td>
	                        </tr>
	                    </tbody>
	                    <tfoot>
	                        <tr>
	                            <th>Subtotal:</th>
	                            <td>$100.00</td>
	                        </tr>
	                        <tr>
	                            <th>Shipping:</th>
	                            <td>Flat rate</td>
	                        </tr>
	                        <tr>
	                            <th>Payment method:</th>
	                            <td>Direct bank transfor</td>
	                        </tr>
	                        <tr class="total">
	                            <th class="border-no">Total:</th>
	                            <td class="border-no">$100.00</td>
	                        </tr>
	                    </tfoot>
	                </table>
	            </div>
	            <div id="account-addresses">
	                <div class="row">
	                    <div class="col-sm-6 mb-8">
	                        <div class="ecommerce-address billing-address">
	                            <h4 class="title title-underline ls-25 font-weight-bold">Billing Address</h4>
	                            <address class="mb-4">
	                                <table class="address-table">
	                                    <tbody>
	                                        <tr>
	                                            <td>John Doe</td>
	                                        </tr>
	                                        <tr>
	                                            <td>Conia</td>
	                                        </tr>
	                                        <tr>
	                                            <td>Wall Street</td>
	                                        </tr>
	                                        <tr>
	                                            <td>California</td>
	                                        </tr>
	                                        <tr>
	                                            <td>United States (US)</td>
	                                        </tr>
	                                        <tr>
	                                            <td>92020</td>
	                                        </tr>
	                                        <tr>
	                                            <td>1112223334</td>
	                                        </tr>
	                                        <tr class="email">
	                                            <td>nicework125@gmail.com</td>
	                                        </tr>
	                                    </tbody>
	                                </table>
	                            </address>
	                        </div>
	                    </div>
	                    <div class="col-sm-6 mb-8">
	                        <div class="ecommerce-address shipping-address">
	                            <h4 class="title title-underline ls-25 font-weight-bold">Shipping Address</h4>
	                            <address class="mb-4">
	                                <table class="address-table">
	                                    <tbody>
	                                        <tr>
	                                            <td>John Doe</td>
	                                        </tr>
	                                        <tr>
	                                            <td>Conia</td>
	                                        </tr>
	                                        <tr>
	                                            <td>Wall Street</td>
	                                        </tr>
	                                        <tr>
	                                            <td>California</td>
	                                        </tr>
	                                        <tr>
	                                            <td>United States (US)</td>
	                                        </tr>
	                                        <tr>
	                                            <td>92020</td>
	                                        </tr>
	                                    </tbody>
	                                </table>
	                            </address>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <!-- End of Account Address -->

	            <a href="#" class="btn btn-dark btn-rounded btn-icon-left btn-back mt-6"><i class="w-icon-long-arrow-left"></i>Back To List</a>
	        </div>
	    </div>
	    <!-- End of PageContent -->
	</main>
@endsection