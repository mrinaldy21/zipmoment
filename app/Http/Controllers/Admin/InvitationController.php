<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invitation;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    public function index()
    {
        $invitations = Invitation::latest()->paginate(10);
        return view('admin.invitations.index', compact('invitations'));
    }

    public function create()
    {
        return view('admin.invitations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'groom_name' => 'required|string|max:255',
            'groom_description' => 'nullable|string|max:255',
            'groom_child_number' => 'nullable|integer|min:1',
            'groom_total_siblings' => 'nullable|integer|min:1',
            'groom_father_name' => 'nullable|string|max:255',
            'groom_mother_name' => 'nullable|string|max:255',
            'bride_name' => 'required|string|max:255',
            'bride_description' => 'nullable|string|max:255',
            'bride_child_number' => 'nullable|integer|min:1',
            'bride_total_siblings' => 'nullable|integer|min:1',
            'bride_father_name' => 'nullable|string|max:255',
            'bride_mother_name' => 'nullable|string|max:255',
            'event_date' => 'required|date',
            'event_location' => 'required|string',
            'map_link' => 'nullable|url',
            'cover_photo' => 'nullable|image|max:2048',
            'template' => 'required|in:elegant,floral,modern',
            'gallery.*' => 'image|max:2048',
        ]);

        $data = $request->except(['cover_photo', 'gallery']);
        $data['slug'] = Str::slug($request->title) . '-' . Str::random(5);

        if ($request->hasFile('cover_photo')) {
            $data['cover_photo'] = $request->file('cover_photo')->store('covers', 'public');
        }

        $invitation = Invitation::create($data);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $photo) {
                $path = $photo->store('galleries', 'public');
                $invitation->galleries()->create(['photo_path' => $path]);
            }
        }

        return redirect()->route('admin.invitations.index')->with('success', 'Invitation created successfully.');
    }

    public function edit(Invitation $invitation)
    {
        return view('admin.invitations.edit', compact('invitation'));
    }

    public function update(Request $request, Invitation $invitation)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'groom_name' => 'required|string|max:255',
            'groom_description' => 'nullable|string|max:255',
            'groom_child_number' => 'nullable|integer|min:1',
            'groom_total_siblings' => 'nullable|integer|min:1',
            'groom_father_name' => 'nullable|string|max:255',
            'groom_mother_name' => 'nullable|string|max:255',
            'bride_name' => 'required|string|max:255',
            'bride_description' => 'nullable|string|max:255',
            'bride_child_number' => 'nullable|integer|min:1',
            'bride_total_siblings' => 'nullable|integer|min:1',
            'bride_father_name' => 'nullable|string|max:255',
            'bride_mother_name' => 'nullable|string|max:255',
            'event_date' => 'required|date',
            'event_location' => 'required|string',
            'map_link' => 'nullable|url',
            'cover_photo' => 'nullable|image|max:2048',
            'template' => 'required|in:elegant,floral,modern',
            'gallery.*' => 'image|max:2048',
        ]);

        $data = $request->except(['cover_photo', 'gallery']);
        // Keep slug same or regenerate if title changes? better keep same or make editable. I'll invoke simple update.

        if ($request->hasFile('cover_photo')) {
            if ($invitation->cover_photo) {
                Storage::disk('public')->delete($invitation->cover_photo);
            }
            $data['cover_photo'] = $request->file('cover_photo')->store('covers', 'public');
        }

        $invitation->update($data);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $photo) {
                $path = $photo->store('galleries', 'public');
                $invitation->galleries()->create(['photo_path' => $path]);
            }
        }

        return redirect()->route('admin.invitations.index')->with('success', 'Invitation updated successfully.');
    }

    public function destroy(Invitation $invitation)
    {
        if ($invitation->cover_photo) {
            Storage::disk('public')->delete($invitation->cover_photo);
        }

        foreach ($invitation->galleries as $gallery) {
            Storage::disk('public')->delete($gallery->photo_path);
            $gallery->delete();
        }

        $invitation->delete();

        return redirect()->route('admin.invitations.index')->with('success', 'Invitation deleted successfully.');
    }

    public function destroyGallery(Gallery $gallery)
    {
        // Delete file from storage
        if ($gallery->photo_path) {
            Storage::disk('public')->delete($gallery->photo_path);
        }

        // Delete record from database
        $gallery->delete();

        return response()->json(['success' => true, 'message' => 'Photo deleted successfully.']);
    }
}
