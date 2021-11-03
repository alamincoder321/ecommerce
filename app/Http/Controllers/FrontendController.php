<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
class FrontendController extends Controller
{
    public function index(){
        $sliders = Slider::where('status', 1)->limit(3)->latest()->get();
        $brands = Brand::where('status', 1)->latest()->get();
        $categories = Category::where('status', 1)->latest()->get();
        $products = Product::where('status', 1)->limit(6)->latest()->get();

        return view('pages.home', compact('sliders', 'brands', 'categories', 'products'));
    }
}
