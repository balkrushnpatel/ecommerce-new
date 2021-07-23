@extends('layouts.master')
@section('title','Product')
@section('content')
    <main class="main">
            <!-- Start of Page Header -->
        <div class="page-header">
            <div class="container">
                <h1 class="page-title mb-0">My Account</h1>
            </div>
        </div>
        <!-- End of Page Header -->

        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li>My account</li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of PageContent -->
        <div class="page-content pt-2">
            <div class="container">
                <div class="tab tab-vertical row gutter-lg">
                    <ul class="nav nav-tabs mb-6" role="tablist">
                        <li class="nav-item">
                            <a href="#account-dashboard" class="nav-link active">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="#account-orders" class="nav-link">Orders</a>
                        </li>
                        <li class="nav-item">
                            <a href="#account-details" class="nav-link" id="accountDetails">Account details</a>
                        </li>
                        <li class="link-item">
                            <a href="wishlist.html">Wishlist</a>
                        </li>
                        <li class="link-item">
                            <a href="{{ route('logout') }}">Logout</a>
                        </li>
                    </ul>

                    <div class="tab-content mb-6">
                        <div class="tab-pane active in" id="account-dashboard">
                            <p class="greeting">
                                Hello
                                <span class="text-dark font-weight-bold">{{ auth()->user()->first_name }}</span>
                                (not
                                <span class="text-dark font-weight-bold">{{ auth()->user()->first_name }}</span>?
                                <a href="{{ route('logout') }}" class="text-primary">Log out</a>)
                            </p>

                            <p class="mb-4">
                                From your account dashboard you can view your <a href="#account-orders"
                                    class="text-primary link-to-tab">recent orders</a>,
                                and
                                <a href="#account-details" class="text-primary link-to-tab">edit your password and
                                    account details.</a>
                            </p>

                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                    <a href="#account-orders" class="link-to-tab">
                                        <div class="icon-box text-center">
                                            <span class="icon-box-icon icon-orders">
                                                <i class="w-icon-orders"></i>
                                            </span>
                                            <div class="icon-box-content">
                                                <p class="text-uppercase mb-0">Orders</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                    <a href="#account-details" class="link-to-tab">
                                        <div class="icon-box text-center">
                                            <span class="icon-box-icon icon-account">
                                                <i class="w-icon-user"></i>
                                            </span>
                                            <div class="icon-box-content">
                                                <p class="text-uppercase mb-0">Account Details</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                    <a href="wishlist.html" class="link-to-tab">
                                        <div class="icon-box text-center">
                                            <span class="icon-box-icon icon-wishlist">
                                                <i class="w-icon-heart"></i>
                                            </span>
                                            <div class="icon-box-content">
                                                <p class="text-uppercase mb-0">Wishlist</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                    <a href="{{ route('logout') }}">
                                        <div class="icon-box text-center">
                                            <span class="icon-box-icon icon-logout">
                                                <i class="w-icon-logout"></i>
                                            </span>
                                            <div class="icon-box-content">
                                                <p class="text-uppercase mb-0">Logout</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane mb-4" id="account-orders">
                            <div class="icon-box icon-box-side icon-box-light">
                                <span class="icon-box-icon icon-orders">
                                    <i class="w-icon-orders"></i>
                                </span>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title text-capitalize ls-normal mb-0">Orders</h4>
                                </div>
                            </div>
                           
                            <table class="shop-table account-orders-table mb-6">
                                <thead>
                                    <tr>
                                        <th class="order-id">Order</th>
                                        <th class="order-date">Date</th>
                                        <th class="order-status">Status</th>
                                        <th class="order-total">Total</th>
                                        <th class="order-actions">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td class="order-id">{{$order->order_id}}</td>
                                        <td class="order-date">{{$order->created_at}}</td>
                                        <td class="order-status">Processing</td>
                                        <td class="order-total">
                                            <span class="order-price">{{$order->grand_total}}</span> 
                                        </td>
                                        <td class="order-action">
                                            <a href="{{route('order.view',encrypt($order['id']))}}"
                                                class="btn btn-outline btn-default btn-block btn-sm btn-rounded" target="_blank">View</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <a href="{{ route('product') }}" class="btn btn-dark btn-rounded btn-icon-right">Go
                                Shop<i class="w-icon-long-arrow-right"></i></a>
                        </div>
                        <div class="tab-pane" id="account-details">
                            <div class="icon-box icon-box-side icon-box-light">
                                <span class="icon-box-icon icon-account mr-2">
                                    <i class="w-icon-user"></i>
                                </span>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title mb-0 ls-normal">Account Details</h4>
                                </div>
                            </div>
                            @include('partials._flash')
                            <form class="form account-details-form" action="{{ route('account.detail') }}" method="post">
            
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="firstname">First name *</label>
                                            <input type="text" id="firstname" name="first_name" value="{{ auth()->user()->first_name }}"
                                                class="form-control form-control-md">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lastname">Middle name *</label>
                                            <input type="text" id="middlename" name="middle_name" 
                                               value="{{ auth()->user()->middle_name }}" class="form-control form-control-md">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lastname">Last name *</label>
                                            <input type="text" id="lastname" name="last_name"
                                              value="{{ auth()->user()->last_name }}"  class="form-control form-control-md">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <label for="email_1">Mobile No*</label>
                                           <input type="text" id="mobile" name="mobile_no" value="{{ auth()->user()->mobile_no }}"
                                           class="form-control  number form-control-md">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                          <label for="email_1">Email address *</label>
                                          <input type="email" id="email_1" name="email" value="{{ auth()->user()->email }}"
                                          class="form-control form-control-md" readonly>
                                        </div>
                                    </div>
                                    <h4 class="title title-password ls-25 font-weight-bold">Password change</h4>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                          <label class="text-dark" for="cur-password">Current Password</label>
                                          <input type="password" class="form-control form-control-md"value="{{ old('name', auth()->user()->old_password) }}"
                                          id="cur-password" name="old_password">
                                           @if ($errors->has('old_password'))
                                             <span class="text-danger">{{ $errors->first('old_password') }}</span>
                                           @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                         <label class="text-dark" for="new-password">New Password</label>
                                         <input type="password" class="form-control form-control-md"
                                         id="new-password" name="password">
                                         @if ($errors->has('password'))
                                             <span class="text-danger">{{ $errors->first('password') }}</span>
                                         @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                         <label class="text-dark" for="conf-password">Confirm Password</label>
                                         <input type="password" class="form-control form-control-md"
                                          id="conf-password" name="conf_password">
                                          @if ($errors->has('conf_password'))
                                             <span class="text-danger">{{ $errors->first('conf_password') }}</span>
                                         @endif
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-dark btn-rounded btn-sm mb-4">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of PageContent -->
    </main>
@endsection
@if(Session::get('isProfileUpdate'))
<script type="text/javascript"> 
    window.addEventListener('load',function() {
        setTimeout(function() {
           $('#accountDetails').trigger('click');
        }, 100);
    }); 
</script>
@endif
@php
   Session::forget('isProfileUpdate');
@endphp
@push('scripts') 
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script> 
<script>
    $('.account-orders-table').DataTable();
</script>
@endpush