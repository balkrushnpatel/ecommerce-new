@extends('layouts.auth')
@section('title','Reset Password')
@section('content')
<main class="main login-page">
<!-- Start of Page Header -->
    <div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">{{ __('Reset Password') }}</h1>
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
                            <a href="javascript:void(0);" class="nav-link active">{{ __('Reset Password') }}</a>
                        </li> 
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="sign-in">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="text" class="form-control border-0 @error('email') is-invalid @enderror" name="email" id="email" required value="{{ $email ?? old('email') }}" readonly>
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
                                <div class="form-group mt-5">
                                    <label>{{ __('Confirm Password') }} <span class="required">*</span></label>
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password-confirm" required value="{{ old('password_confirmation') }}">
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> 
                                <button type="submit" class="btn btn-primary w-100">{{ __('Reset Password') }}</button>
                            </form>
                        </div> 
                    </div> 
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
