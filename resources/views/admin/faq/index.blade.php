@extends('layouts.app')
@section('title','Faq')
@section('content')
 @include('layouts.partials.sub-header',['pageHeader' => 'Faq'])
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container-fluid"> 
		<!--begin::Card-->
		<div class="card card-custom">
			
		  <form id="faq-form"  class="form fv-plugins-bootstrap fv-plugins-framework" action="@yield('editId',route('faq.index'))" method="post" accept-charset="utf-8" role="form" enctype="multipart/form-data">
				{{csrf_field()}}
				@section('editMethod')
				@show  
				@csrf 
				<div class="card-body"> 
					<div class="row"> 
					    <div class="col-sm-12 col-lg-12">
											@php $i= '1'; @endphp
											@if(!empty($faqs))
												@foreach($faqs as $faq)
													<div class="row pb-3 {{ ($i != 1)?'row-item':'' }}" id="row{{ $i }}">
											           <div class="col-lg-5 colorpicker-component">
											    		   <input type="text" placeholder="Add Question" class="form-control" name="faq_question[]" value="{{ $faq['faq_question']}}">
											    	   </div> 
											    	   <div class="col-lg-5 colorpicker-component">
											    		   <textarea  name="faq_answer[]" class="kt-ckeditor-1">{{$faq['faq_answer']}}
										                  </textarea> 
											    	   </div>
											         
												       		<div class="col-lg-2">
																<button id="{{ $i }}" class=" btn btn-sm btn-danger btn_remove">X</button>
															</div> 
										
												       	@php $i++; @endphp
												    </div>
												@endforeach
											@else
												<!-- <div class="row pb-3 {{ ($i != 1)?'row-item':'' }}" id="row{{ $i }}">
											           <div class="col-lg-5 colorpicker-component">
											    		   <input type="text" placeholder="Add Question" class="form-control" name="faq_question[]" value="">
											    	   </div> 
											    	   <div class="col-lg-5 colorpicker-component">
											    		   <textarea  name="faq_answer[]" id="kt-ckeditor-1">
										                  </textarea> 
											    	   </div>
											         	@if($i != '1')
												       		<div class="col-lg-2">
																<button id="{{ $i }}" class=" btn btn-sm btn-danger btn_remove">X</button>
															</div> 
												       	@endif
												       	@php $i++; @endphp
												    </div> -->
										    @endif
										    <div id="add-faq-input-wrap"></div>
											<div class="form-group">
												<button  type="button" id="addFaqInput"class="btn btn-primary">Add More Faqs</button>
											</div> 
						</div>
					</div> 
				</div>
				<div class="card-footer">
					<div class="row">
						<div class="col-lg-12">
							<a href="{{ route('faq.index')}}" class="btn btn-light-primary font-weight-bold">Cancel</a>
							<button type="submit" class="btn btn-light-success font-weight-bold mr-2">{{ isset($faq) ? 'Update' : 'Save' }} </button>
						</div>
					</div>
				</div>
			</form>
		</div> 
    </div> 
</div> 
@endsection
@push('scripts')  
<script src="{{ asset('wjs/faq.js')}}"></script>
@endpush