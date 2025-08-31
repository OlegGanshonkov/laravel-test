<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserImitationController extends Controller
{
    public function start(User $user)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        if ($user->isAdmin()) {
            return redirect()->route('dashboard')->with('error', 'Cannot impersonate other administrators.');
        }

        session()->put('admin_user_imitation_id', auth()->id());

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Hello ' . $user->name);
    }

    public function stop()
    {
        if (!session()->has('admin_user_imitation_id')) {
            return redirect()->route('dashboard');
        }

        $admin = User::find(session('admin_user_imitation_id'));

        Auth::logout();

        session()->forget('admin_user_imitation_id');

        Auth::login($admin);

        return redirect()->route('dashboard')->with('success', 'Hello ' . $admin->name);
    }
}
