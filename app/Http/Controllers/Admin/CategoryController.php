<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Category;
use Carbon\Carbon;
class CategoryController extends Controller
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
        $categories = Category::latest()->get();
        return view('admin.Category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->created_at = Carbon::now();
        $category->save();

        Toastr::success('Category added successfully!');
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
       $category = Category::findOrFail($id);
       return view('admin.category.edit', compact('category')); 
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
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->updated_at = Carbon::now();
        $category->update();

        Toastr::success('Category update successfully!');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        Toastr::error('Category delete successfully!');
        return back();
    }


    //============== category active =========

    public function Active($id)
    {
        Category::findOrFail($id)->update(['status' => 1]);
        Toastr::success('Category Active successfully!');
        return back();
    }

    //============== category inactive =========

    public function Inactive($id)
    {
        Category::findOrFail($id)->update(['status' => 0]);
        Toastr::error('Category Inactive successfully!');
        return back();
    }
}
