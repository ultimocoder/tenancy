<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //return view('fronts.index');
        $landlord = 'landlord';

        $user = Auth::user();
        
        if($user->role == $landlord){
            return view('landlord.dashboard');
        }
        //for admin only
        Auth::logout();
        return redirect()->route('login');
        //return view('home');
    }
    public function tenantInformation(){
        return view('landlord.tenant-information');
    }
    
}
