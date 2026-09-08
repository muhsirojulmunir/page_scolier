@php
    $benefits = \App\Support\Content::benefits();
@endphp

<section id="layanan" class="section-pad bg-paper-alt relative overflow-hidden border-b border-navy-900/10">
    <div class="shell relative">

        {{-- ------- Kepala Section ------- --}}
        <div class="max-w-3xl">
            <span data-reveal class="section-index">{{ __('site.benefits.index') }}</span>

            <h2 data-reveal class="display-2 text-balance-heading mt-6">
                {{ __('site.benefits.title') }}
                <span class="accent-italic">{{ __('site.benefits.title_accent') }}</span>
            </h2>

            <p data-reveal class="lede mt-6">{{ __('site.benefits.lede') }}</p>
        </div>

        {{-- ------- Grid 2x2 Kartu Keuntungan & Layanan (2 Atas, 2 Bawah) ------- --}}
        <div class="mt-14 grid gap-6 md:gap-8 sm:grid-cols-2 lg:grid-cols-2">
            @foreach ($benefits as $b)
                <article
                    data-reveal
                    class="card card-hover group flex flex-col justify-between p-8 md:p-10"
                >
                    <span class="card-rule"></span>

                    <div>
                        {{-- Baris Atas: Badge Kategori & Ikon --}}
                        <div class="flex items-center justify-between gap-4">
                            <span class="pill !bg-gold-400/15 !border-gold-400/35 !text-gold-700 text-xs font-semibold">
                                {{ $b['badge'] ?? 'Scolier' }}
                            </span>
                            <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl border border-navy-900/10 bg-navy-900 text-gold-400 transition-all duration-300 group-hover:bg-gold-500 group-hover:text-navy-950 group-hover:scale-105">
                                <x-icon name="{{ $b['icon'] ?? 'target' }}" class="h-6 w-6" />
                            </span>
                        </div>

                        {{-- Judul Program & Subjudul --}}
                        <div class="mt-6">
                            <h3 class="font-display text-2xl md:text-3xl font-bold tracking-tight text-navy-950">
                                {{ $b['title'] ?? '' }}
                            </h3>

                            @if (!empty($b['subtitle']))
                                <p class="mt-1 text-xs font-semibold uppercase tracking-wider text-gold-600">
                                    {{ $b['subtitle'] }}
                                </p>
                            @endif
                        </div>

                        {{-- Deskripsi Program --}}
                        <p class="mt-4 text-sm md:text-[0.9375rem] leading-relaxed text-ink-muted">
                            {{ $b['desc'] ?? '' }}
                        </p>

                        {{-- Poin-poin Keunggulan (Grid 2 Kolom di dalam Kartu) --}}
                        @if (!empty($b['highlights']))
                            <ul class="mt-6 grid gap-3 sm:grid-cols-2 border-t border-navy-900/10 pt-5">
                                @foreach ($b['highlights'] as $highlight)
                                    <li class="flex items-center gap-2.5 text-xs md:text-sm font-medium text-navy-900/85">
                                        <x-icon name="check" class="h-4 w-4 text-gold-600 shrink-0" stroke="2.2" />
                                        <span>{{ $highlight }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    {{-- Baris Bawah: Tombol Aksi Konsultasi WhatsApp --}}
                    <div class="mt-8 flex flex-wrap items-center justify-between gap-4 border-t border-navy-900/5 pt-5">
                        <span class="inline-flex items-center gap-1.5 text-xs font-medium text-ink-muted">
                            <x-icon name="sparkle" class="h-3.5 w-3.5 text-gold-500" />
                            <span>{{ __('site.hero.note') }}</span>
                        </span>

                        <a
                            href="{{ $waUrl($b['wa_text'] ?? null) }}"
                            target="_blank"
                            rel="noopener"
                            class="btn btn-outline text-xs !py-2.5 !px-5 flex items-center gap-2 group/btn"
                        >
                            <span>{{ __('site.benefits.cta_label') }}</span>
                            <x-icon name="arrow-right" class="h-3.5 w-3.5 text-gold-600 transition-transform duration-200 group-hover/btn:translate-x-1" />
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

    </div>
</section>
