<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\PackageFeature;

class PackagePriceController extends Controller
{
    public function index($id){
        $package = Package::where('status', true)->get();
        $packageFeatures = PackageFeature::where('status', true)->get();
        $package_id = $id;
        return view('front.plan_pricing', compact('package','packageFeatures','package_id'));
    }

    public function plan($id){
        $package = Package::where('status', true)->get();
        $packageFeatures = PackageFeature::where('status', true)->get();
        $package_id = $id;
        return view('front.sign_up_plan', compact('package','packageFeatures','package_id'));
        }  
}
