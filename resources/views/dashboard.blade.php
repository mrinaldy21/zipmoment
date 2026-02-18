<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-8 text-gray-900 dark:text-gray-100 text-center">
                    <h1 class="text-3xl font-bold mb-4">Welcome, {{ auth()->user()->name }}!</h1>
                    <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                        Your professional digital invitation management dashboard. Distribute your invitations and manage your guest lists with ease.
                    </p>
                </div>
            </div>

            <!-- Dashboard Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- My Invitations -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-indigo-500 hover:shadow-md transition">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 rounded-full bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-semibold uppercase tracking-widest text-indigo-500">Live</span>
                        </div>
                        <h3 class="text-xl font-bold mb-2">My Invitations</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">View your assigned invitations and start managing your distribution.</p>
                        <a href="{{ route('dashboard.invitations.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-900 font-bold transition">
                            View Invitations
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Assistance -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-emerald-500 hover:shadow-md transition text-center flex flex-col justify-center">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Need Support?</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4 italic">"Transforming weddings into digital masterpieces."</p>
                        <p class="text-sm text-gray-500">Contact ZipMoment Admin for any missing data or custom requests.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
