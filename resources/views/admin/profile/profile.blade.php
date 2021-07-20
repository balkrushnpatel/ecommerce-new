@extends('layouts.app')
@section('title','Profile')
@section('content')
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container-fluid"> 
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-label">Profile
                    <span class="d-block text-muted pt-2 font-size-sm">{{ __('Edit Profile') }}</span></h3>
                </div> 
            </div>
          <form id="profile-form"  class="form fv-plugins-bootstrap fv-plugins-framework"action="{{ route('profile.update') }}"  method="post" accept-charset="utf-8" role="form" enctype="multipart/form-data">
                {{csrf_field()}}
                @section('editMethod')
                @method('put')
                @show  
                @csrf 
                <div class="card-body">
                    @if (session('status'))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-custom alert-success fade show card-alert"> 
                                            <span>{{ session('status') }}</span>
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
                    <div class="col-md-6">
                        <label for="first_name" class="col-form-label">First Name <span class="text-danger"></span></label>
                        <input type="text" class="form-control" placeholder="Enter first name" id="first_name"value="{{old('first_name', $user->first_name ?? '')}}" name="first_name">
                        @if ($errors->has('first_name'))
                                 <span class="text-danger">{{ $errors->first('first_name') }}</span>
                        @endif
                        <div class="fv-plugins-message-container"></div>
                    </div> 
                    <div class="col-md-6">
                        <label for="middle_name" class="col-form-label">Middle Name </label>
                        <input type="text" class="form-control" placeholder="Enter middle name" id="middle_name" value="{{ (isset($user)) ? $user->middle_name : '' }}" name="middle_name">
                        <div class="fv-plugins-message-container"></div>
                    </div>
                
                    <div class="col-md-6">
                        <label for="last_name" class="col-form-label">Last Name <span class="text-danger"></span></label>
                        <input type="text" class="form-control" placeholder="Enter Lastname" id="last_name" value="{{old('last_name', $user->last_name ?? '')}}" name="last_name">
                        @if ($errors->has('last_name'))
                                 <span class="text-danger">{{ $errors->first('last_name') }}</span>
                        @endif
                        <div class="fv-plugins-message-container"></div>
                    </div> 
                    <div class="col-md-6">
                        <label for="email" class="col-form-label"> Email <span class="text-danger"></span></label>
                        <input type="text" class="form-control" placeholder="Enter email" id="email" value="{{old('email', $user->email ?? '')}}" name="email">
                        @if ($errors->has('email'))
                                 <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                        <div class="fv-plugins-message-container"></div>
                    </div> 
                     <div class="col-md-6">
                        <label for="mobile_no" class="col-form-label">Mobile Number <span class="text-danger"></span></label>
                        <input type="text" class="form-control" placeholder="Enter mobile no" id="email" value="{{old('mobile_no', $user->mobile_no ?? '')}}" name="mobile_no">
                        @if ($errors->has('mobile_no'))
                                 <span class="text-danger">{{ $errors->first('mobile_no') }}</span>
                        @endif
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
            <form id="profile-form"  class="form fv-plugins-bootstrap fv-plugins-framework"action="{{ route('profile.password') }}"  method="post" accept-charset="utf-8" role="form" enctype="multipart/form-data">
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
                                            <input class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" id="password_confirmation" type="password" placeholder="{{ __('Confirm Password') }}" aria-required="true"  required="true"/>
                                            @if ($errors->has('password_confirmation'))
                                            <span id="name-error" class="error text-danger"
                                                for="input-name">{{ $errors->first('password_confirmation') }}</span>
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
            </form>
        </div> 
    </div> 
</div> 
@endsection
