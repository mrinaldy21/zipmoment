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
            'event_date' => 'nullable|date',
            'event_location' => 'nullable|string',
            'map_link' => 'nullable|url',
            'cover_photo' => 'nullable|image|max:2048',
            'template' => 'required|in:elegant,floral,modern',
            'gallery.*' => 'image|max:2048',
            'user_id' => 'required|exists:users,id',
            'package_type' => 'nullable|in:basic,premium,exclusive',
            'is_watermark_enabled' => 'nullable|boolean',
            'custom_domain' => 'nullable|string|unique:invitations,custom_domain',
            'gallery_limit' => 'nullable|integer',

            // CORE WEDDING INFO (Relational Fallback/Primary)
            'groom_photo' => 'nullable|image|max:2048',
            'bride_photo' => 'nullable|image|max:2048',
            'groom_instagram' => 'nullable|string|max:255',
            'bride_instagram' => 'nullable|string|max:255',
            'akad_date' => 'nullable|date',
            'akad_start' => 'nullable|string|max:255',
            'akad_end' => 'nullable|string|max:255',
            'akad_location' => 'nullable|string|max:255',
            'akad_maps' => 'nullable|url',
            'resepsi_date' => 'nullable|date',
            'resepsi_start' => 'nullable|string|max:255',
            'resepsi_end' => 'nullable|string|max:255',
            'resepsi_location' => 'nullable|string|max:255',
            'resepsi_maps' => 'nullable|url',
            'gift_bank_pria' => 'nullable|string|max:255',
            'gift_bank_pria_name' => 'nullable|string|max:255',
            'gift_bank_wanita' => 'nullable|string|max:255',
            'gift_bank_wanita_name' => 'nullable|string|max:255',
            'music_path' => 'nullable|file|mimes:mp3,wav|max:5120',
            'music_title' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:255',
            'contact_instagram' => 'nullable|string|max:255',
            'footer_website' => 'nullable|string|max:255',
        ]);

        try {
            $data = $request->except(['cover_photo', 'gallery', 'groom_photo', 'bride_photo', 'music_path']);
            $data['slug'] = Str::slug($request->title) . '-' . Str::random(5);

            // Cloudinary Uploads
            if ($request->hasFile('cover_photo')) {
                $data['cover_photo'] = $this->cloudinary->upload($request->file('cover_photo'), 'zipmoment/covers');
            }
            if ($request->hasFile('groom_photo')) {
                $data['groom_photo'] = $this->cloudinary->upload($request->file('groom_photo'), 'zipmoment/couples');
            }
            if ($request->hasFile('bride_photo')) {
                $data['bride_photo'] = $this->cloudinary->upload($request->file('bride_photo'), 'zipmoment/couples');
            }
            if ($request->hasFile('music_path')) {
                $data['music_path'] = $this->cloudinary->upload($request->file('music_path'), 'zipmoment/music');
            }

            $invitation = Invitation::create($data);

            if ($request->hasFile('gallery')) {
                // Gallery Limit Enforcement
                $allowed = ($request->package_type === 'basic') ? ($request->gallery_limit ?? 5) : 999;
                $uploadCount = count($request->file('gallery'));
                
                if ($uploadCount > $allowed) {
                    return back()->withInput()->with('error', "Your package limit is $allowed photos. Please select Premium for more.");
                }

                foreach ($request->file('gallery') as $photo) {
                    $url = $this->cloudinary->upload($photo, 'zipmoment/galleries');
                    if ($url) {
                        $invitation->galleries()->create(['photo_path' => $url]);
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
            'event_date' => 'nullable|date',
            'event_location' => 'nullable|string',
            'map_link' => 'nullable|url',
            'cover_photo' => 'nullable|image|max:2048',
            'template' => 'required|in:elegant,floral,modern',
            'gallery.*' => 'image|max:2048',
            'user_id' => 'required|exists:users,id',
            'package_type' => 'nullable|in:basic,premium,exclusive',
            'is_watermark_enabled' => 'nullable|boolean',
            'custom_domain' => 'nullable|string|unique:invitations,custom_domain,' . $invitation->id,
            'gallery_limit' => 'nullable|integer',

            // CORE WEDDING INFO
            'groom_photo' => 'nullable|image|max:2048',
            'bride_photo' => 'nullable|image|max:2048',
            'groom_instagram' => 'nullable|string|max:255',
            'bride_instagram' => 'nullable|string|max:255',
            'akad_date' => 'nullable|date',
            'akad_start' => 'nullable|string|max:255',
            'akad_end' => 'nullable|string|max:255',
            'akad_location' => 'nullable|string|max:255',
            'akad_maps' => 'nullable|url',
            'resepsi_date' => 'nullable|date',
            'resepsi_start' => 'nullable|string|max:255',
            'resepsi_end' => 'nullable|string|max:255',
            'resepsi_location' => 'nullable|string|max:255',
            'resepsi_maps' => 'nullable|url',
            'gift_bank_pria' => 'nullable|string|max:255',
            'gift_bank_pria_name' => 'nullable|string|max:255',
            'gift_bank_wanita' => 'nullable|string|max:255',
            'gift_bank_wanita_name' => 'nullable|string|max:255',
            'music_path' => 'nullable|file|mimes:mp3,wav|max:5120',
            'music_title' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:255',
            'contact_instagram' => 'nullable|string|max:255',
            'footer_website' => 'nullable|string|max:255',
        ]);

        try {
            $data = $request->except(['cover_photo', 'gallery', 'groom_photo', 'bride_photo', 'music_path']);

            // Cloudinary Uploads
            if ($request->hasFile('cover_photo')) {
                $data['cover_photo'] = $this->cloudinary->upload($request->file('cover_photo'), 'zipmoment/covers');
            }
            if ($request->hasFile('groom_photo')) {
                $data['groom_photo'] = $this->cloudinary->upload($request->file('groom_photo'), 'zipmoment/couples');
            }
            if ($request->hasFile('bride_photo')) {
                $data['bride_photo'] = $this->cloudinary->upload($request->file('bride_photo'), 'zipmoment/couples');
            }
            if ($request->hasFile('music_path')) {
                $data['music_path'] = $this->cloudinary->upload($request->file('music_path'), 'zipmoment/music');
            }

            $invitation->update($data);

        // Handle Existing Events Update
        if ($request->has('existing_events')) {
            foreach ($request->existing_events as $id => $eventData) {
                $event = $invitation->events()->find($id);
                if ($event) {
                    $event->update($eventData);
                }
            }
        }

        // Handle New Events
        if ($request->has('new_events')) {
            foreach ($request->new_events as $eventData) {
                $invitation->events()->create($eventData);
            }
        }

        // Reset gallery logic if needed or handled separately
        if ($request->hasFile('gallery')) {
            // Gallery Limit Enforcement
            $currentCount = $invitation->galleries()->count();
            $allowed = ($request->package_type === 'basic') ? ($request->gallery_limit ?? 5) : 999;
            $newUploads = count($request->file('gallery'));

            if ($currentCount + $newUploads > $allowed) {
                return back()->withInput()->with('error', "Your package limit is $allowed photos. Currently you have $currentCount. Please upgrade to Premium for unlimited gallery.");
            }

                foreach ($request->file('gallery') as $photo) {
                    $url = $this->cloudinary->upload($photo, 'zipmoment/galleries');
                    if ($url) {
                        $invitation->galleries()->create(['photo_path' => $url]);
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
