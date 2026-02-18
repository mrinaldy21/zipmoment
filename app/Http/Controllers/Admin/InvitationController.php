<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invitation;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Support\Str;
use App\Services\CloudinaryService;


class InvitationController extends Controller
{
    protected $cloudinary;

    public function __construct(CloudinaryService $cloudinary)
    {
        $this->cloudinary = $cloudinary;
    }
    public function index()
    {
        $invitations = Invitation::latest()->paginate(10);
        return view('admin.invitations.index', compact('invitations'));
    }

    public function create()
    {
        $clients = User::where('role', 'client')->get();
        return view('admin.invitations.create', compact('clients'));
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
            'user_id' => 'required|exists:users,id',
        ]);

        try {
            $data = $request->except(['cover_photo', 'gallery']);
            $data['slug'] = Str::slug($request->title) . '-' . Str::random(5);

            if ($request->hasFile('cover_photo')) {
                $data['cover_photo'] = $this->cloudinary->upload(
                    $request->file('cover_photo'), 
                    'zipmoment/covers'
                );
            }

            // user_id is now taken from request validation
            $invitation = Invitation::create($data);

            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $photo) {
                    $url = $this->cloudinary->upload($photo, 'zipmoment/galleries');
                    if ($url) {
                        $invitation->galleries()->create([
                            'photo_path' => $url
                        ]);
                    }
                }
            }

            return redirect()->route('admin.invitations.index')->with('success', 'Invitation created successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Upload failed: ' . $e->getMessage());
        }
    }

    public function edit(Invitation $invitation)
    {
        $clients = User::where('role', 'client')->get();
        return view('admin.invitations.edit', compact('invitation', 'clients'));
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
            'user_id' => 'required|exists:users,id',
        ]);

        try {
            $data = $request->except(['cover_photo', 'gallery']);

            if ($request->hasFile('cover_photo')) {
                $data['cover_photo'] = $this->cloudinary->upload(
                    $request->file('cover_photo'), 
                    'zipmoment/covers'
                );
            }

            $invitation->update($data);

            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $photo) {
                    $url = $this->cloudinary->upload($photo, 'zipmoment/galleries');
                    if ($url) {
                        $invitation->galleries()->create([
                            'photo_path' => $url
                        ]);
                    }
                }
            }

            return redirect()->route('admin.invitations.index')->with('success', 'Invitation updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Update failed: ' . $e->getMessage());
        }
    }

    public function destroy(Invitation $invitation)
    {
        // Safe delete: only delete database records for now
        // Deleting from Cloudinary requires more complex logic to get public_id
        foreach ($invitation->galleries as $gallery) {
            $gallery->delete();
        }

        $invitation->delete();

        return redirect()->route('admin.invitations.index')->with('success', 'Invitation deleted successfully.');
    }

    public function destroyGallery(Gallery $gallery)
    {
        // Delete record from database
        $gallery->delete();

        return response()->json(['success' => true, 'message' => 'Photo removed from record successfully.']);
    }

    public function showPublic(Invitation $invitation)
    {
        return view('themes.' . $invitation->template, compact('invitation'));
    }
}
