<?php

namespace App\Http\Controllers\Landlord;
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


class TenantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // private function generateAccountId() {
    //     // Get current timestamp (milliseconds)
    //         //return $phone;
    //         // Get current timestamp (milliseconds)
    //         $timestamp = microtime(true) * 10000;
        
    //         // Generate random number to fill remaining digits
    //         $random_number = mt_rand(100000000, 999999999);
        
    //         // Concatenate timestamp and random number and phone number
    //         $account_id =date('dm') . $random_number;
        
    //         // Truncate to 17 digits
    //         $account_id = substr($account_id, 0, 9);
        
    //         return $account_id;
    // }

    private function generateAccountId()
    {
        $accountIdRecord = AccountId::firstOrCreate([]);

        $accountId = str_pad($accountIdRecord->current_id, 6, '0', STR_PAD_LEFT);

        $accountIdRecord->increment('current_id');

        return $accountId;
    }

    public function tenantList(){
        $tenants = Tenant::where(['added_by_id' => Auth::user()->id, 'status' => true])->get();
        //dd($tenants->toArray());
        return view('landlord.tenant.list', compact('tenants'));
    }

    public function createTenant(){
        $user_id = Auth::user()->id;
        $property_list = Property::where(['active_property' => true , 'added_by_id'=> $user_id])->get();
        $property_units = PropertyUnit::where(['status' => true , 'added_by_id'=> $user_id, 'booked' => 0])->get();

        $property = [];
        $unit = [];
        //dd($property_units->toArray());
        return view('landlord.tenant.create', compact('property_list','property','unit','property_units'));
    }

    public function createTenantFromUnit($id){
       $unit  = PropertyUnit::where(['added_by_id' => Auth::user()->id, 'id' => $id])->first();
       if($unit){
        $property = Property::where(['added_by_id' => Auth::user()->id,'id'=>$unit->property_id])->first();
       }
       $user_id = Auth::user()->id;
        $property_list = Property::where(['active_property' => true , 'added_by_id'=> $user_id])->get();
        return view('landlord.tenant.create', compact('property_list','unit','property'));

    }
    public function saveTenant(request $request){
        //dd($request->toArray());
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required',
            'phone' => 'required|min:10',
            'address' => 'required',
            // 'secondary_first_name' => 'required',
            // 'secondary_last_name' => 'required',
            'rental_amount' => 'required|regex:/^\$[0-9]{1,3}(,[0-9]{3})*(\.[0-9]{2})?$/',
            'property' => 'required',
            'address' => 'required',
            'unit' => 'required',
            'lease_type' => "required",
            'lease_start_date' => 'required',
            'lease_end_date' => 'required'

        ]);
        
        $date1 = new \DateTime($request->lease_start_date);
        $start = $date1->format('Y-m-d');
        $date2 = new \DateTime($request->lease_end_date);
        $end = $date2->format('Y-m-d');

        $date3 = new \DateTime($request->first_payment_due_date);
        $due_date = $date3->format('Y-m-d');
      

        $property = Property::where('id',$request->property)->first();
        //dd($property->toARray());
        $unit = PropertyUnit::where(['added_by_id' => Auth::user()->id, 'id' => $request->unit])->first();
        
        $user = new User;
        $user->role = 'tenant';
        //$user->username = $request->first_name."".$request->last_name;
        $user->username = $request->username;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->city = $property->city; 
        $user->state = $property->state; 
        $user->zipcode = $property->postal_code;
        $user->password = $request->password;
        $user->status = true;
        $user->unique_id = "T".$this->generateAccountId();
        $user->save();

        $tenant = new Tenant;
        $tenant->user_id = $user->id;
        $tenant->unique_id = $user->unique_id;
        $tenant->added_by_id = Auth::user()->id;
        $tenant->property_id = $request->property;
        $tenant->property_name = $property->property_name;
        $tenant->property_unit = $unit->unit_name;
        $tenant->property_unit_id = $request->unit;
        $tenant->lease_type = $request->lease_type;
        if($request->lease_start_date){
            $tenant->lease_start_date = $start;
        }
        if($request->lease_end_date){
            $tenant->lease_end_date = $end;
        }
        if($request->first_payment_due_date){
            $tenant->first_payment_due_date = $due_date;
        }
        
        $tenant->rental_amount = str_replace(array('$', ','), '', $request->rental_amount);
        $tenant->first_name = $request->first_name;
        $tenant->last_name = $request->last_name;
        $tenant->secondary_first_name = $request->secondary_first_name;
        $tenant->secondary_last_name = $request->secondary_last_name;
        $tenant->email = $request->email;
        $tenant->phone = $request->phone; 
        $tenant->password = '12345678';
        $tenant->address = $request->address;  
        $tenant->rental_status = 'Active';
        $tenant->account_status = 'Current'; 
        $tenant->status = true;
        $tenant->save();

        $unit->booked = true;
        $unit->save(); 
        if($request->view){
            return redirect()->route('landlord.property.view', $request->property)->with('message', 'Tenant saved successfully.');

        }else{
            return redirect()->route('landlord.new.tenant')->with('message', 'Tenant saved successfully.');
        }

    }

    public function deletePhoto($id){

        $tenant = Tenant::where(['id'=> $id])->first();


            if($tenant->image){
                unlink(public_path('landlord/tenants/'.$tenant->image));
            }   
            $tenant->image = '';
        
        $tenant->save();
        return redirect()->back()->with('message', 'Photo removed successfully.');
    }


    public function tenantAdvancedSearchCreate(){
        return view('landlord.tenant.advanced-search');
    }

    public function tenantDashboardSearch(request $request){
        $data = $request;
        return view('landlord.tenant.advanced-search',compact('data'));
    }

    public function tenantAdvancedSearch(request $request){
        
        if($request->ajax()){
            $query = Tenant::query();
            
            if($request->first_name){
                $query->where('first_name', 'like', '%' . $request->first_name . '%');
            }
            if($request->last_name){
                $query->where('last_name', 'like', '%' . $request->last_name . '%');
            }
            if($request->email){
                $query->where('email', 'like', '%' . $request->email . '%');
            }
            if($request->property_name){
                $query->where('tenants.property_name', 'like', '%' . $request->property_name . '%');
            }
            if($request->address){
                $query->where('tenants.address', 'like', '%' . $request->address . '%');
            }
            if($request->phone){
                $query->where('tenants.phone', 'like', '%' . $request->phone . '%');
            }
            if($request->account){
                $query->where('tenants.unique_id', 'like', '%' . $request->account . '%');
            }
            $data = $query->where(['added_by_id' => Auth::user()->id])
                ->select('id','unique_id','property_unit','first_name','last_name','email','property_name','address','phone')
                    ->get();
            // ->join('properties', 'properties.id', '=', 'tenants.property_id')
            //     ->select('tenants.id','tenants.first_name','tenants.last_name','tenants.email','properties.property_name')->get();
            // dd($data->toArray());
            return response()->json(['data'=>$data]);
        }
        
    }
    public function tenantInfo($id = null){
         
        $tenant_info=array();
        if($id == '')
        {   

            if(session()->has('tenant_id') && !empty(session('tenant_id')))
            {
                $sessionId = Session::get('tenant_id');   
                $tenant_info = Tenant::where(['id'=> $sessionId])->first();
                $user = User::where('id',$tenant_info->user_id)->first();
                $popups  = PopupTenant::where(['added_by_id' => Auth::user()->id])->get();
                return view('landlord.tenant-information', compact('tenant_info','user','popups'));
            }
            else
            {
                $popups  = PopupTenant::where(['added_by_id' => Auth::user()->id])->get();
                 return view('landlord.tenant-information', compact('tenant_info','popups'));
            }
        }
        else
        {
           
             $tenant_info = Tenant::where(['id'=> $id])->first();
             $user = User::where('id',$tenant_info->user_id)->first();
             Session::put('tenant_id', $id);

             //storing data into table
             $popups  = PopupTenant::where(['added_by_id' => Auth::user()->id])->get();
            
             if(count($popups) < 8 ){
                $tenant = PopupTenant::where(['tenant_id' => $id])->first();

                if(!$tenant){
                  $new = new PopupTenant;
                  $new->tenant_id = $id;
                  $new->unique_id = $tenant_info->unique_id;
                  $new->added_by_id = Auth::user()->id;
                  $new->save(); 
                }

             }
             $popups  = PopupTenant::where(['added_by_id' => Auth::user()->id])->get();
             
             return view('landlord.tenant-information', compact('tenant_info','user','popups'));
        }     
    }
    public function tenantAdditionalInfo($id = null){
        $tenant_info=array();
        if($id == '')
        {
            if(session()->has('tenant_id') && !empty(session('tenant_id')))
            {
                $sessionId = Session::get('tenant_id');   
                $tenant_info = Tenant::where(['id'=> $sessionId])->first();
                $user = User::where('id',$tenant_info->user_id)->first();
                $popups  = PopupTenant::where(['added_by_id' => Auth::user()->id])->get();
                
                return view('landlord.tenant.tenant-additional-information', compact('tenant_info','user','popups'));
            }
            else
            {   
                $popups  = PopupTenant::where(['added_by_id' => Auth::user()->id])->get();
                 return view('landlord.tenant.tenant-additional-information', compact('tenant_info','popups'));
            }
        }
        else
        {
            
             $tenant_info = Tenant::where(['id'=> $id])->first();
             $user = User::where('id',$tenant_info->user_id)->first();
             Session::put('tenant_id', $id);
             $popups  = PopupTenant::where(['added_by_id' => Auth::user()->id])->get();
             return view('landlord.tenant.tenant-additional-information', compact('tenant_info','user','popups'));
        } 
    }

    public function deleteTenantSession(request $request){
        // echo session('tenant_id');
        // echo $id = $request->id;
        // dd(session()->all()) ;
        $id = $request->id;
        $tenant = PopupTenant::where('tenant_id',$id)->delete();
        session()->forget('tenant_id');
       
        return response()->json(['success'=>"Deleted successfully."]);
    }

    public function tenantEdit($id){
        $tenant = User::where('users.id', $id)
            ->join('tenants as t', 't.user_id', '=', 'users.id')
                ->select('t.id','t.first_name','t.last_name','t.email','t.phone','t.address','t.first_payment_due_date','users.unique_id','users.username','users.zipcode','users.city','users.state','users.country','t.created_at','t.lease_start_date','t.lease_end_date','t.rental_amount','t.status','t.property_name','t.property_unit','t.account_status','t.late_fee','t.rental_status','t.lease_type','t.image')->first();
        // dd($tenant->toArray());
        return view('landlord.tenant.edit',compact('tenant'));
    }

    public function tenantEditAdditional($id){
        $tenant = User::where('users.id', $id)
            ->join('tenants as t', 't.user_id', '=', 'users.id')
                ->select('t.id','t.first_name','t.last_name','t.email','t.phone','t.address','users.unique_id','users.zipcode','users.city','users.state','users.country','t.created_at','t.lease_start_date','t.lease_end_date','t.rental_amount','t.status','t.property_name','t.property_unit','t.account_status','t.late_fee','t.rental_status','t.lease_type','t.image')->first();
        // dd($tenant->toArray());
        return view('landlord.tenant.additional-edit',compact('tenant'));
    }

    public function tenantUpdate(request $request){

        $date1 = new \DateTime($request->lease_start_date);
        $start = $date1->format('Y-m-d');
        $date2 = new \DateTime($request->lease_end_date);
        $end = $date2->format('Y-m-d');

        $date3 = new \DateTime($request->first_payment_due_date);
        $due_date = $date3->format('Y-m-d');
      //echo  date('Y-m-d',strtotime($request->lease_end_date));
     //dd($request->toArray());

        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            // 'email' => 'required|unique:users',
            'phone' => 'required|min:10',
            'address' => 'required',
            // 'secondary_first_name' => 'required',
            // 'secondary_last_name' => 'required',
            // 'rental_amount' => 'required',
            // 'property' => 'required',
            // 'address' => 'required',
            'unit_number' => 'required',
            'lease_type' => "required"
        ]);
        
        $tenant = Tenant::where(['id'=> $request->id])->first();

        if($request->rental_status == 'Active' && $tenant->rental_status == 'Expired'){
            return redirect()->back()->with('message', 'this unit has been deactivated. To make this tenant active you must register the tenant to a different unit');
        }

        $tenant->first_name = $request->first_name;
        $tenant->last_name = $request->last_name;
        $tenant->address = $request->address; 
        $tenant->added_by_id = Auth::user()->id;
        $tenant->property_unit = $request->unit_number;
        $tenant->email = $request->email;
        $tenant->phone = $request->phone; 
        // $tenant->lease_start_date = $start;
        // $tenant->lease_end_date = $end;
        if($request->lease_start_date){
            $tenant->lease_start_date = $start;
        }
        if($request->lease_end_date){
            $tenant->lease_end_date = $end;
        }
        if($request->first_payment_due_date){
            $tenant->first_payment_due_date = $due_date;
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

        // if($files = $request->file('file')) {

        //     if($tenant->image){
        //         unlink(public_path('landlord/tenants/'.$tenant->image));
        //     }   
        //     //$image = $request->file('edit_image');
        //     //$request->image->move(public_path('images'), $imageName);
        //     $destinationPath = 'public/landlord/tenants/'; // upload path
        //     $image = time() . "." . $files->getClientOriginalExtension();
        //     $request->file->move(public_path('landlord/tenants'), $image);
        //     $tenant->image = $image;
            
        // }  

        if($request->cropped_image) {
            if($tenant->image){
                unlink(public_path('landlord/tenants/'.$tenant->image));
            }

            $data = $request->cropped_image;
            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
    
            $image_name = time() . '.png';
            $image_path = public_path('landlord/tenants') . '/' . $image_name;
    
            file_put_contents($image_path, $data);
    
            $tenant->image = $image_name;
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

        return redirect()->route('landlord.tenant-information')->with('message', 'Tenant updated successfully.');

    }
}
