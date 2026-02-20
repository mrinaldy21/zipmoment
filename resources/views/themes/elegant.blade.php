<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invitation->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        .font-cursive { font-family: 'Great Vibes', cursive; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .font-sans { font-family: 'Montserrat', sans-serif; }
        
        .gold-text { color: #d4af37; }
        .gold-bg { background-color: #d4af37; }
        .gold-border { border-color: #d4af37; }
        
        .bg-cream { background-color: #fdfbf7; }
        
        .timeline-item::after {
            content: '';
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #d4af37;
            transform: translateX(-50%);
        }

        @media (max-width: 768px) {
            .timeline-item::after {
                left: 20px;
            }
        }

        .scroll-reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease-out;
        }

        .scroll-reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="font-sans bg-cream text-[#3a3a3a] antialiased overflow-x-hidden">
    
    @include('themes.partials.opening_screen', ['theme' => 'elegant'])
    @include('themes.partials.music_player', ['theme' => 'elegant'])
    
    <!-- Section: Hero -->
    <section class="relative min-h-screen flex flex-col justify-center items-center text-center p-6 overflow-hidden">
        @if($invitation->cover_photo_url)
            <div class="absolute inset-0 z-0">
                <img src="{{ $invitation->cover_photo_url }}" class="w-full h-full object-cover scale-105 animate-slow-zoom">
                <div class="absolute inset-0 bg-black/30 backdrop-blur-[2px]"></div>
            </div>
        @endif
        
        <div class="relative z-10 animate__animated animate__fadeInUp">
            <h3 class="text-white text-lg md:text-xl uppercase tracking-[0.4em] mb-4">The Wedding Of</h3>
<h1 class="text-white mb-8 text-[3.5rem]" style="font-family:'Allura', sans-serif;">
    {{ $invitation->groom_name }} & {{ $invitation->bride_name }}
</h1>
            <div class="max-w-md mx-auto h-[1px] bg-white/50 mb-8"></div>
            <p class="text-white text-xl md:text-2xl font-light tracking-widest uppercase mb-12">
                {{ \Carbon\Carbon::parse($invitation->event_date)->translatedFormat('d F Y') }}
            </p>
            
            <div class="mt-8">
                @include('themes.partials.countdown')
            </div>
        </div>

        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7-7-7m14-8l-7 7-7-7"></path></svg>
        </div>
    </section>

    <!-- Section: Couple -->
    <section class="py-24 px-6 max-w-5xl mx-auto text-center">
        <div class="scroll-reveal mb-16">
            <span class="gold-text font-cursive text-4xl block mb-2">Our Love</span>
            <h2 class="font-serif text-4xl md:text-5xl uppercase tracking-widest">Groom & Bride</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <!-- Groom -->
            <div class="scroll-reveal flex flex-col items-center">
                <div class="relative mb-6">
                    <div class="absolute inset-0 gold-bg rounded-full translate-x-3 translate-y-3 opacity-20"></div>
                    <img src="{{ $invitation->groom_photo_url ?? 'https://via.placeholder.com/300' }}" class="relative w-64 h-64 object-cover rounded-full border-8 border-white shadow-2xl">
                    @if($invitation->groom_instagram)
                        <a href="https://instagram.com/{{ ltrim($invitation->groom_instagram, '@') }}" target="_blank" class="absolute bottom-4 right-4 bg-white p-2 rounded-full shadow-lg gold-text hover:gold-bg hover:text-white transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    @endif
                </div>
                <h3 class="font-serif text-3xl gold-text mb-2">{{ $invitation->groom_name }}</h3>
                <p class="text-xs uppercase tracking-widest text-gray-400 mb-4 whitespace-pre-line">{{ $invitation->groom_parent_text }}</p>
            </div>

            <!-- Bride -->
            <div class="scroll-reveal flex flex-col items-center">
                <div class="relative mb-6">
                    <div class="absolute inset-0 gold-bg rounded-full -translate-x-3 translate-y-3 opacity-20"></div>
                    <img src="{{ $invitation->bride_photo_url ?? 'https://via.placeholder.com/300' }}" class="relative w-64 h-64 object-cover rounded-full border-8 border-white shadow-2xl">
                    @if($invitation->bride_instagram)
                        <a href="https://instagram.com/{{ ltrim($invitation->bride_instagram, '@') }}" target="_blank" class="absolute bottom-4 right-4 bg-white p-2 rounded-full shadow-lg gold-text hover:gold-bg hover:text-white transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    @endif
                </div>
                <h3 class="font-serif text-3xl gold-text mb-2">{{ $invitation->bride_name }}</h3>
                <p class="text-xs uppercase tracking-widest text-gray-400 whitespace-pre-line">{{ $invitation->bride_parent_text }}</p>
            </div>
        </div>
    </section>

    <!-- Section: Events -->
    <section class="bg-stone-50 py-24 px-6 border-y border-stone-200">
        <div class="max-w-6xl mx-auto">
            <div class="scroll-reveal text-center mb-16">
                <span class="gold-text font-cursive text-4xl block mb-2">Join Us</span>
                <h2 class="font-serif text-4xl md:text-5xl uppercase tracking-widest">Wedding Events</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($invitation->events as $ev)
                    <div class="scroll-reveal bg-white p-8 rounded-2xl shadow-xl border-t-8 gold-border text-center transform hover:-translate-y-2 transition duration-500">
                        <h4 class="font-serif text-2xl uppercase gold-text mb-6">{{ $ev->event_type }}</h4>
                        
                        <div class="space-y-4 mb-8">
                            <div class="flex flex-col items-center">
                                <svg class="w-5 h-5 text-gray-400 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <p class="font-bold">{{ \Carbon\Carbon::parse($ev->date)->translatedFormat('l, d F Y') }}</p>
                            </div>
                            <div class="flex flex-col items-center">
                                <svg class="w-5 h-5 text-gray-400 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <p>{{ $ev->start_time }} - {{ $ev->end_time }}</p>
                            </div>
                            <div class="flex flex-col items-center">
                                <svg class="w-5 h-5 text-gray-400 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <p class="text-sm px-4">{{ $ev->location }}</p>
                            </div>
                        </div>

                        @if($ev->maps_link)
                            <a href="{{ $ev->maps_link }}" target="_blank" class="inline-block gold-bg text-white px-6 py-2 rounded-full font-bold text-xs uppercase tracking-widest hover:opacity-90 transition shadow-md">
                                Open Maps
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Section: Love Stories -->
    @if($invitation->loveStories->count() > 0)
    <section class="py-24 px-6 max-w-4xl mx-auto overflow-hidden">
        <div class="scroll-reveal text-center mb-16">
            <span class="gold-text font-cursive text-4xl block mb-2">Our Journey</span>
            <h2 class="font-serif text-4xl md:text-5xl uppercase tracking-widest">Love Stories</h2>
        </div>

        <div class="relative">
            <!-- Timeline Line -->
            <div class="absolute left-1/2 -content-[''] translate-x-[-50%] h-full w-[2px] bg-stone-200 hidden md:block"></div>
            
            <div class="space-y-16">
                @foreach($invitation->loveStories as $key => $story)
                    <div class="scroll-reveal relative flex flex-col md:flex-row items-center {{ $key % 2 != 0 ? 'md:flex-row-reverse' : '' }}">
                        <!-- Dot -->
                        <div class="absolute left-1/2 -translate-x-1/2 w-4 h-4 gold-bg rounded-full hidden md:block z-10 shadow-lg"></div>
                        
                        <!-- Content -->
                        <div class="w-full md:w-1/2 {{ $key % 2 == 0 ? 'md:pr-12 md:text-right' : 'md:pl-12 md:text-left' }}">
                             <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition duration-500">
                                @if($story->photo_url)
                                    <img src="{{ $story->photo_url }}" class="w-full h-48 object-cover rounded-xl mb-4 shadow">
                                @endif
                                <h4 class="font-serif text-xl gold-text mb-2">{{ $story->title }}</h4>
                                <p class="text-xs text-gray-500 leading-relaxed">{{ $story->description }}</p>
                             </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Section: Gallery -->
    @if($invitation->galleries->count() > 0)
    <section class="py-24 px-6 bg-stone-900 text-white">
        <div class="max-w-6xl mx-auto">
            <div class="scroll-reveal text-center mb-16">
                <span class="gold-text font-cursive text-4xl block mb-2">Our Moments</span>
                <h2 class="font-serif text-4xl md:text-5xl uppercase tracking-widest">Photo Gallery</h2>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($invitation->galleries as $gallery)
                    <div class="scroll-reveal aspect-square overflow-hidden rounded-xl bg-stone-800">
                        <img src="{{ $gallery->photo_url }}" class="w-full h-full object-cover transition duration-700 hover:scale-110 opacity-90 hover:opacity-100">
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Section: Gift -->
    <section class="py-24 px-6 max-w-5xl mx-auto text-center">
        <div class="scroll-reveal mb-12">
            <span class="gold-text font-cursive text-4xl block mb-2">Wedding Gift</span>
            <h2 class="font-serif text-4xl md:text-5xl uppercase tracking-widest mb-6">Tanda Kasih</h2>
            <p class="max-w-2xl mx-auto text-sm text-gray-500 leading-relaxed italic">
                Doa restu Anda merupakan karunia yang sangat berarti bagi kami. Namun jika memberi adalah ungkapan kasih Anda, Anda dapat mengirimkan melalui :
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-3xl mx-auto">
            @if($invitation->gift_bank_pria)
            <div class="scroll-reveal bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
                <p class="font-bold uppercase text-xs tracking-widest text-gray-400 mb-4">Transfer Pria</p>
                <h4 class="font-serif text-2xl gold-text mb-1">{{ $invitation->gift_bank_pria }}</h4>
                <p class="text-sm font-bold uppercase">{{ $invitation->gift_bank_pria_name }}</p>
            </div>
            @endif
            @if($invitation->gift_bank_wanita)
            <div class="scroll-reveal bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
                <p class="font-bold uppercase text-xs tracking-widest text-gray-400 mb-4">Transfer Wanita</p>
                <h4 class="font-serif text-2xl gold-text mb-1">{{ $invitation->gift_bank_wanita }}</h4>
                <p class="text-sm font-bold uppercase">{{ $invitation->gift_bank_wanita_name }}</p>
            </div>
            @endif
        </div>
    </section>

    <!-- Section: Guestbook -->
    <section class="py-24 px-6 bg-stone-50">
        <div class="max-w-3xl mx-auto">
             <div class="scroll-reveal text-center mb-16">
                <span class="gold-text font-cursive text-4xl block mb-2">Wishes</span>
                <h2 class="font-serif text-4xl md:text-5xl uppercase tracking-widest">Guestbook</h2>
            </div>
            @include('themes.partials.guestbook', ['theme' => 'elegant'])
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-16 px-6 text-center bg-white border-t border-stone-100">
        <h3 class="font-cursive text-4xl gold-text mb-8">{{ $invitation->groom_name }} & {{ $invitation->bride_name }}</h3>
        <p class="text-xs uppercase tracking-[0.3em] text-gray-400 mb-12">Thank You for Being Part of Our Day</p>
        
        <div class="flex flex-col items-center space-y-4">
             @if($invitation->is_watermark_enabled)
             <div class="mt-8 pt-8 border-t border-gray-100 flex flex-col items-center group/wm">
                <!-- Main Watermark (Removable) -->
                <span class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-300 mb-2">Designed with</span>
                <div class="flex items-center space-x-2 grayscale opacity-40 hover:opacity-100 hover:grayscale-0 transition-all duration-700 cursor-pointer">
                    <div class="w-8 h-8 bg-amber-500 rounded-lg flex items-center justify-center font-black text-black text-md italic shadow-xl shadow-amber-500/10">Z</div>
                    <span class="text-sm font-black tracking-tighter uppercase italic text-black">ZipMoment</span>
                </div>
                <p class="text-[9px] text-gray-400 mt-2 font-medium">Create your exclusive invitation at <span class="text-amber-600 font-bold">zipmoment.id</span></p>
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

    <script>
        // Scroll Reveal Implementation
        const observerOptions = {
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.scroll-reveal').forEach(el => observer.observe(el));
    </script>
</body>
</html>
