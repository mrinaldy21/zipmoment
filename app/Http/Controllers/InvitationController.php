<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Invitation;


class InvitationController extends Controller
{
    public function show(Request $request, $slug)
    {
        $invitation = Invitation::with(['galleries', 'loveStories', 'events' => function($q) {
            $q->orderBy('sort_order');
        }, 'messages' => function($query) {
            $query->latest();
        }])->where('slug', $slug)->firstOrFail();
        
        $guest = $request->query('to');
        
        $view = 'themes.' . $invitation->template;
        
        // Template Tier Enforcement: Basic only gets Elegant (Standard)
        if ($invitation->isBasic() && in_array($invitation->template, ['floral', 'modern'])) {
            $view = 'themes.elegant';
        }

        if (!view()->exists($view)) {
            $view = 'themes.elegant';
        }

        return view($view, compact('invitation', 'guest'));
    }
}
