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
        @endswitch
    </g>

    <circle cx="12" cy="12" r="11.5" fill="none" stroke="currentColor" stroke-opacity="0.18" />
</svg>
