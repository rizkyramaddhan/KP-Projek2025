<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function(){
    return view('auth.login');
})->name('Login');

Route::post('/login', function(){

});

Route::get('/sidebar', function (){
    return view('layout.body.sidebar');
});