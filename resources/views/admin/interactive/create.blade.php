@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.invitations.interactive.index', $invitation) }}" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">New Interactive Scene</h2>
                    <p class="text-sm text-gray-600">Create a new interactive background for {{ $invitation->title }}</p>
                </div>
            </div>
        </div>

        @if($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Whoops!</strong>
                <span class="block sm:inline">Ada masalah dengan input Anda.</span>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <form action="{{ route('admin.invitations.interactive.store', $invitation) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="space-y-6">
                        <!-- Scene Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Scene Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500"
                                placeholder="e.g., Main Room, Garden, Hall">
                            <p class="mt-1 text-sm text-gray-500">A descriptive name for this scene.</p>
                        </div>

                        <!-- Background Image -->
                        <div>
                            <label for="background_image" class="block text-sm font-medium text-gray-700">Background Image</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="background_image" class="relative cursor-pointer bg-white rounded-md font-medium text-pink-600 hover:text-pink-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-pink-500">
                                            <span>Upload a file</span>
                                            <input id="background_image" name="background_image" type="file" class="sr-only" accept="image/*" required>
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, SVG up to 5MB</p>
                                    <p class="text-xs font-semibold mt-2 text-pink-600">Tip: Use a portrait-oriented image (e.g., 1080x1920) for best mobile experience.</p>
                                </div>
                            </div>
                            <div id="image-preview-container" class="mt-4 hidden">
                                <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
                                <img id="image-preview" class="max-h-64 rounded-lg shadow-sm border" src="" alt="Preview">
                            </div>
                        </div>

                        <!-- Settings -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="sort_order" class="block text-sm font-medium text-gray-700">Sort Order</label>
                                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            </div>
                            
                            <div class="flex items-center pt-6">
                                <input id="is_active" name="is_active" type="checkbox" value="1" checked
                                    class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded">
                                <label for="is_active" class="ml-2 block text-sm text-gray-900">
                                    Set as Active Scene
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-5 border-t border-gray-200">
                        <div class="flex justify-end gap-3">
                            <a href="{{ route('admin.invitations.interactive.index', $invitation) }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                                Save & Continue to Editor
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('background_image').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('image-preview').src = e.target.result;
                document.getElementById('image-preview-container').classList.remove('hidden');
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>
@endsection
