@extends('layouts.app')
@section('title','Payment')
@section('content')
@include('layouts.partials.sub-header',['pageHeader' => 'Payment Method'])
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container-fluid"> 
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-label">Payment Method  Setting
                    <span class="d-block text-muted pt-2 font-size-sm"></span></h3>
                </div> 
            </div>
          <form id="payment-form"  class="form fv-plugins-bootstrap fv-plugins-framework"action="{{ route('payment.setting') }}"  method="post" accept-charset="utf-8" role="form" enctype="multipart/form-data">
                {{csrf_field()}}
                @section('editMethod')
                @show  
                @csrf 
                <div class="card-body">
                   <div><h3>Paypal Setting</h3></div>
                  <div class="row">
                    <div class="col-md-6 col-sm-12">
                         <label for="paypal-email" class="col-form-label"> Paypal Email<span class="required">*</span></label>
                          <input type="text" class="form-control" id="paypal-email" value="{{getSetting('paypal_email')}}" name="paypal_email">
                          <div class="fv-plugins-message-container"></div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                          <label for="Account-type" class="col-form-label">Paypal Account Type<span class="required">*</span></label>
                          <select class="form-control select2" name="paypal_type" id="paypal_account_type"> 
                            <option value="">Choose One</option> 
                            <option  value="1"  {{ (getSetting('paypal_type')  == '1' ? 'selected' : '') }} >Sandbox</option>
                            <option  value="2"  {{ (getSetting('paypal_type')  == '2' ? 'selected' : '') }} >Original</option>  
                          </select>
                    </div>
                  </div>
                  <br>
                  <div><h3>Stripe Setting</h3></div>
                  <div class="row">
                    <div class="col-md-4 col-sm-12">
                         <label for="stripe-key" class="col-form-label">Stripe Secret Key<span class="required">*</span></label>
                          <input type="text" class="form-control" id="stripe-key" value="{{getSetting('secret_key')}}" name="secret_key">
                          <div class="fv-plugins-message-container"></div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                         <label for="paypal-email" class="col-form-label">Stripe Publishable Key<span class="required">*</span></label>
                          <input type="text" class="form-control" id="publish-key" value="{{getSetting('publishable_key')}}" name="publishable_key">
                          <div class="fv-plugins-message-container"></div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                          <label for="Account-type" class="col-form-label">Stripe Account Type<span class="required">*</span></label>
                          <select class="form-control select2" name="stripe_type" id="account-type"> 
                            <option value="">Choose One</option> 
                            <option  value="1"  {{ (getSetting('stripe_type')  == '1' ? 'selected' : '') }} >Test</option>
                            <option  value="2"  {{ (getSetting('stripe_type')  == '2' ? 'selected' : '') }} >Live</option>  
                          </select>
                    </div>
                  </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-light-success font-weight-bold mr-2">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div> 
    </div> 
</div> 
@endsection
