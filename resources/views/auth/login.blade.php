@extends('layouts.auth')

@section('content')
<div class="login login-3 wizard d-flex flex-column flex-lg-row flex-column-fluid"> 
    <div class="login-aside d-flex flex-column flex-row-auto"> 
        <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15"> 
            <a href="{{ url('/') }}" class="login-logo text-center pt-lg-25 pb-10">
                <img src="{{ asset('assets/media/logos/logo-1.png')}}" class="max-h-70px" alt="" />
            </a> 
            <h3 class="font-weight-bolder text-center font-size-h4 text-dark-50 line-height-xl">User Experience &amp; Interface Design
            <br />Strategy SaaS Solutions</h3> 
        </div> 
        <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-x-center" style="background-position-y: calc(100% + 5rem); background-image: url({{ asset('assets/media/svg/illustrations/login-visual-5.svg')}}"></div> 
    </div> 
    <div class="login-content flex-row-fluid d-flex flex-column p-10">
        <div class="text-right d-flex justify-content-center">
            <div class="top-signin text-right d-flex justify-content-end pt-5 pb-lg-0 pb-10">
                <span class="font-weight-bold text-muted font-size-h4">Having issues?</span>
                <a href="javascript:;" class="font-weight-bold text-primary font-size-h4 ml-2" id="kt_login_signup">Get Help</a>
            </div>
        </div>
        <div class="d-flex flex-row-fluid flex-center"> 
            <div class="login-form"> 
                <form method="POST" action="{{ route('login') }}" class="form">
                    @csrf
                    <div class="pb-5 pb-lg-15">
                        <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">{{ __('Login') }}</h3>
                    </div> 
                    <div class="form-group">
                        <label class="font-size-h6 font-weight-bolder text-dark">Email Id</label>
                        <input id="email" type="email" class="form-control h-auto py-7 px-6 rounded-lg border-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus autocomplete="off" > 
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> 
                    <div class="form-group">
                        <div class="d-flex justify-content-between mt-n5">
                            <label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label> 
                            @if (Route::has('password.request')) 
                                <a href="{{ route('password.request') }}" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5">{{ __('Forgot Your Password?') }}</a> 
                            @endif
                        </div>
                        <input id="password" type="password" class="form-control h-auto py-7 px-6 rounded-lg border-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> 
                    <div class="pb-lg-0 pb-5">
                        <button type="submit" id="" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">Log In</button> 
                    </div> 
                </form> 
            </div> 
        </div> 
    </div> 
</div>
@endsection
