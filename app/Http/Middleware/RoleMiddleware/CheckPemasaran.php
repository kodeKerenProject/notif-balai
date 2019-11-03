<?php

namespace App\Http\Middleware\RoleMiddleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPemasaran
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user()->role()->first();
        if ($user->role == 'pemasaran') {
            return $next($request);
        } else {
            return redirect()->back();
        }
    }
}
