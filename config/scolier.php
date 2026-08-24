<?php

/*
|--------------------------------------------------------------------------
| Data Scolier (bukan teks)
|--------------------------------------------------------------------------
|
| Berkas ini hanya memuat data yang SAMA untuk semua bahasa: kontak, jadwal,
| nama ikon, angka, dan kanji bidang SSW.
|
| Seluruh TEKS ada di lang/{id,en,ms,ja}/site.php dan dihubungkan lewat kunci
| ('key') di bawah. Dipisah begini supaya mengganti ikon atau jam operasional
| cukup di satu tempat, tidak perlu menyunting empat berkas bahasa.
|
*/

return [

    'brand' => [
        'name' => 'Scolier',
    ],

    'contact' => [
        // Nomor tampilan & nomor untuk link wa.me (hanya angka, diawali kode negara).
        'whatsapp_display' => '+62 822-4500-3028',
        'whatsapp'         => '6282245003028',

        'address_line'  => 'Ruko Bizhome, Pakuwon City Residence RL6-61',
        'address_city'  => 'Surabaya, Jawa Timur',
        'maps_query'    => 'Ruko Bizhome Pakuwon City Residence RL6-61 Surabaya',

        /*
        |----------------------------------------------------------------
        | Jam operasional
        |----------------------------------------------------------------
        | Isi tiap hari dengan ['jam buka', 'jam tutup'] format 24 jam,
        | atau `null` bila tutup. Status "Buka sekarang" dihitung otomatis
        | dari data ini memakai zona waktu di bawah.
        | Catatan di bawah jadwal ada di lang/{locale}/site.php -> hours.note
        */
        'hours' => [
            'timezone' => 'Asia/Jakarta',

            'schedule' => [
                'Mon' => ['09:00', '20:00'],
                'Tue' => ['09:00', '20:00'],
                'Wed' => ['09:00', '20:00'],
                'Thu' => ['09:00', '20:00'],
                'Fri' => ['09:00', '20:00'],
                'Sat' => null,
                'Sun' => null,
            ],
        ],

        // TODO: isi username Instagram Scolier (tanpa @). Kosongkan bila belum ada.
        'instagram' => '',
        'email'     => '',
    ],

    /*
    |--------------------------------------------------------------------------
    | Angka ringkas di bawah hero
    |--------------------------------------------------------------------------
    | Label & keterangannya ada di lang/{locale}/site.php -> stats
    */
    'stats' => [
        ['key' => 'languages', 'value' => 3, 'suffix' => ''],
        ['key' => 'programs',  'value' => 6, 'suffix' => ''],
        ['key' => 'tracks',    'value' => 2, 'suffix' => ''],
        ['key' => 'personal',  'value' => 1, 'suffix' => ':1'],
    ],

    // Empat pilar di section Tentang. Judul & isinya di lang/{locale}/site.php -> pillars
    'pillars' => [
        ['key' => 'teachers',  'icon' => 'academic'],
        ['key' => 'curriculum', 'icon' => 'target'],
        ['key' => 'small_class', 'icon' => 'users'],
        ['key' => 'guidance',  'icon' => 'document'],
    ],

    // Program. Teksnya di lang/{locale}/site.php -> programs
    'programs' => [
        [
            'key' => 'ssw',
            'icon' => 'globe',
            'featured' => true,

            // Bidang kerja SSW. Kanji & romaji sama di semua bahasa;
            // keterangannya di lang/{locale}/site.php -> ssw_fields
            'fields' => [
                ['key' => 'kaigo',    'jp' => '介護',       'romaji' => 'Kaigo'],
                ['key' => 'gaishoku', 'jp' => '外食業',     'romaji' => 'Gaishokugyo'],
                ['key' => 'shokuhin', 'jp' => '食料品製造', 'romaji' => 'Shokuhin'],
                ['key' => 'nougyou',  'jp' => '農業',       'romaji' => 'Nougyou'],
                ['key' => 'kensetsu', 'jp' => '建設',       'romaji' => 'Kensetsu'],
            ],
        ],
        ['key' => 'japanese', 'icon' => 'torii',    'featured' => false],
        ['key' => 'mandarin', 'icon' => 'lantern',  'featured' => false],
        ['key' => 'english',  'icon' => 'chat',     'featured' => false],
        ['key' => 'study',    'icon' => 'building', 'featured' => false],
        ['key' => 'visa',     'icon' => 'document', 'featured' => false],
    ],

    // Lima langkah alur belajar. Teksnya di lang/{locale}/site.php -> steps
    'steps' => ['consult', 'placement', 'class', 'exam', 'departure'],

    /*
    |--------------------------------------------------------------------------
    | Perjalanan Bersama Scolier
    |--------------------------------------------------------------------------
    | Tiga tahap pendampingan. Tahap bertanda 'featured' ditonjolkan dan
    | menurunkan daftar 'wellness' di bawahnya.
    | Teksnya di lang/{locale}/site.php -> journey & wellness
    */
    'journey' => [
        ['key' => 'academic',  'icon' => 'compass',  'featured' => false],
        ['key' => 'documents', 'icon' => 'document', 'featured' => false],
        ['key' => 'wellness',  'icon' => 'heart',    'featured' => true],
        ['key' => 'visa',      'icon' => 'passport', 'featured' => false],
        ['key' => 'departure', 'icon' => 'plane',    'featured' => false],
        ['key' => 'keeptouch', 'icon' => 'chat',     'featured' => false],
    ],

    // Rincian Student Wellness Consultancy — layanan setelah tiba di negara tujuan.
    'wellness' => [
        ['key' => 'alumni',    'icon' => 'academic'],
        ['key' => 'community', 'icon' => 'users'],
        ['key' => 'worship',   'icon' => 'worship'],
        ['key' => 'consulate', 'icon' => 'flag'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Testimoni
    |--------------------------------------------------------------------------
    | PENTING: isi di lang/{locale}/site.php masih CONTOH STRUKTUR, bukan testimoni asli.
    | TODO: ganti dengan testimoni nyata beserta izin publikasinya sebelum tayang.
    | Kosongkan array ini untuk menyembunyikan seluruh section testimoni.
    */
    'testimonials' => [
        ['key' => 'one',   'initial' => 'R'],
        ['key' => 'two',   'initial' => 'A'],
        ['key' => 'three', 'initial' => 'B'],
    ],

    // Jumlah pertanyaan di section FAQ. Teksnya di lang/{locale}/site.php -> faqs
    'faqs' => ['beginner', 'ssw', 'duration', 'format', 'campus', 'cost'],

    /*
    |--------------------------------------------------------------------------
    | Galeri foto kecil (section Tentang)
    |--------------------------------------------------------------------------
    | Simpan foto di public/img/photos/ lalu tulis nama berkasnya di 'file'.
    | Rasio yang paling pas 4:3, ukuran minimal 800x600.
    |
    | Selama berkasnya belum ada, kotaknya tampil sebagai placeholder berbrand
    | supaya jelas masih menunggu foto — tidak ada gambar rusak.
    | Kosongkan array ini untuk menyembunyikan galerinya sama sekali.
    |
    | Keterangan tiap foto ada di lang/{locale}/site.php -> photos
    */
    'photos' => [
        ['key' => 'class',    'file' => 'kelas.jpg'],
        ['key' => 'teaching', 'file' => 'pengajar.jpg'],
        ['key' => 'office',   'file' => 'kantor.jpg'],
    ],

];
