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
    public function tenantInfo(){                 
                $tenant_info = Tenant::where(['user_id'=> Auth::user()->id])->first();              
                $user = User::where('id',$tenant_info->user_id)->first();
                $popups  = PopupTenant::where(['added_by_id' => Auth::user()->id])->get();
                return view('tenant.tenant-information', compact('tenant_info','user','popups'));
      
    }
    public function tenantEdit($id){
        $tenant = User::where('users.id', $id)
            ->join('tenants as t', 't.user_id', '=', 'users.id')
                ->select('t.id','t.first_name','t.last_name','t.email','t.phone','t.address','users.unique_id','users.zipcode','users.city','users.state','users.country','t.created_at','t.lease_start_date','t.lease_end_date','t.rental_amount','t.status','t.property_name','t.property_unit','t.account_status','t.late_fee','t.rental_status','t.lease_type','t.image')->first();
        // dd($tenant->toArray());
        return view('tenant.edit',compact('tenant'));
    }
    public function tenantUpdate(request $request){
      
        $date1 = new \DateTime($request->lease_start_date);
        $start = $date1->format('Y-m-d');
        $date2 = new \DateTime($request->lease_end_date);
        $end = $date2->format('Y-m-d');
      

        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            // 'email' => 'required|unique:users',
            'phone' => 'required|min:10',
            'lease_type' => "required"
        ]);
        
        $tenant = Tenant::where(['id'=> $request->id])->first();
        $tenant->first_name = $request->first_name;
        $tenant->last_name = $request->last_name;
        $tenant->address = $request->address; 
        $tenant->added_by_id = Auth::user()->id;
        $tenant->property_unit = $request->unit_number;
        $tenant->email = $request->email;
        $tenant->phone = $request->phone; 
        if($request->lease_start_date){
            $tenant->lease_start_date = $start;
        }
        if($request->lease_end_date){
            $tenant->lease_end_date = $end;
        }
        $tenant->rental_amount = str_replace(array('$', ','), '', $request->rental_amount);
        $tenant->account_status = $request->acc_status;
        $tenant->late_fee = $request->late_fee;
        $tenant->rental_status = $request->rental_status;
        $tenant->lease_type = $request->lease_type;
        if($request->rental_status == 'Active'){
            $tenant->status = true;
        }else{
            $tenant->status = false;
            $unit = PropertyUnit::where(['added_by_id' => Auth::user()->id,'property_id' => $tenant->property_id, 'unit_name' => $request->unit_number])->first();
            if($unit){
                $unit->booked = 0;
                $unit->save();
                $tenant->property_unit = '';
                $tenant->property_unit_id = null;

            }
        }

        if($files = $request->file('file')) {

            if($tenant->image){
                unlink(public_path('tenants/'.$tenant->image));
            }   
            //$image = $request->file('edit_image');
            //$request->image->move(public_path('images'), $imageName);
            $destinationPath = 'public/tenants/'; // upload path
            $image = time() . "." . $files->getClientOriginalExtension();
            $request->file->move(public_path('tenants'), $image);
            $tenant->image = $image;
            
        }  
        
        $tenant->save();

        $user = User::where(['id' => $tenant->user_id])->first();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->address = $request->address; 
        $user->username = $request->first_name."".$request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone; 
        if($request->status){
            $user->status = true;
        }else{
            $user->status = false;
        }
        $user->state = $request->state; 
        $user->city = $request->city; 
        $user->country = $request->country;
        $user->zipcode = $request->zipcode; 
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

    
}
