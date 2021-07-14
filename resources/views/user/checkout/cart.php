@extends('layouts.master')
@section('content')
<section class="shopping-cart-area pt-80 pb-80">
<div class="container">
<div class="row">
<div class="col-lg-12">
<div class="section-title text-center">
<h3 class="title">Shopping Cart</h3>
<p class="text pt-15">Shopping cart-Checkout-Order complete</p>
</div> 
</div>
</div> 
<div class="row">
<div class="col-lg-12">
<div class="shopping-table table-responsive mt-50">
<table class="table" id="cart-table">
<thead class="thead-bg">
<tr>
<th class="product">Product</th>
<th class="price">Price</th>
<th class="quantity">Quantity</th>
<th class="total">Total</th>
<th class="remove">Close</th>
</tr>
</thead>
<tbody>

	<form action="{{ route('checkout.cart') }}" method="post">
		{{csrf_field()}}
		@csrf 
	  <?php $total = 0 ?>
			@foreach(session()->get('cart') as $item)
			 <?php $total += $item['price'] * $item['quantity'];?>
			<tr class="tr-wrap">
			<td class="product d-flex">
			<div class="product-img">
			  <img src="{{asset('/uploads/product/'.$item['id'].'/'.$item['image'])}}">
			 </div>
			<div class="product-content media-body">
			<h4 class="product-title">{{ $item['name'] }}</h4>
			<p class="text">{{$item['description']}}</p>
			</div>
			</td>
			<td class="price">
			<div class="product-Price">
			<span>$<j id="product_price_{{ $item['id'] }}">{{ $item['price'] }}</j></span>
			</div>
			</td>
			<td class="quantity">
			 <div class="product-quantity d-flex justify-content-center">
			 <button type="button" id="sub" class="subqty" data-id="{{ $item['id'] }}">-</button> 
			<input type="text" id="qty_{{ $item['id'] }}" value="{{$item['quantity']}}"  name="quantity[{{ $item['id'] }}][quantity]"/>
			 <button type="button" id="add" class="addqty" data-id="{{ $item['id'] }}">+</button> 
			</div>
			</td> 
			<td class="total">
			<div class="product-Price">
			<span><j id="total_{{$item['id']}}">${{ $item['price'] * $item['quantity'] }}</j></span>
			</div>
			</td>
			<td class="remove">
			<div class="product-remove">
			<a href="{{url('remove-to-cart/'.$item['id'])}}"><i class="lni lni-close"></i></a>
			</div>
			</td>
			</tr>
		@endforeach
		<tr rowspan="4">
			<td></td>
			<td></td>
			<td>Grand Total</td>
			<td colspan="2">$<j id="grandtotalHTMl"></j></td>
		</tr>
		<input type="hidden" name="grandtotal" value="0" id="grandtotal">
	
</tbody>
</table>
<div class="cart-btn d-flex justify-content-between">
<a href="{{route('shop')}}" class="main-btn btn-border">Buy Products</a>
@if (Auth::user()->hasRole('User'))
 <button type="submit" class="main-btn">Checkout</button>
@else
  
@endif

</form>
</div>
</div> 
</div>
</div> 
</div> 
</section>
@endsection