<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ZipMoment — Premium Digital Wedding Invitations</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .font-outfit { font-family: 'Outfit', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .lux-gradient { background: linear-gradient(135deg, #fff 0%, #facc15 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        
        /* Cinematic Noise Textures */
        .grain-overlay {
            position: fixed;
            top: -50%;
            left: -50%;
            right: -50%;
            bottom: -50%;
            width: 200%;
            height: 200%;
            background: transparent url('http://assets.iceable.com/img/noise-transparent.png') repeat 0 0;
            background-repeat: repeat;
            animation: grain 8s steps(10) infinite;
            opacity: .05;
            visibility: visible;
            z-index: 1000;
            pointer-events: none;
        }

        @keyframes grain {
            0%, 100% { transform:translate(0, 0); }
            10% { transform:translate(-5%, -10%); }
            20% { transform:translate(-15%, 5%); }
            30% { transform:translate(7%, -25%); }
            40% { transform:translate(-5%, 25%); }
            50% { transform:translate(-15%, 10%); }
            60% { transform:translate(15%, 0%); }
            70% { transform:translate(0%, 15%); }
            80% { transform:translate(3%, 35%); }
            90% { transform:translate(-10%, 10%); }
        }

        .cinematic-reveal {
            animation: cinematicReveal 1.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        @keyframes cinematicReveal {
            to { opacity: 1; transform: translateY(0); }
        }

        .lens-flare {
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(251, 191, 36, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(60px);
            pointer-events: none;
        }
    </style>
</head>
<body class="bg-[#030303] text-white selection:bg-amber-500 selection:text-black antialiased">
    <!-- Cinematic Grain Overlay -->
    <div class="grain-overlay"></div>

    <!-- Navigation -->
    <nav class="fixed w-full z-[60] top-0 py-6 transition-all duration-500">
        <div class="max-w-7xl mx-auto px-8 flex items-center justify-between">
            <div class="flex items-center space-x-3 group cursor-pointer">
                <div class="w-10 h-10 bg-gradient-to-tr from-amber-500 to-amber-200 rounded-xl flex items-center justify-center shadow-lg shadow-amber-500/20 group-hover:scale-110 transition-transform duration-500">
                    <span class="text-black font-black text-xl italic">Z</span>
                </div>
                <span class="text-2xl font-outfit font-black tracking-tighter uppercase italic tracking-[0.1em]">ZipMoment</span>
            </div>
            
            <div class="hidden md:flex items-center space-x-12 text-[10px] font-black uppercase tracking-[0.3em] text-white/40">
                <a href="#features" class="hover:text-amber-500 transition-colors">Experience</a>
                <a href="#pricing" class="hover:text-amber-500 transition-colors text-white">Investment</a>
                <a href="#templates" class="hover:text-amber-500 transition-colors">Showcase</a>
            </div>

            <div class="flex items-center space-x-6">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-8 py-3 bg-white text-black text-[10px] font-black uppercase tracking-widest rounded-full hover:bg-amber-500 hover:scale-105 transition-all shadow-xl">Studio Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-[10px] font-black tracking-widest uppercase hover:text-amber-500 transition-colors border-b border-transparent hover:border-amber-500">Client Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden pt-20">
        <!-- Luxury Ambient Background -->
        <div class="absolute inset-0 z-0">
            <div class="lens-flare top-[-10%] left-[-10%] animate-pulse"></div>
            <div class="lens-flare bottom-[-10%] right-[-10%] opacity-50"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[radial-gradient(circle_at_center,_rgba(251,191,36,0.03)_0%,_transparent_60%)]"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-8 relative z-10 text-center">
            <div class="cinematic-reveal inline-flex items-center px-5 py-2 glass rounded-full text-[9px] font-black uppercase tracking-[0.4em] text-amber-500 mb-10 border border-amber-500/10">
                <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mr-3 animate-ping"></span>
                The Pinnacle of Digital Invitations
            </div>
            
            <h1 class="cinematic-reveal text-6xl md:text-[120px] font-serif italic font-black leading-[0.9] mb-10 tracking-tighter" style="animation-delay: 0.2s">
                Undangan Digital <br> 
                <span class="lux-gradient">Yang Terasa Mahal.</span>
            </h1>
            
            <p class="cinematic-reveal text-lg md:text-2xl text-white/40 font-outfit font-light max-w-3xl mx-auto mb-16 leading-relaxed italic" style="animation-delay: 0.4s">
                Setiap detail diciptakan untuk mengesankan tamu Anda sejak detik pertama. <br>
                Bukan sekadar template, tapi karya seni cinta yang eksklusif.
            </p>
            
            <div class="cinematic-reveal flex flex-col md:flex-row items-center justify-center gap-8" style="animation-delay: 0.6s">
                @php
                    $waNumber = "6287896443386";
                    $heroMsg = rawurlencode("Halo ZipMoment, saya ingin membuat undangan yang membuat tamu saya berkata: 'ini mahal'.\n\nMohon info detail paket Luxury-nya.");
                    $waUrl = "https://wa.me/{$waNumber}?text={$heroMsg}";
                @endphp
                <a href="{{ $waUrl }}" target="_blank" class="w-full md:w-auto px-12 py-6 bg-amber-500 text-black font-black uppercase tracking-[0.2em] text-xs rounded-full hover:scale-110 hover:shadow-[0_0_40px_rgba(245,158,11,0.3)] transition-all duration-500 flex items-center justify-center group">
                    Start Your Luxury Story
                    <svg class="w-4 h-4 ml-3 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
                <a href="#pricing" class="w-full md:w-auto px-12 py-6 glass text-white font-black uppercase tracking-[0.2em] text-xs rounded-full hover:bg-white/10 transition-all duration-500">Explore Collection</a>
            </div>

            <!-- Enhanced Trust Bar -->
            <div class="cinematic-reveal mt-32 pt-16 border-t border-white/5 flex flex-wrap justify-center items-center gap-16 md:gap-24 opacity-30 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-1000" style="animation-delay: 0.8s">
                <div class="flex flex-col items-center">
                    <span class="text-4xl font-outfit font-black tracking-tighter mb-2">500+</span>
                    <span class="text-[9px] font-black uppercase tracking-[0.3em] text-amber-500/80">Premium Couples</span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="text-4xl font-outfit font-black tracking-tighter mb-2 italic">Excl.</span>
                    <span class="text-[9px] font-black uppercase tracking-[0.3em] text-amber-500/80">Boutique Service</span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="text-4xl font-outfit font-black tracking-tighter mb-2">Bali</span>
                    <span class="text-[9px] font-black uppercase tracking-[0.3em] text-amber-500/80">Jakarta & Beyond</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Differentiation Section -->
    <section id="features" class="py-40 relative bg-[#030303]">
        <div class="max-w-7xl mx-auto px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-32 items-center">
                <div class="space-y-12">
                    <div class="inline-block px-4 py-1 bg-amber-500/10 text-amber-500 border border-amber-500/20 rounded-full text-[10px] font-black uppercase tracking-[0.3em] mb-4">Why ZipMoment?</div>
                    <h2 class="text-5xl md:text-7xl font-serif italic font-black leading-tight tracking-tighter">Bukan Sekadar <br> <span class="text-white/20">Template Biasa.</span></h2>
                    <p class="text-xl text-white/40 font-outfit font-light leading-relaxed italic">"Undangan yang membuat tamu Anda berkata: ini mahal." Kami menciptakan karya seni digital yang menceritakan cinta Anda dengan cara yang paling eksklusif.</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div class="space-y-4 group">
                            <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center group-hover:bg-amber-500 transition-colors duration-500">
                                <svg class="w-6 h-6 text-amber-500 group-hover:text-black transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 002-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            </div>
                            <h4 class="font-outfit font-black uppercase text-xs tracking-widest text-white">Cinematic Motion</h4>
                            <p class="text-sm text-white/40 leading-relaxed font-light">Animasi transisi yang halus, memberikan kesan eksklusif sejak detik pertama dibuka.</p>
                        </div>
                        <div class="space-y-4 group">
                            <div class="w-12 h-12 rounded-2xl bg-white/5 flex items-center justify-center group-hover:bg-amber-500 transition-colors duration-500">
                                <svg class="w-6 h-6 text-amber-500 group-hover:text-black transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9H3m3.343-5.657l-.707-.707m2.828 9.9l-.707.707M6.343 17.657l-.707.707m9.9-9.9l-.707-.707M12 7a5 5 0 100 10 5 5 0 000-10z"></path></svg>
                            </div>
                            <h4 class="font-outfit font-black uppercase text-xs tracking-widest text-white">Luminous Details</h4>
                            <p class="text-sm text-white/40 leading-relaxed font-light">Setiap detail dibuat untuk mengesankan tamu Anda dengan standar estetika butik kelas atas.</p>
                        </div>
                    </div>
                </div>
                
                <div class="relative group">
                    <div class="absolute -inset-4 bg-amber-500/10 blur-[80px] rounded-full group-hover:bg-amber-500/20 transition-all duration-1000"></div>
                    <div class="relative glass p-4 rounded-[48px] overflow-hidden">
                        <div class="aspect-[4/5] overflow-hidden rounded-[36px] bg-black">
                             <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&w=1200&q=80" alt="Luxury Preview" class="w-full h-full object-cover scale-110 group-hover:scale-100 transition duration-[3s] opacity-70">
                             <div class="absolute inset-0 bg-gradient-to-t from-[#030303] via-transparent to-transparent opacity-80"></div>
                             <div class="absolute bottom-12 inset-x-8 text-center">
                                <span class="text-[9px] font-black tracking-[0.5em] text-amber-500 uppercase mb-4 block">Handcrafted Excellence</span>
                                <h3 class="text-3xl font-serif italic text-white mb-6 leading-tight">Membawa Undangan Tradisional Ke Level Studio Digital.</h3>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Experience Timeline -->
    <section class="py-40 relative">
        <div class="max-w-7xl mx-auto px-8">
            <div class="text-center mb-32">
                <span class="text-[9px] font-black uppercase tracking-[0.5em] text-amber-500 mb-6 block">Our Process</span>
                <h2 class="text-5xl font-serif italic font-black mb-8">The Experience Journey</h2>
                <p class="text-white/40 font-outfit font-light italic max-w-2xl mx-auto">Kami merancang setiap langkah untuk memastikan proses yang tenang dan hasil yang sempurna.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-12 relative">
                <!-- Timeline Line (Desktop) -->
                <div class="absolute top-1/2 left-0 w-full h-[1px] bg-white/5 -translate-y-1/2 hidden md:block"></div>
                
                <!-- Step 1 -->
                <div class="relative group text-center">
                    <div class="w-16 h-16 rounded-full glass border border-white/10 flex items-center justify-center mx-auto mb-8 bg-black group-hover:border-amber-500/50 transition-colors duration-700 relative z-10">
                        <span class="text-amber-500 font-serif italic text-xl">01</span>
                    </div>
                    <h4 class="text-xs font-black uppercase tracking-widest text-white mb-4">Konsultasi</h4>
                    <p class="text-[10px] text-white/40 leading-relaxed font-outfit px-4">Diskusi intim melalui WhatsApp untuk memahami visi Anda.</p>
                </div>

                <!-- Step 2 -->
                <div class="relative group text-center">
                    <div class="w-16 h-16 rounded-full glass border border-white/10 flex items-center justify-center mx-auto mb-8 bg-black group-hover:border-amber-500/50 transition-colors duration-700 relative z-10">
                        <span class="text-amber-500 font-serif italic text-xl">02</span>
                    </div>
                    <h4 class="text-xs font-black uppercase tracking-widest text-white mb-4">Kirim Detail</h4>
                    <p class="text-[10px] text-white/40 leading-relaxed font-outfit px-4">Lengkapi detail acara dan foto-foto moment terbaik Anda.</p>
                </div>

                <!-- Step 3 -->
                <div class="relative group text-center">
                    <div class="w-16 h-16 rounded-full glass border border-white/10 flex items-center justify-center mx-auto mb-8 bg-black group-hover:border-amber-500/50 transition-colors duration-700 relative z-10">
                        <span class="text-amber-500 font-serif italic text-xl">03</span>
                    </div>
                    <h4 class="text-xs font-black uppercase tracking-widest text-white mb-4">Proses Studio</h4>
                    <p class="text-[10px] text-white/40 leading-relaxed font-outfit px-4">Sentuhan kurasi studio kami bekerja dalam 1x24 jam.</p>
                </div>

                <!-- Step 4 -->
                <div class="relative group text-center">
                    <div class="w-16 h-16 rounded-full glass border border-white/10 flex items-center justify-center mx-auto mb-8 bg-black group-hover:border-amber-500/50 transition-colors duration-700 relative z-10">
                        <span class="text-amber-500 font-serif italic text-xl">04</span>
                    </div>
                    <h4 class="text-xs font-black uppercase tracking-widest text-white mb-4">Review & Revisi</h4>
                    <p class="text-[10px] text-white/40 leading-relaxed font-outfit px-4">Pastikan setiap detail sudah sesuai dengan keinginan Anda.</p>
                </div>

                <!-- Step 5 -->
                <div class="relative group text-center">
                    <div class="w-16 h-16 rounded-full glass border border-white/10 flex items-center justify-center mx-auto mb-8 bg-black group-hover:border-amber-500/50 transition-colors duration-700 relative z-10">
                        <span class="text-amber-500 font-serif italic text-xl">05</span>
                    </div>
                    <h4 class="text-xs font-black uppercase tracking-widest text-white mb-4">Siap Dibagikan</h4>
                    <p class="text-[10px] text-white/40 leading-relaxed font-outfit px-4">Undangan digital eksklusif Anda siap mengesankan tamu.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Template Showcase Section -->
    <section id="templates" class="py-40 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-8">
            <div class="text-center mb-24">
                <div class="inline-block px-4 py-1 glass text-white/40 border border-white/5 rounded-full text-[9px] font-black uppercase tracking-[0.4em] mb-6">Gallery Showcase</div>
                <h2 class="text-5xl md:text-7xl font-serif italic font-black tracking-tighter">Pilih Estetika <br> <span class="lux-gradient">Pernikahan Anda.</span></h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- Theme 1: Elegant -->
                <div class="group relative">
                    <div class="absolute -inset-2 bg-gradient-to-b from-amber-500/20 to-transparent blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                    <div class="relative glass rounded-[40px] overflow-hidden transition-all duration-700 group-hover:-translate-y-4">
                        <div class="aspect-[3/4] overflow-hidden relative">
                            <img src="https://images.unsplash.com/photo-1544124499-58912cbddaad?auto=format&fit=crop&w=800&q=80" alt="Elegant Theme" class="w-full h-full object-cover scale-110 group-hover:scale-125 transition-transform duration-[4s] opacity-60">
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
                            
                            <!-- Hover Overlay -->
                            <div class="absolute inset-0 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 backdrop-blur-sm bg-black/40">
                                <div class="w-20 h-20 rounded-full border border-white/20 flex items-center justify-center scale-50 group-hover:scale-100 transition-transform duration-700">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </div>
                                <span class="text-[10px] font-black uppercase tracking-[0.4em] text-white mt-4">View Cinematic Demo</span>
                            </div>
                        </div>
                        <div class="p-10 text-center">
                            <span class="text-[8px] font-black tracking-[0.5em] text-amber-500 uppercase mb-2 block">Premium Tier</span>
                            <h3 class="text-2xl font-serif italic text-white">The Elegant Noir</h3>
                            <div class="mt-6 flex items-center justify-center space-x-2 text-white/20">
                                <span class="h-[1px] w-8 bg-current"></span>
                                <span class="text-[8px] font-black uppercase tracking-widest">Minimalist Luxury</span>
                                <span class="h-[1px] w-8 bg-current"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Theme 2: Modern -->
                <div class="group relative">
                    <div class="absolute -inset-2 bg-gradient-to-b from-indigo-500/20 to-transparent blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                    <div class="relative glass rounded-[40px] overflow-hidden transition-all duration-700 group-hover:-translate-y-4">
                        <div class="aspect-[3/4] overflow-hidden relative">
                            <img src="https://images.unsplash.com/photo-1549416878-b9ca35c2d47b?auto=format&fit=crop&w=800&q=80" alt="Modern Theme" class="w-full h-full object-cover scale-110 group-hover:scale-125 transition-transform duration-[4s] opacity-60">
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
                            
                            <!-- Hover Overlay -->
                            <div class="absolute inset-0 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 backdrop-blur-sm bg-black/40">
                                <div class="w-20 h-20 rounded-full border border-white/20 flex items-center justify-center scale-50 group-hover:scale-100 transition-transform duration-700">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </div>
                                <span class="text-[10px] font-black uppercase tracking-[0.4em] text-white mt-4">View Cinematic Demo</span>
                            </div>
                        </div>
                        <div class="p-10 text-center">
                            <span class="text-[8px] font-black tracking-[0.5em] text-indigo-400 uppercase mb-2 block">Exclusive Tier</span>
                            <h3 class="text-2xl font-serif italic text-white">Modern Majestic</h3>
                            <div class="mt-6 flex items-center justify-center space-x-2 text-white/20">
                                <span class="h-[1px] w-8 bg-current"></span>
                                <span class="text-[8px] font-black uppercase tracking-widest">Avant Garde</span>
                                <span class="h-[1px] w-8 bg-current"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Theme 3: Floral -->
                <div class="group relative">
                    <div class="absolute -inset-2 bg-gradient-to-b from-rose-500/20 to-transparent blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                    <div class="relative glass rounded-[40px] overflow-hidden transition-all duration-700 group-hover:-translate-y-4">
                        <div class="aspect-[3/4] overflow-hidden relative">
                            <img src="https://images.unsplash.com/photo-1522673607200-164883eeca48?auto=format&fit=crop&w=800&q=80" alt="Floral Theme" class="w-full h-full object-cover scale-110 group-hover:scale-125 transition-transform duration-[4s] opacity-60">
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
                            
                            <!-- Hover Overlay -->
                            <div class="absolute inset-0 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 backdrop-blur-sm bg-black/40">
                                <div class="w-20 h-20 rounded-full border border-white/20 flex items-center justify-center scale-50 group-hover:scale-100 transition-transform duration-700">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </div>
                                <span class="text-[10px] font-black uppercase tracking-[0.4em] text-white mt-4">View Cinematic Demo</span>
                            </div>
                        </div>
                        <div class="p-10 text-center">
                            <span class="text-[8px] font-black tracking-[0.5em] text-rose-400 uppercase mb-2 block">Signature Tier</span>
                            <h3 class="text-2xl font-serif italic text-white">Floral Romantisme</h3>
                            <div class="mt-6 flex items-center justify-center space-x-2 text-white/20">
                                <span class="h-[1px] w-8 bg-current"></span>
                                <span class="text-[8px] font-black uppercase tracking-widest">Timeless Beauty</span>
                                <span class="h-[1px] w-8 bg-current"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- EmotionalSELL -->
            <div class="mt-40 text-center max-w-4xl mx-auto">
                <p class="text-2xl md:text-3xl font-serif italic text-white/80 leading-relaxed">
                    "Setiap desain adalah pernyataan posisi Anda. Berikan kesan yang tidak akan pernah dilupakan tamu Anda sejak detik pertama mereka membuka undangan."
                </p>
                <div class="mt-10 flex flex-col items-center">
                    <div class="h-12 w-[1px] bg-amber-500/40"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Strong Trust Section -->
    <section id="experience" class="py-40 relative bg-[#050505]">
        <div class="max-w-7xl mx-auto px-8">
            <!-- Behind the Studio Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-32 items-center mb-60 pt-20">
                <div class="relative scroll-reveal px-4 lg:px-0">
                    <div class="absolute -inset-20 bg-amber-500/5 blur-[120px] rounded-full"></div>
                    <div class="inline-block px-4 py-1 bg-white/5 border border-white/10 rounded-full text-[9px] font-black uppercase tracking-[0.4em] mb-8 text-white/40">Behind The Studio</div>
                    <h2 class="text-5xl md:text-6xl font-serif italic font-black mb-10 tracking-tighter leading-[1.1]">The Heart of <br><span class="lux-gradient">Creative Craftsmanship.</span></h2>
                    <p class="text-lg text-white/60 font-outfit font-light leading-relaxed mb-10 italic">
                        "ZipMoment lahir dari keinginan menghadirkan undangan digital yang terasa elegan dan berkesan. Kami percaya bahwa setiap detail kecil adalah doa, dan setiap pixel adalah penghormatan bagi hari bahagia Anda."
                    </p>
                    <div class="flex items-center space-x-12">
                        <div>
                            <span class="block text-2xl font-serif italic text-white mb-1">Authentic</span>
                            <span class="text-[10px] font-black uppercase tracking-widest text-white/20">Boutique Service</span>
                        </div>
                        <div>
                            <span class="block text-2xl font-serif italic text-white mb-1">Curated</span>
                            <span class="text-[10px] font-black uppercase tracking-widest text-white/20">Intentional Design</span>
                        </div>
                    </div>
                </div>
                <div class="relative group">
                    <div class="absolute -inset-2 bg-gradient-to-r from-amber-500/20 to-transparent blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-1000"></div>
                    <div class="relative glass rounded-[60px] overflow-hidden aspect-[4/5] lg:aspect-square">
                        <img src="https://images.unsplash.com/photo-1497215728101-856f4ea42174?auto=format&fit=crop&w=1200&q=80" alt="Studio Workspace" class="w-full h-full object-cover scale-110 group-hover:scale-100 transition-transform duration-[3s] opacity-40 group-hover:opacity-60 grayscale hover:grayscale-0">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
                    </div>
                </div>
            </div>
            <div class="text-center mb-24">
                <div class="inline-block px-4 py-1 bg-white/5 border border-white/10 rounded-full text-[9px] font-black uppercase tracking-[0.4em] text-white/40 mb-6">Trusted by 500+ Couples</div>
                <h2 class="text-5xl md:text-7xl font-serif italic font-black tracking-tighter mb-8">Eksklusivitas Yang Diakui Di<br> <span class="lux-gradient">Seluruh Indonesia.</span></h2>
                <div class="flex flex-wrap justify-center gap-6 text-[10px] font-black uppercase tracking-widest text-white/30">
                    <span class="hover:text-amber-500 transition-colors">Jakarta</span>
                    <span class="opacity-20">•</span>
                    <span class="hover:text-amber-500 transition-colors">Bandung</span>
                    <span class="opacity-20">•</span>
                    <span class="hover:text-amber-500 transition-colors">Surabaya</span>
                    <span class="opacity-20">•</span>
                    <span class="hover:text-amber-500 transition-colors">Bali</span>
                    <span class="opacity-20">•</span>
                    <span class="hover:text-amber-500 transition-colors">Medan</span>
                </div>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-32">
                <div class="group relative aspect-square overflow-hidden rounded-[40px] glass">
                    <img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=600&q=80" alt="Client Gallery" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-[2s] scale-110 group-hover:scale-100 opacity-40 group-hover:opacity-100">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-60"></div>
                    <div class="absolute bottom-6 left-6 opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="text-[8px] font-black uppercase tracking-widest text-white">Aditya & Siska — JAKARTA</span>
                    </div>
                </div>
                <div class="group relative aspect-square overflow-hidden rounded-[40px] glass md:translate-y-12">
                    <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&w=600&q=80" alt="Client Gallery" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-[2s] scale-110 group-hover:scale-100 opacity-40 group-hover:opacity-100">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-60"></div>
                    <div class="absolute bottom-6 left-6 opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="text-[8px] font-black uppercase tracking-widest text-white">Reza & Indah — BALI</span>
                    </div>
                </div>
                <div class="group relative aspect-square overflow-hidden rounded-[40px] glass">
                    <img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&w=600&q=80" alt="Client Gallery" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-[2s] scale-110 group-hover:scale-100 opacity-40 group-hover:opacity-100">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-60"></div>
                    <div class="absolute bottom-6 left-6 opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="text-[8px] font-black uppercase tracking-widest text-white">Dimas & Rara — BANDUNG</span>
                    </div>
                </div>
                <div class="group relative aspect-square overflow-hidden rounded-[40px] glass md:translate-y-12">
                    <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?auto=format&fit=crop&w=600&q=80" alt="Client Gallery" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-[2s] scale-110 group-hover:scale-100 opacity-40 group-hover:opacity-100">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-60"></div>
                    <div class="absolute bottom-6 left-6 opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="text-[8px] font-black uppercase tracking-widest text-white">Kevin & Nadya — SURABAYA</span>
                    </div>
                </div>
            </div>

            <div class="mt-40 grid grid-cols-1 lg:grid-cols-3 gap-12">
                <div class="glass p-12 rounded-[50px] space-y-8 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-8 opacity-5 group-hover:opacity-10 transition-opacity">
                        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H16.017C14.9124 8 14.017 7.10457 14.017 6V5C14.017 3.34315 15.3602 2 17.017 2H18.017C18.5693 2 19.017 2.44772 19.017 3V4C19.017 4.55228 18.5693 5 18.017 5H17.017C16.4647 5 16.017 5.44772 16.017 6V8H19.017C20.6739 8 22.017 9.34315 22.017 11V15C22.017 16.6569 20.6739 18 19.017 18H16.017L16.017 21H14.017ZM2.017 21L2.017 18C2.017 16.8954 2.91243 16 4.017 16H7.017C7.56928 16 8.017 15.5523 8.017 15V9C8.017 8.44772 7.56928 8 7.017 8H4.017C2.91243 8 2.017 7.10457 2.017 6V5C2.017 3.34315 3.36015 2 5.017 2H6.017C6.56928 2 7.017 2.44772 7.017 3V4C7.017 4.55228 6.56928 5 6.017 5H5.017C4.46472 5 4.017 5.44772 4.017 6V8H7.017C8.67385 8 10.017 9.34315 10.017 11V15C10.017 16.6569 8.67385 18 7.017 18H4.017L4.017 21H2.017Z"/></svg>
                    </div>
                    <div class="flex text-amber-500">
                        @for($i=0; $i<5; $i++)<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>@endfor
                    </div>
                    <p class="text-xl font-serif italic text-white/80 leading-relaxed">"Undangannya benar-benar mahal sekali kelihatannya. Tamu-tamu saya pada tanya bikin di mana. Benar-benar eksklusif!"</p>
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 rounded-full bg-white/10"></div>
                        <div>
                            <span class="text-[10px] font-black uppercase tracking-widest block">Amanda & Rizky</span>
                            <span class="text-[8px] font-medium text-white/20 uppercase tracking-widest">Wedding 2024</span>
                        </div>
                    </div>
                </div>
                <div class="glass p-12 rounded-[50px] space-y-8 relative overflow-hidden group lg:translate-y-8">
                    <div class="absolute top-0 right-0 p-8 opacity-5 group-hover:opacity-10 transition-opacity">
                        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H16.017C14.9124 8 14.017 7.10457 14.017 6V5C14.017 3.34315 15.3602 2 17.017 2H18.017C18.5693 2 19.017 2.44772 19.017 3V4C19.017 4.55228 18.5693 5 18.017 5H17.017C16.4647 5 16.017 5.44772 16.017 6V8H19.017C20.6739 8 22.017 9.34315 22.017 11V15C22.017 16.6569 20.6739 18 19.017 18H16.017L16.017 21H14.017ZM2.017 21L2.017 18C2.017 16.8954 2.91243 16 4.017 16H7.017C7.56928 16 8.017 15.5523 8.017 15V9C8.017 8.44772 7.56928 8 7.017 8H4.017C2.91243 8 2.017 7.10457 2.017 6V5C2.017 3.34315 3.36015 2 5.017 2H6.017C6.56928 2 7.017 2.44772 7.017 3V4C7.017 4.55228 6.56928 5 6.017 5H5.017C4.46472 5 4.017 5.44772 4.017 6V8H7.017C8.67385 8 10.017 9.34315 10.017 11V15C10.017 16.6569 8.67385 18 7.017 18H4.017L4.017 21H2.017Z"/></svg>
                    </div>
                    <div class="flex text-amber-500">
                        @for($i=0; $i<5; $i++)<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>@endfor
                    </div>
                    <p class="text-xl font-serif italic text-white/80 leading-relaxed">"Satu kata: Cinematic. Transisinya sekelas butik undangan internasional. Best investment for our wedding!"</p>
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 rounded-full bg-white/10"></div>
                        <div>
                            <span class="text-[10px] font-black uppercase tracking-widest block">Bima & Citra</span>
                            <span class="text-[8px] font-medium text-white/20 uppercase tracking-widest">Wedding 2024</span>
                        </div>
                    </div>
                </div>
                <div class="glass p-12 rounded-[50px] space-y-8 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-8 opacity-5 group-hover:opacity-10 transition-opacity">
                        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H16.017C14.9124 8 14.017 7.10457 14.017 6V5C14.017 3.34315 15.3602 2 17.017 2H18.017C18.5693 2 19.017 2.44772 19.017 3V4C19.017 4.55228 18.5693 5 18.017 5H17.017C16.4647 5 16.017 5.44772 16.017 6V8H19.017C20.6739 8 22.017 9.34315 22.017 11V15C22.017 16.6569 20.6739 18 19.017 18H16.017L16.017 21H14.017ZM2.017 21L2.017 18C2.017 16.8954 2.91243 16 4.017 16H7.017C7.56928 16 8.017 15.5523 8.017 15V9C8.017 8.44772 7.56928 8 7.017 8H4.017C2.91243 8 2.017 7.10457 2.017 6V5C2.017 3.34315 3.36015 2 5.017 2H6.017C6.56928 2 7.017 2.44772 7.017 3V4C7.017 4.55228 6.56928 5 6.017 5H5.017C4.46472 5 4.017 5.44772 4.017 6V8H7.017C8.67385 8 10.017 9.34315 10.017 11V15C10.017 16.6569 8.67385 18 7.017 18H4.017L4.017 21H2.017Z"/></svg>
                    </div>
                    <div class="flex text-amber-500">
                        @for($i=0; $i<5; $i++)<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>@endfor
                    </div>
                    <p class="text-xl font-serif italic text-white/80 leading-relaxed">"Tidak sangka harga segini bisa dapat kualitas se-premium ini. ZipMoment benar-benar game changer!"</p>
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 rounded-full bg-white/10"></div>
                        <div>
                            <span class="text-[10px] font-black uppercase tracking-widest block">Reno & Vania</span>
                            <span class="text-[8px] font-medium text-white/20 uppercase tracking-widest">Wedding 2024</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-40 relative">
        <div class="max-w-7xl mx-auto px-8">
            <div class="text-center mb-32">
                <div class="inline-block px-4 py-1 bg-amber-500/10 text-amber-500 border border-amber-500/20 rounded-full text-[9px] font-black uppercase tracking-[0.4em] mb-6">Investment Packages</div>
                <h2 class="text-5xl md:text-7xl font-serif italic font-black mb-8 tracking-tighter">Investasi Untuk<br> <span class="lux-gradient">Moment Tak Terlupakan.</span></h2>
                <div class="flex flex-col items-center space-y-4">
                    <p class="text-xl text-white/40 font-outfit font-light italic">"Hanya untuk mereka yang menginginkan kesempurnaan di setiap pixel."</p>
                    <div class="flex items-center space-x-3 text-[10px] uppercase tracking-[0.3em] text-amber-500/60 font-black">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                        <span>Kami menerima jumlah pasangan terbatas setiap minggu untuk menjaga kualitas.</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 items-stretch">
                @php
                    function waLink($package, $price, $number) {
                        $msg = "Halo ZipMoment, saya ingin membuat undangan yang membuat tamu saya terkesan.\n\nSaya tertarik dengan paket: {$package}\n\nMohon bantu saya mewujudkan pernikahan impian.";
                        return "https://wa.me/{$number}?text=" . rawurlencode($msg);
                    }
                @endphp
                <!-- Package 1: Basic -->
                <div class="flex flex-col p-12 rounded-[50px] glass hover:bg-white/[0.05] transition-all duration-700 group relative overflow-hidden">
                    <div class="mb-12 text-center">
                        <span class="text-[9px] font-black uppercase tracking-[0.5em] text-white/30 mb-4 block">THE ESSENTIAL</span>
                        <h3 class="text-3xl font-serif italic font-bold mb-6 tracking-tighter">Standard</h3>
                        <div class="flex flex-col items-center">
                            <span class="text-xs text-white/10 line-through mb-2 tracking-widest">IDR 69,000</span>
                            <div class="flex items-baseline justify-center">
                                <span class="text-5xl font-outfit font-black tracking-tighter italic">49<span class="text-lg font-light ml-1 opacity-40">k</span></span>
                            </div>
                        </div>
                    </div>
                    
                    <ul class="space-y-6 mb-16 flex-1 text-[11px] font-outfit font-light tracking-wide text-white/60">
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mr-4 text-amber-500/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Selection of Standard Theme
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mr-4 text-amber-500/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Ambient Music Player
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mr-4 text-amber-500/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Event Details & Maps
                        </li>
                        <li class="flex items-center opacity-30 italic">
                            <svg class="w-4 h-4 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            Watermark Included
                        </li>
                    </ul>

                    <a href="{{ waLink('Standard', '49k', $waNumber) }}" target="_blank" class="w-full py-5 text-center glass border-white/10 font-black uppercase text-[10px] tracking-[0.3em] rounded-2xl hover:bg-white/10 transition-all duration-500">Pesan Essential</a>
                </div>

                <!-- Package 2: Premium (Signature) -->
                <div class="flex flex-col p-12 rounded-[50px] border-2 border-amber-500/30 bg-gradient-to-br from-amber-500/[0.08] to-transparent hover:from-amber-500/[0.12] transition-all duration-700 group relative md:scale-110 shadow-[0_0_100px_rgba(251,191,36,0.05)] overflow-hidden">
                    <div class="absolute top-0 right-12 py-3 px-8 bg-amber-500 text-black text-[9px] font-black uppercase tracking-[0.4em] rounded-b-3xl">Most Preferred</div>
                    
                    <div class="mb-12 text-center">
                        <span class="text-[9px] font-black uppercase tracking-[0.5em] text-amber-500 mb-4 block">THE EXCLUSIVE</span>
                        <h3 class="text-4xl font-serif italic font-black mb-6 tracking-tighter text-amber-100 italic">Signature</h3>
                        <div class="flex flex-col items-center">
                            <span class="text-xs text-amber-500/20 line-through mb-2 tracking-widest">IDR 149,000</span>
                            <div class="flex items-baseline justify-center">
                                <span class="text-7xl font-outfit font-black tracking-tighter text-amber-500 italic leading-none">99<span class="text-2xl font-light ml-1 opacity-40">k</span></span>
                            </div>
                        </div>
                    </div>
                    
                    <ul class="space-y-6 mb-16 flex-1 text-[12px] font-outfit font-medium tracking-wide text-white/80">
                        <li class="flex items-center text-amber-400">
                            <svg class="w-5 h-5 mr-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            Unlock All Premium Themes
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Unlimited Photo Gallery
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Interactive RSVP Studio
                        </li>
                        <li class="flex items-center text-amber-300 font-black italic tracking-widest">
                            <svg class="w-5 h-5 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            NO WATERMARK
                        </li>
                    </ul>

                    <a href="{{ waLink('Signature', '99k', $waNumber) }}" target="_blank" class="w-full py-6 text-center bg-amber-500 text-black font-black uppercase text-xs tracking-[0.3em] rounded-2xl hover:scale-105 transition-all duration-500 shadow-2xl shadow-amber-500/20">Claim Signature Promo</a>
                </div>

                <!-- Package 3: Exclusive -->
                <div class="flex flex-col p-12 rounded-[50px] glass hover:bg-white/[0.05] transition-all duration-700 group relative overflow-hidden">
                    <div class="mb-12 text-center">
                        <span class="text-[9px] font-black uppercase tracking-[0.5em] text-indigo-400 mb-4 block">THE MAJESTY</span>
                        <h3 class="text-3xl font-serif italic font-bold mb-6 tracking-tighter">Majesty Kit</h3>
                        <div class="flex flex-col items-center">
                            <span class="text-xs text-indigo-500/20 line-through mb-2 tracking-widest">IDR 299,000</span>
                            <div class="flex items-baseline justify-center">
                                <span class="text-5xl font-outfit font-black tracking-tighter italic">249<span class="text-lg font-light ml-1 opacity-40">k</span></span>
                            </div>
                        </div>
                    </div>
                    
                    <ul class="space-y-6 mb-16 flex-1 text-[11px] font-outfit font-light tracking-wide text-white/60">
                        <li class="flex items-center text-indigo-100 font-black">
                            <svg class="w-4 h-4 mr-4 text-indigo-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
                            CUSTOM DOMAIN (.com)
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mr-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            VIP Cinematic Animations
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mr-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Concierge Design Support
                        </li>
                    </ul>

                    <a href="{{ waLink('Majesty', '249k', $waNumber) }}" target="_blank" class="w-full py-5 text-center border border-indigo-500/20 text-indigo-300 font-black uppercase text-[10px] tracking-[0.3em] rounded-2xl hover:bg-indigo-500/10 transition-all duration-500">Acquire Majesty</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Floating WhatsApp Button -->
    <a href="{{ $waUrl }}" target="_blank" class="fixed bottom-12 right-12 z-[100] group">
        <div class="absolute inset-0 bg-amber-500 blur-2xl opacity-20 group-hover:opacity-60 transition-opacity animate-pulse"></div>
        <div class="relative glass bg-amber-500/10 backdrop-blur-xl border border-white/10 p-2 rounded-full shadow-2xl flex items-center space-x-4 pr-8 group-hover:scale-110 transition-transform duration-500">
            <div class="w-12 h-12 bg-amber-500 text-black rounded-full flex items-center justify-center shadow-lg">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.412 0 6.556-5.338 11.892-11.893 11.892-1.997-.001-3.951-.5-5.688-1.448l-6.309 1.656zm6.224-3.82l.448.265c1.416.84 3.057 1.285 4.725 1.285h.005c5.454 0 9.895-4.442 9.897-9.896 0-2.642-1.029-5.125-2.897-6.994s-4.352-2.896-6.991-2.896c-5.455 0-9.896 4.442-9.898 9.897 0 1.748.463 3.453 1.336 4.956l.29.499-1.002 3.661 3.748-.983zm11.554-7.051c-.244-.123-1.442-.711-1.666-.793-.223-.082-.387-.123-.55.123s-.631.793-.773.955-.285.184-.528.062c-.243-.123-1.026-.379-1.954-1.206-.721-.643-1.209-1.437-1.351-1.682-.141-.245-.015-.377.108-.499.11-.11.243-.285.365-.428.122-.142.162-.245.243-.408.081-.163.041-.306-.021-.428s-.55-1.326-.753-1.815c-.198-.478-.399-.413-.55-.421-.143-.008-.306-.008-.469-.008s-.428.061-.652.306c-.224.245-.856.836-.856 2.04s.876 2.365.998 2.529c.122.163 1.725 2.636 4.177 3.692.584.251 1.04.402 1.396.515.586.186 1.119.16 1.54.098.47-.069 1.442-.589 1.646-1.159.204-.571.204-1.061.142-1.163s-.224-.163-.467-.285z"/></svg>
            </div>
            <div class="flex flex-col">
                <span class="text-[8px] font-black uppercase tracking-[0.3em] text-white/40">Consultation</span>
                <span class="text-[10px] font-black uppercase tracking-[0.1em] text-amber-500">Concierge Service</span>
            </div>
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
