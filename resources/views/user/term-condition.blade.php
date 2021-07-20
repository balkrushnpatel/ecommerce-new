@extends('layouts.master')
@section('title','Privacy Policy')
@section('content')
	<div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">Term & Condition</h1>
        </div>
    </div> 
    <nav class="breadcrumb-nav mb-10 pb-8">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>Term & Condition</li>
            </ul>
        </div>
    </nav> 
    <div class="page-content">
        <div class="container">
        	<div class="row">
        		<div class="col-sm-12 text-justify">
        			{!! getSetting('terms_condition') !!}
        		</div>
        	</div>
        </div>
    </div>
@endsection 