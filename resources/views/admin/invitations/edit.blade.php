<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Invitation') }}
        </h2>
        @if(session('error'))
            <div class="mt-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                {{ session('error') }}
            </div>
        @endif
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <form action="{{ route('admin.invitations.update', $invitation->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div>
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Title</label>
                            <input type="text" name="title" value="{{ old('title', $invitation->title) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Groom Section -->
                            <div class="space-y-4 bg-gray-50 dark:bg-gray-900/50 p-6 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm">
                                <h3 class="font-bold text-gray-800 dark:text-gray-200 border-b dark:border-gray-800 pb-2">Groom Information</h3>
                                <div>
                                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Full Name</label>
                                    <input type="text" name="groom_name" value="{{ old('groom_name', $invitation->groom_name) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Birth Order (Child Number)</label>
                                        <input type="number" name="groom_child_number" value="{{ old('groom_child_number', $invitation->groom_child_number) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="e.g. 1">
                                    </div>
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Total siblings</label>
                                        <input type="number" name="groom_total_siblings" value="{{ old('groom_total_siblings', $invitation->groom_total_siblings) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="e.g. 5">
                                    </div>
                                </div>
                                <div>
                                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Father's Name</label>
                                    <input type="text" name="groom_father_name" value="{{ old('groom_father_name', $invitation->groom_father_name) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                </div>
                                <div>
                                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Mother's Name</label>
                                    <input type="text" name="groom_mother_name" value="{{ old('groom_mother_name', $invitation->groom_mother_name) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                </div>
                                <div class="pt-2 border-t dark:border-gray-800">
                                    <label class="block font-medium text-sm text-gray-500 dark:text-gray-400 italic">Custom Description (Fallback)</label>
                                    <input type="text" name="groom_description" value="{{ old('groom_description', $invitation->groom_description) }}" placeholder="Used if info above is empty" class="mt-1 block w-full text-xs border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                </div>
                            </div>

                            <!-- Bride Section -->
                            <div class="space-y-4 bg-gray-50 dark:bg-gray-900/50 p-6 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm">
                                <h3 class="font-bold text-gray-800 dark:text-gray-200 border-b dark:border-gray-800 pb-2">Bride Information</h3>
                                <div>
                                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Full Name</label>
                                    <input type="text" name="bride_name" value="{{ old('bride_name', $invitation->bride_name) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Birth Order (Child Number)</label>
                                        <input type="number" name="bride_child_number" value="{{ old('bride_child_number', $invitation->bride_child_number) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="e.g. 2">
                                    </div>
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Total siblings</label>
                                        <input type="number" name="bride_total_siblings" value="{{ old('bride_total_siblings', $invitation->bride_total_siblings) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="e.g. 3">
                                    </div>
                                </div>
                                <div>
                                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Father's Name</label>
                                    <input type="text" name="bride_father_name" value="{{ old('bride_father_name', $invitation->bride_father_name) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                </div>
                                <div>
                                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Mother's Name</label>
                                    <input type="text" name="bride_mother_name" value="{{ old('bride_mother_name', $invitation->bride_mother_name) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                </div>
                                <div class="pt-2 border-t dark:border-gray-800">
                                    <label class="block font-medium text-sm text-gray-500 dark:text-gray-400 italic">Custom Description (Fallback)</label>
                                    <input type="text" name="bride_description" value="{{ old('bride_description', $invitation->bride_description) }}" placeholder="Used if info above is empty" class="mt-1 block w-full text-xs border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Event Date -->
                            <div>
                                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Event Date</label>
                                <input type="datetime-local" name="event_date" value="{{ old('event_date', \Carbon\Carbon::parse($invitation->event_date)->format('Y-m-d\TH:i')) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            </div>

                            <!-- Event Location -->
                            <div>
                                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Location Name</label>
                                <input type="text" name="event_location" value="{{ old('event_location', $invitation->event_location) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            </div>
                        </div>

                        <!-- Map Link -->
                        <div>
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Google Maps Link (Optional)</label>
                            <input type="url" name="map_link" value="{{ old('map_link', $invitation->map_link) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Cover Photo -->
                            <div>
                                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Cover Photo</label>
                                @if($invitation->cover_photo_url)
                                    <div class="mb-2">
                                        <img src="{{ $invitation->cover_photo_url }}" alt="Current Cover" class="w-32 h-32 object-cover rounded shadow-md border dark:border-gray-700">
                                        <p class="text-xs text-gray-500 mt-1 italic">Current Cover</p>
                                    </div>
                                @endif
                                <input type="file" name="cover_photo" accept="image/*" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                <p class="text-xs text-gray-500 mt-1">Leave empty to keep current photo.</p>
                            </div>

                            <!-- Template -->
                            <div>
                                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Select Template</label>
                                <select name="template" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="elegant" {{ old('template', $invitation->template) == 'elegant' ? 'selected' : '' }}>Elegant (Gold/White)</option>
                                    <option value="floral" {{ old('template', $invitation->template) == 'floral' ? 'selected' : '' }}>Floral (Pink/Flowers)</option>
                                    <option value="modern" {{ old('template', $invitation->template) == 'modern' ? 'selected' : '' }}>Modern (Dark/Minimalist)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Gallery -->
                        <div>
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-2">Gallery Photos</label>
                            @if($invitation->galleries->count() > 0)
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-4" id="gallery-container">
                                    @foreach($invitation->galleries as $gallery)
                                        <div class="relative group" id="gallery-item-{{ $gallery->id }}">
                                            <img src="{{ asset('storage/' . $gallery->photo_path) }}" alt="Gallery" class="w-full h-24 object-cover rounded shadow border dark:border-gray-700 transition group-hover:opacity-75">
                                            <button type="button" 
                                                onclick="deleteGalleryPhoto({{ $gallery->id }})"
                                                class="absolute top-1 right-1 bg-red-600 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-700 focus:outline-none shadow-lg"
                                                title="Delete this photo">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <div class="mt-2">
                                <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Add More Photos</label>
                                <input type="file" name="gallery[]" accept="image/*" multiple class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                            </div>
                        </div>

                        <div class="flex items-center justify-end space-x-4 border-t dark:border-gray-700 pt-6">
                            <a href="{{ route('admin.invitations.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 px-4 py-2 transition font-medium">Cancel</a>
                            <button type="submit" class="bg-indigo-600 dark:bg-indigo-500 text-white font-bold py-2.5 px-6 rounded-lg hover:bg-indigo-700 dark:hover:bg-indigo-600 transition shadow-lg transform active:scale-95">
                                Update Invitation
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Gallery Deletion Script -->
    <script>
        function deleteGalleryPhoto(id) {
            if (!confirm('Are you sure you want to delete this photo? This action cannot be undone.')) {
                return;
            }

            fetch(`/admin/gallery/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const item = document.getElementById(`gallery-item-${id}`);
                    if (item) {
                        item.classList.add('scale-0', 'opacity-0');
                        setTimeout(() => {
                            item.remove();
                            // Check if gallery is now empty
                            const container = document.getElementById('gallery-container');
                            if (container && container.children.length === 0) {
                                container.remove();
                            }
                        }, 300);
                    }
                } else {
                    alert('Error deleting photo: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while deleting the photo.');
            });
        }
    </script>
</x-app-layout>
