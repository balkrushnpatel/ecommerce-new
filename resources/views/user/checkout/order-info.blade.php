<ul class="order-view list-style-none">
	                <li>
	                    <label>Order number</label>
	                    <strong># {{ $order->order_id}}</strong>
	                </li>
	                <li>
	                    <label>Status</label>
	                    <strong>{{deliveryStatus()[$order->status]}}</strong>
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
	                    <strong>
	                    	@if($order->payment_type == 1)
                        		Cash On Delivery 
                        	@else
                        		Paypal
                        	@endif
                        </strong>
	                </li>
	            </ul> 
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
	                    	@foreach(json_decode($order->order_detail) as $ord)
		                        <tr>
		                            <td>
		                                <a href="{{ $ord->url }}">{{ $ord->name }}</a>&nbsp;<strong>x {{ $ord->quantity }}</strong><br> 
		                            </td>
		                            <td><i class="fa fa-inr"></i> {{ $ord->total_price }}</td>
		                        </tr>
		                    @endforeach 
	                    </tbody>
	                    <tfoot>
	                        <tr>
	                            <th>Subtotal:</th>
	                            <td><i class="fa fa-inr"></i> {{ $order->total_amount }}</td>
	                        </tr>
	                        <tr>
	                            <th>Shipping Charge:</th>
	                            <td><i class="fa fa-inr"></i> {{ $order->shipping_charge }}</td>
	                        </tr>
	                        <tr>
	                            <th>Discount :</th>
	                            <td>
	                            	@if($order->discount_type == 1)
	                            		<i class="fa fa-inr"></i> 
	                            	@else
	                            		<i class="fa fa-percent"></i>
	                            	@endif
	                            	{{ $order->discount }}
	                            </td>
	                        </tr> 
	                        <tr class="total">
	                            <th class="border-no">Total:</th>
	                            <td class="border-no"><i class="fa fa-inr"></i> {{ $order->grand_total }}</td>
	                        </tr>
	                    </tfoot>
	                </table>
	            </div>
	            <div id="account-addresses">
	                <div class="row">
	                    <div class="col-sm-6 mb-8">
	                        <div class="ecommerce-address billing-address">
	                            <h4 class="title title-underline ls-25 font-weight-bold">Billing Address</h4>
	                            @php
	                            	$address = json_decode($order->shipping_info); 
	                            @endphp
	                            <address class="mb-4">
	                                <table class="address-table">
	                                    <tbody>
	                                        <tr>
	                                            <td>
	                                            	<strong>Name :</strong> {{ $address->first_name }} {{ $address->last_name }}</td>
	                                        </tr>
	                                        <tr>
	                                            <td class="email">
	                                            	<strong>Email :</strong> {{ $address->email }}
	                                            </td>
	                                        </tr>
	                                        <tr>
	                                            <td>
	                                            	<strong>Mobile No :</strong>{{ $address->mobile_no }}
	                                            </td>
	                                        </tr>
	                                        <tr>
	                                            <td>
	                                            	<strong>Address :</strong> {{ $address->address }} {{ $address->address_2 }}, {{ $address->town }} </br> 
	                                            	{{ $address->state }},{{ $address->country }} - {{ $address->zip }}</td>
	                                        </tr>
	                                    </tbody>
	                                </table>
	                            </address>
	                        </div>
	                    </div>
	                    @if($address->ship_first_name)
		                    <div class="col-sm-6 mb-8">
		                        <div class="ecommerce-address shipping-address">
		                            <h4 class="title title-underline ls-25 font-weight-bold">Shipping Address</h4>
		                            <address class="mb-4">
		                                <table class="address-table">
		                                    <tbody>
		                                        <tr>
		                                            <td>
		                                            	<strong>Name :</strong> {{ $address->ship_first_name }} {{ $address->ship_last_name }}</td>
		                                        </tr>
		                                        <tr>
		                                            <td class="email">
		                                            	<strong>Email :</strong> {{ $address->ship_email_id }}
		                                            </td>
		                                        </tr>
		                                        <tr>
		                                            <td>
		                                            	<strong>Mobile No :</strong>{{ $address->ship_mobile_no }}
		                                            </td>
		                                        </tr>
		                                        <tr>
		                                            <td>
		                                            	<strong>Address :</strong> {{ $address->ship_address }} {{ $address->ship_address_2 }}, {{ $address->ship_town }} </br> 
		                                            	{{ $address->ship_state }},{{ $address->ship_country }} - {{ $address->ship_zip }}</td>
		                                        </tr>
		                                    </tbody>
		                                </table>
		                            </address>
		                        </div>
		                    </div>
		                @endif
	                </div>
	            </div> 