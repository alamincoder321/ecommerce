<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
class ProductController extends Controller
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
        $products = Product::latest()->get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
        $brands     = Brand::latest()->get();
        return view('admin.product.create', compact('categories', 'brands'));
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
            'brand_id'      => 'required',
            'category_id'   => 'required',
            'name'          => 'required',
            'qnty'          => 'required',
            'price'         => 'required',
            'image'         => 'required|mimes:png,jpg,jpeg',
        ],[
            'category_id.required'  => 'Select Category name',
            'brand_id.required'     => 'Select Brand name',
        ]);

        if($request->hasFile('image')) {

            $image = $request->file('image');
            $filename = uniqid() . "-" . time() . "." . $image->getClientOriginalExtension();

            Image::make($image)->resize(484,441)->save(public_path('images/product/'.$filename));
            $img_url ="images/product/".$filename;
        }

        $product = new Product;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->qnty = $request->qnty;
        $product->price = $request->price;
        $product->image = $img_url;
        $product->created_at = Carbon::now();
        $product->save();

        Toastr::success('Product added successfully!');
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
        $product    = Product::findOrFail($id);
        $categories = Category::latest()->get();
        $brands     = Brand::latest()->get();
        return view('admin.product.edit', compact( 'product', 'categories', 'brands'));
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
            'brand_id'      => 'required',
            'category_id'   => 'required',
            'name'          => 'required',
            'qnty'          => 'required',
            'price'         => 'required',
            'image'         => 'required|mimes:png,jpg,jpeg',
        ],[
            'category_id.required'  => 'Select Category name',
            'brand_id.required'     => 'Select Brand name',
        ]);

        $product = Product::findOrFail($id);
        $old     = $request->image1;
        if($request->hasFile('image')) {
            if(File::exists($old)){
                File::delete($old);
            }

            $image = $request->file('image');
            $filename = uniqid() . "-" . time() . "." . $image->getClientOriginalExtension();

            Image::make($image)->resize(484,441)->save(public_path('images/product/'.$filename));
            $img_url ="images/product/".$filename;
        }

        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->qnty = $request->qnty;
        $product->price = $request->price;
        $product->image = $img_url;
        $product->updated_at = Carbon::now();
        $product->update();  

        Toastr::success('Product update successfully!');
        return redirect()->route('product.index');      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $old     = $product->image;

        if($product){
             if (File::exists($old)) {
                File::delete($old);
        }
            $product->delete();
            Toastr::error('Product delete successfully!');
            return back();
        }
    }

    //============== product active =========

    public function Active($id)
    {
        Product::findOrFail($id)->update(['status' => 1]);
        Toastr::success('Product Active successfully!');
        return back();
    }

    //============== product inactive =========

    public function Inactive($id)
    {
        Product::findOrFail($id)->update(['status' => 0]);
        Toastr::error('Product Inactive successfully!');
        return back();
    }
}
