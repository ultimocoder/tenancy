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
use App\Models\AddPayment;
use App\Models\PaymentHistory;
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
        $tenant = Tenant::where(['user_id' => Auth::user()->id])->first();
        $payment_histories = PaymentHistory::where(['tenant_id' => $tenant->id])->get();
        //dd($payment_histories->toArray());
        return view('tenant.payments.payment-history',compact('payment_histories'));
    }
    public function tenantPaymentMethod()
    {
        return view('tenant.payments.payment-method');
    }
    public function tenantAddPaymentMethod()
    {
        $tenant_info = Tenant::where(['user_id'=> Auth::user()->id])->first();              
        $user = User::where('id',$tenant_info->user_id)->first();  
        $countries = Country::get();         
        return view('tenant.payments.add-payment-method', compact('user','countries'));
    }

    public function tenantAddPayment(request $request)
    {      
      
        //  echo $request->stripeToken;
        //  dd($request->toArray());
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $tenant_info = Tenant::where(['user_id'=> Auth::user()->id])->first();              
        $user = User::where('id',$tenant_info->user_id)->first();       
        //$paymentcount=AddPayment::all()->count();
       
        $user->country= $request->country;
        $user->save();

        $user_country = Country::where('nicename', $user->country)->first();
      
        // $check_user = User::where(['email' => $request->email])->first();
        
        if($user->customer_id){
            $cus_id = $user->customer_id;
        }else{
             // customer create 
            $customer  = $stripe->customers->create([
                'name' => $user->first_name." ".$user->last_name,
                'email' => $user->email,
                'phone' => $user->phone,
                'address' => [
                    'line1' => $user->address,
                    'city' => $user->city,
                    'state' => $user->state,
                    'country' => $user_country->iso,
                    'postal_code' => $user->zipcode,
                ],
                'metadata' => ["name" => $user->username, 'role' => 'tenant', 'phone' => $user->phone , 'email' => $user->email],
            
            ]);
            $cus_id = $customer->id;
        }
           
        
        // dd($customer->id);
        // payment method create

        $request_country = Country::where('nicename', $request->country)->first();
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
                    'country'=> $request_country->iso,
                    'city' => $request->city,
                    'state' => $request->state, 
                    'line1' =>$request->address,
                    'line2' => '',
                    'postal_code' => $request->postal_code,
                ]          
            ])       
            ]);
            
           
          
        // attach payment methods
            $attach= $stripe->paymentMethods->attach(
                $payment->id,
                ['customer' => $cus_id]
            );

            if($request->primary == 'on')
            {
                $payments = AddPayment::where(['tenant_id'=> $tenant_info->id])->get();       
                foreach ($payments as $paym) {
                
                    $paym->primary = null; 
                    $paym->save();
                }
            }
           
            $user->customer_id= $cus_id;
            $user->save();
            if($request->primary == 'on')
            {
                 $customer = $stripe->customers->update(
                    $cus_id,
                    ['invoice_settings' => ['default_payment_method' => $payment->id],]
                  );
            }

            $addpayment = new AddPayment;
            $addpayment->tenant_id = $tenant_info->id;
            $addpayment->customer_id= $cus_id;
            $addpayment->payment_id = $payment->id;
            $addpayment->card_number = $request->card_number;
            $addpayment->card_month = $request->card_expiry_month;
            $addpayment->card_year = $request->card_expiry_year;
            $addpayment->security_code = $request->card_cvc;
            $addpayment->billing_zip_code = $request->zip_code;
            $addpayment->nickname = $request->nick_name;
            $addpayment->primary = $request->primary;
            $addpayment->created_at = now();
            $addpayment->updated_at= now();
            $addpayment->save();
            return redirect()->route('tenant.tenant-manage-payment-accounts')->with('message', 'Account Information add successfully.');
       
      
    }

    public function tenantManagePaymentAccounts()
    {
        $tenant_info = Tenant::where(['user_id'=> Auth::user()->id])->first();              
        $cardlist = AddPayment::where(['tenant_id'=> $tenant_info->id])->get();  
        return view('tenant.payments.manage-payment-accounts',compact('cardlist'));
    }
    

    public function tenantEditBankAccount($id)
    {
        $editbankaccount = AddPayment::where(['id'=> $id])->first();  
        $tenant_info = Tenant::where(['user_id'=> Auth::user()->id])->first();              
        $user = User::where('id',$tenant_info->user_id)->first();  
        $countries = Country::get(); 
        return view('tenant.payments.edit-bank-account',compact('editbankaccount','user','countries'));
    }

    public function tenantUpdateBankAccount(request $request){  
        
        $tenant_info = Tenant::where(['user_id'=> Auth::user()->id])->first();              
        $user = User::where('id',$tenant_info->user_id)->first();  
        $user->country= $request->country;
        $user->save();
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $accountinfo = AddPayment::where(['id'=> $request->id])->first();  
        // if($request->primary == 'on')
        // {
        //     $payments = AddPayment::where(['tenant_id'=> $accountinfo->tenant_id])->get();       
        //     foreach ($payments as $payment) {
              
        //         $payment->primary = null; 
        //         $payment->save();
        //     }
        // }           
        $payment = AddPayment::findOrFail($request->id);
          $stripePaymentMethod = $stripe->paymentMethods->update(
            $payment->payment_id, // Stripe payment method ID
            [
                'card' => [                    
                    'exp_month' => $request->card_expiry_month,
                    'exp_year' => $request->card_expiry_year,                    
                ],
            ]
        );       
        // dd($stripePaymentMethod->toarray());        Update local database payment details
        $payment->card_number = $request->card_number;
        $payment->card_month = $request->card_expiry_month;
        $payment->card_year = $request->card_expiry_year;
        $payment->security_code = $request->card_cvc;
        $payment->billing_zip_code = $request->zip_code;
        $payment->nickname = $request->nick_name;
        // $payment->primary = $request->primary;
        $payment->updated_at = now();
        $payment->save();
        return redirect()->route('tenant.tenant-manage-payment-accounts')->with('message', 'Account Information updated successfully.');      

    }
    
     
     
   
}
