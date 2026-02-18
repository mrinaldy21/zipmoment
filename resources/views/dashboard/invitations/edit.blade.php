<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Invitation') }}: {{ $invitation->title }}
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
                    
                    <form action="{{ route('dashboard.invitations.update', $invitation->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
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
                                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Birth Order</label>
                                        <input type="number" name="groom_child_number" value="{{ old('groom_child_number', $invitation->groom_child_number) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    </div>
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Total siblings</label>
                                        <input type="number" name="groom_total_siblings" value="{{ old('groom_total_siblings', $invitation->groom_total_siblings) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
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
                                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Birth Order</label>
                                        <input type="number" name="bride_child_number" value="{{ old('bride_child_number', $invitation->bride_child_number) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    </div>
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Total siblings</label>
                                        <input type="number" name="bride_total_siblings" value="{{ old('bride_total_siblings', $invitation->bride_total_siblings) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
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
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Google Maps Link</label>
                            <input type="url" name="map_link" value="{{ old('map_link', $invitation->map_link) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Cover Photo -->
                            <div>
                                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Cover Photo (Leave empty to keep current)</label>
                                @if($invitation->cover_photo_url)
                                    <img src="{{ $invitation->cover_photo_url }}" class="w-32 h-32 object-cover rounded mb-2">
                                @endif
                                <input type="file" name="cover_photo" accept="image/*" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer">
                            </div>

                            <!-- Template -->
                            <div>
                                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Select Template</label>
                                <select name="template" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="elegant" {{ old('template', $invitation->template) == 'elegant' ? 'selected' : '' }}>Elegant</option>
                                    <option value="floral" {{ old('template', $invitation->template) == 'floral' ? 'selected' : '' }}>Floral</option>
                                    <option value="modern" {{ old('template', $invitation->template) == 'modern' ? 'selected' : '' }}>Modern</option>
                                </select>
                            </div>
                        </div>

                        <!-- Gallery -->
                        <div>
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Gallery Photos</label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4" id="gallery-container">
                                @foreach($invitation->galleries as $photo)
                                    <div class="relative group" id="photo-{{ $photo->id }}">
                                        <img src="{{ $photo->photo_url }}" class="w-full h-32 object-cover rounded">
                                        <button type="button" onclick="removePhoto({{ $photo->id }})" class="absolute top-2 right-2 bg-red-600 text-white p-1 rounded-full opacity-0 group-hover:opacity-100 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                            <input type="file" name="gallery[]" accept="image/*" multiple class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                        </div>

                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('dashboard.invitations.index') }}" class="text-gray-600 hover:text-gray-900">Cancel</a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                Update Invitation
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function removePhoto(id) {
            if (confirm('Remove this photo?')) {
                fetch(`/dashboard/gallery/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`photo-${id}`).remove();
                    }
                });
            }
        }
    </script>
</x-app-layout>
