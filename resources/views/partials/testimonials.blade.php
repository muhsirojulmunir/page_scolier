@php
    $testimonials = \App\Support\Content::testimonials();
@endphp

@if (! empty($testimonials))
    <section id="testimoni" class="section-pad surface-paper">
        <div class="shell">
            <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
                <div class="max-w-2xl">
                    <span data-reveal class="section-index">{{ __('site.testimonials_section.index') }}</span>

                    <h2 data-reveal class="display-2 text-balance-heading mt-6">
                        {{ __('site.testimonials_section.title') }}
                        <span class="accent-italic">{{ __('site.testimonials_section.title_accent') }}</span>
                    </h2>
                </div>

                <a
                    data-reveal
                    href="{{ $waUrl() }}"
                    target="_blank"
                    rel="noopener"
                    class="btn btn-outline shrink-0"
                >
                    {{ __('site.testimonials_section.cta') }}
                    <x-icon name="arrow-right" class="h-[1.15rem] w-[1.15rem]" />
                </a>
            </div>

            <ul data-reveal-group class="mt-14 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($testimonials as $t)
                    {{-- `min-w-0` wajib: isi kartu memakai `truncate` (white-space:
                         nowrap), sehingga lebar minimum kartu ikut melar dan item
                         grid — yang bawaannya tidak boleh menyusut di bawah
                         min-content — mendorong halaman jadi lebih lebar. --}}
                    <li data-reveal class="card card-hover flex min-w-0 flex-col p-7">
                        <span class="card-rule"></span>

                        <x-icon name="quote" class="h-7 w-7 text-gold-500/45" />

                        {{-- Kutipan adalah teks bebas dari pengguna: biarkan kata
                             panjang tetap bisa dipatahkan. --}}
                        <blockquote class="mt-5 flex-1 break-words font-display text-xl leading-snug text-navy-900">
                            {{ $t['quote'] }}
                        </blockquote>

                        <figcaption class="mt-7 flex items-center gap-3.5 border-t border-navy-900/[0.08] pt-6">
                            <span
                                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-navy-900 font-display text-lg font-semibold text-gold-400"
                                aria-hidden="true"
                            >{{ $t['initial'] }}</span>

                            <span class="min-w-0">
                                <span class="block truncate text-sm font-semibold text-navy-900">{{ $t['name'] }}</span>
                                <span class="mt-0.5 block truncate text-xs text-ink-muted">{{ $t['role'] }}</span>
                            </span>
                        </figcaption>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endif
