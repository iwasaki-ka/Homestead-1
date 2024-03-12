<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DakokuController;
use App\Http\Controllers\KinmuhyouController;
use App\Http\Controllers\KanrisyaController;
use App\Http\Controllers\SearchController;

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

Route::get('/edit_kintai/{syain_number}/{date}', [KinmuhyouController::class, 'editKintai'])->name('edit_kintai');

Route::put('/update_kintai/{syain_number}/{date}', [KinmuhyouController::class, 'updateKintai'])->name('update_kintai');

Route::get('/search/{syain_number}', [SearchController::class, 'showSearchPage'])->name('search');

Route::get('/search_result/{syain_number}', [SearchController::class, 'showResult'])->name('search_result');

Route::get('/syainjouhou/{syain_number}', [SearchController::class, 'showSyainJouhou'])->name('syainjouhou');

Route::get('/kintai_detail/{syain_number}/{year}/{month}', [SearchController::class, 'showKintaiDetail'])->name('kintai_detail');

Route::get('/edit_syain/{syain_number}', [SearchController::class, 'editSyain'])->name('edit_syain');

Route::put('/update_syain/{syain_number}', [KanrisyaController::class, 'updateSyain'])->name('update_syain');

Route::get('/newsyain', [KanrisyaController::class, 'newSyain'])->name('newsyain');

Route::post('/create_syain', [KanrisyaController::class, 'create_syain'])->name('create_syain');

Route::get('/roumusi_search/{syain_number}', [SearchController::class, 'showSearchPage'])->name('roumusi_search');

Route::get('/roumusi_search_result/{syain_number}', [SearchController::class, 'showResult'])->name('roumusi_search_result');

Route::get('/roumusi_syainjouhou/{syain_number}', [SearchController::class, 'showSyainJouhou'])->name('roumusi_syainjouhou');

Route::get('/roumusi_kintai_detail/{syain_number}/{year}/{month}', [SearchController::class, 'showKintaiDetail'])->name('roumusi_kintai_detail');

Route::post('/kinmuhyou/reset/{syain_number}/{date}', [KinmuhyouController::class, 'resetKintai'])->name('reset_kintai');

?>
