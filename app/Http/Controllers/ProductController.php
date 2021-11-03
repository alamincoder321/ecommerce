<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
class ProductController extends Controller
{

    public function index()
    {
        $brands = Brand::where('status', 1)->latest()->get();
        $categories = Category::where('status', 1)->latest()->get();
        $products = Product::latest()->get();
        return view('pages.product', compact('products', 'brands', 'categories'));
    }
}
