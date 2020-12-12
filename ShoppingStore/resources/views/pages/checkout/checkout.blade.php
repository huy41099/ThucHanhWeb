@extends('layout')
@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{URL::to('/home-page')}}">Trang chủ</a></li>
              <li class="active">Thanh toán</li>
            </ol>
        </div>
        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-10 clearfix">
                    <div class="bill-to">
                        <p>ĐIỀN THÔNG TIN</p>
                        <div class="form-one">
                            <form action="{{URL::to('/save-shipping')}}" method="POST">
                                {{csrf_field()}}
                                <input type="text" name="shipName" placeholder="Họ và tên *">
                                <input type="text" name="shipAddress" placeholder="Địa chỉ">
                                <input type="text" name="shipPhone" placeholder="Số điện thoại">
                                <input type="text" name="shipEmail" placeholder="Email">
                                <textarea name="shipNote" placeholder="Ghi chú đơn hàng" rows="10"></textarea>
                                <input type="submit" name="sendOrder" value="Gửi" class="btn btn-primary btn-sm">
                            </form>
                        </div>
                    </div>
                </div>				
            </div>
        </div>
        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
        </div>

        
        <div class="payment-options">
            <span>
                <label><input type="checkbox"> Direct Bank Transfer</label>
            </span>
            <span>
                <label><input type="checkbox"> Check Payment</label>
            </span>
            <span>
                <label><input type="checkbox"> Paypal</label>
            </span>
        </div>
    </div>
</section> <!--/#cart_items-->

@endsection