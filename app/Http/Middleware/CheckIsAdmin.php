<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if ($user && !$user->isAdministrator()) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
