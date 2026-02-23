<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invitation->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700;900&family=Metrophobic&family=Bormi:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        :root {
            --cinematic-gold: #d4af37;
            --cinematic-dark: #050505;
        }
        
        .hero-title {
            font-size: clamp(3.5rem, 15vw, 8rem);
            line-height: 0.9;
            letter-spacing: -0.05em;
            text-shadow: 0 10px 30px rgba(0,0,0,0.5);
            background: linear-gradient(to bottom, #fff 0%, #a1a1a1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .cinematic-depth {
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        .opening-reveal {
            animation: cinematicReveal 2.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes cinematicReveal {
            0% { transform: scale(1.1) translateY(20px); opacity: 0; filter: blur(10px); }
            100% { transform: scale(1) translateY(0); opacity: 1; filter: blur(0); }
        }

        .cinematic-reveal {
            opacity: 0;
            clip-path: inset(0 100% 0 0);
            transition: all 1.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .cinematic-reveal.visible {
            opacity: 1;
            clip-path: inset(0 0 0 0);
        }

        .scroll-reveal {
            opacity: 0;
            transform: translateY(60px);
            transition: all 1.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .scroll-reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .parallax-zoom {
            transform: scale(1.1);
            transition: transform 12s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .parallax-zoom.visible {
            transform: scale(1);
        }
    </style>
</head>
<body class="font-body antialiased overflow-x-hidden selection:bg-amber-500 selection:text-black">
    
    @include('themes.partials.opening_screen', ['theme' => 'cinematic'])
    @include('themes.partials.music_player', ['theme' => 'cinematic'])
    
    <!-- Hero Section -->
    <section class="relative h-screen flex flex-col justify-center items-center text-center p-8 overflow-hidden bg-black cinematic-depth">
        <div class="absolute inset-0 z-0">
            <img src="{{ $invitation->cover_photo_url }}" class="w-full h-full object-cover opacity-40 parallax-zoom scroll-reveal scale-105" alt="Cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-black/60"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,transparent_0%,black_100%)] opacity-70"></div>
        </div>

        <div class="relative z-10 w-full max-w-5xl mx-auto opening-reveal">
            
            <h3 class="md:text-xl uppercase tracking-[0.5em] mb-6 md:mb-8 text-gray-400">The Wedding Of</h3>
            <div class="overflow-hidden mb-8">
                <h1 class="font-header hero-title uppercase scroll-reveal italic" style="transition-delay: 200ms;">
                    {{ $invitation->groom_name }}
                </h1>
            </div>
            
            <div class="h-[1px] w-24 bg-gradient-to-r from-transparent via-amber-500/50 to-transparent mx-auto my-12 scroll-reveal" style="transition-delay: 400ms;"></div>
            
            <div class="overflow-hidden">
                <h1 class="font-header hero-title uppercase scroll-reveal italic" style="transition-delay: 600ms;">
                    {{ $invitation->bride_name }}
                </h1>
            </div>

            <div class="mt-16 scroll-reveal" style="transition-delay: 800ms;">
                <p class="text-xl md:text-2xl font-header tracking-[0.5em] text-white/80 uppercase mb-12">
                    {{ \Carbon\Carbon::parse($invitation->event_date)->translatedFormat('d F Y') }}
                </p>
                <div class="mb-12">
                    @include('themes.partials.countdown')
                </div>
            </div>
        </div>

        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 text-[8px] uppercase tracking-[0.4em] opacity-40 animate-pulse font-black">
            Scroll to Enter the Story
        </div>
    </section>

    <!-- Section: Intro Narrative -->
    <section class="py-40 md:py-60 relative px-6 bg-[var(--bg-cinematic)]">
        <div class="max-w-4xl mx-auto text-center scroll-reveal">
            <div class="w-px h-24 bg-gradient-to-b from-amber-500/50 to-transparent mx-auto mb-16"></div>
            <h2 class="font-header text-2xl md:text-4xl leading-relaxed mb-12 font-black italic">
                "Two souls with but a single thought, <br> two hearts that beat as one."
            </h2>
            <p class="text-sm md:text-base opacity-40 uppercase tracking-[0.3em] font-light">The Narrative Begins</p>
        </div>
    </section>

    <!-- Couple Details with Depth -->
    <section class="py-20 relative overflow-hidden bg-black/50">
        <!-- Groom Layer -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-0">
            <div class="relative h-[60vh] md:h-screen overflow-hidden scroll-reveal">
                <img src="{{ $invitation->groom_photo_url ?? 'https://via.placeholder.com/800x1000' }}" class="w-full h-full object-cover grayscale brightness-50 hover:grayscale-0 hover:brightness-100 transition duration-[3s]">
                <div class="absolute inset-0 bg-gradient-to-r from-black/80 to-transparent flex items-center p-12 lg:p-24">
                    <div class="cinematic-reveal">
                        <span class="text-amber-500 font-black text-xs uppercase tracking-[0.4em] mb-4 block">The Gentleman</span>
                        <h3 class="font-header text-4xl md:text-7xl font-black uppercase mb-6">{{ $invitation->groom_name }}</h3>
                        <p class="text-[10px] md:text-xs text-white/50 leading-loose max-w-sm uppercase tracking-widest whitespace-pre-line">{{ $invitation->groom_parent_text }}</p>
                    </div>
                </div>
            </div>
            <!-- Bride Layer -->
            <div class="relative h-[60vh] md:h-screen overflow-hidden scroll-reveal" style="transition-delay: 200ms;">
                <img src="{{ $invitation->bride_photo_url ?? 'https://via.placeholder.com/800x1000' }}" class="w-full h-full object-cover grayscale brightness-50 hover:grayscale-0 hover:brightness-100 transition duration-[3s]">
                <div class="absolute inset-0 bg-gradient-to-l from-black/80 to-transparent flex items-center justify-end text-right p-12 lg:p-24">
                    <div class="cinematic-reveal text-right">
                        <span class="text-amber-500 font-black text-xs uppercase tracking-[0.4em] mb-4 block">The Lady</span>
                        <h3 class="font-header text-4xl md:text-7xl font-black uppercase mb-6">{{ $invitation->bride_name }}</h3>
                        <p class="text-[10px] md:text-xs text-white/50 leading-loose max-w-sm uppercase tracking-widest ml-auto whitespace-pre-line">{{ $invitation->bride_parent_text }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Events with Luxurious Reveal -->
    <section class="py-40 bg-[var(--bg-cinematic)]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-32 scroll-reveal text-amber-500 font-header">
                <h2 class="text-4xl md:text-6xl font-black uppercase tracking-widest">The Ceremony</h2>
                <div class="h-px w-40 bg-current mx-auto mt-8 opacity-20"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-px bg-[var(--border-cinematic)]">
                @foreach($invitation->events as $event)
                <div class="p-16 md:p-24 bg-[var(--bg-cinematic)] scroll-reveal">
                    <div class="h-full border-l-4 border-amber-500/20 pl-8 transition-colors hover:border-amber-500 duration-1000">
                        <span class="text-[9px] font-black uppercase tracking-[1em] opacity-40 mb-12 block">{{ $event->name }}</span>
                        <h3 class="font-header text-3xl md:text-5xl font-black uppercase mb-6">{{ \Carbon\Carbon::parse($event->date)->translatedFormat('d F Y') }}</h3>
                        <p class="text-xl md:text-2xl font-light mb-12 tracking-widest opacity-60">{{ $event->start_time }} — {{ $event->end_time ?? 'LATE' }}</p>
                        <p class="text-[10px] uppercase font-bold tracking-[0.4em] mb-12 opacity-30">{{ $event->location }}</p>
                        
                        @if($event->maps_link)
                        <a href="{{ $event->maps_link }}" target="_blank" class="inline-flex items-center space-x-6 text-amber-500 hover:text-white transition-colors duration-500 group">
                            <span class="text-[10px] font-black uppercase tracking-[0.5em]">Open Coordinates</span>
                            <div class="w-12 h-12 rounded-full border border-amber-500/20 flex items-center justify-center group-hover:bg-amber-500 group-hover:border-amber-500 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </div>
                        </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Love Story Section -->
    @if($invitation->loveStories->count() > 0)
    <div class="py-40 bg-black">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-32 scroll-reveal text-amber-500 font-header">
                <h2 class="text-4xl md:text-6xl font-black uppercase tracking-widest italic">Our Narrative</h2>
                <div class="h-px w-40 bg-current mx-auto mt-8 opacity-20"></div>
            </div>

            <div class="space-y-1">
                @foreach($invitation->loveStories as $story)
                    <div class="scroll-reveal group relative h-[50vh] md:h-[70vh] overflow-hidden">
                        @if($story->photo_url)
                            <img src="{{ $story->photo_url }}" class="absolute inset-0 w-full h-full object-cover grayscale brightness-50 group-hover:grayscale-0 group-hover:brightness-100 transition duration-[3s]">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent flex items-end p-12 md:p-24">
                            <div class="max-w-2xl">
                                <h4 class="font-header text-3xl md:text-5xl font-black uppercase mb-6 text-amber-500 italic">{{ $story->title }}</h4>
                                <p class="text-xs md:text-sm text-white/70 leading-loose uppercase tracking-[0.2em]">{{ $story->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Immersive Gallery -->
    <section class="py-40 bg-black">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-1">
            @foreach($invitation->galleries as $photo)
            <div class="relative aspect-[3/4] overflow-hidden scroll-reveal group">
                <img src="{{ $photo->photo_url }}" class="w-full h-full object-cover grayscale brightness-75 group-hover:grayscale-0 group-hover:brightness-100 group-hover:scale-110 transition duration-[3s]">
            </div>
            @endforeach
        </div>
    </section>

    <!-- Wedding Gift Section -->
    @if($invitation->gift_bank_pria || $invitation->gift_bank_wanita)
    <div class="py-40 bg-black/80">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <div class="scroll-reveal mb-24">
                <h2 class="font-header text-4xl md:text-6xl font-black uppercase tracking-widest text-amber-500 italic">Curated Gifts</h2>
                <p class="text-[10px] md:text-xs text-white/30 uppercase tracking-[0.5em] mt-8">Your presence is our primary gift. Should you wish to express more:</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-1 max-w-4xl mx-auto bg-amber-500/10">
                @if($invitation->gift_bank_pria)
                <div class="p-16 bg-black flex flex-col items-center justify-center">
                    <span class="text-amber-500/40 font-black text-[10px] uppercase tracking-[0.4em] mb-8">Paternal Transfer</span>
                    <h4 class="font-header text-2xl md:text-3xl font-black text-white mb-2 italic tracking-widest">{{ $invitation->gift_bank_pria }}</h4>
                    <p class="text-[10px] font-bold text-white/40 uppercase tracking-[0.3em]">{{ $invitation->gift_bank_pria_name }}</p>
                </div>
                @endif
                @if($invitation->gift_bank_wanita)
                <div class="p-16 bg-black flex flex-col items-center justify-center">
                    <span class="text-amber-500/40 font-black text-[10px] uppercase tracking-[0.4em] mb-8">Maternal Transfer</span>
                    <h4 class="font-header text-2xl md:text-3xl font-black text-white mb-2 italic tracking-widest">{{ $invitation->gift_bank_wanita }}</h4>
                    <p class="text-[10px] font-bold text-white/40 uppercase tracking-[0.3em]">{{ $invitation->gift_bank_wanita_name }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif

    <!-- Guestbook Section -->
    <section class="py-40 bg-black border-y border-white/5">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-24 scroll-reveal">
                <h2 class="font-header text-4xl md:text-6xl font-black uppercase tracking-widest text-amber-500 italic">Guestbook</h2>
                <div class="h-px w-40 bg-amber-500/20 mx-auto mt-8"></div>
            </div>
            @include('themes.partials.guestbook', ['theme' => 'cinematic'])
        </div>
    </section>

    <!-- Footer: The End Credits -->
    <footer class="py-16 text-center border-t border-gray-900 bg-stone-950">
        <h3 class="font-header text-2xl text-white mb-4 tracking-widest">{{ $invitation->groom_name }} & {{ $invitation->bride_name }}</h3>
        @if($invitation->is_watermark_enabled)
        <div class="mt-12 pt-12 border-t border-gray-900 flex flex-col items-center group/wm">
           <span class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-700 mb-4">Architected by</span>
           <div class="flex items-center space-x-3 grayscale opacity-30 hover:opacity-100 hover:grayscale-0 transition-all duration-1000 cursor-pointer">
               <img src="{{ asset('images/logo.png') }}" 
                    alt="ZipMoment Logo"
                    class="h-8 md:h-10 object-contain rounded-xl shadow-lg">
           </div>
           <p class="text-[9px] text-gray-600 mt-4 font-light tracking-widest uppercase">Experience the peak of digital storytelling at <span class="text-white">zipmoment.id</span></p>
        </div>
        @endif

        <!-- Boutique Signature (Permanent) -->
        <div class="mt-12 opacity-10 hover:opacity-60 transition-opacity duration-1000">
           <span class="text-[8px] font-header italic tracking-[0.4em] text-gray-500 uppercase">Experience by ZipMoment</span>
        </div>
        <p class="text-[10px] uppercase tracking-widest text-gray-600 mt-8">Created for Eternity &bull; {{ date('Y') }}</p>
    </footer>

    @include('themes.partials.template_cta')
    <script>
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    if(entry.target.classList.contains('cinematic-reveal')) {
                         entry.target.style.transitionDelay = '400ms';
                    }
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.scroll-reveal, .cinematic-reveal, .parallax-zoom').forEach(el => observer.observe(el));
    </script>
</body>
</html>
