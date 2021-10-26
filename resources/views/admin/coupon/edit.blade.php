@extends('layouts.backend.master')

@section('coupon')
    active
@endsection

@section('content')
    <!-- Page-Title -->
    <div class="row">
      <div class="col-sm-12">
          <h4 class="pull-left page-title"> Coupon update</h4>
          <ol class="breadcrumb pull-right">
              <li><a href="#">Ecommerce</a></li>
              <li><a href="{{route ('coupon.index')}}">Coupon list</a></li>
              <li class="active">Coupon update Page</li>
          </ol>
      </div>
    </div>
    <div class="row">
        <div class="col-md-10 m-auto offset-md-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Coupon update</h3></div>
                <div class="panel-body">
                    <form role="form" action="{{route ('coupon.store')}}" method="POST">
                    @csrf
                    @method('PUT')
                        <div class="form-group">
                            <label for="name">Coupon Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{$coupon->name}}">

                            @if ($errors->has('name'))
                            <span class="text-danger">{{$errors->first('name')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="discount">Discount</label>
                            <input type="text" name="discount" class="form-control" id="discount" value="{{$coupon->discount}}">

                            @if ($errors->has('discount'))
                            <span class="text-danger">{{$errors->first('discount')}}</span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-purple waves-effect waves-light">Submit</button>
                    </form>
                </div><!-- panel-body -->
            </div> <!-- panel -->
        </div>
    </div>

@endsection