<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use Validator;
use DB;
class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $faqs=Faq::get(); 
         return view('admin.faq.index',compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {  
          DB::beginTransaction();
            $validator = Validator::make($request->all(),[
             /* 'name' => 'required',*/
            ]);
            if ($validator->fails()) {
              return back()
                  ->withErrors($validator)
                  ->withInput();
            }

            foreach($request->input('faq_question') as $key=>$faqQuestion){
                if(isset($request->input('faq_id')[$key])){
                    $faq      = Faq::findOrFail($request->input('faq_id')[$key]);
                }else{
                    $faq      = new Faq();
                }
                $faq->faq_question           = $faqQuestion;
                $faq->faq_answer           = $request->input('faq_answer')[$key];
                $faq->save();          
            }

          DB::commit();
          return redirect()->route('faq.index')->with('success',' Faq create successfully!');
      }catch (\Exception $e) {
          DB::rollback();
          dd($e->getMessage());
      } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
