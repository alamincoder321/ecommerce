<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Cart;
use Carbon\Carbon;
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
        $carts = Cart::all()->where('user_ip', request()->ip());
        $total = Cart::all()->where('user_ip', request()->ip())->sum(
            function($t){
                return $t->qnty * $t->product->price;
            }
        );
        return view('pages.cart', compact('carts', 'total'));
    }

    public function destroyCart($id)
    {
        Cart::findOrFail($id)->delete();

        Toastr::error('Cart Product delete successfully!');
        return back();
    }
}
