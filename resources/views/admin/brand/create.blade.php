@extends('layouts.backend.master')

@section('brand')
    active
@endsection

@section('content')
    <!-- Page-Title -->
    <div class="row">
      <div class="col-sm-12">
          <h4 class="pull-left page-title"> Brand Add</h4>
          <ol class="breadcrumb pull-right">
              <li><a href="#">Ecommerce</a></li>
              <li><a href="{{route ('brand.index')}}">Brand list</a></li>
              <li class="active">Brand Add Page</li>
          </ol>
      </div>
    </div>
    <div class="row">
        <div class="col-md-10 m-auto offset-md-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Brand Add</h3></div>
                <div class="panel-body">
                    <form role="form" action="{{route ('brand.store')}}" method="POST">
                    @csrf
                        <div class="form-group">
                            <label for="name">Brand Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter Brand name">

                            @if ($errors->has('name'))
                            <span class="text-danger">{{$errors->first('name')}}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-purple waves-effect waves-light">Submit</button>
                    </form>
                </div><!-- panel-body -->
            </div> <!-- panel -->
        </div>
    </div>

@endsection