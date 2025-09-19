<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts/{id}', function ($id) {
    return view('post');
});

Route::get('/login', function () {
    return view('user.auth.login');
})->name('login');

Route::get('user/create-post', function () {
    return view('user.create-post');
})->name('create-post');
