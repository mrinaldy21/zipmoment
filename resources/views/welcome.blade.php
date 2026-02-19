<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ZipMoment — Premium Digital Wedding Invitations</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .glass { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(10px); }
        .gold-gradient { background: linear-gradient(135deg, #f6d365 0%, #fda085 100%); }
        .lux-text { background: linear-gradient(to right, #fff 20%, #A855F7 40%, #A855F7 60%, #fff 80%); background-size: 200% auto; color: #000; background-clip: text; text-fill-color: transparent; -webkit-background-clip: text; -webkit-text-fill-color: transparent; animation: shine 5s linear infinite; }
        @keyframes shine { to { background-position: 200% center; } }
    </style>
</head>
<body class="bg-[#050505] text-white selection:bg-amber-500 selection:text-black">
    
    <!-- Top Scarcity Banner -->
    <div class="bg-amber-500 text-black text-[10px] font-black uppercase tracking-[0.3em] py-2 text-center relative z-[60]">
        Setiap minggu kami hanya menerima 10 pasangan agar kualitas tetap terjaga
    </div>

    <!-- Navigation -->
    <nav class="fixed w-full z-50 border-b border-white/5 glass top-7">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <div class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center font-black text-black text-xl italic shadow-lg shadow-amber-500/20">Z</div>
                <span class="text-xl font-black tracking-tighter uppercase italic">ZipMoment</span>
            </div>
            
            <div class="hidden md:flex items-center space-x-10 text-[11px] font-black uppercase tracking-[0.2em] text-white/60">
                <a href="#features" class="hover:text-amber-500 transition-colors">Features</a>
                <a href="#pricing" class="hover:text-amber-500 transition-colors text-white">Pricing</a>
                <a href="#templates" class="hover:text-amber-500 transition-colors">Templates</a>
            </div>

            <div class="flex items-center space-x-4">
                @if (Route::has('login'))
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-6 py-2 bg-white text-black text-xs font-black uppercase tracking-widest rounded-full hover:bg-amber-500 transition-all">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-xs font-black tracking-widest uppercase hover:text-amber-500 transition-colors">Login</a>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-56 pb-32 overflow-hidden">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[1000px] h-[600px] bg-amber-500/10 blur-[120px] rounded-full pointer-events-none"></div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
            <div class="inline-flex items-center px-4 py-2 bg-white/5 border border-white/10 rounded-full text-[10px] font-black uppercase tracking-[0.3em] text-amber-500 mb-8 animate-pulse">
                Premium Digital Wedding Studio
            </div>
            <h1 class="text-5xl md:text-8xl font-serif italic font-black leading-[1.1] mb-8 tracking-tighter">
                Undangan Digital Premium <br> <span class="bg-gradient-to-r from-amber-200 to-amber-500 bg-clip-text text-transparent">Terlihat Mahal & Elegan</span>
            </h1>
            <p class="text-lg md:text-xl text-white/40 font-medium max-w-2xl mx-auto mb-12 leading-relaxed italic">
                Bukan sekadar link undangan, tapi pengalaman berkesan untuk tamu Anda. Desain sinematik, transisi mewah, dan kualitas tanpa kompromi.
            </p>
            
            <div class="flex flex-col md:flex-row items-center justify-center gap-6">
                @php
                    $waNumber = "628123456789";
                    $heroMsg = rawurlencode("Halo ZipMoment, saya tertarik membuat undangan digital yang mahal & elegan.\n\nMohon info detailnya.");
                    $waUrl = "https://wa.me/{$waNumber}?text={$heroMsg}";
                @endphp
                <a href="{{ $waUrl }}" target="_blank" class="w-full md:w-auto px-10 py-5 bg-amber-500 text-black font-black uppercase tracking-widest rounded-full hover:scale-105 transition-all shadow-2xl shadow-amber-500/20 flex items-center justify-center">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.412 0 6.556-5.338 11.892-11.893 11.892-1.997-.001-3.951-.5-5.688-1.448l-6.309 1.656zm6.224-3.82l.448.265c1.416.84 3.057 1.285 4.725 1.285h.005c5.454 0 9.895-4.442 9.897-9.896 0-2.642-1.029-5.125-2.897-6.994s-4.352-2.896-6.991-2.896c-5.455 0-9.896 4.442-9.898 9.897 0 1.748.463 3.453 1.336 4.956l.29.499-1.002 3.661 3.748-.983zm11.554-7.051c-.244-.123-1.442-.711-1.666-.793-.223-.082-.387-.123-.55.123s-.631.793-.773.955-.285.184-.528.062c-.243-.123-1.026-.379-1.954-1.206-.721-.643-1.209-1.437-1.351-1.682-.141-.245-.015-.377.108-.499.11-.11.243-.285.365-.428.122-.142.162-.245.243-.408.081-.163.041-.306-.021-.428s-.55-1.326-.753-1.815c-.198-.478-.399-.413-.55-.421-.143-.008-.306-.008-.469-.008s-.428.061-.652.306c-.224.245-.856.836-.856 2.04s.876 2.365.998 2.529c.122.163 1.725 2.636 4.177 3.692.584.251 1.04.402 1.396.515.586.186 1.119.16 1.54.098.47-.069 1.442-.589 1.646-1.159.204-.571.204-1.061.142-1.163s-.224-.163-.467-.285z"/></svg>
                    Pesan via WhatsApp
                </a>
                <a href="#pricing" class="w-full md:w-auto px-10 py-5 bg-white/5 border border-white/10 text-white font-black uppercase tracking-widest rounded-full hover:bg-white/10 transition-all backdrop-blur-sm">Lihat Paket Promo</a>
            </div>

            <!-- Trust Bar -->
            <div class="mt-24 pt-12 border-t border-white/5 flex flex-wrap justify-center items-center gap-12 opacity-40 grayscale group hover:grayscale-0 hover:opacity-100 transition-all duration-700">
                <div class="flex flex-col items-center">
                    <span class="text-3xl font-black italic tracking-tighter mb-1">500+</span>
                    <span class="text-[9px] font-black uppercase tracking-widest">Pasangan Bahagia</span>
                </div>
                <div class="h-8 w-[1px] bg-white/10"></div>
                <div class="flex flex-col items-center">
                    <span class="text-3xl font-black italic tracking-tighter mb-1">100%</span>
                    <span class="text-[9px] font-black uppercase tracking-widest">Kualitas Premium</span>
                </div>
                <div class="h-8 w-[1px] bg-white/10"></div>
                <div class="flex flex-col items-center">
                    <span class="text-3xl font-black italic tracking-tighter mb-1">24h</span>
                    <span class="text-[9px] font-black uppercase tracking-widest">Proses Kilat</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Differentiation Section -->
    <section class="py-32 relative bg-[#080808]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div class="space-y-8">
                    <h2 class="text-4xl md:text-5xl font-serif italic font-black leading-tight">Mengapa ZipMoment Berbeda?</h2>
                    <p class="text-white/40 leading-relaxed italic">Kami tidak menjual template kaku. Kami menciptakan karya seni digital yang menceritakan cinta Anda dengan cara yang paling eksklusif.</p>
                    
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="w-10 h-10 rounded-full bg-amber-500/10 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-black uppercase text-[10px] tracking-widest text-amber-500 mb-2">Cinematic Experience</h4>
                                <p class="text-xs text-white/60 leading-relaxed">Animasi halus dan transisi elegan yang memberikan kesan mewah sejak detik pertama.</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <div class="w-10 h-10 rounded-full bg-amber-500/10 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-black uppercase text-[10px] tracking-widest text-amber-500 mb-2">Bukan Template Pasaran</h4>
                                <p class="text-xs text-white/60 leading-relaxed">Layout eksklusif yang didesain khusus agar undangan Anda tidak terlihat sama dengan ribuan orang lain.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="relative group">
                    <div class="absolute inset-0 bg-amber-500/20 blur-[100px] rounded-full group-hover:bg-amber-500/30 transition-all duration-700"></div>
                    <div class="relative bg-white/5 border border-white/10 p-4 rounded-[40px] backdrop-blur-xl">
                        <div class="bg-black rounded-[30px] overflow-hidden aspect-[9/16] relative shadow-2xl">
                             <div class="absolute inset-x-0 top-0 p-8 z-10 text-center">
                                <div class="w-12 h-[1px] bg-amber-500/50 mx-auto mb-4"></div>
                                <span class="text-[8px] font-black uppercase tracking-[0.4em] text-white/40 block">Digital Studio Preview</span>
                             </div>
                             <img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=1000&q=80" class="w-full h-full object-cover opacity-60 scale-110 group-hover:scale-100 transition duration-[2s]">
                             <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
                             <div class="absolute bottom-12 inset-x-0 text-center px-8">
                                <h3 class="font-serif italic text-3xl mb-4">Elegance Redefined</h3>
                                <button class="px-6 py-3 bg-white text-black text-[10px] font-black uppercase tracking-widest rounded-full">Explore Demo</button>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trusted Partners Section (Instagram Style) -->
    <section class="py-32 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-serif italic font-black mb-16 tracking-tight italic">Dipercaya Pasangan di Seluruh Indonesia</h2>
            
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @for ($i = 1; $i <= 6; $i++)
                <div class="aspect-square bg-white/5 rounded-2xl overflow-hidden border border-white/5 group relative">
                    <img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover grayscale opacity-50 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-700">
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <span class="text-[8px] font-black uppercase tracking-widest border border-white/40 px-3 py-1 rounded-full">View Moment</span>
                    </div>
                </div>
                @endfor
            </div>

            <div class="mt-20 max-w-2xl mx-auto bg-white/5 border border-white/10 p-12 rounded-[50px] text-center relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-8 pointer-events-none opacity-10">
                    <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H16.017C14.9124 8 14.017 7.10457 14.017 6V5C14.017 3.34315 15.3602 2 17.017 2H18.017C18.5693 2 19.017 2.44772 19.017 3V4C19.017 4.55228 18.5693 5 18.017 5H17.017C16.4647 5 16.017 5.44772 16.017 6V8H19.017C20.6739 8 22.017 9.34315 22.017 11V15C22.017 16.6569 20.6739 18 19.017 18H16.017L16.017 21H14.017ZM2.017 21L2.017 18C2.017 16.8954 2.91243 16 4.017 16H7.017C7.56928 16 8.017 15.5523 8.017 15V9C8.017 8.44772 7.56928 8 7.017 8H4.017C2.91243 8 2.017 7.10457 2.017 6V5C2.017 3.34315 3.36015 2 5.017 2H6.017C6.56928 2 7.017 2.44772 7.017 3V4C7.017 4.55228 6.56928 5 6.017 5H5.017C4.46472 5 4.017 5.44772 4.017 6V8H7.017C8.67385 8 10.017 9.34315 10.017 11V15C10.017 16.6569 8.67385 18 7.017 18H4.017L4.017 21H2.017Z"/></svg>
                </div>
                <div class="flex items-center justify-center space-x-2 text-amber-500 mb-6">
                    @for($i=0; $i<5; $i++)<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>@endfor
                </div>
                <p class="text-xl md:text-2xl font-serif italic mb-8 leading-relaxed">"Undangannya benar-benar mahal sekali kelihatannya. Tamu-tamu saya pada tanya bikin di mana. Benar-benar eksklusif!"</p>
                <div class="flex flex-col items-center">
                    <img src="https://via.placeholder.com/60" class="w-12 h-12 rounded-full mb-4 grayscale">
                    <span class="text-[10px] font-black uppercase tracking-widest">Amanda & Rizky</span>
                    <span class="text-[8px] font-medium text-white/40 uppercase tracking-widest mt-1">Wedding 2024</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-32 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <div class="inline-block px-4 py-1 bg-amber-500/10 text-amber-500 border border-amber-500/20 rounded-full text-[10px] font-black uppercase tracking-[0.2em] mb-4">Launching Promo: 20% OFF</div>
                <h2 class="text-4xl md:text-5xl font-serif italic font-black mb-6 tracking-tight">Investasi untuk Moment Berharga</h2>
                <p class="text-white/40 text-sm tracking-widest uppercase font-black">Pilih paket eksklusif untuk pernikahan impian Anda</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
                @php
                    function waLink($package, $price, $number) {
                        $msg = "Halo ZipMoment, saya tertarik membuat undangan digital yang mahal & elegan.\n\nPaket yang saya pilih: {$package} (IDR {$price})\n\nMohon info detailnya.";
                        return "https://wa.me/{$number}?text=" . rawurlencode($msg);
                    }
                @endphp
                <!-- Package 1: Basic -->
                <div class="flex flex-col p-10 rounded-[40px] border border-white/5 bg-white/[0.02] hover:bg-white/[0.04] transition-all group relative">
                    <div class="mb-10 text-center">
                        <span class="text-[10px] font-black uppercase tracking-[0.4em] text-white/40 mb-2 block tracking-widest leading-none">THE ORIENT</span>
                        <h3 class="text-3xl font-serif italic font-bold mb-4 tracking-tighter">Basic</h3>
                        <div class="flex flex-col items-center">
                            <span class="text-xs text-white/20 line-through mb-1">IDR 69k</span>
                            <div class="flex items-baseline justify-center">
                                <span class="text-lg text-white/40 font-bold mr-1 italic">IDR</span>
                                <span class="text-5xl font-black tracking-tighter italic">49k</span>
                            </div>
                        </div>
                    </div>
                    
                    <ul class="space-y-6 mb-12 flex-1">
                        <li class="flex items-center text-xs tracking-wide text-white/60">
                            <svg class="w-4 h-4 mr-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            Standard Template
                        </li>
                        <li class="flex items-center text-xs tracking-wide text-white/60">
                            <svg class="w-4 h-4 mr-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            Music Player
                        </li>
                        <li class="flex items-center text-xs tracking-wide text-white/60">
                            <svg class="w-4 h-4 mr-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            Event Information
                        </li>
                        <li class="flex items-center text-xs tracking-wide text-white/60">
                            <svg class="w-4 h-4 mr-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            Gallery (Max 5 Photos)
                        </li>
                        <li class="flex items-center text-xs tracking-wide text-white/30 italic">
                            <svg class="w-4 h-4 mr-3 text-red-500/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                            Watermark Branding
                        </li>
                    </ul>

                    </ul>

                    <a href="{{ waLink('Basic', '49k', $waNumber) }}" target="_blank" class="w-full py-4 text-center border border-white/10 font-black uppercase text-[10px] tracking-widest rounded-2xl hover:bg-white/5 transition-all">Pesan Paket Basic</a>
                </div>

                <!-- Package 2: Premium (Best Seller) -->
                <div class="flex flex-col p-10 rounded-[40px] border-2 border-amber-500/30 bg-gradient-to-br from-amber-500/10 to-transparent hover:from-amber-500/20 transition-all group relative lg:scale-105 shadow-2xl shadow-amber-500/10 overflow-hidden">
                    <div class="absolute top-0 right-10 py-3 px-6 bg-amber-500 text-black text-[10px] font-black uppercase tracking-widest rounded-b-3xl shadow-lg">Best Seller</div>
                    
                    <div class="mb-10 text-center">
                        <span class="text-[10px] font-black uppercase tracking-[0.4em] text-amber-500 mb-2 block tracking-widest leading-none">THE SIGNATURE</span>
                        <h3 class="text-3xl font-serif italic font-bold mb-4 tracking-tighter text-amber-100">Premium</h3>
                        <div class="flex flex-col items-center">
                            <span class="text-xs text-amber-500/30 line-through mb-1">IDR 149k</span>
                            <div class="flex items-baseline justify-center">
                                <span class="text-lg text-amber-500/60 font-bold mr-1 italic">IDR</span>
                                <span class="text-6xl font-black tracking-tighter text-amber-500 italic leading-none">99k</span>
                            </div>
                        </div>
                    </div>
                    
                    <ul class="space-y-6 mb-12 flex-1">
                        <li class="flex items-center text-xs tracking-wide text-amber-100 font-bold">
                            <svg class="w-4 h-4 mr-3 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            All Templates Unlocked
                        </li>
                        <li class="flex items-center text-xs tracking-wide text-white/80">
                            <svg class="w-4 h-4 mr-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            Unlimited Photo Gallery
                        </li>
                        <li class="flex items-center text-xs tracking-wide text-white/80">
                            <svg class="w-4 h-4 mr-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            RSVP System
                        </li>
                        <li class="flex items-center text-xs tracking-wide text-white/80">
                            <svg class="w-4 h-4 mr-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            Love Story Section
                        </li>
                        <li class="flex items-center text-xs tracking-wide text-white/80">
                            <svg class="w-4 h-4 mr-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            Google Maps Integration
                        </li>
                        <li class="flex items-center text-xs tracking-wide text-amber-400 font-bold italic">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            NO WATERMARK
                        </li>
                    </ul>

                    </ul>

                    <a href="{{ waLink('Premium', '99k', $waNumber) }}" target="_blank" class="w-full py-5 text-center bg-amber-500 text-black font-black uppercase text-[10px] tracking-widest rounded-2xl hover:scale-[1.02] transition-all shadow-xl shadow-amber-500/20">Ambil Promo Premium</a>
                </div>

                <!-- Package 3: Exclusive (Luxury) -->
                <div class="flex flex-col p-10 rounded-[40px] border border-white/5 bg-gradient-to-br from-indigo-500/[0.05] to-transparent hover:from-indigo-500/10 transition-all group relative">
                    <div class="absolute top-0 right-10 py-3 px-6 bg-indigo-500 text-white text-[10px] font-black uppercase tracking-widest rounded-b-3xl shadow-lg">Luxury</div>
                    <div class="mb-10 text-center">
                        <span class="text-[10px] font-black uppercase tracking-[0.4em] text-indigo-400 mb-2 block tracking-widest leading-none">THE MAJESTY</span>
                        <h3 class="text-3xl font-serif italic font-bold mb-4 tracking-tighter">Exclusive</h3>
                        <div class="flex flex-col items-center">
                            <span class="text-xs text-indigo-500/20 line-through mb-1">IDR 299k</span>
                            <div class="flex items-baseline justify-center">
                                <span class="text-lg text-indigo-400/60 font-bold mr-1 italic">IDR</span>
                                <span class="text-5xl font-black tracking-tighter text-white italic leading-none">249k</span>
                            </div>
                        </div>
                    </div>
                    
                    <ul class="space-y-6 mb-12 flex-1">
                        <li class="flex items-center text-xs tracking-wide text-indigo-100 font-black uppercase tracking-widest">
                            <svg class="w-4 h-4 mr-3 text-indigo-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
                            CUSTOM DOMAIN (.com)
                        </li>
                        <li class="flex items-center text-xs tracking-wide text-white/80">
                            <svg class="w-4 h-4 mr-3 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            VIP Luxury FX Animations
                        </li>
                        <li class="flex items-center text-xs tracking-wide text-white/80">
                            <svg class="w-4 h-4 mr-3 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            Cinematic Countdown
                        </li>
                        <li class="flex items-center text-xs tracking-wide text-white/80">
                            <svg class="w-4 h-4 mr-3 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            Priority High Performance
                        </li>
                        <li class="flex items-center text-xs tracking-wide text-white/80">
                            <svg class="w-4 h-4 mr-3 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            Full Concierge Support
                        </li>
                    </ul>

                    </ul>

                    <a href="{{ waLink('Exclusive', '249k', $waNumber) }}" target="_blank" class="w-full py-4 text-center border border-indigo-500/20 text-indigo-300 font-black uppercase text-[10px] tracking-widest rounded-2xl hover:bg-indigo-500/10 transition-all">Pesan Luxury Kit</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Floating WhatsApp Button -->
    <a href="{{ $waUrl }}" target="_blank" class="fixed bottom-8 right-8 z-[100] group">
        <div class="absolute inset-0 bg-amber-500 blur-xl opacity-40 group-hover:opacity-60 transition-opacity animate-pulse"></div>
        <div class="relative bg-amber-500 text-black p-4 rounded-full shadow-2xl flex items-center space-x-3 hover:scale-110 transition-transform">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.412 0 6.556-5.338 11.892-11.893 11.892-1.997-.001-3.951-.5-5.688-1.448l-6.309 1.656zm6.224-3.82l.448.265c1.416.84 3.057 1.285 4.725 1.285h.005c5.454 0 9.895-4.442 9.897-9.896 0-2.642-1.029-5.125-2.897-6.994s-4.352-2.896-6.991-2.896c-5.455 0-9.896 4.442-9.898 9.897 0 1.748.463 3.453 1.336 4.956l.29.499-1.002 3.661 3.748-.983zm11.554-7.051c-.244-.123-1.442-.711-1.666-.793-.223-.082-.387-.123-.55.123s-.631.793-.773.955-.285.184-.528.062c-.243-.123-1.026-.379-1.954-1.206-.721-.643-1.209-1.437-1.351-1.682-.141-.245-.015-.377.108-.499.11-.11.243-.285.365-.428.122-.142.162-.245.243-.408.081-.163.041-.306-.021-.428s-.55-1.326-.753-1.815c-.198-.478-.399-.413-.55-.421-.143-.008-.306-.008-.469-.008s-.428.061-.652.306c-.224.245-.856.836-.856 2.04s.876 2.365.998 2.529c.122.163 1.725 2.636 4.177 3.692.584.251 1.04.402 1.396.515.586.186 1.119.16 1.54.098.47-.069 1.442-.589 1.646-1.159.204-.571.204-1.061.142-1.163s-.224-.163-.467-.285z"/></svg>
            <span class="text-[10px] font-black uppercase tracking-widest hidden md:block">Konsultasi Promo</span>
        </div>
    </a>

    <!-- Footer -->
    <footer class="py-20 border-t border-white/5 relative bg-black">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center font-black text-white text-md italic">Z</div>
                <span class="text-lg font-black tracking-tighter uppercase italic opacity-60">ZipMoment</span>
            </div>
            
            <p class="text-white/20 text-[10px] tracking-[0.2em] font-black uppercase">&copy; 2026 ZipMoment Digital Wedding Platform. All Rights Reserved.</p>
            
            <div class="flex items-center space-x-6 text-white/40">
                <a href="#" class="hover:text-white transition-colors transition-all"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4.001 1.791 4.001 4c0 2.21-1.791 4-4.001 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
                <a href="#" class="hover:text-white transition-colors transition-all"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg></a>
            </div>
        </div>
    </footer>

</body>
</html>
