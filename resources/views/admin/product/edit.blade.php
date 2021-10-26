@extends('layouts.backend.master')

@section('product')
    active
@endsection

@section('content')
    <!-- Page-Title -->
    <div class="row">
      <div class="col-sm-12">
          <h4 class="pull-left page-title"> Product update</h4>
          <ol class="breadcrumb pull-right">
              <li><a href="#">Ecommerce</a></li>
              <li><a href="{{route ('product.index')}}">Product list</a></li>
              <li class="active">Product update Page</li>
          </ol>
      </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Product update</h3></div>
                <div class="panel-body">
                    <form role="form" action="{{route ('product.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{$product->name}}">

                            @if ($errors->has('name'))
                            <span class="text-danger">{{$errors->first('name')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="qnty">Product-Quantity</label>
                            <input type="text" name="qnty" class="form-control" id="qnty" value="{{$product->qnty}}">

                            @if ($errors->has('qnty'))
                            <span class="text-danger">{{$errors->first('qnty')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="price">Product-Price</label>
                            <input type="text" name="price" class="form-control" id="price" value="{{$product->price}}">

                            @if ($errors->has('price'))
                            <span class="text-danger">{{$errors->first('price')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Brand Name</label>
                            <select class="form-control" name="brand_id">
                                <option label="Choose Brand name"></option>
                                @foreach($brands as $brand)
                                    <option value="{{$brand->id}}" {{$product->brand_id==$brand->id ? 'selected':''}}>{{$brand->name}}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('brand_id'))
                            <span class="text-danger">{{$errors->first('brand_id')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Category Name</label>
                            <select class="form-control" name="category_id">
                                <option label="Choose Category name"></option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{$product->category_id==$category->id ? 'selected':''}}>{{$category->name}}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('category_id'))
                            <span class="text-danger">{{$errors->first('category_id')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="image">Product-Image</label>
                            <img src="{{asset($product->image)}}" width="70" height="70">
                            <input type="file" name="image" class="form-control" id="image">

                            @if ($errors->has('image'))
                            <span class="text-danger">{{$errors->first('image')}}</span>
                            @endif
                        </div>
                        <input type="hidden" name="image1" value="{{$product->image}}">
                        <button type="submit" class="btn btn-purple waves-effect waves-light">Submit</button>
                    </form>
                </div><!-- panel-body -->
            </div> <!-- panel -->
        </div>
    </div>

@endsection