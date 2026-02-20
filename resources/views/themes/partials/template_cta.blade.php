@if(isset($isDemo) && $isDemo)
<!-- Conversion CTA Section (Bottom) -->
<section class="py-20 px-6 bg-[var(--bg-secondary)] border-t border-[var(--glass-border)] text-center relative z-20">
    <div class="max-w-2xl mx-auto">
        <h2 class="text-2xl md:text-4xl font-serif italic mb-6">Ingin undangan seperti ini?</h2>
        <p class="text-[var(--text-muted)] mb-10 font-outfit">Hadirkan sentuhan personal dan kemewahan di setiap detail momen spesial Anda bersama ZipMoment.</p>
        <a href="https://wa.me/628123456789?text=Halo%20ZipMoment,%20saya%20tertarik%20dengan%20undangan%20template%20{{ $invitation->template }}." 
           class="inline-flex items-center space-x-3 px-10 py-4 bg-amber-500 hover:bg-amber-600 text-white rounded-full font-bold uppercase tracking-widest transition-all transform hover:scale-105 shadow-xl shadow-amber-500/20">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.521.151-.172.2-.296.3-.495.099-.199.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
            <span>Konsultasi via WhatsApp</span>
        </a>
    </div>
</section>

<!-- Floating Mobile CTA -->
<div class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50 md:hidden w-[calc(100%-3rem)] max-w-sm">
    <a href="https://wa.me/628123456789?text=Halo%20ZipMoment,%20saya%20tertarik%20dengan%20undangan%20template%20{{ $invitation->template }}." 
       class="flex items-center justify-center space-x-2 w-full py-4 bg-amber-500 text-white rounded-2xl font-bold uppercase tracking-widest shadow-2xl animate-bounce">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.521.151-.172.2-.296.3-.495.099-.199.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
        <span>Konsultasi Sekarang</span>
    </a>
</div>

<style>
    :root {
        --bg-secondary: #f3f4f6;
        --glass-border: rgba(0, 0, 0, 0.05);
        --text-muted: #6b7280;
    }
    @media (prefers-color-scheme: dark) {
        :root {
            --bg-secondary: #0a0a0a;
            --glass-border: rgba(255, 255, 255, 0.05);
            --text-muted: #9ca3af;
        }
    }
</style>
@endif
