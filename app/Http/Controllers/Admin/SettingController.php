<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use Validator;
use DB;
use File;
class SettingController extends Controller
{
    public function index(){
         return view('admin.setting.index');
    }
    public function homesetting(Request $request){
       try {  
            DB::beginTransaction();
            $validator = Validator::make($request->all(),[
               
            ]);
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
            //Featured Product
            $setting=$this->set('featured_products');
            $setting->type       = 'featured_products';
            $setting->value      = ($request->input('featured_products'))?$request->input('featured_products'):0; 
            $setting->save();
            
            $setting=$this->set('no_of_featured_products');
            $setting->type       = 'no_of_featured_products';
            $setting->value      = $request->input('no_of_featured_products');
            $setting->save();

            //Bundle Product
            $setting=$this->set('bundle_products');
            $setting->type       = 'bundle_products';
            $setting->value      = ($request->input('bundle_products'))?$request->input('bundle_products'):0; 
            $setting->save();
            
            $setting=$this->set('no_of_bundle_products');
            $setting->type       = 'no_of_bundle_products';
            $setting->value      = $request->input('no_of_bundle_products');
            $setting->save();

            //Customer Product
            $setting=$this->set('customer_products');
            $setting->type       = 'customer_products';
            $setting->value      = ($request->input('customer_products'))?$request->input('customer_products'):0; 
            $setting->save();
            
            $setting=$this->set('no_of_customer_products');
            $setting->type       = 'no_of_customer_products';
            $setting->value      = $request->input('no_of_customer_products');
            $setting->save();

            //Vendor
            $setting=$this->set('vendor');
            $setting->type       = 'vendor';
            $setting->value      = ($request->input('vendor'))?$request->input('vendor'):0; 
            $setting->save();

            
            $setting=$this->set('no_of_vendor');
            $setting->type       = 'no_of_vendor';
            $setting->value      = $request->input('no_of_vendor');
            $setting->save();

            $setting=$this->set('vendor_title');
            $setting->type       = 'vendor_title';
            $setting->value       =$request->input('vendor_title');
            $setting->save();
          
            DB::commit();
             return view('admin.setting.index');

        }catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        } 
    }


    function set($type){
        $settingtype=Settings::where('type',$type)->first();
        if($settingtype){
           $setting=Settings::findOrFail($settingtype->id);
        }else{
            $setting  = new Settings();
        }
        return $setting;
    }

    public function contact(){
        return view('admin.setting.contact');
    }
    public function contactsetting(Request $request){
       try {  
            DB::beginTransaction();
            $validator = Validator::make($request->all(),[
               
            ]);
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $setting=$this->set('contact_address');
            $setting->type       = 'contact_address';
            $setting->value       =$request->input('contact_address');
            $setting->save();

            $setting=$this->set('contact_phone');
            $setting->type       = 'contact_phone';
            $setting->value      =$request->input('contact_phone');
            $setting->save();

            $setting=$this->set('contact_email');
            $setting->type       = 'contact_email';
            $setting->value      =$request->input('contact_email');
            $setting->save();

            $setting=$this->set('contact_website');
            $setting->type       = 'contact_website';
            $setting->value      =$request->input('contact_website');
            $setting->save();


            $setting=$this->set('contact_about');
            $setting->type       = 'contact_about';
            $setting->value      =$request->input('contact_about');
            $setting->save();
            DB::commit();
             return view('admin.setting.contact');

        }catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        } 
    }

    public function header(){

        return view('admin.setting.header');
    }

    function setHeader(Request $request){
      if($request->ajax()){
        try {  
            DB::beginTransaction();
            $isEnable = $request->isEnable;
            $name=$request->name;

             $setting=$this->set($name);
            $setting->type       = $name;
            $setting->value       =$isEnable;
            $setting->save();

            $status = 3;
            $featured = ' un public';
            if($isEnable == 1){
              $status = 2;
              $featured = ' public';
            }
           DB::commit();
            return response()->json([ 
              'status'=>$status ,
              'message'=>str_replace("_"," ",$name).$featured,
            ]);
        }catch (\Exception $e) {
            DB::rollback(); 
            return response()->json($e->getMessage());
        } 
      }else{
          return abort(404);
      }
    }

    public function footer(){
        return view('admin.setting.footer');
    }

    public function footersetting(Request $request){
       try {  
            DB::beginTransaction();
            $validator = Validator::make($request->all(),[
               
            ]);
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $setting=$this->set('footer_cat_id');
            $setting->type  = 'footer_cat_id';
            $setting->value = ($request->input('foot_cat_id') ? implode(",", $request->input('foot_cat_id')) : null);
            $setting->save();

            $setting=$this->set('footer_text');
            $setting->type      = 'footer_text';
            $setting->value     =$request->input('foot_text');
            $setting->save();
           
            DB::commit();
            return view('admin.setting.footer');
        }catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        } 
    }
    
    public function favicon(){
         return view('admin.setting.favicon');
    }

    public function faviconsetting(Request $request){
       try {  
            DB::beginTransaction();
            $validator = Validator::make($request->all(),[
               
            ]);
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
           $setting=$this->set('favicon_image');
           $setting->type      = 'favicon_image'; 
            if ($request->hasFile('image')) {
                $image = $request->file('image');

                $name = 'favicon.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/favicon/');
                $image->move($destinationPath, $name);
                $setting->value= $name; 
                $setting->save();
            } 
            DB::commit();
            return view('admin.setting.favicon');
        }catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        } 
    }
    public function logo(){
        return view('admin.setting.logo');
    }
    public function logosetting(Request $request){
       try {  
            DB::beginTransaction();
            $validator = Validator::make($request->all(),[
               
            ]);
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $setting=$this->set('logo_image');
            $setting->type      = 'logo_image'; 
            if ($request->hasFile('image')) { 
                $image = $request->file('image');
                $name = 'logo.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/logo/');
                $image->move($destinationPath, $name);
                $setting->value= $name; 
                $setting->save();
            } 
            DB::commit();
            return view('admin.setting.logo');
        }catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        } 
    }
    public function general(){
         return view('admin.setting.generalsetting');
    }
    public function generalsetting(Request $request){
       try {  
            DB::beginTransaction();
            $validator = Validator::make($request->all(),[
               
            ]);
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $setting=$this->set('system_name');
            $setting->type      = 'system_name';
            $setting->value     =$request->input('system_name');
            $setting->save();

            $setting=$this->set('system_email');
            $setting->type      = 'system_email';
            $setting->value     =$request->input('system_email');
            $setting->save();

            $setting=$this->set('system_title');
            $setting->type      = 'system_title';
            $setting->value     =$request->input('system_title');
            $setting->save();

            $setting=$this->set('cache_time');
            $setting->type      = 'cache_time';
            $setting->value     =$request->input('cache_time');
            $setting->save();

            $setting=$this->set('pro_folder_name');
            $setting->type      = 'pro_folder_name';
            $setting->value     =$request->input('pro_folder_name');
            $setting->save();

            $setting=$this->set('language_id');
            $setting->type  = 'language_id';
            $setting->value = $request->input('language_id');
            $setting->save();

            $setting=$this->set('smtp_status');
            $setting->type  = 'smtp_status';
            $setting->value = $request->input('smtp_status');
            $setting->save();

            $setting=$this->set('smtp_host');
            $setting->type  = 'smtp_host';
            $setting->value = $request->input('smtp_host');
            $setting->save();

            $setting=$this->set('smtp_port');
            $setting->type  = 'smtp_port';
            $setting->value = $request->input('smtp_port');
            $setting->save();

            $setting=$this->set('smtp_user');
            $setting->type  = 'smtp_user';
            $setting->value = $request->input('smtp_user');
            $setting->save();
            
            $setting=$this->set('smtp_pwd');
            $setting->type  = 'smtp_pwd';
            $setting->value = $request->input('smtp_pwd');
            $setting->save();

            $setting=$this->set('facebook_link');
            $setting->type  = 'facebook_link';
            $setting->value = $request->input('facebook_link');
            $setting->save();

            $setting=$this->set('google_link');
            $setting->type  = 'google_link';
            $setting->value = $request->input('google_link');
            $setting->save();

            $setting=$this->set('twitter_link');
            $setting->type  = 'twitter_link';
            $setting->value = $request->input('twitter_link');
            $setting->save();

            $setting=$this->set('pinterest_link');
            $setting->type  = 'pinterest_link';
            $setting->value = $request->input('pinterest_link');
            $setting->save();

            $setting=$this->set('skype_link');
            $setting->type  = 'skype_link';
            $setting->value = $request->input('skype_link');
            $setting->save();

            $setting=$this->set('youtube_link');
            $setting->type  = 'youtube_link';
            $setting->value = $request->input('youtube_link');
            $setting->save();

            $setting=$this->set('terms_condition');
            $setting->type  = 'terms_condition';
            $setting->value = $request->input('terms_condition');
            $setting->save();

            $setting=$this->set('privacy_policy');
            $setting->type  = 'privacy_policy';
            $setting->value = $request->input('privacy_policy');
            $setting->save();

            DB::commit();
            return view('admin.setting.generalsetting');
        }catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        } 
    }

    public function shipment(){
        return view('admin.setting.shipment');
    }
    public function shipmentsetting(Request $request){
       try {  
            DB::beginTransaction();
            $validator = Validator::make($request->all(),[
               
            ]);
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $setting=$this->set('shipment_cost');
            $setting->type       = 'shipment_cost';
            $setting->value      =$request->input('shipment_cost');
            $setting->save();


            $setting=$this->set('shipment_info');
            $setting->type       = 'shipment_info';
            $setting->value      =$request->input('shipment_info');
            $setting->save();
            DB::commit();
             return view('admin.setting.shipment');

        }catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        } 
    }

}
