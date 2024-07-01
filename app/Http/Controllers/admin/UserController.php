<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function index()
    {
        $user = User::all()->where('role', 'landlord');
        return view('admin/User/userlisting', compact('user'));
    }
    public function view_user($id)
    {
        $user = User::where('id', $id)->first();
        // dd($user);
        return view('admin/User/userview', compact('user'));
    }
}
