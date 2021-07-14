@extends('layouts.app')

@push('stylesheets') 

@endpush
@section('title',' Product Stock List')
@section('content')
 @include('layouts.partials.sub-header',['pageHeader' => 'Product Stock']) 
<div class="d-flex flex-column-fluid"> 
    <div class="container-fluid">  
		<div class="card card-custom">
			<div class="card-header flex-wrap py-3">
				<div class="card-title">
					<h3 class="card-label">Product Stock Managed
					<span class="d-block text-muted pt-2 font-size-sm">ListingProduct Stock</span></h3>
				</div> 
				<div class="card-toolbar">  
		 			<a href="{{ route('productstock.create') }}" class="btn btn-primary font-weight-bolder">
					<span class="svg-icon svg-icon-md">
		 				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
						    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						        <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
						        <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
						    </g>
						</svg>
		 			</span>New Product Stock</a>
		 		</div>
		 		<div class="card-toolbar">  
		 			<a href="{{ route('destroy.stock') }}" class="btn btn-primary font-weight-bolder">
					<span class="svg-icon svg-icon-md">
		 				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
						    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						        <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
						        <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
						    </g>
						</svg>
		 			</span>Product Stock Destroy</a>
		 		</div>
			</div>
			<div class="card-body">				
				<table class="table table-bordered table-hover table-checkable" id="productstock-datatable" style="margin-top: 13px !important">
					<thead>
						<tr>
							<th>{{ tableHeader(0) }}</th>
							<th>{{ tableHeader(7) }}</th>
							<th>{{ tableHeader(11) }}</th>
							<th>{{ tableHeader(17) }}</th>
							<th>{{ tableHeader(16) }}</th>
							<th>{{ tableHeader(10) }}</th>
							<th>{{ tableHeader(6) }}</th>
							<th>{{ tableHeader(18) }}</th>
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
<script src="{{ asset('wjs/productstock.js')}}"></script>
@endpush