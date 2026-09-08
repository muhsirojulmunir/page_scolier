@php
    $benefits = \App\Support\Content::benefits();
@endphp

<section id="keunggulan" class="section-pad bg-paper-alt relative overflow-hidden border-b border-navy-900/10">
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

        {{-- ------- Grid 4 Kartu Keuntungan & Layanan ------- --}}
        <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($benefits as $b)
                <article
                    data-reveal
                    class="card card-hover group flex flex-col justify-between p-7"
                >
                    <span class="card-rule"></span>

                    <div>
                        {{-- Badge Kategori & Ikon --}}
                        <div class="flex items-center justify-between gap-3">
                            <span class="pill !bg-gold-400/15 !border-gold-400/35 !text-gold-700 text-xs font-semibold">
                                {{ $b['badge'] ?? 'Scolier' }}
                            </span>
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-navy-900/10 bg-navy-900 text-gold-400 transition-colors duration-300 group-hover:bg-gold-500 group-hover:text-navy-950">
                                <x-icon name="{{ $b['icon'] ?? 'target' }}" class="h-5 w-5" />
                            </span>
                        </div>

                        {{-- Judul Program & Subtitle --}}
                        <h3 class="mt-6 font-display text-xl font-bold tracking-tight text-navy-950">
                            {{ $b['title'] ?? '' }}
                        </h3>

                        @if (!empty($b['subtitle']))
                            <div class="mt-1 text-xs font-semibold uppercase tracking-wider text-gold-600">
                                {{ $b['subtitle'] }}
                            </div>
                        @endif

                        {{-- Deskripsi Ringkas & Bernas --}}
                        <p class="mt-3.5 text-sm leading-relaxed text-ink-muted">
                            {{ $b['desc'] ?? '' }}
                        </p>

                        {{-- Poin-poin Keunggulan --}}
                        @if (!empty($b['highlights']))
                            <ul class="mt-5 space-y-2 border-t border-navy-900/10 pt-4">
                                @foreach ($b['highlights'] as $highlight)
                                    <li class="flex items-center gap-2 text-xs font-medium text-navy-900/80">
                                        <x-icon name="check" class="h-3.5 w-3.5 text-gold-600 shrink-0" stroke="2.2" />
                                        <span>{{ $highlight }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    {{-- Tombol Konsultasi Langsung ke WhatsApp Program Terkait --}}
                    <div class="mt-7 border-t border-navy-900/5 pt-4">
                        <a
                            href="{{ $waUrl($b['wa_text'] ?? null) }}"
                            target="_blank"
                            rel="noopener"
                            class="group/link inline-flex items-center gap-2 text-xs font-semibold tracking-wide text-navy-900 transition-colors duration-200 hover:text-gold-600"
                        >
                            <span>{{ __('site.benefits.cta_label') }}</span>
                            <x-icon name="arrow-right" class="h-3.5 w-3.5 transition-transform duration-200 group-hover/link:translate-x-1" />
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

    </div>
</section>
