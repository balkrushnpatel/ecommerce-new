@extends('layouts.auth')
@section('title','Verify')
@section('content')
<main class="main login-page">
<!-- Start of Page Header -->
    <div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">Verify</h1>
        </div>
    </div>
    <!-- End of Page Header -->
     
    <!-- End of Breadcrumb -->
    <div class="page-content">
        <div class="container">
            <div class="login-popup">
                <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
                    <ul class="nav nav-tabs text-uppercase" role="tablist">
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link active">{{ __('Verify Your Email Address') }}</a>
                        </li> 
                    </ul>
                     <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn  btn-primary btn-cart p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
