@php
    $mapsUrl = 'https://www.google.com/maps/search/?api=1&query='
        . rawurlencode(config('scolier.contact.maps_query'));
@endphp

<section id="tentang" class="section-pad surface-paper relative overflow-hidden">
    {{-- Lambang obor raksasa sebagai tekstur latar, sangat samar.
         Section ini berlatar terang sementara lambangnya putih, jadi
         `brightness-0` mengubahnya menjadi siluet gelap dulu. --}}
    <x-logo-mark
        class="pointer-events-none absolute -right-16 top-1/2 hidden h-[32rem] -translate-y-1/2 opacity-[0.05] brightness-0 lg:block"
    />

    <div class="shell relative">
        <div class="grid gap-14 lg:grid-cols-12 lg:gap-16">

            {{-- ------- Narasi ------- --}}
            <div class="lg:col-span-5">
                <span data-reveal class="section-index">{{ __('site.about.index') }}</span>

                <h2 data-reveal class="display-2 text-balance-heading mt-6">
                    {{ __('site.about.title') }}
                    <span class="accent-italic">{{ __('site.about.title_accent') }}</span>
                </h2>

                <div data-reveal class="mt-7 space-y-5">
                    <p class="lede">{{ __('site.about.body_1') }}</p>
                    <p class="lede">{{ __('site.about.body_2') }}</p>
                </div>

                {{-- Kartu alamat --}}
                <a
                    data-reveal
                    href="{{ $mapsUrl }}"
                    target="_blank"
                    rel="noopener"
                    class="card card-hover group mt-9 flex items-start gap-4 p-5"
                >
                    <span class="card-rule"></span>

                    <span class="mt-0.5 flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-navy-900 text-gold-400">
                        <x-icon name="mappin" class="h-5 w-5" />
                    </span>

                    <span class="min-w-0 flex-1">
                        <span class="block text-[0.7rem] font-semibold uppercase tracking-[0.16em] text-ink-muted">
                            {{ __('site.about.visit') }}
                        </span>
                        <span class="mt-1.5 block font-semibold leading-snug text-navy-900">
                            {{ config('scolier.contact.address_line') }}
                        </span>
                        <span class="mt-0.5 block text-sm text-ink-muted">
                            {{ config('scolier.contact.address_city') }}
                        </span>
                    </span>

                    <x-icon
                        name="arrow-up-right"
                        class="mt-1 h-5 w-5 text-ink-muted transition-transform duration-300 group-hover:-translate-y-0.5 group-hover:translate-x-0.5 group-hover:text-gold-600"
                    />
                </a>
            </div>

            {{-- ------- Empat pilar + galeri ------- --}}
            <div class="lg:col-span-7">
                <ul data-reveal-group class="grid gap-px overflow-hidden rounded-2xl bg-navy-900/10 sm:grid-cols-2">
                    @foreach (\App\Support\Content::pillars() as $pillar)
                        <li data-reveal class="group bg-paper p-7 transition-colors duration-300 hover:bg-white md:p-9">
                            <span class="flex h-12 w-12 items-center justify-center rounded-xl border border-navy-900/10 bg-white text-navy-800 transition-colors duration-300 group-hover:border-gold-500/50 group-hover:text-gold-600">
                                <x-icon name="{{ $pillar['icon'] }}" class="h-[1.35rem] w-[1.35rem]" />
                            </span>

                            <h3 class="mt-5 font-display text-2xl font-semibold leading-tight text-navy-900">
                                {{ $pillar['title'] }}
                            </h3>

                            <p class="mt-2.5 text-[0.9375rem] leading-relaxed text-ink-muted">
                                {{ $pillar['body'] }}
                            </p>
                        </li>
                    @endforeach
                </ul>

                {{-- Galeri foto. Otomatis tersembunyi bila daftarnya kosong. --}}
                @php $photos = \App\Support\Content::photos(); @endphp

                @if (! empty($photos))
                    <div data-reveal class="mt-5">
                        <p class="text-[0.7rem] font-semibold uppercase tracking-[0.16em] text-ink-muted">
                            {{ __('site.photos.title') }}
                        </p>

                        <ul class="mt-3.5 grid grid-cols-3 gap-3">
                            @foreach ($photos as $photo)
                                <li>
                                    <x-photo-tile :photo="$photo" class="aspect-[4/3] w-full rounded-xl" />
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
