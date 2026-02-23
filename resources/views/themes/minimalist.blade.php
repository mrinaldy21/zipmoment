<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invitation->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        :root {
            --bg-minimalist: #f8f9fa;
            --text-minimalist: #2c2c2c;
            --accent-minimalist: #1a1a1a;
            --border-minimalist: rgba(0,0,0,0.05);
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --bg-minimalist: #121212;
                --text-minimalist: #e0e0e0;
                --accent-minimalist: #ffffff;
                --border-minimalist: rgba(255,255,255,0.05);
            }
        }

        .font-serif { font-family: 'Bodoni Moda', serif; }
        .font-sans { font-family: 'Inter', sans-serif; }
        
        body { background-color: var(--bg-minimalist); color: var(--text-minimalist); }

        .scroll-reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .scroll-reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .minimal-line {
            width: 40px;
            height: 1px;
            background: var(--accent-minimalist);
            opacity: 0.2;
            margin: 2rem auto;
        }
    </style>
</head>
<body class="font-sans antialiased overflow-x-hidden selection:bg-black selection:text-white">
    
    @include('themes.partials.opening_screen', ['theme' => 'minimalist'])
    @include('themes.partials.music_player', ['theme' => 'minimalist'])
    
    <!-- Hero Section -->
    <section class="relative min-h-screen flex flex-col justify-center items-center text-center p-8 bg-white dark:bg-black">
        <div class="animate__animated animate__fadeIn">
            <span class="text-[10px] uppercase tracking-[0.6em] font-semibold opacity-40 mb-8 block">The Union of Souls</span>
            <h1 class="font-serif text-5xl md:text-8xl mb-4 italic tracking-tighter">{{ $invitation->groom_name }}</h1>
            <p class="font-serif text-2xl md:text-4xl opacity-20 my-4">&</p>
            <h1 class="font-serif text-5xl md:text-8xl mb-12 italic tracking-tighter">{{ $invitation->bride_name }}</h1>
            
            <div class="minimal-line"></div>
            
            <p class="text-sm md:text-lg tracking-[0.4em] uppercase font-light">
                {{ \Carbon\Carbon::parse($invitation->event_date)->translatedFormat('d F Y') }}
            </p>

            <div class="mt-12">
                @include('themes.partials.countdown')
            </div>
        </div>

        <div class="absolute bottom-12 left-1/2 -translate-x-1/2 animate-bounce opacity-20">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 14l-7 7-7-7"></path></svg>
        </div>
    </section>

    <!-- Couple Section -->
    <section class="py-32 px-6 max-w-4xl mx-auto text-center">
        <div class="scroll-reveal mb-24">
            <h2 class="font-serif text-3xl md:text-5xl italic mb-4">Together as One</h2>
            <div class="minimal-line w-20"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-20">
            <!-- Groom -->
            <div class="scroll-reveal">
                <img src="{{ $invitation->groom_photo_url ?? 'https://via.placeholder.com/400x500' }}" class="w-full aspect-[4/5] object-cover rounded-sm mb-8 filter grayscale hover:grayscale-0 transition duration-1000 shadow-sm">
                <h3 class="font-serif text-3xl italic mb-2">{{ $invitation->groom_name }}</h3>
                <p class="text-[10px] uppercase tracking-widest opacity-40 leading-relaxed whitespace-pre-line">{{ $invitation->groom_parent_text }}</p>
            </div>

            <!-- Bride -->
            <div class="scroll-reveal" style="transition-delay: 200ms;">
                <img src="{{ $invitation->bride_photo_url ?? 'https://via.placeholder.com/400x500' }}" class="w-full aspect-[4/5] object-cover rounded-sm mb-8 filter grayscale hover:grayscale-0 transition duration-1000 shadow-sm">
                <h3 class="font-serif text-3xl italic mb-2">{{ $invitation->bride_name }}</h3>
                <p class="text-[10px] uppercase tracking-widest opacity-40 leading-relaxed whitespace-pre-line">{{ $invitation->bride_parent_text }}</p>
            </div>
        </div>
    </section>

    <!-- Event Section -->
    <section class="py-32 bg-white dark:bg-black/50 border-y border-[var(--border-minimalist)]">
        <div class="max-w-4xl mx-auto px-8 text-center">
            <div class="scroll-reveal">
                <h2 class="font-serif text-3xl md:text-5xl italic mb-12">The Celebration</h2>
                
                @foreach($invitation->events as $event)
                <div class="mb-20 last:mb-0">
                    <span class="text-[10px] uppercase tracking-[0.5em] font-bold opacity-30 block mb-4">{{ $event->name }}</span>
                    <h4 class="font-serif text-2xl italic mb-4">{{ \Carbon\Carbon::parse($event->date)->translatedFormat('l, d F Y') }}</h4>
                    <p class="text-sm opacity-60 mb-2">{{ $event->start_time }} - {{ $event->end_time ?? 'Selesai' }}</p>
                    <p class="text-xs uppercase tracking-widest mb-6">{{ $event->location }}</p>
                    
                    @if($event->maps_link)
                    <a href="{{ $event->maps_link }}" target="_blank" class="inline-block px-8 py-3 border border-[var(--accent-minimalist)] text-[10px] uppercase tracking-[0.3em] hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition-all">View Location</a>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Love Story Section -->
    @if($invitation->loveStories->count() > 0)
    <section class="py-32 px-6 max-w-4xl mx-auto">
        <div class="text-center mb-16 scroll-reveal">
            <h2 class="font-serif text-3xl italic">Our Story</h2>
            <div class="minimal-line w-20"></div>
        </div>

        <div class="space-y-24">
            @foreach($invitation->loveStories as $story)
            <div class="scroll-reveal grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="{{ $loop->iteration % 2 == 0 ? 'md:order-2' : '' }}">
                    @if($story->photo_url)
                        <img src="{{ $story->photo_url }}" class="w-full aspect-video object-cover rounded shadow-sm grayscale hover:grayscale-0 transition duration-1000">
                    @endif
                </div>
                <div class="text-center md:text-left {{ $loop->iteration % 2 == 0 ? 'md:text-right' : '' }}">
                    <h4 class="font-serif text-2xl italic mb-4">{{ $story->title }}</h4>
                    <p class="text-xs leading-relaxed opacity-60 italic">{{ $story->description }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Gallery Section -->
    <section class="py-32 px-4 max-w-6xl mx-auto">
        <div class="text-center mb-16 scroll-reveal">
            <h2 class="font-serif text-3xl italic">The Gallery</h2>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($invitation->galleries as $photo)
            <div class="scroll-reveal aspect-square overflow-hidden group">
                <img src="{{ $photo->photo_url }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-700">
            </div>
            @endforeach
        </div>
    </section>

    <!-- Wedding Gift Section -->
    @if($invitation->gift_bank_pria || $invitation->gift_bank_wanita)
    <section class="py-32 px-6 max-w-4xl mx-auto text-center">
        <div class="scroll-reveal mb-16">
            <h2 class="font-serif text-3xl italic">Wedding Gift</h2>
            <div class="minimal-line w-20"></div>
            <p class="text-xs opacity-40 italic max-w-md mx-auto">Doa restu Anda adalah karunia terindah bagi kami. Namun jika Anda ingin memberikan tanda kasih, Anda dapat mengirimkannya melalui:</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-2xl mx-auto">
            @if($invitation->gift_bank_pria)
            <div class="scroll-reveal p-10 border border-[var(--border-minimalist)] rounded-sm">
                <p class="text-[10px] uppercase tracking-widest opacity-30 mb-4">Transfer Pria</p>
                <h4 class="font-serif text-xl mb-1 italic">{{ $invitation->gift_bank_pria }}</h4>
                <p class="text-[10px] font-bold uppercase tracking-widest opacity-60">{{ $invitation->gift_bank_pria_name }}</p>
            </div>
            @endif
            @if($invitation->gift_bank_wanita)
            <div class="scroll-reveal p-10 border border-[var(--border-minimalist)] rounded-sm">
                <p class="text-[10px] uppercase tracking-widest opacity-30 mb-4">Transfer Wanita</p>
                <h4 class="font-serif text-xl mb-1 italic">{{ $invitation->gift_bank_wanita }}</h4>
                <p class="text-[10px] font-bold uppercase tracking-widest opacity-60">{{ $invitation->gift_bank_wanita_name }}</p>
            </div>
            @endif
        </div>
    </section>
    @endif

    <!-- Guestbook Section -->
    <section class="py-32 bg-white dark:bg-black/20">
        <div class="max-w-2xl mx-auto px-6">
            <div class="text-center mb-16 scroll-reveal">
                <h2 class="font-serif text-3xl italic">Wishes</h2>
                <div class="minimal-line w-20"></div>
            </div>
            @include('themes.partials.guestbook', ['theme' => 'minimalist'])
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-16 px-6 text-center bg-white border-t border-stone-100">
        <h3 class="text-4xl gold-text mb-8" style="font-family:'Pinyon Script', sans-serif;">{{ $invitation->groom_name }} & {{ $invitation->bride_name }}</h3>
        <p class="text-xs uppercase tracking-[0.3em] text-gray-400 mb-12">Thank You for Being Part of Our Day</p>
        
        <div class="flex flex-col items-center space-y-4">
             @if($invitation->is_watermark_enabled)
             <div class="mt-8 pt-8 border-t border-gray-100 flex flex-col items-center group/wm">
                <!-- Main Watermark (Removable) -->
                <span class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-300 mb-2">Designed with</span>
                <div class="flex items-center space-x-2 grayscale opacity-40 hover:opacity-100 hover:grayscale-0 transition-all duration-700 cursor-pointer">
                    <img src="{{ asset('images/logo.png') }}" 
                    alt="ZipMoment Logo"
                    class="h-8 md:h-10 object-contain rounded-xl shadow-lg">
                </div>
                <p class="text-[9px] text-gray-400 mt-2 font-medium">Create your exclusive invitation at <span class="text-amber-950 font-bold">zipmoment.id</span></p>
             </div>
             @endif
             
             <!-- Boutique Signature (Permanent) -->
             <div class="mt-8 opacity-20 hover:opacity-100 transition-opacity duration-1000">
                <span class="text-[8px] font-serif italic tracking-[0.2em] text-gray-400">Experience by ZipMoment</span>
             </div>

             <div class="flex space-x-4 text-gray-300">
                @if($invitation->contact_phone)
                    <a href="tel:{{ $invitation->contact_phone }}" class="hover:gold-text transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1c-5.078 0-9.263-4.185-10.27-9.27L3 5z"></path></svg></a>
                @endif
                @if($invitation->contact_instagram)
                    <a href="https://instagram.com/{{ ltrim($invitation->contact_instagram, '@') }}" class="hover:gold-text transition"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
                @endif
             </div>
             <p class="text-[10px] text-gray-400 mt-4">&copy; {{ date('Y') }} {{ $invitation->footer_website ?? 'ZipMoment' }}. All Rights Reserved.</p>
        </div>
    </footer>

    @include('themes.partials.template_cta')
    <script>
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.scroll-reveal').forEach(el => observer.observe(el));
    </script>
</body>
</html>
