@extends('layouts.backend.master')

@section('subcategory')
    active
@endsection

@section('content')
    <!-- Page-Title -->
    <div class="row">
      <div class="col-sm-12">
          <h4 class="pull-left page-title"> Sub-Category Add</h4>
          <ol class="breadcrumb pull-right">
              <li><a href="#">Ecommerce</a></li>
              <li><a href="{{route ('subcategory.index')}}">Sub-Category list</a></li>
              <li class="active">Sub-Category Add Page</li>
          </ol>
      </div>
    </div>
    <div class="row">
        <div class="col-md-10 m-auto offset-md-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Sub-Category Add</h3></div>
                <div class="panel-body">
                    <form role="form" action="{{route ('subcategory.store')}}" method="POST">
                    @csrf
                        <div class="form-group">
                            <label for="name">Sub-Category Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter Sub-Category">

                            @if ($errors->has('name'))
                            <span class="text-danger">{{$errors->first('name')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <select class="form-control" name="category_id">
                                <option label="Choose Category name"></option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('category_id'))
                            <span class="text-danger">{{$errors->first('category_id')}}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-purple waves-effect waves-light">Submit</button>
                    </form>
                </div><!-- panel-body -->
            </div> <!-- panel -->
        </div>
    </div>

@endsection