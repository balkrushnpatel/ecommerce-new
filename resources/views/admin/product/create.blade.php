@extends('layouts.app')
@section('title','Product Create')
@section('content')
@include('layouts.partials.sub-header',['pageHeader' => 'Product'])
<div class="d-flex flex-column-fluid"> 
	<div class="container-fluid">
		<div class="card card-custom">
			<div class="card-header flex-wrap py-3">
				<div class="card-title">
					<h3 class="card-label">Product
					<span class="d-block text-muted pt-2 font-size-sm">Add &amp; Edit Product</span></h3>
				</div>
			</div>
			<div class="card-body"> 
				<div class="wizard wizard-3" id="kt_wizard_v3" data-wizard-state="step-first" data-wizard-clickable="true"> 
					<div class="wizard-nav">
						<div class="wizard-steps px-8 py-8 px-lg-15 py-lg-3"> 
							<div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
								<div class="wizard-label">
									<h3 class="wizard-title">
									<span>Product Detail</span></h3>
									<div class="wizard-bar"></div>
								</div>
							</div> 
							<div class="wizard-step" data-wizard-type="step">
								<div class="wizard-label">
									<h3 class="wizard-title">
									<span>Business Detail</span></h3>
									<div class="wizard-bar"></div>
								</div>
							</div> 
							<div class="wizard-step" data-wizard-type="step">
								<div class="wizard-label">
									<h3 class="wizard-title">
									<span>Choice Option</span></h3>
									<div class="wizard-bar"></div>
								</div>
							</div>  
						</div>
					</div> 
					<div class="row"> 
						<div class="col-sm-12 col-lg-12"> 
							<form id="kt_form"  class="form fv-plugins-bootstrap fv-plugins-framework" id="addmore" action="@yield('editId',route('product.index'))" method="post" accept-charset="utf-8" role="form" enctype="multipart/form-data">
							{{csrf_field()}}
							@section('editMethod')
							@show  
							@csrf  
								<div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
									<div class="row">
										<div class="col-sm-12 col-lg-4">
											<div class="form-group">
												<label for="product-name" class="col-form-label"> Product Name <span class="required">*</span></label>
		      									<input type="text" class="form-control" id="name" value="{{ (isset($product)) ? $product->name : '' }}" name="name">
											</div>
										</div>
										<div class="col-sm-12 col-lg-4">
											<div class="form-group">
												<label for="cat_id" class="col-form-label">  Category <span class="required">*</span></label>
												<select class="form-control select2" name="cat_id" id="cat_id"> 
													<option value=""> Select  Category</option> 
													@foreach(getCategory() as $key => $category) 
														@if(isset($product->cat_id) && ($product->cat_id == $category['id']))
															<option selected value="{{ $category['id'] }}"> {{ $category['name'] }}</option>
														@else
															<option value="{{ $category['id'] }}"> {{ $category['name'] }}</option>
														@endif
													@endforeach  
												</select>
											</div> 
										</div>
										<div class="col-sm-12 col-lg-4">
											<div class="form-group">
												<div class="col-lg-12">
													<label for="subcat_id" class="col-form-label">  Subcategory <span class="required">*</span></label>
													<select class="form-control select2" name="subcat_id" id="subcat_id"> 
														<option value=""> Select  Subcategory</option> 
														
													</select>
													<div class="fv-plugins-message-container"></div>
												</div>
											</div> 
										</div>
										<div class="col-sm-12 col-lg-4">
											<label for="brand_id" class="col-form-label">  Brand <span class="required">*</span></label>
											<select class="form-control select2" name="brand_id" id="brand_id"> 
												<option value=""> Select Brand</option>  
											</select>
										</div>
										<div class="col-sm-12 col-lg-4">
											 <div class="form-group">
												<label for="product-unit" class="col-form-label"> Unit <span class="required">*</span></label>
												<input type="text" class="form-control number" id="unit" value="{{ (isset($product)) ? $product->unit : '' }}" name="unit">
											</div>
										</div>
										<div class="col-sm-12 col-lg-4">
											<div class="form-group">
												<label for="product-tags" class="col-form-label">Tags <span class="required">*</span></label>
												<input id="kt_tagify_1" class="form-control tagify" name='tags' placeholder='type...' value="{{ $product->tags }}" style="height: 20px;" />
											</div>   
										</div>
										<div class="col-sm-12 col-lg-4">
											<div class="form-group">
												<label class="col-form-label" for="product-image">Image</label> 
		   										<input type="file" class="form-control" id="product-image"value="{{ (isset($product)) ? $product->image : '' }}" name="image[]" multiple >
		   										<div class="images-preview-div"></div>
											</div>
										</div> 
										<div class="col-sm-12 col-lg-12">
											<div class="form-group">
												<label for="product-description" class="col-form-label">  Description </label>
										        <textarea name="description" id="kt-ckeditor-1">{{ (isset($product)) ? $product->description : '' }}
										        </textarea>
											</div>
										</div>
									</div> 
								</div> 
								<div class="pb-5" data-wizard-type="step-content">
									<div class="row">
										<div class="col-sm-12 col-lg-4"> 
											<div class="form-group">
												<label for="product-price" class="col-form-label"> Sale Price</label> 
		      									<input type="text" class="form-control number" id="product-price" value="{{ (isset($product)) ? $product->price : '' }}" name="price">
											</div>
										</div> 
										<div class="col-sm-12 col-lg-4">
											<div class="form-group">
												<label for="product-price" class="col-form-label"> Purchase Price</label> 
												<input type="text" class="form-control number" id="product-price" value="{{ (isset($product)) ? $product->purchase_price : '' }}" name="purchase_price">
											</div>
										</div> 
										<div class="col-sm-12 col-lg-4">
											<div class="form-group">
												<label for="product-qty" class="col-form-label">Qty</label> 
												<input type="text" class="form-control number" id="product-qty" value="{{ (isset($product)) ? $product->qty : '' }}" name="qty">
											</div>
										</div> 
										<div class="col-sm-12 col-lg-4">
											<div class="form-group">
												<label for="product-shipping-cost" class="col-form-label"> Shipping Cost</label> 
												<input type="text" class="form-control number" id="product-shipping-cost" value="{{ (isset($product)) ? $product->shipping_cost : '' }}" name="shipping_cost">
											</div>
										</div> 
										<div class="col-sm-12 col-lg-4">
									        <div class="form-group">
												<label for="product-discount" class="col-form-label"> Product Discount</label> 
		  										<input type="text" class="form-control number" id="product-discount" value="{{ (isset($product)) ? $product->discount : '' }}" name="discount">
											</div>
										</div> 
										<div class="col-sm-12 col-lg-4">
											<div class="form-group">
												<label for="product-discount" class="col-form-label"> Product tax</label> 
		  										<input type="text" class="form-control number" id="product-discount" value="{{ (isset($product)) ? $product->tax : '' }}" name="tax">
											</div>
										</div>
									</div>
								</div>
								<div class="pb-5" data-wizard-type="step-content">
									<div class="row"> 
										<div class="col-sm-12 col-lg-12">
											@php $i= '1'; @endphp
											@if(!empty($product->color))
												@foreach(json_decode($product->color) as $color)
													<div class="row pb-3 {{ ($i != 1)?'row-item':'' }}" id="row{{ $i }}">
											           <div class="col-lg-6 colorpicker-component">
											    		   <input type="text" placeholder="Choice color" class="form-control" name="input_color[]" value="{{ $color }}">
											    	   </div> 
												       	@if($i != '1')
												       		<div class="col-lg-2">
																<button id="{{ $i }}" class=" btn btn-sm btn-danger btn_remove">X</button>
															</div> 
												       	@endif
												       	@php $i++; @endphp
												    </div>
												@endforeach
											@else
												<div class="row pb-3">
										           <div class="col-lg-6 colorpicker-component">
										    		   <input type="text" placeholder="Choice color" class="form-control" name="input_color[]" value="#000000">
										    	   </div> 
										       	</div>
										    @endif
											<div id="add-color-input-wrap"></div>
											<div class="form-group">
												<button  type="button" id="addColorInput"class="btn btn-primary">Add More Colors</button>
											</div> 
										</div>
										<div class="col-sm-12 col-lg-12">  
											<div id="addition-input-wrap"></div>
											<h4 class="pull-left">
		                                        <i>If You Need More Choice Options For Customers Of This Product ,please Click Here.</i>
		                                    </h4>
											<div class="form-group pb-3">
												<button  type="button" id="addInput"class="btn btn-primary">Add Customer Input Options</button>
											</div>
										</div>
									</div>
								</div> 
								<div class="d-flex justify-content-between border-top mt-5 pt-10">
									<div class="mr-2">
										<button type="button" class="btn btn-light-primary font-weight-bolder text-uppercase px-9 py-4" data-wizard-type="action-prev">Previous</button>
									</div>
									<div>
										<button type="button" class="btn btn-success font-weight-bolder text-uppercase px-9 py-4" data-wizard-type="action-submit">Submit</button>
										<button type="button" class="btn btn-primary font-weight-bolder text-uppercase px-9 py-4" data-wizard-type="action-next">Next</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')  
<script src="{{ asset('wjs/product.js')}}"></script>
@endpush