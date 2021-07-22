@extends('layouts.app')

@push('stylesheets') 

@endpush
@section('title',' General Setting')
@section('content')
@include('layouts.partials.sub-header',['pageHeader' => 'Setting']) 
<div class="card card-custom">
    <div class="card-header card-header-tabs-line">
      <div class="card-toolbar">
        <ul class="nav nav-tabs nav-bold nav-tabs-line">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1_4">
              <span class="nav-icon"><i class="flaticon2-chat-1"></i></span>
              <span class="nav-text">General Setting</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2_4">
              <span class="nav-icon"><i class="flaticon2-drop"></i></span>
              <span class="nav-text">Smtp Setting</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3_4">
              <span class="nav-icon"><i class="flaticon2-drop"></i></span>
              <span class="nav-text">Social Links</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_4_4">
              <span class="nav-icon"><i class="flaticon2-drop"></i></span>
              <span class="nav-text">Terms & Condition</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_5_4">
              <span class="nav-icon"><i class="flaticon2-drop"></i></span>
              <span class="nav-text">Privacy Policy</span>
            </a>
          </li>
        </ul> 
      </div>
    </div>
  <div class="card-body">
    <form class="form" action="{{route('general.setting')}}"method="post" role="form" enctype="multipart/form-data">
      {{csrf_field()}}
        @section('editMethod')
        @show  
        @csrf
      <div class="tab-content">
        <div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">
            <div class="row">
              <div class="col-3 form-group">
               <label for="system_name" class="col-form-label">  System Name <span class="required">*</span></label>
                <input type="text" value="{{getSetting('system_name')}}" class="form-control" id="system_name"  name="system_name">
              </div>
               <div class="col-3 form-group">
                <label for="system_email" class="col-form-label">  System Email <span class="required">*</span></label>
                <input type="text" class="form-control"  value="{{getSetting('system_email')}}"id="system_email"  name="system_email">
              </div>
              <div class="col-3 form-group">
                <label for="system_title" class="col-form-label">  System Title <span class="required">*</span></label>
                <input type="text" class="form-control" value="{{getSetting('system_title')}}" id="system_title"  name="system_title">
              </div>
            </div>
            <div class="row">
                <div class="col-3 form-group">
                 <label for="cache_time" class="col-form-label">Homepage Cache Time(Minutes)<span class="required">*</span></label>
                  <input type="text" min="0" step="5"class="form-control number" id="cache_time" value="{{getSetting('cache_time')}}" name="cache_time">
                </div>
                <div class="col-3 form-group">
                  <label for="pro-folder-name" class="col-form-label">Downloadable Product Folder Name <span class="required">*</span></label>
                  <input type="text" class="form-control" id="pro-folder-name" value="{{getSetting('pro_folder_name')}}" name="pro_folder_name">
                </div>
                <div class="col-3 form-group">
                  <label for="language" class="col-form-label">  Language<span class="required">*</span></label>
                  <select class="form-control select2" name="language_id" id="language"> 
                    <option value="">Select Language</option> 
                    @foreach(getLanguage() as $key => $language)
                     <option  value="{{ $key }}"  {{ (getSetting('language_id')  == $key ? 'selected' : '') }} > {{ $language }}</option> 
                    @endforeach  
                  </select>
                </div>
            </div>
        </div>
        <div class="tab-pane fade " id="kt_tab_pane_2_4" role="tabpanel" aria-labelledby="kt_tab_pane_2_4">
          <div class="form-group row">
            <label class="col-form-label">Smtp Status</label>
            <div class="col-3">
              <span class="switch switch-success">
                <label class="col-3 col-form-label">
                <input type="checkbox"  {{ (getSetting('smtp_status')  == 1 ? ' checked' : '') }} value="1" name="smtp_status"/>
                <span></span>
                </label>
              </span>
            </div>
          </div>
          <div class="row">
            <div class="col-3 form-group">
             <label for="smtp_host" class="col-form-label">  Smtp Host <span class="required">*</span></label>
              <input type="text" class="form-control" value="{{getSetting('smtp_host')}}" id="smtp_host"  name="smtp_host">
            </div>
            <div class="col-3 form-group">
              <label for="smtp_port" class="col-form-label">  Smtp Port<span class="required">*</span></label>
              <input type="text" class="form-control"  value="{{getSetting('smtp_port')}}" id="smtp_port"  name="smtp_port">
            </div>
            <div class="col-3 form-group">
              <label for="smtp_user" class="col-form-label">  Smtp User <span class="required">*</span></label>
              <input type="text" class="form-control" value="{{getSetting('smtp_user')}}" id="smtp_user"  name="smtp_user">
            </div>
            <div class="col-3 form-group">
              <label for="smtp_pwd" class="col-form-label">  Smtp Password <span class="required">*</span></label>
              <input type="password" class="form-control" value="{{getSetting('smtp_pwd')}}" id="smtp_user" id="smtp_pwd"  name="smtp_pwd">
            </div>
          </div>
        </div>
        <div class="tab-pane fade " id="kt_tab_pane_3_4" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">
          <div class="row">
            <div class="col-3 form-group input-group-prepend">
              <span class="input-group-text"><i class="socicon-facebook text-primary mr-5"></i></span>
              <input type="text" class="form-control" id="facebook" value="{{getSetting('facebook_link')}}" name="facebook_link">
            </div> 
            <div class="col-3 form-group input-group-prepend">
              <span class="input-group-text"><i class="socicon-twitter text-primary mr-5"></i></span>
              <input type="text" class="form-control" value="{{getSetting('twitter_link')}}" id="twitter"  name="twitter_link">
            </div>
            <div class="col-3 form-group input-group-prepend">
              <span class="input-group-text"><i class="socicon-instagram text-primary mr-5"></i></span>
              <input type="text" class="form-control" value="{{getSetting('google_link')}}" id="google_link"  name="google_link">
            </div>
          </div>
          <div class="row">
            <div class="col-3 form-group input-group-prepend">
              <span class="input-group-text"><i class="socicon-pinterest text-danger mr-5"></i></span>
              <input type="text" class="form-control" value="{{getSetting('pinterest_link')}}" id="pinterest"  name="pinterest_link">
            </div>
            <div class="col-3 form-group input-group-prepend">
              <span class="input-group-text"><i class="socicon-skype text-primary mr-5"></i></span>
              <input type="text" class="form-control"  value="{{getSetting('skype_link')}}" id="skype"  name="skype_link">
            </div> 
            <div class="col-3 form-group input-group-prepend">
              <span class="input-group-text"><i class="socicon-youtube text-danger mr-5"></i></span>
              <input type="text" class="form-control" id="youtube" value="{{getSetting('youtube_link')}}"  name="youtube_link">
            </div>
          </div> 
        </div>
        <div class="tab-pane fade " id="kt_tab_pane_4_4" role="tabpanel" aria-labelledby="kt_tab_pane_4_4">
         <div class="form-group row">
              <div class="col-lg-12">
                <textarea name="terms_condition" id="kt-ckeditor-1">{{getSetting('terms_condition')}}
                </textarea>
                  <div class="fv-plugins-message-container"></div>
              </div> 
         </div>
        </div>
        <div class="tab-pane fade " id="kt_tab_pane_5_4" role="tabpanel" aria-labelledby="kt_tab_pane_5_4">
          <div class="form-group row">
              <div class="col-lg-12">
                <textarea name="privacy_policy" id="kt-ckeditor-2">{{getSetting('privacy_policy')}}
                </textarea>
                  <div class="fv-plugins-message-container"></div>
              </div> 
         </div>
        </div>
      </div>
      <div class="col-3 form-group row">
          <button type="submit" class="btn btn-light-success font-weight-bold mr-2">Save</button>
      </div>
    </form>
  </div>
</div>
@endsection
