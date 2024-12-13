<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function updateRole(Request $request, $id)
{
    $request->validate([
        'role' => 'required|string|in:admin,user',
    ]);

    $user = User::findOrFail($id);

    $role = $request->input('role');

    $user->role = $role;
    $user->save();

    return redirect()->back()
        ->with('feedback.message', 'Rol actualizado correctamente a ' . $role)
        ->with('feedback.color', 'blue');
}

}
