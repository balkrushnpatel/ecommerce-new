@extends('layouts.app')
@section('title','Footer')
@section('content')
@include('layouts.partials.sub-header',['pageHeader' => 'Footer Setting'])
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
<!--begin::Container-->
  <div class="container-fluid"> 
    <!--begin::Card-->
    <div class="card card-custom">
      <div class="card-header flex-wrap py-3">
        <div class="card-title">
          <h3 class="card-label">Footer Setting</h3>
        </div> 
      </div>
      <form id="footer-form"  class="form fv-plugins-bootstrap fv-plugins-framework" action="{{route('footer.setting')}}" method="post" accept-charset="utf-8" role="form" enctype="multipart/form-data">
        {{csrf_field()}}
        @section('editMethod')
        @show  
        @csrf 
        <div class="card-body"> 
          <div class="row"> 
            <div class="form-group col-12">
              <label for="foot-text" class="col-form-label">Footer Category<span class="required">*</span></label>
              <select class="form-control select2" name="foot_cat_id[]" id="foot-text" multiple> 
                <option value="">Select Category</option> 
                @foreach(getCategory() as $key => $category)
                  <option selected value="{{ $category['id'] }}"> {{ $category['name'] }}</option>
                @endforeach  
              </select>
              <div class="fv-plugins-message-container"></div>
            </div> 
            <div class="col-lg-12">
              <label for="foot-text" class="col-form-label">Footer Text<span class="required">*</span></label>
              <textarea name="foot_text" id="kt-ckeditor-1">{{getSetting('vendor_title')}}</textarea>
              <div class="fv-plugins-message-container"></div>
            </div> 
          </div>
          <div class="form-group row">
            <button type="submit" class="btn btn-light-success font-weight-bold mr-2">Save</button>
          </div>
        </div> 
      </form>  
    </div>
  </div> 
</div>
@endsection