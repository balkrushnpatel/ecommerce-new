<div class="social-links">
    <div class="social-icons social-no-color border-thin">
        <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
        <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
        <a href="#" class="social-icon social-pinterest fab fa-pinterest-p"></a>
        <a href="#" class="social-icon social-whatsapp fab fa-whatsapp"></a>
        <a href="#" class="social-icon social-youtube fab fa-linkedin-in"></a>
    </div>
</div>
<span class="divider d-xs-show"></span>
<div class="product-link-wrapper d-flex">
    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart{{ !empty($product->wishlist->product_id) && ($product->wishlist->product_id == $product->id)?'-full':'' }}" onclick="to_wishlist({{ $product->id}} )"></a>
    <a href="#" class="btn-product-icon btn-compare btn-icon-left w-icon-compare"></a>
</div>