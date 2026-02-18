<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\GuestMessage;
use Illuminate\Http\Request;

class GuestMessageController extends Controller
{
    public function store(Request $request, Invitation $invitation)
    {
        // 1. Read guest name from parameter (passed via hidden field for POST stability)
        $guestName = $request->input('guest_name');

        // 2. If no guest name → reject
        if (empty($guestName)) {
            return back()->with('error', 'Hanya tamu undangan yang dapat memberikan ucapan.');
        }

        // 3. Validation
        $request->validate([
            'message' => 'required|string|max:500',
        ]);

        // 4. Anti-spam: 1 message per guest per invitation
        $exists = GuestMessage::where('invitation_id', $invitation->id)
            ->where('guest_name', $guestName)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Anda sudah memberikan ucapan sebelumnya. Terima kasih!');
        }

        // 5. Save message
        GuestMessage::create([
            'invitation_id' => $invitation->id,
            'guest_name' => $guestName,
            'message' => strip_tags($request->message),
        ]);

        return back()->with('success', 'Terima kasih atas ucapan dan doanya!');
    }
}
