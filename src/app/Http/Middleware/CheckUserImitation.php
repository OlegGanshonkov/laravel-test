<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserImitation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return $next($request);
        }

        if (session()->has('admin_user_imitation_id')) {
            $admin = User::find(session('admin_user_imitation_id'));

            if (!$admin || !$admin->isAdmin()) {
                Auth::logout();
                session()->invalidate();
                return redirect('/login');
            }

            if (auth()->user()->isAdmin()) {
                session()->forget('admin_user_imitation_id');
            }
        }

        return $next($request);
    }
}
