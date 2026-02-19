<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Invitation;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Invitation $invitation)
    {
        $events = $invitation->events;
        return view('admin.events.index', compact('invitation', 'events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request, Invitation $invitation)
    {
        $request->validate([
            'event_type' => 'required|string|max:255',
            'date' => 'nullable|date',
            'start_time' => 'nullable|string|max:255',
            'end_time' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'maps_link' => 'nullable|url',
            'sort_order' => 'nullable|integer',
        ]);

        $data = $request->all();
        $data['invitation_id'] = $invitation->id;

        Event::create($data);

        return back()->with('success', 'Event added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'event_type' => 'required|string|max:255',
            'date' => 'nullable|date',
            'start_time' => 'nullable|string|max:255',
            'end_time' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'maps_link' => 'nullable|url',
            'sort_order' => 'nullable|integer',
        ]);

        $event->update($request->all());

        return back()->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return back()->with('success', 'Event deleted successfully.');
    }
}
