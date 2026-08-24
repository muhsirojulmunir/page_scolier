@php
    $faqs = \App\Support\Content::faqs();
@endphp

<section id="faq" class="section-pad bg-paper-alt">
    <div class="shell">
        <div class="grid gap-12 lg:grid-cols-12 lg:gap-16">

            <div class="lg:col-span-4">
                <div class="lg:sticky lg:top-32">
                    <span data-reveal class="section-index">{{ __('site.faq_section.index') }}</span>

                    <h2 data-reveal class="display-2 text-balance-heading mt-6">
                        {{ __('site.faq_section.title') }}
                        <span class="accent-italic">{{ __('site.faq_section.title_accent') }}</span>
                    </h2>

                    <p data-reveal class="lede mt-6">{{ __('site.faq_section.lede') }}</p>
                </div>
            </div>

            <div class="lg:col-span-8">
                <div data-reveal-group class="divide-y divide-navy-900/10 border-y border-navy-900/10">
                    @foreach ($faqs as $i => $faq)
                        <div data-reveal data-faq-item data-open="false" class="faq-item">
                            <h3>
                                <button
                                    type="button"
                                    data-faq-trigger
                                    id="faq-trigger-{{ $i }}"
                                    aria-expanded="false"
                                    aria-controls="faq-panel-{{ $i }}"
                                    class="flex w-full cursor-pointer items-start justify-between gap-6 py-6 text-left transition-colors duration-200 hover:text-gold-700"
                                >
                                    <span class="font-display text-xl font-semibold leading-snug text-navy-900 sm:text-[1.375rem]">
                                        {{ $faq['q'] }}
                                    </span>

                                    <span class="sr-only">{{ __('site.faq_section.toggle') }}</span>

                                    <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-navy-900/15 text-navy-800">
                                        <x-icon name="chevron-down" class="faq-chevron h-4 w-4" stroke="2" />
                                    </span>
                                </button>
                            </h3>

                            <div
                                id="faq-panel-{{ $i }}"
                                role="region"
                                aria-labelledby="faq-trigger-{{ $i }}"
                                class="faq-panel"
                            >
                                <div>
                                    <p class="max-w-2xl pb-7 pr-12 text-[0.9375rem] leading-relaxed text-ink-muted">
                                        {{ $faq['a'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Data terstruktur FAQ untuk hasil pencarian Google.
     Isinya dibangun di App\Support\StructuredData. --}}
@push('head')
    <script type="application/ld+json">{!! \App\Support\StructuredData::faq($faqs) !!}</script>
@endpush
