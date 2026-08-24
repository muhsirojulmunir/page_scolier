<?php

namespace App\Support;

/**
 * Menggabungkan struktur di config/scolier.php dengan teks di lang/{locale}/site.php.
 *
 * Config menyimpan yang sama untuk semua bahasa (ikon, angka, kanji), berkas
 * bahasa menyimpan teksnya. Kelas ini menyatukan keduanya lewat 'key' sehingga
 * view cukup memanggil satu metode dan menerima array yang sudah lengkap.
 */
class Content
{
    /** Ambil satu entri terjemahan; kembalikan array kosong bila belum ada. */
    private static function line(string $key): array
    {
        $value = __("site.{$key}");

        return is_array($value) ? $value : [];
    }

    /** Angka ringkas di bawah hero. */
    public static function stats(): array
    {
        return array_map(
            fn (array $stat) => $stat + self::line("stats.{$stat['key']}"),
            config('scolier.stats', []),
        );
    }

    /** Strip berjalan berisi sertifikasi & bidang kerja. */
    public static function marquee(): array
    {
        return array_values(self::line('marquee'));
    }

    /** Empat pilar di section Tentang. */
    public static function pillars(): array
    {
        return array_map(
            fn (array $pillar) => $pillar + self::line("pillars.{$pillar['key']}"),
            config('scolier.pillars', []),
        );
    }

    /** Daftar program, lengkap dengan bidang SSW pada program unggulan. */
    public static function programs(): array
    {
        return array_map(function (array $program) {
            $merged = $program + self::line("programs.{$program['key']}");

            if (! empty($merged['fields'])) {
                $merged['fields'] = array_map(
                    fn (array $field) => $field + ['label' => __("site.ssw_fields.{$field['key']}")],
                    $merged['fields'],
                );
            }

            return $merged;
        }, config('scolier.programs', []));
    }

    /** Lima langkah alur belajar. */
    public static function steps(): array
    {
        return array_map(
            fn (string $key) => self::line("steps.{$key}"),
            config('scolier.steps', []),
        );
    }

    /** Tiga tahap pendampingan "Perjalanan Bersama Scolier". */
    public static function journey(): array
    {
        return array_map(
            fn (array $stage) => $stage + self::line("journey.{$stage['key']}"),
            config('scolier.journey', []),
        );
    }

    /** Rincian Student Wellness Consultancy. */
    public static function wellness(): array
    {
        return array_map(
            fn (array $item) => $item + self::line("wellness.{$item['key']}"),
            config('scolier.wellness', []),
        );
    }

    /** Testimoni. Kosong bila belum diisi — section otomatis disembunyikan. */
    public static function testimonials(): array
    {
        return array_map(
            fn (array $item) => $item + self::line("testimonials.{$item['key']}"),
            config('scolier.testimonials', []),
        );
    }

    /** Daftar tanya-jawab. */
    public static function faqs(): array
    {
        return array_map(
            fn (string $key) => self::line("faqs.{$key}"),
            config('scolier.faqs', []),
        );
    }

    /**
     * Galeri foto kecil.
     *
     * Tiap entri menyertakan dua ukuran: `thumb` untuk ubin di halaman dan
     * `url` (ukuran penuh) yang baru diambil saat lightbox dibuka. Bila
     * berkas thumb belum dibuat, ukuran penuh dipakai sebagai cadangan.
     *
     * `exists` menandai berkasnya sudah ada atau belum, supaya view bisa
     * menampilkan placeholder alih-alih gambar rusak.
     *
     * @return array<int, array{key: string, file: string, exists: bool, url: ?string, thumb: ?string, caption: string}>
     */
    public static function photos(): array
    {
        return array_map(function (array $photo) {
            $relative = 'img/photos/' . $photo['file'];
            $exists = is_file(public_path($relative));

            $thumbFile = preg_replace('/(\.[a-z0-9]+)$/i', '-thumb$1', $photo['file']);
            $thumbRelative = 'img/photos/' . $thumbFile;
            $hasThumb = is_file(public_path($thumbRelative));

            return $photo + [
                'exists' => $exists,
                'url' => $exists ? asset($relative) : null,
                'thumb' => $exists ? asset($hasThumb ? $thumbRelative : $relative) : null,
                'caption' => __("site.photos.{$photo['key']}"),
            ];
        }, config('scolier.photos', []));
    }
}
