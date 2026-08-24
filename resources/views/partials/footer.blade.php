@php
    $c = config('scolier.contact');

    $mapsUrl = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($c['maps_query']);

    $footerLinks = [
        __('site.footer.group_programs') => [
            ['label' => __('site.footer.links.ssw'),      'href' => '#program'],
            ['label' => __('site.footer.links.japanese'), 'href' => '#program'],
            ['label' => __('site.footer.links.mandarin'), 'href' => '#program'],
            ['label' => __('site.footer.links.english'),  'href' => '#program'],
        ],
        __('site.footer.group_company') => [
            ['label' => __('site.footer.links.about'),   'href' => '#tentang'],
            ['label' => __('site.footer.links.process'), 'href' => '#alur'],
            ['label' => __('site.footer.links.faq'),     'href' => '#faq'],
            ['label' => __('site.footer.links.contact'), 'href' => '#kontak'],
        ],
    ];
@endphp

<footer class="on-dark border-t border-white/10 bg-navy-950 text-white">
    <div class="shell py-16 md:py-20">
        <div class="grid gap-12 md:grid-cols-12">

            {{-- Identitas --}}
            <div class="md:col-span-5">
                {{-- Kedua baris tagline sudah menyatu di dalam logo,
                     jadi tidak perlu ditulis ulang sebagai teks. --}}
                <x-logo class="h-20" />

                <p class="lede mt-6 !max-w-sm !text-[0.9375rem]">
                    {{ __('site.footer.about') }}
                </p>

                <div class="mt-7 flex items-center gap-3">
                    <a
                        href="{{ $waUrl() }}"
                        target="_blank"
                        rel="noopener"
                        class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-white/15 text-white/70 transition-colors duration-200 hover:border-gold-400/60 hover:text-gold-400"
                    >
                        <span class="sr-only">{{ __('site.a11y.wa_contact') }}</span>
                        <x-icon name="whatsapp" class="h-5 w-5" />
                    </a>

                    @if (! empty($c['instagram']))
                        <a
                            href="https://instagram.com/{{ $c['instagram'] }}"
                            target="_blank"
                            rel="noopener"
                            class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-white/15 text-white/70 transition-colors duration-200 hover:border-gold-400/60 hover:text-gold-400"
                        >
                            <span class="sr-only">{{ __('site.a11y.instagram') }}</span>
                            <x-icon name="instagram" class="h-5 w-5" />
                        </a>
                    @endif
                </div>
            </div>

            {{-- Tautan --}}
            @foreach ($footerLinks as $group => $links)
                <nav class="md:col-span-2" aria-label="{{ $group }}">
                    <h2 class="text-[0.7rem] font-semibold uppercase tracking-[0.16em] text-gold-400">
                        {{ $group }}
                    </h2>

                    <ul class="mt-4 space-y-1">
                        @foreach ($links as $link)
                            <li>
                                <a
                                    href="{{ $link['href'] }}"
                                    class="inline-block py-1.5 text-sm text-white/60 transition-colors duration-200 hover:text-white"
                                >{{ $link['label'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            @endforeach

            {{-- Kontak --}}
            <div class="md:col-span-3">
                <h2 class="text-[0.7rem] font-semibold uppercase tracking-[0.16em] text-gold-400">
                    {{ __('site.footer.group_visit') }}
                </h2>

                <address class="mt-5 space-y-4 not-italic">
                    <a
                        href="{{ $mapsUrl }}"
                        target="_blank"
                        rel="noopener"
                        class="block py-1 text-sm leading-relaxed text-white/60 transition-colors duration-200 hover:text-white"
                    >
                        {{ $c['address_line'] }}<br>
                        {{ $c['address_city'] }}
                    </a>

                    <a
                        href="{{ $waUrl() }}"
                        target="_blank"
                        rel="noopener"
                        class="block py-1 text-sm font-semibold text-white transition-colors duration-200 hover:text-gold-400"
                    >{{ $c['whatsapp_display'] }}</a>

                    @if (! empty($c['email']))
                        <a
                            href="mailto:{{ $c['email'] }}"
                            class="block py-1 text-sm text-white/60 transition-colors duration-200 hover:text-white"
                        >{{ $c['email'] }}</a>
                    @endif
                </address>
            </div>
        </div>

        <div class="hairline mt-14"></div>

        <div class="flex flex-col items-center justify-between gap-3 pt-8 sm:flex-row">
            <p class="text-xs text-white/60">
                {{ __('site.footer.rights', ['year' => date('Y')]) }}
            </p>
            <p class="text-xs text-white/60">
                {{ __('site.brand.tagline') }}
            </p>
        </div>
    </div>
</footer>
