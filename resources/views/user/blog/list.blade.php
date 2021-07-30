@extends('layouts.master')
@section('content')
	<div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">Blog</h1>
        </div>
    </div> 
    <nav class="breadcrumb-nav mb-6">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="javascript:void(0);">Blog</a></li>
            </ul>
        </div>
    </nav> 
    <div class="page-content">
        <div class="container">
            <ul class="nav-filters filter-underline blog-filters mb-4">
                <li><a href="#" class="nav-filter active" data-filter="*">All Blog Posts<span></span></a></li>
                @foreach($blogCategory as $key=>$blogcat)
                <li><a href="#" id="cat-{{$blogcat->id}}" class="nav-filter blogcat " data-filter=".cat-{{$blogcat->id}}">{{$blogcat->name}}<span></span></a></li>
                @endforeach
            </ul>
          
            <div class="row grid cols-lg-3 cols-md-2 mb-2" data-grid-options="{
                'layoutMode': 'fitRows'
            }"> @foreach($blogs as $blog)
                    <article class="post post-grid-type grid-item overlay-zoom cat-{{$blog->blog_cat_id}}">
                    <figure class="post-media br-sm">
                        <a href="javascript:void(0);">
                            <img src="{{asset('/uploads/blog/'.$blog->id.'/'.$blog->image)}} " width="600"
                                height="420" alt="blog">
                        </a>
                    </figure>
                    <div class="post-details">
                        <div class="post-cats text-primary">
                            <a href="#">{{$blog->blogCat->name}}</a>
                        </div>
                        <h4 class="post-title">
                            <a href="{{route('blogs.detail',array('id' => $blog->id, 'slug' => Str::slug($blog->slug)))}}">{{$blog->title}}</a>
                        </h4>
                        <div class="post-content">
                            <p>{!! Str::limit($blog->description, 200)!!}</p> <a href="{{route('blogs.detail',array('id' => $blog->id, 'slug' => Str::slug($blog->slug)))}}" class="btn btn-link btn-primary">(read more)</a>
                        </div>
                        <div class="post-meta">
                            by <a href="#" class="post-author">{{$blog->author}}</a>
                            - <a href="#" class="post-date">{{$blog->created_at}}</a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div> 
        </div>
    </div>
@endsection
@push('scripts') 
@if(!empty($categry)) 
    <script type="text/javascript">
    window.addEventListener('load',function() { 
        setTimeout(function() {
           $('#cat-{{ $categry }}').trigger('click');
        }, 50);
    }); 
    </script>
@endif
@endpush