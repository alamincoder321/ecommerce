@extends('layouts.backend.master')

@section('category')
    active
@endsection

@section('content')
  
  <!-- Page-Title -->
  <div class="row">
      <div class="col-sm-12">
          <h4 class="pull-left page-title"> Category List</h4>
          <ol class="breadcrumb pull-right">
              <li><a href="#">Ecommerce</a></li>
              <li class="active">Category list Page</li>
          </ol>
      </div>
  </div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{route ('category.create')}}" class="btn btn-info btn-sm pull-right">Add Category</a>
                <h3 class="panel-title">Category list Table</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th>Status</th>
                                    <th>Action</th>                                
                                </tr>
                            </thead>

                     
                            <tbody>
                              @foreach($categories as $key => $category)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$category->name}}</td>
                                    <td class="text-center">
                                      @if($category->status === 1)
                                        <i class="fa fa-check-square text-success"></i>
                                      @else
                                        <i class="fa fa-times text-danger"></i>
                                      @endif
                                    </td>
                                    <td class="text-right">

                                      @if($category->status == 1)
                                        <a href="{{route ('category.inactive', $category->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-arrow-down"></i></a>
                                      @else
                                        <a href="{{route ('category.active', $category->id)}}" class="btn btn-success btn-sm"><i class="fa fa-arrow-up"></i></a>
                                      @endif

                                      <a href="{{route ('category.edit', $category->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>

                                      <a href="javascript:;" data-id="{{$category->id}}" class="btn btn-warning btn-sm swal-confirm"><i class="fa fa-trash"></i></a>
                                          <form action="{{route ('category.destroy', $category->id)}}" id="delete{{$category->id}}" method="POST">
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