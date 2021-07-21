@extends('layouts.app')
@section('title','Header')
@section('content')
@include('layouts.partials.sub-header',['pageHeader' => 'Header Setting'])
 	<form class="form" action="{{route('header.setting')}}"method="post" role="form" enctype="multipart/form-data">
      {{csrf_field()}}
        @section('editMethod')
        @show  
        @csrf  
            <div class="card-body"> 
                <div class="row"> 
                        <div class="form-group col-3">
                               <label class="col-form-label">HomePage</label>
                                <span class="switch switch-success">
		                        <label class="col-3 col-form-label">
		                        <input type="checkbox" class="header-setting" {{ (getSetting('home_page')  == 1 ? ' checked' : '') }}  value="1" name="home_page"/>
		                        <span></span>
		                        </label>
		                      </span>
		                </div>
		                <div class="form-group col-3">
                               <label class="col-form-label">All Categories</label>
                                <span class="switch switch-success">
		                        <label class="col-3 col-form-label">
		                        <input type="checkbox" class="header-setting" {{ (getSetting('all_category')  == 1 ? ' checked' : '') }} value="1" name="all_category"/>
		                        <span></span>
		                        </label>
		                      </span>
		                </div>
		                <div class="form-group col-3">
                               <label class="col-form-label">Featured Products</label>
                                <span class="switch switch-success">
		                        <label class="col-3 col-form-label">
		                        <input type="checkbox" class="header-setting"  {{ (getSetting('featured_product')  == 1 ? ' checked' : '') }} value="1" name="featured_product"/>
		                        <span></span>
		                        </label>
		                      </span>
		                </div>
		                <div class="form-group col-3">
                               <label class="col-form-label">Today's Deal</label>
                                <span class="switch switch-success">
		                        <label class="col-3 col-form-label">
		                        <input type="checkbox" class="header-setting"  {{ (getSetting('today_deal')  == 1 ? ' checked' : '') }} value="1" name="today_deal"/>
		                        <span></span>
		                        </label>
		                      </span>
		                </div>
		                <div class="form-group col-3">
                               <label class="col-form-label">Bundled Products</label>
                                <span class="switch switch-success">
		                        <label class="col-3 col-form-label">
		                        <input type="checkbox" class="header-setting"  {{ (getSetting('bundled_product')  == 1 ? ' checked' : '') }} value="1" name="bundled_product"/>
		                        <span></span>
		                        </label>
		                      </span>
		                </div>
		                <div class="form-group col-3">
                               <label class="col-form-label">classified</label>
                                <span class="switch switch-success">
		                        <label class="col-3 col-form-label">
		                        <input type="checkbox" class="header-setting" value="1" {{ (getSetting('classified_product')  == 1 ? ' checked' : '') }}  name="classified_product"/>
		                        <span></span>
		                        </label>
		                      </span>
		                </div>
		                <div class="form-group col-3">
                               <label class="col-form-label">Latest Products</label>
                                <span class="switch switch-success">
		                        <label class="col-3 col-form-label">
		                        <input type="checkbox" class="header-setting" {{ (getSetting('latest_product')  == 1 ? ' checked' : '') }}  value="1" name="latest_product"/>
		                        <span></span>
		                        </label>
		                      </span>
		                </div>
		                <div class="form-group col-3">
                               <label class="col-form-label">All Brands</label>
                                <span class="switch switch-success">
		                        <label class="col-3 col-form-label">
		                        <input type="checkbox" class="header-setting"  {{ (getSetting('all_brand')  == 1 ? ' checked' : '') }} value="1" name="all_brand"/>
		                        <span></span>
		                        </label>
		                      </span>
		                </div>
		                <div class="form-group col-3">
                               <label class="col-form-label">Blogs</label>
                                <span class="switch switch-success">
		                        <label class="col-3 col-form-label">
		                        <input type="checkbox" class="header-setting" {{ (getSetting('blog_product')  == 1 ? ' checked' : '') }} value="1" name="blog_product"/>
		                        <span></span>
		                        </label>
		                      </span>
		                </div>
		                <div class="form-group col-3">
                               <label class="col-form-label">Contact</label>
                                <span class="switch switch-success">
		                        <label class="col-3 col-form-label">
		                        <input type="checkbox" class="header-setting" {{ (getSetting('contact_product')  == 1 ? ' checked' : '') }} value="1" name="contact_product"/>
		                        <span></span>
		                        </label>
		                      </span>
		                </div>
                </div> 
            </div>
    </form>      
@endsection
@push('scripts')  
<script src="{{ asset('wjs/setting.js')}}"></script>
@endpush