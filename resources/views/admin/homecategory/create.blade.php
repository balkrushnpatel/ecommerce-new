@extends('layouts.app')
@section('title','HomeCategory Create')
@section('content')
@include('layouts.partials.sub-header',['pageHeader' => 'HomeCategory'])
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container-fluid"> 
		<!--begin::Card-->
		<div class="card card-custom">
			<div class="card-header flex-wrap py-3">
				<div class="card-title">
					<h3 class="card-label">Home Category
					<span class="d-block text-muted pt-2 font-size-sm">Add &amp; Edit Sub Category</span></h3>
				</div> 
				
			</div>
		  <form id="homecategory-form"  class="form fv-plugins-bootstrap fv-plugins-framework" action="@yield('editId',route('home-category.index'))" method="post" accept-charset="utf-8" role="form" enctype="multipart/form-data">
				{{csrf_field()}}
				@section('editMethod')
				@show  
				@csrf 
				<div class="card-body"> 
					<div id="form">
						<div id="home-category">
							@php $rowkey=0;@endphp
							@if(!empty($homecategory) && count($homecategory))  
				                @foreach($homecategory as  $rowkey=>$item) 
				                    <input type="hidden" name="home_cat[{{ $rowkey }}][id]" value="{{$item->id}}">
				                	<div class="row row-item" id="home-category-row-{{ $rowkey }}">
					                	<div class="col-lg-4 col-sm-12" >
											<label for="cat_id-[{{ $rowkey }}]" class="col-form-label">  Category <span class="required">*</span></label>
											<select class="form-control select2"  name="home_cat[{{ $rowkey }}][cat_id]" id="cat_id-[{{ $rowkey }}]"> 
												<option value=""> Select  Category</option> 
												@foreach(getCategory() as $key => $category)
													@if(isset($item->cat_id) && ($item->cat_id ==$category['id']))
														<option selected value="{{ $category['id'] }}"> {{ $category['name'] }}</option>
													@else
														<option value="{{ $category['id'] }}"> {{ $category['name'] }}</option>
													@endif
												@endforeach  
											</select>
											<div class="fv-plugins-message-container"></div> 
										</div>  
					                	<div class="col-lg-4 col-sm-12" >
											<label for="cat_id" class="col-form-label">  Banner <span class="required">*</span></label>
											<select class="form-control select2"  name="home_cat[{{ $rowkey }}][banner_id]" id="banner_id_[{{ $rowkey }}]" > 
												<option value=""> Select  Banner</option> 
												@foreach(getBanner() as $key => $banner)
												@if(isset($item->banner_id) && ($item->banner_id ==$key))
														<option selected value="{{ $key }}"> {{ $banner }}</option>
													@else
													<option value="{{ $key }}" >{{ $banner}}</option>
													@endif
												@endforeach  
											</select>
											<div class="fv-plugins-message-container"></div> 
										</div>  
					                	<div class="col-lg-1 col-sm-12 mt-15" >
											<button type="button"  class="btn btn-sm btn-success more-btn">+</button>
										</div>  
										@if($rowkey !=0)
						                	<div class="col-lg-1  col-sm-12 mt-15" >
												<button id="{{ $rowkey}}" type="button" class="btn btn-sm btn-danger btn_remove delete-btn-select" data-id="{{ isset($item->id)?$item->id:''}}">X</button>
											</div>  
										 @endif
								    </div> 

								@endforeach    
				             @else
				          		<div class="row row-item">
				                	<div class="col-lg-4 col-sm-12" >
										<label for="cat_id" class="col-form-label">  Category <span class="required">*</span></label>
										<select class="form-control select2"  name="home_cat[{{ $rowkey }}][cat_id]" id="cat_id"> 
											<option value=""> Select  Category</option> 
											@foreach(getCategory() as $key => $category)
												
													<option value="{{ $category['id'] }}"> {{ $category['name'] }}</option>
												
											@endforeach  
										</select>
										<div class="fv-plugins-message-container"></div> 
									</div>  
				                	<div class="col-lg-4 col-sm-12" >
										<label for="cat_id" class="col-form-label">  Banner <span class="required">*</span></label>
										<select class="form-control select2"  name="home_cat[{{ $rowkey }}][banner_id]" id="banner_id_0" > 
											<option value=""> Select  Banner</option> 
											@foreach(getBanner() as $key => $banner)
												<option value="{{ $key }}" @if(isset($homecategory->banner_id) && ($banner->banner_id == $key)) selected @endif>{{ $banner}}</option>
											@endforeach  
										</select>
										<div class="fv-plugins-message-container"></div> 
									</div>  
				                	<div class="col-lg-1 col-sm-12 mt-15" >
										<button type="button"  class="btn btn-sm btn-success more-btn">+</button>
									</div>  
				                	<div class="col-lg-1  col-sm-12 mt-15" >
										<button id="0" type="button" class="btn btn-sm btn-danger btn_remove delete-btn-select hidden">X</button>
									</div>  
							    </div> 
						    @endif
			          	</div>
                    </div>
                    <div class="more-feilds"></div>
				</div>
				<div class="card-footer">
					<div class="row">
						<div class="col-lg-12">
							<button type="submit" class="btn btn-light-success font-weight-bold mr-2">{{ isset($homecategory) ? 'Update' : 'Save' }} </button>
						</div>
					</div>
				</div>
			</form>
		</div> 
    </div> 
</div> 
@endsection
@push('scripts')  
<script src="{{ asset('wjs/homecategory.js')}}"></script>
@endpush