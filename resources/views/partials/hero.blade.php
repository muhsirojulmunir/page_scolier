@php
    use App\Support\Content;
@endphp

<section id="beranda" class="surface-navy grain on-dark relative overflow-hidden">
    <div class="grid-lines"></div>

    <div class="shell relative pb-16 pt-32 md:pb-20 md:pt-40 lg:pt-44">
        <div class="grid items-center gap-10 lg:grid-cols-12 lg:gap-8">

            {{-- ---------------- Kolom teks (Kiri) ---------------- --}}
            <div class="lg:col-span-7">
                <span data-hero-item class="pill">
                    <span class="relative flex h-1.5 w-1.5">
                        <span class="absolute inline-flex h-full w-full rounded-full bg-gold-400 opacity-75 motion-safe:animate-ping"></span>
                        <span class="relative inline-flex h-1.5 w-1.5 rounded-full bg-gold-400"></span>
                    </span>
                    {{ __('site.hero.badge') }}
                </span>

                <h1 data-hero-item class="display-1 mt-7 text-white">
                    {{ __('site.hero.title_1') }}<br>
                    @if (filled(__('site.hero.title_2')))
                        {{ __('site.hero.title_2') }}<br>
                    @endif
                    <span class="accent-italic">{{ __('site.hero.title_accent') }}</span>
                </h1>

                <p data-hero-item class="lede mt-7 max-w-xl">
                    {!! __('site.hero.lede', [
                        'ssw' => '<strong class="font-semibold text-white">Tokutei Ginou (SSW)</strong>',
                    ]) !!}
                </p>

                <div data-hero-item class="mt-9 flex flex-col gap-3 sm:flex-row sm:items-center">
                    <a
                        href="{{ $waUrl() }}"
                        target="_blank"
                        rel="noopener"
                        class="btn btn-primary"
                    >
                        <x-icon name="whatsapp" class="h-5 w-5" />
                        {{ __('site.hero.cta_primary') }}
                    </a>

                    <a href="#program" class="btn btn-ghost-light">
                        {{ __('site.hero.cta_secondary') }}
                        <x-icon name="arrow-right" class="h-[1.15rem] w-[1.15rem]" />
                    </a>
                </div>

                <ul data-hero-item class="mt-9 flex flex-wrap gap-x-6 gap-y-3">
                    @foreach (__('site.hero.assurances') as $item)
                        <li class="flex items-center gap-2 text-sm text-white/70">
                            <x-icon name="check" class="h-4 w-4 text-gold-400" stroke="2.2" />
                            {{ $item }}
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- ---------------- Kolom QR Code Proporsional (Kanan) ---------------- --}}
            <div data-hero-item class="flex justify-center lg:col-span-5 lg:justify-end">
                <div class="relative w-full max-w-[19rem] sm:max-w-[20rem] overflow-hidden rounded-3xl border border-white/15 bg-white/[0.04] p-6 text-center shadow-2xl backdrop-blur-xl transition-all duration-300 hover:border-gold-400/40 hover:bg-white/[0.06]">
                    {{-- Kilau latar --}}
                    <div class="pointer-events-none absolute -right-12 -top-12 h-36 w-36 rounded-full bg-gold-400/10 blur-2xl"></div>

                    {{-- QR Code Persegi Bersih & Proporsional --}}
                    <div class="flex justify-center">
                        <div class="relative rounded-2xl bg-white p-3.5 shadow-xl transition-transform duration-300 hover:scale-[1.02]">
                            <img
                                src="{{ asset('img/barcode-wa.jpeg') }}"
                                alt="QR Code WhatsApp Scolier"
                                width="200"
                                height="200"
                                class="h-44 w-44 object-contain sm:h-48 sm:w-48"
                            />
                        </div>
                    </div>

                    {{-- Jarak & Teks Panduan Proporsional --}}
                    <div class="mt-5 space-y-1.5">
                        <p class="text-sm font-semibold tracking-wide text-white">
                            {{ __('site.hero.qr_label') }}
                        </p>
                        <p class="text-xs leading-relaxed text-white/60">
                            {{ __('site.hero.qr_sublabel') }}
                        </p>
                    </div>
                </div>
            </div>

        </div>

        {{-- ---------------- Angka ringkas ---------------- --}}
        <div data-hero-item class="mt-16 md:mt-24">
            <div class="hairline"></div>

            <dl class="grid grid-cols-2 gap-x-6 gap-y-9 pt-9 md:grid-cols-4">
                @foreach (Content::stats() as $stat)
                    <div>
                        <dd
                            class="font-display text-4xl font-semibold text-gold-400 md:text-5xl"
                            data-count-to="{{ $stat['value'] }}"
                            data-count-suffix="{{ $stat['suffix'] }}"
                        >{{ $stat['value'] }}{{ $stat['suffix'] }}</dd>

                        <dt class="mt-2.5 text-sm font-semibold text-white">{{ $stat['label'] }}</dt>
                        <p class="mt-1 text-xs leading-relaxed text-white/60">{{ $stat['sub'] }}</p>
                    </div>
                @endforeach
            </dl>
        </div>
    </div>
</section>
