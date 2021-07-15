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
                		<a href="javascript:void(0);" data-cat_id="{{ $item['id'] }}" class="category-filter">
                            {{ $item['name'] }}
                        </a>
                	</li>
                @endforeach
            </ul>
        </div> 
        <div class="widget widget-collapsible">
            <h3 class="widget-title"><span>Price</span></h3>
            <div class="widget-body">
                <ul class="filter-items search-ul">
                    <li><a href="javascript:void(0);" class="price_filter" data-price="0-100">$0.00 - $100.00</a></li>
                    <li><a href="javascript:void(0);" class="price_filter" data-price="100-200">$100.00 - $200.00</a></li>
                    <li><a href="javascript:void(0);" class="price_filter" data-price="200-300">$200.00 - $300.00</a></li>
                    <li><a href="javascript:void(0);" class="price_filter" data-price="300-500">$300.00 - $500.00</a></li>
                    <li><a href="javascript:void(0);" class="price_filter" data-price="500">$500.00+</a></li>
                </ul>
                <form class="price-range">
                    <input type="number" name="min_price" class="min_price text-center"
                        placeholder="$min"><span class="delimiter">-</span><input type="number"
                        name="max_price" class="max_price text-center" placeholder="$max"><a
                        href="#" class="btn btn-primary btn-rounded">Go</a>
                </form>
            </div>
        </div>    
    </div> 
</aside>