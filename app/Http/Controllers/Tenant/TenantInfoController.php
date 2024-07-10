<?php

namespace App\Http\Controllers\Tenant;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\PropertyUnit;
use App\Models\AccountId;
use App\Models\PopupTenant;
use auth;
use Carbon\Carbon;


class TenantInfoController extends Controller
{
    public function tenantsInfo(){                 
        $tenant_info = Tenant::where(['user_id'=> Auth::user()->id])->first();              
        $user = User::where('id',$tenant_info->user_id)->first();
        $popups  = PopupTenant::where(['added_by_id' => Auth::user()->id])->get();
        return view('tenant.tenant-information', compact('tenant_info','user','popups'));      
    }
    public function tenantEdit($id){
        $tenant = User::where('users.id', $id)
            ->join('tenants as t', 't.user_id', '=', 'users.id')
                ->select('t.id','t.first_name','t.last_name','t.email','t.phone','t.address','users.unique_id','users.zipcode','users.username','users.city','users.state','users.country','t.created_at','t.lease_start_date','t.lease_end_date','t.rental_amount','t.status','t.property_name','t.property_unit','t.account_status','t.late_fee','t.rental_status','t.lease_type','t.image')->first();
        // dd($tenant->toArray());
        return view('tenant.edit',compact('tenant'));
    }
    public function tenantUpdate(request $request){    

        $validated = $request->validate([          
            // 'email' => 'required|unique:users',
            'phone' => 'required|min:10'
           
        ]);
        $tenant = Tenant::where(['id'=> $request->id])->first();       
        $tenant->email = $request->email;
        $tenant->phone = $request->phone;          
        $tenant->save();
        $user = User::where(['id' => $tenant->user_id])->first();
      
        $user->email = $request->email;
        $user->phone = $request->phone;         
        $user->save();
        return redirect()->route('tenant.tenant-information')->with('message', 'Tenant updated successfully.');

    }
    public function deletePhoto($id){

        $tenant = Tenant::where(['id'=> $id])->first();
            if($tenant->image){
                unlink(public_path('tenants/'.$tenant->image));
            }   
            $tenant->image = '';
        
        $tenant->save();
        return redirect()->back()->with('message', 'Photo removed successfully.');
    }
    public function tenantAdditionalInfo(){       
        $tenant_info = Tenant::where(['user_id'=> Auth::user()->id])->first();              
        $user = User::where('id',$tenant_info->user_id)->first();                  
        return view('tenant.tenant-additional-information', compact('tenant_info','user'));           
    }
    public function tenantEditAdditionalInfo($id){
       
        $tenant = User::where('users.id', $id)
            ->join('tenants as t', 't.user_id', '=', 'users.id')
                ->select('*')->first();
        // dd($tenant->toArray());
        return view('tenant.additional-information-edit',compact('tenant'));
     
    }
    public function tenantUpdateAdditionalInfo(request $request){    
              
        $tenant = Tenant::where(['id'=> $request->id])->first();       
        $tenant->late_fee = $request->late_fee;
        $tenant->grace_period_days = $request->grace_period_days;   
        $tenant->number_of_security_deposit = $request->number_of_security_deposit;
        $tenant->total_security_deposit = $request->total_security_deposit;   
        $tenant->rent_due_date = $request->rent_due_date;
        $tenant->pets = $request->pets;    
        $tenant->storage = $request->storage;      
        $tenant->parking = $request->parking;      
        $tenant->notes = $request->notes;            
        $tenant->save();       
        return redirect()->route('tenant.tenant-additional-information')->with('message', 'Tenant Additional Information updated successfully.');

    }

    
}
