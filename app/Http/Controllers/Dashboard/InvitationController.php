<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\CloudinaryService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class InvitationController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $invitations = auth()->user()->invitations()->latest()->paginate(10);
        return view('dashboard.invitations.index', compact('invitations'));
    }

    public function show(Invitation $invitation)
    {
        $this->authorize('view', $invitation);
        return view('dashboard.invitations.show', compact('invitation'));
    }
}
