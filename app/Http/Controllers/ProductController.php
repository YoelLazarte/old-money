<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        $allProducts = Product::all();
        return view('products.index', [
            'products' => $allProducts
        ]);
    }

    public function view(int $id){
        return view('products.view', [
            'product' => Product::findOrFail($id)
        ]);
    }
}