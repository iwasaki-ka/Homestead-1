<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DakokuController;
use App\Http\Controllers\KinmuhyouController;

Route::get('/', function () {return view('login');})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/login', function () {return view('login');})->name('login.get');

Route::get('/syain/{syain_number}', function ($syain_number) {return view('syain', ['syain_number' => $syain_number]);})->name('syain');

Route::get('/kanrisya/{syain_number}', function ($syain_number) { return view('kanrisya', ['syain_number' => $syain_number]);})->name('kanrisya');

Route::get('/roumusi/{syain_number}', function ($syain_number) {return view('roumusi', ['syain_number' => $syain_number]);})->name('roumusi');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dakoku/{syain_number}', [DakokuController::class, 'dakoku_view'])->name('dakoku');

Route::post('/dakoku', [DakokuController::class, 'syukkin'])->name('dakoku.syukkin');

Route::put('/dakoku/{syain_number}', [DakokuController::class, 'taikin'])->name('dakoku.taikin');


Route::get('/showKintai/{syain_number}', [KinmuhyouController::class, 'showKintai'])->name('showKintai');

Route::get('/kinmuhyou_detail/{syain_number}/{month}', [KinmuhyouController::class, 'kinmuhyou_detail'])->name('kinmuhyou_detail');


?>
