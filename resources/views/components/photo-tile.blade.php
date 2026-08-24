@props(['photo'])

{{--
    Satu ubin foto. Bila berkasnya belum ada di public/img/photos/, yang tampil
    adalah placeholder berbrand — bukan ikon gambar rusak — sehingga jelas
    bagian ini masih menunggu foto asli.
--}}
@if ($photo['exists'])
    <button
        type="button"
        data-photo-open
        data-photo-src="{{ $photo['url'] }}"
        data-photo-caption="{{ $photo['caption'] }}"
        {{ $attributes->merge(['class' => 'photo-tile group relative block cursor-pointer overflow-hidden']) }}
    >
        {{-- Ubin memakai versi kecil; ukuran penuh baru diambil saat lightbox dibuka. --}}
        <img
            src="{{ $photo['thumb'] }}"
            alt="{{ $photo['caption'] }}"
            loading="lazy"
            decoding="async"
            class="h-full w-full object-cover transition-transform duration-500 ease-out motion-safe:group-hover:scale-[1.07]"
        />

        {{-- Selubung gelap + keterangan, muncul saat disorot --}}
        <span
            class="pointer-events-none absolute inset-0 flex items-end bg-gradient-to-t from-navy-950/85 via-navy-950/10 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100 group-focus-visible:opacity-100"
        >
            <span class="flex w-full items-center gap-1.5 p-3 text-left text-[0.7rem] font-medium leading-tight text-white">
                <x-icon name="expand" class="h-3.5 w-3.5 shrink-0 text-gold-400" stroke="2" />
                <span class="line-clamp-2">{{ $photo['caption'] }}</span>
            </span>
        </span>
    </button>
@else
    <span
        {{ $attributes->merge(['class' => 'photo-tile flex flex-col items-center justify-center gap-1.5 border border-dashed border-navy-900/25 bg-navy-900/[0.04] p-3 text-center']) }}
        title="{{ __('site.photos.placeholder_hint', ['file' => $photo['file']]) }}"
    >
        <x-logo-mark class="h-7 opacity-25" />
        <span class="text-[0.6rem] font-semibold uppercase tracking-[0.12em] text-ink-muted/70">
            {{ $photo['file'] }}
        </span>
    </span>
@endif
