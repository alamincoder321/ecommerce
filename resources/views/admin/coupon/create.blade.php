@extends('layouts.backend.master')

@section('coupon')
    active
@endsection

@section('content')
    <!-- Page-Title -->
    <div class="row">
      <div class="col-sm-12">
          <h4 class="pull-left page-title"> Coupon Add</h4>
          <ol class="breadcrumb pull-right">
              <li><a href="#">Ecommerce</a></li>
              <li><a href="{{route ('coupon.index')}}">Coupon list</a></li>
              <li class="active">Coupon Add Page</li>
          </ol>
      </div>
    </div>
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Coupon Add</h3></div>
                <div class="panel-body">
                    <form role="form" action="{{route ('coupon.store')}}" method="POST">
                    @csrf
                        <div class="form-group">
                            <label for="name">Coupon Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter Coupon">

                            @if ($errors->has('name'))
                            <span class="text-danger">{{$errors->first('name')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="discount">Discount</label>
                            <input type="text" name="discount" class="form-control" id="discount" placeholder="Enter discount %">

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