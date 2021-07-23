@extends('layouts.master')
@section('title','All Brand')
@section('content')
	<main class="main">
		<!-- Start of Breadcrumb -->
		<nav class="breadcrumb-nav">
		    <div class="container">
		        <ul class="breadcrumb bb-no">
		            <li><a href="{{ url('/') }}">Home</a></li>
		            <li><a href="javascript:void(0);" class="active">Category</a></li> 
		        </ul>
		    </div>
		</nav> 
		<div class="page-content pb-10 mb-2">
            <div class="container">
                <section class="category-section mb-10 pb-1">
	                <h2 class="title title-center mb-5">Category Group</h2>
	                <div class="row">
	                	@foreach(getCategory() as $item)
	                		<div class="col-sm-12 col-md-4 pt-5">
			                    <div class="category-wrap">
			                        <div class="category category-group-image brand-group-image">
			                            <div class="category-content">
			                                <h4 class="category-name">
			                                	<a href="{{ route('category.product',array('id' => $item['id'], 'slug' => Str::slug($item['slug'])))}}">{{ $item['name'] }}</a>
			                                </h4>
			                                <ul class="category-list">
			                                	@foreach($item['subCategory'] as $key=> $sitem)
			                                		@foreach($sitem['brands'] as $key=> $bitem)
				                                    	<li><a href="{{ route('brand.product',array('id' => $bitem['id'], 'slug' => Str::slug($bitem['slug'])))}}">{{ $bitem['name'] }}</a></li>
				                                    @endforeach
				                                @endforeach
			                                </ul>
			                            </div>
			                            <a href="#">
			                                <figure class="category-media">
			                                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"
			                                        width="190" height="214" />
			                                </figure>
			                            </a>
			                        </div>
			                    </div> 
			                </div>
		                @endforeach 
		            </div>
	            </section>
            </div>
        </div>
	</main>
@endsection