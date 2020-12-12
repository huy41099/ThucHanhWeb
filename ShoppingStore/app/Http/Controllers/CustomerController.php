<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function login_page() {
        return view('pages.customer.login');
    }

    public function logout_page() {
        Session::flush();
        return Redirect::to('home-page');
    }

    public function login_checkout() {
        return view('pages.checkout.login');
    }

    public function register_customer(Request $request) {
        $data = array();
        $data['customer_name']     = $request->customerName;
        $data['customer_email']    = $request->userSignUp;
        $data['customer_password'] = md5($request->passSignUp);
        $data['customer_phone']    = $request->phone;
        
        $customerId = DB::table('tbl_customers')->insertGetId($data);

        Session::put('customer_id', $customerId);
        Session::put('customer_name', $request->customerName);
        return Redirect::to('/home-page');
    }

    public function login_customer(Request $request) {
        $customer_email    = $request->userSignIn;
        $customer_password = md5($request->passSignIn);

        $result = DB::table('tbl_customers')
        ->where('customer_email', $customer_email)
        ->where('customer_password', $customer_password)->first();
        if($result!=null) {
            Session::put('customer_id', $result->customer_id);
            return Redirect::to('/home-page');
        } else {
            return Redirect::to('/login-checkout');
        }
    }
}
