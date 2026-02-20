<div id="countdown" class="flex justify-center space-x-2 md:space-x-8">
    <div class="text-center group">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-2 md:p-4 border-b-4 border-[#d4af37] w-14 md:w-20 transform group-hover:-translate-y-1 transition">
            <span id="days" class="text-xl md:text-3xl font-bold text-[#d4af37]">00</span>
        </div>
        <p class="text-[9px] md:text-xs uppercase tracking-widest text-gray-500 mt-2">Days</p>
    </div>
    <div class="text-center group">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-2 md:p-4 border-b-4 border-[#d4af37] w-14 md:w-20 transform group-hover:-translate-y-1 transition">
            <span id="hours" class="text-xl md:text-3xl font-bold text-[#d4af37]">00</span>
        </div>
        <p class="text-[9px] md:text-xs uppercase tracking-widest text-gray-500 mt-2">Hours</p>
    </div>
    <div class="text-center group">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-2 md:p-4 border-b-4 border-[#d4af37] w-14 md:w-20 transform group-hover:-translate-y-1 transition">
            <span id="minutes" class="text-xl md:text-3xl font-bold text-[#d4af37]">00</span>
        </div>
        <p class="text-[9px] md:text-xs uppercase tracking-widest text-gray-500 mt-2">Mins</p>
    </div>
    <div class="text-center group">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-2 md:p-4 border-b-4 border-[#d4af37] w-14 md:w-20 transform group-hover:-translate-y-1 transition">
            <span id="seconds" class="text-xl md:text-3xl font-bold text-[#d4af37]">00</span>
        </div>
        <p class="text-[9px] md:text-xs uppercase tracking-widest text-gray-500 mt-2">Secs</p>
    </div>
</div>

<script>
    function startCountdown(dateString) {
        const targetDate = new Date(dateString).getTime();
        
        const timer = setInterval(() => {
            const now = new Date().getTime();
            const distance = targetDate - now;
            
            if (distance < 0) {
                clearInterval(timer);
                return;
            }
            
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            document.getElementById('days').innerText = String(days).padStart(2, '0');
            document.getElementById('hours').innerText = String(hours).padStart(2, '0');
            document.getElementById('minutes').innerText = String(minutes).padStart(2, '0');
            document.getElementById('seconds').innerText = String(seconds).padStart(2, '0');
        }, 1000);
    }

    // Start with the invitation date
    startCountdown('{{ $invitation->event_date }}');
</script>
