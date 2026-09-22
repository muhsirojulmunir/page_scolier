@php
    $c = config('scolier.contact');

    $mapsUrl = 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($c['maps_query']);

    $footerLinks = [
        __('site.footer.group_programs') => [
            ['label' => __('site.footer.links.ssw'),      'href' => '#layanan'],
            ['label' => __('site.footer.links.japanese'), 'href' => '#layanan'],
            ['label' => __('site.footer.links.mandarin'), 'href' => '#layanan'],
            ['label' => __('site.footer.links.korean'),   'href' => '#layanan'],
            ['label' => __('site.footer.links.english'),  'href' => '#layanan'],
        ],
        __('site.footer.group_company') => [
            ['label' => __('site.footer.links.about'),   'href' => '#tentang'],
            ['label' => __('site.nav.services'),         'href' => '#layanan'],
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
            <div class="md:col-span-4">
                {{-- Logo ringkas (tanpa tagline) — sama dengan yang di navbar --}}
                <x-logo class="h-14 md:h-16" :simple="true" />

                <p class="lede mt-6 !max-w-sm !text-[0.9375rem]">
                    {{ __('site.footer.about') }}
                </p>

                @if (! empty($c['instagram']))
                    <div class="mt-7 flex items-center gap-3">
                        <a
                            href="https://instagram.com/{{ $c['instagram'] }}"
                            target="_blank"
                            rel="noopener"
                            class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-white/15 text-white/70 transition-colors duration-200 hover:border-gold-400/60 hover:text-gold-400"
                        >
                            <span class="sr-only">{{ __('site.a11y.instagram') }}</span>
                            <x-icon name="instagram" class="h-5 w-5" />
                        </a>
                    </div>
                @endif
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

            {{-- Kontak & Barcode --}}
            <div class="md:col-span-4">
                <h2 class="text-[0.7rem] font-semibold uppercase tracking-[0.16em] text-gold-400">
                    {{ __('site.footer.group_visit') }}
                </h2>

                <div class="mt-5 flex items-start justify-between gap-4">
                    <address class="space-y-3 not-italic min-w-0 flex-1">
                        <a
                            href="{{ $mapsUrl }}"
                            target="_blank"
                            rel="noopener"
                            class="block text-sm leading-relaxed text-white/70 transition-colors duration-200 hover:text-white"
                        >
                            <span class="font-semibold text-white">Ruko Bizhome RL6-61</span><br>
                            <span>Pakuwon City, Surabaya</span><br>
                            <span>Jawa Timur, Indonesia</span>
                        </a>

                        <a
                            href="{{ $waUrl() }}"
                            target="_blank"
                            rel="noopener"
                            class="inline-block font-display text-base font-bold text-gold-400 transition-colors duration-200 hover:text-gold-300"
                        >{{ $c['whatsapp_display'] }}</a>

                        @if (! empty($c['email']))
                            <a
                                href="mailto:{{ $c['email'] }}"
                                class="block text-xs text-white/50 transition-colors duration-200 hover:text-white truncate"
                            >{{ $c['email'] }}</a>
                        @endif
                    </address>

                    {{-- Barcode / QR Code WhatsApp --}}
                    <div class="shrink-0 flex flex-col items-center">
                        <a
                            href="{{ $waUrl() }}"
                            target="_blank"
                            rel="noopener"
                            title="{{ __('site.hero.qr_sublabel') }}"
                            class="group relative block rounded-2xl bg-white p-2 shadow-xl transition-all duration-300 hover:scale-105 hover:shadow-gold-500/20"
                        >
                            <img
                                src="{{ asset('img/barcode-wa.jpeg') }}"
                                alt="QR Code WhatsApp Scolier"
                                width="100"
                                height="100"
                                class="h-20 w-20 sm:h-24 sm:w-24 object-contain rounded-xl"
                            />
                        </a>
                        <span class="mt-1.5 text-[0.65rem] font-medium tracking-wide text-white/60 text-center">
                            {{ __('site.hero.qr_label') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="hairline mt-14"></div>

        <div class="flex flex-col items-center justify-between gap-3 pt-8 sm:flex-row">
            <p class="text-xs text-white/60">
                {{ __('site.footer.rights', ['year' => date('Y')]) }}
            </p>
            <p class="text-xs text-white/60">
                {{ __('site.brand.descriptor') }}
            </p>
        </div>
    </div>
</footer>
