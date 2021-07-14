@extends('layouts.app')

@push('stylesheets') 

@endpush
@section('title',' Product List')
@section('content')
 @include('layouts.partials.sub-header',['pageHeader' => 'Product']) 
<div class="d-flex flex-column-fluid"> 
    <div class="container-fluid">  
		<div class="card card-custom">
			<div class="card-header flex-wrap py-3">
				<div class="card-title">
					<h3 class="card-label"> Product Managed
					<span class="d-block text-muted pt-2 font-size-sm">Listing Product</span></h3>
				</div> 
				<div class="card-toolbar">  
		 			<a href="{{ route('product.create') }}" class="btn btn-primary font-weight-bolder">
					<span class="svg-icon svg-icon-md">
		 				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
						    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						        <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
						        <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
						    </g>
						</svg>
		 			</span>New Product</a>
		 		</div>
			</div>
			<div class="card-body">				
				<table class="table table-bordered table-hover table-checkable" id="product-datatable" style="margin-top: 13px !important">
					<thead>
						<tr>
							<th>{{ tableHeader(0) }}</th>
							<th>{{ tableHeader(7) }}</th>
							<th>{{ tableHeader(12) }}</th>
							<th>{{ tableHeader(1) }}</th>
							<th>{{ tableHeader(23) }}</th>
							<th>{{ tableHeader(5) }}</th>
							<th>{{ tableHeader(6) }}</th>
							<th>{{ tableHeader(10) }}</th>
							<th>{{ tableHeader(13) }}</th>
							<th>{{ tableHeader(22) }}</th>
							<th>{{ tableHeader(2) }}</th>
							<th>{{ tableHeader(3) }}</th>
							<th>{{ tableHeader(4) }}</th>
                        </tr>
					</thead> 
				</table> 
			</div>
		</div> 
    </div> 
</div> 
@include('modals.delete') 
@endsection
@push('scripts') 
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script> 
<script src="{{ asset('wjs/product.js')}}"></script>
@endpush