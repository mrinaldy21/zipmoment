<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invitation->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Nunito:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        .font-cursive { font-family: 'Dancing Script', cursive; }
        .font-body { font-family: 'Nunito', sans-serif; }
        
        .floral-text { color: #db2777; }
        .floral-bg { background-color: #db2777; }
        .floral-border { border-color: #fce7f3; }
        
        .bg-floral { background-color: #fffafb; }

        .timeline-dot {
            width: 12px;
            height: 12px;
            background: #db2777;
            border-radius: 50%;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            box-shadow: 0 0 10px rgba(219, 39, 119, 0.4);
        }

        .scroll-reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.7s ease-out;
        }

        .scroll-reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="font-body bg-floral text-gray-700 antialiased overflow-x-hidden">
    
    @include('themes.partials.opening_screen', ['theme' => 'floral'])
    @include('themes.partials.music_player', ['theme' => 'floral'])
    
    <!-- Hero Section -->
    <section class="relative min-h-screen flex flex-col justify-center items-center text-center p-6 overflow-hidden">
        <div class="absolute inset-0 z-0">
             <img src="https://images.unsplash.com/photo-1522673607200-1648482ce486?auto=format&fit=crop&w=2000&q=80" class="w-full h-full object-cover blur-[1px]">
             <div class="absolute inset-0 bg-white/60"></div>
        </div>
        
        <div class="relative z-10 animate__animated animate__fadeIn">
            <h3 class="text-pink-400 text-sm uppercase tracking-[0.4em] mb-4 font-bold">The Wedding Of</h3>
            <h1 class="font-cursive text-6xl md:text-8xl text-pink-600 mb-8">{{ $invitation->groom_name }} & {{ $invitation->bride_name }}</h1>
            <div class="flex justify-center mb-8">
                @include('themes.partials.countdown')
            </div>
            <p class="text-pink-500 text-lg md:text-xl italic font-semibold tracking-widest uppercase">
                {{ \Carbon\Carbon::parse($invitation->event_date)->translatedFormat('d F Y') }}
            </p>
        </div>
    </section>

    <!-- Couple Section -->
    <section class="py-24 px-6 max-w-6xl mx-auto text-center">
        <div class="scroll-reveal mb-16">
            <h2 class="font-cursive text-5xl text-pink-600 mb-2">Groom & Bride</h2>
            <p class="text-pink-300 uppercase tracking-widest text-xs font-bold">Our Love Story Starts Here</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Groom -->
            <div class="scroll-reveal group">
                <div class="relative inline-block mb-6">
                    <div class="absolute inset-0 bg-pink-100 rounded-2xl transform rotate-3 group-hover:rotate-6 transition duration-500"></div>
                    <img src="{{ $invitation->groom_photo_url ?? 'https://via.placeholder.com/300' }}" class="relative w-72 h-72 object-cover rounded-2xl border-4 border-white shadow-xl">
                </div>
                <h3 class="font-cursive text-4xl text-pink-600 mb-1">{{ $invitation->groom_name }}</h3>
                <p class="text-[10px] uppercase font-bold text-gray-400 tracking-tighter mb-4 whitespace-pre-line">{{ $invitation->groom_parent_text }}</p>
                @if($invitation->groom_instagram)
                    <a href="https://instagram.com/{{ ltrim($invitation->groom_instagram, '@') }}" class="text-pink-400 hover:text-pink-600 font-bold text-sm tracking-widest">@ {{ ltrim($invitation->groom_instagram, '@') }}</a>
                @endif
            </div>

            <!-- Bride -->
            <div class="scroll-reveal group">
                <div class="relative inline-block mb-6">
                    <div class="absolute inset-0 bg-pink-100 rounded-2xl transform -rotate-3 group-hover:-rotate-6 transition duration-500"></div>
                    <img src="{{ $invitation->bride_photo_url ?? 'https://via.placeholder.com/300' }}" class="relative w-72 h-72 object-cover rounded-2xl border-4 border-white shadow-xl">
                </div>
                <h3 class="font-cursive text-4xl text-pink-600 mb-1">{{ $invitation->bride_name }}</h3>
                <p class="text-[10px] uppercase font-bold text-gray-400 tracking-tighter mb-4 whitespace-pre-line">{{ $invitation->bride_parent_text }}</p>
                @if($invitation->bride_instagram)
                    <a href="https://instagram.com/{{ ltrim($invitation->bride_instagram, '@') }}" class="text-pink-400 hover:text-pink-600 font-bold text-sm tracking-widest">@ {{ ltrim($invitation->bride_instagram, '@') }}</a>
                @endif
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section class="py-24 px-6 bg-pink-50/50">
        <div class="max-w-6xl mx-auto">
             <div class="scroll-reveal text-center mb-16">
                <h2 class="font-cursive text-5xl text-pink-600 mb-2">Wedding Events</h2>
                <p class="text-pink-300 uppercase tracking-widest text-xs font-bold">Save These Times</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($invitation->events as $ev)
                    <div class="scroll-reveal bg-white p-8 rounded-[2rem] shadow-lg border border-pink-100 text-center relative group overflow-hidden">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-pink-50 rounded-bl-full -mr-8 -mt-8 transition-all group-hover:scale-150 duration-700"></div>
                        
                        <h4 class="font-cursive text-3xl text-pink-600 mb-6 relative">{{ $ev->event_type }}</h4>
                        
                        <div class="space-y-4 mb-8 text-sm relative">
                            <p class="font-bold flex items-center justify-center"><svg class="w-4 h-4 mr-2 text-pink-300" fill="currentColor" viewBox="0 0 20 20"><path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"/></svg> {{ \Carbon\Carbon::parse($ev->date)->translatedFormat('l, d F Y') }}</p>
                            <p class="flex items-center justify-center"><svg class="w-4 h-4 mr-2 text-pink-300" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"/></svg> {{ $ev->start_time }} - {{ $ev->end_time }}</p>
                            <p class="flex items-center justify-center text-xs px-2"><svg class="w-4 h-4 mr-2 text-pink-300 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"/></svg> {{ $ev->location }}</p>
                        </div>

                        @if($ev->maps_link)
                            <a href="{{ $ev->maps_link }}" target="_blank" class="inline-block bg-pink-500 text-white px-8 py-2 rounded-full font-bold text-xs uppercase tracking-widest hover:bg-pink-600 transition shadow relative">
                                Venue Map
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Love Story Timeline -->
    @if($invitation->loveStories->count() > 0)
    <section class="py-24 px-6 max-w-4xl mx-auto">
        <div class="scroll-reveal text-center mb-16">
            <h2 class="font-cursive text-5xl text-pink-600 mb-2">Love Journey</h2>
            <p class="text-pink-300 uppercase tracking-widest text-xs font-bold">How We Met</p>
        </div>

        <div class="space-y-12">
            @foreach($invitation->loveStories as $story)
                <div class="scroll-reveal flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-8 pb-12 border-l-2 border-pink-100 ml-4 md:ml-0 pl-8 md:pl-0 relative">
                     <div class="absolute left-[-9px] md:left-1/2 md:translate-x-[-50%] top-0 timeline-dot border-4 border-white"></div>
                     
                     <div class="w-full md:w-1/2 md:text-right hidden md:block">
                        @if($story->photo_url)
                            <img src="{{ $story->photo_url }}" class="w-full h-40 object-cover rounded-2xl shadow-md border-2 border-white">
                        @endif
                     </div>
                     <div class="w-full md:w-1/2 text-left">
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-pink-50">
                            <div class="md:hidden mb-4">
                                @if($story->photo_url)
                                    <img src="{{ $story->photo_url }}" class="w-full h-32 object-cover rounded-xl shadow-sm">
                                @endif
                            </div>
                            <h4 class="font-cursive text-2xl text-pink-500 mb-2">{{ $story->title }}</h4>
                            <p class="text-sm text-gray-400 italic leading-relaxed">{{ $story->description }}</p>
                        </div>
                     </div>
                </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Gallery -->
    @if($invitation->galleries->count() > 0)
    <section class="py-24 px-6 bg-pink-100/30">
        <div class="max-w-6xl mx-auto">
            <div class="scroll-reveal text-center mb-16">
                 <h2 class="font-cursive text-5xl text-pink-600 mb-2">Captured Moments</h2>
                 <p class="text-pink-300 uppercase tracking-widest text-xs font-bold">Our Beautiful Memories</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($invitation->galleries as $gallery)
                    <img src="{{ $gallery->photo_url }}" class="scroll-reveal w-full aspect-square object-cover rounded-2xl shadow-sm hover:scale-105 transition duration-500">
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Gift Section -->
    <section class="py-24 px-6 max-w-4xl mx-auto text-center">
        <div class="scroll-reveal mb-12">
            <h2 class="font-cursive text-5xl text-pink-600 mb-4">Wedding Gift</h2>
            <p class="text-gray-400 text-sm italic">Sharing the love...</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @if($invitation->gift_bank_pria)
                <div class="scroll-reveal bg-pink-50 p-6 rounded-2xl border-2 border-dashed border-pink-200">
                    <p class="text-[10px] uppercase font-bold text-pink-400 mb-2">Tanda Kasih (Groom)</p>
                    <p class="text-xl font-bold text-gray-700">{{ $invitation->gift_bank_pria }}</p>
                    <p class="text-sm italic font-medium text-pink-500">{{ $invitation->gift_bank_pria_name }}</p>
                </div>
            @endif
            @if($invitation->gift_bank_wanita)
                <div class="scroll-reveal bg-pink-50 p-6 rounded-2xl border-2 border-dashed border-pink-200">
                    <p class="text-[10px] uppercase font-bold text-pink-400 mb-2">Tanda Kasih (Bride)</p>
                    <p class="text-xl font-bold text-gray-700">{{ $invitation->gift_bank_wanita }}</p>
                    <p class="text-sm italic font-medium text-pink-500">{{ $invitation->gift_bank_wanita_name }}</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Guestbook -->
    <section class="py-24 px-6 max-w-3xl mx-auto">
         <div class="scroll-reveal text-center mb-16">
                 <h2 class="font-cursive text-5xl text-pink-600 mb-2">Best Wishes</h2>
                 <p class="text-pink-300 uppercase tracking-widest text-xs font-bold">Leave a Message</p>
            </div>
        @include('themes.partials.guestbook', ['theme' => 'floral'])
    </section>

    <footer class="py-12 bg-white text-center border-t border-pink-100">
        <h3 class="font-cursive text-3xl text-pink-500 mb-4">{{ $invitation->groom_name }} & {{ $invitation->bride_name }}</h3>
        @if($invitation->is_watermark_enabled)
        <div class="mt-8 pt-8 border-t border-pink-50 flex flex-col items-center group/wm">
           <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-pink-200 mb-2">Beautifully Designed with</span>
           <div class="flex items-center space-x-2 grayscale opacity-40 hover:opacity-100 hover:grayscale-0 transition-all duration-700 cursor-pointer">
               <div class="w-8 h-8 bg-pink-500 rounded-lg flex items-center justify-center font-black text-white text-md italic shadow-xl shadow-pink-500/10">Z</div>
               <span class="text-sm font-black tracking-tighter uppercase italic text-pink-600">ZipMoment</span>
           </div>
           <p class="text-[9px] text-pink-300 mt-2 font-medium italic">Create your dream invitation at <span class="text-pink-500 font-bold">zipmoment.id</span></p>
        </div>
        @endif

        <!-- Boutique Signature (Permanent) -->
        <div class="mt-8 opacity-20 hover:opacity-100 transition-opacity duration-1000">
           <span class="text-[8px] font-cursive italic tracking-[0.2em] text-pink-400">Experience by ZipMoment</span>
        </div>
        <p class="text-[10px] uppercase tracking-widest text-gray-400 mt-4">&copy; {{ date('Y') }} ZipMoment Invitations</p>
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
