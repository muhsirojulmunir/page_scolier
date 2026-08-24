@props(['name' => 'check', 'stroke' => 1.5])

@php
    // Ikon brand digambar dengan fill, ikon UI dengan stroke.
    $filled = in_array($name, ['whatsapp', 'instagram', 'star', 'quote'], true);
@endphp

<svg
    {{ $attributes->merge(['class' => 'shrink-0']) }}
    viewBox="0 0 24 24"
    fill="{{ $filled ? 'currentColor' : 'none' }}"
    @unless ($filled)
        stroke="currentColor"
        stroke-width="{{ $stroke }}"
        stroke-linecap="round"
        stroke-linejoin="round"
    @endunless
    aria-hidden="true"
    focusable="false"
>
    @switch($name)
        {{-- ---------- Program & nilai ---------- --}}
        @case('academic')
            <path d="M12 3 2.5 8 12 13l9.5-5L12 3Z" />
            <path d="M6 10.2V15c0 1.7 2.7 3 6 3s6-1.3 6-3v-4.8" />
            <path d="M21.5 8v5.5" />
            @break

        @case('target')
            <circle cx="12" cy="12" r="8.5" />
            <circle cx="12" cy="12" r="4.5" />
            <circle cx="12" cy="12" r="1" fill="currentColor" stroke="none" />
            @break

        @case('users')
            <path d="M15.5 20v-1.6a3.4 3.4 0 0 0-3.4-3.4H6.4A3.4 3.4 0 0 0 3 18.4V20" />
            <circle cx="9.25" cy="7.5" r="3.5" />
            <path d="M21 20v-1.6a3.4 3.4 0 0 0-2.6-3.3" />
            <path d="M15.5 4.2a3.4 3.4 0 0 1 0 6.6" />
            @break

        @case('document')
            <path d="M14 2.8H7.2A2.2 2.2 0 0 0 5 5v14a2.2 2.2 0 0 0 2.2 2.2h9.6A2.2 2.2 0 0 0 19 19V7.8L14 2.8Z" />
            <path d="M14 2.8v3.4a1.6 1.6 0 0 0 1.6 1.6H19" />
            <path d="M8.8 13h6.4M8.8 16.6h4.2" />
            @break

        @case('globe')
            <circle cx="12" cy="12" r="9" />
            <path d="M3.2 9.8h17.6M3.2 14.2h17.6" />
            <path d="M12 3c2.3 2.5 3.5 5.6 3.5 9s-1.2 6.5-3.5 9c-2.3-2.5-3.5-5.6-3.5-9S9.7 5.5 12 3Z" />
            @break

        @case('torii')
            {{-- Gerbang torii — penanda program Jepang --}}
            <path d="M3 6h18" />
            <path d="M4.4 9h15.2" />
            <path d="M6.6 9v11M17.4 9v11" />
            <path d="M6.6 12.6h10.8" />
            @break

        @case('lantern')
            {{-- Lentera — penanda program Mandarin --}}
            <path d="M12 2.6v2.2" />
            <ellipse cx="12" cy="12" rx="6.4" ry="7.2" />
            <path d="M9.4 5.4h5.2M9.4 18.6h5.2" />
            <path d="M12 4.8v14.4" />
            <path d="M12 19.8v1.6" />
            @break

        @case('chat')
            <path d="M20.2 12.4a7.6 7.6 0 0 1-8.2 7.6 8.4 8.4 0 0 1-3-.7L4 20.6l1.4-4.6a7.5 7.5 0 0 1-.9-3.6A7.6 7.6 0 0 1 12.4 4.4a7.6 7.6 0 0 1 7.8 8Z" />
            <path d="M9 11.4h6M9 14.4h3.6" />
            @break

        @case('building')
            <path d="M3.6 21h16.8" />
            <path d="M5.4 21V5.4A1.4 1.4 0 0 1 6.8 4h6.4a1.4 1.4 0 0 1 1.4 1.4V21" />
            <path d="M14.6 21V10h3.6a1.4 1.4 0 0 1 1.4 1.4V21" />
            <path d="M8.4 8h3M8.4 11.6h3M8.4 15.2h3" />
            @break

        {{-- ---------- UI ---------- --}}
        @case('arrow-right')
            <path d="M4.5 12h14.5" />
            <path d="m13.2 6 5.8 6-5.8 6" />
            @break

        @case('arrow-up-right')
            <path d="M7 17 17 7" />
            <path d="M8.4 7H17v8.6" />
            @break

        @case('chevron-down')
            <path d="m6 9.5 6 6 6-6" />
            @break

        @case('check')
            <path d="m4.8 12.6 4.6 4.6L19.2 7.4" />
            @break

        @case('check-circle')
            <circle cx="12" cy="12" r="9" />
            <path d="m8.4 12.2 2.6 2.6 4.8-5" />
            @break

        @case('menu')
            <path d="M4 7h16M4 12h16M4 17h16" />
            @break

        @case('close')
            <path d="M6 6 18 18M18 6 6 18" />
            @break

        @case('mappin')
            <path d="M19 10.4c0 5.1-7 11.1-7 11.1s-7-6-7-11.1a7 7 0 0 1 14 0Z" />
            <circle cx="12" cy="10.2" r="2.6" />
            @break

        @case('clock')
            <circle cx="12" cy="12" r="8.6" />
            <path d="M12 7.2V12l3.2 1.9" />
            @break

        {{-- ---------- Perjalanan bersama Scolier ---------- --}}
        @case('compass')
            <circle cx="12" cy="12" r="9" />
            <path d="m15.4 8.6-2 4.8-4.8 2 2-4.8z" />
            @break

        @case('heart')
            <path d="M12 20.1 4.9 13a4.4 4.4 0 0 1 6.2-6.2l.9.9.9-.9a4.4 4.4 0 1 1 6.2 6.2Z" />
            @break

        {{-- Rumah ibadah: kubah netral, tidak merujuk satu agama tertentu --}}
        @case('worship')
            <path d="M3.4 21h17.2" />
            <path d="M5.6 21v-9.4M18.4 21v-9.4" />
            <path d="M5.6 11.6a6.4 6.4 0 0 1 12.8 0" />
            <path d="M12 5.2V2.8" />
            <path d="M9.8 21v-4.4a2.2 2.2 0 0 1 4.4 0V21" />
            @break

        {{-- Bendera: penanda perwakilan negara (KJRI/KBRI) --}}
        @case('flag')
            <path d="M5.2 21.2V3" />
            <path d="M5.2 4.2h12.2l-2 3.7 2 3.7H5.2" />
            @break

        {{-- Paspor: tahap pengurusan visa --}}
        @case('passport')
            <rect x="4.6" y="2.6" width="14.8" height="18.8" rx="2.2" />
            <circle cx="12" cy="10.2" r="3.4" />
            <path d="M8.6 10.2h6.8" />
            <path d="M8.8 17.4h6.4" />
            @break

        {{-- Pesawat: tahap keberangkatan --}}
        @case('plane')
            <path d="M12 2.6c.8 0 1.4.63 1.4 1.4v4.7l7.4 4.3v2.2l-7.4-2.2v4.1l2.4 1.8v1.7L12 19.8l-3.8.8v-1.7l2.4-1.8v-4.1L3.2 15.2V13l7.4-4.3V4c0-.77.6-1.4 1.4-1.4Z" />
            @break

        @case('expand')
            <path d="M9 3.6H3.6V9" />
            <path d="M15 3.6h5.4V9" />
            <path d="M15 20.4h5.4V15" />
            <path d="M9 20.4H3.6V15" />
            @break

        @case('sparkle')
            <path d="M12 3.2 13.7 9l5.8 1.7-5.8 1.7L12 18.2 10.3 12.4 4.5 10.7 10.3 9 12 3.2Z" />
            @break

        {{-- ---------- Brand (fill) ---------- --}}
        @case('whatsapp')
            <path d="M17.47 14.38c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.96-.94 1.16-.17.2-.35.22-.65.08-.3-.15-1.26-.46-2.4-1.48-.89-.79-1.49-1.77-1.66-2.07-.17-.3-.02-.46.13-.61.14-.14.3-.35.45-.53.15-.18.2-.3.3-.5.1-.2.05-.38-.02-.53-.08-.15-.67-1.61-.92-2.2-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.79.37-.27.3-1.04 1.01-1.04 2.47s1.06 2.87 1.21 3.07c.15.2 2.1 3.2 5.08 4.49.71.3 1.26.49 1.69.63.71.22 1.36.19 1.87.12.57-.09 1.76-.72 2.01-1.41.25-.7.25-1.29.17-1.42-.07-.13-.27-.2-.57-.35Z" />
            <path d="M12.04 2.4c-5.3 0-9.6 4.3-9.6 9.6 0 1.7.44 3.34 1.29 4.79L2.4 21.6l4.95-1.3a9.56 9.56 0 0 0 4.69 1.2h.01c5.3 0 9.6-4.3 9.6-9.6a9.54 9.54 0 0 0-2.81-6.79A9.54 9.54 0 0 0 12.04 2.4Zm0 17.28h-.01a7.98 7.98 0 0 1-4.06-1.11l-.29-.17-3.02.79.81-2.94-.19-.3a7.94 7.94 0 0 1-1.22-4.25 7.98 7.98 0 1 1 7.98 7.98Z" />
            @break

        @case('instagram')
            <path d="M12 2.16c3.2 0 3.58.01 4.85.07 1.17.05 1.8.25 2.23.41.56.22.96.48 1.38.9.42.42.68.82.9 1.38.16.42.36 1.06.41 2.23.06 1.27.07 1.65.07 4.85s-.01 3.58-.07 4.85c-.05 1.17-.25 1.8-.41 2.23-.22.56-.48.96-.9 1.38-.42.42-.82.68-1.38.9-.42.16-1.06.36-2.23.41-1.27.06-1.65.07-4.85.07s-3.58-.01-4.85-.07c-1.17-.05-1.8-.25-2.23-.41a3.72 3.72 0 0 1-1.38-.9 3.72 3.72 0 0 1-.9-1.38c-.16-.42-.36-1.06-.41-2.23-.06-1.27-.07-1.65-.07-4.85s.01-3.58.07-4.85c.05-1.17.25-1.8.41-2.23.22-.56.48-.96.9-1.38.42-.42.82-.68 1.38-.9.42-.16 1.06-.36 2.23-.41 1.27-.06 1.65-.07 4.85-.07Zm0 5.68a4.16 4.16 0 1 0 0 8.32 4.16 4.16 0 0 0 0-8.32Zm0 6.86a2.7 2.7 0 1 1 0-5.4 2.7 2.7 0 0 1 0 5.4Zm5.3-7.02a.97.97 0 1 1-1.94 0 .97.97 0 0 1 1.94 0Z" />
            @break

        @case('quote')
            <path d="M9.4 5.6c-3 1.5-4.8 4-4.8 7.4v5.4h6.2v-6.2H7.5c0-2 .9-3.4 2.7-4.4l-.8-2.2Zm9.2 0c-3 1.5-4.8 4-4.8 7.4v5.4H20v-6.2h-3.3c0-2 .9-3.4 2.7-4.4l-.8-2.2Z" />
            @break

        @case('star')
            <path d="m12 3.6 2.6 5.3 5.8.85-4.2 4.1 1 5.79L12 16.9l-5.2 2.74 1-5.79-4.2-4.1 5.8-.85L12 3.6Z" />
            @break
    @endswitch
</svg>
