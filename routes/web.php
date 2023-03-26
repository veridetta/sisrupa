<?php

use App\Http\Controllers\admin\AparatController;
use App\Http\Controllers\admin\BlokController;
use App\Http\Controllers\admin\InformasiController;
use App\Http\Controllers\admin\JenisController;
use App\Http\Controllers\admin\JenisSuratController;
use App\Http\Controllers\admin\LaporanController;
use App\Http\Controllers\admin\LokasiController;
use App\Http\Controllers\admin\PedagangController;
use App\Http\Controllers\admin\pembayaranController;
use App\Http\Controllers\admin\PengaduanController;
use App\Http\Controllers\admin\penyewaanController;
use App\Http\Controllers\admin\PetugasController;
use App\Http\Controllers\admin\RtController;
use App\Http\Controllers\admin\RtrwController;
use App\Http\Controllers\admin\RwController;
use App\Http\Controllers\admin\SuratController;
use App\Http\Controllers\admin\TagihanController;
use App\Http\Controllers\admin\WargaController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MiscellaneousController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\kades\AparatController as KadesAparatController;
use App\Http\Controllers\kades\JenisSuratController as KadesJenisSuratController;
use App\Http\Controllers\kades\KadesController as KadesKadesController;
use App\Http\Controllers\kades\RtController as KadesRtController;
use App\Http\Controllers\kades\RtrwController as KadesRtrwController;
use App\Http\Controllers\kades\RwController as KadesRwController;
use App\Http\Controllers\kades\SuratController as KadesSuratController;
use App\Http\Controllers\kades\WargaController as KadesWargaController;
use App\Http\Controllers\KadesController;
use App\Http\Controllers\PedagangController as ControllersPedagangController;
use App\Http\Controllers\PelamarController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\warga\PengaduanController2;
use App\Http\Controllers\warga\SuratController2;
use App\Http\Controllers\warga\WargaController2;

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


// Main Page Route
Route::get('/', [Controller::class, 'dashboard'])->name('dashboard-home');
Route::get('/log', [Controller::class, 'home'])->name('dashboard-login');
Route::get('/reg', [Controller::class, 'register'])->name('dashboard-register');
Route::get('/informasi', [Controller::class, 'info'])->name('dashboard-informasi');

/* Route Pages */
Route::get('/error', [MiscellaneousController::class, 'error'])->name('error');

Route::get('redirect', [Controller::class, 'redirect'])->name('redirect');

Route::group(['middleware' => ['auth']], function() {
    // your routes
    Route::group(['prefix' => 'pedagang'], function () {
        Route::get('pedagang', [ControllersPedagangController::class, 'pedagang'])->name('pedagang-pedagang');
            Route::get('pedagang_data', [ControllersPedagangController::class, 'pedagang_data'])->name('pedagang-data-pedagang');
            Route::post('pedagang_add', [PedagangController::class, 'pedagang_add'])->name('pedagang-add-pedagang');
            Route::get('pedagang_data_single/{id}', [ControllersPedagangController::class, 'pedagang_data_single'])->name('pedagang-data-single-pedagang');
    });
    Route::group(['prefix' => 'admin'], function () {
        Route::get('info', [InformasiController::class, 'index'])->name('info-admin');
        Route::post('info_add', [InformasiController::class, 'info_add'])->name('info-add-admin');

        Route::group(['prefix' => 'd'], function () {
            //baru
            Route::get('petugas', [PetugasController::class, 'petugas'])->name('petugas-admin');
            Route::post('petugas_add', [PetugasController::class, 'petugas_add'])->name('petugas-add-admin');
            Route::get('petugas_data', [PetugasController::class, 'petugas_data'])->name('petugas-data-admin');
            Route::get('petugas_data_single/{id}', [PetugasController::class, 'petugas_data_single'])->name('petugas-data-single-admin');
            Route::get('petugas_delete/{id}', [PetugasController::class, 'petugas_delete'])->name('petugas-delete-admin');

            Route::get('pedagang', [PedagangController::class, 'pedagang'])->name('pedagang-admin');
            Route::post('pedagang_add', [PedagangController::class, 'pedagang_add'])->name('pedagang-add-admin');
            Route::get('pedagang_data', [PedagangController::class, 'pedagang_data'])->name('pedagang-data-admin');
            Route::get('pedagang_data_single/{id}', [PedagangController::class, 'pedagang_data_single'])->name('pedagang-data-single-admin');
            Route::get('pedagang_delete/{id}', [PedagangController::class, 'pedagang_delete'])->name('pedagang-delete-admin');


        });
        Route::group(['prefix' => 'm'], function () {
            //baru
            Route::get('jenis', [JenisController::class, 'jenis'])->name('jenis-admin');
            Route::post('jenis_add', [JenisController::class, 'jenis_add'])->name('jenis-add-admin');
            Route::get('jenis_data', [JenisController::class, 'jenis_data'])->name('jenis-data-admin');
            Route::get('jenis_data_single/{id}', [JenisController::class, 'jenis_data_single'])->name('jenis-data-single-admin');
            Route::get('jenis_delete/{id}', [JenisController::class, 'jenis_delete'])->name('jenis-delete-admin');

            Route::get('lokasi', [LokasiController::class, 'lokasi'])->name('lokasi-admin');
            Route::post('lokasi_add', [LokasiController::class, 'lokasi_add'])->name('lokasi-add-admin');
            Route::get('lokasi_data', [LokasiController::class, 'lokasi_data'])->name('lokasi-data-admin');
            Route::get('lokasi_data_single/{id}', [LokasiController::class, 'lokasi_data_single'])->name('lokasi-data-single-admin');
            Route::get('lokasi_delete/{id}', [LokasiController::class, 'lokasi_delete'])->name('lokasi-delete-admin');

            
            Route::get('blok', [BlokController::class, 'blok'])->name('blok-admin');
            Route::post('blok_add', [BlokController::class, 'blok_add'])->name('blok-add-admin');
            Route::get('blok_data', [BlokController::class, 'blok_data'])->name('blok-data-admin');
            Route::get('blok_data_single/{id}', [BlokController::class, 'blok_data_single'])->name('blok-data-single-admin');
            Route::get('blok_delete/{id}', [BlokController::class, 'blok_delete'])->name('blok-delete-admin');

            Route::get('tagihan', [TagihanController::class, 'tagihan'])->name('tagihan-admin');
            Route::post('tagihan_add', [TagihanController::class, 'tagihan_add'])->name('tagihan-add-admin');
            Route::get('tagihan_data', [TagihanController::class, 'tagihan_data'])->name('tagihan-data-admin');
            Route::get('tagihan_data_single/{id}', [TagihanController::class, 'tagihan_data_single'])->name('tagihan-data-single-admin');
            Route::get('tagihan_delete/{id}', [TagihanController::class, 'tagihan_delete'])->name('tagihan-delete-admin');
            
        });
        Route::group(['prefix' => 'p'], function () {
             Route::get('penyewaan', [penyewaanController::class, 'penyewaan'])->name('penyewaan-admin');
            Route::post('penyewaan_add', [penyewaanController::class, 'penyewaan_add'])->name('penyewaan-add-admin');
            Route::get('penyewaan_data', [penyewaanController::class, 'penyewaan_data'])->name('penyewaan-data-admin');
            Route::get('penyewaan_data_single/{id}', [penyewaanController::class, 'penyewaan_data_single'])->name('penyewaan-data-single-admin');
            Route::get('penyewaan_delete/{id}', [penyewaanController::class, 'penyewaan_delete'])->name('penyewaan-delete-admin');

            Route::get('pembayaran', [pembayaranController::class, 'pembayaran'])->name('pembayaran-admin');
            Route::post('pembayaran_add', [pembayaranController::class, 'pembayaran_add'])->name('pembayaran-add-admin');
            Route::get('pembayaran_data', [pembayaranController::class, 'pembayaran_data'])->name('pembayaran-data-admin');
            Route::get('pembayaran_data_single/{id}', [pembayaranController::class, 'pembayaran_data_single'])->name('pembayaran-data-single-admin');
            Route::get('pembayaran_delete/{id}', [pembayaranController::class, 'pembayaran_delete'])->name('pembayaran-delete-admin');
        });
        Route::group(['prefix' => 'l'], function () {
            Route::get('bulan/{bulan}/{tahun}', [LaporanController::class, 'bulan'])->name('bulan-admin');
            Route::get('bulan_data/{bulan}/{tahun}', [LaporanController::class, 'bulan_data'])->name('bulan-data-admin');
            Route::post('form_bulan_data', [LaporanController::class, 'bulan'])->name('bulan-form-data-admin');

            Route::get('harian/{tanggal}', [LaporanController::class, 'harian'])->name('harian-admin');
            Route::get('harian_data/{tanggal}', [LaporanController::class, 'harian_data'])->name('harian-data-admin');
            Route::post('form_harian_data', [LaporanController::class, 'harian'])->name('harian-form-data-admin');

            Route::get('kwitansi/{id}', [LaporanController::class, 'kwitansi'])->name('kwitansi-admin');
        });
    });
    //edit
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('dashboard-admin');
    Route::get('/pedagang', [ControllersPedagangController::class, 'pedagang'])->name('dashboard-pedagang');
    
});
