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
        
        // Template Tier Enforcement
        if ($invitation->isBasic()) {
            // Basic can only use elegant or minimalist
            if (!in_array($invitation->template, ['elegant', 'minimalist'])) {
                $view = 'themes.elegant';
            }
        } elseif ($invitation->isPremium() && !$invitation->isExclusive()) {
            // Premium can use all except cinematic and modern (Exclusive)
            if (in_array($invitation->template, ['cinematic', 'modern'])) {
                $view = 'themes.elegant';
            }
        }

        if (!view()->exists($view)) {
            $view = 'themes.elegant';
        }

        $isDemo = str_starts_with($invitation->slug, 'demo-');

        return view($view, compact('invitation', 'guest', 'isDemo'));
    }
}
