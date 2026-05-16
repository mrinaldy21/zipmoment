@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Interactive Scenes: {{ $invitation->title }}</h2>
                <p class="text-sm text-gray-600">Manage interactive backgrounds and hotspots for this invitation.</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.invitations.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                    Back to Invitations
                </a>
                <a href="{{ route('admin.invitations.interactive.create', $invitation) }}" class="px-4 py-2 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition-colors flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    New Scene
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                @if($scenes->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($scenes as $scene)
                            <div class="border rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow relative">
                                <img src="{{ $scene->background_url }}" alt="{{ $scene->name }}" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <div class="flex justify-between items-start mb-2">
                                        <h3 class="font-bold text-lg">{{ $scene->name }}</h3>
                                        @if($scene->is_active)
                                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Active</span>
                                        @else
                                            <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded-full">Inactive</span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-gray-600 mb-4">{{ $scene->hotspots->count() }} Hotspots</p>
                                    
                                    <div class="flex gap-2 mt-4">
                                        <a href="{{ route('admin.invitations.interactive.edit', [$invitation, $scene]) }}" class="flex-1 text-center px-3 py-2 bg-pink-50 text-pink-600 rounded hover:bg-pink-100 text-sm font-medium transition-colors">
                                            Visual Editor
                                        </a>
                                        <form action="{{ route('admin.invitations.interactive.destroy', [$invitation, $scene]) }}" method="POST" class="inline" onsubmit="return confirm('Hapus scene ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-2 bg-red-50 text-red-600 rounded hover:bg-red-100 text-sm font-medium transition-colors">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No scenes</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by creating a new interactive scene.</p>
                        <div class="mt-6">
                            <a href="{{ route('admin.invitations.interactive.create', $invitation) }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                New Scene
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
