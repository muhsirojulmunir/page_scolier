@props(['alt' => ''])

{{--
    Lambang Scolier (obor di atas buku terbuka), dipotong dari berkas logo asli
    dan latarnya dilepas menjadi transparan.

    Rasio asli 368 x 588 (tegak). Atur tingginya saja lewat kelas — lebarnya
    mengikuti sendiri, jadi tidak akan gepeng:
        <x-logo-mark class="h-16" />

    Isi `alt` hanya bila lambang berdiri sendiri sebagai informasi. Bila ia
    hanya hiasan atau berdampingan dengan teks "Scolier", biarkan kosong
    supaya tidak dibacakan dua kali oleh pembaca layar.
--}}
<img
    src="{{ asset('img/logo-mark.png') }}"
    alt="{{ $alt }}"
    width="368"
    height="588"
    draggable="false"
    @if ($alt === '') aria-hidden="true" @endif
    {{ $attributes->merge(['class' => 'w-auto select-none']) }}
/>
