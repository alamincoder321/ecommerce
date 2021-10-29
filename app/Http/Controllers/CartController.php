<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Cart;
use App\Models\Coupon;
use Carbon\Carbon;
use Session;
class CartController extends Controller
{
    public function Addcart(Request $request, $id)
    {
        $check = Cart::where('product_id', $id)->where('user_ip', request()->ip())->first();

        if ($check) {
            Cart::where('product_id', $id)->where('user_ip', request()->ip())->increment('qnty');

            Toastr::success('Cart Product added successfully!');
            return back();
        }else{
            $cart = new Cart;
            $cart->product_id = $id;
            $cart->qnty       = 1;
            $cart->user_ip    = request()->ip();
            $cart->created_at = Carbon::now();
            $cart->save();

            Toastr::success('Cart Product added successfully!');
            return back();
        }
    }

    public function showCart()
    {
        $carts = Cart::where('user_ip', request()->ip())->latest()->get();
        $total = Cart::all()->where('user_ip', request()->ip())->sum(
            function($t){
                return $t->qnty * $t->product->price;
            }
        );
        return view('pages.cart', compact('carts', 'total'));
    }

    public function destroyCart($id)
    {
        Cart::where('id', $id)->where('user_ip', request()->ip())->delete();

        Toastr::error('Cart Product delete successfully!');
        return back();
    }

    public function Updatecart(Request $request, $id)
    {
        Cart::where('id', $id)->where('user_ip', request()->ip())->update(['qnty' => $request->qnty]);

        Toastr::success('Cart Product update successfully!');
        return back();
    }


    //========================= Coupon Apply ==================

    public function Applycoupon(Request $request)
    {
        $check = Coupon::where('name', $request->name)->first();

        if ($check) {
            Session::put('coupon', [
                'name' => $check->name,
                'discount' => $check->discount,
            ]);

            Toastr::success('Coupon Apply successfully!');
            return back();
        }else{
            Toastr::error('No Any Coupon on Your Cart!');
            return back();
        }
    }

    public function delete()
    {
        if (Session::has('coupon')) {
            Session::forget('coupon');

            Toastr::error('Coupon delete successfully!');
            return back();
        }
    }
}
