<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        // mengambil kategori unik dari database
        $categories = Product::select('category')
            ->distinct()
            ->pluck('category');

        return view('home', compact('products', 'categories'));
    }
}
