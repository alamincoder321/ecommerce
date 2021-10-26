<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use App\Models\Slider;
use Carbon\Carbon;
class SliderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required',
            'title'     => 'required',
            'image'     => 'required|mimes:png,jpg,jpeg',
        ]);

        if($request->hasFile('image')) {

            $image = $request->file('image');
            $filename = uniqid() . "-" . time() . "." . $image->getClientOriginalExtension();

            Image::make($image)->resize(484,441)->save(public_path('images/slider/'.$filename));
            $img_url ="images/slider/".$filename;
        }

        $slider = new Slider;
        $slider->name       = $request->name;
        $slider->title      = $request->title;
        $slider->short_text = $request->short_text;
        $slider->image      = $img_url;
        $slider->created_at = Carbon::now();
        $slider->save();

        Toastr::success('Slider added successfully!');
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'      => 'required',
            'title'     => 'required',
            'image'     => 'required|mimes:png,jpg,jpeg',
        ]);

        $slider = Slider::findOrFail($id);
        $old    = $request->image1;
        if($request->hasFile('image')) {
            if (File::exists($old)) {
                File::delete($old);
            }

            $image = $request->file('image');
            $filename = uniqid() . "-" . time() . "." . $image->getClientOriginalExtension();

            Image::make($image)->resize(484,441)->save(public_path('images/slider/'.$filename));
            $img_url ="images/slider/".$filename;
        }

        $slider->name       = $request->name;
        $slider->title      = $request->title;
        $slider->short_text = $request->short_text;
        $slider->image      = $img_url;
        $slider->updated_at = Carbon::now();
        $slider->update();

        Toastr::success('Slider update successfully!');
        return redirect()->route('slider.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $old    = $slider->image;

        if ($slider) {
            if (File::exists($old)) {
                File::delete($old);
        }
            $slider->delete();
            Toastr::error('Slider delete successfully!');
            return back();
        }
    }

    //============== slider active =========

    public function Active($id)
    {
        Slider::findOrFail($id)->update(['status' => 1]);
        Toastr::success('Slider Active successfully!');
        return back();
    }

    //============== slider inactive =========

    public function Inactive($id)
    {
        Slider::findOrFail($id)->update(['status' => 0]);
        Toastr::error('Slider Inactive successfully!');
        return back();
    }

}
