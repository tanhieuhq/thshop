<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'dashboard']);
            return $next($request);
        });
        // session(['module_active' => 'dashboard']);
    }
    function show(Request $request)
    {
        $status = $request->input('status');
        if ($status == 'success') {
            $order_list = Order::where('status', 'Thành công')->paginate(10);
        } elseif ($status == 'pending') {
            $order_list = Order::where('status', 'Đang xử lý')->paginate(10);
        } elseif($status == 'canceled') {
            $order_list = Order::where('status', 'Đã hủy')->paginate(10);
        }else{
            $order_list=Order::orderby('created_at','desc')->paginate(10);
        }

        $order_success=Order::where('status','Thành công')->count();
        $order_pending=Order::where('status','Đang xử lý')->count();
        $order_canceled=Order::where('status','Đã hủy')->count();
        $orders=Order::all();
        $sales=0;
        foreach($orders as $item){
            $sales+=$item->amount_total;
        }
        $order=[$order_success,$order_pending,$order_canceled,$order_list,$sales];
        return view('admin.dashboard',compact('order'));
    }
}