@extends('layouts.backend.master')

@section('coupon')
    active
@endsection

@section('content')
  
  <!-- Page-Title -->
  <div class="row">
      <div class="col-sm-12">
          <h4 class="pull-left page-title"> Coupon List</h4>          
          <ol class="breadcrumb pull-right">
              <li><a href="#">Ecommerce</a></li>
              <li class="active">Coupon list Page</li>
          </ol>
      </div>
  </div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{route ('coupon.create')}}" class="btn btn-info btn-sm pull-right">Add Coupon</a>
                <h3 class="panel-title">Coupon list Table</h3>                
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Coupon Name</th>
                                    <th>Discount</th>
                                    <th>Status</th>
                                    <th>Action</th>                                
                                </tr>
                            </thead>

                     
                            <tbody>
                              @foreach($coupons as $key => $coupon)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$coupon->name}}</td>
                                    <td>{{$coupon->discount}}%</td>
                                    <td class="text-center">
                                      @if($coupon->status === 1)
                                        <i class="fa fa-check-square text-success"></i>
                                      @else
                                        <i class="fa fa-times text-danger"></i>
                                      @endif
                                    </td>
                                    <td class="text-right">

                                      @if($coupon->status == 1)
                                        <a href="{{route ('coupon.inactive', $coupon->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-arrow-down"></i></a>
                                      @else
                                        <a href="{{route ('coupon.active', $coupon->id)}}" class="btn btn-success btn-sm"><i class="fa fa-arrow-up"></i></a>
                                      @endif

                                      <a href="{{route ('coupon.edit', $coupon->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>

                                      <a href="javascript:;" data-id="{{$coupon->id}}" class="btn btn-warning btn-sm swal-confirm"><i class="fa fa-trash"></i></a>
                                          <form action="{{route ('coupon.destroy', $coupon->id)}}" id="delete{{$coupon->id}}" method="POST">
                                          @csrf
                                          @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                              @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div> <!-- End Row -->

@endsection