<aside class="sidebar shop-sidebar left-sidebar sticky-sidebar-wrapper">
    <!-- Start of Sidebar Overlay -->
    <div class="sidebar-overlay"></div>
    <a class="sidebar-close" href="#"><i class="close-icon"></i></a>

    <!-- Start of Sidebar Content -->
    <div class="sidebar-content scrollable">
        <div class="filter-actions">
            <label>Filter :</label>
            <a href="#" class="btn btn-dark btn-link filter-clean">Clean All</a>
        </div>
        <!-- Start of Collapsible widget -->
        <div class="widget widget-collapsible">
            <h3 class="widget-title"><span>All Categories</span></h3>
            <ul class="widget-body filter-items search-ul">
            	@foreach(getCategory() as $key=>$item) 
                	<li>
                		<a href="{{ route('category.product',array('id' => $item['id'], 'slug' => Str::slug($item['slug'])))}}">
                            {{ $item['name'] }}
                        </a>
                	</li>
                @endforeach
            </ul>
        </div>
        <!-- End of Collapsible Widget -->
        <!-- Start of Collapsible Widget -->
        <div class="widget widget-collapsible">
            <h3 class="widget-title"><span>Price</span></h3>
            <div class="widget-body">
                <ul class="filter-items search-ul">
                    <li><a href="#">$0.00 - $100.00</a></li>
                    <li><a href="#">$100.00 - $200.00</a></li>
                    <li><a href="#">$200.00 - $300.00</a></li>
                    <li><a href="#">$300.00 - $500.00</a></li>
                    <li><a href="#">$500.00+</a></li>
                </ul>
                <form class="price-range">
                    <input type="number" name="min_price" class="min_price text-center"
                        placeholder="$min"><span class="delimiter">-</span><input type="number"
                        name="max_price" class="max_price text-center" placeholder="$max"><a
                        href="#" class="btn btn-primary btn-rounded">Go</a>
                </form>
            </div>
        </div> 
        <div class="widget widget-collapsible">
            <h3 class="widget-title"><span>Size</span></h3>
            <ul class="widget-body filter-items item-check mt-1">
                <li><a href="#">Extra Large</a></li>
                <li><a href="#">Large</a></li>
                <li><a href="#">Medium</a></li>
                <li><a href="#">Small</a></li>
            </ul>
        </div>  
    </div>
    <!-- End of Sidebar Content -->
</aside>