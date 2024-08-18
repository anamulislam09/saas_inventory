<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use App\Services\AuthorizationService;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')->with('error', 'Please Login First...');
        }

        $authorizationService = App::make(AuthorizationService::class);
        $authorizationService->isAuthorized();

        return $next($request);
    }
}
