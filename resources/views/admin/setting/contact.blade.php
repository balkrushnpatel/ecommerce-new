@extends('layouts.app')
@section('title','Contact Create')
@section('content')
@include('layouts.partials.sub-header',['pageHeader' => 'Contact'])
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
<!--begin::Container-->
    <div class="container-fluid"> 
    <!--begin::Card-->
        <div class="card card-custom">
              <div class="card-header flex-wrap py-3">
                  <div class="card-title">
                  <h3 class="card-label">Contact
                  </div> 
              </div>
              <form id="contact-form"  class="form fv-plugins-bootstrap fv-plugins-framework" action="{{route('contact.setting')}}" method="post" accept-charset="utf-8" role="form" enctype="multipart/form-data">
              {{csrf_field()}}
              @section('editMethod')
              @show  
              @csrf 
                <div class="card-body"> 
                    <div class="row"> 
                        <div class="form-group col-3">
                                <label for="cont-address" class="col-form-label"> Contact Address<span class="required">*</span></label>
                                <input type="text" class="form-control" id="cont-address"  name="cont_address">
                                <div class="fv-plugins-message-container"></div>
                        </div>
                        <div class="form-group col-3">
                           
                                <label for="cont-phone" class="col-form-label"> Contact Phone<span class="required">*</span></label>
                                <input type="number" class="form-control" id="cont-phone"  name="cont_phone">
                                <div class="fv-plugins-message-container"></div>
                           
                        </div>
                        <div class="form-group col-3">
                                                              <label for="cont-email" class="col-form-label"> Contact Email<span class="required">*</span></label>
                                <input type="email" class="form-control" id="cont-email"  name="cont_email">
                                <div class="fv-plugins-message-container"></div>
                           
                        </div>
                        <div class="form-group col-3">
                            
                                <label for="cont-website" class="col-form-label"> Contact Website<span class="required">*</span></label>
                                <input type="text" class="form-control" id="cont-website"  name="cont_website">
                                <div class="fv-plugins-message-container"></div>
                        </div>
                    </div>    
                      <div class="form-group row">
                          <div class="col-lg-12">
                              <label for="cont-about" class="col-form-label"> Contact About<span class="required">*</span></label>
                             <textarea name="cont_about" id="kt-ckeditor-1">
                             </textarea>
                              <div class="fv-plugins-message-container"></div>
                          </div> 
                      </div>
                      <div class="form-group row">
                          <button type="submit" class="btn btn-light-success font-weight-bold mr-2">Save</button>
                      </div>
                      </div> 
                      </div> 
                  </div>
              </form>
        </div>  
@endsection