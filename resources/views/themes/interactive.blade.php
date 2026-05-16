@php
    $activeScene = $invitation->interactiveScenes()->where('is_active', true)->orderBy('sort_order')->first();
    // Fallback if no interactive scene exists
    if (!$activeScene) {
        $fallbackTemplate = 'romantic'; // Just a fallback
        // We will try to include a different view if this fails, but for now let's just show a simple message or load the first allowed template.
    }
@endphp

@if(!$activeScene)
    <div style="text-align:center; padding: 50px; font-family: sans-serif;">
        <h1>Tampilan Interaktif Belum Siap</h1>
        <p>Mohon maaf, template interaktif untuk undangan ini belum dikonfigurasi.</p>
    </div>
@else
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{{ $invitation->title }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS (via CDN for standalone theme) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Framer Motion / Animation logic handled via custom CSS for simplicity -->
    <style>
        :root {
            --primary: #cfa75a;
            --dark: #2b130d;
        }
        body {
            margin: 0;
            padding: 0;
            background-color: #1a1a1a;
            font-family: 'Inter', sans-serif;
            color: #333;
            overflow: hidden; /* Prevent scrolling on body */
        }
        h1, h2, h3, .font-serif {
            font-family: 'Cormorant Garamond', serif;
        }
        
        /* Mobile Wrapper */
        .mobile-wrapper {
            position: relative;
            width: 100%;
            height: 100dvh;
            max-width: 480px;
            margin: 0 auto;
            background-color: #000;
            box-shadow: 0 0 50px rgba(0,0,0,0.5);
            overflow: hidden;
        }
        
        /* Background Scene */
        .scene-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 1;
        }
        
        /* Hotspots */
        .hotspot-layer {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 10;
        }
        
        .hotspot-item {
            position: absolute;
            transform: translate(-50%, -50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            z-index: 15;
            animation: float 4s ease-in-out infinite;
        }
        
        .hotspot-item:active {
            transform: translate(-50%, -50%) scale(0.95);
        }
        
        @keyframes float {
            0% { margin-top: 0px; }
            50% { margin-top: -8px; }
            100% { margin-top: 0px; }
        }
        
        .hotspot-icon {
            width: 55px;
            height: 55px;
            filter: drop-shadow(0 10px 15px rgba(0,0,0,0.3));
            transition: all 0.3s ease;
        }
        
        .hotspot-fallback {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(4px);
            border: 2px solid var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        
        .hotspot-fallback::after {
            content: '';
            width: 12px;
            height: 12px;
            background-color: var(--primary);
            border-radius: 50%;
        }
        
        .hotspot-label {
            margin-top: 8px;
            font-family: 'Cormorant Garamond', serif;
            font-size: 14px;
            font-weight: 700;
            color: #fff;
            background: linear-gradient(135deg, rgba(43,19,13,0.8), rgba(102,64,33,0.8));
            padding: 4px 12px;
            border-radius: 20px;
            white-space: nowrap;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            border: 1px solid rgba(255,255,255,0.2);
        }
        
        /* Modal System */
        .modal-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(5px);
            z-index: 50;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: flex-end;
        }
        
        .modal-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }
        
        .modal-content {
            width: 100%;
            max-height: 85%;
            background: linear-gradient(to bottom, #fffaf0, #f4dfb9);
            border-radius: 30px 30px 0 0;
            padding: 30px 24px;
            transform: translateY(100%);
            transition: transform 0.4s cubic-bezier(0.2, 0.9, 0.2, 1);
            overflow-y: auto;
            position: relative;
            box-shadow: 0 -10px 40px rgba(0,0,0,0.2);
        }
        
        .modal-overlay.active .modal-content {
            transform: translateY(0);
        }
        
        .modal-handle {
            width: 50px;
            height: 5px;
            background: rgba(0,0,0,0.2);
            border-radius: 5px;
            margin: 0 auto 20px;
        }
        
        .close-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 36px;
            height: 36px;
            background: #2b130d;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            cursor: pointer;
            z-index: 10;
        }
        
        /* Content Styling */
        .content-title {
            font-size: 32px;
            color: #2b130d;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .card {
            background: rgba(255,255,255,0.7);
            border: 1px solid rgba(207,167,90,0.4);
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 16px;
        }
        
        /* Music Control */
        .music-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 45px;
            height: 45px;
            background: rgba(255,255,255,0.8);
            backdrop-filter: blur(4px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 40;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }
        
        .music-btn.playing {
            animation: spin 4s linear infinite;
        }
        
        @keyframes spin { 100% { transform: rotate(360deg); } }
    </style>
</head>
<body>

<div class="mobile-wrapper">
    <!-- Background Scene -->
    <img src="{{ $activeScene->background_url }}" class="scene-bg" alt="{{ $activeScene->name }}">
    
    <!-- Music Button -->
    @if($invitation->music_path)
    <div id="musicToggle" class="music-btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2b130d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18V5l12-2v13"></path><circle cx="6" cy="18" r="3"></circle><circle cx="18" cy="16" r="3"></circle></svg>
    </div>
    <audio id="bgMusic" loop src="{{ $invitation->music_url }}"></audio>
    @endif
    
    <!-- Hotspots -->
    <div class="hotspot-layer">
        @foreach($activeScene->hotspots->where('is_active', true) as $index => $hotspot)
            <div class="hotspot-item" style="left: {{ $hotspot->x_percent }}%; top: {{ $hotspot->y_percent }}%; animation-delay: {{ $index * 0.2 }}s;" onclick="openModal('{{ $hotspot->target_type }}', '{{ $hotspot->id }}')">
                @if($hotspot->icon_url)
                    <img src="{{ $hotspot->icon_url }}" class="hotspot-icon" alt="{{ $hotspot->label }}">
                @else
                    <div class="hotspot-fallback"></div>
                @endif
                
                @if($hotspot->label)
                    <div class="hotspot-label">{{ $hotspot->label }}</div>
                @endif
            </div>
            
            <!-- Preload Custom Content into Hidden Divs if custom -->
            @if($hotspot->target_type === 'custom')
                <div id="custom-content-{{ $hotspot->id }}" class="hidden">
                    <h2 class="content-title">{{ $hotspot->custom_title ?? 'Informasi' }}</h2>
                    <div class="card">
                        <p class="text-gray-700 leading-relaxed">{{ $hotspot->custom_content }}</p>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    
    <!-- Unified Modal -->
    <div id="mainModal" class="modal-overlay" onclick="if(event.target === this) closeModal()">
        <div class="modal-content">
            <div class="modal-handle"></div>
            <div class="close-btn" onclick="closeModal()">✕</div>
            
            <div id="modalBody" class="pb-10">
                <!-- Content injected here via JS -->
            </div>
        </div>
    </div>
</div>

<!-- Hidden Content Blocks for Injection -->
<div class="hidden">
    <!-- Couple Info -->
    <div id="content-couple">
        <h2 class="content-title">About Us</h2>
        <div class="grid grid-cols-1 gap-4">
            <div class="card text-center">
                @if($invitation->groom_photo)
                <img src="{{ $invitation->groom_photo_url }}" class="w-24 h-24 rounded-full mx-auto mb-3 object-cover border-2 border-[var(--primary)]">
                @endif
                <h3 class="font-serif text-2xl font-bold text-gray-800">{{ $invitation->groom_name }}</h3>
                <p class="text-sm text-gray-600 mt-2">{!! nl2br(e($invitation->groom_parent_text)) !!}</p>
                @if($invitation->groom_instagram)
                <a href="https://instagram.com/{{ $invitation->groom_instagram }}" target="_blank" class="inline-block mt-3 text-sm text-pink-600">@{{ $invitation->groom_instagram }}</a>
                @endif
            </div>
            
            <div class="text-center font-serif text-3xl text-[var(--primary)]">&</div>
            
            <div class="card text-center">
                @if($invitation->bride_photo)
                <img src="{{ $invitation->bride_photo_url }}" class="w-24 h-24 rounded-full mx-auto mb-3 object-cover border-2 border-[var(--primary)]">
                @endif
                <h3 class="font-serif text-2xl font-bold text-gray-800">{{ $invitation->bride_name }}</h3>
                <p class="text-sm text-gray-600 mt-2">{!! nl2br(e($invitation->bride_parent_text)) !!}</p>
                @if($invitation->bride_instagram)
                <a href="https://instagram.com/{{ $invitation->bride_instagram }}" target="_blank" class="inline-block mt-3 text-sm text-pink-600">@{{ $invitation->bride_instagram }}</a>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Gallery -->
    <div id="content-gallery">
        <h2 class="content-title">Gallery</h2>
        @if($invitation->galleries->count() > 0)
        <div class="grid grid-cols-2 gap-3">
            @foreach($invitation->galleries as $photo)
                <img src="{{ $photo->photo_url }}" class="w-full h-32 object-cover rounded-xl shadow-sm border border-[var(--primary)] border-opacity-30">
            @endforeach
        </div>
        @else
        <p class="text-center text-gray-500 py-10">Belum ada foto.</p>
        @endif
    </div>
    
    <!-- Date & Venue -->
    <div id="content-date_venue">
        <h2 class="content-title">Date & Venue</h2>
        
        @if($invitation->akad_date || $invitation->resepsi_date)
            @if($invitation->akad_date)
            <div class="card text-center">
                <h3 class="font-serif text-xl font-bold text-gray-800 mb-2">Akad Nikah</h3>
                <p class="font-medium text-[var(--primary)]">{{ \Carbon\Carbon::parse($invitation->akad_date)->translatedFormat('l, d F Y') }}</p>
                <p class="text-gray-600 text-sm mt-1">{{ $invitation->akad_start }} - {{ $invitation->akad_end ?? 'Selesai' }}</p>
                @if($invitation->akad_location)
                <p class="text-sm font-semibold mt-3 text-gray-800">{{ $invitation->akad_location }}</p>
                @endif
                @if($invitation->akad_maps)
                <a href="{{ $invitation->akad_maps }}" target="_blank" class="mt-4 inline-block w-full py-2 bg-gray-900 text-white rounded-lg text-sm">Buka Google Maps</a>
                @endif
            </div>
            @endif
            
            @if($invitation->resepsi_date)
            <div class="card text-center mt-4">
                <h3 class="font-serif text-xl font-bold text-gray-800 mb-2">Resepsi</h3>
                <p class="font-medium text-[var(--primary)]">{{ \Carbon\Carbon::parse($invitation->resepsi_date)->translatedFormat('l, d F Y') }}</p>
                <p class="text-gray-600 text-sm mt-1">{{ $invitation->resepsi_start }} - {{ $invitation->resepsi_end ?? 'Selesai' }}</p>
                @if($invitation->resepsi_location)
                <p class="text-sm font-semibold mt-3 text-gray-800">{{ $invitation->resepsi_location }}</p>
                @endif
                @if($invitation->resepsi_maps)
                <a href="{{ $invitation->resepsi_maps }}" target="_blank" class="mt-4 inline-block w-full py-2 bg-gray-900 text-white rounded-lg text-sm">Buka Google Maps</a>
                @endif
            </div>
            @endif
        @else
            <!-- Fallback to basic event fields if new ones are empty -->
            <div class="card text-center">
                <h3 class="font-serif text-xl font-bold text-gray-800 mb-2">Acara Pernikahan</h3>
                <p class="font-medium text-[var(--primary)]">{{ \Carbon\Carbon::parse($invitation->event_date)->translatedFormat('l, d F Y') }}</p>
                @if($invitation->event_location)
                <p class="text-sm font-semibold mt-3 text-gray-800">{{ $invitation->event_location }}</p>
                @endif
                @if($invitation->map_link)
                <a href="{{ $invitation->map_link }}" target="_blank" class="mt-4 inline-block w-full py-2 bg-gray-900 text-white rounded-lg text-sm">Buka Google Maps</a>
                @endif
            </div>
        @endif
    </div>
    
    <!-- Gift -->
    <div id="content-gift">
        <h2 class="content-title">Wedding Gift</h2>
        <p class="text-center text-sm text-gray-600 mb-6">Doa restu Anda merupakan karunia yang sangat berarti bagi kami.</p>
        
        @if($invitation->gift_bank_pria || $invitation->gift_bank_wanita)
            @if($invitation->gift_bank_pria)
            <div class="card">
                <p class="font-bold text-gray-800">Bank / E-Wallet</p>
                <p class="text-[var(--primary)] font-mono text-lg mt-1 mb-1">{{ $invitation->gift_bank_pria }}</p>
                <p class="text-sm text-gray-600">a.n. {{ $invitation->gift_bank_pria_name ?? $invitation->groom_name }}</p>
            </div>
            @endif
            
            @if($invitation->gift_bank_wanita)
            <div class="card mt-3">
                <p class="font-bold text-gray-800">Bank / E-Wallet</p>
                <p class="text-[var(--primary)] font-mono text-lg mt-1 mb-1">{{ $invitation->gift_bank_wanita }}</p>
                <p class="text-sm text-gray-600">a.n. {{ $invitation->gift_bank_wanita_name ?? $invitation->bride_name }}</p>
            </div>
            @endif
        @else
            <div class="card text-center">
                <p class="text-gray-500">Informasi gift belum tersedia.</p>
            </div>
        @endif
    </div>

    <!-- RSVP -->
    <div id="content-rsvp">
        <h2 class="content-title">RSVP</h2>
        <div class="card">
            <form action="{{ route('guestbook.store', $invitation) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" name="name" required class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white/50 focus:outline-none focus:border-[var(--primary)]" placeholder="Nama Anda">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kehadiran</label>
                    <select name="attendance" required class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white/50 focus:outline-none focus:border-[var(--primary)]">
                        <option value="Hadir">Hadir</option>
                        <option value="Tidak Hadir">Tidak Hadir</option>
                        <option value="Ragu-ragu">Ragu-ragu</option>
                    </select>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ucapan & Doa</label>
                    <textarea name="message" rows="3" required class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white/50 focus:outline-none focus:border-[var(--primary)]" placeholder="Tuliskan ucapan Anda"></textarea>
                </div>
                <button type="submit" class="w-full py-3 bg-[#2b130d] text-white rounded-xl font-bold hover:bg-[#4a2819] transition-colors">Kirim RSVP</button>
            </form>
        </div>
    </div>
    
    <!-- Love Story -->
    <div id="content-love_story">
        <h2 class="content-title">Love Story</h2>
        @if($invitation->loveStories->count() > 0)
            <div class="relative pl-6 border-l-2 border-[var(--primary)] space-y-6">
                @foreach($invitation->loveStories as $story)
                <div class="relative">
                    <div class="absolute w-4 h-4 bg-[var(--primary)] rounded-full -left-[33px] top-1"></div>
                    <h3 class="font-bold text-gray-800">{{ $story->year }}</h3>
                    <h4 class="font-serif text-lg font-bold text-[#2b130d] mt-1">{{ $story->title }}</h4>
                    <p class="text-sm text-gray-600 mt-2">{{ $story->story }}</p>
                </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500 py-4">Cerita cinta belum ditambahkan.</p>
        @endif
    </div>
</div>

<script>
    // Music Player Logic
    const musicToggle = document.getElementById('musicToggle');
    const bgMusic = document.getElementById('bgMusic');
    
    if(musicToggle && bgMusic) {
        musicToggle.addEventListener('click', () => {
            if (bgMusic.paused) {
                bgMusic.play();
                musicToggle.classList.add('playing');
                // Change icon to pause or animated visualizer
            } else {
                bgMusic.pause();
                musicToggle.classList.remove('playing');
            }
        });
        
        // Auto play try on first click anywhere
        document.body.addEventListener('click', function initAudio() {
            if(bgMusic.paused) {
                bgMusic.play().then(() => {
                    musicToggle.classList.add('playing');
                }).catch(e => console.log('Autoplay prevented'));
            }
            document.body.removeEventListener('click', initAudio);
        }, { once: true });
    }

    // Modal Logic
    const modalOverlay = document.getElementById('mainModal');
    const modalBody = document.getElementById('modalBody');

    function openModal(type, id = null) {
        modalBody.innerHTML = '';
        let sourceHtml = '';
        
        if (type === 'custom' && id) {
            const el = document.getElementById('custom-content-' + id);
            if(el) sourceHtml = el.innerHTML;
        } else {
            const el = document.getElementById('content-' + type);
            if(el) sourceHtml = el.innerHTML;
        }
        
        if (!sourceHtml) {
            sourceHtml = '<div class="text-center py-10"><p>Konten belum tersedia.</p></div>';
        }
        
        modalBody.innerHTML = sourceHtml;
        modalOverlay.classList.add('active');
    }

    function closeModal() {
        modalOverlay.classList.remove('active');
    }
</script>

</body>
</html>
@endif
