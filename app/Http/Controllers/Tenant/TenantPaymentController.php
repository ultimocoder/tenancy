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
    
    
   
}
