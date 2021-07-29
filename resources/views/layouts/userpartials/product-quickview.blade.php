<div class="row gutter-lg">
    <div class="col-md-6 mb-4 mb-md-0">
        <div class="product-gallery product-gallery-sticky mb-0">
            <div class="product-single-carousel owl-carousel owl-theme owl-nav-inner row cols-1 gutter-no">
                @php
                    $images = fileView($product,'no','multi','jpg','img');
                @endphp
                @foreach($images as $img)
                    <figure class="product-image">
                        <img src="{{ $img }}" data-zoom-image="{{ $img }}" alt="{{ $product->name }}" width="800" height="900">
                    </figure>
                @endforeach
            </div>
            <div class="product-thumbs-wrap">
                <div class="product-thumbs">
                    @foreach($images as $img)
                        <div class="product-thumb active">
                            <img src="{{ $img }}" alt="{{ $product->name }}" width="103" height="116">
                        </div>
                    @endforeach
                </div>
                <button class="thumb-up disabled"><i class="w-icon-angle-left"></i></button>
                <button class="thumb-down disabled"><i class="w-icon-angle-right"></i></button>
            </div>
        </div>
    </div>
    <div class="col-md-6 overflow-hidden p-relative">
        <div class="product-details scrollable pl-0">
            <h2 class="product-title">{{ $product->name }}</h2>
            <div class="product-bm-wrapper">
                <figure class="brand">
                    @php 
                    $brand = $product->brand;
                    @endphp
                    <img src="{{ asset('uploads/brand/'.$brand->image) }} " alt="{{ $brand->name }}" width="102" height="48" />
                </figure>
                <div class="product-meta">
                    <div class="product-categories">
                        Category:
                        <span class="product-category"><a href="{{ route('category.product',array('id' => $product->categories->id, 'slug' => Str::slug($product->categories->slug)))}}">{{ $product->categories->name }}</a></span>
                    </div>
                    <div class="product-sku">
                        SKU: <span>MS46891340</span>
                    </div>
                </div>
            </div>

            <hr class="product-divider">

            <div class="product-price">{!! $product->productPrice() !!}</div>

            <div class="ratings-container">
                <div class="ratings-full">
                    <span class="ratings" style="width: 80%;"></span>
                    <span class="tooltiptext tooltip-top"></span>
                </div>
                <a href="#" class="rating-reviews">(3 Reviews)</a>
            </div>

            <div class="product-short-desc">
                <ul class="list-type-check list-style-none">
                    <li>{{$product->description}}</li>
                </ul>
            </div>

            <hr class="product-divider">

            @if(!empty($product->color))
            <div class="product-form product-variation-form product-color-swatch">
                <label>Color:</label>
                <div class="d-flex align-items-center product-variations">
                    @foreach(json_decode($product->color) as $clr)
                        <a href="javascript:void(0)" class="color cust-color" data-color="{{ $clr }}" style="background-color: {{ $clr }}"></a>
                    @endforeach
                </div>
            </div>
            @endif
             @if(!empty($product->option))
                @php
                    $option = json_decode($product->option); 
                @endphp
                @foreach($option as $opt) 
                    <div class="product-form product-variation-form product-size-swatch">
                        <label class="mb-1">{{ $opt->title }}:</label>
                        <div class="flex-wrap d-flex align-items-center product-variations">
                            @if($opt->choice != 'text')
                                @php 
                                    $choice = explode(',',$opt->option); 
                                @endphp
                                @if($opt->choice =='single')
                                    <select name="option" id="option">
                                        @foreach($choice as $choic)
                                            <option value="{{ $choic }}">{{ $choic }}</option>
                                        @endforeach
                                    </select>
                                @endif
                                @if($opt->choice =='multi')
                                    <div class="toolbox">
                                    <div class="toolbox-item toolbox-sort select-box text-dark">
                                        <select name="option[]" id="option" multiple class="form-control">
                                            @foreach($choice as $choic)
                                                <option value="{{ $choic }}">{{ $choic }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    </div>
                                @endif
                                @if($opt->choice =='radio')
                                    @foreach($choice as $choic)
                                        <input type="radio" name="option" value="{{ $choic }}"class="size ml-2"><span class="product-option"> {{ $choic }}</span>
                                    @endforeach
                                @endif
                                @if($opt->choice =='checkbox')
                                    @foreach($choice as $choic)
                                        <input type="checkbox" name="option[]" value="{{ $choic }}"> 
                                        <span class="product-option"> {{ $choic }}</span>
                                    @endforeach
                                @endif
                            @else
                                <input type="text" name="option" class="form-control">
                            @endif  
                        </div> 
                    </div>
                @endforeach
            @endif
            <div class="product-form">
                <div class="product-qty-form">
                    <div class="input-group">
                        <input class="quantity form-control" type="number" min="1" max="{{ $product->qty}}" name="qty" id="product_qty_{{$product->id}}"  value="1">
                        <button class="quantity-plus w-icon-plus" data-btn="+" data-id="{{ $product->id}}"></button>
                        <button class="quantity-minus w-icon-minus" data-btn="-" data-id="{{ $product->id}}"></button>
                    </div>
                </div>
                <button class="btn btn-primary btn-cart" data-id="{{ $product->id}}">
                    <i class="w-icon-cart"></i>
                    <span>Add to Cart</span>
                </button>
            </div>

            <div class="social-links-wrapper">
                 @include('user.product.social-link',$product);
            </div>
        </div>
    </div>
</div>