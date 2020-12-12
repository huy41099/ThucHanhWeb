<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ManageOrderController extends Controller
{
    public function manage_order() {
        $all_order = DB::table('tbl_order')
        // ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
        // ->select('tbl_order.*','tbl_customers.customer_name')
        ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
        ->join('tbl_shipping','tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
        ->join('tbl_order_details', 'tbl_order.order_id', '=', 'tbl_order_details.order_id')
        ->select('tbl_order.*', 'tbl_customers.*', 'tbl_shipping.*', 'tbl_order_details.*')
        ->orderby('tbl_order.order_id','desc')->get();

        $manager_order = view('admin.manage_order')
        ->with('all_order', $all_order);
        return view('admin_layout')->with('admin.manage_order',$manager_order);
    }

    public function delete_order($order_id) {
        DB::table('tbl_order')->where('order_id', $order_id)->delete();
        Session::put('msg','Delete order successful.');
        return Redirect::to('manage-order');
    }

    public function order_details($order_id) {
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
        ->join('tbl_shipping','tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
        ->join('tbl_order_details', 'tbl_order.order_id', '=', 'tbl_order_details.order_id')
        ->select('tbl_order.*', 'tbl_customers.*', 'tbl_shipping.*', 'tbl_order_details.*')
        ->first();
        // echo "<pre>";
        // print_r($order_by_id);
        // echo "</pre>";
        
        $manager_order_by_id = view('admin.order_details')
        ->with('order_by_id',$order_by_id);
        return view('admin_layout')->with('admin.order_details',$manager_order_by_id);
    }
}
