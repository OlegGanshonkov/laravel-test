<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $users = [];

        if (auth()->user()->isAdmin()) {
            $users = User::getList();
        }

        return view('dashboard', compact('users'));
    }
}
