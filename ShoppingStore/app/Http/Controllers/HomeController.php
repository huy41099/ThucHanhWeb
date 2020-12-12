<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
session_start();

class HomeController extends Controller
{
    public function index() {
        $categoryProduct = DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
        $brandProduct    = DB::table('tbl_brand')->orderBy('brand_id','desc')->get();
        $product         = DB::table('tbl_product')->orderBy('product_id','desc')->limit(3)->get();
        return view('pages.home')
            ->with('categoryProduct',$categoryProduct)
            ->with('brandProduct',$brandProduct)
            ->with('product', $product); 
    }

    public function show_category_product($category_id) {
        $categoryProduct = DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
        $brandProduct    = DB::table('tbl_brand')->orderBy('brand_id','desc')->get();
        $category_by_id  = DB::table('tbl_product')
        ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->where('tbl_product.category_id', $category_id)->get();
        
        return view('pages.category.category_product_home')
        ->with('categoryProduct', $categoryProduct)
        ->with('brandProduct', $brandProduct)
        ->with('category_by_id', $category_by_id);
    }

    public function show_brand_product($brand_id) {
        $categoryProduct = DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
        $brandProduct    = DB::table('tbl_brand')->orderBy('brand_id','desc')->get();
        $brand_by_id     = DB::table('tbl_product')
        ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->where('tbl_product.brand_id', $brand_id)->get();
        
        return view('pages.brand.brand_product_home')
        ->with('categoryProduct', $categoryProduct)
        ->with('brandProduct', $brandProduct)
        ->with('brand_by_id', $brand_by_id);
    }

    public function show_detail($product_id) {
        $categoryProduct = DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
        $brandProduct    = DB::table('tbl_brand')->orderBy('brand_id','desc')->get();
        $detailProduct   = DB::table('tbl_product')
        ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        ->where('tbl_product.product_id', $product_id)->get();
        
        return view('pages.details.product_detail_home')
        ->with('categoryProduct', $categoryProduct)
        ->with('brandProduct', $brandProduct)
        ->with('detailProduct', $detailProduct);
    }
}
