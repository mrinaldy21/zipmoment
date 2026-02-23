<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invitation->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Outfit:wght@200;300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        :root {
            --bg-romantic: #fff9f9;
            --text-romantic: #4a4a4a;
            --accent-romantic: #db2777;
            --gold-romantic: #d4af37;
            --border-romantic: rgba(219, 39, 119, 0.1);
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --bg-romantic: #140d10;
                --text-romantic: #e5e7eb;
                --accent-romantic: #f472b6;
                --gold-romantic: #facc15;
                --border-romantic: rgba(244, 114, 182, 0.1);
            }
        }

        .font-serif { font-family: 'Playfair Display', serif; }
        .font-outfit { font-family: 'Outfit', sans-serif; }
        
        body { background-color: var(--bg-romantic); color: var(--text-romantic); }

        .lux-gradient {
            background: linear-gradient(135deg, var(--accent-romantic) 0%, var(--gold-romantic) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .scroll-reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all 1s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        .scroll-reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .bg-gradient-canvas {
            background: radial-gradient(circle at top right, var(--border-romantic) 0%, transparent 40%),
                        radial-gradient(circle at bottom left, var(--border-romantic) 0%, transparent 40%);
        }
    </style>
</head>
<body class="font-outfit font-light antialiased overflow-x-hidden selection:bg-rose-500 selection:text-white">
    
    @include('themes.partials.opening_screen', ['theme' => 'romantic'])
    @include('themes.partials.music_player', ['theme' => 'romantic'])
    
    <!-- Hero Section -->
    <section class="relative min-h-[90vh] flex flex-col justify-center items-center text-center p-8 bg-gradient-canvas">
        <div class="animate__animated animate__zoomIn">
            <div class="w-20 h-[1px] bg-rose-500/30 mx-auto mb-12"></div>
            <h3 class="text-[10px] md:text-sm uppercase tracking-[0.5em] text-rose-500 font-bold mb-8">A Journey of Love</h3>
            <h1 class="font-serif text-5xl md:text-8xl mb-6 italic">{{ $invitation->groom_name }}</h1>
            <div class="font-serif text-3xl italic opacity-30 my-4">&</div>
            <h1 class="font-serif text-5xl md:text-8xl mb-12 italic">{{ $invitation->bride_name }}</h1>
            <p class="text-lg md:text-2xl font-light tracking-widest uppercase mb-12 border-y border-rose-100 dark:border-rose-900 py-4 px-8 inline-block">
                {{ \Carbon\Carbon::parse($invitation->event_date)->translatedFormat('d F Y') }}
            </p>

            <div class="mt-8">
                @include('themes.partials.countdown')
            </div>
        </div>
    </section>

    <!-- Emotional Introduction -->
    <section class="py-32 px-6 max-w-3xl mx-auto text-center">
        <div class="scroll-reveal">
            <p class="text-xl md:text-2xl font-serif italic leading-relaxed opacity-70">
                "Cinta bukan sekadar kata, namun janji setia di hadapan Tuhan dan alam semesta. Di hari yang penuh berkah ini, kami memohon kehadiran Anda untuk menjadi saksi pengikatan janji suci kami."
            </p>
        </div>
    </section>

    <!-- Couple Section -->
    <section class="py-32 px-6">
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-24 items-center">
            <div class="scroll-reveal order-2 lg:order-1">
                <div class="relative group">
                    <div class="absolute -inset-4 bg-rose-500/5 blur-2xl rounded-full"></div>
                    <img src="{{ $invitation->groom_photo_url ?? 'https://via.placeholder.com/600x800' }}" class="relative w-full aspect-[3/4] object-cover rounded-[100px] shadow-2xl filter brightness-95 group-hover:brightness-100 transition duration-700">
                </div>
            </div>
            <div class="scroll-reveal order-1 lg:order-2 text-center lg:text-left">
                <span class="lux-gradient font-serif text-4xl mb-4 block italic">The Groom</span>
                <h2 class="font-serif text-5xl md:text-7xl mb-8 tracking-tighter">{{ $invitation->groom_name }}</h2>
                <p class="text-sm md:text-lg opacity-60 leading-relaxed mb-10 italic whitespace-pre-line">
                    {{ $invitation->groom_parent_text }}
                </p>
                @if($invitation->groom_instagram)
                <a href="https://instagram.com/{{ ltrim($invitation->groom_instagram, '@') }}" class="inline-flex items-center space-x-2 text-rose-500 font-bold tracking-widest uppercase text-xs">
                    <span>Instagram</span>
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4.001 1.791 4.001 4c0 2.21-1.791 4-4.001 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                </a>
                @endif
            </div>
        </div>

        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-24 items-center mt-32 md:mt-60">
            <div class="scroll-reveal text-center lg:text-right">
                <span class="lux-gradient font-serif text-4xl mb-4 block italic">The Bride</span>
                <h2 class="font-serif text-5xl md:text-7xl mb-8 tracking-tighter">{{ $invitation->bride_name }}</h2>
                <p class="text-sm md:text-lg opacity-60 leading-relaxed mb-10 italic whitespace-pre-line">
                    {{ $invitation->bride_parent_text }}
                </p>
                @if($invitation->bride_instagram)
                <a href="https://instagram.com/{{ ltrim($invitation->bride_instagram, '@') }}" class="inline-flex items-center space-x-2 text-rose-500 font-bold tracking-widest uppercase text-xs">
                    <span>Instagram</span>
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4.001 1.791 4.001 4c0 2.21-1.791 4-4.001 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                </a>
                @endif
            </div>
            <div class="scroll-reveal">
                <div class="relative group">
                    <div class="absolute -inset-4 bg-rose-500/5 blur-2xl rounded-full"></div>
                    <img src="{{ $invitation->bride_photo_url ?? 'https://via.placeholder.com/600x800' }}" class="relative w-full aspect-[3/4] object-cover rounded-[100px] shadow-2xl filter brightness-95 group-hover:brightness-100 transition duration-700">
                </div>
            </div>
        </div>

        <!-- Love Story Section -->
        @if($invitation->loveStories->count() > 0)
        <div class="max-w-4xl mx-auto mt-40">
            <div class="text-center mb-16 scroll-reveal">
                <span class="lux-gradient font-serif text-3xl italic block mb-2">Our Story</span>
                <h2 class="font-serif text-5xl tracking-tighter">The Journey of Us</h2>
            </div>

            <div class="relative px-6">
                <div class="absolute left-1/2 -content-[''] translate-x-[-50%] h-full w-[1px] bg-rose-200 hidden md:block"></div>
                <div class="space-y-24">
                    @foreach($invitation->loveStories as $key => $story)
                        <div class="scroll-reveal relative flex flex-col md:flex-row items-center {{ $key % 2 != 0 ? 'md:flex-row-reverse' : '' }}">
                            <div class="w-full md:w-1/2 {{ $key % 2 == 0 ? 'md:pr-16 md:text-right' : 'md:pl-16 md:text-left' }}">
                                <div class="bg-white/50 dark:bg-rose-950/10 p-8 rounded-[40px] border border-rose-100 dark:border-rose-900 backdrop-blur-sm">
                                    @if($story->photo_url)
                                        <img src="{{ $story->photo_url }}" class="w-full h-48 object-cover rounded-[30px] mb-6 shadow-lg">
                                    @endif
                                    <h4 class="font-serif text-2xl italic mb-4 rose-500">{{ $story->title }}</h4>
                                    <p class="text-sm opacity-60 leading-relaxed italic">{{ $story->description }}</p>
                                </div>
                            </div>
                            <div class="absolute left-1/2 -translate-x-1/2 w-4 h-4 bg-rose-400 rounded-full border-4 border-white dark:border-rose-950 hidden md:block"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </section>

    <!-- Event & Logistics -->
    <section class="py-32 bg-white dark:bg-black p-8 md:p-24 rounded-[60px] md:rounded-[100px] mx-4 md:mx-8">
        <div class="max-w-5xl mx-auto text-center scroll-reveal">
            <h2 class="font-serif text-4xl md:text-7xl mb-16 tracking-tighter">The Holy Matrimony & Reception</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-24">
                @foreach($invitation->events as $event)
                <div class="p-12 rounded-[50px] border border-rose-100 dark:border-rose-900 group hover:bg-rose-50/50 dark:hover:bg-rose-950/20 transition duration-700">
                    <span class="text-rose-500 font-bold uppercase tracking-[0.3em] text-[10px] mb-6 block">{{ $event->name }}</span>
                    <h3 class="font-serif text-3xl mb-4 italic">{{ \Carbon\Carbon::parse($event->date)->translatedFormat('l, d F Y') }}</h3>
                    <p class="text-lg opacity-60 mb-8">{{ $event->start_time }} - {{ $event->end_time ?? 'Finish' }}</p>
                    <div class="h-[1px] w-12 bg-rose-200 dark:bg-rose-800 mx-auto mb-8"></div>
                    <p class="text-xs uppercase tracking-widest font-bold mb-8 opacity-40">{{ $event->location }}</p>
                    
                    @if($event->maps_link)
                    <a href="{{ $event->maps_link }}" target="_blank" class="w-full py-4 bg-rose-500 text-white rounded-2xl text-[10px] font-black uppercase tracking-[0.3em] hover:bg-rose-600 shadow-xl shadow-rose-500/20 transition duration-500 inline-block">Direct Navigation</a>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>

        <!-- Wedding Gift Section -->
        @if($invitation->gift_bank_pria || $invitation->gift_bank_wanita)
        <div class="max-w-4xl mx-auto mt-40 text-center scroll-reveal">
            <span class="lux-gradient font-serif text-3xl italic block mb-2">Wedding Gift</span>
            <h2 class="font-serif text-5xl tracking-tighter mb-12">Tanda Kasih</h2>
            <p class="text-sm opacity-60 italic mb-12 max-w-lg mx-auto">Kehadiran Anda adalah hadiah terindah. Namun jika Anda bermaksud memberikan tanda kasih, dapat melalui:</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-2xl mx-auto">
                @if($invitation->gift_bank_pria)
                <div class="p-10 rounded-[40px] border border-rose-100 dark:border-rose-900 bg-white/30 dark:bg-rose-950/5">
                    <p class="text-[10px] uppercase tracking-widest text-rose-500 font-bold mb-4">Bank Transfer (Pria)</p>
                    <h4 class="font-serif text-2xl italic mb-2">{{ $invitation->gift_bank_pria }}</h4>
                    <p class="text-xs font-bold uppercase tracking-widest opacity-40">{{ $invitation->gift_bank_pria_name }}</p>
                </div>
                @endif
                @if($invitation->gift_bank_wanita)
                <div class="p-10 rounded-[40px] border border-rose-100 dark:border-rose-900 bg-white/30 dark:bg-rose-950/5">
                    <p class="text-[10px] uppercase tracking-widest text-rose-500 font-bold mb-4">Bank Transfer (Wanita)</p>
                    <h4 class="font-serif text-2xl italic mb-2">{{ $invitation->gift_bank_wanita }}</h4>
                    <p class="text-xs font-bold uppercase tracking-widest opacity-40">{{ $invitation->gift_bank_wanita_name }}</p>
                </div>
                @endif
            </div>
        </div>
        @endif

    <!-- Gallery Presentation -->
    <section class="py-32 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 scroll-reveal">
                <span class="lux-gradient font-serif text-3xl italic block mb-2">Our Moments</span>
                <h2 class="font-serif text-5xl tracking-tighter">Caught in Time</h2>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($invitation->galleries as $index => $photo)
                <div class="scroll-reveal {{ $index % 5 == 0 ? 'md:col-span-2 md:row-span-2' : '' }} group relative overflow-hidden rounded-[30px] shadow-xl">
                    <img src="{{ $photo->photo_url }}" class="w-full h-full object-cover transition duration-[4s] group-hover:scale-125">
                    <div class="absolute inset-0 bg-gradient-to-t from-rose-900/40 to-transparent opacity-0 group-hover:opacity-100 transition duration-700"></div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

        <!-- Guestbook Section -->
        <div class="max-w-3xl mx-auto mt-40 px-6">
            <div class="text-center mb-16 scroll-reveal">
                <span class="lux-gradient font-serif text-3xl italic block mb-2">Wishes</span>
                <h2 class="font-serif text-5xl tracking-tighter">Guestbook</h2>
            </div>
            @include('themes.partials.guestbook', ['theme' => 'romantic'])
        </div>

    <!-- Footer -->
    <footer class="py-32 text-center">
        <div class="scroll-reveal">
            <img src="{{ asset('images/logo.png') }}" alt="ZipMoment" class="h-10 mx-auto rounded-xl mb-8 grayscale opacity-20">
            <p class="text-[10px] uppercase tracking-[0.6em] font-black opacity-20 whitespace-nowrap">Architected with Love by ZipMoment</p>
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
