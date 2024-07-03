<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyUnit;
use Auth;

class PropertyController extends Controller
{
    public function properties(){
        $property = Property::all();
       
        return view('admin/Properties/propertie', compact('property'));
    }
    public function new_properties ()
    {
        return view('admin/Properties/new_properties');

    }

    public function property_edit($id)
    {
         $property = Property::where('id', $id)->first();
        //  $unit = Unit::where('property_id', $id)->get();

        return view('admin.Properties.property_edit', compact('property'));
    }
    public function property_view($id)
    {
         $property = Property::where('id', $id)->first();
         $unit = PropertyUnit::where('property_id', $id)->get();
        //  dd($unit);
             return view('admin.Properties.property_view', compact('property','unit'));
    
    }
    public function property_register(Request $request)
    {
    $user = Auth::user();
    //  dd($user->id);
        $validated = $request->validate([
           
            'property_name' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'state' => 'required',
            'property_type' => 'required',
            // 'status' => 'required',

            'unitnum' => 'required',
            'room' => 'required',
            // 'kitchen' => 'required',
            // 'bathroom' => 'required',
            'sqft' => 'required',
            
        ]);

        $post = new Property;
        $post->added_by_id =  $user->id;
        $post->property_name = $request->property_name;
        $post->address = $request->address;
        $post->property_type_id = $request->property_type;
        $post->city = $request->city;
        $post->state = $request->state;
        $post->postal_code = $request->postal_code;
        $post->active_property = $request->status;
        $post->save();

        $property_id = Property::latest()->first()->id;

        $results = [];
        $unit_number=$request->unitnum;
        $room = $request->room;
        $kitchen=$request->kitchen;
        $bathroom=$request->bathroom;
        $sqft=$request->sqft;
        foreach ($unit_number as $index => $unit) {
            $results[] = [
                "property_id"=> $property_id,

                    "unit_name" => $unit_number[$index],
                    "room" => $room[$index],
                    "kitchen" => $kitchen[$index],
                    "bathroom" => $bathroom[$index],
                    "sqft" => $sqft[$index],
                    'created_at' => now(), // this could be in model events / observers
                    'updated_at' => now()
                ];
            
        }
        Unit::insert($results);
       return redirect('properties');
    }
    public function property_update(Request $request,$id)
    {

        //  dd($id);
         $validated = $request->validate([
           
            'property_name' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'state' => 'required',
            'property_type' => 'required',
            'status' => 'required',
            
        ]);
        $user = Auth::user();
        $post = Property::where('id',$id)->first();
    // dd($post);
    $post->added_by_id =  $user->id;
        $post->property_name = $request->property_name;
        $post->address = $request->address;
        $post->property_type_id = $request->property_type;
        $post->city = $request->city;
        $post->state = $request->state;
        $post->postal_code = $request->postal_code;
        $post->active_property = $request->status;
        $post->Update();

        // $property_id = Property::latest()->first()->id;
        Unit::where('property_id', $id)->delete();

        $results = [];
        $unit_number=$request->unit_num;
        $room = $request->room;
        $kitchen=$request->kitchen;
        $bathroom=$request->bathroom;
        $sqft=$request->sqft;
        foreach ($unit_number as $index => $unit) {
            $results[] = [
                "property_id"=> $id,
                    "unit_name" => $unit_number[$index],
                    "room" => $room[$index],
                    "kitchen" => $kitchen[$index],
                    "bathroom" => $bathroom[$index],
                    "sqft" => $sqft[$index],
                    'created_at' => now(), // this could be in model events / observers
                    'updated_at' => now()
                ];
        }
        Unit::insert($results);
       return redirect('properties');
    }

}
