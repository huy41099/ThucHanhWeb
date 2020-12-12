@extends('layout')
@section('content')
@foreach($detailProduct as $key=>$product)
<div class="product-details"><!--product-details-->

    
    <div class="col-sm-5">
        <div class="view-product">
            <img src="{{URL::to('public/upload/products/'.$product->product_image)}}" alt="" />
        </div>
    </div>
    

    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
            <h2>{{$product->product_name}}</h2>
            <p>Mã sản phẩm: {{$product->product_id}}</p>
            <img src="{{URL::to('public/frontend/images/product-details/rating.png')}}" alt="" />
            
            <form action="{{URL::to('/save-cart')}}" method="POST">
               {{csrf_field()}}
                <span>
                    <span>US {{number_format($product->product_price).'$'}}</span>
                    <label>Số lượng:</label>
                    <input name='qty' type="number" minimun="1" value="1" />
                    <input type="hidden" name="productId_hidden" value="{{$product->product_id}}"/>
                    <button type="submit" class="btn btn-fefault cart">
                        <i class="fa fa-shopping-cart"></i>
                        Thêm giỏ hàng
                    </button>
                </span>
            </form>

            <p><b>Tình trạng:</b> Còn hàng</p>
            <p><b>Category:</b> {{$product->category_name}}</p>
            <p><b>Brand:</b> {{$product->brand_name}}</p>
            <p><b>Mô tả:</b> {{$product->product_desc}}</p>
            <a href=""><img src="{{URL::to('public/frontend/images/product-details/share.png')}}" class="share img-responsive"  alt="" /></a>
        </div><!--/product-information-->
    </div>
</div><!--/product-details-->
@endforeach
@endsection