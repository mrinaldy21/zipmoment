<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invitation;
use App\Models\InteractiveScene;
use App\Models\InteractiveHotspot;
use App\Services\CloudinaryService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InteractiveController extends Controller
{
    protected $cloudinary;

    public function __construct(CloudinaryService $cloudinary)
    {
        $this->cloudinary = $cloudinary;
    }

    public function index(Invitation $invitation)
    {
        $scenes = $invitation->interactiveScenes;
        return view('admin.interactive.index', compact('invitation', 'scenes'));
    }

    public function create(Invitation $invitation)
    {
        return view('admin.interactive.create', compact('invitation'));
    }

    public function store(Request $request, Invitation $invitation)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'background_image' => 'required|image|max:5120',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        DB::beginTransaction();
        try {
            $slug = Str::slug($request->name);
            $count = 1;
            while (InteractiveScene::where('invitation_id', $invitation->id)->where('slug', $slug)->exists()) {
                $slug = Str::slug($request->name) . '-' . $count++;
            }

            $url = $this->cloudinary->upload($request->file('background_image'), 'zipmoment/interactive');
            if (!$url) throw new \Exception('Gagal mengunggah background.');

            // Get image dimensions if possible (for Cloudinary, you'd usually get this from the upload response, but here we just have a URL. We can use getimagesize or just save the URL)
            // As a fallback, we'll just save the URL since $this->cloudinary->upload currently only returns URL string.

            $scene = $invitation->interactiveScenes()->create([
                'name' => $request->name,
                'slug' => $slug,
                'background_url' => $url,
                'is_active' => $request->has('is_active'),
                'sort_order' => $request->sort_order ?? 0,
            ]);

            DB::commit();
            return redirect()->route('admin.invitations.interactive.index', $invitation)->with('success', 'Scene berhasil dibuat.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Scene creation failed', ['error' => $e->getMessage()]);
            return back()->withInput()->withErrors(['error' => 'Gagal membuat scene: ' . $e->getMessage()]);
        }
    }

    public function edit(Invitation $invitation, InteractiveScene $scene)
    {
        $scene->load('hotspots');
        return view('admin.interactive.edit', compact('invitation', 'scene'));
    }

    public function update(Request $request, Invitation $invitation, InteractiveScene $scene)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'background_image' => 'nullable|image|max:5120',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        DB::beginTransaction();
        try {
            $data = [
                'name' => $request->name,
                'is_active' => $request->has('is_active'),
                'sort_order' => $request->sort_order ?? 0,
            ];

            if ($request->hasFile('background_image')) {
                $url = $this->cloudinary->upload($request->file('background_image'), 'zipmoment/interactive');
                if (!$url) throw new \Exception('Gagal mengunggah background.');
                $data['background_url'] = $url;
            }

            $scene->update($data);

            DB::commit();
            return redirect()->route('admin.invitations.interactive.index', $invitation)->with('success', 'Scene berhasil diperbarui.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Scene update failed', ['error' => $e->getMessage()]);
            return back()->withInput()->withErrors(['error' => 'Gagal memperbarui scene: ' . $e->getMessage()]);
        }
    }

    public function destroy(Invitation $invitation, InteractiveScene $scene)
    {
        try {
            $scene->delete();
            return redirect()->route('admin.invitations.interactive.index', $invitation)->with('success', 'Scene berhasil dihapus.');
        } catch (\Throwable $e) {
            return back()->withErrors(['error' => 'Gagal menghapus scene.']);
        }
    }

    // HOTSPOT METHODS (API / AJAX for Visual Editor)

    public function storeHotspot(Request $request, Invitation $invitation, InteractiveScene $scene)
    {
        $request->validate([
            'label' => 'nullable|string|max:255',
            'icon_image' => 'nullable|image|max:2048',
            'x_percent' => 'required|numeric|min:0|max:100',
            'y_percent' => 'required|numeric|min:0|max:100',
            'width_percent' => 'nullable|numeric|min:0|max:100',
            'target_type' => 'required|string',
            'custom_title' => 'nullable|string|max:255',
            'custom_content' => 'nullable|string',
        ]);

        try {
            $data = $request->except(['icon_image']);

            if ($request->hasFile('icon_image')) {
                $url = $this->cloudinary->upload($request->file('icon_image'), 'zipmoment/interactive_icons');
                if (!$url) throw new \Exception('Gagal mengunggah icon.');
                $data['icon_url'] = $url;
            }

            $hotspot = $scene->hotspots()->create($data);

            return response()->json(['success' => true, 'hotspot' => $hotspot]);
        } catch (\Throwable $e) {
            Log::error('Hotspot creation failed', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function updateHotspot(Request $request, Invitation $invitation, InteractiveScene $scene, InteractiveHotspot $hotspot)
    {
        $request->validate([
            'label' => 'nullable|string|max:255',
            'icon_image' => 'nullable|image|max:2048',
            'x_percent' => 'required|numeric|min:0|max:100',
            'y_percent' => 'required|numeric|min:0|max:100',
            'width_percent' => 'nullable|numeric|min:0|max:100',
            'target_type' => 'required|string',
            'custom_title' => 'nullable|string|max:255',
            'custom_content' => 'nullable|string',
        ]);

        try {
            $data = $request->except(['icon_image']);

            if ($request->hasFile('icon_image')) {
                $url = $this->cloudinary->upload($request->file('icon_image'), 'zipmoment/interactive_icons');
                if (!$url) throw new \Exception('Gagal mengunggah icon.');
                $data['icon_url'] = $url;
            }

            $hotspot->update($data);

            return response()->json(['success' => true, 'hotspot' => $hotspot]);
        } catch (\Throwable $e) {
            Log::error('Hotspot update failed', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function updateHotspotPosition(Request $request, Invitation $invitation, InteractiveScene $scene, InteractiveHotspot $hotspot)
    {
        $request->validate([
            'x_percent' => 'required|numeric|min:0|max:100',
            'y_percent' => 'required|numeric|min:0|max:100',
        ]);

        $hotspot->update([
            'x_percent' => $request->x_percent,
            'y_percent' => $request->y_percent,
        ]);

        return response()->json(['success' => true]);
    }

    public function destroyHotspot(Invitation $invitation, InteractiveScene $scene, InteractiveHotspot $hotspot)
    {
        try {
            $hotspot->delete();
            return response()->json(['success' => true]);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
