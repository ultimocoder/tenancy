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
 
}
