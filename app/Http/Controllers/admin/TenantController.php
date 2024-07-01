<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant;


class TenantController extends Controller
{
    public function tenant_info(){
        $tenant = Tenant::all();
        return view('admin/Tenantinfo/tenantinformation', compact('tenant'));
    }
    public function tenant_info_view($id)
    {
        $tenant = Tenant::where('id', $id)->first();
        return view('admin/Tenantinfo/tenantinfoview', compact('tenant'));

    }
   

}
