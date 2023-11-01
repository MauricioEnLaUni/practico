<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    /*
        I have to do this, even though it is a bad practice, otherwise I get:
            cURL error 60: SSL certificate problem: self-signed certificate in certificate chain (see https://curl.haxx.se/libcurl/c/libcurl-errors.html) for https://www.banxico.org.mx/SieAPIRest/service/v1/series/SF43718/datos/oportuno
    */
    $client = new GuzzleHttp\Client(["verify" => false]);
    $res = $client->request('GET', 'https://www.banxico.org.mx/SieAPIRest/service/v1/series/SF43718/datos/oportuno', [
        "headers" => [
            "Accept" => "application/json",
            "Bmx-Token" => "de82d2e41c639784c4b249c0a376c79d06ec72b4911de42fbf15de2023036991"
        ]
    ]);
    $data = json_decode($res->getBody())->bmx->series[0];

    return view('welcome', compact("data"));
});

Route::get('/{any?}', function ($any = null) {
    if ($any && !str_starts_with($any, 'admin')) {
        return redirect('/admin/');
    } elseif(!$any) {
        return redirect("/admin");
    }
})->where('any', '.*');
