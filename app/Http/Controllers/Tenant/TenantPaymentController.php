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
        $paymentcount=AddPayment::all()->count();
  
        $user_country = Country::where('nicename', $user->country)->first();
      
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
                ['customer' => $customer->id]
            );
            if($request->primary == 'on')
            {
                $tenant = AddPayment::where(['tenant_id'=> $tenant_info->id])->first();       
                $tenant->primary = 'NULL';      
                $tenant->save();
            }
            $addpayment = new AddPayment;
            $addpayment->tenant_id = $tenant_info->id;
            $addpayment->customer_id = $customer->id;
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
        return view('tenant.payments.edit-bank-account',compact('editbankaccount','user'));
    }

    public function tenantUpdateBankAccount(request $request){   

        $accountinfo = AddPayment::where(['id'=> $request->id])->first();  
        if($request->primary == 'on')
        {
            $payments = AddPayment::where(['tenant_id'=> $accountinfo->tenant_id])->get();       
            foreach ($payments as $payment) {
              
                $payment->primary = null; 
                $payment->save();
            }
        }
        $account = AddPayment::where(['id'=> $request->id])->first();       
        $account->card_number = $request->card_number;
        $account->card_month = $request->card_expiry_month;
        $account->card_year = $request->card_expiry_year;
        $account->security_code = $request->card_cvc;
        $account->billing_zip_code = $request->zip_code;
        $account->nickname = $request->nick_name;
        $account->primary = $request->primary;
        $account->updated_at= now();          
        $account->save();
        return redirect()->route('tenant.tenant-manage-payment-accounts')->with('message', 'Account Information updated successfully.');      

    }
     
     
   
}
