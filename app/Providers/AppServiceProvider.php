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
}
