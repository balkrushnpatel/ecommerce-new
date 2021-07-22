@extends('layouts.app')
@section('title','Shipment Create')
@section('content')
@include('layouts.partials.sub-header',['pageHeader' => 'Shipment'])
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
<!--begin::Container-->
    <div class="container-fluid"> 
    <!--begin::Card-->
        <div class="card card-custom">
              <div class="card-header flex-wrap py-3">
                  <div class="card-title">
                  <h3 class="card-label">Shipment
                  </div> 
              </div>
              <form id="shipment-form"  class="form fv-plugins-bootstrap fv-plugins-framework" action="{{route('shipment.setting')}}" method="post" accept-charset="utf-8" role="form" enctype="multipart/form-data">
              {{csrf_field()}}
              @section('editMethod')
              @show  
              @csrf 
                <div class="card-body"> 
                    <div class="row"> 
                        <div class="form-group col-3">
                                <label for="shipment-cost" class="col-form-label">Shipment Cost<span class="required">*</span></label>
                                <input type="text" class="form-control number" id="shipment-cost" value="{{getSetting('shipment_cost')}}" name="shipment_cost">
                                <div class="fv-plugins-message-container"></div>
                        </div>
                    </div>    
                      <div class="form-group row">
                          <div class="col-lg-12">
                              <label for="shipment_info" class="col-form-label">Shipment Info<span class="required">*</span></label>
                             <textarea name="shipment_info" id="kt-ckeditor-1">{{getSetting('shipment_info')}}
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