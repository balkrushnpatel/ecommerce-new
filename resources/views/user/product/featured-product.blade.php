<div class="row cols-xl-5 cols-md-4 cols-sm-3 cols-2">
	@foreach($featuredProduct as $product)
		@include('user.product.product-box',$product)  
	@endforeach 
</div>