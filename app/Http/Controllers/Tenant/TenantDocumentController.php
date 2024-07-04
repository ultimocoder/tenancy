<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TenantDocumentController extends Controller
{
    public function documents()
    {
       
        return view('tenant.document.document');
    }
}
