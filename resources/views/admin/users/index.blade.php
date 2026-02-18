<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Client Management') }}
            </h2>
            <a href="{{ route('admin.users.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded transition shadow-md">
                + New Client
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b dark:border-gray-700">
                                    <th class="py-3 px-4 font-bold uppercase text-sm text-gray-600 dark:text-gray-400">Name</th>
                                    <th class="py-3 px-4 font-bold uppercase text-sm text-gray-600 dark:text-gray-400">Email</th>
                                    <th class="py-3 px-4 font-bold uppercase text-sm text-gray-600 dark:text-gray-400 text-center">Invitations</th>
                                    <th class="py-3 px-4 font-bold uppercase text-sm text-gray-600 dark:text-gray-400 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900/50 transition">
                                        <td class="py-4 px-4 font-medium">{{ $user->name }}</td>
                                        <td class="py-4 px-4 text-gray-600 dark:text-gray-400 text-sm">{{ $user->email }}</td>
                                        <td class="py-4 px-4 text-center">
                                            <span class="bg-indigo-100 text-indigo-700 text-xs px-2 py-1 rounded-full font-bold">
                                                {{ $user->invitations_count ?? $user->invitations()->count() }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4 text-right space-x-2">
                                            <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:text-blue-900 font-bold px-2 py-1">Edit</a>
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this client? All their invitations will be detached or deleted based on system rules.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-bold px-2 py-1">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-8 text-center text-gray-500 italic">No clients found. Create your first client to assign invitations.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
