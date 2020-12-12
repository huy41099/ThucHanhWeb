<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
session_start();
class CategoryProduct extends Controller
{
    public function add_category_product() {
        return view('admin.add_category_product');
    }

    public function all_category_product() {
        $all_category_product = DB::table('tbl_category_product')->get();
        $manager_category     = view('admin.all_category_product')->with('all', $all_category_product);
        return view('admin_layout')->with('admin.all_category_product',$manager_category);
    }

    public function save_category_product(Request $request) {
        $data = array();
        //Get data
        $data['category_name']   = $request->cateProductName;
        $data['category_desc']   = $request->cateProductDesc;
        $data['category_status'] = $request->cateProductStatus;

        //Insert database
        DB::table('tbl_category_product')->insert($data);
        Session::put('msg','Add category successful.');
        return Redirect::to('add-category-product');
    }

    public function inactive_category_product($cateProduct_id) {
        DB::table('tbl_category_product')
        ->where('category_id',$cateProduct_id)
        ->update(['category_status' => 1]);
        Session::put('msg','Active category product successful');
        return Redirect::to('all-category-product');
    }

    public function active_category_product($cateProduct_id) {
        DB::table('tbl_category_product')
        ->where('category_id',$cateProduct_id)
        ->update(['category_status' => 0]);
        Session::put('msg','Inactive category product successful');
        return Redirect::to('all-category-product');
    }

    public function edit_category_product($cateProduct_id) {
        $edit_category_product = DB::table('tbl_category_product')->where('category_id',$cateProduct_id)->get();
        $manager_category      = view('admin.edit_category_product')->with('edit', $edit_category_product);
        return view('admin_layout')->with('admin.edit_category_product',$manager_category);
    }

    public function update_category_product(Request $request, $cateProduct_id) {
        $data = array();
        //Get data
        $data['category_name'] = $request->cateProductName;
        $data['category_desc'] = $request->cateProductDesc;

        //Update data
        DB::table('tbl_category_product')->where('category_id', $cateProduct_id)->update($data);
        Session::put('msg','Update category successful.');
        return Redirect::to('all-category-product');
    }

    public function delete_category_product($cateProduct_id) {
        DB::table('tbl_category_product')->where('category_id', $cateProduct_id)->delete();
        Session::put('msg','Delete category successful.');
        return Redirect::to('all-category-product');
    }
}
