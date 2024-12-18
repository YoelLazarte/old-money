<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        return view('home');
    }

    public function products(){
        return view('products');
    }

    public function blog(){
        return view('blog');
    }

    public function closeSession(){
        return view('closeSession');
    }
}
