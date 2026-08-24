<?php

namespace App\Support;

/**
 * Membangun data terstruktur schema.org (JSON-LD) untuk landing page.
 *
 * Sengaja ditaruh di kelas PHP, bukan di dalam berkas Blade. Kunci schema.org
 * diawali "@" ('@context', '@type'), dan parser/linter Blade membaca setiap
 * token "@kata" sebagai direktif — termasuk yang berada di dalam string.
 * Di PHP biasa tidak ada penafsiran seperti itu, sekaligus logikanya keluar
 * dari lapisan tampilan.
 */
class StructuredData
{
    /** Opsi encoding yang sama untuk semua blok JSON-LD. */
    private const FLAGS = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG;

    /** Profil lembaga: alamat, kontak, dan jam operasional. */
    public static function organization(string $url): string
    {
        $contact = (array) config('scolier.contact');

        return (string) json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'EducationalOrganization',
            'name' => config('scolier.brand.name'),
            'slogan' => __('site.brand.tagline'),
            'description' => __('site.meta.schema_description'),
            'inLanguage' => Locales::meta()['html'],
            'url' => $url,
            'telephone' => $contact['whatsapp_display'] ?? null,
            'areaServed' => 'Surabaya, Indonesia',
            'openingHours' => BusinessHours::fromConfig()->schemaSpecification(),
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $contact['address_line'] ?? null,
                'addressLocality' => 'Surabaya',
                'addressRegion' => 'Jawa Timur',
                'addressCountry' => 'ID',
            ],
        ], self::FLAGS);
    }

    /**
     * Daftar tanya-jawab.
     *
     * @param  array<int, array{q: string, a: string}>  $faqs
     */
    public static function faq(array $faqs): string
    {
        return (string) json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => array_map(static fn (array $faq): array => [
                '@type' => 'Question',
                'name' => $faq['q'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $faq['a'],
                ],
            ], array_values($faqs)),
        ], self::FLAGS);
    }
}
