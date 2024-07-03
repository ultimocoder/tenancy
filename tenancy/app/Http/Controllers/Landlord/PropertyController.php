<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PropertyType;
use App\Models\Property;
use App\Models\PropertyUnit;
use App\Models\Tenant;
use App\Models\Subscription;
use App\Models\PackagePrice;
use App\Models\Package;
use auth;

class PropertyController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }

     public function fetchPropertyUnit(request $request){
        $data['props'] = PropertyUnit::where(["property_id"=> $request->prop_id, 'booked'=>false ])
        ->get();
        $data['property'] = Property::where(['id' => $request->prop_id])->first();

        return response()->json($data);
    }

    // public function index(){
    //     $property = Property::where('added_by_id', Auth::user()->id)->get();
    //     return view('landlord.property.list',compact('property'));
    // }

    public function list(){
        $property = Property::where('added_by_id', Auth::user()->id)->get();
        $property_slug = 'Properties';
        return view('landlord.property.list',compact('property','property_slug'));
    }
    public function view(){
        $property = Property::where('added_by_id', Auth::user()->id)->get();
        $property_slug = 'View Property';
        return view('landlord.property.list',compact('property','property_slug'));
    }
    public function edit(){
        $property = Property::where('added_by_id', Auth::user()->id)->get();
        $property_slug = 'Edit Property';
        return view('landlord.property.list',compact('property','property_slug'));
    }

    public function createProperty(){
        $property_types = PropertyType::where('property_type_status',true)->get();
        $user = Auth::user();
        $subscription = Subscription::where(['user_id'=>$user->id, 'current_status' => 'active'])->first();
        if($subscription){
          $pacakge_price  =  PackagePrice::where(['price_id' => $subscription->stripe_price])->first();
          $package = Package::where(['id'=> $pacakge_price->package_id])->first();
          //dd($package->toArray());
        }
        return view('landlord.property.create',compact('property_types','package','subscription'));
    }

    public function saveProperty(request $request){
        $validated = $request->validate([
            'property_nickname' => 'required',
        ]);
       
       $subscription= Subscription::where(['user_id' => Auth::user()->id, 'current_status' => 'active'])->first();
        $units = PropertyUnit::where(['added_by_id' => Auth::user()->id])->get();
        
        if(count($units) >= $subscription->quantity){
            return redirect()->route('landlord.property.create')->with('error', 'Please upgrade your plan for adding more units.');
        }
        
        //echo $request->kitchen_unit_1;
        //dd($request->toARray());
        $property = new Property;
        $property->added_by_id = Auth::user()->id;
        $property->property_name = $request->property_nickname;
        $property->property_type_id = $request->property_type;
        $property->address = $request->address;
        $property->city = $request->city;
        $property->state = $request->state;
        $property->postal_code = $request->postal_code;

        // if($request->status){
            $property->active_property = true;
        // }

        $property->save();
        
        $count = count($request->unit);
        // dd($count);
        if($count > 0){
            for($i=0; $i < $count; $i++){
                if($i < $count - count($units) ){
                
                $pu = new PropertyUnit;
                $pu->added_by_id = Auth::user()->id;
                $pu->property_id = $property->id;
                $pu->unit_name = $request->unit[$i];
                $pu->room = $request->unit_number[$i];
                $pu->sqfeet = $request->sqft[$i];
                //$pu->kitchen = $request->kitchen_unit_."".$j;

                $kitchen = "kitchen_unit_".$i+1;
                $bathroom = "bathroom_unit_".$i+1;

                $pu->kitchen = $request->$kitchen;
                $pu->bathroom = $request->$bathroom;
                $pu->save();
                }
               
            } 
        }


        return redirect()->route('landlord.property')->with('message', 'Property saved successfully.');
    }

    public function editProperty($id){
      $property = Property::where('id', $id)->first();
      $property_unit = PropertyUnit::where('property_id', $id)->get();
      $property_types = PropertyType::where('property_type_status',true)->get();
      $tenants = Tenant::where(['added_by_id'=> Auth::user()->id])->get();
      $user = Auth::user();
      $subscription = Subscription::where(['user_id'=>$user->id, 'current_status' => 'active'])->first();
        if($subscription){
          $pacakge_price  =  PackagePrice::where(['price_id' => $subscription->stripe_price])->first();
          $package = Package::where(['id'=> $pacakge_price->package_id])->first();
          //dd($package->toArray());
        }

      return view('landlord.property.edit',compact('property','property_types','property_unit','tenants','package','subscription'));
    }

    public function updateProperty(request $request){
        $subscription= Subscription::where(['user_id' => Auth::user()->id, 'current_status' => 'active'])->first();
    $units = PropertyUnit::where(['added_by_id' => Auth::user()->id])->get();
    
    if(count($units) >= $subscription->quantity){
        return redirect()->back()->with('error', 'Please upgrade your plan for adding more units.');
    }

    //dd($request->toARray());
        $property = Property::where('id', $request->id)->first();
        $property->added_by_id = Auth::user()->id;
        $property->property_name = $request->property_nickname;
        $property->property_type_id = $request->property_type;
        $property->address = $request->address;
        $property->city = $request->city;
        $property->state = $request->state;
        $property->postal_code = $request->postal_code;

        if($request->status){
            $property->active_property = true;
        }else{
            if($request->checkTenantInProperty){
                return redirect()->back()->with('error', 'You can not mark this property Inactive while tenants are registered to units in the property.');
            }
            $property->active_property = false;
        }

        $property->save();

        
        //old propertyunit delete
        // $unit = PropertyUnit::where('property_id',$request->id)->get();

        // if(count($unit)> 0){
        //     foreach($unit as $u){
        //         $u->delete();
        //     }
        // }
        if($request->unitid){
           $count = count($request->unitid);
        //dd($count);
        $changeArrayIndexKitchen = array_values($request->kitchen_unit);
        $changeArrayIndexBathroom = array_values($request->bathroom_unit);
        
        if($count > 0){
            for($i=0; $i < $count; $i++){
                if($request->unitid[$i] != null)
                {
                    $pu = PropertyUnit::where(['added_by_id' => Auth::user()->id, 'id' => $request->unitid[$i]])->first();
                    $pu->added_by_id = Auth::user()->id;
                    $pu->property_id = $property->id;
                    $pu->unit_name = $request->unit[$i];
                    $pu->room = $request->unit_number[$i];
                    $pu->sqfeet = $request->sqft[$i];
                    //$pu->kitchen = $request->kitchen_unit_."".$j;
    
                    // $kitchen = "kitchen_unit_".$i+1;
                    //$bathroom = "bathroom_unit_".$i+1;
    
                    $pu->kitchen = $changeArrayIndexKitchen[$i];
                    $pu->bathroom = $changeArrayIndexBathroom[$i];
                    $pu->save();
                }
                else
                {
                    $pu = new PropertyUnit;
                    $pu->added_by_id = Auth::user()->id;
                    $pu->property_id = $property->id;
                    $pu->unit_name = $request->unit[$i];
                    $pu->room = $request->unit_number[$i];
                    $pu->sqfeet = $request->sqft[$i];
                    //$pu->kitchen = $request->kitchen_unit_."".$j;

                    // $kitchen = "kitchen_unit_".$i+1;
                    //$bathroom = "bathroom_unit_".$i+1;

                    $pu->kitchen = $changeArrayIndexKitchen[$i];
                    $pu->bathroom = $changeArrayIndexBathroom[$i];
                    $pu->save();
                }
                // $pu = new PropertyUnit;
                // $pu->added_by_id = Auth::user()->id;
                // $pu->property_id = $property->id;
                // $pu->unit_name = $request->unit[$i];
                // $pu->room = $request->unit_number[$i];
                // $pu->sqfeet = $request->sqft[$i];
                // //$pu->kitchen = $request->kitchen_unit_."".$j;

                // // $kitchen = "kitchen_unit_".$i+1;
                // //$bathroom = "bathroom_unit_".$i+1;

                // $pu->kitchen = $changeArrayIndexKitchen[$i];
                // $pu->bathroom = $changeArrayIndexBathroom[$i];
                // $pu->save();
               
            } 
        }
        }
        

        

        return redirect()->route('landlord.edit.property')->with('message', 'Property updated successfully.');

    }

    public function viewPropertyUnit($id){
        $property = Property::where(['id'=> $id, 'added_by_id' => Auth::user()->id])->first();
        $property_unit = PropertyUnit::where(['property_id' => $id, 'added_by_id' => Auth::user()->id])->get();
        $property_types = PropertyType::where('property_type_status',true)->get();
        $tenants = Tenant::where(['property_id'=> $property->id ,'added_by_id' => Auth::user()->id])->get();
        //dd($tenants->toArray());
        //dd($property_unit->toArray());
        return view('landlord.property.view-property-unit',compact('property','property_types','property_unit','tenants'));
      }

    public function deletePropertyUnit(request $request){
        // dd($request->toArray());
        $id = $request->id;
        $docs = PropertyUnit::where('id',$id)->delete();
       
        return response()->json(['success'=>"Deleted successfully."]);
    }
    
    public function deactivateUnit($unit_id){
        $property_unit = PropertyUnit::where(['id' => $unit_id, 'added_by_id' => Auth::user()->id])->first();
        //$tenant = Tenant::where(['added_by_id' => Auth::user()->id,'property_unit_id' => $unit_id])->first();
        if($property_unit->status){
            $property_unit->status = false;
            $property_unit->save();
        return redirect()->back()->with('message', 'Unit deactivated successfully.');
        }else{
            $property_unit->status = true;
            $property_unit->save();
            return redirect()->back()->with('message', 'Unit activated successfully.');
        }
        
        
    }
}
