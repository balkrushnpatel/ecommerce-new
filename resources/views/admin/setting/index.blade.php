@extends('layouts.app')

@push('stylesheets') 

@endpush
@section('title','Setting')
@section('content')
@include('layouts.partials.sub-header',['pageHeader' => 'Setting']) 
  <div class="card card-custom">
    <div class="card-header card-header-tabs-line">
      <div class="card-toolbar">
        <ul class="nav nav-tabs nav-bold nav-tabs-line">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#featured_product">
              <span class="nav-icon"><i class="flaticon2-chat-1"></i></span>
              <span class="nav-text">Featured Products</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#product_bundled">
              <span class="nav-icon"><i class="flaticon2-drop"></i></span>
              <span class="nav-text">Product Bundle</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#customer_product">
              <span class="nav-icon"><i class="flaticon2-drop"></i></span>
              <span class="nav-text">Customer Products</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#vendor">
              <span class="nav-icon"><i class="flaticon2-drop"></i></span>
              <span class="nav-text">Vendor</span>
            </a>
          </li>
        </ul> 
      </div>
      </div>
    <div class="card-body">
      <form class="form" action="{{route('home.setting')}}"method="post" role="form" enctype="multipart/form-data">
      {{csrf_field()}}
        @section('editMethod')
        @show  
        @csrf
        <div class="tab-content">
          <div class="tab-pane fade show active" id="featured_product" role="tabpanel" aria-labelledby="featured_product">
            <div class="row">
             <div class="form-group col-3">
                <div class="form-group">
                  <label class="col-form-label">Featured Products</label>
                  <span class="switch switch-success">
                    <label class="col-form-label">
                    <input type="checkbox" value="1" {{ (getSetting('featured_products')  == 1 ? ' checked' : '') }} name="featured_products"/>
                    <span></span>
                    </label>
                  </span>
                </div>
              </div>
              <div class="form-group col-3">
                <label for="pro_num" class="col-form-label"> Number Of Products <span class="required">*</span></label>
                <input type="number" class="form-control" id="pro_num"  value="{{getSetting('no_of_featured_products')}}" name="no_of_featured_products">
              </div>
            </div>
          </div>
          <div class="tab-pane fade " id="product_bundled" role="tabpanel" aria-labelledby="product_bundled">
            <div class="row">
              <div class="form-group col-3">
                <div class="form-group">
                <label class="col-form-label">Bundle Products</label>
                  <span class="switch switch-success">
                    <label class="col-form-label">
                    <input type="checkbox" value="1" {{ (getSetting('bundle_products')  == 1 ? ' checked' : '') }} name="bundle_products"/>
                    <span></span>
                    </label>
                  </span>
                </div>
              </div> 
              <div class="form-group col-3">
                <div class="form-group">
                  <label for="pro_num" class="col-form-label"> Number Of Products <span class="required">*</span></label>
                  <input type="number" class="form-control" id="bun_pro_num"  value="{{getSetting('no_of_bundle_products')}}" name="no_of_bundle_products">
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade " id="customer_product" role="tabpanel" aria-labelledby="customer_product">
            <div class="row">
              <div class="col-3">
                <div class="form-group"> 
                  <label class="col-form-label">Customer Products</label>
                  <span class="switch switch-success">
                    <label class="col-form-label">
                    <input type="checkbox" {{ (getSetting('customer_products')  == 1 ? ' checked' : '') }} value="1" name="customer_products"/>
                    <span></span>
                    </label>
                  </span> 
                </div>
              </div>
              <div class="col-3">
                <div class="form-group">
                  <label for="pro_num" class="col-form-label"> Number Of Products <span class="required">*</span></label>
                  <input type="number" class="form-control" value="{{getSetting('no_of_customer_products')}}" id="cust_pro_num"  name="no_of_customer_products">
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade " id="vendor" role="tabpanel" aria-labelledby="vendor">
            <div class="row">
              <div class="form-group col-3">
                <div class="row">
                  <label class="col-6 col-form-label">Vendor</label> 
                  <span class="switch switch-success">
                    <label class="col-6 col-form-label">
                      <input type="checkbox" {{ (getSetting('vendor')  == 1 ? ' checked' : '') }} value="1" name="vendor"/>
                      <span></span>
                    </label>
                  </span> 
                </div>
              </div>
              <div class="col-3 form-group ">
                <label for="vender_title" class="col-form-label"> Title for Vendor Section <span class="required">*</span></label>
                <input type="text"  class="form-control"  value="{{getSetting('vendor_title')}}"id="vendor_title"  name="vendor_title" >
              </div>
              <div class="col-3 form-group ">
                <label for="vender_num" class="col-form-label"> Number Of Vendor <span class="required">*</span></label>
                <input type="number" value="{{getSetting('no_of_vendor')}}" class="form-control" id="vendor_num"  name="no_of_vendor">
              </div>
            </div>
          </div>
        </div>
        <div class="col-3 form-group row">
            <button type="submit" class="btn btn-light-success font-weight-bold mr-2">Save</button>
        </div>
      </form>
    </div>
  </div>
@endsection
