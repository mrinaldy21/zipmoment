<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Invitation') }}
        </h2>
        @if(session('error'))
            <div class="mt-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                {{ session('error') }}
            </div>
        @endif
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($errors->any())
                        <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                <h3 class="text-sm font-bold text-red-800 uppercase tracking-wider">Perhatian: Mohon perbaiki kesalahan berikut</h3>
                            </div>
                            <ul class="list-disc list-inside text-xs text-red-700 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{ route('admin.invitations.update', $invitation->id) }}" method="POST" enctype="multipart/form-data" class="space-y-12">
                        @csrf
                        @method('PUT')

                        <!-- Section: Business & Package Settings (SaaS Mode) -->
                        <div class="bg-gradient-to-br from-indigo-900 to-slate-900 rounded-3xl p-8 mb-12 shadow-2xl border border-indigo-700/50 relative overflow-hidden group">
                            <div class="absolute top-0 right-0 p-8 opacity-10 group-hover:opacity-20 transition-opacity">
                                <svg class="w-48 h-48 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                            </div>
                            
                            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
                                <div class="space-y-2">
                                    <div class="inline-flex items-center px-3 py-1 bg-indigo-500/20 rounded-full text-indigo-300 text-[10px] font-black uppercase tracking-widest border border-indigo-500/30">
                                        Admin Owner Mode
                                    </div>
                                    <h3 class="text-3xl font-black text-white tracking-tight">Business Settings</h3>
                                    <p class="text-indigo-200/60 text-sm font-medium max-w-sm">Manage invitation package tiers, domain settings, and branding visibility.</p>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full md:w-auto">
                                    <!-- Basic Package -->
                                    <label class="package-card relative cursor-pointer group">
                                        <input type="radio" name="package_type" value="basic" class="peer sr-only" {{ $invitation->package_type == 'basic' ? 'checked' : '' }} onchange="updateTemplateAccess()">
                                        <div class="h-full p-5 rounded-2xl border-2 border-slate-700 bg-slate-800/40 peer-checked:border-white peer-checked:bg-slate-700/60 peer-checked:ring-4 peer-checked:ring-white/10 peer-checked:ring-offset-2 peer-checked:ring-offset-slate-900 peer-checked:scale-[1.03] peer-checked:shadow-[0_0_20px_rgba(255,255,255,0.15)] transition-all duration-300 hover:border-slate-500 relative overflow-hidden">
                                            <div class="selected-badge hidden absolute top-2 left-2 text-[10px] bg-yellow-400 text-black px-2 py-1 rounded-full font-bold">
                                                ACTIVE
                                            </div>
                                            <div class="flex flex-col items-center text-center space-y-2 relative z-10">
                                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest peer-checked:text-white">BASIC</span>
                                                <p class="text-xl font-black text-slate-200 peer-checked:text-white">ENTRY</p>
                                                
                                                <!-- Selected Indicator -->
                                                <div class="hidden peer-checked:flex items-center space-x-1 mt-2 px-2 py-0.5 bg-white/20 rounded-full border border-white/30">
                                                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                                    <span class="text-[9px] font-bold text-white uppercase tracking-tighter">Selected</span>
                                                </div>
                                            </div>
                                            <!-- Subtle Decor -->
                                            <div class="absolute -bottom-4 -right-4 w-16 h-16 bg-white/5 rounded-full blur-xl group-hover:scale-150 transition-transform"></div>
                                        </div>
                                    </label>

                                    <!-- Premium Package -->
                                    <label class="package-card relative cursor-pointer group">
                                        <input type="radio" name="package_type" value="premium" class="peer sr-only" {{ $invitation->package_type == 'premium' ? 'checked' : '' }} onchange="updateTemplateAccess()">
                                        <div class="h-full p-5 rounded-2xl border-2 border-amber-900/50 bg-amber-900/20 peer-checked:border-amber-400 peer-checked:bg-amber-900/40 peer-checked:ring-4 peer-checked:ring-amber-500/20 peer-checked:ring-offset-2 peer-checked:ring-offset-slate-900 peer-checked:scale-[1.03] peer-checked:shadow-[0_0_25px_rgba(251,191,36,0.25)] transition-all duration-300 hover:border-amber-500/50 relative overflow-hidden">
                                             <div class="selected-badge hidden absolute top-2 left-2 text-[10px] bg-yellow-400 text-black px-2 py-1 rounded-full font-bold">
                                                ACTIVE
                                            </div>
                                            <div class="flex flex-col items-center text-center space-y-2 relative z-10">
                                                <span class="text-[10px] font-black text-amber-500/70 uppercase tracking-widest peer-checked:text-amber-400">PREMIUM</span>
                                                <p class="text-xl font-black text-amber-100 peer-checked:text-white">PRO TIER</p>
                                                
                                                <!-- Selected Indicator -->
                                                <div class="hidden peer-checked:flex items-center space-x-1 mt-2 px-2 py-0.5 bg-amber-500/20 rounded-full border border-amber-500/30">
                                                    <svg class="w-3 h-3 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                                    <span class="text-[9px] font-bold text-amber-400 uppercase tracking-tighter">Selected</span>
                                                </div>
                                            </div>
                                            <!-- Subtle Decor -->
                                            <div class="absolute -bottom-4 -right-4 w-20 h-20 bg-amber-500/10 rounded-full blur-xl group-hover:scale-150 transition-transform"></div>
                                        </div>
                                    </label>

                                    <!-- Exclusive Package -->
                                    <label class="package-card relative cursor-pointer group">
                                        <input type="radio" name="package_type" value="exclusive" class="peer sr-only" {{ $invitation->package_type == 'exclusive' ? 'checked' : '' }} onchange="updateTemplateAccess()">
                                        <div class="h-full p-5 rounded-2xl border-2 border-indigo-900/50 bg-indigo-900/20 peer-checked:border-indigo-400 peer-checked:bg-indigo-900/40 peer-checked:ring-4 peer-checked:ring-indigo-500/20 peer-checked:ring-offset-2 peer-checked:ring-offset-slate-900 peer-checked:scale-[1.03] peer-checked:shadow-[0_0_25px_rgba(129,140,248,0.25)] transition-all duration-300 hover:border-indigo-500/50 relative overflow-hidden">
                                            <div class="selected-badge hidden absolute top-2 left-2 text-[10px] bg-yellow-400 text-black px-2 py-1 rounded-full font-bold">
                                                ACTIVE
                                            </div>
                                            <div class="flex flex-col items-center text-center space-y-2 relative z-10">
                                                <span class="text-[10px] font-black text-indigo-400/70 uppercase tracking-widest peer-checked:text-indigo-300">EXCLUSIVE</span>
                                                <p class="text-xl font-black text-white peer-checked:text-white tracking-widest">ELITE</p>
                                                
                                                <!-- Selected Indicator -->
                                                <div class="hidden peer-checked:flex items-center space-x-1 mt-2 px-2 py-0.5 bg-indigo-500/20 rounded-full border border-indigo-500/30">
                                                    <svg class="w-3 h-3 text-indigo-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                                    <span class="text-[9px] font-bold text-indigo-300 uppercase tracking-tighter">Selected</span>
                                                </div>
                                            </div>
                                            <!-- Subtle Decor -->
                                            <div class="absolute -bottom-4 -right-4 w-20 h-20 bg-indigo-500/10 rounded-full blur-xl group-hover:scale-150 transition-transform"></div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div class="mt-8 pt-8 border-t border-white/5 grid grid-cols-1 md:grid-cols-3 gap-8">
                                <div class="space-y-3">
                                    <label class="block text-[10px] font-black text-indigo-300 uppercase tracking-widest">Watermark Branding</label>
                                    <div class="flex items-center space-x-4">
                                        <select name="is_watermark_enabled" class="bg-slate-800 text-white border-slate-700 rounded-xl text-xs focus:ring-indigo-500 w-full p-3 font-bold">
                                            <option value="1" {{ $invitation->is_watermark_enabled ? 'selected' : '' }}>Show "Created with ZipMoment"</option>
                                            <option value="0" {{ !$invitation->is_watermark_enabled ? 'selected' : '' }}>HIDE Branding (Premium Only)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <label class="block text-[10px] font-black text-indigo-300 uppercase tracking-widest">Custom Domain / Subdomain</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg class="w-3 h-3 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                                        </div>
                                        <input type="text" name="custom_domain" value="{{ old('custom_domain', $invitation->custom_domain) }}" placeholder="namapengantin.com" class="bg-slate-800 text-white border-slate-700 rounded-xl text-xs focus:ring-indigo-500 w-full pl-8 p-3 placeholder:text-slate-600 font-mono">
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <label class="block text-[10px] font-black text-indigo-300 uppercase tracking-widest">Gallery Photo Limit</label>
                                    <input type="number" name="gallery_limit" value="{{ old('gallery_limit', $invitation->gallery_limit) }}" class="bg-slate-800 text-white border-slate-700 rounded-xl text-xs focus:ring-indigo-500 w-full p-3 font-bold">
                                </div>
                            </div>
                        </div>

                        <!-- Section: Basic Info -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-bold text-indigo-600 border-b pb-2 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Basic Information
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Invitation Title</label>
                                    <input type="text" name="title" value="{{ old('title', $invitation->title) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                </div>
                                <div>
                                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Assign to Client</label>
                                    <select name="user_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        @foreach($clients as $client)
                                            <option value="{{ $client->id }}" {{ old('user_id', $invitation->user_id) == $client->id ? 'selected' : '' }}>
                                                {{ $client->name }} ({{ $client->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-span-1 md:col-span-2">
                                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-4 tracking-tight">Design Template Selection</label>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <!-- Elegant Card (Always Unlocked) -->
                                        <label class="relative cursor-pointer group" id="template-card-elegant">
                                            <input type="radio" name="template" value="elegant" class="peer sr-only" {{ old('template', $invitation->template) == 'elegant' ? 'checked' : '' }}>
                                            <div class="template-box overflow-hidden rounded-2xl border-2 border-gray-100 bg-white relative ...">
                                                <!-- ACTIVE BADGE -->
                                                <div class="template-active hidden absolute top-2 left-2 text-[10px] bg-indigo-600 text-white px-2 py-1 rounded-full font-bold z-20">
                                                    ACTIVE
                                                </div>  
                                                <div class="h-24 bg-gradient-to-r from-amber-50 to-orange-50 flex items-center justify-center relative overflow-hidden">
                                                    <span class="text-amber-600 font-serif text-2xl italic tracking-tighter">Elegant</span>
                                                </div>
                                                <div class="p-4 flex items-center justify-between">
                                                    <span class="text-xs font-bold text-gray-700">Elegant Gold</span>
                                                    <span class="text-[9px] px-2 py-0.5 bg-gray-100 text-gray-500 rounded-full font-black uppercase">Standard</span>
                                                </div>
                                            </div>
                                        </label>

                                        <!-- Floral Card (Premium/Exclusive) -->
                                        <label class="relative cursor-pointer group" id="template-card-floral">
                                            <input type="radio" name="template" value="floral" class="peer sr-only" {{ old('template', $invitation->template) == 'floral' ? 'checked' : '' }}>
                                             <div class="template-box overflow-hidden rounded-2xl border-2 border-gray-100 bg-white relative ...">
                                                <!-- ACTIVE BADGE -->
                                                <div class="template-active hidden absolute top-2 left-2 text-[10px] bg-indigo-600 text-white px-2 py-1 rounded-full font-bold z-20">
                                                    ACTIVE
                                                </div>  
                                                <div class="h-24 bg-gradient-to-r from-pink-50 to-rose-50 flex items-center justify-center relative overflow-hidden">
                                                    <span class="text-rose-600 font-serif text-2xl italic tracking-tighter">Floral</span>
                                                </div>
                                                <div class="p-4 flex items-center justify-between">
                                                    <span class="text-xs font-bold text-gray-700">Floral Romance</span>
                                                    <span class="text-[9px] px-2 py-0.5 bg-amber-100 text-amber-700 rounded-full font-black uppercase flex items-center">
                                                        <svg class="w-2 h-2 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                                        Premium
                                                    </span>
                                                </div>
                                                <!-- Overlay Lock -->
                                                <div class="lock-overlay absolute inset-0 bg-white/60 flex flex-col items-center justify-center backdrop-blur-[1px] opacity-0 pointer-events-none transition-opacity">
                                                    <svg class="w-8 h-8 text-rose-300" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2V7a5 5 0 00-5-5zM7 7a3 3 0 016 0v2H7V7z"/></svg>
                                                    <span class="text-[8px] font-black uppercase text-rose-400 mt-2 tracking-widest">Premium Only</span>
                                                </div>
                                            </div>
                                        </label>

                                        <!-- Modern Card (Exclusive) -->
                                        <label class="relative cursor-pointer group" id="template-card-modern">
                                            <input type="radio" name="template" value="modern" class="peer sr-only" {{ old('template', $invitation->template) == 'modern' ? 'checked' : '' }}>
                                            <div class="template-box overflow-hidden rounded-2xl border-2 border-gray-100 bg-white relative ...">
                                                <!-- ACTIVE BADGE -->
                                                <div class="template-active hidden absolute top-2 left-2 text-[10px] bg-indigo-600 text-white px-2 py-1 rounded-full font-bold z-20">
                                                    ACTIVE
                                                </div>  
                                                <div class="h-24 bg-slate-900 flex items-center justify-center relative overflow-hidden">
                                                    <span class="text-indigo-400 font-sans text-xl font-black uppercase tracking-widest">Modern</span>
                                                </div>
                                                <div class="p-4 flex items-center justify-between border-t border-gray-50">
                                                    <span class="text-xs font-bold text-gray-700">Dark Minimalist</span>
                                                    <span class="text-[9px] px-2 py-0.5 bg-indigo-100 text-indigo-700 rounded-full font-black uppercase flex items-center">
                                                        <svg class="w-2 h-2 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2V7a5 5 0 00-5-5zM7 7a3 3 0 016 0v2H7V7z"/></svg>
                                                        Exclusive
                                                    </span>
                                                </div>
                                                <!-- Overlay Lock -->
                                                <div class="lock-overlay absolute inset-0 bg-slate-900/60 flex flex-col items-center justify-center backdrop-blur-[1px] opacity-0 pointer-events-none transition-opacity">
                                                    <svg class="w-8 h-8 text-indigo-400/50" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a5 5 0 00-5 5v2a2 2 0 00-2 2v5a2 2 0 002 2h10a2 2 0 002-2v-5a2 2 0 00-2-2V7a5 5 0 00-5-5zM7 7a3 3 0 016 0v2H7V7z"/></svg>
                                                    <span class="text-[8px] font-black uppercase text-indigo-400/50 mt-2 tracking-widest">Exclusive Only</span>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Main Cover Photo</label>
                                    @if($invitation->cover_photo_url)
                                        <img src="{{ $invitation->cover_photo_url }}" class="w-32 h-20 object-cover rounded mb-2 border">
                                    @endif
                                    <input type="file" name="cover_photo" class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                                </div>
                            </div>
                        </div>

                        <!-- Section: Wedding Details (Core) -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-bold text-green-600 border-b pb-2 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Wedding Timeline & Primary Location
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="bg-gray-50 p-6 rounded-2xl space-y-4 border border-gray-100 shadow-inner">
                                    <div>
                                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Primary Wedding Date</label>
                                        <input type="datetime-local" name="event_date" value="{{ old('event_date', $invitation->event_date ? date('Y-m-d\TH:i', strtotime($invitation->event_date)) : '') }}" class="block w-full border-gray-300 rounded-xl shadow-sm focus:ring-green-500 focus:border-green-500">
                                        <p class="text-[10px] text-gray-400 mt-1 italic">*This date is used for the countdown timer.</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Primary Location Name</label>
                                        <input type="text" name="event_location" value="{{ old('event_location', $invitation->event_location) }}" placeholder="Ex: Grand Ballroom Hotel Indonesia" class="block w-full border-gray-300 rounded-xl shadow-sm focus:ring-green-500 focus:border-green-500">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Google Maps Link (Primary)</label>
                                        <input type="url" name="map_link" value="{{ old('map_link', $invitation->map_link) }}" placeholder="https://maps.app.goo.gl/..." class="block w-full text-xs border-gray-300 rounded-xl shadow-sm focus:ring-green-500 focus:border-green-500">
                                    </div>
                                </div>
                                <div class="flex flex-col justify-center items-center p-8 bg-green-50/30 rounded-2xl border-2 border-dashed border-green-200 text-center">
                                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600 mb-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <p class="text-xs font-bold text-green-800 uppercase mb-2">Informasi Tambahan</p>
                                    <p class="text-[11px] text-green-700 leading-relaxed px-4">
                                        Data di sebelah kiri adalah **informasi utama** yang digunakan sistem untuk navigasi dasar dan hitung mundur. Detail acara spesifik (Akad, Resepsi, dll) dapat dikelola di bagian bawah.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Section: Groom & Bride Media -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-bold text-pink-600 border-b pb-2 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                Groom & Bride Media
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <!-- Groom Profile -->
                                <div class="bg-blue-50/50 p-4 rounded-lg space-y-4">
                                    <p class="font-bold text-blue-700 text-sm italic">Groom Profile</p>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 uppercase">Groom Photo</label>
                                        @if($invitation->groom_photo_url)
                                            <img src="{{ $invitation->groom_photo_url }}" class="w-24 h-24 object-cover rounded-full mb-2 border-2 border-white shadow">
                                        @endif
                                        <input type="file" name="groom_photo" class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 uppercase">Instagram @</label>
                                        <input type="text" name="groom_instagram" value="{{ old('groom_instagram', $invitation->groom_instagram) }}" placeholder="Ex: @budi_santoso" class="mt-1 block w-full text-sm border-gray-300 rounded-md">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 uppercase">Groom Full Name</label>
                                        <input type="text" name="groom_name" value="{{ old('groom_name', $invitation->groom_name) }}" class="mt-1 block w-full text-sm border-gray-300 rounded-md" required>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2">
                                        <input type="number" name="groom_child_number" value="{{ old('groom_child_number', $invitation->groom_child_number) }}" placeholder="Putra ke" class="text-xs border-gray-300 rounded-md">
                                        <input type="number" name="groom_total_siblings" value="{{ old('groom_total_siblings', $invitation->groom_total_siblings) }}" placeholder="Bersaudara" class="text-xs border-gray-300 rounded-md">
                                    </div>
                                    <input type="text" name="groom_father_name" value="{{ old('groom_father_name', $invitation->groom_father_name) }}" placeholder="Nama Ayah" class="block w-full text-sm border-gray-300 rounded-md">
                                    <input type="text" name="groom_mother_name" value="{{ old('groom_mother_name', $invitation->groom_mother_name) }}" placeholder="Nama Ibu" class="block w-full text-sm border-gray-300 rounded-md">
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 uppercase">Short Description</label>
                                        <textarea name="groom_description" rows="2" class="mt-1 block w-full text-sm border-gray-300 rounded-md">{{ old('groom_description', $invitation->groom_description) }}</textarea>
                                    </div>
                                </div>

                                <!-- Bride Profile -->
                                <div class="bg-pink-50/50 p-4 rounded-lg space-y-4">
                                    <p class="font-bold text-pink-700 text-sm italic">Bride Profile</p>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 uppercase">Bride Photo</label>
                                        @if($invitation->bride_photo_url)
                                            <img src="{{ $invitation->bride_photo_url }}" class="w-24 h-24 object-cover rounded-full mb-2 border-2 border-white shadow">
                                        @endif
                                        <input type="file" name="bride_photo" class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 uppercase">Instagram @</label>
                                        <input type="text" name="bride_instagram" value="{{ old('bride_instagram', $invitation->bride_instagram) }}" placeholder="Ex: @siti_aminah" class="mt-1 block w-full text-sm border-gray-300 rounded-md">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 uppercase">Bride Full Name</label>
                                        <input type="text" name="bride_name" value="{{ old('bride_name', $invitation->bride_name) }}" class="mt-1 block w-full text-sm border-gray-300 rounded-md" required>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2">
                                        <input type="number" name="bride_child_number" value="{{ old('bride_child_number', $invitation->bride_child_number) }}" placeholder="Putri ke" class="text-xs border-gray-300 rounded-md">
                                        <input type="number" name="bride_total_siblings" value="{{ old('bride_total_siblings', $invitation->bride_total_siblings) }}" placeholder="Bersaudara" class="text-xs border-gray-300 rounded-md">
                                    </div>
                                    <input type="text" name="bride_father_name" value="{{ old('bride_father_name', $invitation->bride_father_name) }}" placeholder="Nama Ayah" class="block w-full text-sm border-gray-300 rounded-md">
                                    <input type="text" name="bride_mother_name" value="{{ old('bride_mother_name', $invitation->bride_mother_name) }}" placeholder="Nama Ibu" class="block w-full text-sm border-gray-300 rounded-md">
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 uppercase">Short Description</label>
                                        <textarea name="bride_description" rows="2" class="mt-1 block w-full text-sm border-gray-300 rounded-md">{{ old('bride_description', $invitation->bride_description) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section: Wedding Events (Dynamic) -->
                        <div class="space-y-6">
                            <div class="flex items-center justify-between border-b pb-2">
                                <h3 class="text-lg font-bold text-green-600 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    Wedding Events
                                </h3>
                                <button type="button" onclick="toggleEventForm()" class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full font-bold hover:bg-green-200 transition">
                                    + Add Custom Event
                                </button>
                            </div>

                            <!-- Quick Add Event Form (Hidden by default) -->
                            <div id="quick-event-form" class="hidden bg-green-50/50 border-2 border-dashed border-green-200 rounded-xl p-6">
                                <p class="text-sm font-bold text-green-700 mb-4 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    Create New Wedding Event
                                </p>
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                    <div class="col-span-1">
                                        <label class="block text-[10px] font-bold text-gray-500 uppercase">Event Type</label>
                                        <input type="text" form="event-form" name="event_type" placeholder="Ex: After Party" class="w-full text-sm border-gray-300 rounded-md">
                                    </div>
                                    <div class="col-span-1">
                                        <label class="block text-[10px] font-bold text-gray-500 uppercase">Date</label>
                                        <input type="date" form="event-form" name="date" class="w-full text-sm border-gray-300 rounded-md">
                                    </div>
                                    <div class="col-span-1">
                                        <label class="block text-[10px] font-bold text-gray-500 uppercase">Times</label>
                                        <div class="flex space-x-1">
                                            <input type="text" form="event-form" name="start_time" placeholder="19:00" class="w-1/2 text-xs border-gray-300 rounded-md">
                                            <input type="text" form="event-form" name="end_time" placeholder="Selesai" class="w-1/2 text-xs border-gray-300 rounded-md">
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <label class="block text-[10px] font-bold text-gray-500 uppercase">Order</label>
                                        <input type="number" form="event-form" name="sort_order" value="0" class="w-full text-sm border-gray-300 rounded-md">
                                    </div>
                                </div>
                                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <input type="text" form="event-form" name="location" placeholder="Location Name" class="w-full text-sm border-gray-300 rounded-md">
                                    <input type="url" form="event-form" name="maps_link" placeholder="Google Maps URL" class="w-full text-xs border-gray-300 rounded-md">
                                </div>
                                <div class="mt-6 flex justify-end items-center space-x-3 pt-4 border-t border-green-100">
                                    <button type="button" onclick="toggleEventForm()" class="text-xs mr-2 text-gray-400 font-bold uppercase tracking-widest">Cancel</button>
                                    <button 
                                        type="button"
                                        onclick="submitEvent()"
                                        class="px-10 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl shadow-md transition-all duration-200">
                                        SAVE EVENT
                                    </button>
                                </div>
                            </div>
                            
                            <div id="events-container" class="space-y-4">
                                @forelse($invitation->events as $event)
                                    <div class="event-row bg-gray-50 p-4 rounded-lg relative border border-gray-100 shadow-sm" id="event-row-{{ $event->id }}">
                                        <input type="hidden" name="existing_events[{{ $event->id }}][id]" value="{{ $event->id }}">
                                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                            <div>
                                                <label class="block text-[10px] font-bold text-gray-500 uppercase">Event Type</label>
                                                <input type="text" name="existing_events[{{ $event->id }}][event_type]" value="{{ $event->event_type }}" class="w-full text-sm border-gray-300 rounded-md">
                                            </div>
                                            <div>
                                                <label class="block text-[10px] font-bold text-gray-500 uppercase">Date</label>
                                                <input type="date" name="existing_events[{{ $event->id }}][date]" value="{{ $event->date }}" class="w-full text-sm border-gray-300 rounded-md">
                                            </div>
                                            <div>
                                                <label class="block text-[10px] font-bold text-gray-500 uppercase">Start - End Time</label>
                                                <div class="flex space-x-1">
                                                    <input type="text" name="existing_events[{{ $event->id }}][start_time]" value="{{ $event->start_time }}" placeholder="08:00" class="w-1/2 text-xs border-gray-300 rounded-md">
                                                    <input type="text" name="existing_events[{{ $event->id }}][end_time]" value="{{ $event->end_time }}" placeholder="Selesai" class="w-1/2 text-xs border-gray-300 rounded-md">
                                                </div>
                                            </div>
                                            <div>
                                                <label class="block text-[10px] font-bold text-gray-500 uppercase">Sort Order</label>
                                                <input type="number" name="existing_events[{{ $event->id }}][sort_order]" value="{{ $event->sort_order }}" class="w-full text-sm border-gray-300 rounded-md">
                                            </div>
                                        </div>
                                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <input type="text" name="existing_events[{{ $event->id }}][location]" value="{{ $event->location }}" placeholder="Location Name" class="w-full text-sm border-gray-300 rounded-md">
                                            <input type="url" name="existing_events[{{ $event->id }}][maps_link]" value="{{ $event->maps_link }}" placeholder="Google Maps URL" class="w-full text-xs border-gray-300 rounded-md">
                                        </div>
                                        <button type="button" onclick="deleteEvent({{ $event->id }})" class="absolute -top-2 -right-2 bg-red-100 text-red-600 rounded-full p-1 hover:bg-red-200 shadow-sm border border-red-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    </div>
                                @empty
                                    <p class="text-sm text-gray-400 italic text-center py-4 bg-gray-50 rounded-lg border-2 border-dashed">No detailed events added yet.</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Section: Love Stories (Dynamic) -->
                        <div class="space-y-6">
                            <div class="flex items-center justify-between border-b pb-2">
                                <h3 class="text-lg font-bold text-teal-600 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                    Love Stories
                                </h3>
                                <button type="button" onclick="toggleStoryForm()" class="text-xs bg-teal-100 text-teal-700 px-3 py-1 rounded-full font-bold hover:bg-teal-200 transition">
                                    + Add Story Milestone
                                </button>
                            </div>

                            <!-- List Existing Stories -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($invitation->loveStories as $story)
                                    <div class="bg-white border rounded-xl overflow-hidden shadow-sm flex group relative" id="story-card-{{ $story->id }}">
                                        @if($story->photo_url)
                                            <img src="{{ $story->photo_url }}" class="w-32 h-32 object-cover">
                                        @else
                                            <div class="w-32 h-32 bg-gray-100 flex items-center justify-center">
                                                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        @endif
                                        <div class="p-4 flex-1">
                                            <div class="flex justify-between items-start">
                                                <span class="text-[10px] font-bold text-teal-600 bg-teal-50 px-2 rounded-full uppercase">#{{ $story->sort_order }}</span>
                                                <button type="button" onclick="deleteStory({{ $story->id }})" class="text-red-400 hover:text-red-600">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </div>
                                            <h4 class="font-bold text-gray-800 mt-1">{{ $story->title }}</h4>
                                            <p class="text-xs text-gray-500 line-clamp-2 mt-1">{{ $story->description }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Quick Add Story Form (Hidden by default) -->
                            <div id="quick-story-form" class="hidden bg-teal-50/50 border-2 border-dashed border-teal-200 rounded-xl p-6">
                                <p class="text-sm font-bold text-teal-700 mb-4 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    Add Story
                                </p>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div class="space-y-3">
                                        <label class="block text-xs font-bold text-gray-500 uppercase">Story Photo</label>
                                        <input type="file" form="story-form" name="photo" class="block w-full text-xs bg-white p-1 rounded border">
                                    </div>
                                    <div class="md:col-span-2 space-y-3">
                                        <div class="grid grid-cols-4 gap-4">
                                            <input type="text" form="story-form" name="title" placeholder="Milestone Title (Ex: Our First Meet)" class="col-span-3 text-sm border-gray-300 rounded-md">
                                            <input type="number" form="story-form" name="sort_order" placeholder="Order" class="text-sm border-gray-300 rounded-md">
                                        </div>
                                        <textarea form="story-form" name="description" rows="3" placeholder="Tell us about this beautiful moment..." class="w-full text-sm border-gray-300 rounded-md"></textarea>
                                        <div class="flex justify-end items-center space-x-3 pt-4 border-t border-teal-100">
                                            <button type="button" onclick="toggleStoryForm()" class="text-xs text-gray-400 font-bold uppercase tracking-widest">Cancel</button>
                                            <button type="button" onclick="submitStory()" class="bg-teal-600 hover:bg-teal-700 text-white text-xs font-bold px-8 py-3 rounded-xl shadow-lg transition transform active:scale-95">
                                                Save Story
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section: Wedding Gift -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-bold text-amber-600 border-b pb-2 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Wedding Gift (Bank Info)
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-gray-50 p-6 rounded-lg">
                                <div class="space-y-3">
                                    <label class="block text-xs font-bold text-gray-500 uppercase">Rekening Pihak Pria</label>
                                    <input type="text" name="gift_bank_pria" value="{{ old('gift_bank_pria', $invitation->gift_bank_pria) }}" placeholder="Ex: BCA - 12345678" class="w-full text-sm border-gray-300 rounded-md">
                                    <input type="text" name="gift_bank_pria_name" value="{{ old('gift_bank_pria_name', $invitation->gift_bank_pria_name) }}" placeholder="Atas Nama" class="w-full text-sm border-gray-300 rounded-md">
                                </div>
                                <div class="space-y-3">
                                    <label class="block text-xs font-bold text-gray-500 uppercase">Rekening Pihak Wanita</label>
                                    <input type="text" name="gift_bank_wanita" value="{{ old('gift_bank_wanita', $invitation->gift_bank_wanita) }}" placeholder="Ex: Mandiri - 87654321" class="w-full text-sm border-gray-300 rounded-md">
                                    <input type="text" name="gift_bank_wanita_name" value="{{ old('gift_bank_wanita_name', $invitation->gift_bank_wanita_name) }}" placeholder="Atas Nama" class="w-full text-sm border-gray-300 rounded-md">
                                </div>
                            </div>
                        </div>

                        <!-- Section: Background Music -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-bold text-purple-600 border-b pb-2 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>
                                Background Music
                            </h3>
                            <div class="bg-purple-50 p-6 rounded-lg flex flex-col md:flex-row md:items-center space-y-4 md:space-y-0 md:space-x-8">
                                <div class="flex-1">
                                    <label class="block text-xs font-bold text-gray-500 uppercase">Upload MP3 (Max 5MB)</label>
                                    <input type="file" name="music_path" accept=".mp3" class="block w-full text-sm bg-white p-2 rounded border border-purple-200">
                                    <input type="text" name="music_title" value="{{ old('music_title', $invitation->music_title) }}" placeholder="Judul Lagu (Ex: Tulus - Teman Hidup)" class="mt-2 w-full text-sm border-gray-200 rounded-md">
                                </div>
                                @if($invitation->music_url)
                                <div class="flex flex-col items-center">
                                    <p class="text-[10px] font-bold text-purple-700 mb-1">CURRENT MUSIC</p>
                                    <audio controls class="h-8 w-48">
                                        <source src="{{ $invitation->music_url }}" type="audio/mpeg">
                                    </audio>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Section: Gallery -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-bold text-blue-600 border-b pb-2 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Photo Gallery
                            </h3>
                            <div>
                                @if($invitation->galleries->count() > 0)
                                    <div class="grid grid-cols-2 md:grid-cols-6 gap-4 mb-6" id="gallery-container">
                                        @foreach($invitation->galleries as $gallery)
                                            <div class="relative group" id="gallery-item-{{ $gallery->id }}">
                                                <img src="{{ $gallery->photo_url }}" class="w-full h-24 object-cover rounded shadow border">
                                                <button type="button" onclick="deleteGalleryPhoto({{ $gallery->id }})" class="absolute -top-2 -right-2 bg-red-600 shadow text-white rounded-full p-1 opacity-100 md:opacity-0 md:group-hover:opacity-100 transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Add New Photos</label>
                                <input type="file" name="gallery[]" multiple class="block w-full text-sm border-gray-300 rounded-md">
                            </div>
                        </div>

                        <!-- Section: Footer Info -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-bold text-gray-600 border-b pb-2 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Footer Information
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 bg-gray-50 p-6 rounded-lg">
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase">Vendor Phone</label>
                                    <input type="text" name="contact_phone" value="{{ old('contact_phone', $invitation->contact_phone) }}" placeholder="+62..." class="mt-1 block w-full text-sm border-gray-300 rounded-md">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase">Vendor IG</label>
                                    <input type="text" name="contact_instagram" value="{{ old('contact_instagram', $invitation->contact_instagram) }}" placeholder="@zipmoment" class="mt-1 block w-full text-sm border-gray-300 rounded-md">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase">Vendor Website</label>
                                    <input type="text" name="footer_website" value="{{ old('footer_website', $invitation->footer_website) }}" placeholder="zipmoment.com" class="mt-1 block w-full text-sm border-gray-300 rounded-md">
                                </div>
                            </div>
                        </div>

                        <div class="pt-12 mt-12 border-t flex justify-between items-center">

                        <!-- Left -->
                        <a href="{{ route('admin.invitations.index') }}"
                        class="text-sm text-gray-400 hover:text-gray-600 transition">
                            ← Back to Invitations
                        </a>

                        <!-- Right Buttons -->
                        <div class="flex gap-4">
                            <a href="{{ route('admin.invitations.index') }}"
                            class="px-6 py-3 rounded-xl border text-gray-600 hover:bg-gray-100 transition">
                                Cancel
                            </a>

                            <button type="submit"
                                class="px-10 py-3 mx-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl shadow-md transition-all duration-200">
                                Save Invitation
                            </button>
                        </div>
                    </div>

                    </form>

                    <!-- Auxiliary Forms for related items -->
                    <form id="story-form" action="{{ route('admin.invitations.stories.store', $invitation->id) }}" method="POST" enctype="multipart/form-data" class="hidden"></form>
                    <form id="event-form" action="{{ route('admin.invitations.events.store', $invitation->id) }}" method="POST" class="hidden"></form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts for Dynamic Management -->
    <script>
        // --- TEMPLATE ACCESS MANAGEMENT ---
    function updateTemplateAccess() {
        const checkedPackage = document.querySelector('input[name="package_type"]:checked');
        if (!checkedPackage) return;
        
        const packageType = checkedPackage.value;
        const templates = {
            elegant: ['basic', 'premium', 'exclusive'],
            floral: ['premium', 'exclusive'],
            modern: ['exclusive']
        };

        Object.keys(templates).forEach(t => {
            const card = document.getElementById(`template-card-${t}`);
            if (!card) return;
            
            const input = card.querySelector('input');
            const overlay = card.querySelector('.lock-overlay');
            const box = card.querySelector('.template-box');
            
            if (templates[t].includes(packageType)) {
                // Unlock
                card.style.pointerEvents = 'auto';
                card.style.opacity = '1';
                if (overlay) overlay.style.opacity = '0';
                if (box) box.classList.remove('grayscale-[0.8]');
            } else {
                // Lock
                card.style.pointerEvents = 'none';
                card.style.opacity = '0.6';
                if (overlay) overlay.style.opacity = '1';
                if (box) box.classList.add('grayscale-[0.8]');
                
                // If currently selected, revert to basic (elegant)
                if (input && input.checked) {
                    const elegantInput = document.querySelector('input[name="template"][value="elegant"]');
                    if (elegantInput) elegantInput.checked = true;
                }
            }
        });
    }

    // Initialize on load
    document.addEventListener('DOMContentLoaded', () => {
        updateTemplateAccess();
    });

    // --- LOVE STORY MANAGEMENT ---
        function toggleStoryForm() {
            const form = document.getElementById('quick-story-form');
            form.classList.toggle('hidden');
            if(!form.classList.contains('hidden')) {
                form.scrollIntoView({ behavior: 'smooth' });
            }
        }

        async function submitStory() {
            const form = document.getElementById('story-form');
            const quickForm = document.getElementById('quick-story-form');
            const formData = new FormData(form);
            
            // Collect data from inputs that have form="story-form"
            quickForm.querySelectorAll('[form="story-form"]').forEach(input => {
                if (input.type === 'file') {
                    if (input.files[0]) formData.append(input.name, input.files[0]);
                } else {
                    formData.append(input.name, input.value);
                }
            });

            formData.append('_token', '{{ csrf_token() }}');

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: { 'Accept': 'application/json' }
                });
                if (response.ok) {
                    location.reload(); // Refresh to show new story
                } else {
                    const data = await response.json();
                    alert('Error: ' + (data.message || 'Failed to save story'));
                }
            } catch (e) {
                alert('An error occurred during upload.');
            }
        }

        function deleteStory(id) {
            if(!confirm('Delete this story milestone?')) return;
            fetch(`/admin/stories/${id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
            }).then(() => {
                document.getElementById(`story-card-${id}`).remove();
            });
        }

        // --- EVENT MANAGEMENT ---
        function toggleEventForm() {
            const form = document.getElementById('quick-event-form');
            form.classList.toggle('hidden');
            if(!form.classList.contains('hidden')) {
                form.scrollIntoView({ behavior: 'smooth' });
            }
        }

        async function submitEvent() {
            const form = document.getElementById('event-form');
            const quickForm = document.getElementById('quick-event-form');
            const formData = new FormData();
            
            quickForm.querySelectorAll('[form="event-form"]').forEach(input => {
                formData.append(input.name, input.value);
            });

            formData.append('_token', '{{ csrf_token() }}');

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: { 'Accept': 'application/json' }
                });
                if (response.ok) {
                    location.reload(); 
                } else {
                    const data = await response.json();
                    alert('Error: ' + (data.message || 'Failed to save event'));
                }
            } catch (e) {
                alert('An error occurred during submission.');
            }
        }

        let newEventCount = 0;
        function addEventRow() {
            const container = document.getElementById('events-container');
            const id = `new_${newEventCount++}`;
            const html = `
                <div class="event-row bg-indigo-50/50 p-4 rounded-lg relative border border-indigo-200 shadow-sm animate-pulse-once" id="event-row-${id}">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-indigo-500 uppercase">Event Type</label>
                            <input type="text" name="new_events[${id}][event_type]" placeholder="Ex: Afterparty" class="w-full text-sm border-indigo-300 rounded-md focus:ring-indigo-500" required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-indigo-500 uppercase">Date</label>
                            <input type="date" name="new_events[${id}][date]" class="w-full text-sm border-indigo-300 rounded-md focus:ring-indigo-500">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-indigo-500 uppercase">Start - End Time</label>
                            <div class="flex space-x-1">
                                <input type="text" name="new_events[${id}][start_time]" placeholder="19:00" class="w-1/2 text-xs border-indigo-300 rounded-md focus:ring-indigo-500">
                                <input type="text" name="new_events[${id}][end_time]" placeholder="Selesai" class="w-1/2 text-xs border-indigo-300 rounded-md focus:ring-indigo-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-indigo-500 uppercase">Sort Order</label>
                            <input type="number" name="new_events[${id}][sort_order]" value="0" class="w-full text-sm border-indigo-300 rounded-md focus:ring-indigo-500">
                        </div>
                    </div>
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" name="new_events[${id}][location]" placeholder="Location Name" class="w-full text-sm border-indigo-300 rounded-md focus:ring-indigo-500">
                        <input type="url" name="new_events[${id}][maps_link]" placeholder="Google Maps URL" class="w-full text-xs border-indigo-300 rounded-md focus:ring-indigo-500">
                    </div>
                    <button type="button" onclick="document.getElementById('event-row-${id}').remove()" class="absolute -top-2 -right-2 bg-indigo-200 text-indigo-700 rounded-full p-1 hover:bg-indigo-300 shadow-sm border border-indigo-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            `;
            const div = document.createElement('div');
            div.innerHTML = html;
            container.appendChild(div.firstElementChild);
        }

        function deleteEvent(id) {
            if(!confirm('Delete this event?')) return;
            fetch(`/admin/events/${id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
            }).then(() => {
                document.getElementById(`event-row-${id}`).remove();
            });
        }
        function deleteGalleryPhoto(id) {
            if (!confirm('Are you sure you want to delete this photo? This action cannot be undone.')) {
                return;
            }

            fetch(`/admin/gallery/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const item = document.getElementById(`gallery-item-${id}`);
                    if (item) {
                        item.classList.add('scale-0', 'opacity-0');
                        setTimeout(() => {
                            item.remove();
                            // Check if gallery is now empty
                            const container = document.getElementById('gallery-container');
                            if (container && container.children.length === 0) {
                                container.remove();
                            }
                        }, 300);
                    }
                } else {
                    alert('Error deleting photo: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while deleting the photo.');
            });
        }
    </script>
    <script>
document.addEventListener("DOMContentLoaded", function () {

    const radios = document.querySelectorAll('input[name="package_type"]');
    const cards = document.querySelectorAll('.package-card');

    function setActiveCard() {
        cards.forEach(card => card.classList.remove('package-active'));

        radios.forEach(radio => {
            if (radio.checked) {
                radio.closest('.package-card').classList.add('package-active');
            }
        });
    }

    // initial load
    setActiveCard();

    // on change
    radios.forEach(radio => {
        radio.addEventListener('change', () => {
            setActiveCard();
        });
    });

});
</script>

<script>
document.addEventListener("DOMContentLoaded", function(){

    const radios = document.querySelectorAll('input[name="template"]');
    const cards = document.querySelectorAll('.template-card');

    function setActiveTemplate(){
        cards.forEach(c=>c.classList.remove('template-selected'));

        radios.forEach(r=>{
            if(r.checked){
                r.closest('.template-card').classList.add('template-selected');
            }
        });
    }

    setActiveTemplate();

    radios.forEach(r=>{
        r.addEventListener('change', function(){
            setActiveTemplate();
        });
    });

});
</script>


<style>
.package-active > div{
    border:2px solid #facc15 !important;
    background:rgba(250,204,21,0.08) !important;
    transform:scale(1.03);
    box-shadow:0 0 25px rgba(250,204,21,0.25);
}

.template-selected .template-box{
    border:2px solid #4f46e5 !important;
    box-shadow:0 0 0 3px rgba(79,70,229,0.15);
    transform:scale(1.02);
}

.template-selected .template-active{
    display:flex !important;
}
</style>



</x-app-layout>
