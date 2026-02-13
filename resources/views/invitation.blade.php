<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invitation->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .font-cursive { font-family: 'Great Vibes', cursive; }
        .font-body { font-family: 'Nunito', sans-serif; }
    </style>
</head>
<body class="font-body bg-slate-50 text-slate-800 antialiased">
    
    <!-- Hero Section -->
    <div class="relative min-h-screen flex flex-col justify-center items-center text-center p-6 bg-[url('https://images.unsplash.com/photo-1519225468725-e23a60c5e933?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80')] bg-cover bg-center">
        <div class="absolute inset-0 bg-white/60 backdrop-blur-sm"></div>
        
        <div class="relative z-10 w-full max-w-lg mx-auto animate-fade-in-up">
            <h3 class="text-xl uppercase tracking-widest mb-4">The Wedding Of</h3>
            <h1 class="font-cursive text-6xl md:text-8xl text-rose-600 mb-2">{{ $invitation->groom_name }}</h1>
            <p class="text-4xl text-rose-500 mb-2">&</p>
            <h1 class="font-cursive text-6xl md:text-8xl text-rose-600 mb-8">{{ $invitation->bride_name }}</h1>

            <div class="bg-white/80 p-6 rounded-lg shadow-xl mb-8">
                <p class="text-lg mb-2">Akan diselenggarakan pada:</p>
                <p class="font-bold text-2xl text-slate-800">
                    {{ \Carbon\Carbon::parse($invitation->event_date)->translatedFormat('l, d F Y') }}
                </p>
                <p class="text-xl text-slate-600 mb-4">
                    Pukul {{ \Carbon\Carbon::parse($invitation->event_date)->format('H:i') }} WIB
                </p>
                
                <p class="text-lg mb-2">Bertempat di:</p>
                <p class="font-bold text-lg mb-4">{{ $invitation->event_location }}</p>

                @if($invitation->map_link)
                <div class="mt-4">
                    <a href="{{ $invitation->map_link }}" target="_blank" class="inline-block bg-rose-600 text-white px-6 py-2 rounded-full hover:bg-rose-700 transition">
                        Buka Google Maps
                    </a>
                </div>
                @endif
            </div>

            <!-- Guest Name Section -->
            @if(request()->has('to'))
            <div class="mt-8 bg-slate-900/10 p-4 rounded-lg backdrop-blur-md">
                <p class="text-sm uppercase tracking-wide mb-1">Kepada Yth:</p>
                <h3 class="text-2xl font-bold">{{ request()->query('to') }}</h3>
                <p class="text-xs mt-1">Tanpa mengurangi rasa hormat, kami mengundang Bapak/Ibu/Saudara/i untuk hadir di acara kami.</p>
            </div>
            @endif
        </div>
    </div>

</body>
</html>
