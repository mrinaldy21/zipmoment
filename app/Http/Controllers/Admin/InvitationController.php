<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invitation;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


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
            $uploaded = Cloudinary::upload($request->file('cover_photo')->getRealPath(), [
                'folder' => 'zipmoment/covers'
            ]);
            $data['cover_photo'] = $uploaded->getSecurePath();
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
            // tidak perlu delete storage lokal lagi

            $uploaded = Cloudinary::upload($request->file('cover_photo')->getRealPath(), [
                'folder' => 'zipmoment/covers'
            ]);

            $data['cover_photo'] = $uploaded->getSecurePath();
        }


        $invitation->update($data);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $photo) {
                $uploaded = Cloudinary::upload($photo->getRealPath(), [
                    'folder' => 'zipmoment/galleries'
                ]);

                $invitation->galleries()->create([
                    'photo_path' => $uploaded->getSecurePath()
                ]);
            }

        }

        return redirect()->route('admin.invitations.index')->with('success', 'Invitation updated successfully.');
    }

    public function destroy(Invitation $invitation)
    {
        // tidak perlu hapus file storage lokal lagi

        foreach ($invitation->galleries as $gallery) {
            $gallery->delete();
        }

        $invitation->delete();

        return redirect()->route('admin.invitations.index')
            ->with('success', 'Invitation deleted successfully.');
    }

    public function destroyGallery(Gallery $gallery)
    {
        // sementara hanya hapus dari database
        $gallery->delete();

        return response()->json([
            'success' => true,
            'message' => 'Photo deleted successfully.'
        ]);
    }

}
