@props(['alt' => 'Scolier — Where Students Become Global'])

{{--
    Logo Scolier lengkap: lambang obor + tulisan SCOLIER + kedua baris tagline
    ("Where Students Become Global" dan "Konsultan Pendidikan | Kursus Bahasa
    Asing"), diambil utuh dari berkas asli dengan latar dilepas.

    Rasio 900 x 340. Atur tingginya saja — lebarnya mengikuti sendiri:
        <x-logo class="h-16" />

    Perhatikan: baris tagline hanya sekitar 12% dari tinggi logo, jadi di bawah
    tinggi ~56px tulisannya mulai tidak terbaca. Beri ruang yang cukup.

    Butuh lambangnya saja (favicon, watermark)? Pakai <x-logo-mark />.
--}}
<img
    src="{{ asset('img/logo-full.png') }}"
    alt="{{ $alt }}"
    width="900"
    height="340"
    draggable="false"
    {{ $attributes->merge(['class' => 'w-auto select-none']) }}
/>
