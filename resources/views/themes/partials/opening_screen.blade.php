<div id="opening-screen" class="fixed inset-0 z-[100] flex flex-col justify-center items-center text-center p-6 transition-all duration-1000 ease-in-out bg-white dark:bg-gray-900">
    @if($invitation->cover_photo_url)
        <div class="absolute inset-0 z-0">
            <img src="{{ $invitation->cover_photo_url }}" class="w-full h-full object-cover opacity-30 dark:opacity-20">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-white dark:to-gray-900"></div>
        </div>
    @endif

    <div class="relative z-10 w-full max-w-lg mx-auto">
        <h3 class="text-lg md:text-xl uppercase tracking-[0.3em] text-gray-500 mb-4">The Wedding Of</h3>
        <h1 class="font-serif text-4xl md:text-6xl mb-8 {{ $theme === 'elegant' ? 'text-[#d4af37]' : ($theme === 'floral' ? 'text-pink-600' : 'text-white') }}">
            {{ $invitation->groom_name }} & {{ $invitation->bride_name }}
        </h1>

        <div class="mb-8">
            <p class="text-sm uppercase tracking-widest text-gray-500 mb-2">Kepada Yth.</p>
            <p class="text-sm uppercase tracking-widest text-gray-500 mb-1">Bapak/Ibu/Saudara/i:</p>
            <h2 class="text-2xl font-bold {{ $theme === 'elegant' ? 'text-[#2c2c2c]' : ($theme === 'floral' ? 'text-gray-800' : 'text-gray-300') }}">
                {{ $guest ?? 'Tamu Undangan' }}
            </h2>
            <p class="text-sm text-gray-500 mt-2">Di Tempat</p>
        </div>

        <button onclick="openInvitation()" class="inline-block px-8 py-3 rounded-full font-bold uppercase tracking-widest transition transform hover:scale-105 active:scale-95 shadow-lg
            {{ $theme === 'elegant' ? 'bg-[#d4af37] text-white hover:bg-[#b8952e]' : ($theme === 'floral' ? 'bg-pink-500 text-white hover:bg-pink-600' : 'bg-white text-black hover:bg-gray-200') }}">
            Buka Undangan
        </button>
    </div>
</div>

<style>
    body.locked {
        overflow: hidden;
    }
</style>

<script>
    document.body.classList.add('locked');

    function openInvitation() {
        const screen = document.getElementById('opening-screen');
        screen.style.transition = 'all 2s cubic-bezier(0.4, 0, 0.2, 1)';
        screen.style.opacity = '0';
        screen.style.filter = 'blur(20px)';
        screen.style.transform = 'scale(1.1)';
        screen.style.pointerEvents = 'none';
        
        setTimeout(() => {
            screen.style.display = 'none';
            document.body.classList.remove('locked');
            // Trigger animations in the main page if any
            document.dispatchEvent(new CustomEvent('invitationOpened'));
        }, 1000);
    }
</script>
