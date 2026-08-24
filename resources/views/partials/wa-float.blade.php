{{-- Tombol WhatsApp mengambang — muncul setelah pengguna melewati hero --}}
<a
    data-wa-float
    href="{{ $waUrl() }}"
    target="_blank"
    rel="noopener"
    class="group fixed bottom-5 right-5 z-[85] inline-flex h-14 items-center gap-3 rounded-full bg-gold-400 pl-4 pr-4 text-navy-950 shadow-[0_12px_32px_-10px_rgba(227,162,31,0.9)] transition-[background-color,padding] duration-300 hover:bg-gold-300 sm:bottom-7 sm:right-7"
    style="opacity: 0; transform: translateY(1rem) scale(0.9); pointer-events: none"
>
    <x-icon name="whatsapp" class="h-6 w-6 shrink-0" />

    {{-- Label melebar saat hover di layar besar --}}
    <span
        class="hidden max-w-0 overflow-hidden whitespace-nowrap text-sm font-semibold opacity-0 transition-[max-width,opacity] duration-300 ease-out group-hover:max-w-[14rem] group-hover:opacity-100 sm:inline"
    >{{ __('site.nav.cta') }}</span>

    <span class="sr-only">{{ __('site.a11y.wa_contact') }}</span>
</a>
