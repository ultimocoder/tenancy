<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;

class TenantLoginController extends Controller
{

    public function tenantloginpost(request $request){  
          
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        // dd($credentials);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if(Auth::user()->role == 'tenant'){
                $user_id = Auth::user()->id;
                $user = User::where('id', $user_id)->first();         
                Session::put('userdetsils', $user);
                return redirect()->intended('tenant/tenant-info')->withSuccess('Youh have Successfully loggedin');
            } 
        }
            return back()->withErrors([
                'username' => ' invalid username',
                'password' => ' invalid password',
        ]);
    }

    public function tenantdashboard()
    {
        if(Auth::check()){
            return view('admin/tenant_dashboard');
        }
       return redirect("tenant/login")->withSuccess('Opps! You do not have access');
    }

    public function tenantlogout(){   
        Auth::logout();
        return redirect('tenant/login');
    }  
}
