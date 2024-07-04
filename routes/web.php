<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/notify', function (Request $request) {
    echo 'notifyGet';

    echo $request;

    return $request;
});

Route::post('/notifyPost', function (Request $request) {

    echo 'notifyPost';
    echo $request;

    return $request;
});
