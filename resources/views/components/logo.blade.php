@props([
    'alt' => 'Scolier',
    'simple' => true,
])

{{--
    Logo Scolier:
    - Default ($simple = false): Lambang obor + tulisan SCOLIER + kedua baris tagline
      ("Where Students Become Global" dan "Konsultan Pendidikan | Kursus Bahasa Asing").
    - Ringkas ($simple = true): Lambang obor + tulisan SCOLIER saja (tanpa tagline),
      khusus untuk header / navbar agar bersih dan terbaca jelas.

    Rasio 900 x 340 (full) atau 920 x 340 (simple). Atur tingginya saja:
        <x-logo class="h-14 md:h-16" :simple="true" />
--}}
<img
    src="{{ asset($simple ? 'img/logo-nav.png' : 'img/logo-full.png') }}"
    alt="{{ $alt }}"
    width="900"
    height="340"
    draggable="false"
    {{ $attributes->merge(['class' => 'w-auto select-none']) }}
/>
