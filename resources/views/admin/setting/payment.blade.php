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
                    <h3 class="card-label">Payment 
                    <span class="d-block text-muted pt-2 font-size-sm">{{ __('Edit Profile') }}</span></h3>
                </div> 
            </div>
          <form id="payment-form"  class="form fv-plugins-bootstrap fv-plugins-framework"action="{{ route('payment.setting') }}"  method="post" accept-charset="utf-8" role="form" enctype="multipart/form-data">
                {{csrf_field()}}
                @section('editMethod')
                @method('put')
                @show  
                @csrf 
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-6">
                         <label for="paypal-email" class="col-form-label"> Paypal Email<span class="required">*</span></label>
                          <input type="text" class="form-control" id="paypal-email" value="{{getSetting('paypal_email')}}" name="paypal_email">
                          <div class="fv-plugins-message-container"></div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-12">
        
                            <button type="submit" class="btn btn-light-success font-weight-bold mr-2">Save </button>
                        </div>
                    </div>
                </div>
            </form>
           <!--  <form id="profile-form"  class="form fv-plugins-bootstrap fv-plugins-framework"action="{{ route('profile.password') }}"  method="post" accept-charset="utf-8" role="form" enctype="multipart/form-data">
                {{csrf_field()}}
                @section('editMethod')
                @method('put')
                @show  
                @csrf 
                <div class="card-body"> 
                     @if (session('status_password'))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-custom alert-success fade show card-alert"> 
                                            <span>{{ session('status_password') }}</span>
                                            <div class="alert-close">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                    <div class="row"> 
                           <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <label>{{ __('Current Password') }}</label>
                                            <input class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" name="old_password" id="old_password" type="password" placeholder="{{ __('Current Password') }}" value="{{ old('name', auth()->user()->old_password) }}" required="true" aria-required="true" />
                                            @if ($errors->has('old_password'))
                                            <span id="name-error" class="error text-danger"
                                                for="input-name">{{ $errors->first('old_password') }}</span>
                                            @endif
                                        </div> 
                            </div> 
                            <div class="col-md-4">
                                            <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                                                <label>{{ __('New Password') }}</label>
                                                <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" type="password" placeholder="{{ __('Password') }}" aria-required="true" required="true" />
                                                @if ($errors->has('password'))
                                                <span id="name-error" class="error text-danger"
                                                    for="input-name">{{ $errors->first('password') }}</span>
                                                @endif
                                            </div> 
                            </div>
                             <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                                            <label>{{ __('Confirm New Password') }}</label>
                                            <input class="form-control{{ $errors->has('conf_password') ? ' is-invalid' : '' }}" name="conf_password" id="password_confirmation" type="password" placeholder="{{ __('Confirm Password') }}" aria-required="true"  required="true"/>
                                            @if ($errors->has('conf_password'))
                                            <span id="name-error" class="error text-danger"
                                                for="input-name">{{ $errors->first('conf_password') }}</span>
                                            @endif
                                        </div> 
                                    </div>
                    
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-12">
        
                            <button type="submit" class="btn btn-light-success font-weight-bold mr-2">Save</button>
                        </div>
                    </div>
                </div>
            </form> -->
        </div> 
    </div> 
</div> 
@endsection
