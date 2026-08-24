@php
    use App\Support\BusinessHours;

    $c = config('scolier.contact');

    $mapsQuery = rawurlencode($c['maps_query']);
    $mapsUrl   = "https://www.google.com/maps/search/?api=1&query={$mapsQuery}";
    $mapsEmbed = "https://www.google.com/maps?q={$mapsQuery}&output=embed";

    $hours = BusinessHours::fromConfig();
@endphp

<section id="kontak" class="section-pad surface-paper">
    <div class="shell">
        <div class="max-w-2xl">
            <span data-reveal class="section-index">{{ __('site.contact_section.index') }}</span>

            <h2 data-reveal class="display-2 text-balance-heading mt-6">
                {{ __('site.contact_section.title') }}
                <span class="accent-italic">{{ __('site.contact_section.title_accent') }}</span>
            </h2>
        </div>

        <div class="mt-14 grid gap-5 lg:grid-cols-12">

            {{-- ------- Kolom informasi ------- --}}
            <div data-reveal-group class="flex flex-col gap-5 lg:col-span-5">

                {{-- WhatsApp --}}
                <a
                    data-reveal
                    href="{{ $waUrl() }}"
                    target="_blank"
                    rel="noopener"
                    class="surface-navy grain group relative overflow-hidden rounded-2xl p-7 transition-transform duration-300 motion-safe:hover:-translate-y-1"
                >
                    <div class="flex items-start justify-between gap-4">
                        <span class="flex h-12 w-12 items-center justify-center rounded-full bg-gold-400 text-navy-950">
                            <x-icon name="whatsapp" class="h-6 w-6" />
                        </span>

                        <x-icon
                            name="arrow-up-right"
                            class="h-5 w-5 text-white/50 transition-transform duration-300 group-hover:-translate-y-0.5 group-hover:translate-x-0.5 group-hover:text-gold-400"
                        />
                    </div>

                    <span class="mt-6 block text-[0.7rem] font-semibold uppercase tracking-[0.16em] text-white/50">
                        {{ __('site.contact_section.wa_label') }}
                    </span>

                    {{-- Nomor telepon memakai huruf sans dengan angka tabular:
                         fungsional dan mudah dibaca, bukan serif display. --}}
                    <span class="mt-2 block text-xl font-semibold tabular-nums tracking-tight text-white sm:text-[1.375rem]">
                        {{ $c['whatsapp_display'] }}
                    </span>
                    <span class="mt-2 block text-sm text-white/55">
                        {{ __('site.contact_section.wa_note') }}
                    </span>
                </a>

                {{-- Alamat --}}
                <a
                    data-reveal
                    href="{{ $mapsUrl }}"
                    target="_blank"
                    rel="noopener"
                    class="card card-hover group p-7"
                >
                    <span class="card-rule"></span>

                    <div class="flex items-start justify-between gap-4">
                        <span class="flex h-11 w-11 items-center justify-center rounded-full border border-navy-900/10 text-navy-800 transition-colors duration-300 group-hover:border-gold-500/50 group-hover:text-gold-600">
                            <x-icon name="mappin" class="h-5 w-5" />
                        </span>

                        <x-icon
                            name="arrow-up-right"
                            class="h-5 w-5 text-ink-muted transition-transform duration-300 group-hover:-translate-y-0.5 group-hover:translate-x-0.5 group-hover:text-gold-600"
                        />
                    </div>

                    <span class="mt-6 block text-[0.7rem] font-semibold uppercase tracking-[0.16em] text-ink-muted">
                        {{ __('site.contact_section.address_label') }}
                    </span>
                    <span class="mt-1.5 block font-display text-2xl font-semibold leading-tight text-navy-900">
                        {{ $c['address_line'] }}
                    </span>
                    <span class="mt-1 block text-sm text-ink-muted">{{ $c['address_city'] }}</span>
                </a>

                {{-- Jam operasional --}}
                @if ($hours->hasSchedule())
                    @php $isOpen = $hours->isOpen(); @endphp

                    <div data-reveal data-disclosure data-open="true" class="card p-7">
                        <button
                            type="button"
                            data-disclosure-trigger
                            aria-expanded="true"
                            aria-controls="jam-operasional"
                            class="flex w-full cursor-pointer items-center justify-between gap-4 text-left"
                        >
                            <span class="flex items-center gap-3.5">
                                <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full border border-navy-900/10 text-navy-800">
                                    <x-icon name="clock" class="h-5 w-5" />
                                </span>

                                <span class="min-w-0">
                                    <span class="flex items-center gap-2 text-sm font-semibold {{ $isOpen ? 'text-open' : 'text-ink-muted' }}">
                                        @if ($isOpen)
                                            <span class="relative flex h-2 w-2 shrink-0">
                                                <span class="absolute inline-flex h-full w-full rounded-full bg-open opacity-70 motion-safe:animate-ping"></span>
                                                <span class="relative inline-flex h-2 w-2 rounded-full bg-open"></span>
                                            </span>
                                        @endif
                                        {{ $hours->statusLabel() }}
                                    </span>

                                    <span class="mt-0.5 block text-xs text-ink-muted">
                                        {{ $hours->statusDetail() }}
                                    </span>
                                </span>
                            </span>

                            <span class="sr-only">{{ __('site.hours.toggle') }}</span>

                            <x-icon
                                name="chevron-down"
                                class="disclosure-chevron h-4 w-4 shrink-0 text-ink-muted"
                                stroke="2"
                            />
                        </button>

                        <div id="jam-operasional" class="disclosure-panel">
                            <div>
                                <dl class="mt-6 space-y-2.5 border-t border-navy-900/[0.08] pt-5">
                                    @foreach ($hours->week() as $day)
                                        <div
                                            @class([
                                                'flex items-baseline justify-between gap-4 rounded-md',
                                                '-mx-2 bg-gold-100 px-2 py-1.5' => $day['isToday'],
                                            ])
                                        >
                                            <dt @class([
                                                'text-sm',
                                                'font-semibold text-navy-900' => $day['isToday'],
                                                'text-ink-muted' => ! $day['isToday'],
                                            ])>
                                                {{ $day['label'] }}
                                                @if ($day['isToday'])
                                                    <span class="ml-1 text-[0.65rem] font-semibold uppercase tracking-wider text-gold-700">
                                                        {{ __('site.hours.today') }}
                                                    </span>
                                                @endif
                                            </dt>

                                            <dd @class([
                                                'text-sm tabular-nums',
                                                'font-semibold text-navy-900' => $day['isToday'],
                                                'text-ink-muted' => ! $day['isToday'],
                                            ])>
                                                {{ $day['range'] ?? __('site.hours.closed') }}
                                            </dd>
                                        </div>
                                    @endforeach
                                </dl>

                                <p class="mt-5 text-xs leading-relaxed text-ink-muted">
                                    {{ __('site.hours.note') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- ------- Peta ------- --}}
            <div data-reveal class="lg:col-span-7">
                <div class="card h-full overflow-hidden p-0">
                    <div class="relative h-[22rem] w-full lg:h-full lg:min-h-[32rem]">
                        <iframe
                            src="{{ $mapsEmbed }}"
                            title="{{ __('site.a11y.map_title', ['address' => $c['address_line'], 'city' => $c['address_city']]) }}"
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            class="absolute inset-0 h-full w-full border-0"
                        ></iframe>
                    </div>

                    <div class="flex flex-wrap items-center justify-between gap-4 border-t border-navy-900/10 bg-white p-5">
                        <p class="text-sm text-ink-muted">
                            {{ __('site.contact_section.map_note') }}
                        </p>

                        <a
                            href="{{ $mapsUrl }}"
                            target="_blank"
                            rel="noopener"
                            class="inline-flex min-h-11 items-center gap-2 py-2 text-sm font-semibold text-navy-900 transition-colors duration-200 hover:text-gold-700"
                        >
                            {{ __('site.contact_section.map_link') }}
                            <x-icon name="arrow-up-right" class="h-4 w-4" stroke="2" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
