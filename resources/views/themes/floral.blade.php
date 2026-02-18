<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invitation->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .font-cursive { font-family: 'Dancing Script', cursive; }
        .font-body { font-family: 'Nunito', sans-serif; }
    </style>
</head>
<body class="font-body bg-[#fff0f5] text-[#5d4037] antialiased">

    @include('themes.partials.opening_screen', ['theme' => 'floral'])

    <!-- Hero Section -->
    <div class="min-h-screen flex flex-col justify-center items-center text-center p-6 bg-[url('https://images.unsplash.com/photo-1490750967868-58cb75063ed4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80')] bg-cover bg-center">
        <div class="absolute inset-0 bg-white/70 backdrop-blur-[2px]"></div>
        
        <div class="relative z-10 w-full max-w-lg mx-auto bg-white/80 p-10 rounded-3xl shadow-2xl border-2 border-pink-200">
            @if(!empty($guest))
                <div class="mb-6 pb-6 border-b border-pink-100">
                    <p class="text-xs uppercase tracking-widest text-pink-500 mb-1">Dear Special Guest</p>
                    <h2 class="text-2xl font-cursive font-bold text-gray-800">{{ $guest }}</h2>
                </div>
            @endif
            <h3 class="text-sm uppercase tracking-widest mb-4 text-pink-500">The Wedding Celebration of</h3>
            <div class="space-y-1">
                <h1 class="font-cursive text-[clamp(1.8rem,5vw,3.2rem)] leading-tight text-pink-600">{{ $invitation->groom_name }}</h1>
                @if($invitation->groom_parent_text)
                    <p class="text-xs md:text-sm italic text-pink-400 font-medium whitespace-pre-line">{{ $invitation->groom_parent_text }}</p>
                @endif
            </div>
            
            <div class="font-cursive text-3xl text-pink-300 my-4">&</div>

            <div class="space-y-1 mb-8">
                <h1 class="font-cursive text-[clamp(1.8rem,5vw,3.2rem)] leading-tight text-pink-600">{{ $invitation->bride_name }}</h1>
                @if($invitation->bride_parent_text)
                    <p class="text-xs md:text-sm italic text-pink-400 font-medium whitespace-pre-line">{{ $invitation->bride_parent_text }}</p>
                @endif
            </div>

            <div class="bg-pink-50 p-6 rounded-xl border border-pink-100 mb-8">
                <p class="font-bold text-2xl text-pink-800">
                    {{ \Carbon\Carbon::parse($invitation->event_date)->translatedFormat('l, d F Y') }}
                </p>
                <p class="text-lg text-pink-600">
                    {{ \Carbon\Carbon::parse($invitation->event_date)->format('H:i') }} WIB
                </p>
                <p class="mt-4 font-semibold text-lg">{{ $invitation->event_location }}</p>

                @if($invitation->map_link)
                <a href="{{ $invitation->map_link }}" target="_blank" class="mt-4 inline-block bg-pink-500 text-white px-6 py-2 rounded-full hover:bg-pink-600 transition shadow-lg transform hover:scale-105">
                    Open Map
                </a>
                @endif
            </div>

            <!-- Gallery -->
            @if($invitation->galleries->count() > 0)
            <div class="mt-8">
                <h3 class="font-cursive text-3xl text-pink-600 mb-4">Our Love Story</h3>
                <div class="flex overflow-x-auto space-x-4 pb-4">
                    @foreach($invitation->galleries as $gallery)
                        <img src="{{ $gallery->photo_url }}" class="w-48 h-32 object-cover rounded-lg shadow-md flex-shrink-0">
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Guestbook -->
            @include('themes.partials.guestbook', ['theme' => 'floral'])

        </div>
    </div>

</body>
</html>
