<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\CloudinaryService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class InvitationController extends Controller
{
    use AuthorizesRequests;

    protected $cloudinary;

    public function __construct(CloudinaryService $cloudinary)
    {
        $this->cloudinary = $cloudinary;
    }

    public function index()
    {
        $invitations = auth()->user()->invitations()->latest()->paginate(10);
        return view('dashboard.invitations.index', compact('invitations'));
    }

    public function create()
    {
        if (!auth()->user()->canCreateInvitation()) {
            return redirect()->route('dashboard.invitations.index')
                ->with('error', 'You have reached the limit for the Free plan. Please upgrade to Premium for unlimited invitations.');
        }

        return view('dashboard.invitations.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->canCreateInvitation()) {
            return redirect()->route('dashboard.invitations.index')
                ->with('error', 'You have reached the limit for the Free plan.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'groom_name' => 'required|string|max:255',
            'bride_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_location' => 'required|string',
            'template' => 'required|in:elegant,floral,modern',
            'cover_photo' => 'nullable|image|max:2048',
            'gallery.*' => 'image|max:2048',
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

            $invitation = auth()->user()->invitations()->create($data);

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

            return redirect()->route('dashboard.invitations.index')->with('success', 'Invitation created successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Upload failed: ' . $e->getMessage());
        }
    }

    public function edit(Invitation $invitation)
    {
        $this->authorize('update', $invitation);
        return view('dashboard.invitations.edit', compact('invitation'));
    }

    public function update(Request $request, Invitation $invitation)
    {
        $this->authorize('update', $invitation);

        $request->validate([
            'title' => 'required|string|max:255',
            'groom_name' => 'required|string|max:255',
            'bride_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_location' => 'required|string',
            'template' => 'required|in:elegant,floral,modern',
            'cover_photo' => 'nullable|image|max:2048',
            'gallery.*' => 'image|max:2048',
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

            return redirect()->route('dashboard.invitations.index')->with('success', 'Invitation updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Update failed: ' . $e->getMessage());
        }
    }

    public function destroy(Invitation $invitation)
    {
        $this->authorize('delete', $invitation);
        
        foreach ($invitation->galleries as $gallery) {
            $gallery->delete();
        }

        $invitation->delete();

        return redirect()->route('dashboard.invitations.index')->with('success', 'Invitation deleted successfully.');
    }

    public function destroyGallery(Gallery $gallery)
    {
        $this->authorize('update', $gallery->invitation);
        $gallery->delete();

        return response()->json(['success' => true, 'message' => 'Photo removed successfully.']);
    }
}
