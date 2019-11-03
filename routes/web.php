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
    // return view('welcome');
    return redirect('login');
});

// route client	
Route::group(['middleware'=>'roles','roles'=>'client'], function() {
	// menampilkan list produk
	Route::get('/list_produk', 'SAController@list_produk'); 
	// apply SA
	Route::get('/sa', 'SAController@sa')->name('home');
	Route::post('/sa', 'SAController@applySA');
	Route::post('/saLuar', 'SAController@applySAluar');
	// mou
	Route::get('/mou', 'MOUController@mou');
	Route::post('/mou_signed/{id}', 'MOUController@mou_signed');
	// form kapan bayar
	Route::get('/form_bayar', 'BPController@getForm_bayar');
	Route::post('/form_bayar/{id}', 'BPController@form_bayar');
	// upload bukti bayar
	Route::get('/bukti_bayar', 'BPController@getBukti');
	Route::post('/bukti_bayar/{id}', 'BPController@bukti_bayar');
	// upload dok audit
	Route::get('/verify_dokSert', 'JAController@verify_dokSert');
	Route::post('/dokAudit', 'JAController@dokAudit');
	// approval draft sert
	Route::get('/apprv_draftSert', 'SertController@getApprv');
	Route::post('/apprv_draftSert_action', 'SertController@postApprv');
	// request ambil/kirim sert
	Route::get('/req_sert', 'SertController@req_sert');
	Route::post('/req_sert_action/{id}', 'SertController@postReq_sert');
});

// route seksi pemasaran, seksi kerjasama, kabidpjt, seksi keuangan, auditor, kabidPaskal, tim_teknis, komite_timTeknis
Route::group(['middleware'=>'roles','roles'=>['pemasaran', 'kerjasama', 'kabidpjt', 'keuangan', 'sertifikasi', 'kabidpaskal', 'auditor', 'tim_teknis', 'komite_timTeknis', 'subag_umum']], function() {
	// menampilkan list produk
	Route::get('/company', 'CompanyController@list');
	Route::get('/company/{id}', 'CompanyController@single');
});

// route seksi pemasaran
Route::group(['middleware'=>'roles','roles'=>'pemasaran'], function() {
	// verify SA
	Route::get('/company/{id}/sert/{idProduk}', 'CompanyController@verifySA');
	Route::post('/verifySA/{id}', 'CompanyController@verSA');
	Route::post('/verifySALuar/{id}', 'CompanyController@verSALuar');
	// penawaran harga
	Route::get('/bidPrice/{id}/sert/{idProduk}', 'BPController@index');
	Route::post('/bidPrice_create/{id}', 'BPController@create');
	Route::post('/submit_bidPrice/{id}', 'BPController@submit');
	// pemberitahuan sertifikat jadi
	Route::get('/sert_jadi/{id}/sert/{idProduk}', 'SertController@sert_jadi');
	Route::post('/sert_jadi_action/{id}', 'SertController@postSert_jadi');
	// arrange schedule pengiriman/pengambilan
	Route::get('/jadwalSert/{id}/sert/{idProduk}', 'SertController@jadwalSert');
	Route::post('/jadwalSert_action/{id}', 'SertController@postJadwalSert');
});

// route seksi kerjasama
Route::group(['middleware'=>'roles','roles'=>'kerjasama'], function() {
	// mou
	Route::get('/company/{id}/cmou/{idProduk}', 'MOUController@cmou');
	Route::post('/mou_create/{id}', 'MOUController@create');
	Route::post('/unlock_mou/{id}', 'MOUController@unlock_mou');
});

// route kabidpjt
Route::group(['middleware'=>'roles','roles'=>'kabidpjt'], function() {
	// approval penawaran harga
	Route::get('/company/{id}/approval/{idProduk}', 'BPController@getApprove');
	Route::post('/bidPrice_approval/{id}', 'BPController@approve');
});

// route seksi keuangan
Route::group(['middleware'=>'roles','roles'=>'keuangan'], function() {
	// invoice
	Route::get('/company/{id}/invoice/{idProduk}', 'BPController@getInvoice_create');
	Route::post('/invoice_create/{id}', 'BPController@invoice_create');
	Route::post('/uploadKB/{id}', 'BPController@kbiling_upload');
});

// route seksi sertifikasi
Route::group(['middleware'=>'roles','roles'=>'sertifikasi'], function() {
	// surat pemberitahuan jadwal & tim audit
	Route::get('/company/{id}/jadwalAudit/{idProduk}', 'JAController@index');
	Route::post('/suratJA_upload/{id}', 'JAController@upload');
	// upload audit plan dan sampling plan
	Route::get('/auditPlan/{id}/upload/{idProduk}', 'JAController@auditPlan');
	Route::post('/auditPlan_upload/{id}', 'JAController@auditPlan_upload');
	// upload shu, bapc, closed ncr
	Route::get('/laporanSert/{id}/upload/{idProduk}', 'LaporanHasilSert@index');
	Route::post('/laporanSert_upload/{id}', 'LaporanHasilSert@upload');
	Route::post('/lapSert_create/{id}', 'LaporanHasilSert@create');
	// draft sert
	Route::get('/draftSert/{id}/create/{idProduk}', 'SertController@index');
	Route::post('/draftSert_create/{id}', 'SertController@create');
	// cetak sert
	Route::post('/cetak_sert/{id}', 'SertController@cetak_sert');
});

// route kabid paskal
Route::group(['middleware'=>'roles','roles'=>'kabidpaskal'], function() {
	Route::get('/company/{id}/apprv_jadwalAudit/{idProduk}', 'JAController@apprv_jadwalAudit');
	Route::post('/apprv_jadwalAudit', 'JAController@apprvPost');
});

// route auditor
Route::group(['middleware'=>'roles','roles'=>'auditor'], function() {
	// laporan audit kecukupan sertifikasi produk
	Route::get('/company/{id}/dokSert/{idProduk}', 'JAController@getDokSert');
	Route::post('/dok_sert_produk', 'JAController@dok_sert_produk');
});

// route tim_teknis
Route::group(['middleware'=>'roles','roles'=>'tim_teknis'], function() {
	// input rekomendasi evaluasi rapat teknis
	Route::get('/company/{id}/rekomendasiRapatTeknis/{idProduk}', 'LaporanHasilSert@getRekomendasi');
	Route::post('/rekomendasiRapatTeknis/{idProduk}', 'LaporanHasilSert@rekomendasi');
});

// route komite_timTeknis
Route::group(['middleware'=>'roles','roles'=>'komite_timTeknis'], function() {
	// input keputusan komite evaluasi teknis
	Route::get('/company/{id}/keputusanTeknis/{idProduk}', 'LaporanHasilSert@getKeputusan');
	Route::post('/keputusanTeknis/{idProduk}', 'LaporanHasilSert@keputusan');
});

// route komite_timTeknis
Route::group(['middleware'=>'roles','roles'=>'subag_umum'], function() {
	Route::get('/company/{id}/pengirimanSert/{idProduk}', 'SertController@pengirimanSert');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index');

// Route::get('/push','PushController@push')->name('push');
// //store a push subscriber.
// Route::post('/push','PushController@store');

Route::post('notifications', 'NotificationController@store');
Route::get('notifications', 'NotificationController@index');
Route::patch('notifications/{id}/read', 'NotificationController@markAsRead');
Route::post('notifications/mark-all-read', 'NotificationController@markAllRead');
Route::post('notifications/{id}/dismiss', 'NotificationController@dismiss');

// Push Subscriptions
Route::post('subscriptions', 'PushController@update');
Route::post('subscriptions/delete', 'PushController@destroy');

Route::get('manifest.json', function () {
    return [
        'name' => config('app.name'),
        'gcm_sender_id' => config('webpush.gcm.sender_id')
    ];
});