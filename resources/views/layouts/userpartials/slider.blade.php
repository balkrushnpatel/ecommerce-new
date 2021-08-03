 @foreach($sliders as $slider)
      <li><a href="#">{{$slider->name}}</a></li>
<div class="single-slider bg_cover" style="background-image: url({{asset('/uploads/slider/'.$slider->id.'/'.$slider->image)}})">
<div class="container">
<div class="row">
<div class="col-lg-6">
<div class="slider-content">
<h5 class="sub-title" data-animation="fadeInDown" data-delay="0.3s">{{$slider->text}}</h5>
<h2 class="slider-title" data-animation="fadeInLeft" data-delay="0.5s">{{$slider->text}}</h2>
<p class="text" data-animation="fadeInLeft" data-delay="0.7s">{{$slider->name}}</p>
<a class="main-btn" data-animation="fadeInUp" data-delay="0.9s" href="#"><i class="lni lni-cart"></i>{{$slider->link}}</a>
</div>
</div>
</div> 
</div> 
</div> 
 @endforeach  