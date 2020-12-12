@extends('layout')
@section('content')

<section id="cart_items">
    <div class="container">
        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
        </div>

        <div class="table-responsive cart_info">
            <?php 
                $content = Cart::content();
            ?>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="description">Tên sản phẩm</td>
                        <td class="price" style="padding-right:50px">Giá</td>
                        <td class="quantity"style="padding-right:40px">Số lượng</td>
                        <td class="total" style="padding-right:50px">Tổng tiền</td>
                        <td style="padding-right:150px"></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($content as $valueContent)
                    <tr>
                        <td class="cart_description">
                            <h4>{{$valueContent->name}}</h4>
                            <p>{{$valueContent->id}}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($valueContent->price)."$"}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href=""> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity" value="{{$valueContent->qty}}" autocomplete="off" size="2">
                                <a class="cart_quantity_down" href=""> - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                <?php
                                    $total = $valueContent->price * $valueContent->qty;
                                    echo number_format($total).' '.'$';
                                ?>
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{URL::to('/delete-cart/'.$valueContent->rowId)}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        

        <h4 style="margin:40px 0; front-size:20px;"> Chọn hình thức thanh toán </h4>
        <form action="/order" method="POST">
            {{ csrf_field() }}
            <div class="payment-options">
                <span>
                    <label><input name="payment_option" value="0" type="checkbox"> ATM </label>
                </span>
                <span>
                    <label><input name="payment_option" value="1" type="checkbox"> COD </label>
                </span>
            </div>
            <input type="submit" name="sendOrder" value="Đặt hàng" class="btn btn-primary btn-sm">
        </form>
    </div>
</section> <!--/#cart_items-->

@endsection