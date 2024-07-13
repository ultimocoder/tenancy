<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Correspondence extends Controller
{
   public function correspondence()
   {
     return view('tenant.correspondence.correspondence');
   }
}
