@extends('layouts.app')
@section('title','Coupon Code Create')
@section('content')
@include('layouts.partials.sub-header',['pageHeader' => 'Coupon Code'])
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container-fluid"> 
		<!--begin::Card-->
		<div class="card card-custom">
			<div class="card-header flex-wrap py-3">
				<div class="card-title">
					<h3 class="card-label">Coupon Code
					<span class="d-block text-muted pt-2 font-size-sm">Add &amp; Edit Coupon Code</span></h3>
				</div> 
				<div class="card-toolbar">  
					<!--begin::Button-->
					<a href="{{ route('couponcode.index') }}" class="btn btn-primary font-weight-bolder">
					<span class="svg-icon svg-icon-md"> 
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
						    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						        <rect x="0" y="0" width="24" height="24"/>
						        <path d="M11.0879549,18.2771971 L17.8286578,12.3976203 C18.0367595,12.2161036 18.0583109,11.9002555 17.8767943,11.6921539 C17.8622027,11.6754252 17.8465132,11.6596867 17.8298301,11.6450431 L11.0891271,5.72838979 C10.8815919,5.54622572 10.5656782,5.56679309 10.3835141,5.7743283 C10.3034433,5.86555116 10.2592899,5.98278612 10.2592899,6.10416552 L10.2592899,17.9003957 C10.2592899,18.1765381 10.4831475,18.4003957 10.7592899,18.4003957 C10.8801329,18.4003957 10.9968872,18.3566309 11.0879549,18.2771971 Z" fill="#000000" opacity="0.3" transform="translate(14.129645, 12.002277) scale(-1, 1) translate(-14.129645, -12.002277) "/>
						        <path d="M5.08795487,18.2771971 L11.8286578,12.3976203 C12.0367595,12.2161036 12.0583109,11.9002555 11.8767943,11.6921539 C11.8622027,11.6754252 11.8465132,11.6596867 11.8298301,11.6450431 L5.08912711,5.72838979 C4.8815919,5.54622572 4.56567821,5.56679309 4.38351414,5.7743283 C4.30344325,5.86555116 4.25928988,5.98278612 4.25928988,6.10416552 L4.25928988,17.9003957 C4.25928988,18.1765381 4.48314751,18.4003957 4.75928988,18.4003957 C4.88013293,18.4003957 4.99688719,18.3566309 5.08795487,18.2771971 Z" fill="#000000" transform="translate(8.129645, 12.002277) scale(-1, 1) translate(-8.129645, -12.002277) "/>
						    </g>
						</svg> 
					</span>Back</a> 
				</div>
			</div>
		  <form id="couponcode-form"  class="form fv-plugins-bootstrap fv-plugins-framework" action="@yield('editId',route('couponcode.index'))" method="post" accept-charset="utf-8" role="form" enctype="multipart/form-data">
				{{csrf_field()}}
				@section('editMethod')
				@show  
				@csrf 
				<div class="card-body"> 
					<div class="row"> 
					    <div class="col-sm-12 col-md-12"> 
					    	<div class="row">
					        	<div class="col-lg-4 form-group">
							    	<label for="couponcode-code" class="col-form-label"> Code <span class="required">*</span></label>
							      	<input type="text" class="form-control" id="code" value="{{ (isset($code)) ? $code->code : '' }}" name="code">
							      	<div class="fv-plugins-message-container"></div>
						        </div>  
					        	<div class="col-lg-4 form-group">
							    	<label for="couponcode-description" class="col-form-label">  Description </label> 
							      	<input type="text" class="form-control" id="couponcode-description" value="{{ (isset($code)) ? $code->description : '' }}" name="description">
							      	<div class="fv-plugins-message-container"></div>
						        </div>  
								<div class="col-lg-4 form-group">
									<label for="codetype" class="col-form-label"> Discount Type <span class="required">*</span></label>
									<select class="form-control select2" name="type" id="type"> 
								        <option value="">Select</option> 								
										<option value="1" @if((isset($code->type) && $code->type == '1')) selected="selected" @endif>Amount</option>	
										<option value="2" @if((isset($code->type) && $code->type == '2')) selected="selected" @endif>Percentage</option>
									</select>
									<div class="fv-plugins-message-container"></div> 
								</div> 
					        	<div class="col-lg-4 form-group">
							    	<label for="couponcode-discount">Discount</label> 
							      	<input type="text" class="form-control" id="couponcode-discount" value="{{ (isset($code)) ? $code->discount : '' }}" name="discount">
							      	<div class="fv-plugins-message-container"></div>
						        </div>  
							  	<div class="col-lg-4 form-group"> 
									<label>Valid Date <span class="text-danger">*</span></label>
									<input class="form-control datepicker" id="valid_date" placeholder="Choose Date" value="{{ (isset($code)) ? $code->valid_date : '' }}"autocomplete="off" data-rule-required="true" name="valid_date" type="text">
								</div>   
					        	<div class="col-lg-4 form-group">
							    	<label for="discount_on" class="col-form-label">Discount On</label> 
							      	<select class="form-control select2" name="discount_on" id="discount_on"> 
								        <option value="">Select</option> 
										<option value="1" @if((isset($code->discount_on) && $code->discount_on == '1')) selected="selected" @endif>All Product</option>
										<option value="2" @if((isset($code->discount_on) && $code->discount_on == '2')) selected="selected" @endif>Category</option>
										<option value="3" @if((isset($code->discount_on) && $code->discount_on == '3')) selected="selected" @endif>SubCategory</option>
										<option value="4" @if((isset($code->discount_on) && $code->discount_on == '4')) selected="selected" @endif>Product</option>
									</select>
						      		<div class="fv-plugins-message-container"></div>
						        </div>  
								<div class="col-lg-4 form-group">
									<label for="discountType" class="col-form-label" id="discountType">  Category <span class="required">*</span></label>
									<select class="form-control select2" name="cat_id[]" id="cat_id" multiple="multiple"> 
										<option value=""> Select Category</option>
									</select>
									<div class="fv-plugins-message-container"></div>
								</div> 
						  	 	<div class="col-lg-4 form-group mt-15">
	  	 							<div class="radio-inline">
	  	 								<label>Status <span class="required">*</span></label>&nbsp&nbsp&nbsp
										<label class="radio radio-success">
											<input type="radio" name="status" value="1" {{ (isset($code) && ($code->status == 1) ) ? 'checked': ''}} >
											<span></span>Active
										</label>
										<label class="radio radio-success">
										<input type="radio" name="status" value="0" {{ (isset($code) && ($code->status == 0) ) ? 'checked': ''}}>
										<span></span>Deactive</label> 
									</div>
								</div>
							</div>  
					    </div> 
					</div> 
				</div>
				<div class="card-footer">
					<div class="row">
						<div class="col-lg-12">
							<a href="{{ route('couponcode.index')}}" class="btn btn-light-primary font-weight-bold">Cancel</a>
							<button type="submit" class="btn btn-light-success font-weight-bold mr-2">{{ isset($code) ? 'Update' : 'Save' }} </button>
						</div>
					</div>
				</div>
			</form>
		</div> 
    </div> 
</div> 
@endsection
@push('scripts')  
<script src="{{ asset('wjs/couponcode.js')}}"></script>
@endpush