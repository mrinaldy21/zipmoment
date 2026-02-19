<div id="music-player" class="fixed bottom-6 left-6 z-[90] flex items-center space-x-3 transition-all duration-500 transform translate-y-20 opacity-0">
    <button onclick="toggleMusic()" class="bg-white/90 dark:bg-gray-800/90 backdrop-blur shadow-lg rounded-full p-3 border border-gray-200 dark:border-gray-700 hover:scale-110 active:scale-95 transition group">
        <div id="music-icon-playing" class="hidden animate-spin-slow">
            <svg class="w-6 h-6 text-[#d4af37]" fill="currentColor" viewBox="0 0 20 20"><path d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM8.94 6.94a.75.75 0 111.06 1.06L8.56 9.5h3.94a.75.75 0 010 1.5H8.56l1.44 1.5a.75.75 0 11-1.06 1.06L6.44 11l2.5-2.5a.75.75 0 010-1.06z"/></svg>
        </div>
        <div id="music-icon-paused" class="">
            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>
        </div>
    </button>
    
    @if($invitation->music_title)
        <div class="bg-white/80 backdrop-blur px-3 py-1 rounded-full border shadow-sm hidden md:block">
            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-tighter animate-pulse">{{ $invitation->music_title }}</p>
        </div>
    @endif

    <audio id="invitation-audio" loop>
        <source src="{{ $invitation->music_url }}" type="audio/mpeg">
    </audio>
</div>

<style>
    @keyframes spin-slow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    .animate-spin-slow {
        animation: spin-slow 8s linear infinite;
    }
</style>

<script>
    const audio = document.getElementById('invitation-audio');
    const player = document.getElementById('music-player');
    const iconPlaying = document.getElementById('music-icon-playing');
    const iconPaused = document.getElementById('music-icon-paused');
    let isPlaying = false;

    // Show player once invitation is opened
    document.addEventListener('invitationOpened', () => {
        player.classList.remove('translate-y-20', 'opacity-0');
        playMusic();
    });

    function toggleMusic() {
        if (isPlaying) {
            pauseMusic();
        } else {
            playMusic();
        }
    }

    function playMusic() {
        audio.play().then(() => {
            isPlaying = true;
            iconPlaying.classList.remove('hidden');
            iconPaused.classList.add('hidden');
        }).catch(e => {
            console.log("Autoplay prevented or failed:", e);
        });
    }

    function pauseMusic() {
        audio.pause();
        isPlaying = false;
        iconPlaying.classList.add('hidden');
        iconPaused.classList.remove('hidden');
    }
</script>
