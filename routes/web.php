<?php

use App\Http\Livewire\About;
use App\Http\Livewire\Arsipkan;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Lihat;
use App\Http\Livewire\Ubah;
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

Route::get('/', Dashboard::class)->name('dash');
Route::get('/arsipkan-surat', Arsipkan::class)->name('arsipkan');
Route::get('/detail-surat/{sid}', Lihat::class)->name('detail');
Route::get('/ubah-surat/{sid}', Ubah::class)->name('ubah');
Route::get('/about', About::class)->name('about');

Route::get('/download-file-arsip/{foldname}', function ($foldname) {
    return response()->download($_SERVER['DOCUMENT_ROOT'].'/storage/file-surat/' . $foldname);
})->name('unduh');
