@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Sản phẩm mới</h2>

    @foreach($product as $key=>$valuePro)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <a href="{{URL::to('product-detail/'.$valuePro->product_id)}}">
                    <img src="{{URL::to('public/upload/products/'.$valuePro->product_image)}}" 
                    height='270', width='80' alt="" />
                    <h2>{{$valuePro->product_price}}</h2>
                    <p>{{$valuePro->product_name}}</p>
                </div>
            </div>
        </div>
    </div>	
    @endforeach

</div><!--features_items-->

@endsection