@extends('admin.master')
@section('tittle','cccs')
@section('controller','Product')
@section('action','Edit')
@section('content')
    <style>
        .img_current {width: 150px;}
        .img_product {width: 120px; margin-bottom: 20px;}
        .icon-del {position: relative;top:-55px; left: -20px;}
    </style>
    <form action="" method="POST" enctype="multipart/form-data" name="frmEdit">
    <div class="col-lg-7" style="padding-bottom:120px">

            @include('admin.blocks.errors')
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label>Category Parent</label>
                <select class="form-control" name="sltParent">
                    <option value="0">Please Choose Category</option>
                    <?php dequy($cate,'0','--',old('sltParent'));?>
                </select>
            </div>
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" name="txtName" placeholder="Please Enter Username" value="{!! old('txtName'),isset($data) ? $data['name']: null !!}" />
            </div>
            <div class="form-group">
                <label>Price</label>
                <input class="form-control" name="txtPrice" placeholder="Please Enter Password" value="{!! old('txtPrice'),isset($data) ? $data['price']: null !!}" />
            </div>
            <div class="form-group">
                <label>Intro</label>
                <textarea class="form-control" rows="3" name="txtIntro" >{!! old('txtIntro'),isset($data) ? $data['intro']: null !!}</textarea>
                <script type="text/javascript">ckeditor("txtIntro")</script>
            </div>
            <div class="form-group">
                <label>Content</label>
                <textarea class="form-control" rows="3" name="txtContent">{!! old('txtContent'),isset($data) ? $data['content']: null !!}</textarea>
                <script type="text/javascript">ckeditor("txtContent")</script>
            </div>
            <div class="form-group ">
                <label>Images Current</label>
                <img src="{!! asset('resources/upload/'.$data['image'] ) !!}" class="img_current">
                <input type="hidden"  name="img_current" value="{!! $data['image'] !!}">
            </div>
            <div class="form-group">
                <label>Images</label>
                <input type="file" name="fImages">
            </div>
            <div class="form-group">
                <label>Product Keywords</label>
                <input class="form-control" name="txtKeywords" placeholder="Please Enter Category Keywords" value="{!! old('txtKeywords'),isset($data) ? $data['keywords']: null !!}" />
            </div>
            <div class="form-group">
                <label>Product Description</label>
                <textarea class="form-control" rows="3" name="txtDescription">{!! old('txtDescription'),isset($data) ? $data['description']: null !!}</textarea>
            </div>
            <button type="submit" class="btn btn-default">Product Edit</button>
            <button type="reset" class="btn btn-default">Reset</button>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-4">
        @foreach($product_image as $key=> $item)
            <div class="form-group" id="hinh_{!! $item['id'] !!}">
                <img src="{!! asset('resources/upload/detail/'.$item['image']) !!}" class="img_product" idHinh="{!! $item['id'] !!}" id="{!! $item['id'] !!}">
                <a href="javascript:void(0)" type="button" id="del_img_demo" class="btn btn-danger btn-circle icon-del"><i class="fa fa-times"></i></a>
                <input type="file" name="fProductDetail[]">

            </div>
        @endforeach
            <button type="button" class="btn btn-primary" id="addImages">Add Images</button>
            <div id="insert"></div>
    </div>

    </form>
@endsection