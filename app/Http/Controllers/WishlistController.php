<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Wishlist;
use Auth;
class WishlistController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Addwishlist($id)
    {
        if (Auth::check()) {
            $check = Wishlist::where('user_id', Auth::id())->where('product_id', $id)->first();
            if ($check) {
                Toastr::error('Already You added this product on Wishlist');
                return back();
            }else{
                $data = new Wishlist;
                $data->user_id = Auth::id();
                $data->product_id = $id;
                $data->qnty = 1;
                $data->save();

                Toastr::success('Wishlist added successfully');
                return back();
            }

        }else{
            Toastr::error('Login first');
            return redirect()->route('login');
        }
    }

    public function showWishlist(){
        $wishlists = Wishlist::where('user_id', Auth::id())->latest()->get();
        return view('pages.wishlist', compact('wishlists'));
    }

    public function destroyWishlist($id)
    {
        wishlist::findOrFail($id)->delete();
        Toastr::error('Wishlist delete successfully');
        return back();
    }
    
}
