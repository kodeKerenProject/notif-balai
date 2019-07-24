<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	@if( is_null($dok) || (!is_null($dok) && is_null($dok->shu) && is_null($dok->bapc) && is_null($dok->closed_ncr)) )
	<b><i>Upload SHU, BAPC, dan Closed NCR</i></b><br>
	<form method="POST" action="{{ url('/laporanSert_upload') }}" enctype="multipart/form-data">
		@csrf
		<label>SHU</label>
		<input type="file" name="shu" required=""><br>
		<label>BAPC</label>
		<input type="file" name="bapc" required=""><br>
		<label>Closed NCR</label>
		<input type="file" name="cncr" required=""><br>
		<button type="submit">Submit</button> | <button type="reset">Reset</button>
	</form>
	@else
	<b><i>SHU, BAPC, dan Closed NCR telah diupload</i></b><br>
	@endif

	@if(!is_null($dok) && !is_null($dok->shu) && !is_null($dok->bapc) && !is_null($dok->closed_ncr) && is_null($dok->laporan_hasil_sert))
	<b><i>Buat Laporan Hasil Sertifikasi</i></b>
	<form method="POST" action="{{ url('/lapSert_create') }}">
		@csrf
		<label>Nama</label>
		<input type="text" name="nama" required=""><br>
		<label>Produk</label>
		<input type="text" name="produk" required=""><br>
		<button type="submit">Submit</button> | <button type="reset">Reset</button>
	</form><br>
	@elseif(!is_null($dok) && !is_null($dok->laporan_hasil_sert))
	<b><i>Laporan Hasil Sertifikasi telah dibuat</i></b><br>
	<a href="{{ asset('dok/lapSert/'.$dok->laporan_hasil_sert) }}" target="_blank">Lihat File</a><br><br>
	@endif

	<br>
	@if(!isset($data[0]))
	<b><i>Input Rekomendasi Evaluasi Rapat Teknis</i></b><br>
	<form method="POST" action="{{ url('/rekomendasiRapatTeknis') }}">
		@csrf
		Sebagai : User1<br>
		<label>Rekomendasi</label><br>
		<textarea name="rek" required=""></textarea><br>
		<button type="submit">Submit</button> | <button type="reset">Reset</button>
	</form>
	@else
	<b><i>Rekomendasi Evaluasi Rapat Teknis telah diisi</i></b><br>
	<a href="{{ asset('dok/lapSert/'.$dok->laporan_hasil_sert) }}" target="_blank">Lihat File Laporan Hasil Sertifikasi</a><br><br>
	@endif

	<br>
	@if(!isset($data[1]))
	<b><i>Input Keputusan Komite Evaluasi Teknis</i></b><br>
	<form method="POST" action="{{ url('/keputusanTeknis') }}">
		@csrf
		Sebagai : User1<br>
		<label>Keputusan</label><br>
		<textarea name="kep" required=""></textarea><br>
		<button type="submit">Submit</button> | <button type="reset">Reset</button>
	</form>
	@else
	<b><i>Keputusan Komite Evaluasi Teknis telah diisi</i></b><br>
	<a href="{{ asset('dok/lapSert/'.$dok->laporan_hasil_sert) }}" target="_blank">Lihat File Laporan Hasil Sertifikasi</a><br><br>
	@endif
</body>
</html>