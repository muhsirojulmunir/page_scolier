<section class="surface-navy grain on-dark relative overflow-hidden">
    <div class="grid-lines"></div>

    <div class="shell relative py-20 md:py-28">
        <div class="mx-auto max-w-3xl text-center">
            <x-logo data-reveal class="mx-auto h-24" />

            <h2 data-reveal class="display-2 text-balance-heading mt-8 text-white">
                {{ __('site.cta_section.title') }}
                <span class="accent-italic">{{ __('site.cta_section.title_accent') }}</span>
            </h2>

            <p data-reveal class="lede mx-auto mt-6 !max-w-xl">
                {{ __('site.cta_section.lede') }}
            </p>

            <div data-reveal class="mt-10 flex flex-col items-center justify-center gap-3 sm:flex-row">
                <a
                    href="{{ $waUrl() }}"
                    target="_blank"
                    rel="noopener"
                    class="btn btn-primary w-full sm:w-auto"
                >
                    <x-icon name="whatsapp" class="h-5 w-5" />
                    {{ __('site.cta_section.primary') }}
                </a>

                <a href="#program" class="btn btn-ghost-light w-full sm:w-auto">
                    {{ __('site.cta_section.secondary') }}
                </a>
            </div>

            <p data-reveal class="mt-7 text-sm text-white/60">
                {{ __('site.cta_section.note', ['phone' => config('scolier.contact.whatsapp_display')]) }}
            </p>
        </div>
    </div>
</section>
