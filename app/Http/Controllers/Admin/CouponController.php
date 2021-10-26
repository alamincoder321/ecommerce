<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Coupon;
use Carbon\Carbon;
class CouponController extends Controller
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
        $coupons = Coupon::latest()->get();
        return view('admin.coupon.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupon.create');
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
            'discount'  => 'required',
        ]);

        $coupon = new Coupon;
        $coupon->name = strtoupper($request->name);
        $coupon->discount = $request->discount;
        $coupon->created_at = Carbon::now();
        $coupon->save();

        Toastr::success('Coupon added successfully!');
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
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon.edit', compact('coupon'));
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
            'discount'  => 'required',
        ]);

        $coupon = Coupon::findOrFail($id);
        $coupon->name = strtoupper($request->name);
        $coupon->discount = $request->discount;
        $coupon->updated_at = Carbon::now();
        $coupon->update();

        Toastr::success('Coupon update successfully!');
        return redirect()->route('coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Coupon::findOrFail($id)->delete();
        Toastr::error('Coupon delete successfully!');
        return back();
    }

    //============== coupon active =========

    public function Active($id)
    {
        Coupon::findOrFail($id)->update(['status' => 1]);
        Toastr::success('Coupon Active successfully!');
        return back();
    }

    //============== coupon inactive =========

    public function Inactive($id)
    {
        Coupon::findOrFail($id)->update(['status' => 0]);
        Toastr::error('Coupon Inactive successfully!');
        return back();
    }
}
