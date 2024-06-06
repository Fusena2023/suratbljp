<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NonsuratController;
use App\Models\Karyawan;
use App\Models\Nonsurat;
use Illuminate\Auth\Events\Login;

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

Route::get('/', function () {
    // Menapilkan jumlah monitor surat
    //'lsm','bumn-swasta','k-l','sekolah','perguruantinggi','pemerintahdaerah','tni-polri'
    $jumlahsurat = Karyawan::count();
    $jumlahpemohonlsm = Karyawan::where('kriteriapemohon','lsm')->count();
    $jumlahpemohonbumn = Karyawan::where('kriteriapemohon','bumn-swasta')->count();
    $jumlahnondatasurat = Nonsurat::count();
    //compact untuk melempar data 
    return view('welcome', compact('jumlahsurat','jumlahpemohonlsm','jumlahpemohonlsm','jumlahnondatasurat'));
})->middleware('auth');

//middleware('auth'); digunakan untuk supaya orang lain tidak bisa akses ke web harus login dan balik ke route login
Route::get('/datasurat',[KaryawanController::class, 'index'])->name('datasurat')->middleware('auth');
Route::get('/nondatasurat',[NonsuratController::class, 'index'])->name('nondatasurat')->middleware('auth');

Route::get('/tambahdatasurat',[KaryawanController::class, 'tambahdatasurat'])->name('tambahdatasurat');
Route::get('/tambahnondatasurat',[NonsuratController::class, 'tambahnondatasurat'])->name('tambahnondatasurat');

Route::post('/insertdata',[KaryawanController::class, 'insertdata'])->name('insertdata');
Route::post('/insertnondatasurat',[NonsuratController::class, 'insertnondatasurat'])->name('insertnondatasurat');

Route::get('/tampilkandata/{id}',[KaryawanController::class,'tampilkandata'])->name('tampilkandata');
Route::get('/tampilkannondatasurat/{id}',[NonsuratController::class,'tampilkannondatasurat'])->name('tampilkannondatasurat');

Route::post('/updatedata/{id}',[KaryawanController::class,'updatedata'])->name('updatedata');
Route::post('/updatenondatasurat/{id}',[NonsuratController::class,'updatenondatasurat'])->name('updatenondatasurat');

Route::post('/updatedata/{id}',[KaryawanController::class,'updatedata'])->name('updatedata');
Route::post('/updatenondatasurat/{id}',[NonsuratController::class,'updatenondatasurat'])->name('updatenondatasurat');

Route::get('/delete/{id}',[KaryawanController::class,'delete'])->name('delete');
Route::get('/deletenondatasurat/{id}',[NonsuratController::class,'deletenondatasurat'])->name('deletenondatasurat');

Route::get('/login',[LoginController::class, 'login'])->name('login');
Route::post('/loginproses',[LoginController::class, 'loginproses'])->name('loginproses');

Route::get('/register',[LoginController::class, 'register'])->name('register');
Route::post('/registeruser',[LoginController::class, 'registeruser'])->name('registeruser');

Route::get('/logout',[LoginController::class, 'logout'])->name('logout');

//export pdf
// Route::get('/exportpdf',[KaryawanController::class,'exportpdf'])->name('exportpdf');

//export excel
Route::get('/exportexcel',[KaryawanController::class,'exportexcel'])->name('exportexcel');
//import excel
Route::post('/importexcel',[KaryawanController::class,'importexcel'])->name('importexcel');