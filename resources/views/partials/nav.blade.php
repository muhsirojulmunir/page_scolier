@php
    $links = [
        ['href' => '#tentang',     'label' => __('site.nav.about')],
        ['href' => '#layanan',     'label' => __('site.nav.services')],
        ['href' => '#perjalanan',  'label' => __('site.nav.journey')],
        ['href' => '#faq',         'label' => __('site.nav.faq')],
        ['href' => '#kontak',      'label' => __('site.nav.contact')],
    ];
@endphp

<header
    data-nav
    class="fixed inset-x-0 top-0 z-[210] transition-[background-color,box-shadow,backdrop-filter] duration-300"
>
    <div class="shell relative z-10">
        <nav
            aria-label="{{ __('site.a11y.main_nav') }}"
            {{-- Navbar dibuat lebih tinggi supaya logo utuh beserta kedua baris
                 tagline-nya masih terbaca. --}}
            class="flex h-20 items-center justify-between gap-4 md:h-24"
        >
            {{-- Logo --}}
            <a
                href="#beranda"
                data-nav-brand
                {{-- `shrink-0` wajib: tanpa itu flexbox memeras logo saat ruang
                     menyempit dan lockup-nya jadi gepeng, bukan mengecil. --}}
                class="-m-2 flex shrink-0 items-center rounded-lg p-2 text-white transition-colors duration-300"
                aria-label="{{ __('site.a11y.home') }}"
            >
                <x-logo class="h-14 md:h-16" :simple="true" />
            </a>

            {{-- Tautan desktop --}}
            <ul class="hidden items-center gap-1 xl:flex" data-nav-links>
                @foreach ($links as $link)
                    <li>
                        <a
                            href="{{ $link['href'] }}"
                            {{-- `whitespace-nowrap` mencegah label terlipat dua baris
                                 bila ruangnya menyempit. --}}
                            class="relative block whitespace-nowrap rounded-full px-3 py-3 text-sm font-medium text-white/75 transition-colors duration-200 hover:text-white xl:px-4"
                        >
                            <span class="relative z-10">{{ $link['label'] }}</span>
                            <span
                                data-nav-underline
                                class="absolute inset-x-3 bottom-2 h-px origin-left scale-x-0 bg-gold-400 transition-transform duration-300 ease-out xl:inset-x-4"
                            ></span>
                        </a>
                    </li>
                @endforeach
            </ul>

            {{-- Aksi --}}
            <div class="flex items-center gap-2">
                <x-language-switcher />

                <a
                    href="{{ $waUrl() }}"
                    target="_blank"
                    rel="noopener"
                    class="btn btn-primary hidden !min-h-11 !px-5 !py-2.5 text-[0.875rem] xl:inline-flex"
                >
                    {{ __('site.nav.cta') }}
                </a>

                {{-- Tombol menu mobile --}}
                <button
                    type="button"
                    data-menu-toggle
                    aria-expanded="false"
                    aria-controls="menu-mobile"
                    class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-white/25 text-white transition-colors duration-200 hover:bg-white/10 xl:hidden"
                >
                    <span class="sr-only">{{ __('site.a11y.menu_open') }}</span>
                    <x-icon name="menu" class="h-5 w-5" data-menu-icon-open />
                    <x-icon name="close" class="hidden h-5 w-5" data-menu-icon-close />
                </button>
            </div>
        </nav>
    </div>
</header>

{{--
    Panel menu mobile dipindah ke LUAR <header> agar position:fixed bekerja
    benar relatif terhadap viewport (bukan terhadap stacking context header).
    z-[200] memastikan panel di atas semua konten halaman, namun header tetap
    di z-[210] sehingga tombol hamburger/tutup selalu dapat diklik.
--}}
<div
    id="menu-mobile"
    data-menu-panel
    hidden
    class="on-dark fixed inset-0 z-[200] flex flex-col justify-between overflow-y-auto bg-navy-900 px-6 pb-10 pt-24 xl:hidden"
>
    <ul class="flex flex-col gap-1">
        @foreach ($links as $link)
            <li data-menu-item class="border-b border-white/10">
                <a
                    href="{{ $link['href'] }}"
                    class="group flex items-center justify-between gap-4 py-5 text-white"
                >
                    <span class="display-3">{{ $link['label'] }}</span>
                    <x-icon
                        name="arrow-right"
                        class="h-5 w-5 text-gold-400 transition-transform duration-300 group-hover:translate-x-1"
                    />
                </a>
            </li>
        @endforeach
    </ul>

    <div data-menu-item class="mt-10 flex flex-col gap-4">
        <a
            href="{{ $waUrl() }}"
            target="_blank"
            rel="noopener"
            class="btn btn-primary w-full"
        >
            {{ __('site.nav.cta') }}
        </a>
    </div>
</div>
