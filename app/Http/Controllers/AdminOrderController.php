<?php

namespace App\Http\Controllers;

use App\Order;
use App\Detail_order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    function __construct(){
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'order']);
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders=Order::all();
        return view('admin.order.list',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     function detail_order($id){
        $order=Order::find($id);
        $detail_order=Detail_order::where('order_id',$id)->get();
        return view('admin.order.detail_order',compact('order','detail_order'));
     }
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
    public function show()
    {
        
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
        $status=$request->input('status');
        if($status==0){
            $status='Thành công';
        }elseif($status==1){
            $status='Đang xử lý';
        }elseif($status==2){
            $status='Đã hủy';
        }
        Order::where('id',$id)->update(['status'=>$status]);
        return redirect('/admin/order/list/');
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
