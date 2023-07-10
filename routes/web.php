<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", function () {
    return view('pages.home');
});

Route::get("/login", function () {
    return view('auth.login');
});

Route::get('/konsultasi', function () {
    return view('pages.konsultasi');
});

Route::get('/list-konsultasi', function () {
    return view('pages.admin.list-konsultasi');
});


Route::get("/gejala", function () {
    return view('pages.admin.gejala');
});

Route::get("/alergi", function () {
    return view('pages.admin.alergi');
});
