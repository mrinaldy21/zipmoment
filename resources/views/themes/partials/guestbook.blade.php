<div class="mt-16 pt-16 border-t {{ $theme === 'elegant' ? 'border-[#d4af37]/20' : ($theme === 'floral' ? 'border-pink-100' : 'border-gray-800') }}">
    <h3 class="font-cursive text-4xl text-center mb-8 {{ $theme === 'elegant' ? 'text-[#d4af37]' : ($theme === 'floral' ? 'text-pink-600' : 'text-white') }}">
        Ucapan & Doa
    </h3>

    <div class="max-w-2xl mx-auto px-4">
        <!-- Message Form -->
        <div class="bg-white dark:bg-gray-800/50 p-6 rounded-2xl shadow-sm border {{ $theme === 'elegant' ? 'border-[#d4af37]/30' : ($theme === 'floral' ? 'border-pink-200' : 'border-gray-700') }} mb-12">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg text-sm">
                    {{ session('error') }}
                </div>
            @endif

            @if(!empty($guest))
                <form action="{{ route('guestbook.store', $invitation->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="guest_name" value="{{ $guest }}">
                    
                    <div class="mb-4">
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-2">Nama</label>
                        <input type="text" value="{{ $guest }}" readonly class="w-full bg-gray-50 border-gray-200 rounded-lg text-gray-600 focus:ring-0 cursor-not-allowed">
                    </div>

                    <div class="mb-6">
                        <label class="block text-xs uppercase tracking-widest text-gray-500 mb-2">Pesan Ucapan</label>
                        <textarea name="message" rows="4" required maxlength="500" placeholder="Berikan ucapan selamat & doa restu..." 
                            class="w-full border-gray-200 rounded-lg focus:ring-2 {{ $theme === 'elegant' ? 'focus:ring-[#d4af37]' : ($theme === 'floral' ? 'focus:ring-pink-400' : 'focus:ring-gray-500') }} dark:bg-gray-700 dark:border-gray-600"></textarea>
                        @error('message')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full py-3 rounded-xl font-bold uppercase tracking-widest transition
                        {{ $theme === 'elegant' ? 'bg-[#d4af37] text-white hover:bg-[#b8952e]' : ($theme === 'floral' ? 'bg-pink-500 text-white hover:bg-pink-600' : 'bg-white text-black hover:bg-gray-200 border border-gray-300') }}">
                        Kirim Ucapan
                    </button>
                </form>
            @else
                <div class="text-center py-4">
                    <p class="text-gray-500 italic">Hanya tamu undangan yang dapat memberikan ucapan</p>
                </div>
            @endif
        </div>

        <!-- Message List -->
        <div class="space-y-6">
            @forelse($invitation->messages as $msg)
                <div class="bg-white dark:bg-gray-800/30 p-5 rounded-2xl border {{ $theme === 'elegant' ? 'border-[#d4af37]/10' : ($theme === 'floral' ? 'border-pink-50' : 'border-gray-800') }} shadow-sm">
                    <div class="flex justify-between items-start mb-2">
                        <h4 class="font-bold text-lg {{ $theme === 'elegant' ? 'text-[#2c2c2c]' : ($theme === 'floral' ? 'text-gray-800' : 'text-gray-200') }}">
                            {{ $msg->guest_name }}
                        </h4>
                        <span class="text-[10px] text-gray-400 uppercase tracking-tighter">
                            {{ $msg->created_at->translatedFormat('d M Y, H:i') }}
                        </span>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                        {{ $msg->message }}
                    </p>
                </div>
            @empty
                <p class="text-center text-gray-400 text-sm italic">Belum ada ucapan</p>
            @endforelse
        </div>
    </div>
</div>
