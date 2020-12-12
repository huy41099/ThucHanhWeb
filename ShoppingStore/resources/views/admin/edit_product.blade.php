@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                UPDATE PRODUCT
            </header>
            <div class="panel-body">
                <?php
                    $msg = Session::get('msg');
                    if($msg) {
                        echo "<b style='color:green'>".$msg."</b>";
                        Session::put('msg',null);
                    }
                ?>
                <div class="position-center">
                    @foreach($editProduct as $key=>$valuePro)
                    <form role="form" action="{{URL::to('/update-product/'.$valuePro->product_id)}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Product name</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="productName" 
                        value="{{$valuePro->product_name}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Image</label>
                        <input type="file" class="form-control" id="exampleInputEmail1" name="productImage">
                        <img src="{{URL::to('/public/upload/products/'.$valuePro->product_image)}}" height="100" weight="100"/>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Product Category</label>
                        <select name="productCategory" class="form-control m-bot15">
                            @foreach($categoryProduct as $key=>$valueCate)
                                @if($valueCate->category_id == $valuePro->category_id)
                                <option selected value="{{$valueCate->category_id}}">{{$valueCate->category_name}}</option>
                                @else
                                <option value="{{$valueCate->category_id}}">{{$valueCate->category_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Product Brand</label>
                        <select name="productBrand" class="form-control m-bot15">
                            @foreach($brandProduct as $key=>$valueBrand)
                                @if($valueBrand->brand_id == $valuePro->brand_id)
                                <option selected value="{{$valueBrand->brand_id}}">{{$valueBrand->brand_name}}</option>
                                @else
                                <option value="{{$valueBrand->brand_id}}">{{$valueBrand->brand_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Content</label>
                        <textarea style="resize:none" rows="8" class="form-control" name="productContent" id="exampleInputPassword1">
                            {{$valuePro->product_content}}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <textarea style="resize:none" rows="8" class="form-control" name="productDesc" id="exampleInputPassword1">
                            {{$valuePro->product_desc}}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Price</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="productPrice"
                        value="{{$valuePro->product_price}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Status</label>
                        <select name="productStatus" class="form-control m-bot15">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info" name="addProduct">Submit</button>
                </form>
                @endforeach
                </div>

            </div>
        </section>

    </div>
</div>
@endsection