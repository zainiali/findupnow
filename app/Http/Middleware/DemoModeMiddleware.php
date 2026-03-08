<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class DemoModeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Route::is('admin.store-login') || Route::is('store-login') || Route::is('admin.logout') || Route::is('send-message-to-provider') || Route::is('provider.send-message-to-buyer') || Route::is('get-available-schedule')) {
            return $next($request);
        } else {
            if (env('APP_MODE') == 'DEMO') {
                if ($request->isMethod('post') || $request->isMethod('delete') || $request->isMethod('put') || $request->isMethod('patch')) {

                    if ($request->ajax()) {
                        return response()->json(['message' => 'This Is Demo Version. You Can Not Change Anything'], 403);
                    } else {

                        $notification = __('This Is Demo Version. You Can Not Change Anything');
                        $notification = ['message' => $notification, 'alert-type' => 'error'];
                        return redirect()->back()->with($notification);
                    }
                }
                if (Route::is('user.remove-wishlist')) {

                    if ($request->ajax()) {
                        return response()->json(['message' => 'This Is Demo Version. You Can Not Change Anything'], 403);
                    } else {

                        $notification = __('This Is Demo Version. You Can Not Change Anything');
                        $notification = ['message' => $notification, 'alert-type' => 'error'];
                        return redirect()->back()->with($notification);
                    }

                }
            }
        }
        return $next($request);
    }
}
