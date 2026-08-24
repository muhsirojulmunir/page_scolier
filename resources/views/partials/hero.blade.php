@php
    use App\Support\Content;

    $languages = [
        ['key' => 'japanese', 'glyph' => '日本語',  'size' => 'text-4xl'],
        ['key' => 'mandarin', 'glyph' => '中文',    'size' => 'text-4xl'],
        ['key' => 'english',  'glyph' => 'English', 'size' => 'text-3xl'],
    ];
@endphp

<section id="beranda" class="surface-navy grain on-dark relative overflow-hidden">
    <div class="grid-lines"></div>

    <div class="shell relative pb-16 pt-32 md:pb-20 md:pt-40 lg:pt-44">
        <div class="grid items-center gap-14 lg:grid-cols-12 lg:gap-10">

            {{-- ---------------- Kolom teks ---------------- --}}
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
                    {{ __('site.hero.title_2') }}<br>
                    <span class="accent-italic">{{ __('site.hero.title_accent') }}</span>
                </h1>

                <p data-hero-item class="lede mt-7">
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

            {{-- ---------------- Kartu bahasa ---------------- --}}
            <div class="hero-perspective lg:col-span-5">
                <div data-hero-cards class="relative mx-auto flex max-w-md flex-col gap-4 lg:max-w-none">
                    @foreach ($languages as $i => $lang)
                        {{-- Pembungkus menangani parallax guliran (sumbu Y), kartu di
                             dalamnya menangani kemiringan kursor (rotasi + Z). Dipisah
                             supaya keduanya tidak berebut properti transform. --}}
                        <div
                            data-hero-card
                            data-parallax="{{ [14, -6, 20][$i] }}"
                            style="margin-left: {{ [0, 1.75, 0.75][$i] }}rem"
                        >
                            <article data-tilt class="lang-card">
                                {{-- Permukaan kaca dipisah ke lapisan sendiri: elemen ber-
                                     backdrop-filter memaksa transform-style jadi flat, yang
                                     akan mematikan kedalaman anak-anaknya. --}}
                                <span class="lang-card__surface" aria-hidden="true"></span>
                                <span class="lang-card__glare" aria-hidden="true"></span>

                                <span class="lang-card__body">
                                    {{-- Kotak w-24: memuat "English" (terlebar) maupun glif
                                         CJK, yang selalu memakai font cadangan sistem. --}}
                                    <span class="lang-glyph depth-3 {{ $lang['size'] }} w-24 shrink-0 text-center">
                                        {{ $lang['glyph'] }}
                                    </span>

                                    <span class="depth-1 h-12 w-px shrink-0 bg-white/15"></span>

                                    <span class="depth-2 min-w-0">
                                        <span class="block truncate font-semibold text-white">
                                            {{ __("site.hero.languages.{$lang['key']}.name") }}
                                        </span>
                                        <span class="mt-0.5 block text-sm text-white/55">
                                            {{ __("site.hero.languages.{$lang['key']}.cert") }}
                                        </span>
                                    </span>
                                </span>
                            </article>
                        </div>
                    @endforeach

                    {{-- Catatan kecil di bawah tumpukan kartu --}}
                    <p
                        data-hero-card
                        data-parallax="30"
                        class="mt-2 flex items-center gap-2.5 pl-1 text-xs text-white/60"
                    >
                        <x-icon name="sparkle" class="h-3.5 w-3.5 shrink-0 text-gold-400" />
                        {{ __('site.hero.note') }}
                    </p>
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
