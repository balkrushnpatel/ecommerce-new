@extends('layouts.master')
@section('title','Track Order')
@section('content')
	 <div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">Track Your Order</h1>
        </div>
    </div>
     <nav class="breadcrumb-nav mb-10 pb-1">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>Track Order</li>
            </ul>
        </div>
    </nav>
    <div class="page-content contact-us">
        <div class="container">
    		<section class="trackorder-section">
                <div class="row gutter-lg pb-3">
                    <div class="col-lg-6 mb-8">
                        <h4 class="title mb-3"></h4>
                        <form class="form" action="#" method="post">
                        	{{csrf_field()}}
                            <div class="form-group">
                                <label for="name">Order Id <span class="required">*</span></label>
                                <input type="text" id="order_id" name="order_id"
                                    class="form-control">
                                @error('name')
									<span id="name-error" class="error">
										<strong>{{ $message }}</strong>
									</span> 
								@enderror
                            </div>
                            <button type="button" class="btn btn-primary btn-outline track-order">Send Now</button>
                        </form>
                        <p id="delivery_info"></p>
                    </div>
                </div>
            </section>
         </div>
    </div>   
@endsection