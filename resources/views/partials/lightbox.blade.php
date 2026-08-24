{{--
    Penampil foto ukuran penuh. Hanya dipakai bila ada foto yang bisa diklik,
    jadi markupnya tidak dirender kalau galeri masih kosong.
--}}
<div
    data-lightbox
    hidden
    role="dialog"
    aria-modal="true"
    aria-label="{{ __('site.photos.viewer') }}"
    class="fixed inset-0 z-[95] flex items-center justify-center bg-navy-950/92 p-4 backdrop-blur-sm sm:p-8"
>
    <button
        type="button"
        data-lightbox-close
        class="absolute right-4 top-4 inline-flex h-11 w-11 cursor-pointer items-center justify-center rounded-full border border-white/20 text-white transition-colors duration-200 hover:bg-white/10 sm:right-6 sm:top-6"
    >
        <span class="sr-only">{{ __('site.photos.close') }}</span>
        <x-icon name="close" class="h-5 w-5" stroke="2" />
    </button>

    <figure data-lightbox-figure class="flex max-h-full w-full max-w-4xl flex-col items-center gap-4">
        <img
            data-lightbox-image
            src=""
            alt=""
            class="max-h-[75vh] w-auto max-w-full rounded-2xl border border-white/10 object-contain shadow-[0_40px_90px_-30px_rgba(0,0,0,0.9)]"
        />
        <figcaption
            data-lightbox-caption
            class="max-w-xl text-center text-sm leading-relaxed text-white/70"
        ></figcaption>
    </figure>
</div>
