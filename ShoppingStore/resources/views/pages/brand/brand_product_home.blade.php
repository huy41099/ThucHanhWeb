@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Thương hiệu </h2>
    @foreach($brand_by_id as $key=>$valueBrand)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <a href="{{URL::to('product-detail/'.$valueBrand->product_id)}}">
                    <img src="{{URL::to('../public/upload/products/'.$valueBrand->product_image)}}" 
                    height='270', width='80' alt="" />
                    <h2>{{$valueBrand->product_price}}</h2>
                    <p>{{$valueBrand->product_name}}</p> 
                </div>
            </div>
        </div>
    </div>	
    @endforeach

</div><!--features_items-->

@endsection