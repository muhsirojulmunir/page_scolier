@php
    $steps = \App\Support\Content::steps();
@endphp

<section id="alur" class="surface-navy grain on-dark section-pad relative overflow-hidden">
    <div class="shell relative">
        <div class="grid gap-14 lg:grid-cols-12 lg:gap-16">

            {{-- ------- Kepala section (menempel saat digulir) ------- --}}
            <div class="lg:col-span-5">
                <div class="lg:sticky lg:top-32">
                    <span data-reveal class="section-index">{{ __('site.process_section.index') }}</span>

                    <h2 data-reveal class="display-2 text-balance-heading mt-6 text-white">
                        {{ __('site.process_section.title') }}
                        <span class="accent-italic">{{ __('site.process_section.title_accent') }}</span>
                        {{ __('site.process_section.title_end') }}
                    </h2>

                    <p data-reveal class="lede mt-6">{{ __('site.process_section.lede') }}</p>

                    <a
                        data-reveal
                        href="{{ $waUrl() }}"
                        target="_blank"
                        rel="noopener"
                        class="btn btn-primary mt-9"
                    >
                        <x-icon name="whatsapp" class="h-5 w-5" />
                        {{ __('site.process_section.cta') }}
                    </a>
                </div>
            </div>

            {{-- ------- Linimasa ------- --}}
            <div class="lg:col-span-7">
                <ol data-timeline data-reveal-group class="relative">
                    {{-- Rel abu-abu + garis emas yang mengisi seiring guliran --}}
                    <span
                        class="absolute left-[1.4375rem] top-2 bottom-2 w-px bg-white/12"
                        aria-hidden="true"
                    ></span>
                    <span
                        data-timeline-rail
                        class="absolute left-[1.4375rem] top-2 bottom-2 w-px origin-top scale-y-0 bg-gradient-to-b from-gold-400 to-gold-600"
                        aria-hidden="true"
                    ></span>

                    @foreach ($steps as $i => $step)
                        <li data-reveal class="relative flex gap-6 pb-11 last:pb-0">
                            {{-- Nomor langkah --}}
                            <span
                                class="relative z-10 flex h-[2.875rem] w-[2.875rem] shrink-0 items-center justify-center rounded-full border border-white/15 bg-navy-800 font-display text-lg font-semibold text-gold-400"
                            >
                                {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                            </span>

                            <div class="pt-1.5">
                                <h3 class="font-display text-2xl font-semibold leading-tight text-white">
                                    {{ $step['title'] }}
                                </h3>
                                <p class="mt-2.5 max-w-xl text-[0.9375rem] leading-relaxed text-white/60">
                                    {{ $step['body'] }}
                                </p>
                            </div>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</section>
