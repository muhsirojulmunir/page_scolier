@props(['code' => 'id'])

@php
    // Setiap instans butuh id mask sendiri, kalau tidak semua bendera di halaman
    // akan memakai mask milik yang pertama.
    $uid = 'flag-' . $code . '-' . substr(md5(uniqid('', true)), 0, 6);
@endphp

{{--
    Bendera bulat sebagai SVG, bukan emoji: Windows tidak punya glif bendera
    sehingga emoji bendera hanya tampil sebagai dua huruf ("ID", "GB").
--}}
<svg
    viewBox="0 0 24 24"
    {{ $attributes->merge(['class' => 'h-5 w-5 shrink-0']) }}
    aria-hidden="true"
    focusable="false"
>
    <defs>
        <clipPath id="{{ $uid }}">
            <circle cx="12" cy="12" r="12" />
        </clipPath>
    </defs>

    <g clip-path="url(#{{ $uid }})">
        @switch($code)
            {{-- Indonesia: merah di atas, putih di bawah --}}
            @case('id')
                <rect width="24" height="12" fill="#E70011" />
                <rect y="12" width="24" height="12" fill="#ffffff" />
                @break

            {{-- Britania Raya: Union Jack --}}
            @case('gb')
                <rect width="24" height="24" fill="#012169" />
                <path d="M0 0 L24 24 M24 0 L0 24" stroke="#ffffff" stroke-width="5" />
                <path d="M0 0 L24 24 M24 0 L0 24" stroke="#C8102E" stroke-width="2.6" />
                <path d="M12 0 V24 M0 12 H24" stroke="#ffffff" stroke-width="8" />
                <path d="M12 0 V24 M0 12 H24" stroke="#C8102E" stroke-width="4.6" />
                @break

            {{-- Malaysia: 14 jalur, kanton biru, bulan sabit & bintang kuning --}}
            @case('my')
                <rect width="24" height="24" fill="#ffffff" />
                @for ($i = 0; $i < 7; $i++)
                    <rect y="{{ $i * 24 / 7 }}" width="24" height="{{ 24 / 14 }}" fill="#CC0001" />
                @endfor
                <rect width="13.5" height="{{ 24 / 14 * 7 }}" fill="#010066" />
                <circle cx="6.4" cy="5.6" r="3.5" fill="#FFCC00" />
                <circle cx="7.7" cy="5.2" r="3.1" fill="#010066" />
                <path
                    d="M10.9 3.1 11.5 4.9 13.4 4.9 11.9 6 12.4 7.8 10.9 6.7 9.4 7.8 9.9 6 8.4 4.9 10.3 4.9 Z"
                    fill="#FFCC00"
                />
                @break

            {{-- Jepang: cakram merah di atas putih --}}
            @case('jp')
                <rect width="24" height="24" fill="#ffffff" />
                <circle cx="12" cy="12" r="7.2" fill="#BC002D" />
                @break

            {{-- Tiongkok / China: Merah dengan 5 bintang kuning --}}
            @case('cn')
                <rect width="24" height="24" fill="#DE2910" />
                {{-- Bintang utama --}}
                <polygon points="5.5,2 6.4,4.8 9.4,4.8 7,6.5 7.9,9.3 5.5,7.6 3.1,9.3 4,6.5 1.6,4.8 4.6,4.8" fill="#FFDE00" />
                {{-- 4 Bintang pendamping --}}
                <polygon points="10.5,1.5 10.9,2.7 12.1,2.7 11.1,3.4 11.5,4.5 10.5,3.8 9.5,4.5 9.9,3.4 8.9,2.7 10.1,2.7" transform="scale(0.8) translate(3, 0)" fill="#FFDE00" />
                <polygon points="12.5,3.5 12.9,4.7 14.1,4.7 13.1,5.4 13.5,6.5 12.5,5.8 11.5,6.5 11.9,5.4 10.9,4.7 12.1,4.7" transform="scale(0.8) translate(3, 1)" fill="#FFDE00" />
                <polygon points="12.5,7 12.9,8.2 14.1,8.2 13.1,8.9 13.5,10 12.5,9.3 11.5,10 11.9,8.9 10.9,8.2 12.1,8.2" transform="scale(0.8) translate(3, 2.5)" fill="#FFDE00" />
                <polygon points="10.5,9.5 10.9,10.7 12.1,10.7 11.1,11.4 11.5,12.5 10.5,11.8 9.5,12.5 9.9,11.4 8.9,10.7 10.1,10.7" transform="scale(0.8) translate(3, 3.5)" fill="#FFDE00" />
                @break

            {{-- Korea Selatan: Taegeukgi --}}
            @case('kr')
                <rect width="24" height="24" fill="#FFFFFF" />
                {{-- Taegeuk (Yin-Yang) --}}
                <g transform="rotate(-34 12 12)">
                    <path d="M12 6 A6 6 0 0 1 12 18 A3 3 0 0 1 12 12 A3 3 0 0 0 12 6" fill="#CD2E3A" />
                    <path d="M12 18 A6 6 0 0 1 12 6 A3 3 0 0 1 12 12 A3 3 0 0 0 12 18" fill="#0047A0" />
                </g>
                {{-- 4 Trigrams hitam sederhana di 4 sudut --}}
                <g fill="#000000">
                    {{-- Kiri Atas (Geon) --}}
                    <rect x="3" y="4" width="4.5" height="0.9" transform="rotate(45 5.25 4.5)" />
                    <rect x="3" y="5.5" width="4.5" height="0.9" transform="rotate(45 5.25 6)" />
                    <rect x="3" y="7" width="4.5" height="0.9" transform="rotate(45 5.25 7.5)" />
                    {{-- Kanan Bawah (Gon) --}}
                    <rect x="16.5" y="16" width="2" height="0.9" transform="rotate(45 18.75 16.5)" />
                    <rect x="19" y="16" width="2" height="0.9" transform="rotate(45 18.75 16.5)" />
                    <rect x="16.5" y="17.5" width="2" height="0.9" transform="rotate(45 18.75 18)" />
                    <rect x="19" y="17.5" width="2" height="0.9" transform="rotate(45 18.75 18)" />
                    <rect x="16.5" y="19" width="2" height="0.9" transform="rotate(45 18.75 19.5)" />
                    <rect x="19" y="19" width="2" height="0.9" transform="rotate(45 18.75 19.5)" />
                    {{-- Kanan Atas (Gam) --}}
                    <rect x="16.5" y="5.5" width="4.5" height="0.9" transform="rotate(-45 18.75 6)" />
                    <rect x="16.5" y="4" width="2" height="0.9" transform="rotate(-45 18.75 4.5)" />
                    <rect x="19" y="4" width="2" height="0.9" transform="rotate(-45 18.75 4.5)" />
                    <rect x="16.5" y="7" width="2" height="0.9" transform="rotate(-45 18.75 7.5)" />
                    <rect x="19" y="7" width="2" height="0.9" transform="rotate(-45 18.75 7.5)" />
                    {{-- Kiri Bawah (Ri) --}}
                    <rect x="3" y="16" width="4.5" height="0.9" transform="rotate(-45 5.25 16.5)" />
                    <rect x="3" y="17.5" width="2" height="0.9" transform="rotate(-45 5.25 18)" />
                    <rect x="5.5" y="17.5" width="2" height="0.9" transform="rotate(-45 5.25 18)" />
                    <rect x="3" y="19" width="4.5" height="0.9" transform="rotate(-45 5.25 19.5)" />
                </g>
                @break
        @endswitch
    </g>

    <circle cx="12" cy="12" r="11.5" fill="none" stroke="currentColor" stroke-opacity="0.18" />
</svg>
