@extends('layouts.master')
@section('title','All Brand')
@section('content')
 <main class="main">
            <!-- Start of Page Header -->
            <div class="page-header">
                <div class="container">
                    <h1 class="page-title">Compare</h1>
                </div>
            </div>
            <!-- End of Page Header -->

            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav mb-2">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li>Compare</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of Page Content -->
            <div class="page-content mb-10 pb-2">
                <div class="container">
                    @include('user.product.compare-detail',$products)
                </div>
                <!-- End of Compare Table -->
            </div>
            <!-- End of Page Content -->
        </main>
@endsection