@extends('layouts.master')
@section('title','BlogDetail')
@section('content')
 <main class="main">
            <!-- Start of Page Header -->
            <div class="page-header">
                <div class="container">
                    <h1 class="page-title mb-0">Blog Detail</h1>
                </div>
            </div>
            <!-- End of Page Header -->

            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb bb-no">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{route('blogs')}}">Blog</a></li>
                        <li>Blog Detail</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of Page Content -->
            <div class="page-content mb-8">
                <div class="container">
                    <div class="row gutter-lg">
                        <div class="main-content post-single-content">
                            <div class="post post-grid post-single">
                                <figure class="post-media br-sm">
                                    <img src="{{asset('/uploads/blog/'.$blog->id.'/'.$blog->image)}} " alt="Blog" width="930" height="500" />
                                </figure>
                                <div class="post-details">
                                    <div class="post-meta">
                                        by <a href="#" class="post-author">{{ $blog->author}}</a>
                                        - <a href="#" class="post-date">{{ $blog->created_at}}</a>
                                    </div>
                                    <h2 class="post-title"><a href="#">{{$blog->title}}</a></h2>
                                    <div class="post-content">
                                        <p>{!! $blog->description!!}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Post -->
                            <!-- End Post Navigation -->
                            <h4 class="title title-lg font-weight-bold mt-10 pt-1 mb-5">Related Posts</h4>
                            <div class="post-slider owl-carousel owl-theme owl-nav-top row cols-lg-3 cols-md-4 cols-sm-3 cols-xs-2 cols-1 pb-2" data-owl-options="{
                                'nav': true,
                                'dots': false,
                                'margin': 20,
                                'responsive': {
                                    '0': {
                                        'items': 1
                                    },
                                    '576': {
                                        'items': 2
                                    },
                                    '768': {
                                        'items': 3
                                    },
                                    '992': {
                                        'items': 2
                                    },
                                    '1200': {
                                        'items': 3
                                    }
                                }
                            }"> 
                                @foreach($posts as $post)
                                <div class="post post-grid">
                                    <figure class="post-media br-sm">
                                        <a href="#">
                                            <img src="{{asset('/uploads/blog/'.$post->id.'/'.$post->image)}} " alt="Post" width="296"
                                                height="190" style="background-color: #bcbcb4;" />
                                        </a>
                                    </figure>
                                    <div class="post-details text-center">
                                        <div class="post-meta">
                                            by <a href="#" class="post-author">{{$post->author}}</a>
                                            - <a href="#" class="post-date">{{$post->created_at}}</a>
                                        </div>
                                        <h4 class="post-title mb-3"><a href="#">{!! Str::limit($blog->description, 200)!!}</a></h4>
                                        <a href="{{route('blogs.detail',array('id' => $post->id, 'slug' => Str::slug($post->slug)))}}" class="btn btn-link btn-dark btn-underline font-weight-normal">Read More<i class="w-icon-long-arrow-right"></i></a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <!-- End Related Posts -->
                        </div>
                        <!-- End of Main Content -->
                        <aside class="sidebar right-sidebar blog-sidebar sidebar-fixed sticky-sidebar-wrapper">
                            <div class="sidebar-overlay">
                                <a href="#" class="sidebar-close">
                                    <i class="close-icon"></i>
                                </a>
                            </div>
                            <a href="#" class="sidebar-toggle">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <div class="sidebar-content">
                                <div class="sticky-sidebar">
                                    <!-- End of Widget search form -->
                                    <div class="widget widget-categories">
                                    	@php  $blogcats=App\Models\BlogCat::where('status',1)->get();@endphp
                                        <h3 class="widget-title bb-no mb-0">Categories</h3>
                                        <ul class="widget-body filter-items search-ul">
                                        	@foreach($blogcats as $blogcat)
                                            <li><a href="{{route('blog.category',$blogcat->id)}}">{{$blogcat->name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- End of Widget categories -->
                                    <div class="widget widget-posts">
                                        <h3 class="widget-title bb-no">Popular Posts</h3>
                                        <div class="widget-body">
                                            <div class="owl-carousel owl-theme owl-nav-top row cols-1" data-owl-options="{
                                                'nav': true,
                                                'dots': false,
                                                'margin': 20
                                            }"> @php $blogs=App\Models\Blog::where('status',1)->get();@endphp
                                                @foreach($blogs as $blog)
                                                <div class="widget-col">
                                                    <div class="post-widget mb-4">
                                                        <figure class="post-media br-sm">
                                                            <img src="{{asset('/uploads/blog/'.$blog->id.'/'.$blog->image)}} " alt="Blog" width="150" height="150" />
                                                        </figure>
                                                        <div class="post-details">
                                                            <div class="post-meta">
                                                                <a href="#" class="post-date">{{$blog->created_at}}</a>
                                                            </div>
                                                            <h4 class="post-title">
                                                                <a href="{{route('blogs.detail',array('id' => $blog->id, 'slug' => Str::slug($blog->slug)))}}">{!!Str::limit($blog->description, 200)!!}}</a>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End of Widget posts -->
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
            <!-- End of Page Content -->
        </main>
@endsection