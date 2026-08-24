@php
    $items = \App\Support\Content::marquee();
@endphp

<section
    class="relative overflow-hidden border-y border-white/10 bg-navy-950 py-5"
    aria-label="{{ __('site.a11y.marquee') }}"
>
    <div class="marquee-mask">
        {{-- Dua salinan berdampingan: salinan kedua mengisi celah saat yang
             pertama bergeser keluar, sehingga perulangan tidak terlihat. --}}
        <div data-marquee class="marquee gap-10 pr-10">
            @for ($copy = 0; $copy < 2; $copy++)
                <ul
                    class="flex shrink-0 items-center gap-10"
                    @if ($copy === 1) aria-hidden="true" @endif
                >
                    @foreach ($items as $item)
                        <li class="flex items-center gap-10 whitespace-nowrap">
                            <span class="text-sm font-medium tracking-wide text-white/55">{{ $item }}</span>
                            <span class="h-1 w-1 rounded-full bg-gold-500/60"></span>
                        </li>
                    @endforeach
                </ul>
            @endfor
        </div>
    </div>
</section>
