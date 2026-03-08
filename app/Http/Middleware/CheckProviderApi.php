<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckProviderApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('api')->user();

        if ($user->is_provider == 1) {
            if ($user->status == 1) {
                return $next($request);
            } else {
                return response()->json([
                    'message' => 'Your account is not active. Please contact with admin.',
                    'status'  => false,
                ]);
            }
        } else {
            return response()->json([
                'message' => 'You are not a provider.',
                'status'  => false,
            ]);
        }

    }
}
