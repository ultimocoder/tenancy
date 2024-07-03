<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Country;

class SignUpController extends Controller
{
    public function userSignUp($unit ,$id){
        $package = Package::where('id', $id)->first();
        $countries = Country::get();
        //dd($package->toArray());
        $unit = $unit;
        return view('front.user_sign_up',compact('package','unit','countries'));
    }
}
