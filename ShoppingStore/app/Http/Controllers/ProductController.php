<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
session_start();

class ProductController extends Controller
{
    public function add_product() 
    {
        $categoryProduct = DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
        $brandProduct    = DB::table('tbl_brand')->orderBy('brand_id','desc')->get();
        return view('admin.add_product')
            ->with('categoryProduct',$categoryProduct)
            ->with('brandProduct',$brandProduct); 
    }

    public function all_product() 
    {
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')->get();
        $manager_product = view('admin.all_product')->with('all_product', $all_product);
        return view('admin_layout')->with('admin.all_product',$manager_product);
    }

    public function save_product(Request $request)
    {
        $data = array();
        $data['product_name']    = $request->productName;
        $data['product_image']   = $request->productImage;
        $data['category_id']     = $request->productCategory;
        $data['brand_id']        = $request->productBrand;
        $data['product_content'] = $request->productContent;
        $data['product_desc']    = $request->productDesc;
        $data['product_price']   = $request->productPrice;
        $data['product_status']  = $request->productStatus;
       
        if($request->hasFile('productImage')) {
            $image = $request->file('productImage');
            if($image) {
                $get_name_image = $image->getClientOriginalName();
                $name_image     = current(explode('.',$get_name_image));
                $new_image      = $name_image.rand(0,99).'.'.$image->getClientOriginalExtension();
                $image->move('public/upload/products',$new_image);
                $data['product_image'] = $new_image;
                DB::table('tbl_product')->insert($data);
                Session::put('msg','Add product successful.');
                return Redirect::to('add-product');
            }
        }
        
        $data['product_image'] = '';
        DB::table('tbl_product')->insert($data);
        Session::put('msg','Add product successful.');
        return Redirect::to('add-product');
    }

    public function inactive_product($product_id) 
    {
        DB::table('tbl_product')
        ->where('product_id',$product_id)
        ->update(['product_status' => 1]);
        Session::put('msg','Active product successful');
        return Redirect::to('all-product');
    }

    public function active_product($product_id) 
    {
        DB::table('tbl_product')
        ->where('product_id',$product_id)
        ->update(['product_status' => 0]);
        Session::put('msg','Inactive product successful');
        return Redirect::to('all-product');
    }

    public function edit_product($product_id) 
    {
        $categoryProduct = DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
        $brandProduct    = DB::table('tbl_brand')->orderBy('brand_id','desc')->get();
        $edit_product    = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_product = view('admin.edit_product')
        ->with('editProduct', $edit_product)
        ->with('categoryProduct', $categoryProduct)
        ->with('brandProduct', $brandProduct);
        return view('admin_layout')
        ->with('admin.edit_product',$manager_product);
    }

    public function update_product(Request $request, $product_id) 
    {
        $data = array();
        //Get data
        $data['product_name']    = $request->productName;
        $data['category_id']     = $request->productCategory;
        $data['brand_id']        = $request->productBrand;
        $data['product_content'] = $request->productContent;
        $data['product_desc']    = $request->productDesc;
        $data['product_price']   = $request->productPrice;
        $data['product_status']  = $request->productStatus;

        $get_image = $request->file('productImage');
        if($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image     = current(explode('.',$get_name_image));
            $new_image      = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/products',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id', $product_id)->update($data);
            Session::put('msg','Update product successful.');
            return Redirect::to('all-product');
        }
        DB::table('tbl_product')->where('product_id', $product_id)->update($data);
        Session::put('msg','Update product successful.');
        return Redirect::to('all-product');
    }

    public function delete_product($product_id)
    {
        DB::table('tbl_product')->where('product_id', $product_id)->delete();
        Session::put('msg','Delete category successful.');
        return Redirect::to('all-product');
    }
}
