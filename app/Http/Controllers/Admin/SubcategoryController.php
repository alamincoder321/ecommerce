<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Subcategory;
use App\Models\Category;
use Carbon\Carbon;
class SubcategoryController extends Controller
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
        $subcategories = Subcategory::latest()->get();
        return view('admin.subcategory.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('admin.subcategory.create', compact('categories'));
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
            'category_id' => 'required',
            'name'        => 'required',
        ],[
            'category_id.required' => 'Category name required',
        ]);

        $subcategory = new Subcategory;
        $subcategory->category_id = $request->category_id;
        $subcategory->name        = $request->name;
        $subcategory->created_at  = Carbon::now();
        $subcategory->save();

        Toastr::success('Subcategory added successfully!');
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
        $subcategory = Subcategory::findOrFail($id); 
        $categories  = Category::latest()->get();
        return view('admin.subcategory.edit', compact('categories', 'subcategory')); 
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
            'category_id' => 'required',
            'name'        => 'required',
        ],[
            'category_id.required' => 'Category name required',
        ]);

        $subcategory = Subcategory::findOrFail($id);
        $subcategory->category_id = $request->category_id;
        $subcategory->name        = $request->name;
        $subcategory->updated_at  = Carbon::now();
        $subcategory->update();

        Toastr::success('Subcategory update successfully!');
        return redirect()->route('subcategory.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Subcategory::findOrFail($id)->delete();
        Toastr::error('Subcategory delete successfully!');
        return back();
    }


    //============== subcategory active =========

    public function Active($id)
    {
        Subcategory::findOrFail($id)->update(['status' => 1]);
        Toastr::success('Subcategory Active successfully!');
        return back();
    }

    //============== subcategory inactive =========

    public function Inactive($id)
    {
        Subcategory::findOrFail($id)->update(['status' => 0]);
        Toastr::error('Subcategory Inactive successfully!');
        return back();
    }
}
