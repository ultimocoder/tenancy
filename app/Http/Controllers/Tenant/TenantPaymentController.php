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
use Session;
use stripe;
Use \Carbon\Carbon;

class TenantPaymentController extends Controller
{
    public function tenantMakePayment()
    {
        $tenant_info = Tenant::where(['user_id'=> Auth::user()->id])->first();
        return view('tenant.payments.make-payment', compact('tenant_info'));
    }
   
    public function tenantPaymentReview()
    {
        $tenant_info = Tenant::where(['user_id'=> Auth::user()->id])->first();
        return view('tenant.payments.payment-review', compact('tenant_info'));
    }
    public function tenantPaymentHistory()
    {
        return view('tenant.payments.payment-history');
    }
    public function tenantPaymentMethod()
    {
        return view('tenant.payments.payment-method');
    }
    public function tenantAddPaymentMethod()
    {
        $tenant_info = Tenant::where(['user_id'=> Auth::user()->id])->first();              
        $user = User::where('id',$tenant_info->user_id)->first();      
        
        return view('tenant.payments.add-payment-method', compact('user'));
    }

    public function tenantAddPayment(request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $tenant_info = Tenant::where(['user_id'=> Auth::user()->id])->first();              
        $user = User::where('id',$tenant_info->user_id)->first();       
       
        // $customer  = $stripe->customers->create([
        //     'name' => $user->first_name." ".$user->last_name,
        //     'email' => $user->email,
        //     'phone' => $user->phone,
        //     'address' => [
        //         'line1' => $user->address,
        //         'city' => $user->city,
        //         'state' => $user->state,
        //         'country' => $user->country,
        //         'postal_code' => $user->zipcode,
        //     ],
        //     'metadata' => ["name" => $user->username, 'role' => 'tenant', 'phone' => $user->phone , 'email' => $user->email],
        
        // ]);
       
      // dd($request->stripeToken);
       $payment =  $stripe->paymentMethods->create([
        'type' => 'card',
            'card' => [
             'token' =>$request->stripeToken,
            ],
           'billing_details'=> ([
           'name' => $user->first_name." ".$user->last_name,
           'email' => $user->email,
           'phone' => $user->phone,
            'address'=> [
              'country'=> $request->country,
              'city' => $request->city,
              'state' => $request->state, 
              'line1' =>$request->address,
              'line2' => '',
              'postal_code' => $request->postal_code,
            ]
          
           ])
               
            
       
        ]);
       echo "<pre>";
       print_r($payment);die;
      
    
     
       
    }
    
     
    
   
}
