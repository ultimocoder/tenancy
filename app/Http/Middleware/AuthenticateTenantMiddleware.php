<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\User;

class AuthenticateTenantMiddleware
{
    public function handle(Request $request, Closure $next)
    {
                if (Auth::Check()) {
                    return $next($request);
        
        }else{
            return redirect('tenant/login');
        }
    }
}
