@extends('layouts.app')
@section('title','OrderDetail')
@section('content')
@include('layouts.partials.sub-header',['pageHeader' => 'OrderDetail'])
<!--begin::Entry-->
<div class="d-flex flex-column-fluid"> 
    <div class="container-fluid">  
		<div class="card card-custom">
			<div class="card-header flex-wrap py-3">
				<div class="card-title">
					<h3 class="card-label"> OrderDetail Managed
					<span class="d-block text-muted pt-2 font-size-sm">Listing OrderDetail </span></h3>
				</div> 
			</div>
			<div class="card-body">				
				<table class="table table-bordered table-hover table-checkable" id="orderDetail-datatable" style="margin-top: 13px !important">
					<thead>
						<tr>
							<th>{{ tableHeader(0) }}</th>
							<th>{{ tableHeader(34) }}</th>
							<th>{{ tableHeader(35) }}</th>
							<th>{{ tableHeader(36) }}</th>
							<th>{{ tableHeader(1) }}</th>
							<th>{{ tableHeader(37) }}</th>
							<th>{{ tableHeader(4) }}</th>
                        </tr>
					</thead> 
				</table> 
			</div>
		</div> 
    </div> 
</div>
<div class="modal fade" id="delivery-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delivery Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                 </button>
            </div>
          
             <form  id="delivery-form" method="post" action="{{route('delivery.payment')}}" role="form">
			    @csrf 
	            <div class="modal-body">
	               <div class="card">
	               	<input type="hidden" name="order_id" id="order_id">
	                       <div class="card-body"> 
		                        <div class="form-group"> 
			                        <label for="boundary_type"  class="">Payment Status<span class="text-danger">*</span></label> 
			                          <div class="select2-input">
			                            <select id="payment_status" name="payment_status" class="form-control select2" style="width:100%">
	                						<option value="">Choose One</option>
	                						@if(paymentStatus())
											 	@foreach(paymentStatus() as $key => $value)
											 		<option value="{{ $key }}" {{ (isset($selected_id) && $selected_id == $key) ? 'selected' : '' }} >{{ $value }}</option>
											 	@endforeach
											 @endif
	                                    </select>
	                                  </div>
		                        </div>
								<div class="form-group">
									<label  class="" for="from_date">Payment Details <span class="text-danger">*</span></label>
									<textarea class="form-control" autocomplete="off" data-rule-required="true" name="payment_details"></textarea>
								</div>  
		                        <div class="form-group">
			                        <label for="delivery_status"  class="">  Delivery Status <span class="text-danger">*</span></label>
			                        <div class="select2-input">
			                          <select id="delivery_status" name="status" class="form-control select2" style="width:100%">
	                						<option value="">Choose One</option>
	                						@if(deliveryStatus())
											 	@foreach(deliveryStatus() as $key => $value)
											 		<option value="{{ $key }}" {{ (isset($selected_id) && $selected_id == $key) ? 'selected' : '' }} >{{ $value }}</option>
											 	@endforeach
											 @endif
	                                    </select>  
                                	</div>
		                        </div>
								<div class="form-group">
									<label  class=""> Details on Delivery Status <span class="text-danger">*</span></label>
									<textarea class="form-control" autocomplete="off" data-rule-required="true" name="delivery_details"></textarea>
								</div>  
		                    </div> 
                   </div>
	            </div>

	            <div class="modal-footer">
	                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cancel</button>
	                <button type="submit" class="btn btn-primary font-weight-bold" id="order_delivery">Save</button>
	            </div>
	        </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('wjs/orderDetail.js')}}"></script>
@endpush