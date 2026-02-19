<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Invitations') }}
            </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">List of Invitations</h3>
                        <a href="{{ route('admin.invitations.create') }}" class="bg-sky-500 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded transition">
                            + New Invitation
                        </a>
                    </div>
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-hidden border border-gray-100 dark:border-gray-700 rounded-2xl shadow-sm">
                        <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-700">
                            <thead class="bg-gray-50/50 dark:bg-gray-700/50">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Package Tier</th>
                                    <th scope="col" class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Invitation Info</th>
                                    <th scope="col" class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Client</th>
                                    <th scope="col" class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Ceremony</th>
                                    <th scope="col" class="px-6 py-4 text-right text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700">
                                @foreach($invitations as $invitation)
                                <tr class="hover:bg-gray-50/50 transition-colors group">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($invitation->package_type == 'basic')
                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-[9px] font-black bg-slate-100 text-slate-500 uppercase tracking-widest border border-slate-200">
                                                Basic
                                            </span>
                                        @elseif($invitation->package_type == 'premium')
                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-[9px] font-black bg-amber-50 text-amber-600 uppercase tracking-widest border border-amber-200 shadow-sm">
                                                <svg class="w-2 h-2 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                                Premium
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-[9px] font-black bg-indigo-50 text-indigo-600 uppercase tracking-widest border border-indigo-200 shadow-md">
                                                <svg class="w-2 h-2 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
                                                Exclusive
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 relative">
                                                @if($invitation->cover_photo_url)
                                                    <img class="h-10 w-10 rounded-xl object-cover shadow-sm group-hover:shadow-md transition-shadow" src="{{ $invitation->cover_photo_url }}" alt="">
                                                @else
                                                    <div class="h-10 w-10 rounded-xl bg-slate-100 flex items-center justify-center">
                                                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-black text-slate-700 dark:text-white uppercase tracking-tight">{{ $invitation->title }}</div>
                                                <div class="text-[10px] text-slate-400 font-medium">/{{ $invitation->slug }} &bull; {{ ucfirst($invitation->template) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-xs font-bold text-slate-600 dark:text-gray-300">{{ $invitation->user->name ?? 'Unassigned' }}</div>
                                        <div class="text-[9px] text-slate-400 font-medium uppercase tracking-widest">{{ $invitation->user->email ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-500">
                                        <div class="font-black text-slate-700 dark:text-white">{{ \Carbon\Carbon::parse($invitation->event_date)->format('d M Y') }}</div>
                                        <div class="text-[9px] font-medium uppercase tracking-widest text-slate-400">Time: {{ \Carbon\Carbon::parse($invitation->event_date)->format('H:i') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-bold space-x-3 flex items-center justify-end">
                                        <div class="flex items-center bg-gray-50 dark:bg-gray-700/50 rounded-xl p-1 border border-gray-100 dark:border-gray-700">
                                            <a href="{{ route('invitation.show', $invitation->slug) }}" target="_blank" class="p-2 text-slate-400 hover:text-indigo-600 transition-colors" title="Preview">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            </a>
                                            <button onclick="copyToClipboard('{{ route('invitation.show', $invitation->slug) }}')" class="p-2 text-slate-400 hover:text-indigo-600 transition-colors" title="Copy Link">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                                            </button>
                                            @php
                                                $waText = rawurlencode("Halo Kak! Ini link undangan digital premium ZipMoment untuk acaranya:\n\n" . route('invitation.show', $invitation->slug) . "\n\nSilakan dicek ya!");
                                            @endphp
                                            <a href="https://wa.me/?text={{ $waText }}" target="_blank" class="p-2 text-slate-400 hover:text-green-500 transition-colors" title="Share to WhatsApp">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.412 0 6.556-5.338 11.892-11.893 11.892-1.997-.001-3.951-.5-5.688-1.448l-6.309 1.656zm6.224-3.82l.448.265c1.416.84 3.057 1.285 4.725 1.285h.005c5.454 0 9.895-4.442 9.897-9.896 0-2.642-1.029-5.125-2.897-6.994s-4.352-2.896-6.991-2.896c-5.455 0-9.896 4.442-9.898 9.897 0 1.748.463 3.453 1.336 4.956l.29.499-1.002 3.661 3.748-.983zm11.554-7.051c-.244-.123-1.442-.711-1.666-.793-.223-.082-.387-.123-.55.123s-.631.793-.773.955-.285.184-.528.062c-.243-.123-1.026-.379-1.954-1.206-.721-.643-1.209-1.437-1.351-1.682-.141-.245-.015-.377.108-.499.11-.11.243-.285.365-.428.122-.142.162-.245.243-.408.081-.163.041-.306-.021-.428s-.55-1.326-.753-1.815c-.198-.478-.399-.413-.55-.421-.143-.008-.306-.008-.469-.008s-.428.061-.652.306c-.224.245-.856.836-.856 2.04s.876 2.365.998 2.529c.122.163 1.725 2.636 4.177 3.692.584.251 1.04.402 1.396.515.586.186 1.119.16 1.54.098.47-.069 1.442-.589 1.646-1.159.204-.571.204-1.061.142-1.163s-.224-.163-.467-.285z"/></svg>
                                            </a>
                                        </div>
                                        <a href="{{ route('admin.invitations.edit', $invitation->id) }}" class="text-slate-900 dark:text-white hover:text-indigo-500 transition-all uppercase tracking-widest text-[9px] py-2 px-3 rounded-xl border border-slate-200 dark:border-slate-700 hover:border-indigo-200 font-black">Manage</a>
                                        <form action="{{ route('admin.invitations.destroy', $invitation->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Archive this invitation?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-slate-300 hover:text-red-600 transition-colors uppercase tracking-widest text-[9px]">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $invitations->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            alert('Link copied to clipboard!');
        }).catch(err => {
            console.error('Failed to copy: ', err);
        });
    }
</script>
