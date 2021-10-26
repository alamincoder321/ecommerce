@extends('layouts.backend.master')

@section('slider')
    active
@endsection

@section('content')
    <!-- Page-Title -->
    <div class="row">
      <div class="col-sm-12">
          <h4 class="pull-left page-title"> Slider update</h4>
          <ol class="breadcrumb pull-right">
              <li><a href="#">Ecommerce</a></li>
              <li><a href="{{route ('slider.index')}}">Slider list</a></li>
              <li class="active">Slider update Page</li>
          </ol>
      </div>
    </div>
    <div class="row">
        <div class="col-md-10 m-auto offset-md-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Slider update</h3></div>
                <div class="panel-body">
                    <form role="form" action="{{route ('slider.update', $slider->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="form-group">
                            <label for="name">Slider Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{$slider->name}}">

                            @if ($errors->has('name'))
                            <span class="text-danger">{{$errors->first('name')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" id="title" value="{{$slider->title}}">

                            @if ($errors->has('title'))
                            <span class="text-danger">{{$errors->first('title')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="short_text">Description</label>
                            <textarea name="short_text" class="form-control" rows="6" placeholder="Enter slider Description">{{$slider->short_text}}</textarea>

                            @if ($errors->has('short_text'))
                            <span class="text-danger">{{$errors->first('short_text')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="image">Slider-Image</label>
                            <img src="{{asset($slider->image)}}" width="70" height="70">
                            <input type="file" name="image" class="form-control" id="image" placeholder="Enter slider Description">

                            @if ($errors->has('image'))
                            <span class="text-danger">{{$errors->first('image')}}</span>
                            @endif
                        </div>
                        <input type="hidden" name="image1" value="{{$slider->image}}">
                        <button type="submit" class="btn btn-purple waves-effect waves-light">Submit</button>
                    </form>
                </div><!-- panel-body -->
            </div> <!-- panel -->
        </div>
    </div>

@endsection