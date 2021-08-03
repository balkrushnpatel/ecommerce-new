@extends('layouts.master')
@section('title','Contact Us')
@section('content') 
    <!-- Start of Page Header -->
    <div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">Contact Us</h1>
        </div>
    </div>
    <!-- End of Page Header -->

    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav mb-10 pb-1">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>Contact Us</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    <!-- Start of PageContent -->
    <div class="page-content contact-us">
        <div class="container">
        	<p>@include('partials._home_flash')</p>
            <section class="content-title-section mb-10">
                <h3 class="title title-center mb-3">Contact
                    Information
                </h3>
                <p class="text-center">Lorem ipsum dolor sit amet,
                    consectetur
                    adipiscing elit, sed do eiusmod tempor incididunt ut</p>
            </section>
            <!-- End of Contact Title Section -->

            <section class="contact-information-section mb-10">
		        <div class="row owl-carousel owl-theme cols-xl-4 cols-md-3 cols-sm-2 cols-1" data-owl-options="{
		                'items': 4,
		                'nav': false,
		                'dots': false,
		                'loop': false,
		                'margin': 20,
		                'responsive': {
		                    '0': {
		                        'items': 1
		                    },
		                    '480': {
		                        'items': 2
		                    },
		                    '768': {
		                        'items': 3
		                    },
		                    '992': {
		                        'items': 4
		                    }
		                }
		            }">
                    <div class="icon-box text-center icon-box-primary">
                        <span class="icon-box-icon icon-email">
                            <i class="w-icon-envelop-closed"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title">E-mail Address</h4>
                            <p>{{ getSetting('contact_email') }}</p>
                        </div>
                    </div>
                    <div class="icon-box text-center icon-box-primary">
                        <span class="icon-box-icon icon-headphone">
                            <i class="w-icon-headphone"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title">Phone Number</h4>
                            <p>{{ getSetting('contact_phone') }}</p>
                        </div>
                    </div>
                    <div class="icon-box text-center icon-box-primary">
                        <span class="icon-box-icon icon-map-marker">
                            <i class="w-icon-map-marker"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title">Address</h4>
                            <p>{{ getSetting('contact_address') }}</p>
                        </div>
                    </div>
                    <div class="icon-box text-center icon-box-primary">
                        <span class="icon-box-icon icon-fax">
                            <i class="w-icon-net-world"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title">Website</h4>
                            <p>{{ getSetting('contact_website') }}</p>
                        </div>
                    </div>
                </div>
            </section>  
            <hr class="divider mb-10 pb-1"> 
            <section class="contact-section">
                <div class="row gutter-lg pb-3">
                    <div class="col-lg-6 mb-8">
                        <h4 class="title mb-3">Faq</h4>
                        <div class="accordion accordion-bg accordion-gutter-md accordion-border">
                            @foreach($faqs as $faq)
                            <div class="card">
                                <div class="card-header">
                                    <a href="#collapse1" class="collapse">{{$faq->faq_question}}</a>
                                </div>
                                <div id="collapse1" class="card-body expanded">
                                    <p class="mb-0">
                                        {!! $faq->faq_answer !!}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6 mb-8">
                        <h4 class="title mb-3">Send Us a Message</h4>
                        <form class="form contact-us-form" action="{{ route('inquiry.send') }}" method="post">
                        	{{csrf_field()}}
                            <div class="form-group">
                                <label for="name">Your Name <span class="required">*</span></label>
                                <input type="text" id="name" name="name"
                                    class="form-control">
                                @error('name')
									<span id="name-error" class="error">
										<strong>{{ $message }}</strong>
									</span> 
								@enderror
                            </div>
                            <div class="form-group">
                                <label for="email_id">Your Email <span class="required">*</span></label>
                                <input type="email" id="email_id" name="email_id" class="form-control">
                                @error('email_id')
									<span id="email_id-error" class="error">
										<strong>{{ $message }}</strong>
									</span> 
								@enderror
                            </div>
                            <div class="form-group">
                                <label for="subject">Your Subject <span class="required">*</span></label>
                                <input type="text" id="subject" name="subject" class="form-control">
                                @error('subject')
									<span id="subject-error" class="error">
										<strong>{{ $message }}</strong>
									</span> 
								@enderror
                            </div>
                            <div class="form-group">
                                <label for="message">Your Message <span class="required">*</span></label>
                                <textarea id="message" name="message" cols="30" rows="5" class="message-control"></textarea>
                                @error('name')
									<span id="message-error" class="error">
										<strong>{{ $message }}</strong>
									</span> 
								@enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-outline">Send Now</button>
                        </form>
                    </div>
                </div>
            </section> 
        </div> 
        <div class="google-map contact-google-map" id="googlemaps">
        	<iframe id="gmap_canvas" src="https://maps.google.com/maps?q=Mission%20District%2C%20San%20Francisco%2C%20CA%2C%20USA&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed" width="100%" height="100%"></iframe>
        </div> 
    </div> 
@endsection