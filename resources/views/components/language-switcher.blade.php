@props(['align' => 'right'])

@php
    use App\Support\Locales;

    $options = Locales::options();
    $current = Locales::meta();
    $id = 'lang-' . substr(md5(uniqid('', true)), 0, 6);
@endphp

{{--
    Pemilih bahasa. Tiap pilihan adalah tautan biasa ke URL bahasanya, jadi
    tetap berfungsi tanpa JavaScript dan bisa dibuka di tab baru. JavaScript
    hanya mengurus buka/tutup panelnya.
--}}
<div data-lang-switcher class="relative">
    <button
        type="button"
        data-lang-trigger
        aria-expanded="false"
        aria-controls="{{ $id }}"
        aria-haspopup="true"
        class="inline-flex h-11 cursor-pointer items-center gap-2 rounded-full border border-white/25 pl-2.5 pr-3 text-white transition-colors duration-200 hover:border-white/50 hover:bg-white/10"
    >
        <x-flag :code="$current['flag']" class="h-[1.375rem] w-[1.375rem]" />
        <span class="text-sm font-semibold uppercase tracking-wide">{{ Locales::current() }}</span>
        <x-icon
            name="chevron-down"
            class="lang-chevron h-3.5 w-3.5 opacity-70 transition-transform duration-300"
            stroke="2.2"
        />
        <span class="sr-only">{{ __('site.language.title') }}</span>
    </button>

    <div
        id="{{ $id }}"
        data-lang-panel
        hidden
        @class([
            'absolute top-[calc(100%+0.625rem)] z-50 w-[19rem] overflow-hidden rounded-2xl border border-navy-900/10 bg-white shadow-[0_28px_60px_-24px_rgba(7,19,34,0.55)]',
            'right-0' => $align === 'right',
            'left-0' => $align === 'left',
        ])
    >
        <div class="border-b border-navy-900/[0.08] px-5 pb-3.5 pt-4">
            <p class="font-display text-lg font-semibold leading-tight text-navy-900">
                {{ __('site.language.title') }}
            </p>
            <p class="mt-0.5 text-xs leading-relaxed text-ink-muted">
                {{ __('site.language.subtitle') }}
            </p>
        </div>

        <ul class="p-2">
            @foreach ($options as $option)
                <li>
                    <a
                        href="{{ $option['url'] }}"
                        hreflang="{{ $option['code'] }}"
                        @if ($option['active']) aria-current="true" @endif
                        @class([
                            'group flex items-center gap-3.5 rounded-xl px-3 py-2.5 transition-colors duration-150',
                            'bg-navy-900/[0.05]' => $option['active'],
                            'hover:bg-navy-900/[0.04]' => ! $option['active'],
                        ])
                    >
                        <x-flag :code="$option['flag']" class="h-6 w-6 text-navy-900" />

                        <span class="min-w-0 flex-1">
                            <span class="block truncate text-sm font-semibold text-navy-900">
                                {{ $option['country'] }}
                            </span>
                            <span class="mt-0.5 block truncate text-xs text-ink-muted">
                                {{ $option['native'] }}
                            </span>
                        </span>

                        @if ($option['active'])
                            <x-icon name="check" class="h-4 w-4 shrink-0 text-gold-700" stroke="2.6" />
                            <span class="sr-only">{{ __('site.language.current') }}</span>
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
