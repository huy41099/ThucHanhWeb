<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
session_start();

class CategoryBrand extends Controller
{
    public function add_category_brand()
    {
        return view('admin.add_category_brand');
    }

    public function all_category_brand() 
    {
        $all_category_brand   = DB::table('tbl_brand')->get();
        $manager_category     = view('admin.all_category_brand')->with('all', $all_category_brand);
        return view('admin_layout')->with('admin.all_category_brand',$manager_category);
    }

    public function save_category_brand(Request $request) 
    {
        $data = array();
        //Get data
        $data['brand_name']   = $request->cateBrandName;
        $data['brand_desc']   = $request->cateBrandDesc;
        $data['brand_status'] = $request->cateBrandStatus;

        //Insert database
        DB::table('tbl_brand')->insert($data);
        Session::put('msg','Add brand successful.');
        return Redirect::to('add-category-brand');
    }

    public function inactive_category_brand($cateBrand_id) 
    {
        DB::table('tbl_brand')
        ->where('brand_id',$cateBrand_id)
        ->update(['brand_status' => 1]);
        Session::put('msg','Active category brand successful');
        return Redirect::to('all-category-brand');
    }

    public function active_category_brand($cateBrand_id) 
    {
        DB::table('tbl_brand')
        ->where('brand_id',$cateBrand_id)
        ->update(['brand_status' => 0]);
        Session::put('msg','Inactive category brand successful');
        return Redirect::to('all-category-brand');
    }

    public function edit_category_brand($cateBrand_id) 
    {
        $edit_category_brand = DB::table('tbl_brand')->where('brand_id',$cateBrand_id)->get();
        $manager_brand       = view('admin.edit_category_brand')->with('edit', $edit_category_brand);
        return view('admin_layout')->with('admin.edit_category_brand',$manager_brand);
    }

    public function update_category_brand(Request $request, $cateBrand_id) 
    {
        $data = array();
        //Get data
        $data['brand_name'] = $request->cateBrandtName;
        $data['brand_desc'] = $request->cateBrandtDesc;

        //Update data
        DB::table('tbl_brand')->where('brand_id', $cateBrand_id)->update($data);
        Session::put('msg','Update brand successful.');
        return Redirect::to('all-category-brand');
    }

    public function delete_category_brand($cateBrand_id) 
    {
        DB::table('tbl_brand')->where('brand_id', $cateBrand_id)->delete();
        Session::put('msg','Delete brand successful.');
        return Redirect::to('all-category-brand');
    }
}
