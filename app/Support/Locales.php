<?php

namespace App\Support;

use Illuminate\Support\Facades\App;

/**
 * Daftar bahasa yang tersedia beserta cara membangun tautannya.
 *
 * Bahasa Indonesia adalah bawaan dan memakai URL akar ("/"). Bahasa lain
 * memakai awalan kode: /en, /ms, /ja. Dipisah begini supaya tiap bahasa punya
 * alamat sendiri yang bisa dibagikan dan diindeks mesin pencari.
 */
class Locales
{
    public const DEFAULT = 'id';

    /**
     * @var array<string, array{country: string, native: string, flag: string, html: string, dir: string}>
     */
    public const AVAILABLE = [
        'id' => [
            'country' => 'Indonesia',
            'native' => 'Bahasa Indonesia',
            'flag' => 'id',
            'html' => 'id-ID',
            'dir' => 'ltr',
        ],
        'en' => [
            'country' => 'United Kingdom',
            'native' => 'English',
            'flag' => 'gb',
            'html' => 'en-GB',
            'dir' => 'ltr',
        ],
        'ms' => [
            'country' => 'Malaysia',
            'native' => 'Bahasa Melayu',
            'flag' => 'my',
            'html' => 'ms-MY',
            'dir' => 'ltr',
        ],
        'ja' => [
            'country' => '日本',
            'native' => '日本語',
            'flag' => 'jp',
            'html' => 'ja-JP',
            'dir' => 'ltr',
        ],
    ];

    /** Kode bahasa selain bawaan — dipakai sebagai batasan segmen URL. */
    public static function prefixed(): array
    {
        return array_values(array_diff(array_keys(self::AVAILABLE), [self::DEFAULT]));
    }

    /** Pola untuk `->where()` pada rute, misalnya "en|ms|ja". */
    public static function routePattern(): string
    {
        return implode('|', self::prefixed());
    }

    /** Kembalikan kode yang sah; selain itu jatuh ke bawaan. */
    public static function resolve(?string $locale): string
    {
        return isset(self::AVAILABLE[$locale]) ? $locale : self::DEFAULT;
    }

    public static function current(): string
    {
        return self::resolve(App::getLocale());
    }

    /** @return array{country: string, native: string, flag: string, html: string, dir: string} */
    public static function meta(?string $locale = null): array
    {
        return self::AVAILABLE[self::resolve($locale ?? App::getLocale())];
    }

    /** Alamat halaman untuk sebuah bahasa. */
    public static function url(string $locale): string
    {
        $locale = self::resolve($locale);

        return $locale === self::DEFAULT ? url('/') : url("/{$locale}");
    }

    /**
     * Seluruh pilihan bahasa untuk komponen pemilih.
     *
     * @return array<int, array{code: string, country: string, native: string, flag: string, url: string, active: bool}>
     */
    public static function options(): array
    {
        $current = self::current();

        return array_map(
            fn (string $code) => [
                'code' => $code,
                'country' => self::AVAILABLE[$code]['country'],
                'native' => self::AVAILABLE[$code]['native'],
                'flag' => self::AVAILABLE[$code]['flag'],
                'url' => self::url($code),
                'active' => $code === $current,
            ],
            array_keys(self::AVAILABLE),
        );
    }
}
