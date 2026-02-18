<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_invitations' => auth()->user()->invitations()->count(),
            'plan' => auth()->user()->subscription->plan_name ?? 'free',
            'can_create' => auth()->user()->canCreateInvitation(),
        ];

        return view('dashboard', compact('stats'));
    }
}
