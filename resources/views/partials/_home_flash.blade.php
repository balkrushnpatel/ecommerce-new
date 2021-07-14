@if(session()->has('success'))
  <div id="alert-message" class="alert alert-success alert-button">
      <a href="#" class="btn btn-success btn-rounded">Well Done</a>
      {{ session()->get('success') }}
  </div> 
@endif
@if(session()->has('error'))
 <div id="alert-message" class="alert alert-icon alert-error alert-bg alert-inline">
      <h4 class="alert-title"><i class="w-icon-times-circle"></i>Oh snap!</h4>
      {{ session()->get('success') }}
  </div> 
@endif

@if(session()->has('info'))
  <div id="alert-message" class="btn btn-warning btn-rounded">
    <a href="#" class="btn btn-success btn-rounded">Warning</a>
    {{ session()->get('success') }}
  </div> 
@endif
@if ($errors->any())
  <div id="alert-message" class="alert alert-icon alert-error alert-bg alert-inline"> 
     
    @foreach ($errors->all() as $error)
      <p>{{ $error }}</p>
    @endforeach
  </div>
@endif

