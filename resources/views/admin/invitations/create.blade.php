<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Invitation') }}
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
                    
                    <form action="{{ route('admin.invitations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Title -->
                        <div>
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Title (e.g. The Wedding of Budi & Siti)</label>
                            <input type="text" name="title" value="{{ old('title') }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        </div>

                        <!-- Assign to Client -->
                        <div>
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Assign to Client</label>
                            <select name="user_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">-- Select Client --</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('user_id') == $client->id ? 'selected' : '' }}>
                                        {{ $client->name }} ({{ $client->email }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Groom Section -->
                            <div class="space-y-4 bg-gray-50 dark:bg-gray-900/50 p-6 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm">
                                <h3 class="font-bold text-gray-800 dark:text-gray-200 border-b dark:border-gray-800 pb-2">Groom Information</h3>
                                <div>
                                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Full Name</label>
                                    <input type="text" name="groom_name" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Birth Order (Child Number)</label>
                                        <input type="number" name="groom_child_number" placeholder="e.g. 1" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    </div>
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Total siblings</label>
                                        <input type="number" name="groom_total_siblings" placeholder="e.g. 3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    </div>
                                </div>
                                <div>
                                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Father's Name</label>
                                    <input type="text" name="groom_father_name" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                </div>
                                <div>
                                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Mother's Name</label>
                                    <input type="text" name="groom_mother_name" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                </div>
                                <div class="pt-2 border-t dark:border-gray-800">
                                    <label class="block font-medium text-sm text-gray-500 dark:text-gray-400 italic">Custom Description (Fallback)</label>
                                    <input type="text" name="groom_description" placeholder="Used if info above is empty" class="mt-1 block w-full text-xs border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                </div>
                            </div>

                            <!-- Bride Section -->
                            <div class="space-y-4 bg-gray-50 dark:bg-gray-900/50 p-6 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm">
                                <h3 class="font-bold text-gray-800 dark:text-gray-200 border-b dark:border-gray-800 pb-2">Bride Information</h3>
                                <div>
                                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Full Name</label>
                                    <input type="text" name="bride_name" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Birth Order (Child Number)</label>
                                        <input type="number" name="bride_child_number" placeholder="e.g. 2" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    </div>
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Total siblings</label>
                                        <input type="number" name="bride_total_siblings" placeholder="e.g. 3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    </div>
                                </div>
                                <div>
                                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Father's Name</label>
                                    <input type="text" name="bride_father_name" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                </div>
                                <div>
                                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Mother's Name</label>
                                    <input type="text" name="bride_mother_name" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                </div>
                                <div class="pt-2 border-t dark:border-gray-800">
                                    <label class="block font-medium text-sm text-gray-500 dark:text-gray-400 italic">Custom Description (Fallback)</label>
                                    <input type="text" name="bride_description" placeholder="Used if info above is empty" class="mt-1 block w-full text-xs border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Event Date -->
                            <div>
                                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Event Date</label>
                                <input type="datetime-local" name="event_date" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            </div>

                            <!-- Event Location -->
                            <div>
                                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Location Name</label>
                                <input type="text" name="event_location" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            </div>
                        </div>

                        <!-- Map Link -->
                        <div>
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Google Maps Link (Optional)</label>
                            <input type="url" name="map_link" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Cover Photo -->
                            <div>
                                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Cover Photo</label>
                                <input type="file" name="cover_photo" accept="image/*" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                            </div>

                            <!-- Template -->
                            <div>
                                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Select Template</label>
                                <select name="template" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="elegant">Elegant (Gold/White)</option>
                                    <option value="floral">Floral (Pink/Flowers)</option>
                                    <option value="modern">Modern (Dark/Minimalist)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Gallery -->
                        <div>
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Gallery Photos (Select Multiple)</label>
                            <input type="file" name="gallery[]" accept="image/*" multiple class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit" class="bg-gray-800 dark:bg-gray-200 text-white dark:text-gray-800 font-bold py-2 px-4 rounded hover:bg-gray-700 dark:hover:bg-white transition">
                                Create Invitation
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
