<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
session_start();
class AdminController extends Controller
{
    public function index() {
        return view('admin_login');
    }

    public function showDashboard() {
        return view('admin.dashboard');
    }

    //LOGIN ADMINISTRATOR
    public function logIn(Request $request) {
        $email    = $request->admin_Email;
        $password = md5($request->admin_Password);
        
        $result   = DB::table('tbl_admin')
        ->where('admin_email', $email)
        ->where('admin_password', $password)
        ->first();

        if($result) {
            Session::put('admin_name', $result->admin_name);
            Session::put('admin_id', $result->admin_id);
            return Redirect::to('/dashboard');
        } else {
            Session::put('msg','Please check email or password. Try again!!!');
            return view('/admin_login');
        }
    }

    //LOGOUT ADMINISTRATOR
    public function logOut() {
        return view('admin_login');
    }
}
