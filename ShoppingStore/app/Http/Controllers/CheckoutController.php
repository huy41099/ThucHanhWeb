<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    public function login_checkout() {
        return view('pages.customer.login');
    }

    public function checkout() {
        $categoryProduct = DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
        $brandProduct    = DB::table('tbl_brand')->orderBy('brand_id','desc')->get();
        return view('pages.checkout.checkout')
        ->with('categoryProduct', $categoryProduct)
        ->with('brandProduct', $brandProduct);
    }

    public function save_shipping(Request $request) {
        $data = array();
        $data['shipping_name']       = $request->shipName;
        $data['shipping_address']    = $request->shipAddress;
        $data['shipping_phone']      = $request->shipPhone;
        $data['shipping_email']      = $request->shipEmail;
        $data['shipping_note']       = $request->shipNote;
        
        $shippingId = DB::table('tbl_shipping')->insertGetId($data);

        Session::put('shipping_id', $shippingId);
        return Redirect::to('/payment');
    }

    public function payment() {
        $categoryProduct = DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
        $brandProduct    = DB::table('tbl_brand')->orderBy('brand_id','desc')->get();
        return view('pages.checkout.payment')
        ->with('categoryProduct', $categoryProduct)
        ->with('brandProduct', $brandProduct);
    }

    public function order(Request $request) {
        //insert table payment 
        $data = array();
        $data['payment_method']     = $request->payment_option;
        $data['payment_status']     = "Đang chờ xử lí";
        $paymentId = DB::table('tbl_payment')->insertGetId($data);

        //insert table order
        $order = array();
        $order['customer_id']     = Session::get('customer_id');
        $order['shipping_id']     = Session::get('shipping_id');
        $order['payment_id']      = $paymentId;
        $order['order_total']     = Cart::total();
        $order['order_status']    = "Đang chờ xử lí";
        $orderId = DB::table('tbl_order')->insertGetId($order);

        //insert order table details
        $content = Cart::content();
        foreach($content as $value_content) {
            $order_details = array();
            $order_details['order_id']               = $orderId;
            $order_details['product_id']             = $value_content->id;
            $order_details['product_name']           = $value_content->name;
            $order_details['product_price']          = $value_content->price;
            $order_details['product_sales_quantity'] = $value_content->qty;
            DB::table('tbl_order_details')->insertGetId($order_details);
        }
        
        if( $data['payment_method'] == 0) {
            Cart::destroy();
            echo "ATM";
        } else {
            Cart::destroy();
            $categoryProduct = DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
            $brandProduct    = DB::table('tbl_brand')->orderBy('brand_id','desc')->get();
            return view('pages.checkout.home_done')
            ->with('categoryProduct', $categoryProduct)
            ->with('brandProduct', $brandProduct);
        }
    }
    
}
