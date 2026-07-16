<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        // Karena role ada 3 berdasarkan enum
        $totalRoles = 3;
        $user = Auth::user() ?? (object)[
            'name' => 'Guest',
            'email' => '-',
            'role' => '-',
            'status' => '-',
            'phone' => '-',
        ];

        return view('dashboard', compact('totalUsers', 'totalRoles', 'user'));
    }
}
