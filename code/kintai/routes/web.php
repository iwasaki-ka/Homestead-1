<?php

use App\Http\Controllers\LoginController;

Route::get('/', function () {return view('login');})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/login', function () {return view('login');})->name('login.get');

Route::get('/syain/{syain_number}', function ($syain_number) {return view('syain', ['syain_number' => $syain_number]);})->name('syain');

Route::get('/kanrisya/{syain_number}', function ($syain_number) { return view('kanrisya', ['syain_number' => $syain_number]);})->name('kanrisya');

Route::get('/roumusi/{syain_number}', function ($syain_number) {return view('roumusi', ['syain_number' => $syain_number]);})->name('roumusi');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

?>
