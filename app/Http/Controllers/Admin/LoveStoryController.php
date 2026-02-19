<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CloudinaryService;
use App\Models\Invitation;
use App\Models\LoveStory;

class LoveStoryController extends Controller
{
    protected $cloudinary;

    public function __construct(CloudinaryService $cloudinary)
    {
        $this->cloudinary = $cloudinary;
    }

    public function index(Invitation $invitation)
    {
        $stories = $invitation->loveStories;
        return view('admin.stories.index', compact('invitation', 'stories'));
    }

    public function store(Request $request, Invitation $invitation)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|max:2048',
            'sort_order' => 'nullable|integer',
        ]);

        $data = $request->except('photo');
        $data['invitation_id'] = $invitation->id;

        if ($request->hasFile('photo')) {
            $data['photo'] = $this->cloudinary->upload($request->file('photo'), 'zipmoment/stories');
        }

        LoveStory::create($data);

        return back()->with('success', 'Story added successfully.');
    }

    public function update(Request $request, LoveStory $story)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|max:2048',
            'sort_order' => 'nullable|integer',
        ]);

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            $data['photo'] = $this->cloudinary->upload($request->file('photo'), 'zipmoment/stories');
        }

        $story->update($data);

        return back()->with('success', 'Story updated successfully.');
    }

    public function destroy(LoveStory $story)
    {
        $story->delete();
        return back()->with('success', 'Story deleted successfully.');
    }
}
