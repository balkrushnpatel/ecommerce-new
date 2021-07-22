@extends('layouts.app')
@section('title','Slider Create')
@section('content')
@include('layouts.partials.sub-header',['pageHeader' => 'Slider'])
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container-fluid"> 
		<!--begin::Card-->
		<div class="card card-custom">
			<div class="card-header flex-wrap py-3">
				<div class="card-title">
					<h3 class="card-label">Slider
					<span class="d-block text-muted pt-2 font-size-sm">Add &amp; Edit Slider</span></h3>
				</div> 
				<div class="card-toolbar">  
					<!--begin::Button-->
					<a href="{{ route('slider.index') }}" class="btn btn-primary font-weight-bolder">
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
		  <form id="slider-form"  class="form fv-plugins-bootstrap fv-plugins-framework" action="@yield('editId',route('slider.index'))" method="post" accept-charset="utf-8" role="form" enctype="multipart/form-data">
				{{csrf_field()}}
				@section('editMethod')
				@show  
				@csrf 
				<div class="card-body"> 
					<div class="row"> 
					    <div class="col-sm-12 col-md-12"> 
					        <div class="row">
					        	<div class="col-lg-4">
							    	<label for="slider-name" class="col-form-label"> Title <span class="required">*</span></label>
							      	<input type="text" class="form-control" id="name" value="{{ (isset($slider)) ? $slider->name : '' }}" name="name">
							      	<div class="fv-plugins-message-container"></div>
						        </div>  
					        	<div class="col-lg-4 form-group">
							    	<label for="slider-link" class="col-form-label"> Link <span class="required">*</span></label>
							      	<input type="text" class="form-control" id="link" value="{{ (isset($slider)) ? $slider->link : '' }}" name="link">
							      	<div class="fv-plugins-message-container"></div>
						        </div>  
					        	<div class="col-lg-4 form-group">
						           <label class="col-form-label" for="slider-image">Image</label> 
						      	   <input type="file" class="form-control" id="slider-image"value="{{ (isset($slider)) ? $slider->image : '' }}" name="image">
						      		<div class="fv-plugins-message-container"></div>
						        </div> 
					            <div class="col-lg-12 form-group">
							    	<label for="slider-text" class="col-form-label">Text</label> 
							      	<textarea name="text" class="form-control summernote">{{ (isset($slider)) ? $slider->text : '' }}
									</textarea>
						      	    <div class="fv-plugins-message-container"></div>
						        </div>  
						  	 	<div class="col-lg-12">
	  	 							<div class="radio-inline">
	  	 								<label>Status <span class="required">*</span></label>&nbsp&nbsp&nbsp
										<label class="radio radio-success">
											<input type="radio" name="status" value="1" {{ (isset($slider) && ($slider->status == 1) ) ? 'checked': ''}} >
											<span></span>Active
										</label>
										<label class="radio radio-success">
										<input type="radio" name="status" value="0" {{ (isset($slider) && ($slider->status == 0) ) ? 'checked': ''}}>
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
							<a href="{{ route('slider.index')}}" class="btn btn-light-primary font-weight-bold">Cancel</a>
							<button type="submit" class="btn btn-light-success font-weight-bold mr-2">{{ isset($slider) ? 'Update' : 'Save' }} </button>
						</div>
					</div>
				</div>
			</form>
		</div> 
    </div> 
</div> 
@endsection
@push('scripts')  
<script src="{{ asset('wjs/slider.js')}}"></script>
@endpush