<a href="#" class="cart-toggle label-down link">
    <i class="w-icon-cart" style="font-size: 2.7rem;">
        <span class="cart-count">{{ !empty(Session::get('cart'))?count(Session::get('cart')):0 }}</span>
    </i>
    <span class="cart-label">Cart</span>
</a>
<div class="dropdown-box">
    <div class="cart-header">
        <span>Shopping Cart</span>
        <a href="javascript:void(0);" class="btn-close">Close<i class="w-icon-long-arrow-right"></i></a>
    </div> 
    <div class="products">
        @php
            $total = '0';
        @endphp
        @if(!empty(Session::get('cart')))
            @foreach(Session::get('cart') as $cart)
                @php
                    $total = ($cart['total_price'] + $total);
                @endphp
                <div class="product product-cart">
                    <div class="product-detail">
                        <a href="{{ $cart['url'] }}" class="product-name">{{ $cart['name'] }}</a>
                        <div class="price-box">
                            <span class="product-quantity">{{ $cart['quantity'] }}</span>
                            <span class="product-price"><i class="fa fa-inr"></i> {{ $cart['price'] }} </span>
                        </div>
                    </div>
                    <figure class="product-media">
                        <a href="{{ $cart['url'] }}">
                            <img src="{{ $cart['image'] }}" alt="{{ $cart['name'] }}" height="84" width="94" />
                        </a>
                    </figure>
                    <button class="btn btn-link btn-close remove-product" data-id="{{ $cart['id'] }}">
                        <i class="fas fa-times"></i>
                    </button>
                </div> 
            @endforeach
        @endif
    </div>
    <div class="cart-total">
        <label>Subtotal:</label>
        <span class="price"><i class="fa fa-inr"></i> {{ $total }}</span>
    </div>
    <div class="cart-action">
        <a href="{{ route('cart') }}" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
    </div>
</div>