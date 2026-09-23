<?php

use App\Support\Locales;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
| Bahasa Indonesia memakai URL akar ("/"), bahasa lain memakai awalan kode
| bahasa: /en, /ms, /ja. Tiap bahasa punya alamat sendiri supaya bisa
| dibagikan dan diindeks mesin pencari secara terpisah.
*/
Route::get('/clear-cache', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
    \Illuminate\Support\Facades\Artisan::call('view:clear');

    $publicHtml = base_path('../public_html');
    if (is_dir($publicHtml)) {
        if (is_dir(public_path('build'))) {
            \App\Providers\AppServiceProvider::copyDirectory(public_path('build'), $publicHtml . '/build');
        }
        if (is_dir(public_path('img'))) {
            \App\Providers\AppServiceProvider::copyDirectory(public_path('img'), $publicHtml . '/img');
        }
        if (file_exists(public_path('robots.txt'))) {
            @copy(public_path('robots.txt'), $publicHtml . '/robots.txt');
        }
        if (file_exists(public_path('sitemap.xml'))) {
            @copy(public_path('sitemap.xml'), $publicHtml . '/sitemap.xml');
        }
    }

    return '<h3>✅ Cache Laravel dibersihkan & aset disinkronkan ke public_html! Silakan kembali ke <a href="/">Halaman Utama</a></h3>';
});

Route::get('/robots.txt', function () {
    $path = public_path('robots.txt');
    if (! file_exists($path)) {
        abort(404);
    }

    $publicHtml = base_path('../public_html');
    if (is_dir($publicHtml)) {
        @copy($path, $publicHtml . '/robots.txt');
    }

    return response(file_get_contents($path), 200, ['Content-Type' => 'text/plain']);
});

Route::get('/sitemap.xml', function () {
    $path = public_path('sitemap.xml');
    if (! file_exists($path)) {
        abort(404);
    }

    $publicHtml = base_path('../public_html');
    if (is_dir($publicHtml)) {
        @copy($path, $publicHtml . '/sitemap.xml');
    }

    return response(file_get_contents($path), 200, ['Content-Type' => 'application/xml']);
});

// Fallback jika web server mengarahkan request gambar statis ke Laravel
Route::get('/img/{filename}', function (string $filename) {
    $path = public_path('img/' . $filename);
    if (! file_exists($path)) {
        abort(404);
    }

    $publicHtml = base_path('../public_html');
    if (is_dir($publicHtml . '/img')) {
        @copy($path, $publicHtml . '/img/' . $filename);
    }

    return response()->file($path);
})->where('filename', '.*');

Route::get('/{locale?}', function (?string $locale = null) {
    App::setLocale(Locales::resolve($locale));

    return view('landing');
})
    ->where('locale', Locales::routePattern())
    ->name('landing');
