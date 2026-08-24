@php
    $stages = \App\Support\Content::journey();
    $wellness = \App\Support\Content::wellness();

    // Nomor tahap yang menurunkan rincian wellness, dipakai di label panel.
    $featuredIndex = collect($stages)->search(fn ($s) => ! empty($s['featured']));
    $featuredNumber = $featuredIndex === false ? null : str_pad($featuredIndex + 1, 2, '0', STR_PAD_LEFT);

    $perRow = 3;

    /*
     * Di tablet kisinya 2 kolom. Kartu wellness selalu memakai satu baris penuh,
     * sehingga sisa kartu bisa berakhir sendirian di baris terakhir. Penempatan
     * itu disimulasikan di sini, lalu setiap baris berisi satu kartu dilebarkan
     * agar tidak ada sel menggantung — berapa pun jumlah tahapnya.
     */
    $mdSpan2 = [];
    $rows = [];
    $current = [];

    foreach ($stages as $i => $stage) {
        if (! empty($stage['featured'])) {
            if ($current) {
                $rows[] = $current;
                $current = [];
            }
            $rows[] = [$i];
            continue;
        }

        $current[] = $i;

        if (count($current) === 2) {
            $rows[] = $current;
            $current = [];
        }
    }

    if ($current) {
        $rows[] = $current;
    }

    foreach ($rows as $row) {
        if (count($row) === 1) {
            $mdSpan2[$row[0]] = true;
        }
    }
@endphp

<section id="perjalanan" class="section-pad bg-paper-alt">
    <div class="shell">

        {{-- ------- Kepala section ------- --}}
        <div class="max-w-3xl">
            <span data-reveal class="section-index">{{ __('site.journey_section.index') }}</span>

            <h2 data-reveal class="display-2 text-balance-heading mt-6">
                {{ __('site.journey_section.title') }}
                <span class="accent-italic">{{ __('site.journey_section.title_accent') }}</span>
            </h2>

            <p data-reveal class="lede mt-6">{{ __('site.journey_section.lede') }}</p>
        </div>

        {{-- ------- Enam tahap ------- --}}
        <ol data-reveal-group class="mt-14 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($stages as $i => $stage)
                @php
                    // Panah hanya di antara kartu pada baris yang sama (3 kolom),
                    // jadi tidak ada panah menunjuk ke ruang kosong di ujung baris.
                    $showArrow = ! $loop->last && ($i + 1) % $perRow !== 0;
                    $mdWide = ! empty($mdSpan2[$i]);
                @endphp

                <li
                    data-reveal
                    @class([
                        'relative flex min-w-0',
                        'md:col-span-2 lg:col-span-1' => $mdWide,
                    ])
                >
                    @if ($showArrow)
                        <span
                            class="pointer-events-none absolute -right-5 top-1/2 z-10 hidden h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full border border-navy-900/10 bg-paper-alt text-gold-600 lg:flex"
                            aria-hidden="true"
                        >
                            <x-icon name="arrow-right" class="h-4 w-4" stroke="2.2" />
                        </span>
                    @endif

                    <div
                        @class([
                            'relative flex w-full min-w-0 flex-col rounded-2xl p-7 md:p-8',
                            // Tahap wellness adalah pembeda utama, jadi dibedakan tegas.
                            'surface-navy grain on-dark' => $stage['featured'],
                            'card card-hover' => ! $stage['featured'],
                        ])
                    >
                        @unless ($stage['featured'])
                            <span class="card-rule"></span>
                        @endunless

                        <div class="flex items-center justify-between gap-4">
                            <span
                                @class([
                                    'flex h-12 w-12 shrink-0 items-center justify-center rounded-xl',
                                    'border border-white/15 bg-white/5 text-gold-400' => $stage['featured'],
                                    'bg-navy-900/[0.04] text-navy-800' => ! $stage['featured'],
                                ])
                            >
                                <x-icon name="{{ $stage['icon'] }}" class="h-[1.35rem] w-[1.35rem]" />
                            </span>

                            <span
                                @class([
                                    'font-display text-2xl font-semibold tabular-nums',
                                    'text-gold-400/70' => $stage['featured'],
                                    'text-navy-900/20' => ! $stage['featured'],
                                ])
                            >{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        </div>

                        <h3
                            @class([
                                'mt-6 font-display text-[1.6rem] font-semibold leading-tight',
                                'text-white' => $stage['featured'],
                                'text-navy-900' => ! $stage['featured'],
                            ])
                        >{{ $stage['title'] }}</h3>

                        <p
                            @class([
                                'mt-3 break-words text-[0.9375rem] leading-relaxed',
                                'text-white/70' => $stage['featured'],
                                'text-ink-muted' => ! $stage['featured'],
                            ])
                        >{{ $stage['body'] }}</p>
                    </div>
                </li>
            @endforeach
        </ol>

        {{-- ------- Rincian Student Wellness Consultancy ------- --}}
        @if (! empty($wellness))
            <div data-reveal class="card mt-5 overflow-hidden p-0">
                <div class="border-b border-navy-900/[0.08] bg-navy-900/[0.03] px-7 py-6 md:px-9">
                    <span class="pill pill-gold">
                        <x-icon name="sparkle" class="h-3.5 w-3.5" />
                        @if ($featuredNumber)
                            <span class="tabular-nums">{{ $featuredNumber }}</span>
                            <span aria-hidden="true">·</span>
                        @endif
                        {{ __('site.journey_section.wellness_title') }}
                    </span>

                    <p class="lede mt-4 !max-w-2xl !text-[0.9375rem]">
                        {{ __('site.journey_section.wellness_lede') }}
                    </p>
                </div>

                <ul data-reveal-group class="grid gap-px bg-navy-900/[0.08] sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($wellness as $item)
                        <li data-reveal class="group min-w-0 bg-white p-7 transition-colors duration-300 hover:bg-paper">
                            <span class="flex h-11 w-11 items-center justify-center rounded-full border border-navy-900/10 text-navy-800 transition-colors duration-300 group-hover:border-gold-500/50 group-hover:text-gold-600">
                                <x-icon name="{{ $item['icon'] }}" class="h-[1.15rem] w-[1.15rem]" />
                            </span>

                            <h4 class="mt-5 font-semibold leading-snug text-navy-900">
                                {{ $item['title'] }}
                            </h4>

                            <p class="mt-2 break-words text-sm leading-relaxed text-ink-muted">
                                {{ $item['body'] }}
                            </p>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</section>
