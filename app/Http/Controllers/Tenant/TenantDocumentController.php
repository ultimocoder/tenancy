<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Tenant;
use App\Models\User;
use auth;

class TenantDocumentController extends Controller
{
    public function documents()
    {
        $tenant_info = Tenant::where(['user_id'=> Auth::user()->id])->first();
        $document_info = Document::where('tenant_id', $tenant_info->id)
                                    ->where('share', '1')
                                    ->get();
        return view('tenant.document.document', compact('document_info'));
    }
    
}
