<div class="product">
    <figure class="product-media product-img">
        <a href="{{ $product->productSlug() }}">
            {!! fileView($product,'thumb','no','jpg','img') !!}  
        </a>
        <div class="product-action-vertical">
            <a href="#" class="btn-product-icon btn-cart w-icon-cart" onclick="to_cart({{ $product->id}})" title="Add to cart"></a>
            <a href="#" class="btn-product-icon btn-wishlist w-icon-heart{{ !empty($product->wishlist->product_id) && ($product->wishlist->product_id == $product->id)?'-full':'' }}" onclick="to_wishlist({{ $product->id}})" title="Add to wishlist"></a> 
            <a href="#" class="btn-product-icon btn-compare w-icon-compare" onclick="to_compare({{ $product->id}})" title="Add to Compare" data-product={{ $product->id}}></a>
        </div>
        <div class="product-action">
            <a href="javascript:void(0);" class="btn-product btn-quickview" onclick="to_quickview({{$product->id}})" title="Quick View">Quick
                View</a>
        </div>
    </figure>
    <div class="product-details">
        <div class="product-cat"><a href="javascript:void(0);">{{ $product->categories->name }}</a>
        </div>
        <h4 class="product-name"><a href="{{ $product->productSlug() }}">{{ $product->name }}</a></h4>
        <div class="ratings-container">
            <div class="ratings-full">
                <span class="ratings" style="width: 80%;"></span>
                <span class="tooltiptext tooltip-top"></span>
            </div>
            <a href="{{ $product->productSlug() }}"  class="rating-reviews">(5 reviews)</a>
        </div>
        <div class="product-pa-wrapper">
            <div class="product-price">
                <ins class="new-price">{!! $product->productPrice() !!}</ins><del class="old-price">{!! $product->mainPrice() !!}</del>
            </div>
        </div>
    </div>
</div>