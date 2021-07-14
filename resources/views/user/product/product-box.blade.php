<div class="product">
    <figure class="product-media">
        <a href="{{ route('product.detail',array('id' => $product->id, 'slug' => Str::slug($product->slug)))}}">
             <img src="{{ asset('user/images/demos/demo1/products/3-4-1.jpg') }}" alt="{{ $product->name }}"
                    class="product-image" />
        </a>
        <div class="product-action-vertical">
            <a href="#" class="btn-product-icon btn-cart w-icon-cart" onclick="to_cart({{ $product->id}} )" title="Add to cart"></a>
            <a href="#" class="btn-product-icon btn-wishlist w-icon-heart" onclick="to_wishlist({{ $product->id}} )" title="Add to wishlist"></a> 
            <a href="#" class="btn-product-icon btn-compare w-icon-compare" onclick="to_compare({{ $product->id}} )" title="Add to Compare"></a>
        </div>
        <div class="product-action">
            <a href="javascript:void(0);" class="btn-product btn-quickview" title="Quick View">Quick
                View</a>
        </div>
    </figure>
    <div class="product-details">
        <div class="product-cat"><a href="javascript:void(0);">{{ $product->categories->name }}</a>
        </div>
        <h4 class="product-name"><a href="{{ route('product.detail',array('id' => $product->id, 'slug' => Str::slug($product->slug)))}}">{{ $product->name }}</a></h4>
        <div class="ratings-container">
            <div class="ratings-full">
                <span class="ratings" style="width: 80%;"></span>
                <span class="tooltiptext tooltip-top"></span>
            </div>
            <a href="{{ route('product.detail',array('id' => $product->id, 'slug' => Str::slug($product->slug)))}}"  class="rating-reviews">(5 reviews)</a>
        </div>
        <div class="product-pa-wrapper">
            <div class="product-price">
                <ins class="new-price"><i class="fa fa-inr"></i> {{ $product->price}}</ins><del class="old-price">$534.00</del>
            </div>
        </div>
    </div>
</div>