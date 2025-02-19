<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // dd('ok');
        if (!Auth::check()) {
            return redirect()->route('login'); 
        }

        $user = Auth::user(); 

        switch ($user->role) {
            case 'Admin':
                return $next($request);
            case 'User':
                return redirect()->route('user.dashboard');
            case 'Shop':
                return redirect()->route('dashboard.index');
            default:
                Auth::logout(); 
                return redirect()->route('login')->with('error', 'Vai trò không hợp lệ.'); 
        }
    }
}
