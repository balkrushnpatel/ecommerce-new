@extends('layouts.auth')
@section('title','Login')
@section('content')
<main class="main login-page">
<!-- Start of Page Header -->
    <div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">Login</h1>
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
                            <a href="javascript:void(0);" class="nav-link active">Sign In</a>
                        </li> 
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="sign-in">
                            <form method="POST" action="{{ route('login') }}" class="form">
                                @csrf
                                <div class="form-group">
                                    <label>Email address <span class="required">*</span></label>
                                    <input type="text" class="form-control border-0 @error('email') is-invalid @enderror" name="email" id="email" required value="{{ old('email') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-0">
                                    <label>Password <span class="required">*</span></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" required value="{{ old('password') }}">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-checkbox d-flex align-items-center justify-content-between">
                                    <input type="checkbox" class="custom-checkbox" id="remember1" name="remember1" required="" >
                                    <label for="remember1">Remember me</label>
                                    <a href="{{ route('password.request') }}" class="text-primary font-size-h6 font-weight-bolder text-hover-primary">{{ __('Forgot Your Password?') }}</a> 
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Log In</button>
                            </form>
                        </div> 
                    </div>
                    <!-- <p class="text-center">Sign in with social account</p>
                    <div class="social-icons social-icon-border-color d-flex justify-content-center">
                        <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                        <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                        <a href="#" class="social-icon social-google fab fa-google"></a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
