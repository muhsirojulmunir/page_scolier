@php
    $programs = collect(\App\Support\Content::programs());
    $featured = $programs->firstWhere('featured', true) ?? $programs->first();
    $rest = $programs->reject(fn($p) => $p === $featured)->values();
@endphp

<section id="program" class="section-pad bg-paper-alt">
    <div class="shell">

        {{-- ------- Kepala section ------- --}}
        <div class="max-w-3xl">
            <span data-reveal class="section-index">{{ __('site.programs_section.index') }}</span>

            <h2 data-reveal class="display-2 text-balance-heading mt-6">
                {{ __('site.programs_section.title') }}
                <span class="accent-italic">{{ __('site.programs_section.title_accent') }}</span>
            </h2>

            <p data-reveal class="lede mt-6">{{ __('site.programs_section.lede') }}</p>
        </div>

        {{-- ------- Kartu unggulan: bentang penuh, dua panel ------- --}}
        <article data-reveal
            class="surface-navy grain on-dark relative mt-14 grid overflow-hidden rounded-2xl lg:grid-cols-5">
            {{-- Panel kiri: penjelasan program --}}
            <div class="p-8 md:p-10 lg:col-span-3 lg:p-12">
                <span class="pill !border-gold-400/40 !bg-gold-400/15 !text-gold-300">
                    <x-icon name="sparkle" class="h-3.5 w-3.5" />
                    {{ $featured['kicker'] }}
                </span>

                <div class="mt-7 flex items-start gap-5">
                    <span
                        class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl border border-white/15 bg-white/5 text-gold-400">
                        <x-icon name="{{ $featured['icon'] }}" class="h-6 w-6" />
                    </span>

                    <h3 class="display-2 !text-[clamp(1.875rem,3.2vw,2.75rem)] text-white">
                        {{ $featured['title'] }}
                    </h3>
                </div>

                <p class="lede mt-5 max-w-xl">{{ $featured['body'] }}</p>

                <ul class="mt-7 grid gap-3 sm:grid-cols-2">
                    @foreach ($featured['points'] as $point)
                        <li class="flex items-start gap-2.5 text-sm text-white/75">
                            <x-icon name="check-circle" class="mt-px h-[1.15rem] w-[1.15rem] shrink-0 text-gold-400" />
                            {{ $point }}
                        </li>
                    @endforeach
                </ul>

                <a href="{{ $waUrl(__('site.wa.program', ['program' => $featured['title']])) }}" target="_blank"
                    rel="noopener" class="btn btn-primary mt-9">
                    <x-icon name="whatsapp" class="h-[1.15rem] w-[1.15rem]" />
                    {{ __('site.programs_section.ask') }}
                </a>
            </div>

            {{-- Panel kanan: bidang kerja SSW --}}
            @if (!empty($featured['fields']))
                <div
                    class="border-t border-white/10 bg-white/[0.04] p-8 md:p-10 lg:col-span-2 lg:border-l lg:border-t-0 lg:p-12">
                    <h4 class="text-[0.7rem] font-semibold uppercase tracking-[0.16em] text-gold-400">
                        {{ __('site.programs_section.fields_title') }}
                    </h4>

                    <ul class="mt-6 space-y-4">
                        @foreach ($featured['fields'] as $field)
                            <li class="flex items-baseline gap-4 border-b border-white/10 pb-4 last:border-0 last:pb-0">
                                <span class="font-display w-28 shrink-0 whitespace-nowrap text-lg leading-none text-gold-400">
                                    {{ $field['jp'] }}
                                </span>

                                <span class="min-w-0">
                                    <span class="block text-sm font-semibold text-white">{{ $field['romaji'] }}</span>
                                    <span class="mt-0.5 block text-xs text-white/60">{{ $field['label'] }}</span>
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </article>

        {{-- ------- Program Bahasa Lainnya (4 Bahasa Utama) ------- --}}
        <div data-reveal-group class="mt-6 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($rest as $program)
                <article data-reveal
                    class="card card-hover group flex flex-col justify-between p-7">
                    <span class="card-rule"></span>

                    <div>
                        <div class="flex items-start justify-between gap-4">
                            <span
                                class="flex h-12 w-12 items-center justify-center rounded-xl bg-navy-900/[0.04] text-navy-800 transition-colors duration-300 group-hover:bg-navy-900 group-hover:text-gold-400">
                                <x-icon name="{{ $program['icon'] }}" class="h-[1.35rem] w-[1.35rem]" />
                            </span>

                            <span class="text-[0.65rem] font-semibold uppercase tracking-[0.14em] text-ink-muted/70">
                                {{ $program['kicker'] }}
                            </span>
                        </div>

                        <div class="mt-6">
                            <h3 class="font-display text-2xl font-semibold leading-tight text-navy-900">
                                {{ $program['title'] }}
                            </h3>

                            <p class="mt-3 text-sm leading-relaxed text-ink-muted">
                                {{ $program['body'] }}
                            </p>
                        </div>

                        <ul class="mt-6 space-y-2.5 border-t border-navy-900/[0.08] pt-5">
                            @foreach ($program['points'] as $point)
                                <li class="flex items-start gap-2 text-xs md:text-sm text-ink-muted">
                                    <x-icon name="check" class="mt-0.5 h-3.5 w-3.5 shrink-0 text-gold-600" stroke="2.5" />
                                    <span>{{ $point }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <a href="{{ $waUrl(__('site.wa.program', ['program' => $program['title']])) }}" target="_blank"
                        rel="noopener"
                        class="mt-6 inline-flex min-h-11 items-center gap-2 self-start rounded-full py-2 text-sm font-semibold text-navy-900 transition-colors duration-200 hover:text-gold-700">
                        {{ __('site.programs_section.ask') }}
                        <x-icon name="arrow-right"
                            class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" stroke="2" />
                    </a>
                </article>
            @endforeach
        </div>
    </div>
</section>