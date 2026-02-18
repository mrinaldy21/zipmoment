<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invitation->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        .font-header { font-family: 'Cinzel', serif; }
        .font-body { font-family: 'Montserrat', sans-serif; }
    </style>
</head>
<body class="font-body bg-black text-gray-200 antialiased">
    
    @include('themes.partials.opening_screen', ['theme' => 'modern'])

    <!-- Hero Section -->
    <div class="relative min-h-screen flex flex-col justify-center items-center text-center p-6">
        @if($invitation->cover_photo_url)
            <div class="absolute inset-0 z-0 opacity-40">
                <img src="{{ $invitation->cover_photo_url }}" class="w-full h-full object-cover grayscale">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-black z-0"></div>
        @endif
        
        <div class="relative z-10 w-full max-w-lg mx-auto">
            @if(!empty($guest))
                <div class="mb-8 border-l-4 border-white pl-4 py-2 text-left">
                    <p class="text-[10px] uppercase tracking-[0.3em] text-gray-400 mb-1">To Our Guest</p>
                    <h2 class="text-2xl font-bold tracking-tight text-white">{{ $guest }}</h2>
                </div>
            @endif
            <h3 class="text-xs uppercase tracking-[0.3em] mb-8 text-gray-400">We Are Getting Married</h3>
            
            <div class="flex flex-col items-center gap-6 mb-10">
                <div class="space-y-2">
                    <h1 class="font-header text-[clamp(2rem,7vw,4.5rem)] leading-none text-white uppercase tracking-tight">{{ $invitation->groom_name }}</h1>
                    @if($invitation->groom_parent_text)
                        <p class="text-[10px] md:text-xs uppercase tracking-[0.2em] text-gray-500 whitespace-pre-line">{{ $invitation->groom_parent_text }}</p>
                    @endif
                </div>

                <span class="text-xl text-gray-700 font-light">&</span>

                <div class="space-y-2">
                    <h1 class="font-header text-[clamp(2rem,7vw,4.5rem)] leading-none text-white uppercase tracking-tight">{{ $invitation->bride_name }}</h1>
                    @if($invitation->bride_parent_text)
                        <p class="text-[10px] md:text-xs uppercase tracking-[0.2em] text-gray-500 whitespace-pre-line">{{ $invitation->bride_parent_text }}</p>
                    @endif
                </div>
            </div>

            <div class="border-t border-b border-gray-700 py-8 my-10">
                <p class="text-lg md:text-xl font-thin mb-4 tracking-widest uppercase">The Wedding of</p>
                <p class="font-light text-xl uppercase tracking-widest text-gray-300">
                    {{ \Carbon\Carbon::parse($invitation->event_date)->translatedFormat('d F Y') }}
                </p>
                <p class="text-sm mt-2 text-gray-500">
                    {{ \Carbon\Carbon::parse($invitation->event_date)->format('H:i') }} WIB
                </p>
            </div>
            
            <p class="uppercase tracking-widest text-xs text-gray-500 mb-2">Venue</p>
            <p class="font-header text-2xl mb-8">{{ $invitation->event_location }}</p>

            @if($invitation->map_link)
            <div class="mt-4">
                <a href="{{ $invitation->map_link }}" target="_blank" class="inline-block border border-white px-8 py-3 text-white hover:bg-white hover:text-black transition uppercase tracking-widest text-xs duration-300">
                    Get Directions
                </a>
            </div>
            @endif

            <!-- Gallery -->
            @if($invitation->galleries->count() > 0)
            <div class="mt-16">
                <h3 class="font-header text-2xl text-white mb-8 border-b border-gray-800 pb-4 inline-block">Gallery</h3>
                <div class="grid grid-cols-2 gap-2">
                    @foreach($invitation->galleries as $gallery)
                        <img src="{{ $gallery->photo_url }}" class="w-full h-40 object-cover grayscale hover:grayscale-0 transition duration-500 filter">
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Guestbook -->
            @include('themes.partials.guestbook', ['theme' => 'modern'])

        </div>
    </div>

</body>
</html>
