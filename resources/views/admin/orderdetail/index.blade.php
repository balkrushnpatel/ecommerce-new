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
@endsection
@push('scripts')
<script src="{{ asset('wjs/orderDetail.js')}}"></script>
@endpush