<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Invitation;


class InvitationController extends Controller
{
    public function show($slug)
    {
        $invitation = Invitation::with('galleries')->where('slug', $slug)->firstOrFail();
        
        $view = 'themes.' . $invitation->template;
        if (!view()->exists($view)) {
            $view = 'themes.elegant';
        }

        return view($view, compact('invitation'));
    }
}
