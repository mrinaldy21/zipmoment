<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Invitation;
use App\Models\Guest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class GuestController extends Controller
{
    use AuthorizesRequests;

    public function index(Invitation $invitation)
    {
        // client & admin boleh lihat invitation miliknya
        $this->authorize('view', $invitation);

        $guests = $invitation->guests()->latest()->paginate(20);
        return view('dashboard.guests.index', compact('invitation', 'guests'));
    }

    public function store(Request $request, Invitation $invitation)
    {
        // cukup view saja (bukan update)
        $this->authorize('view', $invitation);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $invitation->guests()->create([
            'guest_name' => $request->name,
        ]);

        return back()->with('success', 'Guest added successfully.');
    }

    public function destroy(Invitation $invitation, Guest $guest)
    {
        $this->authorize('view', $invitation);

        if ($guest->invitation_id !== $invitation->id) {
            abort(403);
        }

        $guest->delete();
        return back()->with('success', 'Guest removed successfully.');
    }
}

