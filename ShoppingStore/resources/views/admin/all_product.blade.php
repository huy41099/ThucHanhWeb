@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        List  Product
      </div>
      <div class="row w3-res-tb">
       
      </div>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th style="width:20px;"></th>
              <th>Product name</th>
              <th>Product image</th>
              <th>Product Category</th>
              <th>Product Brand</th>
              <th>Price</th>
              <th>Display</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            <?php
                $msg = Session::get('msg');
                if($msg) {
                    echo "<b style='color:green'>".$msg."</b>";
                    Session::put('msg',null);
                }
            ?>
            @foreach($all_product as $key => $value)
              <tr>
                <td><label class="i-checks m-b-none"><i></i></label></td>
                <td> {{$value->product_name}} </td>
                <td> <img src="public/upload/products/{{$value->product_image}}" height="100"; width="100";/></td>
                <td> {{$value->category_name}} </td>
                <td> {{$value->brand_name}} </td>
                <td> {{$value->product_price}} </td>
                {{--  <td><span class="text-ellipsis">
                  <?php
                    if($value->product_status==0) {
                  ?>
                  <a href="{{URL::to('/inactive-product/'.$value->product_id)}}" style="color:red">Inactive</a>
                  <?php
                  }
                  else {
                  ?>
                    <a href="{{URL::to('/active-product/'.$value->product_id)}}" style="color:green">Active</a>
                  <?php
                    }
                  ?>
                  </span>
                </td>  --}}
                <td>
                  <a href="{{URL::to('/edit-product/'.$value->product_id)}}" class="active" style="font-size: 21px;" ui-toggle-class="">
                    <i class="fa fa-pencil-square-o text-success text-active"></i>
                  </a>
                  <a href="{{URL::to('/delete-product/'.$value->product_id)}}" onClick="return confirm('Are you confirm to delete ?')"class="active" style="font-size: 21px;"  ui-toggle-class="">
                    <i class="fa fa-times text-danger text"></i>
                  </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <footer class="panel-footer">
        <div class="row">
          <div class="col-sm-7 text-right text-center-xs">                
            <ul class="pagination pagination-sm m-t-none m-b-none">
              <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
              <li><a href="">1</a></li>
              <li><a href="">2</a></li>
              <li><a href="">3</a></li>
              <li><a href="">4</a></li>
              <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
          </div>
@endsection