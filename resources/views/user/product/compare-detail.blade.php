 <div id="cmp-detail">
    <div class="compare-table">
        <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-products">
      		<div class="compare-col compare-field">Product</div>
    		@foreach($products as $product)
                <div class="compare-col compare-product">
                    <a href="javascript:void(0);" class="btn remove-product remove-compare" data-id="{{$product->id}}"><i class="w-icon-times-solid"></i></a>
                    <div class="product text-center">
                        <figure class="product-media">
                            <a href="{{ $product->productSlug() }}">
                                <img src="{!! fileView($product,'thumb','no','jpg','') !!}" alt="{{$product->name}}" width="228" height="257">  
                            </a>
                            <div class="product-action-vertical">
                                <a href="javascript:void(0);" class="btn-product-icon btn-cart w-icon-cart" onclick="to_cart({{ $product->id}})"></a>
                                <a href="javascript:void(0);" class="btn-product-icon btn-wishlist w-icon-heart" onclick="to_wishlist({{ $product->id}})" title="Add to wishlist"></a>
                            </div>
                        </figure>
                        <div class="product-details">
                            <h3 class="product-name"><a href="{{ $product->productSlug() }}">{{$product->name}}</a></h3>
                        </div>
                    </div>
                </div>
        	@endforeach
        </div>
        <!-- End of Compare Products -->
        <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-price">
            <div class="compare-col compare-field">Price</div>
            @foreach($products as $product)
                <div class="compare-col compare-value">
                    <div class="product-price">
                        <span class="new-price">${{$product->price}}</span>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- End of Compare Price -->
        <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-availability">
            <div class="compare-col compare-field">Availability</div>
            @foreach($products as $product)
            	<div class="compare-col compare-value">In stock</div>
           	@endforeach
        </div>
       
        <!-- End of Compare Availability -->
        <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-description">
            <div class="compare-col compare-field">description</div>
            @foreach($products as $product)
            <div class="compare-col compare-value">
                <ul class="list-style-none list-type-check">
                    <li>{{$product->description}}</li>
                    
                </ul>
            </div>
            @endforeach
        </div>
        <!-- End of Compare Description -->

        <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-category">
            <div class="compare-col compare-field">Category</div>
             @foreach($products as $product)
             <div class="compare-col compare-value">{{$product->categories->name}}</div>
             @endforeach
        </div>
        <!-- End of Compare Category -->
        <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-color">
            <div class="compare-col compare-field">Color</div>
            @foreach($products as $product)
           	@foreach(json_decode($product->color) as $clr)
            <div class="compare-col compare-value">
                <span class="swatch" style="background-color:{{$clr}};"></span>
            </div>
            @endforeach
            @endforeach
        </div>
        <!-- End of Compare Color -->
        <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-size">
            <div class="compare-col compare-field">Size</div>
            @foreach($products as $product)

            @php
                    $option = json_decode($product->option); 
            @endphp
            @if(!empty($option))
            @foreach($option as $opt)
            <div class="compare-col compare-value">{{$opt->option}}</div>
            @endforeach
            @endif
            @endforeach
        </div>
        <!-- End of Compare Size -->
        <div class="compare-row cols-xl-5 cols-lg-4 cols-md-3 cols-2 compare-brand">
            <div class="compare-col compare-field">Brand</div>
             @foreach($products as $product)
             <div class="compare-col compare-value">{{($product->brand_id)?$product->brand->name:''}}</div>
             @endforeach
        </div>
    </div>
</div>