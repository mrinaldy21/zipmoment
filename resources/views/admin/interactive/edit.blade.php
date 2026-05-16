@extends('layouts.app')

@section('content')
<div class="py-12 pb-24">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.invitations.interactive.index', $invitation) }}" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">Visual Editor: {{ $scene->name }}</h2>
                    <p class="text-sm text-gray-600">Click on the background to add a hotspot. Drag hotspots to move them.</p>
                </div>
            </div>
            <div>
                <button type="button" onclick="document.getElementById('sceneSettingsModal').classList.remove('hidden')" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors text-sm font-medium">
                    Edit Scene Settings
                </button>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Left: Visual Editor -->
            <div class="w-full lg:w-2/3 flex justify-center bg-gray-100 rounded-xl p-4 overflow-hidden shadow-inner relative" style="min-height: 600px;">
                <div id="canvas-container" class="relative shadow-2xl" style="width: 100%; max-width: 430px; aspect-ratio: 9/19; background-color: #000;">
                    <img id="scene-bg" src="{{ $scene->background_url }}" class="absolute inset-0 w-full h-full object-cover pointer-events-none" alt="Background">
                    
                    <div id="hotspots-layer" class="absolute inset-0">
                        @foreach($scene->hotspots as $hotspot)
                            <div class="hotspot-element absolute transform -translate-x-1/2 -translate-y-1/2 cursor-grab active:cursor-grabbing"
                                 data-id="{{ $hotspot->id }}"
                                 style="left: {{ $hotspot->x_percent }}%; top: {{ $hotspot->y_percent }}%;">
                                <div class="relative group">
                                    @if($hotspot->icon_url)
                                        <img src="{{ $hotspot->icon_url }}" class="w-12 h-12 object-contain filter drop-shadow-md pointer-events-none" alt="icon">
                                    @else
                                        <div class="w-10 h-10 bg-white/80 rounded-full border-2 border-pink-500 shadow-lg flex items-center justify-center pointer-events-none">
                                            <div class="w-4 h-4 bg-pink-500 rounded-full"></div>
                                        </div>
                                    @endif
                                    <div class="absolute top-full left-1/2 transform -translate-x-1/2 mt-1 px-2 py-1 bg-black/70 text-white text-xs rounded whitespace-nowrap opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity">
                                        {{ $hotspot->label ?: $hotspot->target_type }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Click overlay -->
                    <div id="click-overlay" class="absolute inset-0 cursor-crosshair"></div>
                </div>
            </div>

            <!-- Right: Hotspot Form -->
            <div class="w-full lg:w-1/3">
                <div class="bg-white rounded-xl shadow-sm border p-6 sticky top-6">
                    <h3 class="text-lg font-bold mb-4 border-b pb-2" id="form-title">Add New Hotspot</h3>
                    
                    <div id="instruction-text" class="text-gray-500 text-sm mb-4">
                        Click anywhere on the phone screen preview to add a new hotspot.
                    </div>

                    <form id="hotspot-form" class="hidden space-y-4">
                        <input type="hidden" id="h_id">
                        <input type="hidden" id="h_x">
                        <input type="hidden" id="h_y">

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-700">X Position (%)</label>
                                <input type="number" id="h_x_display" readonly class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 text-gray-500 shadow-sm text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700">Y Position (%)</label>
                                <input type="number" id="h_y_display" readonly class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 text-gray-500 shadow-sm text-sm">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Target Action</label>
                            <select id="h_target_type" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm">
                                <option value="gallery">Gallery</option>
                                <option value="couple">Couple / About Us</option>
                                <option value="date_venue">Date & Venue</option>
                                <option value="love_story">Love Story</option>
                                <option value="dresscode">Dress Code</option>
                                <option value="rsvp">RSVP</option>
                                <option value="gift">Wedding Gift</option>
                                <option value="wishes">Wishes</option>
                                <option value="custom">Custom Modal</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Label (Optional)</label>
                            <input type="text" id="h_label" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm" placeholder="e.g., Photos">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Icon Image</label>
                            <input type="file" id="h_icon" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100">
                            <div id="current-icon-preview" class="mt-2 hidden">
                                <img src="" class="h-12 object-contain bg-gray-100 rounded p-1">
                            </div>
                        </div>

                        <div id="custom-fields" class="hidden space-y-4 pt-4 border-t">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Custom Title</label>
                                <input type="text" id="h_custom_title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Custom Content</label>
                                <textarea id="h_custom_content" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 text-sm"></textarea>
                            </div>
                        </div>

                        <div class="flex items-center pt-2">
                            <input id="h_is_active" type="checkbox" checked class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded">
                            <label for="h_is_active" class="ml-2 block text-sm text-gray-900">Active</label>
                        </div>

                        <div class="pt-4 flex gap-2 border-t">
                            <button type="button" id="btn-cancel" class="flex-1 bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                                Cancel
                            </button>
                            <button type="button" id="btn-save" class="flex-1 bg-pink-600 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-pink-700">
                                Save
                            </button>
                        </div>
                        
                        <div id="delete-container" class="hidden pt-2">
                            <button type="button" id="btn-delete" class="w-full bg-red-50 text-red-600 py-2 px-4 border border-red-200 rounded-md shadow-sm text-sm font-medium hover:bg-red-100">
                                Delete Hotspot
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scene Settings Modal -->
<div id="sceneSettingsModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="document.getElementById('sceneSettingsModal').classList.add('hidden')"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="{{ route('admin.invitations.interactive.update', [$invitation, $scene]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="modal-title">Edit Scene Settings</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Scene Name</label>
                            <input type="text" name="name" value="{{ $scene->name }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Change Background (Optional)</label>
                            <input type="file" name="background_image" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100">
                        </div>
                        <div class="flex items-center">
                            <input id="scene_is_active" name="is_active" type="checkbox" value="1" {{ $scene->is_active ? 'checked' : '' }} class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded">
                            <label for="scene_is_active" class="ml-2 block text-sm text-gray-900">Active Scene</label>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-pink-600 text-base font-medium text-white hover:bg-pink-700 sm:ml-3 sm:w-auto sm:text-sm">Save Changes</button>
                    <button type="button" onclick="document.getElementById('sceneSettingsModal').classList.add('hidden')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const overlay = document.getElementById('click-overlay');
    const form = document.getElementById('hotspot-form');
    const instructionText = document.getElementById('instruction-text');
    const formTitle = document.getElementById('form-title');
    const hotspotsLayer = document.getElementById('hotspots-layer');
    const customFields = document.getElementById('custom-fields');
    
    let currentHotspotId = null;
    let tempMarker = null;

    // Toggle custom fields based on target type
    document.getElementById('h_target_type').addEventListener('change', function() {
        if(this.value === 'custom') {
            customFields.classList.remove('hidden');
        } else {
            customFields.classList.add('hidden');
        }
    });

    // Helper: Create temporary marker
    function createTempMarker(x, y) {
        if(tempMarker) tempMarker.remove();
        tempMarker = document.createElement('div');
        tempMarker.className = 'absolute w-6 h-6 border-2 border-white rounded-full bg-pink-500/50 transform -translate-x-1/2 -translate-y-1/2 animate-pulse pointer-events-none';
        tempMarker.style.left = x + '%';
        tempMarker.style.top = y + '%';
        hotspotsLayer.appendChild(tempMarker);
    }

    // Click on overlay to add new
    overlay.addEventListener('click', function(e) {
        const rect = overlay.getBoundingClientRect();
        const x = ((e.clientX - rect.left) / rect.width) * 100;
        const y = ((e.clientY - rect.top) / rect.height) * 100;

        openFormForNew(x, y);
    });

    function openFormForNew(x, y) {
        currentHotspotId = null;
        form.reset();
        document.getElementById('h_id').value = '';
        document.getElementById('h_x').value = x.toFixed(2);
        document.getElementById('h_y').value = y.toFixed(2);
        document.getElementById('h_x_display').value = x.toFixed(2);
        document.getElementById('h_y_display').value = y.toFixed(2);
        document.getElementById('current-icon-preview').classList.add('hidden');
        document.getElementById('delete-container').classList.add('hidden');
        
        formTitle.textContent = 'Add New Hotspot';
        instructionText.classList.add('hidden');
        form.classList.remove('hidden');
        customFields.classList.add('hidden');
        
        createTempMarker(x, y);
    }

    // Dragging Logic
    let isDragging = false;
    let dragTarget = null;
    let dragStartX, dragStartY;

    document.querySelectorAll('.hotspot-element').forEach(el => {
        makeDraggable(el);
    });

    function makeDraggable(el) {
        el.addEventListener('mousedown', startDrag);
        el.addEventListener('touchstart', startDrag, {passive: false});
        
        // Click to edit
        el.addEventListener('click', function(e) {
            if(isDragging) return; // Prevent click if we just dragged
            e.stopPropagation(); // Prevent overlay click
            
            // fetch data (in a real app we'd fetch from server or store in data attributes)
            // For simplicity, we'll reload the page on edit or store data in window object.
            // Since we need to populate the form, let's just trigger a click event that acts as edit.
            alert('To edit, please implement data fetching or reload. For now, use the delete button and recreate.');
        });
    }

    function startDrag(e) {
        if(e.type === 'touchstart') {
            e.preventDefault();
            dragStartX = e.touches[0].clientX;
            dragStartY = e.touches[0].clientY;
        } else {
            dragStartX = e.clientX;
            dragStartY = e.clientY;
        }
        
        dragTarget = this;
        isDragging = false; // Will be set to true on move
        
        document.addEventListener('mousemove', drag);
        document.addEventListener('touchmove', drag, {passive: false});
        document.addEventListener('mouseup', stopDrag);
        document.addEventListener('touchend', stopDrag);
    }

    function drag(e) {
        isDragging = true;
        if(!dragTarget) return;
        
        const rect = overlay.getBoundingClientRect();
        let clientX = e.type === 'touchmove' ? e.touches[0].clientX : e.clientX;
        let clientY = e.type === 'touchmove' ? e.touches[0].clientY : e.clientY;
        
        let x = ((clientX - rect.left) / rect.width) * 100;
        let y = ((clientY - rect.top) / rect.height) * 100;
        
        x = Math.max(0, Math.min(100, x));
        y = Math.max(0, Math.min(100, y));
        
        dragTarget.style.left = x + '%';
        dragTarget.style.top = y + '%';
        
        // Update form if this is the active hotspot
        if(currentHotspotId == dragTarget.dataset.id) {
            document.getElementById('h_x').value = x.toFixed(2);
            document.getElementById('h_y').value = y.toFixed(2);
            document.getElementById('h_x_display').value = x.toFixed(2);
            document.getElementById('h_y_display').value = y.toFixed(2);
        }
    }

    function stopDrag(e) {
        if(isDragging && dragTarget) {
            // Save new position
            const id = dragTarget.dataset.id;
            const x = dragTarget.style.left.replace('%','');
            const y = dragTarget.style.top.replace('%','');
            
            fetch(`{{ route('admin.invitations.interactive.store', $invitation) }}/${id}/position`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ x_percent: x, y_percent: y })
            });
        }
        
        dragTarget = null;
        document.removeEventListener('mousemove', drag);
        document.removeEventListener('touchmove', drag);
        document.removeEventListener('mouseup', stopDrag);
        document.removeEventListener('touchend', stopDrag);
        
        // Small timeout to prevent click event firing after drag
        setTimeout(() => { isDragging = false; }, 50);
    }

    // Cancel Button
    document.getElementById('btn-cancel').addEventListener('click', function() {
        form.classList.add('hidden');
        instructionText.classList.remove('hidden');
        if(tempMarker) tempMarker.remove();
    });

    // Save Form
    document.getElementById('btn-save').addEventListener('click', function() {
        const btn = this;
        const originalText = btn.innerHTML;
        btn.innerHTML = 'Saving...';
        btn.disabled = true;

        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('x_percent', document.getElementById('h_x').value);
        formData.append('y_percent', document.getElementById('h_y').value);
        formData.append('target_type', document.getElementById('h_target_type').value);
        formData.append('label', document.getElementById('h_label').value);
        formData.append('custom_title', document.getElementById('h_custom_title').value);
        formData.append('custom_content', document.getElementById('h_custom_content').value);
        formData.append('is_active', document.getElementById('h_is_active').checked ? 1 : 0);
        
        const fileInput = document.getElementById('h_icon');
        if(fileInput.files.length > 0) {
            formData.append('icon_image', fileInput.files[0]);
        }

        let url = `{{ route('admin.invitations.interactive.store', $invitation) }}/{{ $scene->id }}/hotspots`;
        
        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                window.location.reload();
            } else {
                alert('Error: ' + data.message);
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        })
        .catch(err => {
            console.error(err);
            alert('An error occurred');
            btn.innerHTML = originalText;
            btn.disabled = false;
        });
    });
});
</script>
@endsection
