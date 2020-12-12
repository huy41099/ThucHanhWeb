@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                UPDATE CATEGORY PRODUCT
            </header>
            <div class="panel-body">
                <?php
                    $msg = Session::get('msg');
                    if($msg) {
                        echo "<b style='color:green'>".$msg."</b>";
                        Session::put('msg',null);
                    }
                ?>
                @foreach($edit as $key => $edit_cate)
                <div class="position-center">
                <form role="form" action="{{URL::to('/update-category-product/'.$edit_cate->category_id)}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Product name</label>
                        <input type="text" value="{{$edit_cate->category_name}}" class="form-control" id="exampleInputEmail1" name="cateProductName">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <textarea  style="resize:none" rows="8" class="form-control" name="cateProductDesc" id="exampleInputPassword1">
                            {{$edit_cate->category_desc}}
                        </textarea>
                    </div>
                    <button type="submit" class="btn btn-info" name="updateCateProduct">Submit</button>
                </form>
                </div>
                @endforeach
            </div>
        </section>

    </div>
</div>
@endsection