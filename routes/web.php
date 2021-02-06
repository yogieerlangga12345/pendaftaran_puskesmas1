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

Route::get('/', function () {
    return redirect('index');
});

//index
Route::get('index', 'IndexController@index')->name('index');

//dashboard
Route::get('dashboard', 'DashboardController@index')->name('dashboard');

//login
Route::get('login', 'AUPLoginController@index')->name('login');
Route::post('proses-login', 'AUPLoginController@proses_login')->name('post_login');

//Register
Route::get('register', 'RegisterController@index')->name('register');
Route::post('add-register', 'RegisterController@add_register')->name('add_register');

// MasterAdmin
Route::get('master_admin', 'MasterAdminController@index')->name('master_admin');
Route::post('add-admin', 'MasterAdminController@add_admin')->name('add_admin');
Route::get('get-admin', 'MasterAdminController@get_admin')->name('get_admin');
Route::post('update-admin', 'MasterAdminController@update_admin')->name('update_admin');
Route::get('delete-admin', 'MasterAdminController@delete_admin')->name('delete_admin');


//MasterPetugas
Route::get('master_petugas', 'MasterPetugasController@index')->name('master_petugas');
Route::post('add-petugas', 'MasterPetugasController@add_petugas')->name('add_petugas');
Route::get('get-petugas', 'MasterPetugasController@get_petugas')->name('get_petugas');
Route::post('update-petugas', 'MasterPetugasController@update_petugas')->name('update_petugas');
Route::get('delete-petugas', 'MasterPetugasController@delete_petugas')->name('delete_petugas');

//MasterDokter
Route::get('master_dokter', 'MasterDokterController@index')->name('master_dokter');
Route::post('madd-dokter', 'MasterDokterController@madd_dokter')->name('madd_dokter');
Route::get('mget-dokter', 'MasterDokterController@mget_dokter')->name('mget_dokter');
Route::post('mupdate-dokter', 'MasterDokterController@mupdate_dokter')->name('mupdate_dokter');
Route::get('mdelete-dokter', 'MasterDokterController@mdelete_dokter')->name('mdelete_dokter');

//DataDokter
Route::get('data_dokter', 'DataDokterController@index')->name('data_dokter');
Route::post('add-dokter', 'DataDokterController@add_dokter')->name('add_dokter');
Route::get('get-dokter', 'DataDokterController@get_dokter')->name('get_dokter');
Route::post('update-dokter', 'DataDokterController@update_dokter')->name('update_dokter');
Route::get('delete-dokter', 'DataDokterController@delete_dokter')->name('delete_dokter');

//JadwalPraktek
Route::get('jadwal_praktek', 'JadwalPraktekController@index')->name('jadwal_praktek');
Route::post('add-jadwaldokter', 'JadwalPraktekController@add_jadwaldokter')->name('add_jadwaldokter');
Route::get('get-jadwaldokter', 'JadwalPraktekController@get_jadwaldokter')->name('get_jadwaldokter');
Route::post('update-jadwaldokter', 'JadwalPraktekController@update_jadwaldokter')->name('update_jadwaldokter');
Route::get('delete-jadwaldokter', 'JadwalPraktekController@delete_jadwaldokter')->name('delete_jadwaldokter');

//Daftarpasien
Route::get('daftar_pasien', 'DaftarPasienController@index')->name('daftar_pasien');
Route::get('cari-dokter-pasien', 'DaftarPasienController@cari_dokter')->name('cari_dokter');
Route::get('cari-puskesmas', 'DaftarPasienController@cari_puskesmas')->name('cari_puskesmas');
Route::post('add-daftar', 'DaftarPasienController@add_daftar')->name('add_daftar');
Route::get('get-daftar', 'DaftarPasienController@get_daftar')->name('get_daftar');
Route::post('update-daftar', 'DaftarPasienController@update_daftar')->name('update_daftar');
Route::get('delete-daftar', 'DaftarPasienController@delete_daftar')->name('delete_daftar');

//DataPasien
Route::get('data_pasien', 'DataPasienController@index')->name('data_pasien');
Route::post('add-pasien', 'DataPasienController@add_pasien')->name('add_pasien');
Route::get('get-pasien', 'DataPasienController@get_pasien')->name('get_pasien');
Route::post('update-pasien', 'DataPasienController@update_pasien')->name('update_pasien');
Route::get('delete-pasien', 'DataPasienController@delete_pasien')->name('delete_pasien');
Route::get('acc-data', 'DataPasienController@acc_data')->name('acc_data');
Route::get('selesai', 'DataPasienController@selesai')->name('selesai');

//LaporanPendaftaran
Route::get('laporan_pendaftaran', 'LaporanPendaftaranController@index')->name('laporan_pendaftaran');
Route::post('add-laporan', 'DataPasienController@add_laporan')->name('add_laporan');
Route::get('get-laporan', 'DataPasienController@get_laporan')->name('get_laporan');
Route::post('update-laporan', 'DataPasienController@update_laporan')->name('update_laporan');
Route::get('delete-laporan', 'DataPasienController@delete_laporan')->name('delete_laporan');

//PDF
Route::get('laporan-pdf', 'PdfController@generatePDF')->name('pdf');
Route::get('cetak-pdf-pasien', 'PdfController@cetakPDF')->name('cetakPDF');
Route::get('pdf-qr', 'PdfController@pdf_qr')->name('pdf_qr');
Route::get('laporanPDF', 'PdfController@laporanPDF')->name('laporanPDF');
Route::get('laporanDokter', 'PdfController@laporanDokter')->name('laporanDokter');

//Halaman Dokter
Route::get('halaman_dokter', 'HalamanDokterController@index')->name('halaman_dokter');
Route::post('add-data', 'HalamanDokterController@add_data')->name('add_data');
Route::post('update-diagnosa', 'HalamanDokterController@update_diagnosa')->name('update_diagnosa');


//MasterPuskesmas
Route::get('master_puskesmas', 'MasterPuskesmasController@index')->name('master_puskesmas');
Route::post('add-puskesmas', 'MasterPuskesmasController@add_puskesmas')->name('add_puskesmas');
Route::get('get-puskesmas', 'MasterPuskesmasController@get_puskesmas')->name('get_puskesmas');
Route::post('update-puskesmas', 'MasterPuskesmasController@update_puskesmas')->name('update_puskesmas');
Route::get('delete-puskesmas', 'MasterPuskesmasController@delete_puskesmas')->name('delete_puskesmas');
