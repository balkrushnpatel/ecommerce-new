<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderDetails;
use Validator;
use DB;
class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('admin.orderdetail.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function orderView($id){
        try {
            DB::beginTransaction();
            $orderView = OrderDetails::find(decrypt($id)); 
            DB::commit();
            return view('admin.orderdetail.view',compact('orderView'));
        }catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    }

    public function deliveryDetail(Request $request){

     try {
            DB::beginTransaction();
            $orderId=$request->input('order_id');
            $deliveryDetail = OrderDetails::where('id',$orderId)->first();
            $deliveryDetail->payment_status  = $request->input('payment_status');
            $deliveryDetail->payment_details = $request->input('payment_details');
            $deliveryDetail->status          = $request->input('status');
            $deliveryDetail->delivery_details = $request->input('delivery_details'); 
            $deliveryDetail->save();
            DB::commit();
           return redirect()->route('orderDetail.index')->with('success',' Delivery  Detail Update successfully!');
        }catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
        }
    
     
    }


    public function orderDetailAjaxList(\App\Http\Requests\DataTableRequest $request){
        if($request->ajax()){
            try {  
                DB::beginTransaction();
                $recordSet = OrderDetails::orderBy('id','ASC');
                if ($request->search['value'] != '') {
                    $recordSet->where('id','LIKE',$request->search['value']."%");
                }
                $recordsTotal = $recordSet->count();
                $details = $recordSet->offset($request->start)->limit($request->length)->orderBy('id', 'desc')->get();
                $data = [];
                foreach ($details as $key => $detail) {
                    $encryptDetailId = encrypt($detail->id);
                    $action = '';

                    $action .='<a href="'.route('orders.view',$encryptDetailId).'" class="btn btn-sm btn-icon  mr-2"><i class="fas fa-eye"></i></a>';
                  $action .='<a href="javascript:void(0);" id="'.$detail->id.'" class="btn btn-primary order-delivery " title="Delivery">Delivery</a>';
                   
                    $data[] = [
                        str_replace(" ","",tableHeader(0))  => $key + 1,
                        str_replace(" ","",tableHeader(34)) => $detail->order_id,
                        str_replace(" ","",tableHeader(35)) => $detail->total_amount,
                        str_replace(" ","",tableHeader(36))  => $detail->created_at->format('d-m-Y h:i A'),
                        str_replace(" ","",tableHeader(1))  => $detail->getUser->first_name,
                        str_replace(" ","",tableHeader(37))  =>'Pending',
                        str_replace(" ","",tableHeader(4))  => $action,
                    ];
                }
                DB::commit();
                return response()->json([
                    'draw' => $request->draw,
                    'recordsTotal' => $recordsTotal,
                    'recordsFiltered' => $recordsTotal,
                    'data' => $data,
                ]);
            }catch (\Exception $e) {
                DB::rollback(); 
                return response()->json($e->getMessage());
            } 
        }else{
            return abort(404);
        }
    }
}
