<div id="box-view" class="product-wrapper row cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2">
	@foreach($products as $product)
        <div class="product-wrap">
            <div class="product text-center">
                <figure class="product-media">
                    <a href="product-default.html">
                        <img src="{{asset('/uploads/product/'.$product->id.'/'.$product->image)}}" alt="{{ $product->name }}" class="product-image"/>
                    </a>
                    <div class="product-action-horizontal">
                        <a href="#" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart" onclick="to_wishlist({{ $product->id}} )"></a>
                        <a href="#" class="btn-product-icon btn-wishlist w-icon-heart" title="Wishlist" onclick="to_wishlist({{ $product->id}} )"></a>
                        <a href="#" class="btn-product-icon btn-compare w-icon-compare" title="Compare"></a>
                        <a href="#" class="btn-product-icon btn-quickview w-icon-search" title="Quick View" onclick="to_compare({{ $product->id}} )"></a>
                    </div>
                </figure>
                <div class="product-details">
                    <div class="product-cat">
                        <a href="javascript:void(0);">{{ $product->categories->name }}</a>
                    </div>
                    <h3 class="product-name">
                        <a href="{{ route('product.detail',array('id' => $product->id, 'slug' => Str::slug($product->slug)))}}">{{ $product->name }}</a>
                    </h3>
                    <div class="ratings-container">
                        <div class="ratings-full">
                            <span class="ratings" style="width: 100%;"></span>
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <a href="{{ route('product.detail',array('id' => $product->id, 'slug' => Str::slug($product->slug)))}}" class="rating-reviews">(3 reviews)</a>
                    </div>
                    <div class="product-pa-wrapper">
                        <div class="product-price">
                            <i class="fa fa-inr"></i> {{ $product->price }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
<div id="single-box-view" class="product-wrapper row cols-xl-2 cols-sm-1 cols-xs-2 cols-1 hidden">
	@foreach($products as $product)
		<div class="product product-list product-select">
            <figure class="product-media">
                <a href="{{ route('product.detail',array('id' => $product->id, 'slug' => Str::slug($product->slug)))}}">
                    <img src="{{asset('/uploads/product/'.$product->id.'/'.$product->image)}}" alt="{{ $product->name }}" class="product-image">
                </a>
                <div class="product-action-vertical">
                    <a href="#" class="btn-product-icon btn-quickview w-icon-search" title="Quick View"></a>
                </div>
            </figure>
            <div class="product-details">
                <div class="product-cat">
                    <a href="javascript:void(0);">{{ $product->categories->name }}</a>
                </div>
                <h4 class="product-name">
                    <a href="{{ route('product.detail',array('id' => $product->id, 'slug' => Str::slug($product->slug)))}}">{{ $product->name }}</a>
                </h4>
                <div class="ratings-container">
                    <div class="ratings-full">
                        <span class="ratings" style="width: 100%;"></span>
                        <span class="tooltiptext tooltip-top">5.00</span>
                    </div>
                    <a href="product-default.html" class="rating-reviews">(3 Reviews)</a>
                </div>
                <div class="product-price"> <i class="fa fa-inr"></i> {{ $product->price }}</div>
                <div class="product-desc">
                    Ultrices eros in cursus turpis massa cursus mattis. Volutpat ac tincidunt
                    vitae semper quis lectus. Aliquam id diam maecenas ultricies…
                </div>
                <div class="product-action">
                    <a href="javascript:void(0);" class="btn-product btn-cart" title="Add to Cart" onclick="to_cart({{ $product->id}} )"> <i class="w-icon-cart"></i>Add to Cart</a>
                    <a href="javascript:void(0);" class="btn-product-icon btn-wishlist w-icon-heart" title="Add to wishlist" onclick="to_wishlist({{ $product->id}} )"></a>
                    <a href="javascript:void(0);" class="btn-product-icon btn-compare w-icon-compare" title="Compare" onclick="to_compare({{ $product->id}} )"></a>
                </div>
            </div>
        </div>
    @endforeach
</div>