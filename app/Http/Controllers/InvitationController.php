<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Invitation;


class InvitationController extends Controller
{
    public function show(Request $request, $slug)
    {
        $invitation = Invitation::with(['galleries', 'messages' => function($query) {
            $query->latest();
        }])->where('slug', $slug)->firstOrFail();
        
        $guest = $request->query('to');
        
        $view = 'themes.' . $invitation->template;
        if (!view()->exists($view)) {
            $view = 'themes.elegant';
        }

        return view($view, compact('invitation', 'guest'));
    }
}
