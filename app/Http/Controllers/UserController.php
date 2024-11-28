<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function users(){
        $users = User::paginate(10);

        return view('products.users', [
            'users' => $users
        ]);
    }
}
