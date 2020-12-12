@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Danh mục</h2>
    @foreach($category_by_id as $key=>$valueCate)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <a href="{{URL::to('product-detail/'.$valueCate->product_id)}}">
                    <img src="{{URL::to('../public/upload/products/'.$valueCate->product_image)}}" 
                    height='270', width='80' alt="" />
                    <h2>{{$valueCate->product_price}}</h2>
                    <p>{{$valueCate->product_name}}</p>
                </div>
            </div>
        </div>
    </div>	
    @endforeach

</div><!--features_items-->

@endsection