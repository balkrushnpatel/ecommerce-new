@extends('layouts.master')
@section('content')
	<div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">Grid 3</h1>
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
                <li><a href="#" class="nav-filter active" data-filter="*">All Blog Posts <span>6</span></a></li>
                <li><a href="#" class="nav-filter" data-filter=".clothes">Clothes <span>1</span></a></li>
                <li><a href="#" class="nav-filter" data-filter=".entertainment">Entertainment <span>1</span></a></li>
                <li><a href="#" class="nav-filter" data-filter=".fashion">Fashion <span>2</span></a></li>
                <li><a href="#" class="nav-filter" data-filter=".lifestyle">Lifestyle <span>3</span></a></li>
                <li><a href="#" class="nav-filter" data-filter=".others">Others <span>2</span></a></li>
                <li><a href="#" class="nav-filter" data-filter=".shoes">Shoes <span>1</span></a></li>
                <li><a href="#" class="nav-filter" data-filter=".technology">Technology <span>1</span></a></li>
            </ul>

            <div class="row grid cols-lg-3 cols-md-2 mb-2" data-grid-options="{
                'layoutMode': 'fitRows'
            }">
                <article class="post post-grid-type grid-item overlay-zoom fashion">
                    <figure class="post-media br-sm">
                        <a href="javascript:void(0);">
                            <img src="{{ asset('user/images/blog/2cols/1.jpg') }} " width="600"
                                height="420" alt="blog">
                        </a>
                    </figure>
                    <div class="post-details">
                        <div class="post-cats text-primary">
                            <a href="#">Fashion</a>
                        </div>
                        <h4 class="post-title">
                            <a href="javascript:void(0);">New found the men dress for summer</a>
                        </h4>
                        <div class="post-content">
                            <p>Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, 
                            eget blandit nunc tortor eu nibh. Suspendisse potenti.Sed egstas, ant at 
                            vulputate volutpat, uctus metus libero eu augue, vitae luctus…</p> <a href="javascript:void(0);" class="btn btn-link btn-primary">(read more)</a>
                        </div>
                        <div class="post-meta">
                            by <a href="#" class="post-author">John Doe</a>
                            - <a href="#" class="post-date">03.01.2021</a>
                            <a href="#" class="post-comment"><i class="w-icon-comments"></i><span>7</span>Comments</a>
                        </div>
                    </div>
                </article>
                <article class="post post-grid-type grid-item overlay-zoom others technology">
                    <figure class="post-media br-sm">
                        <a href="javascript:void(0);">
                            <img src="{{ asset('user/images/blog/2cols/2.jpg') }} " width="600"
                                height="420" alt="blog">
                        </a>
                    </figure>
                    <div class="post-details">
                        <div class="post-cats text-primary">
                            <a href="#">Others</a>,
                            <a href="#">Technology</a>
                        </div>
                        <h4 class="post-title">
                            <a href="javascript:void(0);">Recognitory the needs is primary condition  for design</a>
                        </h4>
                        <div class="post-content">
                            <p>Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, 
                            eget blandit nunc tortor eu nibh. Suspendisse potenti.Sed egstas, ant at 
                            vulputate volutpat, uctus metus libero eu augue, vitae luctus…</p>
                            <a href="javascript:void(0);" class="btn btn-link btn-primary">(read more)</a>
                        </div>
                        <div class="post-meta">
                            by <a href="#" class="post-author">John Doe</a>
                            - <a href="#" class="post-date">03.05.2021</a>
                            <a href="#" class="post-comment"><i class="w-icon-comments"></i><span>4</span>Comments</a>
                        </div>
                    </div>
                </article>
                <article class="post post-grid-type grid-item overlay-zoom clothes">
                    <figure class="post-media br-sm">
                        <a href="javascript:void(0);">
                            <img src="{{ asset('user/images/blog/2cols/3.jpg') }} " width="600"
                                height="420" alt="blog">
                        </a>
                    </figure>
                    <div class="post-details">
                        <div class="post-cats text-primary">
                            <a href="#">Clothes</a>
                        </div>
                        <h4 class="post-title">
                            <a href="javascript:void(0);">New found the women’s shirt  for summer season</a>
                        </h4>
                        <div class="post-content">
                            <p>Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, 
                            eget blandit nunc tortor eu nibh. Suspendisse potenti.Sed egstas, ant at 
                            vulputate volutpat, uctus metus libero eu augue, vitae luctus…</p>
                            <a href="javascript:void(0);" class="btn btn-link btn-primary">(read more)</a>
                        </div>
                        <div class="post-meta">
                            by <a href="#" class="post-author">John Doe</a>
                            - <a href="#" class="post-date">03.01.2021</a>
                            <a href="#" class="post-comment"><i class="w-icon-comments"></i><span>2</span>Comments</a>
                        </div>
                    </div>
                </article>
                <article class="post post-grid-type grid-item overlay-zoom lifestyle">
                    <figure class="post-media br-sm">
                        <a href="javascript:void(0);">
                            <img src="{{ asset('user/images/blog/2cols/4.jpg') }} " width="600"
                                height="420" alt="blog">
                        </a>
                    </figure>
                    <div class="post-details">
                        <div class="post-cats text-primary">
                            <a href="#">Lifestyle</a>
                        </div>
                        <h4 class="post-title">
                            <a href="javascript:void(0);">We want to be different and fashion gives to me that outlet</a>
                        </h4>
                        <div class="post-content">
                            <p>Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, 
                            eget blandit nunc tortor eu nibh. Suspendisse potenti.Sed egstas, ant at 
                            vulputate volutpat, uctus metus libero eu augue, vitae luctus…</p>
                            <a href="javascript:void(0);" class="btn btn-link btn-primary">(read more)</a>
                        </div>
                        <div class="post-meta">
                            by <a href="#" class="post-author">John Doe</a>
                            - <a href="#" class="post-date">03.03.2021</a>
                            <a href="#" class="post-comment"><i class="w-icon-comments"></i><span>5</span>Comments</a>
                        </div>
                    </div>
                </article>
                <article class="post post-grid-type grid-item overlay-zoom entertainment shoes lifestyle others">
                    <figure class="post-media br-sm">
                        <a href="javascript:void(0);">
                            <img src="{{ asset('user/images/blog/2cols/5.jpg') }} " width="600"
                                height="420" alt="blog">
                        </a>
                    </figure>
                    <div class="post-details">
                        <div class="post-cats text-primary">
                            <a href="#">Entertainment</a>,
                            <a href="#">Lifestyle</a>,
                            <a href="#">Others</a>
                        </div>
                        <h4 class="post-title">
                            <a href="javascript:void(0);">Comes a cool blog post with Images</a>
                        </h4>
                        <div class="post-content">
                            <p>Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, 
                            eget blandit nunc tortor eu nibh. Suspendisse potenti.Sed egstas, ant at 
                            vulputate volutpat, uctus metus libero eu augue, vitae luctus…</p>
                            <a href="javascript:void(0);" class="btn btn-link btn-primary">(read more)</a>
                        </div>
                        <div class="post-meta">
                            by <a href="#" class="post-author">John Doe</a>
                            - <a href="#" class="post-date">03.01.2021</a>
                            <a href="#" class="post-comment"><i class="w-icon-comments"></i><span>2</span>Comments</a>
                        </div>
                    </div>
                </article>
                <article class="post post-grid-type grid-item overlay-zoom fashion lifestyle">
                    <figure class="post-media br-sm">
                        <a href="javascript:void(0);">
                            <img src="{{ asset('user/images/blog/2cols/6.jpg') }} " width="600"
                                height="420" alt="blog">
                        </a>
                    </figure>
                    <div class="post-details">
                        <div class="post-cats text-primary">
                            <a href="#">Fashion</a>,
                            <a href="#">Technology</a>
                        </div>
                        <h4 class="post-title">
                            <a href="javascript:void(0);">Fusce lacinia arcuet nulla</a>
                        </h4>
                        <div class="post-content">
                            <p>Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, 
                            eget blandit nunc tortor eu nibh. Suspendisse potenti.Sed egstas, ant at 
                            vulputate volutpat, uctus metus libero eu augue, vitae luctus…</p>
                            <a href="javascript:void(0);" class="btn btn-link btn-primary">(read more)</a>
                        </div>
                        <div class="post-meta">
                            by <a href="#" class="post-author">John Doe</a>
                            - <a href="#" class="post-date">03.06.2021</a>
                            <a href="#" class="post-comment"><i class="w-icon-comments"></i><span>3</span>Comments</a>
                        </div>
                    </div>
                </article>
            </div> 
        </div>
    </div>
@endsection