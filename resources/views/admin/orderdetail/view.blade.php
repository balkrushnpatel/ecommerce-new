@extends('layouts.app')
@section('title','OrderView')
@section('content')
@include('layouts.partials.sub-header',['pageHeader' => 'OrderView'])
<div class="card card-custom card-shadowless rounded-top-0">
	<div class="card-body p-0">
		<div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
			<div class="col-xl-12 col-xxl-7">
				<!--begin: Wizard Form-->
				<form class="form mt-0 mt-lg-10 fv-plugins-bootstrap fv-plugins-framework" id="kt_form">
				    <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
						<!--begin::Section-->
						<h4 class="mb-10 font-weight-bold text-dark">Review your Order </h4>
						<h6 class="font-weight-bolder mb-3">Order Id</h6>
						<div>{{$orderView->order_id}}</div><br>
						<h6 class="font-weight-bolder mb-3">Order Date</h6>
						<div>{{$orderView->created_at}}</div><br>
						<h6 class="font-weight-bolder mb-3">Delivery Status</h6>
						<div>{{deliveryStatus()[$orderView->status]}}</div><br>
						<h6 class="font-weight-bolder mb-3">Delivery Address:</h6>
						<div class="text-dark-50 line-height-lg">
							@php
	                            	$address = json_decode($orderView->shipping_info); 
	                        @endphp
							<div>{{$address->address}}</div>
							<div>{{$address->address_2}}, {{ $address->town }}</div>
							<div>{{$address->state}},{{ $address->country }} - {{ $address->zip }}</div>
							
						</div>
						<div class="separator separator-dashed my-5"></div>
						<!--end::Section-->
						<!--begin::Section-->
						<h6 class="font-weight-bolder mb-3">Order Details:</h6>
						<div class="text-dark-50 line-height-lg">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th class="pl-0 font-weight-bold text-muted text-uppercase">Ordered Items</th>
											<th class="text-right font-weight-bold text-muted text-uppercase">Qty</th>
											<th class="text-right font-weight-bold text-muted text-uppercase">Unit Price</th>
											<th class="text-right pr-0 font-weight-bold text-muted text-uppercase">Amount</th>
										</tr>
									</thead>
								
									<tbody>
										
										<tr class="font-weight-boldest">
										
											@foreach(json_decode($orderView->order_detail) as $order)
											<td class="border-0 pl-0 pt-7 d-flex align-items-center">
											{{ $order->name }}</td>
											<td class="text-right pt-7 align-middle">{{$order->quantity}}</td>
											<td class="text-right pt-7 align-middle">{{$order->price}}</td>
											<td class="text-primary pr-0 pt-7 text-right align-middle">{{$order->total_price}}</td>
											@endforeach
										</tr>
										
									    <tr>
											<td colspan="2"></td>
											<td class="font-weight-bolder text-right">Subtotal</td>
											<td class="font-weight-bolder text-right pr-0">{{$orderView->total_amount}}</td>
										</tr>
										<tr>
											<td colspan="2" class="border-0 pt-0"></td>
											<td class="border-0 pt-0 font-weight-bolder text-right">Delivery Fees</td>
											
											<td class="border-0 pt-0 font-weight-bolder text-right pr-0">{{ $orderView->shipping_charge }}</td>
											
										</tr>
										<tr>
											<td colspan="2" class="border-0 pt-0"></td>
											<td class="border-0 pt-0 font-weight-bolder font-size-h5 text-right">Grand Total</td>
											<td class="border-0 pt-0 font-weight-bolder font-size-h5 text-success text-right pr-0">{{$orderView->grand_total}}</td>
										</tr>
									</tbody>
									
								</table>
							</div>
						</div>
						<div class="separator separator-dashed my-5"></div>
						<!--end::Section-->
						<!--begin::Section-->
						<div>
							<button type="button" class="btn btn-primary font-weight-bold" onclick="window.print();">Print Order Details</button>
						</div>
						<!--end::Section-->
					</div>
				</form>
				<!--end: Wizard Form-->
			</div>
		</div>
	</div>
</div>
@endsection