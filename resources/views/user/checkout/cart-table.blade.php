<form class="form checkout-form" action="{{ route('checkout') }}" method="POST">
    <div class="row gutter-lg mb-10">
        <div class="col-lg-8 pr-lg-4 mb-6">
            @csrf
            <table class="shop-table cart-table">
                <thead>
                    <tr>
                        <th class="product-name"><span>Product</span></th>
                        <th></th>
                        <th class="product-price"><span>Price</span></th>
                        <th class="product-quantity"><span>Quantity</span></th>
                        <th class="product-subtotal"><span>Subtotal</span></th>
                    </tr>
                </thead>
                <tbody> 
                	@php $total = 0.00 @endphp
                	@if(!empty(Session::get('cart')))
    					@foreach(Session::get('cart') as $cart)
    						@php
    		                    $total = ($cart['total_price'] + $total);
    		                @endphp
                            <tr>
                                <td class="product-thumbnail">
                                    <div class="p-relative">
                                        <a href="{{ $cart['url'] }}">
                                            <figure>
                                                <img src="{{ $cart['image'] }}" alt="{{ $cart['name'] }}" width="300" height="338">
                                            </figure>
                                        </a>
                                        <button type="submit" class="btn btn-close remove-product" data-id="{{ $cart['id'] }}"><i class="fas fa-times"></i></button>
                                    </div>
                                </td>
                                <td class="product-name">
                                    <a href="{{ $cart['url'] }}">
                                        {{ $cart['name'] }}
                                    </a>
                                </td>
                                <td class="product-price"><span class="amount"><i class="fa fa-inr"></i> {{ $cart['price'] }}</span></td>
                                <td class="product-quantity">
                                    <div class="input-group">
                                        <input class="quantity form-control" type="number" min="1" max="{{ $cart['product_qty'] }}" value="{{ $cart['quantity'] }}" readonly id="product_qty_{{ $cart['id'] }}">
                                        <button type="button" class="quantity-plus w-icon-plus cart-qty-btn" data-id="{{ $cart['id'] }}" data-btn="+"></button>
                                        <button type="button" class="quantity-minus w-icon-minus cart-qty-btn" data-id="{{ $cart['id'] }}" data-btn="-"></button>
                                    </div>
                                </td>
                                <td class="product-subtotal">
                                    <span class="amount"><i class="fa fa-inr"></i> {{ $cart['total_price'] }} </span>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class="cart-action mb-6">
                <a href="{{ route('product') }}" class="btn btn-primary btn-rounded btn-icon-left btn-shopping mr-auto"><i class="w-icon-long-arrow-left"></i>Continue Shopping</a>
                <button type="submit" class="btn btn-rounded btn-default btn-clear clear-cart" name="clear_cart" value="Clear Cart">Clear Cart</button>
            </div> 
        </div>
        <div class="col-lg-4 sticky-sidebar-wrapper">
            <div class="sticky-sidebar">
                <div class="cart-summary mb-4">
                    <h3 class="cart-title text-uppercase">Cart Totals</h3>
                    <div class="cart-subtotal d-flex align-items-center justify-content-between">
                        <label class="ls-25">Subtotal</label>
                        <span><i class="fa fa-inr"></i> {{ $total }}</span>
                    </div>
                    <hr class="divider">
                    <ul class="shipping-methods mb-2">
                        <li>
                            <label class="shipping-title text-dark font-weight-bold">Shipping</label>
                        </li>
                        <li>
                            <div class="custom-radio">
                                <input type="radio" id="free-shipping" class="custom-control-input shipping-type" name="shipping" value="0">
                                <label for="free-shipping" class="custom-control-label color-primary">Free Shipping</label>
                            </div>
                        </li> 
                        <li>
                            <div class="custom-radio">
                                <input type="radio" id="flat-rate" class="custom-control-input shipping-type"
                                    name="shipping" value="{{ getSetting('shipment_cost') }}">
                                <label for="flat-rate" class="custom-control-label color-primary">Flat rate: <i class="fa fa-inr"></i> {{ getSetting('shipment_cost') }}</label>
                            </div>
                        </li>
                    </ul> 
                    <div class="shipping-calculator">
                        <p class="shipping-destination lh-1"><strong>Coupon Discount</strong>.</p>
                        <input type="text" class="form-control mb-4" placeholder="Enter coupon code here..." id="coupon_code"/>
                        <button type="button" class="btn btn-primary btn-outline btn-rounded" id="coupon_btn">Apply Coupon</button>
                    </div>
                    <hr class="divider mb-6">
                    <div class="order-total d-flex justify-content-between align-items-center">
                        <label>Total</label>
                        <span class="ls-50"><i class="fa fa-inr"></i> {{ $total }}</span>
                    </div>
                    <div class="order-total d-flex justify-content-between align-items-center">
                        <label>Discount</label>
                        <span class="ls-50" id="discount"><i class="fa fa-inr"></i> 0.00</span>
                    </div>
                    <div class="order-total d-flex justify-content-between align-items-center">
                        <label>Final Total</label>
                        <span class="ls-50"><i class="fa fa-inr"></i> <j id="final_total">{{ $total }}</j></span>
                    </div>
                    <input type="hidden" name="final_total" value="{{ $total }}" id="final_total_text">
                    <input type="hidden" name="discount" value="0.00" id="discount_text">
                    <input type="hidden" name="discount_type" value="1" id="discount_type">
                    <input type="hidden" name="total" value="{{ $total }}" id="total_text">
                    <button type="submit" class="btn btn-block btn-primary btn-icon-right btn-rounded  btn-checkout"> Proceed to checkout<i class="w-icon-long-arrow-right"></i></button>
                </div>
            </div>
        </div>
    </div>
</form>