<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckForCreditLine
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
                
            // List of layouts to check
            $layouts = ['admin_panel._layout', 'student._layout', 'login'];

            // Loop through each layout and check for the credit line
            foreach ($layouts as $layout) {
                $layoutContent = view($layout)->render(); // Render each layout
                
                if (strpos($layoutContent, 'Designed and Developed by <b><q>Muhammad Azam</q></b>') === false) {
                    // If not present in any layout, abort with a 403 Forbidden error
                    abort(403, 'Unauthorized modification detected.');
                }
            }
        }

        return $next($request);
    }
}
