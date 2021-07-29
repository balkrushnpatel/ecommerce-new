@extends('layouts.app')
@section('title','Logo')
@section('content')
@include('layouts.partials.sub-header',['pageHeader' => 'Logo Setting'])
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
<!--begin::Container-->
    <div class="container-fluid"> 
    <!--begin::Card-->
        <div class="card card-custom">
              <div class="card-header flex-wrap py-3">
                  <div class="card-title">
                  <h3 class="card-label">Logo Setting
                  </div> 
              </div>
              <form id="favicon-form"  class="form fv-plugins-bootstrap fv-plugins-framework" action="{{route('logo.setting')}}" method="post" accept-charset="utf-8" role="form" enctype="multipart/form-data">
                {{csrf_field()}}
                @section('editMethod')
                @show  
                @csrf 
                  <div class="card-body"> 
                    <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 col-form-label">Logo</label>
                            <div class="col-lg-9 col-xl-6">
                              <div class="image-input image-input-outline image-input-circle" id="kt_profile_avatar" style="background-image: url(assets/media/users/blank.png)">
                                <div class="image-input-wrapper" style="background-image: url({{ asset('uploads/logo/'.getSetting('logo_image')) }})"></div>
                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change logo">
                                  <i class="fa fa-pen icon-sm text-muted"></i>
                                  <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                  <input type="hidden" name="profile_avatar_remove" />
                                </label>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel logo">
                                  <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                  <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                              </div>
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
    </div> 
</div> 
@endsection