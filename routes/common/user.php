<?php

Route::get('/login', function () {

    $base_url = \App\Helpers\Helper::getBaseUrl();

    $services = json_decode(\App\Helpers\Helper::getServiceBaseUrl(), true);

    $settings = json_encode(\App\Helpers\Helper::getSettings());

    $base = [];

    foreach ($services as $key => $service) {
        $base[$key] = $service;
    }

    $base = json_encode($base); 

    $type = 'login';

    return view('common.user.auth.login', compact('base', 'base_url', 'settings','type'));
});

Route::get('/signup', function () {
    $base_url = \App\Helpers\Helper::getBaseUrl();

    $services = json_decode(\App\Helpers\Helper::getServiceBaseUrl(), true);

    $settings = json_encode(\App\Helpers\Helper::getSettings());

    $base = [];

    foreach ($services as $key => $service) {
        $base[$key] = $service;
    }

    $base = json_encode($base); 

    $type = 'signup';

    return view('common.user.auth.login', compact('base', 'base_url', 'settings','type'));
});

Route::get('/forgot-password', function () {
    $base_url = \App\Helpers\Helper::getBaseUrl();
    $services = json_decode(\App\Helpers\Helper::getServiceBaseUrl(), true);
    $settings = json_encode(\App\Helpers\Helper::getSettings());
    $base = [];
    foreach ($services as $key => $service) {
        $base[$key] = $service;
    }
    $base = json_encode($base); 
    return view('common.user.auth.forgot', compact('base', 'base_url', 'settings'));
});
Route::get('/reset-password', function () {
    $urlparam = ($_GET);
    $base_url = \App\Helpers\Helper::getBaseUrl();
    $services = json_decode(\App\Helpers\Helper::getServiceBaseUrl(), true);
    $settings = json_encode(\App\Helpers\Helper::getSettings());
    $base = [];
    foreach ($services as $key => $service) {
        $base[$key] = $service;
    }
    $base = json_encode($base); 
    return view('common.user.auth.reset', compact('base', 'base_url', 'settings','urlparam'));
});

Route::get('/profile/{type}', function ($type) {
   
    return view('common.user.account.profile',compact('type'));
});

Route::view('/wallet', 'common.user.account.wallet');

Route::get('/home', function () {

    $base_url = \App\Helpers\Helper::getBaseUrl();

    $services = json_decode(\App\Helpers\Helper::getServiceBaseUrl(), true);

    $settings = json_encode(\App\Helpers\Helper::getSettings());

    $base = [];

    foreach ($services as $key => $service) {
        $base[$key] = $service;
    }

    $base = json_encode($base); 

    return view('common.user.home', compact('base', 'base_url', 'settings'));
});

Route::view('/tickets', 'common.user.tickets.index');
Route::view('/closed-tickets', 'common.user.tickets.closed_index');
Route::view('/new-tickets', 'common.user.tickets.form');

Route::get('/view-tickets/{id}', function ($id) {
    return view('common.user.tickets.ticket-chat', compact('id'));
});

Route::get('/logout', function () {
    return view('common.user.auth.logout');
});
