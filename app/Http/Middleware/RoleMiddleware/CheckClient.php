<?php

namespace App\Http\Middleware\RoleMiddleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckClient
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user()->role()->first();
        if ($user->role == 'client') {
            return $next($request);
        } else {
            return redirect()->back();
        }
    }
}
