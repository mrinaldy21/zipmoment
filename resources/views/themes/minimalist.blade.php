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
                <p class="text-[10px] uppercase tracking-widest opacity-40 leading-relaxed">{{ $invitation->groom_description }}</p>
            </div>

            <!-- Bride -->
            <div class="scroll-reveal" style="transition-delay: 200ms;">
                <img src="{{ $invitation->bride_photo_url ?? 'https://via.placeholder.com/400x500' }}" class="w-full aspect-[4/5] object-cover rounded-sm mb-8 filter grayscale hover:grayscale-0 transition duration-1000 shadow-sm">
                <h3 class="font-serif text-3xl italic mb-2">{{ $invitation->bride_name }}</h3>
                <p class="text-[10px] uppercase tracking-widest opacity-40 leading-relaxed">{{ $invitation->bride_description }}</p>
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

    <!-- Footer -->
    <footer class="py-20 border-t border-[var(--border-minimalist)] text-center">
        <div class="mb-8">
            <img src="{{ asset('images/logo.png') }}" alt="ZipMoment" class="h-8 mx-auto opacity-30 grayscale rounded-lg">
        </div>
        <p class="text-[9px] uppercase tracking-[0.4em] opacity-30">&copy; 2026 Crafted by ZipMoment</p>
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
