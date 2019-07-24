<?php

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
    return view('welcome');
});

	
Route::group(['middleware'=>['auth', 'verified']], function() {

	Route::group(['middleware'=>['checkClient']], function() {	
		// produk
		Route::get('/produkClient', 'ProdukController@index');
		Route::post('/produkClient/create', 'ProdukController@create');
		
		// apply SA
		Route::get('sa', 'SAController@sa');
		Route::post('/sa', 'SAController@applySA');
		Route::post('/saLuar', 'SAController@applySAluar');
	});
	Route::group(['middleware'=>['checkPemasaran']], function() {
		// verify SA
		Route::get('/company', 'CompanyController@list');
		Route::get('/company/{id}', 'CompanyController@single');
		Route::get('/company/{id}/sert/{idProduk}', 'CompanyController@verifySA');
		Route::post('/verifySA', 'CompanyController@verSA');
	});

// ------------------- tahap 3 -------------------------
		// mou
		Route::post('/mou_create', 'MOUController@create');
		Route::get('/mou', 'MOUController@mou');
		Route::post('/mou_signed', 'MOUController@mou_signed');
		Route::post('/unlock_mou', 'MOUController@unlock_mou');
		// penawaran harga
		Route::get('/bidPrice', 'BPController@index');
		Route::post('/bidPrice_create', 'BPController@create');
		Route::post('/bidPrice_approval', 'BPController@approve');
		// form kapan bayar
		Route::post('/form_bayar', 'BPController@form_bayar');
		// invoice
		Route::post('/invoice_create', 'BPController@invoice_create');
		// bukti bayar
		Route::post('/bukti_bayar', 'BPController@bukti_bayar');

// ------------------- tahap 4 -------------------------
		// surat pemberitahuan jadwal & tim audit
		Route::get('/jadwalAudit', 'JAController@index');
		Route::post('/suratJA_upload', 'JAController@upload');
		// laporan audit kecukupan sertifikasi produk
		Route::post('/dok_sert_produk', 'JAController@dok_sert_produk');
		Route::get('/verify_dokSert', 'JAController@verify_dokSert');
		Route::post('/dokAudit', 'JAController@dokAudit');
		// upload audit plan dan sampling plan
		Route::post('/auditPlan_upload', 'JAController@auditPlan_upload');

// ------------------- tahap 5 -------------------------
		// upload shu, bapc, closed ncr
		Route::get('/laporanSert', 'LaporanHasilSert@index');
		Route::post('/laporanSert_upload', 'LaporanHasilSert@upload');
		Route::post('/lapSert_create', 'LaporanHasilSert@create');
		// input rekomendasi evaluasi rapat teknis
		Route::post('/rekomendasiRapatTeknis', 'LaporanHasilSert@rekomendasi');
		// input keputusan komite evaluasi teknis
		Route::post('/keputusanTeknis', 'LaporanHasilSert@keputusan');
		// draft sert
		Route::get('/draftSert', 'SertController@index');
		Route::post('/draftSert_create', 'SertController@create');
		// approval draft sert
		Route::post('/apprv_draftSert_action', 'SertController@postApprv');
		// cetak sert
		Route::post('/cetak_sert', 'SertController@cetak_sert');
		// pemberitahuan sertifikat jadi
		Route::post('/sert_jadi', 'SertController@sert_jadi');
		// request ambil/kirim sert
		Route::post('/req_sert', 'SertController@req_sert');
		// arrange schedule pengiriman/pengambilan
		Route::post('/jadwalSert', 'SertController@jadwalSert');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
