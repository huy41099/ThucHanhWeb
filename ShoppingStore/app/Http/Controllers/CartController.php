<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
session_start();

class CartController extends Controller
{
    public function save_cart(Request $request) {
        $quantity     = $request->qty;
        $productID    = $request->productId_hidden;
        $product_info = DB::table('tbl_product')->where('product_id', $productID)->first();

        $data['id']     = $product_info->product_id;
        $data['qty']    = $quantity;
        $data['name']   = $product_info->product_name;
        $data['weight'] = '123';
        $data['price']  = $product_info->product_price;
        $data['image']  = $product_info->product_image;
        Cart::add($data);
        
        return Redirect::to('/show-cart');
    }

    public function show_cart() {
        $categoryProduct = DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
        $brandProduct    = DB::table('tbl_brand')->orderBy('brand_id','desc')->get();

        return view('pages.cart.show_cart')
        ->with('categoryProduct', $categoryProduct)
        ->with('brandProduct', $brandProduct);
    }

    public function delete_cart($rowId) {
        Cart::update($rowId, 0);
        return Redirect::to('/show-cart');
    }
}