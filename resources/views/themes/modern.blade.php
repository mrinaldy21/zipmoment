<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invitation->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Montserrat:wght@200;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        .font-header { font-family: 'Cinzel', serif; }
        .font-body { font-family: 'Montserrat', sans-serif; }
        
        body { background-color: #0a0a0a; color: #e5e5e5; }
        
        .modern-border { border-color: #333; }
        .modern-accent { color: #888; }
        
        .timeline-line {
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 1px;
            background: #333;
            transform: translateX(-50%);
        }

        .scroll-reveal {
            opacity: 0;
            transform: scale(0.98) translateY(10px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .scroll-reveal.visible {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    </style>
</head>
<body class="font-body antialiased overflow-x-hidden">
    
    @include('themes.partials.opening_screen', ['theme' => 'modern'])
    @include('themes.partials.music_player', ['theme' => 'modern'])
    
    <!-- Hero Section -->
    <section class="relative min-h-screen flex flex-col justify-center items-center text-center p-6 bg-black overflow-hidden">
        @if($invitation->cover_photo_url)
            <div class="absolute inset-0 z-0 opacity-50">
                <img src="{{ $invitation->cover_photo_url }}" class="w-full h-full object-cover grayscale brightness-50">
            </div>
        @endif
        
        <div class="relative z-10 animate__animated animate__fadeIn">
            <h3 class="text-xs uppercase tracking-[0.5em] mb-8 text-gray-400">Union of Two Souls</h3>
            <div class="space-y-4 mb-12">
                <h1 class="font-header text-5xl md:text-8xl text-white tracking-widest uppercase">{{ $invitation->groom_name }}</h1>
                <p class="text-2xl font-thin text-gray-500 italic">&</p>
                <h1 class="font-header text-5xl md:text-8xl text-white tracking-widest uppercase">{{ $invitation->bride_name }}</h1>
            </div>
            
            <div class="flex justify-center mb-12">
                @include('themes.partials.countdown')
            </div>

            <p class="text-sm tracking-[0.3em] font-light uppercase border-t border-b border-gray-800 py-4 inline-block">
                {{ \Carbon\Carbon::parse($invitation->event_date)->translatedFormat('d F Y') }}
            </p>
        </div>
    </section>

    <!-- Couple Section -->
    <section class="py-32 px-6 max-w-5xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-24 items-center">
            <!-- Groom -->
            <div class="scroll-reveal text-center md:text-right">
                <div class="relative inline-block mb-10 overflow-hidden group">
                    <img src="{{ $invitation->groom_photo_url ?? 'https://via.placeholder.com/400' }}" class="w-80 h-96 object-cover grayscale hover:grayscale-0 transition duration-1000 transform hover:scale-105">
                    <div class="absolute bottom-4 right-4 bg-black/50 backdrop-blur p-2 border border-white/20">
                         <span class="text-[10px] uppercase tracking-widest text-white">The Groom</span>
                    </div>
                </div>
                <h3 class="font-header text-4xl text-white mb-4 tracking-tight">{{ $invitation->groom_name }}</h3>
                <p class="text-[10px] uppercase text-gray-500 tracking-[0.2em] mb-4 whitespace-pre-line">{{ $invitation->groom_parent_text }}</p>
                @if($invitation->groom_instagram)
                    <a href="#" class="text-[10px] uppercase tracking-[0.2em] border-b border-gray-700 hover:border-white transition pb-1">Instagram Account</a>
                @endif
            </div>

            <!-- Bride -->
            <div class="scroll-reveal text-center md:text-left">
                <div class="relative inline-block mb-10 overflow-hidden group">
                    <img src="{{ $invitation->bride_photo_url ?? 'https://via.placeholder.com/400' }}" class="w-80 h-96 object-cover grayscale hover:grayscale-0 transition duration-1000 transform hover:scale-105">
                    <div class="absolute bottom-4 left-4 bg-black/50 backdrop-blur p-2 border border-white/20">
                         <span class="text-[10px] uppercase tracking-widest text-white">The Bride</span>
                    </div>
                </div>
                <h3 class="font-header text-4xl text-white mb-4 tracking-tight">{{ $invitation->bride_name }}</h3>
                <p class="text-[10px] uppercase text-gray-500 tracking-[0.2em] mb-4 whitespace-pre-line">{{ $invitation->bride_parent_text }}</p>
                @if($invitation->bride_instagram)
                    <a href="#" class="text-[10px] uppercase tracking-[0.2em] border-b border-gray-700 hover:border-white transition pb-1">Instagram Account</a>
                @endif
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section class="py-32 px-6 bg-stone-950">
        <div class="max-w-6xl mx-auto">
            <div class="scroll-reveal mb-20 text-center md:text-left">
                <h2 class="font-header text-4xl md:text-6xl text-white uppercase mb-4">Celebration</h2>
                <div class="h-1 w-20 bg-white ml-auto md:ml-0"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                @foreach($invitation->events as $ev)
                    <div class="scroll-reveal border border-gray-800 p-10 flex flex-col md:flex-row gap-10 hover:border-white/30 transition duration-500">
                        <div class="flex-shrink-0">
                            <h4 class="font-header text-2xl uppercase text-white mb-2">{{ $ev->event_type }}</h4>
                            <p class="text-xs text-gray-500 uppercase tracking-widest">{{ \Carbon\Carbon::parse($ev->date)->translatedFormat('d F') }}</p>
                        </div>
                        <div class="flex-grow space-y-6 pt-1 border-t md:border-t-0 md:border-l border-gray-800 md:pl-10">
                            <div>
                                <p class="text-xs uppercase text-gray-500 tracking-widest mb-1">Time</p>
                                <p class="text-lg font-light">{{ $ev->start_time }} - {{ $ev->end_time }}</p>
                            </div>
                            <div>
                                <p class="text-xs uppercase text-gray-500 tracking-widest mb-1">Location</p>
                                <p class="text-lg font-light mb-4">{{ $ev->location }}</p>
                                @if($ev->maps_link)
                                    <a href="{{ $ev->maps_link }}" class="text-[10px] uppercase tracking-widest border-b border-gray-700 hover:border-white pb-1 transition">View On Map</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Love Story Timeline -->
    @if($invitation->loveStories->count() > 0)
    <section class="py-32 px-6 max-w-4xl mx-auto">
         <div class="scroll-reveal mb-20 text-center">
            <h2 class="font-header text-4xl text-white uppercase mb-4">Our History</h2>
            <p class="text-xs text-gray-500 tracking-[0.3em] uppercase">Moments in time</p>
        </div>

        <div class="relative">
            <div class="timeline-line"></div>
            <div class="space-y-24">
                @foreach($invitation->loveStories as $story)
                    <div class="scroll-reveal relative flex flex-col md:flex-row items-center gap-10">
                         <div class="w-full md:w-1/2 overflow-hidden">
                            @if($story->photo_url)
                                <img src="{{ $story->photo_url }}" class="w-full h-64 object-cover grayscale hover:grayscale-0 transition duration-1000">
                            @endif
                         </div>
                         <div class="w-full md:w-1/2">
                            <h4 class="font-header text-2xl text-white uppercase mb-4 tracking-tight">{{ $story->title }}</h4>
                            <p class="text-xs text-gray-500 uppercase tracking-widest mb-4">Milestone #{{ $story->sort_order }}</p>
                            <p class="text-sm font-light leading-relaxed text-gray-400">{{ $story->description }}</p>
                         </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Gallery -->
    @if($invitation->galleries->count() > 0)
    <section class="py-32 px-6 bg-white text-black">
        <div class="max-w-6xl mx-auto">
             <div class="scroll-reveal mb-16 text-center">
                <h2 class="font-header text-4xl uppercase mb-2">Visual Gallery</h2>
                <p class="text-[10px] uppercase tracking-widest text-gray-400">Captured in monochrome & color</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-1">
                @foreach($invitation->galleries as $gallery)
                    <div class="scroll-reveal overflow-hidden aspect-video relative group">
                        <img src="{{ $gallery->photo_url }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition duration-500"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Gift Section -->
    <section class="py-32 px-6 max-w-2xl mx-auto text-center">
        <div class="scroll-reveal mb-12">
            <h2 class="font-header text-4xl text-white uppercase mb-6">Tanda Kasih</h2>
            <p class="text-xs text-gray-500 uppercase tracking-widest leading-relaxed">Your presence is our greatest gift. Should you wish to honor us with a gift :</p>
        </div>
        <div class="space-y-6">
            @if($invitation->gift_bank_pria)
                <div class="scroll-reveal border border-gray-800 p-8 hover:border-white transition">
                    <p class="text-[10px] uppercase tracking-widest text-gray-500 mb-2">Groom's Account</p>
                    <p class="text-2xl font-header mb-1 tracking-tight">{{ $invitation->gift_bank_pria }}</p>
                    <p class="text-xs uppercase tracking-widest text-gray-400">{{ $invitation->gift_bank_pria_name }}</p>
                </div>
            @endif
            @if($invitation->gift_bank_wanita)
                <div class="scroll-reveal border border-gray-800 p-8 hover:border-white transition">
                    <p class="text-[10px] uppercase tracking-widest text-gray-500 mb-2">Bride's Account</p>
                    <p class="text-2xl font-header mb-1 tracking-tight">{{ $invitation->gift_bank_wanita }}</p>
                    <p class="text-xs uppercase tracking-widest text-gray-400">{{ $invitation->gift_bank_wanita_name }}</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Guestbook -->
    <section class="py-32 px-6 border-t border-gray-900">
        <div class="max-w-3xl mx-auto">
             <div class="scroll-reveal text-center mb-16">
                <h2 class="font-header text-4xl text-white uppercase mb-2">Wishes</h2>
                <p class="text-xs text-gray-500 tracking-widest uppercase">Digital guestbook</p>
            </div>
            @include('themes.partials.guestbook', ['theme' => 'modern'])
        </div>
    </section>

    <footer class="py-16 text-center border-t border-gray-900 bg-stone-950">
        <h3 class="font-header text-2xl text-white mb-4 tracking-widest">{{ $invitation->groom_name }} & {{ $invitation->bride_name }}</h3>
        @if($invitation->is_watermark_enabled)
        <div class="mt-12 pt-12 border-t border-gray-900 flex flex-col items-center group/wm">
           <span class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-700 mb-4">Architected by</span>
           <div class="flex items-center space-x-3 grayscale opacity-30 hover:opacity-100 hover:grayscale-0 transition-all duration-1000 cursor-pointer">
               <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center font-black text-black text-lg italic shadow-2xl">Z</div>
               <span class="text-lg font-black tracking-tighter uppercase italic text-white">ZipMoment</span>
           </div>
           <p class="text-[9px] text-gray-600 mt-4 font-light tracking-widest uppercase">Experience the peak of digital storytelling at <span class="text-white">zipmoment.id</span></p>
        </div>
        @endif
        <p class="text-[10px] uppercase tracking-widest text-gray-600 mt-8">Created for Eternity &bull; {{ date('Y') }}</p>
    </footer>

    <script>
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('visible');
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.scroll-reveal').forEach(el => observer.observe(el));
    </script>
</body>
</html>
