<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\Barang2Controller;
use App\Http\Controllers\BarangPdfController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoggingController;
use App\Http\Controllers\PenggunaanBarangController;
use App\Http\Controllers\PenjemputanController;
use App\Http\Controllers\PenjemputanPdfController;
use App\Http\Controllers\SimulasiController;
use App\Http\Controllers\TransaksiController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix('/admin')->group(function(){
        Route::middleware('level:admin,kasir,owner')->group(function () {
            Route::get('/', [DashboardController::class, 'index']);
            Route::resource('/barang', BarangController::class);
            Route::post('/barang/status',[BarangController::class, 'updateStatus'])->name('Barangstatus');
            Route::get('/Barang/export/excel', [BarangController::class , 'exportExcel'])->name('excelBarang');
            Route::post('/barang/import/excel', [BarangController::class , 'importExcel'])->name('importBarang');
            Route::get('/barang/download/template',[BarangController::class, 'templateExcel'])->name('downloadBarang');
            Route::get('/barang/export/pdf/', [BarangPdfController::class, 'exportBarangPDF'])->name('BarangPdf');
            Route::resource('/barang2', Barang2Controller::class);

            Route::resource('/penjemputan', PenjemputanController::class);

            Route::get('/transaksi/{transaksi}/invoice', [TransaksiController::class , 'invoice'])->name('TransaksiInvoice');
            Route::get('/paket/export/excel', [PaketController::class , 'exportExcel'])->name('excelpaket');
            Route::post('/paket/import/excel', [PaketController::class , 'importExcel'])->name('importpaket');
            Route::get('/paket/download/template',[PaketController::class, 'templateExcel'])->name('downloadpaket');
            Route::get('/paket/export/pdf/', [PaketController::class, 'exportPaketPDF'])->name('paketPdf');

            Route::get('/outlet/export/excel', [OutletController::class , 'exportExcel'])->name('exceloutlet');
            Route::post('/outlet/import/excel', [OutletController::class , 'importExcel'])->name('importoutlet');
            Route::get('/outlet/download/template',[OutletController::class, 'templateExcel'])->name('downloadoutlet');
            Route::get('/outlet/export/pdf/', [OutletController::class, 'exportOutletPDF'])->name('outletPdf');


            Route::post('/status',[PenjemputanController::class, 'updateStatus'])->name('status');
            Route::get('/penjemputan/export/excel', [PenjemputanController::class , 'exportExcel'])->name('excelpenjemputan');
            Route::post('/penjemputan/import/excel', [PenjemputanController::class , 'importExcel'])->name('importPenjemputan');
            Route::get('/penjemputan/download/template',[PenjemputanController::class, 'templateExcel'])->name('downloadPenjemputan');
            Route::get('/penjemputan/export/pdf/', [PenjemputanPdfController::class, 'exportPenjemputanPDF'])->name('penjemputanPdf');

            Route::get('/member/export/excel', [MemberController::class , 'exportExcel'])->name('excelmember');
            Route::post('/member/import/excel', [MemberController::class , 'importExcel'])->name('importmember');
            Route::get('/member/download/template',[MemberController::class, 'templateExcel'])->name('downloadmember');
            Route::get('/member/export/pdf/', [MemberController::class, 'exportMemberPDF'])->name('memberPdf');
            
            Route::get('/user/export/excel', [UserController::class , 'exportExcel'])->name('exceluser');
            Route::get('/user/export/pdf/', [UserController::class, 'exportUserPDF'])->name('userPdf');

            Route::resource('/logging', LoggingController::class);

            Route::get('/laporan', [TransaksiController::class, 'laporan'])->name('transaksi.laporan');
            Route::get('/laporan/export/excel', [TransaksiController::class, 'exportExcel'])->name('transaksi.export.excel');
            Route::get('/laporan/export/pdf', [TransaksiController::class, 'exportPDF'])->name('transaksi.export.pdf');
            Route::get('/laporan/datatable', [TransaksiController::class, 'laporanDatatable'])->name('transaksi.laporanDatatable');
            
        });
        Route::middleware('level:admin')->group(function () {
            Route::resource('/outlet', OutletController::class);
            Route::resource('/paket', PaketController::class);
            Route::get('/simulasi', [SimulasiController::class, 'karyawan']);
        });
            Route::middleware('level:admin,kasir')->group(function () {
                Route::resource('/member', MemberController::class);
                Route::resource('/transaksi', TransaksiController::class);
                Route::post('/transaksi/status',[TransaksiController::class, 'updateStatus'])->name('statusTransaksi');
                Route::post('/transaksi/pembayaran',[TransaksiController::class, 'updatePembayaran'])->name('pembayaranTransaksi');
            });
            Route::resource('/user', UserController::class);
    });
});