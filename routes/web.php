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
    return '<h3>✅ Cache Laravel berhasil dibersihkan! Silakan kembali ke <a href="/">Halaman Utama</a></h3>';
});

Route::get('/{locale?}', function (?string $locale = null) {
    App::setLocale(Locales::resolve($locale));

    return view('landing');
})
    ->where('locale', Locales::routePattern())
    ->name('landing');
