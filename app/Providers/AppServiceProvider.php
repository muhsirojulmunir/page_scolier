<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Otomatis sinkronkan aset build dan gambar ke public_html pada shared hosting
        $publicHtml = base_path('../public_html');
        if (is_dir($publicHtml)) {
            $srcManifest = public_path('build/manifest.json');
            $destManifest = $publicHtml . '/build/manifest.json';
            if (file_exists($srcManifest) && (! file_exists($destManifest) || filemtime($srcManifest) > filemtime($destManifest))) {
                self::copyDirectory(public_path('build'), $publicHtml . '/build');
                if (is_dir(public_path('img'))) {
                    self::copyDirectory(public_path('img'), $publicHtml . '/img');
                }
            }
        }

        /*
         * Bagikan pembuat tautan WhatsApp ke seluruh view.
         *
         * Pemakaian di Blade:
         *   {{ $waUrl() }}                      -> pesan default dari config
         *   {{ $waUrl('Halo, tanya program X') }} -> pesan khusus
         */
        View::share('waUrl', function (?string $message = null): string {
            $number = preg_replace('/\D/', '', (string) config('scolier.contact.whatsapp'));
            $text = $message ?: (string) __('site.wa.default');

            return 'https://wa.me/' . $number . '?text=' . rawurlencode($text);
        });
    }

    /**
     * Salin direktori secara rekursif.
     */
    protected static function copyDirectory(string $src, string $dest): void
    {
        if (! is_dir($src)) {
            return;
        }
        if (! is_dir($dest)) {
            @mkdir($dest, 0755, true);
        }
        $dir = @opendir($src);
        if (! $dir) {
            return;
        }
        while (($file = readdir($dir)) !== false) {
            if ($file !== '.' && $file !== '..') {
                if (is_dir($src . '/' . $file)) {
                    self::copyDirectory($src . '/' . $file, $dest . '/' . $file);
                } else {
                    @copy($src . '/' . $file, $dest . '/' . $file);
                }
            }
        }
        closedir($dir);
    }
}
