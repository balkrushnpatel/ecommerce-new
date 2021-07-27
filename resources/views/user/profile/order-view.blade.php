@extends('layouts.master')
@section('title','Order Detail')
@section('content') 
    <main class="main order"> 
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb shop-breadcrumb bb-no">
                    <li class="passed"><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">
                        <a href="javascript:void(0);">Order Detail</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of PageContent -->
        <div class="page-content mb-10 pb-2">
            <div class="container">  
                @include('user.checkout.order-info',$order) 
            </div>
        </div>
        <!-- End of PageContent -->
    </main>
@endsection