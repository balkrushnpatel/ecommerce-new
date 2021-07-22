@extends('layouts.app')
@section('title','Package Create')
@section('content')
@include('layouts.partials.sub-header',['pageHeader' => 'Package'])
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container-fluid"> 
		<!--begin::Card-->
		<div class="card card-custom">
			<div class="card-header flex-wrap py-3">
				<div class="card-title">
					<h3 class="card-label">Package
					<span class="d-block text-muted pt-2 font-size-sm">Add &amp; Edit Package</span></h3>
				</div> 
				<div class="card-toolbar">  
					<!--begin::Button-->
					<a href="{{ route('package.index') }}" class="btn btn-primary font-weight-bolder">
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
		  <form id="package-form"  class="form fv-plugins-bootstrap fv-plugins-framework" action="@yield('editId',route('package.index'))" method="post" accept-charset="utf-8" role="form" enctype="multipart/form-data">
				{{csrf_field()}}
				@section('editMethod')
				@show  
				@csrf 
				<div class="card-body"> 
					<div class="row"> 
					    <div class="col-sm-12 col-md-12"> 
					    	<div class=" row">
					        	<div class="col-lg-4 form-group">
							    	<label for="package-name" class="col-form-label"> Package Name <span class="required">*</span></label>
							      	<input type="text" class="form-control" id="name" value="{{ (isset($package)) ? $package->name : '' }}" name="name">
							      	<div class="fv-plugins-message-container"></div>
						        </div>  
					        	<div class="col-lg-4 form-group">
							    	<label for="package-description" class="col-form-label">  Description </label> 
							      	<input type="text" class="form-control" id="package-description" value="{{ (isset($package)) ? $package->description : '' }}" name="description">
							      	<div class="fv-plugins-message-container"></div>
						        </div> 
					        	<div class="col-lg-4 form-group">
							    	<label for="package-price" class="col-form-label">Price</label> 
							      	<input type="text" class="form-control" id="package-price" value="{{ (isset($package)) ? $package->price : '' }}" name="price">
							      	<div class="fv-plugins-message-container"></div>
						        </div>  
								<div class="col-lg-4 form-group">
									<label for="validity" class="col-form-label"> Validity<span class="required">*</span></label>
									<select class="form-control select2" name="validity" id="validity"> 
								        <option value="">Select Validity</option> 
										<option value="1" @if((isset($package->validity) && $package->validity == '1')) selected="selected" @endif>3 Months</option>
										<option value="2" @if((isset($package->validity) && $package->validity == '2')) selected="selected" @endif>6 Months</option>
										<option value="3" @if((isset($package->validity) && $package->validity == '3')) selected="selected" @endif>12 Months</option>
									</select>
									<div class="fv-plugins-message-container"></div>
								</div> 
					        	<div class="col-lg-4 form-group">
						           <label class="col-form-label" for="package-image">Image</label> 
						      	   <input type="file" class="form-control" id="package-image"value="{{ (isset($package)) ? $package->image : '' }}" name="image">
							      	<div class="fv-plugins-message-container"></div>
						        </div> 
						  	 	<div class="col-lg-4 form-group mt-15">
	  	 							<div class="radio-inline">
	  	 								<label>Status <span class="required">*</span></label>&nbsp&nbsp&nbsp
										<label class="radio radio-success">
											<input type="radio" name="status" value="1" {{ (isset($package) && ($package->status == 1) ) ? 'checked': ''}} >
											<span></span>Active
										</label>
										<label class="radio radio-success">
										<input type="radio" name="status" value="0" {{ (isset($package) && ($package->status == 0) ) ? 'checked': ''}}>
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
							<a href="{{ route('package.index')}}" class="btn btn-light-primary font-weight-bold">Cancel</a>
							<button type="submit" class="btn btn-light-success font-weight-bold mr-2">{{ isset($package) ? 'Update' : 'Save' }} </button>
						</div>
					</div>
				</div>
			</form>
		</div> 
    </div> 
</div> 
@endsection
@push('scripts')  
<script src="{{ asset('wjs/package.js')}}"></script>
@endpush