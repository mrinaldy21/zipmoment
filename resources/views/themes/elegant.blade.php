<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invitation->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .font-cursive { font-family: 'Great Vibes', cursive; }
        .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="font-serif bg-[#fdfbf7] text-[#4a4a4a] antialiased">
    
    @include('themes.partials.opening_screen', ['theme' => 'elegant'])
    
    <!-- Hero Section -->
    <div class="relative min-h-screen flex flex-col justify-center items-center text-center p-6">
        @if($invitation->cover_photo_url)
            <div class="absolute inset-0 z-0">
                <img src="{{ $invitation->cover_photo_url }}" class="w-full h-full object-cover opacity-20">
            </div>
        @endif
        
        <div class="relative z-10 w-full max-w-2xl mx-auto border-4 border-double border-[#d4af37] p-8 bg-white/90 shadow-xl">
            @if(!empty($guest))
                <div class="mb-6 pb-6 border-b border-gray-100">
                    <p class="text-xs uppercase tracking-[0.2em] text-gray-500 mb-2">Kepada Yth. Bapak/Ibu/Saudara/i</p>
                    <h2 class="text-3xl font-cursive text-[#2c2c2c]">{{ $guest }}</h2>
                </div>
            @endif
            <h3 class="text-xl uppercase tracking-[0.2em] mb-6 text-[#d4af37]">The Wedding Of</h3>
            <div class="space-y-2">
                <h1 class="font-serif text-[clamp(1.8rem,5vw,3.2rem)] leading-tight text-[#d4af37]">
                    {{ $invitation->groom_name }}
                </h1>
                
                @if($invitation->groom_parent_text)
                    <p class="text-sm md:text-base tracking-wide text-gray-500 whitespace-pre-line">{{ $invitation->groom_parent_text }}</p>
                @endif
            </div>

            <p class="text-2xl md:text-3xl text-[#d4af37] my-6">&</p>

            <div class="space-y-3 mb-8">
                <h1 class="font-serif text-[clamp(1.8rem,5vw,3.2rem)] leading-tight text-[#d4af37]">
                    {{ $invitation->bride_name }}
                </h1>

                @if($invitation->bride_parent_text)
                    <p class="text-sm md:text-base tracking-wide text-gray-500 whitespace-pre-line">{{ $invitation->bride_parent_text }}</p>
                @endif
            </div>


            <div class="my-8 border-t border-b border-[#d4af37] py-6">
                <p class="text-lg italic mb-2">Save the Date</p>
                <p class="font-bold text-3xl uppercase tracking-widest text-[#2c2c2c]">
                    {{ \Carbon\Carbon::parse($invitation->event_date)->translatedFormat('d F Y') }}
                </p>
                <p class="text-xl text-[#666] mt-2">
                    {{ \Carbon\Carbon::parse($invitation->event_date)->format('H:i') }} WIB
                </p>
            </div>
            
            <p class="text-lg mb-2">Location</p>
            <p class="font-bold text-xl mb-6">{{ $invitation->event_location }}</p>

            @if($invitation->map_link)
            <div class="mt-4">
                <a href="{{ $invitation->map_link }}" target="_blank" class="inline-block border border-[#d4af37] text-[#d4af37] px-8 py-3 hover:bg-[#d4af37] hover:text-white transition uppercase tracking-widest text-sm">
                    View Map
                </a>
            </div>
            @endif

            <!-- Gallery -->
            @if($invitation->galleries->count() > 0)
            <div class="mt-12">
                <h3 class="font-cursive text-4xl text-[#d4af37] mb-6">Our Moments</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($invitation->galleries as $gallery)
                        <img src="{{ $gallery->photo_url }}" class="w-full h-32 object-cover rounded shadow hover:opacity-75 transition">
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Guestbook -->
            @include('themes.partials.guestbook', ['theme' => 'elegant'])

        </div>
    </div>

</body>
</html>
