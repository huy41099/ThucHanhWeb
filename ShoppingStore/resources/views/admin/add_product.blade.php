@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                ADD  PRODUCT
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
                    <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Product name</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="productName">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Image</label>
                        <input type="file" class="form-control" id="exampleInputEmail1" name="productImage">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Product Category</label>
                        <select name="productCategory" class="form-control m-bot15">
                            @foreach($categoryProduct as $key=>$value)
                            <option value="{{$value->category_id}}">{{$value->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Product Brand</label>
                        <select name="productBrand" class="form-control m-bot15">
                            @foreach($brandProduct as $key=>$value)
                            <option value="{{$value->brand_id}}">{{$value->brand_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Content</label>
                        <textarea style="resize:none" rows="8" class="form-control" name="productContent" id="exampleInputPassword1">
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <textarea style="resize:none" rows="8" class="form-control" name="productDesc" id="exampleInputPassword1">
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Price</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="productPrice">
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
                </div>

            </div>
        </section>

    </div>
</div>
@endsection