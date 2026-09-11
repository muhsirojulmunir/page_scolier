@php
    use App\Support\Content;
@endphp

<section id="beranda" class="surface-navy grain on-dark relative overflow-hidden">
    <div class="grid-lines"></div>

    <div class="shell relative pb-16 pt-32 md:pb-20 md:pt-40 lg:pt-44">
        <div class="max-w-3xl lg:max-w-4xl">
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

            <p data-hero-item class="lede mt-7 max-w-2xl">
                {!! __('site.hero.lede', [
                    'ssw' => '<strong class="font-semibold text-white">Tokutei Ginou (SSW)</strong>',
                ]) !!}
            </p>

            <div data-hero-item class="mt-9 flex flex-col gap-4 lg:flex-row lg:items-center">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
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

                {{-- QR Code Card (Tampil di Laptop & HP, Ukuran Lebih Besar & Mudah di-Scan) --}}
                <div class="flex w-fit items-center gap-3.5 rounded-2xl border border-white/15 bg-white/[0.05] p-2.5 pr-4 backdrop-blur-md transition-all duration-300 hover:border-gold-400/50 hover:bg-white/[0.08] shadow-lg">
                    <a
                        href="{{ $waUrl() }}"
                        target="_blank"
                        rel="noopener"
                        title="Scan atau ketuk untuk chat WhatsApp Scolier"
                        class="group relative shrink-0"
                    >
                        <img
                            src="{{ asset('img/barcode-wa.jpeg') }}"
                            alt="QR Code WhatsApp Scolier"
                            width="80"
                            height="80"
                            class="h-16 w-16 sm:h-20 sm:w-20 rounded-xl bg-white p-1.5 shadow-md transition-transform duration-200 group-hover:scale-105"
                        />
                    </a>
                    <div class="text-left">
                        <span class="flex items-center gap-1.5 text-[0.72rem] font-semibold uppercase tracking-wider text-gold-400">
                            <span class="relative flex h-2 w-2">
                                <span class="absolute inline-flex h-full w-full rounded-full bg-gold-400 opacity-75 motion-safe:animate-ping"></span>
                                <span class="relative inline-flex h-2 w-2 rounded-full bg-gold-400"></span>
                            </span>
                            Scan QR WhatsApp
                        </span>
                        <p class="mt-1 text-xs leading-relaxed text-white/80">
                            Arahkan kamera HP<br class="hidden sm:inline"> atau ketuk untuk chat
                        </p>
                    </div>
                </div>
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
