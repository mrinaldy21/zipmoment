<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Manage Guests: ') }} {{ $invitation->title }}
            </h2>
            <a href="{{ route('dashboard.invitations.index') }}" class="text-sm bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 py-1 px-3 rounded hover:bg-gray-300 transition">
                &larr; Back to Invitations
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Add Guest Form -->
                <div class="md:col-span-1">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="font-bold text-gray-900 dark:text-gray-100 mb-4">Add New Guest</h3>
                            <form action="{{ route('dashboard.guests.store', $invitation->id) }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Guest Name</label>
                                    <input type="text" name="name" placeholder="e.g. John Doe & Family" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                </div>
                                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 rounded transition shadow-md">
                                    Generate Link
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Guest List -->
                <div class="md:col-span-2">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            @if(session('success'))
                                <div class="mb-4 p-3 bg-green-100 border-l-4 border-green-500 text-green-700 text-sm">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <h3 class="font-bold text-gray-900 dark:text-gray-100 mb-1">Personalized Invitation Links</h3>
                            <p class="text-sm text-gray-500 mb-4 italic">Klik nama tamu lalu kirim via WhatsApp</p>
                            
                            <div class="space-y-4">
                                @forelse($guests as $guest)
                                    <div class="p-4 bg-gray-50 dark:bg-gray-900/50 rounded-lg border border-gray-100 dark:border-gray-700 shadow-sm">
                                        <div class="flex justify-between items-start mb-3">
                                            <div>
                                                <h4 class="font-bold text-gray-800 dark:text-gray-200">{{ $guest->guest_name }}</h4>
                                                <p class="text-[10px] text-gray-400 truncate max-w-[200px] md:max-w-md">
                                                    {{ config('app.url') }}/i/{{ $invitation->slug }}?to={{ urlencode($guest->guest_name) }}
                                                </p>
                                            </div>
                                            <form action="{{ route('dashboard.guests.destroy', [$invitation->id, $guest->id]) }}" method="POST" onsubmit="return confirm('Remove this guest?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 transition">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                        
                                        <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2">
                                            <button onclick="sendWhatsApp('{{ $guest->guest_name }}', '{{ $invitation->slug }}')" 
                                                class="flex-1 bg-green-500 hover:bg-green-600 text-white py-2 px-3 rounded-lg text-sm font-bold transition flex items-center justify-center shadow-sm">
                                                <svg class="h-4 w-4 mr-2 fill-current" viewBox="0 0 24 24">
                                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.412-.003 6.557-5.338 11.892-11.893 11.892-1.997-.001-3.951-.5-5.688-1.448l-6.309 1.656zm6.224-3.92s.214.128.404.209c1.51.643 3.157.982 4.846.983 6.005 0 10.895-4.89 10.898-10.891 0-2.903-1.13-5.633-3.186-7.689-2.056-2.055-4.787-3.184-7.688-3.184-5.999 0-10.89 4.89-10.892 10.892-.001 1.917.499 3.791 1.447 5.411l.244.417-1.11 4.053s1.107-.291 3.107-.81l.301.21z"/>
                                                </svg>
                                                Send WhatsApp
                                            </button>

                                            <button onclick="copyText('{{ $guest->guest_name }}', '{{ $invitation->slug }}')" 
                                                class="flex-1 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-2 px-3 rounded-lg text-sm transition flex items-center justify-center hover:bg-gray-50 dark:hover:bg-gray-700">
                                                Copy Text
                                            </button>
                                            
                                            <button onclick="copyLink('{{ config('app.url') }}/i/{{ $invitation->slug }}?to={{ urlencode($guest->guest_name) }}')" 
                                                class="flex-1 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-2 px-3 rounded-lg text-sm transition flex items-center justify-center hover:bg-gray-50 dark:hover:bg-gray-700">
                                                Copy Link
                                            </button>
                                        </div>
                                    </div>
                                @empty
                                    <div class="py-12 text-center text-gray-500">
                                        <p class="italic">No guests added yet.</p>
                                        <p class="text-sm mt-1">Add guest names to generate unique invitation links.</p>
                                    </div>
                                @endforelse
                                
                                <div class="mt-4">
                                    {{ $guests->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <!-- Toast Container -->
    <div id="toast-container" class="fixed top-5 right-5 z-[100] space-y-3 pointer-events-none"></div>

    <script>
        const appUrl = "{{ rtrim(config('app.url'), '/') }}";
        const groomName = "{{ $invitation->groom_name }}";
        const brideName = "{{ $invitation->bride_name }}";

        function generateMessage(guestName, slug) {
            // 1. Build invitation link normally with ?to=encoded guest name
            const guestNameEncoded = encodeURIComponent(guestName);
            const link = `${appUrl}/i/${slug}?to=${guestNameEncoded}`;
            
            // 2. Build full message string
            return `Kepada Yth.
Bapak/Ibu/Saudara/i
*${guestName}*

---

Assalamualaikum Warahmatullahi Wabarakatuh

Tanpa mengurangi rasa hormat, perkenankan kami mengundang Bapak/Ibu/Saudara/i, teman sekaligus sahabat, untuk menghadiri acara pernikahan kami.

Berikut link undangan kami, untuk info lengkap dari acara, bisa kunjungi :

${link}

Merupakan suatu kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan untuk hadir dan memberikan doa restu.

Mohon maaf perihal undangan hanya di bagikan melalui pesan ini.

Wassalamualaikum Warahmatullahi Wabarakatuh

Terima Kasih

Hormat kami,
*${groomName} & ${brideName}*`;
        }

        function showToast(message) {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = 'bg-gray-900 text-white px-6 py-3 rounded-xl shadow-2xl transform transition-all duration-300 ease-out translate-x-12 opacity-0 flex items-center font-medium pointer-events-auto';
            toast.innerHTML = `
                <svg class="w-5 h-5 mr-3 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                ${message}
            `;
            container.appendChild(toast);

            // Animate in
            requestAnimationFrame(() => {
                toast.classList.remove('translate-x-12', 'opacity-0');
            });

            // Animate out and remove
            setTimeout(() => {
                toast.classList.add('translate-x-12', 'opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 2500);
        }

        function sendWhatsApp(guestName, slug) {
            const message = generateMessage(guestName, slug);
            // 3. Apply encodeURIComponent(message)
            const waUrl = `https://wa.me/?text=${encodeURIComponent(message)}`;
            window.open(waUrl, '_blank');
        }

        function copyText(guestName, slug) {
            const message = generateMessage(guestName, slug);
            navigator.clipboard.writeText(message).then(() => {
                showToast('Pesan disalin');
            });
        }

        function copyLink(link) {
            navigator.clipboard.writeText(link).then(() => {
                showToast('Link dikopi');
            });
        }
    </script>
</x-app-layout>
