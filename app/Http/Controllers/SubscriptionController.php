<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\PackagePrice;
use App\Models\Subscription;
use App\Models\SubscriptionItem;
use App\Models\User;
use App\Models\AccountId;
use stripe;
use Session;
use Stripe\Token;
use Carbon\Carbon;

class SubscriptionController extends Controller
{   
    // private function generateAccountId($phone) {
    //     // Get current timestamp (milliseconds)
    //         //return $phone;
    //         // Get current timestamp (milliseconds)
    //         $timestamp = microtime(true) * 10000;
        
    //         // Generate random number to fill remaining digits
    //         $random_number = mt_rand(100000000, 999999999);
        
    //         // Concatenate timestamp and random number and phone number
    //         $account_id =date('dmy') . $random_number. substr($phone,6);
        
    //         // Truncate to 17 digits
    //         $account_id = substr($account_id, 0, 17);
        
    //         return $account_id;
    // }
    
    private function generateAccountId()
    {
        $accountIdRecord = AccountId::firstOrCreate([]);

        $accountId = str_pad($accountIdRecord->current_landlord_id, 17, '0', STR_PAD_LEFT);

        $accountIdRecord->increment('current_landlord_id');

        return $acnumber_of_security_depositId;
    }
    
    public function index(request $request){
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        /*check and delete the unpaid subscription customer */
        
        $user = User::where(['email' => $request->email, 'status' => false])->first();
        
        if($user){
           $deleteCustomer = $stripe->customers->delete($user->customer_id, []);
           $user->delete();
        }
        /*check and delete the unpaid subscription customer end*/
        $validated = $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'address' => 'required',
            'zip_code' => 'required',
            // 'card_number' => 'required',
            // 'exp_month' => 'required',
            // 'exp_year' => 'required',
            // 'security_code' => 'required',
            // 'billing_zip_code' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required'
            
        ]);
    
        //dd($request->toArray());

        /* customer in stripe account start */
        // $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        
        $customer  = $stripe->customers->create([
            'name' => $request->first_name." ".$request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => [
                'line1' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'postal_code' => $request->billing_zip_code,
            ],
            'metadata' => ["name" => $request->username, 'role' => 'customer', 'phone' => $request->phone , 'email' => $request->email],
            //'source' => $request->stripeToken
        
        ]);
        /* customer in stripe account end *
        
        // dd($customer->toArray());
        
        /* customer in db start */
        if($customer){
            $user = new User;
            $user->customer_id = $customer->id;
            $user->role = 'landlord';
            $user->username =  $request->username;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->status = 0;
            $user->address = $request->address;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->country = $request->country;
            $user->zipcode = $request->zip_code;
            $user->unique_id = $this->generateAccountId($request->phone);
            //$user->stripe_id = $token;

            $user->save();
        }
        /* customer in db end */

       
        
        // $subscription = $stripe->subscriptions->create([
        //     'customer' => $user->customer_id,
        //     'items' => [
        //         [
        //             'price' => 'price_1OmqPiSGWHKGovf6pr0CsyEx'
        //         ]
        //     ],
            
        // ]);
        
        $package = PackagePrice::where(['package_id' => $request->package_id, 'status' => true , 'schedule_type' => $request->schedule])->first();
        
        /* set session variables */
        session(['unit' => $request->unit]);
        session(['schedule' => $request->schedule]);
        session(['price_id' => $package->price_id]);
        /* set session variables end*/

        //dd($subscription->toArray());
        $YOUR_DOMAIN = 'http://127.0.0.1:8000/';
        $redirectUrl = route('stripe.checkout.success').'?session_id={CHECKOUT_SESSION_ID}';
        if($request->unit > 2){
            $res = $stripe->checkout->sessions->create([
                'line_items' => [
                  [
                    'price' => $package->price_id,
                    'quantity' => $request->unit,
                  ],
                ],
                'mode' => 'subscription',
                'discounts' => [[
                    'coupon' => 'Sbj1bqJF',
                ]],
                'customer'=> $customer->id,
                //'success_url' => 'http://127.0.0.1:8000/success',
                'success_url' => $redirectUrl,
                'cancel_url' => 'http://127.0.0.1:8000/cancel',
              ]);
        }else{
            $res = $stripe->checkout->sessions->create([
                'line_items' => [
                  [
                    'price' => $package->price_id,
                    'quantity' => $request->unit,
                  ],
                ],
                'mode' => 'subscription',
                // 'discounts' => [[
                //     'coupon' => 'Sbj1bqJF',
                // ]],
                'customer'=> $customer->id,
                //'success_url' => 'http://127.0.0.1:8000/success',
                'success_url' => $redirectUrl,
                'cancel_url' => 'http://127.0.0.1:8000/cancel',
              ]);
        }
          return redirect($res['url']);
        //dd($res->toARray());
    }

    public function stripeCheckoutSuccess(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
  
        $session = $stripe->checkout->sessions->retrieve($request->session_id);
        $customer = $stripe->customers->retrieve($session->customer);

        //dd($session->toArray());
        if($session->status == 'complete'){
            $paymentData = $stripe->customers->allPaymentMethods($customer->id, ['limit' => 1]);
            $payment = $paymentData->toArray();
            $payment_id = $payment['data'][0]['id'];
            $card_type = $payment['data'][0]['type'];
            $card_info = $payment['data'][0]['card'];
            $card_brand = $card_info['brand'];

        } 
        if($customer){
            $customerDetail = User::where('customer_id', $customer->id)->first();
            //dd($customerDetail->toARray());
            if($customerDetail){
                $customerDetail->status = true;
                $customerDetail->pm_type =  $card_type;
                $customerDetail->card_detail = json_encode($card_info);
                $customerDetail->pm_id = $payment_id;
                $customerDetail->pm_type = $card_type;
                $customerDetail->save();
            }

        }
         if($session){
           $subscription = new Subscription;
           $subscription->user_id = $customerDetail->id;
           $subscription->type = 'subscription';
           $subscription->session_id = $session->id;
           $subscription->subscription_id = $session->subscription; 
           $subscription->stripe_status = $session->status;
           $subscription->amount = $session->amount_total/100;
           $subscription->subtotal = $session->amount_subtotal/100;
           $subscription->stripe_price = session('price_id');
           $subscription->quantity = session('unit');
           $subscription->trial_ends_at = Carbon::now()->lastOfMonth();
           $subscription->save();
         }
        
        
       
        /* session forget */ 
        session()->forget('schedule');
        session()->forget('price_id');
        session()->forget('unit');
        /* session forget end*/
        // info($session);
  
        return redirect()->route('success')
                         ->with('success', 'Payment successful.');
    }

    public function success(){
        return view('payment.success');
    }
}
