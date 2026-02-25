<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invitation;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Support\Str;
use App\Services\CloudinaryService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class InvitationController extends Controller
{
    protected $cloudinary;
    protected $allowedTemplates = ['elegant', 'floral', 'modern', 'minimalist', 'romantic', 'cinematic'];

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
            'template' => 'required|in:' . implode(',', $this->allowedTemplates),
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
            'contact_instagram' => 'nullable|string|max:255',
            'footer_website' => 'nullable|string|max:255',
            'thank_you_message' => 'nullable|string',
            'thank_you_image' => 'nullable|image|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->except(['cover_photo', 'gallery', 'groom_photo', 'bride_photo', 'music_path']);
            
            // BULLETPROOF SLUG GENERATION
            $slug = Str::slug($request->title);
            $originalSlug = $slug;
            $count = 1;
            while (Invitation::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . Str::random(4) . '-' . $count++;
            }
            $data['slug'] = $slug;

            // Cloudinary Uploads with Success Logging
            if ($request->hasFile('cover_photo')) {
                $url = $this->cloudinary->upload($request->file('cover_photo'), 'zipmoment/covers');
                if (!$url) throw new \Exception('Gagal mengunggah foto sampul.');
                $data['cover_photo'] = $url;
                Log::info('[INVITATION_MEDIA_UPLOAD]', ['type' => 'cover', 'slug' => $slug, 'admin_id' => auth()->id()]);
            }
            if ($request->hasFile('groom_photo')) {
                $url = $this->cloudinary->upload($request->file('groom_photo'), 'zipmoment/couples');
                if (!$url) throw new \Exception('Gagal mengunggah foto pengantin pria.');
                $data['groom_photo'] = $url;
                Log::info('[INVITATION_MEDIA_UPLOAD]', ['type' => 'groom', 'slug' => $slug, 'admin_id' => auth()->id()]);
            }
            if ($request->hasFile('bride_photo')) {
                $url = $this->cloudinary->upload($request->file('bride_photo'), 'zipmoment/couples');
                if (!$url) throw new \Exception('Gagal mengunggah foto pengantin wanita.');
                $data['bride_photo'] = $url;
                Log::info('[INVITATION_MEDIA_UPLOAD]', ['type' => 'bride', 'slug' => $slug, 'admin_id' => auth()->id()]);
            }
            if ($request->hasFile('music_path')) {
                $url = $this->cloudinary->upload($request->file('music_path'), 'zipmoment/music');
                if (!$url) throw new \Exception('Gagal mengunggah file musik.');
                $data['music_path'] = $url;
                Log::info('[INVITATION_MEDIA_UPLOAD]', ['type' => 'music', 'slug' => $slug, 'admin_id' => auth()->id()]);
            }
            if ($request->hasFile('thank_you_image')) {
                try {
                    $url = $this->cloudinary->upload($request->file('thank_you_image'), 'zipmoment/closings');
                    if ($url) {
                        $data['thank_you_image'] = $url;
                        Log::info('[INVITATION_MEDIA_UPLOAD]', ['type' => 'thank_you_image', 'slug' => $slug, 'admin_id' => auth()->id()]);
                    }
                } catch (\Exception $e) {
                    Log::error('[INVITATION_CLOSING_UPLOAD_FAILED]', ['slug' => $slug, 'message' => $e->getMessage()]);
                }
            }

            $invitation = Invitation::create($data);

            if ($request->hasFile('gallery')) {
                $allowed = ($request->package_type === 'basic') ? ($request->gallery_limit ?? 5) : 999;
                $uploadCount = count($request->file('gallery'));
                
                if ($uploadCount > $allowed) {
                    DB::rollBack();
                    return back()->withInput()->with('error', "Batas paket Anda adalah $allowed foto. Silakan pilih paket Premium untuk lebih banyak foto.");
                }

                foreach ($request->file('gallery') as $photo) {
                    $url = $this->cloudinary->upload($photo, 'zipmoment/galleries');
                    if ($url) {
                        $invitation->galleries()->create(['photo_path' => $url]);
                    }
                }
                Log::info('[INVITATION_MEDIA_UPLOAD]', ['type' => 'gallery', 'count' => $uploadCount, 'slug' => $slug, 'admin_id' => auth()->id()]);
            }

            DB::commit();
            Log::info('[INVITATION_CREATE_SUCCESS]', ['id' => $invitation->id, 'slug' => $slug, 'admin_id' => auth()->id()]);
            return redirect()->route('admin.invitations.index')->with('success', 'Undangan berhasil dibuat.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('[INVITATION_CREATE_FAILED]', [
                'message' => $e->getMessage(),
                'admin_id' => auth()->id(),
                'request' => $request->except(['cover_photo', 'gallery', 'groom_photo', 'bride_photo', 'music_path']),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan undangan: ' . $e->getMessage()]);
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
            'template' => 'required|in:' . implode(',', $this->allowedTemplates),
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
            'contact_instagram' => 'nullable|string|max:255',
            'footer_website' => 'nullable|string|max:255',
            'thank_you_message' => 'nullable|string',
            'thank_you_image' => 'nullable|image|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->except(['cover_photo', 'gallery', 'groom_photo', 'bride_photo', 'music_path']);

            // Cloudinary Uploads with Success Logging
            if ($request->hasFile('cover_photo')) {
                $url = $this->cloudinary->upload($request->file('cover_photo'), 'zipmoment/covers');
                if (!$url) throw new \Exception('Gagal mengunggah foto sampul.');
                $data['cover_photo'] = $url;
                Log::info('[INVITATION_MEDIA_UPLOAD]', ['type' => 'cover', 'slug' => $invitation->slug, 'admin_id' => auth()->id()]);
            }
            if ($request->hasFile('groom_photo')) {
                $url = $this->cloudinary->upload($request->file('groom_photo'), 'zipmoment/couples');
                if (!$url) throw new \Exception('Gagal mengunggah foto pengantin pria.');
                $data['groom_photo'] = $url;
                Log::info('[INVITATION_MEDIA_UPLOAD]', ['type' => 'groom', 'slug' => $invitation->slug, 'admin_id' => auth()->id()]);
            }
            if ($request->hasFile('bride_photo')) {
                $url = $this->cloudinary->upload($request->file('bride_photo'), 'zipmoment/couples');
                if (!$url) throw new \Exception('Gagal mengunggah foto pengantin wanita.');
                $data['bride_photo'] = $url;
                Log::info('[INVITATION_MEDIA_UPLOAD]', ['type' => 'bride', 'slug' => $invitation->slug, 'admin_id' => auth()->id()]);
            }
            if ($request->hasFile('music_path')) {
                $url = $this->cloudinary->upload($request->file('music_path'), 'zipmoment/music');
                if (!$url) throw new \Exception('Gagal mengunggah file musik.');
                $data['music_path'] = $url;
                Log::info('[INVITATION_MEDIA_UPLOAD]', ['type' => 'music', 'slug' => $invitation->slug, 'admin_id' => auth()->id()]);
            }
            if ($request->hasFile('thank_you_image')) {
                try {
                    $url = $this->cloudinary->upload($request->file('thank_you_image'), 'zipmoment/closings');
                    if ($url) {
                        $data['thank_you_image'] = $url;
                        Log::info('[INVITATION_MEDIA_UPLOAD]', ['type' => 'thank_you_image', 'slug' => $invitation->slug, 'admin_id' => auth()->id()]);
                    }
                } catch (\Exception $e) {
                    Log::error('[INVITATION_CLOSING_UPLOAD_FAILED]', ['slug' => $invitation->slug, 'message' => $e->getMessage()]);
                }
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

            if ($request->hasFile('gallery')) {
                $currentCount = $invitation->galleries()->count();
                $allowed = ($request->package_type === 'basic') ? ($request->gallery_limit ?? 5) : 999;
                $newUploads = count($request->file('gallery'));

                if ($currentCount + $newUploads > $allowed) {
                    DB::rollBack();
                    return back()->withInput()->with('error', "Batas paket Anda adalah $allowed foto. Saat ini Anda memiliki $currentCount. Silakan tingkatkan ke Premium untuk galeri tak terbatas.");
                }

                foreach ($request->file('gallery') as $photo) {
                    $url = $this->cloudinary->upload($photo, 'zipmoment/galleries');
                    if ($url) {
                        $invitation->galleries()->create(['photo_path' => $url]);
                    }
                }
                Log::info('[INVITATION_MEDIA_UPLOAD]', ['type' => 'gallery', 'count' => $newUploads, 'slug' => $invitation->slug, 'admin_id' => auth()->id()]);
            }

            DB::commit();
            Log::info('[INVITATION_UPDATE_SUCCESS]', ['id' => $invitation->id, 'slug' => $invitation->slug, 'admin_id' => auth()->id()]);
            return redirect()->route('admin.invitations.index')->with('success', 'Undangan berhasil diperbarui.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('[INVITATION_UPDATE_FAILED]', [
                'id' => $invitation->id,
                'message' => $e->getMessage(),
                'admin_id' => auth()->id(),
                'request' => $request->except(['cover_photo', 'gallery', 'groom_photo', 'bride_photo', 'music_path']),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui undangan: ' . $e->getMessage()]);
        }
    }

    public function destroy(Invitation $invitation)
    {
        $id = $invitation->id;
        $slug = $invitation->slug;
        
        try {
            foreach ($invitation->galleries as $gallery) {
                $gallery->delete();
            }

            $invitation->delete();
            
            Log::info('[INVITATION_DELETE_SUCCESS]', ['id' => $id, 'slug' => $slug, 'admin_id' => auth()->id()]);
            return redirect()->route('admin.invitations.index')->with('success', 'Undangan berhasil dihapus.');
        } catch (\Throwable $e) {
            Log::error('[INVITATION_DELETE_FAILED]', ['id' => $id, 'slug' => $slug, 'message' => $e->getMessage()]);
            return back()->with('error', 'Gagal menghapus undangan.');
        }
    }

    public function destroyGallery(Gallery $gallery)
    {
        try {
            $invitationId = $gallery->invitation_id;
            $gallery->delete();

            Log::info('[INVITATION_GALLERY_DELETE_SUCCESS]', ['invitation_id' => $invitationId, 'gallery_id' => $gallery->id, 'admin_id' => auth()->id()]);
            return response()->json(['success' => true, 'message' => 'Foto berhasil dihapus.']);
        } catch (\Throwable $e) {
            Log::error('[INVITATION_GALLERY_DELETE_FAILED]', ['gallery_id' => $gallery->id, 'message' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Gagal menghapus foto.'], 500);
        }
    }

    public function showPublic(Invitation $invitation)
    {
        return view('themes.' . $invitation->template, [
            'invitation' => $invitation->load(['galleries', 'loveStories', 'events' => function($q) {
                $q->orderBy('sort_order');
            }, 'messages' => function($query) {
                $query->latest();
            }])
        ]);
    }
}
