<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Invitation') }}
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
                    
                    <form action="{{ route('admin.invitations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-12">
                        @csrf

                        <!-- Section: Business & Package Settings (SaaS Mode) -->
                        <div class="bg-gradient-to-br from-indigo-900 to-slate-900 rounded-3xl p-8 mb-12 shadow-2xl border border-indigo-700/50 relative overflow-hidden group">
                            <div class="absolute top-0 right-0 p-8 opacity-10 group-hover:opacity-20 transition-opacity">
                                <svg class="w-48 h-48 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                            </div>
                            
                            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
                                <div class="space-y-2">
                                    <div class="inline-flex items-center px-3 py-1 bg-indigo-500/20 rounded-full text-indigo-300 text-[10px] font-black uppercase tracking-widest border border-indigo-500/30">
                                        Owner Quick Setup
                                    </div>
                                    <h3 class="text-3xl font-black text-white tracking-tight">Product Tiers</h3>
                                    <p class="text-indigo-200/60 text-sm font-medium max-w-sm">Select the package tier for this new invitation.</p>
                                    <button type="button" onclick="quickFillForm()" class="mt-4 px-4 py-2 bg-white/10 hover:bg-white/20 border border-white/20 rounded-xl text-white text-[10px] font-black uppercase tracking-widest transition-all">
                                        ⚡ Quick Fill Demo Data
                                    </button>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full md:w-auto">
                                    <!-- Basic Package -->
                                    <label class="relative cursor-pointer group">
                                        <input type="radio" name="package_type" value="basic" class="peer sr-only" onchange="updateTemplateAccess()">
                                        <div class="h-full p-5 rounded-2xl border-2 border-slate-700 bg-slate-800/40 peer-checked:border-white peer-checked:bg-slate-700/60 peer-checked:ring-4 peer-checked:ring-white/10 peer-checked:ring-offset-2 peer-checked:ring-offset-slate-900 peer-checked:scale-[1.03] peer-checked:shadow-[0_0_20px_rgba(255,255,255,0.15)] transition-all duration-300 hover:border-slate-500 relative overflow-hidden">
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

                                    <!-- Premium Package (Default Choice) -->
                                    <label class="relative cursor-pointer group">
                                        <input type="radio" name="package_type" value="premium" class="peer sr-only" checked onchange="updateTemplateAccess()">
                                        <div class="h-full p-5 rounded-2xl border-2 border-amber-900/50 bg-amber-900/20 peer-checked:border-amber-400 peer-checked:bg-amber-900/40 peer-checked:ring-4 peer-checked:ring-amber-500/20 peer-checked:ring-offset-2 peer-checked:ring-offset-slate-900 peer-checked:scale-[1.03] peer-checked:shadow-[0_0_25px_rgba(251,191,36,0.25)] transition-all duration-300 hover:border-amber-500/50 relative overflow-hidden">
                                            <!-- Best Seller Badge -->
                                            <div class="absolute -top-1 -right-1 z-20">
                                                <span class="bg-amber-500 text-amber-900 text-[8px] font-black px-2 py-1 rounded-bl-lg rounded-tr-xl uppercase tracking-widest shadow-lg">Best Seller</span>
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
                                    <label class="relative cursor-pointer group">
                                        <input type="radio" name="package_type" value="exclusive" class="peer sr-only" onchange="updateTemplateAccess()">
                                        <div class="h-full p-5 rounded-2xl border-2 border-indigo-900/50 bg-indigo-900/20 peer-checked:border-indigo-400 peer-checked:bg-indigo-900/40 peer-checked:ring-4 peer-checked:ring-indigo-500/20 peer-checked:ring-offset-2 peer-checked:ring-offset-slate-900 peer-checked:scale-[1.03] peer-checked:shadow-[0_0_25px_rgba(129,140,248,0.25)] transition-all duration-300 hover:border-indigo-500/50 relative overflow-hidden">
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
                                    <input type="text" name="title" value="{{ old('title') }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                </div>
                                <div>
                                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Assign to Client</label>
                                    <select name="user_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="">-- Select Client --</option>
                                        @foreach($clients as $client)
                                            <option value="{{ $client->id }}" {{ old('user_id') == $client->id ? 'selected' : '' }}>
                                                {{ $client->name }} ({{ $client->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-span-1 md:col-span-2">
                                    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-4">Design Template Selection</label>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <!-- Elegant Card (Always Unlocked) -->
                                        <label class="relative cursor-pointer group" id="template-card-elegant">
                                            <input type="radio" name="template" value="elegant" class="peer sr-only" checked>
                                            <div class="overflow-hidden rounded-2xl border-2 border-gray-100 bg-white peer-checked:border-indigo-600 peer-checked:ring-4 peer-checked:ring-indigo-100 transition-all hover:border-gray-300 shadow-sm group-hover:shadow-md">
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
                                            <input type="radio" name="template" value="floral" class="peer sr-only">
                                            <div class="template-box overflow-hidden rounded-2xl border-2 border-gray-100 bg-white peer-checked:border-indigo-600 peer-checked:ring-4 peer-checked:ring-indigo-100 transition-all hover:border-gray-300 shadow-sm group-hover:shadow-md relative">
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
                                            <input type="radio" name="template" value="modern" class="peer sr-only">
                                            <div class="template-box overflow-hidden rounded-2xl border-2 border-gray-100 bg-white peer-checked:border-indigo-600 peer-checked:ring-4 peer-checked:ring-indigo-100 transition-all hover:border-gray-300 shadow-sm group-hover:shadow-md relative">
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
                                    <input type="file" name="cover_photo" class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
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
                                        <input type="file" name="groom_photo" class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 uppercase">Instagram @</label>
                                        <input type="text" name="groom_instagram" placeholder="Ex: @budi_santoso" class="mt-1 block w-full text-sm border-gray-300 rounded-md">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 uppercase">Groom Full Name</label>
                                        <input type="text" name="groom_name" class="mt-1 block w-full text-sm border-gray-300 rounded-md" required>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2">
                                        <input type="number" name="groom_child_number" placeholder="Putra ke" class="text-xs border-gray-300 rounded-md">
                                        <input type="number" name="groom_total_siblings" placeholder="Bersaudara" class="text-xs border-gray-300 rounded-md">
                                    </div>
                                    <input type="text" name="groom_father_name" placeholder="Nama Ayah" class="block w-full text-sm border-gray-300 rounded-md">
                                    <input type="text" name="groom_mother_name" placeholder="Nama Ibu" class="block w-full text-sm border-gray-300 rounded-md">
                                </div>

                                <!-- Bride Profile -->
                                <div class="bg-pink-50/50 p-4 rounded-lg space-y-4">
                                    <p class="font-bold text-pink-700 text-sm italic">Bride Profile</p>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 uppercase">Bride Photo</label>
                                        <input type="file" name="bride_photo" class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 uppercase">Instagram @</label>
                                        <input type="text" name="bride_instagram" placeholder="Ex: @siti_aminah" class="mt-1 block w-full text-sm border-gray-300 rounded-md">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-600 uppercase">Bride Full Name</label>
                                        <input type="text" name="bride_name" class="mt-1 block w-full text-sm border-gray-300 rounded-md" required>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2">
                                        <input type="number" name="bride_child_number" placeholder="Putri ke" class="text-xs border-gray-300 rounded-md">
                                        <input type="number" name="bride_total_siblings" placeholder="Bersaudara" class="text-xs border-gray-300 rounded-md">
                                    </div>
                                    <input type="text" name="bride_father_name" placeholder="Nama Ayah" class="block w-full text-sm border-gray-300 rounded-md">
                                    <input type="text" name="bride_mother_name" placeholder="Nama Ibu" class="block w-full text-sm border-gray-300 rounded-md">
                                </div>
                            </div>
                        </div>

                        <!-- Section: Event Timing & Location (Core) -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-bold text-green-600 border-b pb-2 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                General Event Info
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="bg-gray-50/50 p-4 rounded-lg space-y-4 shadow-sm border border-gray-100">
                                    <p class="font-bold text-gray-700 text-xs italic">Primary Event Date & Local</p>
                                    <div class="grid grid-cols-1 gap-4">
                                        <div>
                                            <label class="block text-xs font-semibold text-gray-600 uppercase">Primary Wedding Date</label>
                                            <input type="datetime-local" name="event_date" class="mt-1 block w-full text-sm border-gray-300 rounded-md" required>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-gray-600 uppercase">General Location Name</label>
                                            <input type="text" name="event_location" placeholder="Ex: Grand Ballroom Hotel Indonesia" class="mt-1 block w-full text-sm border-gray-300 rounded-md" required>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-gray-600 uppercase">Google Maps Link</label>
                                            <input type="url" name="map_link" placeholder="https://maps.app.goo.gl/..." class="mt-1 block w-full text-xs border-gray-300 rounded-md">
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col justify-center items-center p-6 bg-indigo-50/50 rounded-lg border-2 border-dashed border-indigo-200 text-center">
                                    <svg class="w-12 h-12 text-indigo-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <p class="text-xs font-bold text-indigo-700 uppercase mb-1">Advanced Features</p>
                                    <p class="text-[10px] text-indigo-600">You can add **Dynamic Love Stories** and **Multiple Detailed Events** (Akad, Resepsi, Afterparty, etc.) from the **Edit Page** after this invitation is created.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Section: Key Wedding Photos -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-bold text-blue-600 border-b pb-2 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Wedding Media
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="bg-gray-50/50 p-4 rounded-lg space-y-2 border border-blue-100">
                                    <label class="block text-xs font-bold text-gray-500 uppercase">Background Music (MP3)</label>
                                    <input type="file" name="music_path" accept=".mp3" class="block w-full text-xs bg-white p-2 rounded border">
                                    <input type="text" name="music_title" placeholder="Song Title (Ex: Beautiful in White)" class="w-full text-xs border-gray-300 rounded-md">
                                </div>
                                <div class="bg-gray-50/50 p-4 rounded-lg space-y-2 border border-blue-100">
                                    <label class="block text-xs font-bold text-gray-500 uppercase">Photo Gallery (Bulk)</label>
                                    <input type="file" name="gallery[]" multiple class="block w-full text-xs bg-white p-2 rounded border">
                                    <p class="text-[10px] text-gray-400 italic">Select multiple photos for the gallery.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Section: Wedding Gift -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-bold text-amber-600 border-b pb-2 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Wedding Gift (Bank Info)
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-gray-50 p-6 rounded-lg border border-amber-100">
                                <div class="space-y-3">
                                    <label class="block text-xs font-bold text-gray-500 uppercase">Rekening Pihak Pria</label>
                                    <input type="text" name="gift_bank_pria" placeholder="Ex: BCA - 12345678" class="w-full text-sm border-gray-300 rounded-md">
                                    <input type="text" name="gift_bank_pria_name" placeholder="Atas Nama" class="w-full text-sm border-gray-300 rounded-md">
                                </div>
                                <div class="space-y-3">
                                    <label class="block text-xs font-bold text-gray-500 uppercase">Rekening Pihak Wanita</label>
                                    <input type="text" name="gift_bank_wanita" placeholder="Ex: Mandiri - 87654321" class="w-full text-sm border-gray-300 rounded-md">
                                    <input type="text" name="gift_bank_wanita_name" placeholder="Atas Nama" class="w-full text-sm border-gray-300 rounded-md">
                                </div>
                            </div>
                        </div>

                        <!-- Section: Footer Info -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-bold text-gray-600 border-b pb-2 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Footer Information
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 bg-gray-50 p-6 rounded-lg border border-gray-200">
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase">Vendor Phone</label>
                                    <input type="text" name="contact_phone" placeholder="+62..." class="mt-1 block w-full text-sm border-gray-300 rounded-md">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase">Vendor IG</label>
                                    <input type="text" name="contact_instagram" placeholder="@zipmoment" class="mt-1 block w-full text-sm border-gray-300 rounded-md">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase">Vendor Website</label>
                                    <input type="text" name="footer_website" placeholder="zipmoment.com" class="mt-1 block w-full text-sm border-gray-300 rounded-md">
                                </div>
                            </div>
                        </div>

                        <div class="pt-8 border-t flex justify-end">
                            <button type="submit" class="bg-indigo-600 text-white font-bold px-10 py-3 rounded-xl shadow-lg hover:bg-indigo-700 transform active:scale-95 transition">
                                Create Premium Invitation
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
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

    function quickFillForm() {
        const names = [
            {groom: 'Budi Santoso', bride: 'Siti Aminah'},
            {groom: 'Andra Pratama', bride: 'Dian Lestari'},
            {groom: 'Rizwan Hakim', bride: 'Nabila Putri'}
        ];
        const pair = names[Math.floor(Math.random() * names.length)];
        
        document.querySelector('input[name="title"]').value = pair.groom + ' & ' + pair.bride;
        document.querySelector('input[name="groom_name"]').value = pair.groom;
        document.querySelector('input[name="bride_name"]').value = pair.bride;
        document.querySelector('input[name="event_location"]').value = 'Grand Ballroom Mulia Hotel, Jakarta';
        
        // Set date to 3 months from now
        const date = new Date();
        date.setMonth(date.getMonth() + 3);
        const dateString = date.toISOString().slice(0, 16);
        document.querySelector('input[name="event_date"]').value = dateString;
        
        // Randomly select package and template
        const packages = ['basic', 'premium', 'exclusive'];
        const p = packages[Math.floor(Math.random() * packages.length)];
        document.querySelector(`input[name="package_type"][value="${p}"]`).checked = true;
        
        const templates = ['elegant', 'floral', 'modern'];
        const t = templates[Math.floor(Math.random() * templates.length)];
        document.querySelector(`input[name="template"][value="${t}"]`).checked = true;
        
        alert('Form partially pre-filled with demo data! Just select a client and click Create.');
    }
</script>
