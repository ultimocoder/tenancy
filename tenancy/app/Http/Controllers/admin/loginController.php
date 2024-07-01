<?php

namespace App\Http\Controllers\admin;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;
// use Session;
class logincontroller extends Controller
{
    public function loginpost(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
             'password' => ['required'],
        ]);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
   if(Auth::user()->role == 'admin'){
            return redirect()->intended('admin-dashboard')->withSuccess('Youh have Successfully loggedin');
        }
    }
        return back()->withErrors([
            'username' => ' invalid username',
            'password' => ' invalid password',
        ]);
       }  
    
    public function dashboard()
    {
        if(Auth::check()){
            return view('admin/dashboard');
        }
       return redirect("admin-login")->withSuccess('Opps! You do not have access');
    }
    public function logout(){
        Auth::logout();
        return redirect('admin-login');
    }   
    public function admin_profile()
    {
        $user = Auth::user();
       $id = $user->id;
       $admin = User::where('id', $id)->first();

        return view('admin/adminprofile', compact('admin'));
    }
}
