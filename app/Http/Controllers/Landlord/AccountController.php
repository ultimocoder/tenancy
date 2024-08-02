<?php

namespace App\Http\Controllers\Landlord;

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
use Session;
Use \Carbon\Carbon;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile(){
        return view('landlord.account_and_security.profile');
    }

    public function profileEdit(){
       $countries =  Country::get();
        return view('landlord.account_and_security.profile-edit', compact('countries'));

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
            $request->file->move(public_path('landlord/profile'), $fileName);
    
            if($fileName){
                $user->image = $fileName;
            }
        }
        $user->save();
        //dd($request->toArray());
        return redirect()->route('landlord.profile')->with('message', 'Profile updated successfully.');

    }

    public function account(){
        return view('landlord.account_and_security.account');
    }

    public function accountPasswordChange(){
        return view('landlord.account_and_security.password-change');
    }
    public function accountPasswordSave(request $request){
        $request->validate([
            'new_password' => 'required|min:8',
            'new_confirm_password' => 'required|same:new_password',
        ]);
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect()->route('landlord.account.security')->with('message', 'Password changed successfully.');
    }

    public function accountUsernameChange(){
        return view('landlord.account_and_security.username-change');
    }

    public function accountUsernameSave(request $request){
        $request->validate([
            'username' => 'required|unique:users',
        ]);
        $user = Auth::user();
        $user->username = $request->username;
        $user->save();
        return redirect()->route('landlord.account.security')->with('message', 'Username changed successfully.');
    }

    public function billing(){
        return view('landlord.billing-account.billing');
    }

    public function invoiceList(){
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        //$list = $stripe->invoices->all(['customer'=> Auth::user()->customer_id,'limit' => 3]);
        $list = $stripe->invoices->all(['customer'=> Auth::user()->customer_id]);
        $invoices = $list['data'];
        
        
        //echo date('Y-M-d',$abc[0]->created);
        //dd($invoices);
        //dd($list->toArray());
        return view('landlord.billing-account.invoice_list',compact('invoices'));
    }

    public function invoiceById($id){
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $subscription= Subscription::where(['user_id' => Auth::user()->id])->first();
        if($subscription){
          $package = PackagePrice::where(['price_id'=> $subscription->stripe_price])->first();
        }
        $invoice = $stripe->invoices->retrieve($id, []);
        $data = $stripe->customers->retrievePaymentMethod(
            Auth::user()->customer_id,
            Auth::user()->pm_id,
            []
          );
          
        //dd($package->toArray());  
        //echo $invoice['total_discount_amounts']['0']['amount'];
        //echo date('Y-m-d',$invoice->period_end);
        if($package->schedule_type == 'monthly'){
            $start_date = date('Y-m-d',$invoice->period_end);

            $initialDate = strtotime($start_date);

            // Calculate the next due date
            $nextDueDate = date('l, F d, Y', strtotime('+1 month', $initialDate));
        }
        else{
            $start_date = date('Y-m-d',$invoice->period_end);

            $initialDate = strtotime($start_date);

            // Calculate the next due date
            $nextDueDate = date('l, F d, Y', strtotime('+1 year', $initialDate));
        }
        $packageList = PackagePrice::where(['status'=>true])->get();
        //dd($packageList->toArray());
        // Output the result
        //echo "Next due date: $nextDueDate";
        if(count($invoice['lines']['data']) > 1){
            $plan = $invoice['lines']['data'][1]['plan'];
        }else{
            $plan = $invoice['lines']['data'][0]['plan'];
        }
        // echo $plan->id;
        // dd($plan);   
        //dd($invoice['lines']['data'][0]['quantity']);
        //dd($invoice->toArray());
        return view('landlord.billing-account.invoice',compact('invoice','data','subscription','package','nextDueDate','packageList','plan'));
    }

    public function paymentInfo(){
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        //$paymentData = $stripe->accounts->retrieve('Auth::user()->customer_id', []);
        $data = $stripe->customers->retrievePaymentMethod(
            Auth::user()->customer_id,
            Auth::user()->pm_id,
            []
          );
        //dd($data->toArray());
        return view('landlord.billing-account.payment_info',compact('data'));
    }

    public function paymentInfoSave(request $request){
        //dd($request->toArray());
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        
        $all = $stripe->customers->allPaymentMethods(Auth::user()->customer_id);
        $countries = Country::get(); 
        //pm_1POfezSGWHKGovf6w2TgDnkj
        
        return view('landlord.billing-account.card',compact('request','countries'));
    }

    public function add(){
        return view('landlord.billing-account.card');
    }

    public function paymentEdit(){
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        //$paymentData = $stripe->accounts->retrieve('Auth::user()->customer_id', []);
        $customer = $stripe->customers->retrieve(Auth::user()->customer_id, []);
        //dd($customer->toARray());
        $data = $stripe->customers->retrievePaymentMethod(
            Auth::user()->customer_id,
            Auth::user()->pm_id,
            []
          );

          
        // $pm_data =  $stripe->paymentMethods->create([
        //     'type' => 'card',
        //     'card' => [
        //       'number' => '4242 4242 4242 4242',
        //       'exp_month' => 8,
        //       'exp_year' => 2026,
        //       'cvc' => '314',
        //     ],
        //   ]);
        
        //  dd($pm_data);

        //   $stripe->paymentMethods->attach(
        //     'pm_1MqM05LkdIwHu7ixlDxxO6Mc',
        //     ['customer' => Auth::user()->customer_id]
        //   );
        //$stripe->paymentMethods->detach(Auth::user()->pm_id, []);
        //$payment = $stripe->customers->allPaymentMethods(Auth::user()->customer_id, []);
        $countries = Country::get();  
        //dd($data->toArray());
        return view('landlord.billing-account.payment_edit',compact('data','countries'));
    }

    public function stripePost(Request $request)
    {   
        dd($request->toArray());
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $customer = $stripe->customers->retrieve(Auth::user()->customer_id, []);
        // dd($customer->toArray());

        $new = $stripe->paymentMethods->create([
            'type' => 'card',
            'card' => [
             'token' =>$request->stripeToken,
            ],
            'billing_details' => [
                'address' => [
                    'line1' =>$request->address,
                    'line2' => '',
                    'city' => $request->city,
                    'state' => $request->state,
                    'postal_code' => $request->postal_code,
                    'country' => $request->country,
                ],
            ],
          ]);

        //   echo $new->id;
        //   dd($new->toArray());
            $detach= $stripe->paymentMethods->detach(
                Auth::user()->pm_id,
            );
           $attach= $stripe->paymentMethods->attach(
                $new->id,
                ['customer' => Auth::user()->customer_id]
            );

            
            //dd($all->toArray());
            $country = Country::where('iso', $request->country)->first();

            $user = User::where(['id' => Auth::user()->id])->first();  
            $user->pm_id = $new->id;
            $user->address = $request->address;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->country = $country->nicename;
            $user->zipcode = $request->postal_code;
            $user->card_detail = json_encode($new->card);
            $user->save();


        // $card = $stripe->tokens->retrieve($request->stripeToken, []);
        // echo $card['card']['id'];
        // echo $card->id;
         
            $cust= $stripe->customers->update(
                Auth::user()->customer_id,
                ['invoice_settings' => ['default_payment_method' => $new->id],]
              );    

          //dd($cust->toArray());
        return redirect()->route('landlord.account.payment.info')->with('message', 'Card Updated successfully');
         
        // $card = $stripe->tokens->retrieve($request->stripeToken, []);
        // echo $card['card']['id'];
        // echo $card->id;

        // $user = User::where("id", Auth::user()->id)->first();
        // $user->pm_id = $card['card']['id'];
        // $user->save();

        

        // dd($cust->toARray());
    
    }

    public function subscription(){
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $subscription= Subscription::where(['user_id' => Auth::user()->id, 'current_status' => 'active'])->first();
        if($subscription){
            $package = PackagePrice::where(['price_id'=> $subscription->stripe_price])->first();
            $sub = $stripe->subscriptions->retrieve($subscription->subscription_id, []);
            $nextDueDate = date('M d, Y',$sub->current_period_end);
        }else{
            $subscription= Subscription::where(['user_id' => Auth::user()->id])->first();
            $package = PackagePrice::where(['price_id'=> $subscription->stripe_price])->first();
            $sub = $stripe->subscriptions->retrieve($subscription->subscription_id, []);
            $nextDueDate = date('M d, Y',$sub->current_period_end);
        }
        

        //dd($sub->toArray());
       // dd($subscription->toArray());
        return view('landlord.billing-account.subscription', compact('package','nextDueDate','sub', 'subscription'));
    }

    public function subscriptionInfo($subscriptionId){
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $subscription= Subscription::where(['user_id' => Auth::user()->id, 'current_status' => 'active'])->first();
        if($subscription){
            $package = PackagePrice::where(['price_id'=> $subscription->stripe_price])->first();
            $sub = $stripe->subscriptions->retrieve($subscription->subscription_id, []);
            $nextDueDate = date('M d, Y',$sub->current_period_end);
          }else{
            $subscription= Subscription::where(['user_id' => Auth::user()->id])->first();
            $package = PackagePrice::where(['price_id'=> $subscription->stripe_price])->first();
            $sub = $stripe->subscriptions->retrieve($subscription->subscription_id, []);
            $nextDueDate = date('M d, Y',$sub->current_period_end);
        }
          
          //dd($sub->toArray());

          $data = $stripe->customers->retrievePaymentMethod(
            Auth::user()->customer_id,
            Auth::user()->pm_id,
            []
          );
        
        return view('landlord.billing-account.subscription_info',compact('package','sub','nextDueDate','subscription','data'));

    }

    public function changePlan(){
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $packageLists = Package::where('status', true)->get();
        $subscription= Subscription::where(['user_id' => Auth::user()->id, 'current_status' => 'active'])->first();
        if($subscription){
            $package = PackagePrice::where(['price_id'=> $subscription->stripe_price])->first();
          }
        //dd($package->toARray());
        //dd($subscription->toARray());   
        return view('landlord.billing-account.change_plan',compact('package','subscription','packageLists'));
    }

    public function RenewPlan(){
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $packageLists = Package::where('status', true)->get();
        $subscription= Subscription::where(['user_id' => Auth::user()->id])->first();
        if($subscription){
            $package = PackagePrice::where(['price_id'=> $subscription->stripe_price])->first();
          }
        //dd($package->toARray());
        //dd($subscription->toARray());   
        return view('landlord.billing-account.renew_plan',compact('package','subscription','packageLists'));
    }

    public function cancelation(){
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $subscription= Subscription::where(['user_id' => Auth::user()->id, 'current_status' => 'active'])->first();
        
        if($subscription){
          $package = PackagePrice::where(['price_id'=> $subscription->stripe_price])->first();
        }else{
            $subscription= Subscription::where(['user_id' => Auth::user()->id])->first();
            $package = PackagePrice::where(['price_id'=> $subscription->stripe_price])->first();
        }
        $sub = $stripe->subscriptions->retrieve($subscription->subscription_id, []);
        $nextDueDate = date('M d, Y',$sub->current_period_end);
        //dd($package->toARray());
        //dd($subscription->toARray()); 
        return view('landlord.billing-account.cancelation',compact('package','sub','nextDueDate','subscription'));
    }

    public function cancelationPost(request $request){
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $subscription= Subscription::where(['user_id' => Auth::user()->id,'current_status' => 'active'])->first();
        //dd($subscription->toArray());
        $retrieve = $stripe->subscriptions->retrieve($subscription->subscription_id, []);
        //echo date("Y-m-d", $retrieve->current_period_end);
        // dd($retrieve->toARray());
        //$cancel = $stripe->subscriptions->cancel($subscription->subscription_id, []);
        $cancel = $stripe->subscriptions->update($subscription->subscription_id, ['cancel_at_period_end' => true]);

        //if($cancel->status == 'canceled'){
            $subscription->current_status = 'canceled';
            $subscription->canceled_date = date("Y-m-d", $retrieve->current_period_end);

            $subscription->save();
        //}

        return redirect()->back()->with('message', 'Subscription canceled successfully.');

    }

    public function SubscriptionStatusChange(request $request){
        $invoice_status = $request->invoice_status;
        $status = $request->status;
        $subscription= Subscription::where(['user_id' => Auth::user()->id, 'current_status' => 'active'])->first();
        //dd($subscription->iterator_to_array());
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        
        if($subscription->invoice_status == 'active' && $invoice_status == 'active'){
            $update = $stripe->subscriptions->update(
                $subscription->subscription_id,
                ['pause_collection' => ['behavior' => 'mark_uncollectible']]
              );
            $subscription->invoice_status = 'paused';
            $subscription->save();

        return response()->json(['message' => 'Subscription paused successfully.']);
             
        }else if($subscription->invoice_status == 'paused'){
            // $resume = $stripe->subscriptions->resume(
            //     $subscription->subscription_id,
            //     ['billing_cycle_anchor' => 'now']
            //   );
            $resume = $stripe->subscriptions->update(
                $subscription->subscription_id,
                ['pause_collection' => '']
              );
                $subscription->invoice_status = 'active';

              $subscription->save();
              //dd($resume->toArray());
        return response()->json(['message' => 'Subscription resumed successfully.']);

        }
        
    }

    public function BillingCycle($unit,$id){
        $property_units = PropertyUnit::where(['added_by_id' => Auth::user()->id,'status'=>false])->get();
        if(count($property_units) > 0){
            foreach($property_units as $u){
                $u->status = true;
                $u->save();
            }
        }
        //$subscription = Subscription::where(['user_id' => Auth::user()->id])->first();
        $package = PackagePrice::where(['package_id' => $id])->first();
        $subscription= Subscription::where(['user_id' => Auth::user()->id, 'current_status' => 'active'])->first();
        if($subscription){
            $schedule = PackagePrice::where(['price_id'=> $subscription->stripe_price])->first();
          }

        if($subscription->quantity == $unit && $package->package_id == $id) {
            return redirect()->back()->with('error', 'You already have an active plan under this subscription.');
        }
        elseif($unit < $subscription->quantity){

            $property = Property::where(['added_by_id' => Auth::user()->id])->get();
            $propertyUnits = PropertyUnit::where(['added_by_id' => Auth::user()->id,'status'=>true])->orderBy('unit_name')->get();
            $propertyTypes = PropertyType::where('property_type_status',true)->get();
            $tenants = Tenant::where(['added_by_id' => Auth::user()->id])->get();
            //dd($property->toArray());
            //dd($propertyUnits->toArray());
            //dd($tenants->toArray());
            $unit_number = $unit;

            $oldPropertyUnits = PropertyUnit::where(['added_by_id' => Auth::user()->id, 'status' =>true])->get();
            
            if($unit_number >= count($oldPropertyUnits)){
                //return view('landlord.billing-account.billing-cycle',compact('unit','id'));
                return view('landlord.billing-account.downgrade-billing-cycle',compact('unit','id','schedule'));
            }else{
                return view('landlord.billing-account.downgrade_unit',compact('unit_number','oldPropertyUnits','id','property','schedule','propertyUnits','propertyTypes','tenants'));
            }

            
        }
        else{
            return view('landlord.billing-account.billing-cycle',compact('unit','id','schedule'));
        }
        
        
    }

    public function deactivatePropertyUnit(request $request){
        
        if($request->delete){
            if(count($request->delete) < $request->limit){
                return redirect()->back();
            }
        }
        

        if($request->delete){
            $recordIds = $request->get('delete');
           
            PropertyUnit::whereIn('id', $recordIds)->update(['status' => false]);
        }

        $propertyUnits = PropertyUnit::where(['added_by_id' => Auth::user()->id, 'status' =>true])->get();
        // dd(count($propertyUnits));
        if(count($propertyUnits) > $request->unit){
            $property = count($propertyUnits);
            return redirect()->back()->with('message', 'In order to lower your plan, you must deactivate '.(count($propertyUnits) - $request->unit).' of '.$property.' registered units. Please select the units you wish to deactivate.');
        }elseif(count($propertyUnits) <= $request->unit){
            $property = Property::where(['added_by_id' => Auth::user()->id])->get();
            $propertyUnits = PropertyUnit::where(['added_by_id' => Auth::user()->id,'status'=>false])->orderBy('unit_name')->get();
            $tenants = Tenant::where(['added_by_id' => Auth::user()->id])->get();
            $unit_number = $request->unit;
            $id = $request->id;
            return view('landlord.billing-account.deactive_property_list',compact('unit_number','id','propertyUnits','tenants','property'));
        }
        
    }

    public function downgradeBillingCycle($unit,$id){
        $subscription= Subscription::where(['user_id' => Auth::user()->id, 'current_status' => 'active'])->first();
        if($subscription){
            $schedule = PackagePrice::where(['price_id'=> $subscription->stripe_price])->first();
          }
        return view('landlord.billing-account.downgrade-billing-cycle',compact('unit','id','schedule'));
        
    }

    public function RenewBillingCycle($unit,$id){
        $subscription = Subscription::where(['user_id' => Auth::user()->id])->first();
        $package = PackagePrice::where(['package_id' => $id])->first();

        // if($subscription->quantity == $unit && $package->package_id == $id) {
        //     return redirect()->back()->with('error', 'You have already active on this plan.');
        // }
        
        return view('landlord.billing-account.renew-billing-cycle',compact('unit','id'));
    }

    public function reviewOrder($unit ,$pid,$cycle){
    //     $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    //    $cash_balance = $stripe->customers->retrieveCashBalance(Auth::user()->customer_id, []);
        
    //         $a= $stripe->balance->retrieve([]);
    //     dd($cash_balance);

        $package = PackagePrice::where(['package_id'=>$pid,'status' => true , 'schedule_type' => $cycle])->first();
        $subscription = Subscription::where(['user_id' => Auth::user()->id, 'current_status' => 'active'])->first();
        //dd($subscription->toArray());
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $sub = $stripe->subscriptions->retrieve($subscription->subscription_id, []);
        $nextDueDate = date('Y-m-d',$sub->current_period_end);
        $nextDueDateByFormat = date('F d, Y',$sub->current_period_end);
        //old logic start
        $now = time(); // or your date as well
        $your_date = strtotime($nextDueDate);
        $datediff = $your_date - $now;
        $remaining_days = round($datediff / (60 * 60 * 24));
        //old logic end

        //new logic
        if($cycle == 'monthly' || $cycle == ' monthly'){
            $oldPlanPrice = $subscription->amount;
            $oldPlanQuantity = $subscription->quantity;
            if($unit > 2){ $newamount = $unit * 20;}else{ $newamount = $unit *25;} 
            $newPlanPrice = $newamount;
            $newPlanQuantity = $unit;

            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            //$list = $stripe->invoices->all(['customer'=> Auth::user()->customer_id,'limit' => 3]);
            $list = $stripe->invoices->all(['customer'=> Auth::user()->customer_id]);
            $invoices = $list['data'];

            $count = count($invoices);
            //dd($invoices);
            $periodStartTimestamp = $invoices[$count-1]['period_start'];
            $nextDueDateTime = date('Y-m-d H:i:s', strtotime('+1 month', $periodStartTimestamp));;
            $periodEndTimestamp = strtotime($nextDueDateTime);
            $apiRequestTimeTimestamp = strtotime(date('Y-m-d H:i:s'));

            $nextDueDateByFormat = date('F d, Y',strtotime($nextDueDateTime));

            // Calculate durations in seconds
            $totalPeriodDuration = $periodEndTimestamp - $periodStartTimestamp;
            $remainingPeriodDuration = $periodEndTimestamp - $apiRequestTimeTimestamp;

            // Calculate the cost for the remaining period under the old plan
            //$oldPlanCost = ($remainingPeriodDuration / $totalPeriodDuration) * $oldPlanQuantity * $oldPlanPrice;
            $oldPlanCost = ($remainingPeriodDuration / $totalPeriodDuration) * $oldPlanPrice;


            // Calculate the cost for the remaining period under the new plan
            $newPlanCost = ($remainingPeriodDuration / $totalPeriodDuration) * $newPlanPrice;

            // Calculate the proration cost
           $prorationCost = $newPlanCost - $oldPlanCost;
           $finalCost = round($prorationCost, 2);
        }else{
            $oldPlanPrice = $subscription->amount;
            $oldPlanQuantity = $subscription->quantity;
            if($unit > 2){ $newamount = $unit * 20;}else{ $newamount = $unit *25;} 
            $newPlanPrice = $newamount;
            $newPlanQuantity = $unit;
            
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            //$list = $stripe->invoices->all(['customer'=> Auth::user()->customer_id,'limit' => 3]);
            $list = $stripe->invoices->all(['customer'=> Auth::user()->customer_id]);
            $invoices = $list['data'];

            $count = count($invoices);
            //dd($invoices);
            $periodStartTimestamp = $invoices[$count-1]['period_start'];
            $nextDueDateTime = date('Y-m-d H:i:s', strtotime('+1 year', $periodStartTimestamp));;
            $periodEndTimestamp = strtotime($nextDueDateTime);
            $apiRequestTimeTimestamp = strtotime(date('Y-m-d H:i:s'));

            $nextDueDateByFormat = date('F d, Y',strtotime($nextDueDateTime));

            // Calculate durations in seconds
            $totalPeriodDuration = $periodEndTimestamp - $periodStartTimestamp;
            $remainingPeriodDuration = $periodEndTimestamp - $apiRequestTimeTimestamp;

            // Calculate the cost for the remaining period under the old plan
            //$oldPlanCost = ($remainingPeriodDuration / $totalPeriodDuration) * $oldPlanQuantity * $oldPlanPrice;
            $oldPlanCost = ($remainingPeriodDuration / $totalPeriodDuration) * $oldPlanPrice;


            // Calculate the cost for the remaining period under the new plan
            $newPlanCost = ($remainingPeriodDuration / $totalPeriodDuration) * $newPlanPrice * 12;

            // Calculate the proration cost
           $prorationCost = $newPlanCost - $oldPlanCost;
           $finalCost = round($prorationCost, 2);
        }    
        //dd($invoices);
        //new logic end
       
        return view('landlord.billing-account.review-order',compact('finalCost','unit','pid','cycle','package','nextDueDate','nextDueDateByFormat','remaining_days','subscription'));
    }
    
    public function renewOrder($unit ,$pid,$cycle){
        $package = PackagePrice::where(['package_id'=>$pid,'status' => true , 'schedule_type' => $cycle])->first();

        if($cycle == 'monthly'){
            $currentDateTime = date("Y/m/d H:i:s");
            $currentDateTimeIntoString = strtotime($currentDateTime);
            $nextDueDateTime = date('F d, Y', strtotime('+1 month', $currentDateTimeIntoString));
        }else{
            $currentDateTime = date("Y/m/d H:i:s");
            $currentDateTimeIntoString = strtotime($currentDateTime);
            $nextDueDateTime = date('F d, Y', strtotime('+1 year', $currentDateTimeIntoString));
        }
        return view('landlord.billing-account.renew-order',compact('unit','pid','cycle','package','nextDueDateTime'));
    }

    public function downgradeReviewOrder($unit ,$pid,$cycle){
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $subscription = Subscription::where(['user_id' => Auth::user()->id, 'current_status' => 'active'])->first();
        $sub = $stripe->subscriptions->retrieve($subscription->subscription_id, []);
        // $nextDueDate = date('Y-m-d',$sub->current_period_end);
       
        //new logic
        if($cycle == 'monthly'){

            $list = $stripe->invoices->all(['customer'=> Auth::user()->customer_id]);
            $invoices = $list['data'];

            $count = count($invoices);
            //dd($invoices);
            $periodStartTimestamp = $invoices[$count-1]['period_start'];
            $nextDueDateTime = date('Y-m-d H:i:s', strtotime('+1 month', $periodStartTimestamp));;
            $periodEndTimestamp = strtotime($nextDueDateTime);
            $apiRequestTimeTimestamp = strtotime(date('Y-m-d H:i:s'));

            $nextDueDateByFormat = date('F d, Y',strtotime($nextDueDateTime));

        }else{
        
            $list = $stripe->invoices->all(['customer'=> Auth::user()->customer_id]);
            $invoices = $list['data'];

            $count = count($invoices);
            //dd($invoices);
            $periodStartTimestamp = $invoices[$count-1]['period_start'];
            $nextDueDateTime = date('Y-m-d H:i:s', strtotime('+1 year', $periodStartTimestamp));;
            $periodEndTimestamp = strtotime($nextDueDateTime);
            $apiRequestTimeTimestamp = strtotime(date('Y-m-d H:i:s'));

            $nextDueDateByFormat = date('F d, Y',strtotime($nextDueDateTime));

        } 
        $package = PackagePrice::where(['package_id'=>$pid,'status' => true , 'schedule_type' => $cycle])->first();
        
        return view('landlord.billing-account.downgrade-review-order',compact('unit','pid','cycle','package','nextDueDateByFormat'));
    }

    public function SubscriptionStore(request $request){
        //dd($request->toArray());
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $package = PackagePrice::where(['package_id'=> $request->pid,'schedule_type'=>$request->cycle])->first();
        //dd($package->toArray());

        if($request->unit > 2){
            $create = $stripe->subscriptions->create([
                'customer' => Auth::user()->customer_id,
                'items' => [
                    [
                    'price' => $package->price_id,
                    'quantity' => $request->unit, 
                    ]
                ],
                'discounts' => [[
                    'coupon' => 'mFiEh66R',
                ]],
                'default_payment_method' => Auth::user()->pm_id,
              ]);

            $list = $stripe->invoices->all(['customer'=> Auth::user()->customer_id,'limit' =>1]);
            $invoice = $list['data'];
            $invoice_status = $list['data'][0]['status'];
            
            if($invoice_status != 'paid'){
                $pay = $stripe->invoices->pay($invoice[0]->id, [
                    'payment_method' => Auth::user()->pm_id,
                ]); 
            } 
            $date = date("Y-m-d", $pay->period_end);
            
            $newDate = date('Y-m-d', strtotime($date. ' + 1 months'));
            
            $subscription =  new Subscription;
            $subscription->user_id = Auth::user()->id;
            $subscription->type = 'subscription';
            $subscription->subscription_id = $create->id;
            $subscription->stripe_status = 'complete';
            $subscription->current_status = 'active';
            $subscription->invoice_status = 'active';
            $subscription->stripe_price = $package->price_id;
            $subscription->quantity = $request->unit;
            $subscription->amount = $pay->amount_paid/100;
            $subscription->amount_paid = $pay->amount_paid/100;
            $subscription->subtotal = $pay->subtotal/100;
            $subscription->trial_ends_at = $newDate;
            $subscription->ends_at = $newDate;
            $subscription->save();

            $history =  new SubscriptionHistory;
            $history->user_id = Auth::user()->id;
            $history->type = 'subscription';
            $history->subscription_id = $create->id;
            $history->stripe_status = 'complete';
            $history->current_status = 'active';
            $history->invoice_status = 'active';
            $history->stripe_price = $package->price_id;
            $history->quantity = $request->unit;
            $history->amount = $pay->amount_paid/100;
            $history->amount_paid = $pay->amount_paid/100;
            $history->subtotal = $pay->subtotal/100;
            $history->save();

            // dd($pay->toArray()); 
            return redirect()->route('landlord.account.subscription')->with('message', 'Your subscription renew successfully! Amount charged $'.$pay->amount_paid/100);
        }else{
            $create = $stripe->subscriptions->create([
                'customer' => Auth::user()->customer_id,
                'items' => [
                    [
                    'price' => $package->price_id,
                    'quantity' => $request->unit, 
                    ]
                ],
                'default_payment_method' => Auth::user()->pm_id,
              ]);

                $list = $stripe->invoices->all(['customer'=> Auth::user()->customer_id,'limit' =>1]);
                $invoice = $list['data'];
                $invoice_status = $list['data'][0]['status'];
                
                if($invoice_status != 'paid'){
                    $pay = $stripe->invoices->pay($invoice[0]->id, [
                        'payment_method' => Auth::user()->pm_id,
                    ]); 
                } 

            $list = $stripe->invoices->all(['customer'=> Auth::user()->customer_id,'limit' =>1]);
            $invoice = $list['data'];
            $invoice_status = $list['data'][0]['status'];
            
            if($invoice_status != 'paid'){
                $pay = $stripe->invoices->pay($invoice[0]->id, [
                    'payment_method' => Auth::user()->pm_id,
                ]); 
            } 
            $date = date("Y-m-d", $pay->period_end);
            
            $newDate = date('Y-m-d', strtotime($date. ' + 1 months'));
            
            $subscription =  new Subscription;
            $subscription->user_id = Auth::user()->id;
            $subscription->type = 'subscription';
            $subscription->subscription_id = $create->id;
            $subscription->stripe_status = 'complete';
            $subscription->current_status = 'active';
            $subscription->invoice_status = 'active';
            $subscription->stripe_price = $package->price_id;
            $subscription->quantity = $request->unit;
            $subscription->amount = $pay->amount_paid/100;
            $subscription->amount_paid = $pay->amount_paid/100;
            $subscription->subtotal = $pay->subtotal/100;
            $subscription->trial_ends_at = $newDate;
            $subscription->ends_at = $newDate;
            $subscription->save();

            $history =  new SubscriptionHistory;
            $history->user_id = Auth::user()->id;
            $history->type = 'subscription';
            $history->subscription_id = $create->id;
            $history->stripe_status = 'complete';
            $history->current_status = 'active';
            $history->invoice_status = 'active';
            $history->stripe_price = $package->price_id;
            $history->quantity = $request->unit;
            $history->amount = $pay->amount_paid/100;
            $history->amount_paid = $pay->amount_paid/100;
            $history->subtotal = $pay->subtotal/100;
            $history->save();
            //dd($create->toArray()); 
            return redirect()->route('landlord.account.subscription')->with('message', 'Your subscription renew successfully charges amount $'.$pay->amount_paid/100); 
        }
       
    }

    public function SubscriptionUpdateTemp(request $request){
        Auth::user()->customer_id;
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $YOUR_DOMAIN = 'http://127.0.0.1:8000/';
        $redirectUrl = route('stripe.checkout.success').'?session_id={CHECKOUT_SESSION_ID}';
        $package = PackagePrice::where(['package_id'=> $request->pid,'schedule_type'=>$request->cycle])->first();
        
        $subscription = Subscription::where(['user_id' => Auth::user()->id])->first();
        $retrieve = $stripe->subscriptions->retrieve($subscription->subscription_id, []);
        //dd($retrieve->toArray());
        $old_sub = $retrieve->items->data[0];
        
        $res = $stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
            // 'line_items' => [
            //   [
            //     'price' => $package->price_id,
            //     'quantity' => $request->unit,
            //   ],
            // ],
            'subscription_data' => [
                'items' => [
                    [
                        'id' => $old_sub->id,
                        'price' => $package->price_id,
                        'quantity' => $request->unit,
                    ],
                ],
            ],
            'mode' => 'subscription',
            // 'discounts' => [[
            //     'coupon' => 'Sbj1bqJF',
            // ]],
            'customer'=> Auth::user()->customer_id,
            //'success_url' => 'http://127.0.0.1:8000/success',
            'success_url' => $redirectUrl,
            'cancel_url' => 'http://127.0.0.1:8000/cancel',
          ]);
          return redirect($res['url']);
            
    }

    public function SubscriptionUpdate(request $request){

        $userExist = SubscriptionHistory::where(['user_id' => Auth::user()->id])->get();
        $get_package = PackagePrice::where(['package_id'=> $request->pid,'schedule_type'=>$request->cycle])->first();
        //dd($get_package->toARray());
        

        // dd($request->toArray());
        $date = Carbon::now()->timestamp;
        $proration_date = time();
        //echo $request->unit;
        $new_plan_id = $request->pid;
        $subscription = Subscription::where(['user_id' => Auth::user()->id])->first();
        $package = PackagePrice::where('price_id',$subscription->stripe_price)->first();
        $current_plan_id = $package->package_id;
        //dd($package->toArray());
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $retrieve = $stripe->subscriptions->retrieve($subscription->subscription_id, []);
        //dd($retrieve->toArray());
        $old_sub = $retrieve->items->data[0];
    //   echo $old_sub->id;
    //    dd($retrieve->toARray());

        // $update = $stripe->subscriptions->update(
        //     $subscription->subscription_id,[
        //     'proration_behavior' => 'always_invoice',
        //     'billing_cycle_anchor' => 'now',
        //     'items' => 
        //         [ [  
        //             'price' => $package->price_id,
        //             'quantity' => $request->unit,
        //             'discounts' => [[
        //                 'coupon' => 'Sbj1bqJF',
        //             ]],
        //         ], 
        //     ],
        //     ]);
        
        if($current_plan_id != $new_plan_id ){
            $package = PackagePrice::where(['package_id'=> $request->pid,'schedule_type'=>$request->cycle])->first();
            if($subscription->quantity > 2 ){
                $item = $stripe->subscriptionItems->update(
                    $old_sub->id,[
                        'proration_behavior' => 'always_invoice',
                        'payment_behavior' => 'allow_incomplete',
                        'proration_date' => $proration_date,
                        'quantity' => $request->unit, 
                        'price' => $package->price_id,
                        
                        
                    ]);
            }else{
                if($request->unit == 1){
                    $item = $stripe->subscriptionItems->update(
                        $old_sub->id,[
                            'proration_behavior' => 'always_invoice',
                            'payment_behavior' => 'allow_incomplete',
                            'proration_date' => $proration_date,
                            'quantity' => $request->unit, 
                            'price' => $package->price_id ,
                            'discounts' => null,  
                        ]);
                }else if($request->unit == 2){
                    $item = $stripe->subscriptionItems->update(
                        $old_sub->id,[
                            'proration_behavior' => 'always_invoice',
                            'payment_behavior' => 'allow_incomplete',
                            'proration_date' => $proration_date,
                            'quantity' => $request->unit, 
                            'price' => $package->price_id , 
                            'discounts' => null, 
                        ]);
                }else{
                    $item = $stripe->subscriptionItems->update(
                        $old_sub->id,[
                            'proration_behavior' => 'always_invoice',
                            'payment_behavior' => 'allow_incomplete',
                            'proration_date' => $proration_date,
                            'quantity' => $request->unit,
                            'price' => $package->price_id,
                            'discounts' => [['coupon' => 'mFiEh66R',]],
                            ]);
                }
                
            }
        }else{
            
            $package = PackagePrice::where(['package_id'=> $request->pid,'schedule_type'=>$request->cycle])->first();
            if($subscription->quantity > 2 ){
            
            //$resp = $stripe->subscriptions->deleteDiscount($subscription->subscription_id, []);
            //dd($resp->toARray());

                $item = $stripe->subscriptionItems->update(
                    $old_sub->id,[
                        'proration_behavior' => 'always_invoice',
                        'payment_behavior' => 'allow_incomplete',
                        'proration_date' => $proration_date,
                        'quantity' => $request->unit, 
                        'price' => $package->price_id, 
                    ]);
            }else{
                if($request->unit == 1){
                    $item = $stripe->subscriptionItems->update(
                        $old_sub->id,[
                            'proration_behavior' => 'always_invoice',
                            'payment_behavior' => 'allow_incomplete',
                            'proration_date' => $proration_date,
                            'quantity' => $request->unit,  
                            'price' => $package->price_id, 
                            'discounts' => null, 
                        ]);
                }else if($request->unit == 2){
                    $item = $stripe->subscriptionItems->update(
                        $old_sub->id,[
                            'proration_behavior' => 'always_invoice',
                            'payment_behavior' => 'allow_incomplete',
                            'proration_date' => $proration_date,
                            'quantity' => $request->unit, 
                            'price' => $package->price_id, 
                            'discounts' => null,  
                        ]);
                }else{
                    $item = $stripe->subscriptionItems->update(
                        $old_sub->id,[
                            'proration_behavior' => 'always_invoice',
                            'payment_behavior' => 'allow_incomplete',
                            'proration_date' => $proration_date,
                            'quantity' => $request->unit,
                            'price' => $package->price_id,
                            'discounts' => [['coupon' => 'mFiEh66R',]],
                            ]);
                }
                
            }
        }

        $list = $stripe->invoices->all(['customer'=> Auth::user()->customer_id,'limit' =>1]);
        $invoice = $list['data'];
        $invoice_status = $list['data'][0]['status'];
        $amount_paid = $list['data'][0]['amount_paid'];
        // echo $invoice_status;
        // echo $amount_paid;
        // dd($list->toARray());
        if($invoice_status != 'paid'){
            $pay = $stripe->invoices->pay($invoice[0]->id, [
                'payment_method' => Auth::user()->pm_id,
            ]);

            if(count($userExist) > 0 ){
                $subscription = Subscription::where(['user_id' => Auth::user()->id, 'current_status' => 'active'])->first();
                if($request->unit > 2){ $discount = ((25 * $request->unit) * 20)/100; } else{ $discount = 0; }
    
                $subscriptionNew = new SubscriptionHistory;
                $subscriptionNew->user_id = Auth::user()->id;
                $subscriptionNew->type = 'subscription';
                //$subscription->session_id = $session->id;
                $subscriptionNew->subscription_id = $subscription->subscription_id; 
                $subscriptionNew->stripe_status = $subscription->stripe_status;
                if($request->cycle == 'monthly'){
                    $subscriptionNew->amount = $request->unit * 25 - $discount;
                }else{
                    $subscriptionNew->amount = ($request->unit * 25 - $discount) * 12;
                }
                
                $subscriptionNew->subtotal = $request->unit * 25;
                $subscriptionNew->stripe_price = $get_package->price_id;
                $subscriptionNew->quantity = $request->unit;
                $subscriptionNew->amount_paid = $pay->amount_paid/100;
                $subscriptionNew->current_status = 'active';
                $subscriptionNew->invoice_status = 'active';
                //$subscription->trial_ends_at = Carbon::now()->lastOfMonth();
                $subscriptionNew->save();
    
                $subscription->quantity = $request->unit;
                if($request->cycle == 'monthly'){
                    $subscription->amount = $request->unit * 25 - $discount;
                }else{
                    $subscription->amount = ($request->unit * 25 - $discount) * 12;
                }
                $subscription->subtotal = $request->unit * 25;
                $subscription->amount_paid = $pay->amount_paid/100;
                $subscription->stripe_price = $get_package->price_id;
                $subscription->save();
    
            }else{
                $subscription = Subscription::where(['user_id' => Auth::user()->id, 'current_status' => 'active'])->first();
                //dd($subscription->toArray());
                $history = new SubscriptionHistory;
                $history->user_id = Auth::user()->id;
                $history->type = 'subscription';
                $history->session_id = $subscription->session_id;
                $history->subscription_id = $subscription->subscription_id;
                $history->stripe_status = $subscription->stripe_status;
                $history->current_status = $subscription->current_status;
                $history->invoice_status = $subscription->invoice_status;
                $history->stripe_price = $subscription->stripe_price;
                $history->quantity = $subscription->quantity;
                $history->amount = $subscription->amount;
                $history->amount_paid = $subscription->amount;
                $history->subtotal = $subscription->subtotal;
                $history->canceled_date = $subscription->canceled_date;
                $history->save();
    
                if($request->unit > 2){ $discount = ((25 * $request->unit) * 20)/100; } else{ $discount = 0; }
    
                $subscriptionNew = new SubscriptionHistory;
                $subscriptionNew->user_id = Auth::user()->id;
                $subscriptionNew->type = 'subscription';
                //$subscription->session_id = $session->id;
                $subscriptionNew->subscription_id = $subscription->subscription_id; 
                $subscriptionNew->stripe_status = $subscription->stripe_status;
                if($request->cycle == 'monthly'){
                    $subscriptionNew->amount = $request->unit * 25 - $discount;
                }else{
                    $subscriptionNew->amount = ($request->unit * 25 - $discount) * 12;
                }
                $subscriptionNew->subtotal = $request->unit * 25;
                $subscriptionNew->stripe_price = $get_package->price_id;
                $subscriptionNew->quantity = $request->unit;
                $subscriptionNew->amount_paid = $pay->amount_paid/100;
                $subscriptionNew->current_status = 'active';
                $subscriptionNew->invoice_status = 'active';

                //$subscription->trial_ends_at = Carbon::now()->lastOfMonth();
                $subscriptionNew->save();
    
                $subscription->quantity = $request->unit;
                if($request->cycle == 'monthly'){
                    $subscription->amount = $request->unit * 25 - $discount;
                }else{
                    $subscription->amount = ($request->unit * 25 - $discount) * 12;
                }
                $subscription->subtotal = $request->unit * 25;
                $subscription->amount_paid = $pay->amount_paid/100;
                $subscription->stripe_price = $get_package->price_id;
                $subscription->save();
            }
            
            return redirect()->route('landlord.account.subscription')->with('message', 'Your subscription updated successfully! Amount charged $'.$pay->amount_paid/100);
        }else{
            if(count($userExist) > 0 ){
                $subscription = Subscription::where(['user_id' => Auth::user()->id, 'current_status' => 'active'])->first();
                if($request->unit > 2){ $discount = ((25 * $request->unit) * 20)/100; } else{ $discount = 0; }
    
                $subscriptionNew = new SubscriptionHistory;
                $subscriptionNew->user_id = Auth::user()->id;
                $subscriptionNew->type = 'subscription';
                //$subscription->session_id = $session->id;
                $subscriptionNew->subscription_id = $subscription->subscription_id; 
                $subscriptionNew->stripe_status = $subscription->stripe_status;
                if($request->cycle == 'monthly'){
                    $subscriptionNew->amount = $request->unit * 25 - $discount;
                }else{
                    $subscriptionNew->amount = ($request->unit * 25 - $discount) * 12;
                }
                $subscriptionNew->subtotal = $request->unit * 25;
                $subscriptionNew->stripe_price = $get_package->price_id;
                $subscriptionNew->quantity = $request->unit;
                $subscriptionNew->amount_paid = 0;
                $subscriptionNew->current_status = 'active';
                $subscriptionNew->invoice_status = 'active';
                //$subscription->trial_ends_at = Carbon::now()->lastOfMonth();
                $subscriptionNew->save();
    
                $subscription->quantity = $request->unit;
                if($request->cycle == 'monthly'){
                    $subscription->amount = $request->unit * 25 - $discount;
                }else{
                    $subscription->amount = ($request->unit * 25 - $discount) * 12;
                }
                $subscription->subtotal = $request->unit * 25;
                $subscription->amount_paid = $request->unit * 25 - $discount;
                $subscription->stripe_price = $get_package->price_id;
                $subscription->save();
    
            }else{
                $subscription = Subscription::where(['user_id' => Auth::user()->id, 'current_status' => 'active'])->first();
                //dd($subscription->toArray());
                $history = new SubscriptionHistory;
                $history->user_id = Auth::user()->id;
                $history->type = 'subscription';
                $history->session_id = $subscription->session_id;
                $history->subscription_id = $subscription->subscription_id;
                $history->stripe_status = $subscription->stripe_status;
                $history->current_status = $subscription->current_status;
                $history->invoice_status = $subscription->invoice_status;
                $history->stripe_price = $subscription->stripe_price;
                $history->quantity = $subscription->quantity;
                $history->amount = $subscription->amount;
                $history->amount_paid = $subscription->amount;
                $history->subtotal = $subscription->subtotal;
                $history->canceled_date = $subscription->canceled_date;
                $history->save();
    
                if($request->unit > 2){ $discount = ((25 * $request->unit) * 20)/100; } else{ $discount = 0; }
    
                $subscriptionNew = new SubscriptionHistory;
                $subscriptionNew->user_id = Auth::user()->id;
                $subscriptionNew->type = 'subscription';
                //$subscription->session_id = $session->id;
                $subscriptionNew->subscription_id = $subscription->subscription_id; 
                $subscriptionNew->stripe_status = $subscription->stripe_status;
                if($request->cycle == 'monthly'){
                    $subscriptionNew->amount = $request->unit * 25 - $discount;
                }else{
                    $subscriptionNew->amount = ($request->unit * 25 - $discount) * 12;
                }
                $subscriptionNew->subtotal = $request->unit * 25;
                $subscriptionNew->stripe_price = $get_package->price_id;
                $subscriptionNew->quantity = $request->unit;
                $subscriptionNew->amount_paid = 0;
                $subscriptionNew->current_status = 'active';
                $subscriptionNew->invoice_status = 'active';

                //$subscription->trial_ends_at = Carbon::now()->lastOfMonth();
                $subscriptionNew->save();
    
                $subscription->quantity = $request->unit;
                if($request->cycle == 'monthly'){
                    $subscription->amount = $request->unit * 25 - $discount;
                }else{
                    $subscription->amount = ($request->unit * 25 - $discount) * 12;
                }
                $subscription->subtotal = $request->unit * 25;
                $subscription->amount_paid = $request->unit * 25 - $discount;
                $subscription->stripe_price = $get_package->price_id;
                $subscription->save();
            }

            $property_unit = PropertyUnit::where(['added_by_id' => Auth::user()->id,'status'=> false])->get();
            //dd($property_unit->toARray());
            if(count($property_unit) > 0){
                foreach($property_unit as $unit){
                    $tenant = Tenant::where(['added_by_id' => Auth::user()->id,'property_unit_id' => $unit->id])->first();
                    if($tenant){
                        $tenant->rental_status ='Expired';
                        $tenant->status = false;
                        $tenant->save();
                    }
                    

                    $unit->delete();
                }
            }
            return redirect()->route('landlord.account.subscription')->with('message', 'Your subscription updated successfully! Amount charged $'.$amount_paid/100);


        }
      
        
        //dd($pay->toArray());
       
        //dd($invoice);
        
    }

}
