<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\PropertyUnit;
use App\Models\PropertyType;
use App\Models\Property;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Subscription;
use App\Models\SubscriptionHistory;
use App\Models\PackagePrice;
use App\Models\Package;
use App\Models\Country;
use auth;
use stripe;
Use \Carbon\Carbon;
 
class TenantAccountController extends Controller
{
    public function profile(){
        return view('tenant.account_and_security.profile');
    }

    public function profileEdit(){
        $countries =  Country::get();
         return view('tenant.account_and_security.profile-edit', compact('countries'));
 
     }

     public function profileUpdate(request $request){
        $user = Auth::User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->zipcode = $request->zipcode;
        if($files = $request->file('file')) {
            $fileName = $request->file('file')->getClientOriginalName();
            $request->file->move(public_path('tenants/profile'), $fileName);
    
            if($fileName){
                $user->image = $fileName;
            }
        }
        $user->save();
        //dd($request->toArray());
        return redirect()->route('tenant.profile')->with('message', 'Profile updated successfully.');

    }

    public function account(){
        return view('tenant.account_and_security.account');
    }

    public function accountPasswordChange(){
        return view('tenant.account_and_security.password-change');
    }
    public function accountPasswordSave(request $request){
        $request->validate([
            'new_password' => 'required|min:8',
            'new_confirm_password' => 'required|same:new_password',
        ]);
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect()->route('tenant.account.security')->with('message', 'Password changed successfully.');
    }
    public function accountUsernameChange(){
        return view('tenant.account_and_security.username-change');
    }
    public function accountUsernameSave(request $request){
        $request->validate([
            'username' => 'required|unique:users',
        ]);
        $user = Auth::user();
        $user->username = $request->username;
        $user->save();
        return redirect()->route('tenant.account.security')->with('message', 'Username changed successfully.');
    }
 
}
