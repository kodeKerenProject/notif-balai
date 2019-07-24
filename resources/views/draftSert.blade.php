<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	@if(is_null($produk) || (!is_null($produk) && is_null($produk->draft_sert)))
	<b><i>Pembuatan Draft Sertifikat</i></b>
	<form method="POST" action="{{ url('/draftSert_create') }}">
		@csrf
		<button type="submit">Buat Draft Sretifikat</button>
	</form>
	@elseif(isset($dok) && !is_null($dok) && is_null($dok->input_evaluasi_tt))
	<b><i>Form Pembuatan Draft Sertifikat masih dikunci</i></b>
	@else
	<b><i>Draft Sertifikat telah dibuat</i></b><br>
	<a href="{{ asset('dok/draftSert/'.$produk->draft_sert) }}" target="_blank">Lihat Draft Sertifikat</a><br>
	@endif

	@if(!is_null($produk) && !is_null($produk->draft_sert) && is_null($produk->status_sert_jadi))
	<br>
	<i>Draft Sertifikat telah dibuat</i>
	<a href="{{ asset('dok/draftSert/'.$produk->draft_sert) }}" target="_blank">Lihat Draft Sertifikat</a><br>
	<b><i>Approval Draft Sertifikat</i></b><br>
	<form method="POSt" action="{{ url('/apprv_draftSert_action') }}">
		@csrf
		<button type="submit" value="1" name="apprv">Terima</button> | <button type="submit" value="0" name="apprv">Tolak</button>
	</form>
	@elseif(!is_null($produk) && ($produk->status_sert_jadi == 1 || $produk->status_sert_jadi == 2 || $produk->status_sert_jadi == 3))
	<br>
	<b><i>Approval Draft Sertifikat berhasil</i></b>
	@else
	<br>
	<b><i>Draft Sertifikat belum dibuat</i></b>
	@endif

	@if(!is_null($produk) && $produk->status_sert_jadi == 1)
	<br>
	<br>Approval Draft Sertifikat telah disetujui oleh Client<br>
	<form method="POST" action="{{ url('/cetak_sert') }}">
		@csrf
		<button type="submit">Cetak Sertifikat</button>
	</form>
	@elseif(!is_null($produk) && ($produk->status_sert_jadi == 2 || $produk->status_sert_jadi == 3))
	<br>
	<br><b><i>Sertifikat telah dicetak</i></b>
	@endif

	@if(!is_null($produk) && ($produk->status_sert_jadi == 2 || $produk->status_sert_jadi == 3))
	<br>
	<br>Sertifikat telah dicetak oleh bagian Sertifikasi<br>
	<form method="POST" action="{{ url('/sert_jadi') }}">
		@csrf
		<button type="submit">Kirim Pemberitahuan Sertifikat Jadi ke Client</button>
	</form>
	@endif

	@if(!is_null($produk) && $produk->status_sert_jadi == 3 && is_null($produk->request_sert))
	<br>Request Ambil/Kirim Sertifikat<br>
	<form method="POST" action="{{ url('/req_sert') }}">
		@csrf
		<label>Request</label><br>
		<input type="radio" name="req" value="1">Ambil<br>
		<input type="radio" name="req" value="2">Kirim<br>
		<button type="submit">Submit</button>
	</form>
	@elseif(!is_null($produk) && !is_null($produk->request_sert))
	<br>
	<b><i>Sertifikat Produk {{ $produk->produk }} PT.APA</i></b><br>
	<b><i>Request : </i></b> {{ $produk->request_sert }}<br>
	@endif

	@if(!is_null($produk) && !is_null($produk->request_sert))
	<br>
	<b><i>Sertifikat Produk {{ $produk->produk }} PT.APA</i></b><br>
	<b><i>Request : </i></b> {{ $produk->request_sert }}<br>
	<form method="POST" action="{{ url('/jadwalSert') }}" enctype="multipart/form-data">
		@csrf
		<label>Tanggal Pengiriman/Pengambilan Sertifikat</label><br>
		<input type="date" name="tgl"><br>
		@if($produk->request_sert == 'kirim')
		<label>Upload Resi Pengiriman/Berita Acara</label><br>
		<input type="file" name="resi"><br>
		<button type="submit">Submit</button>
		@endif
	</form>
	@endif
</body>
</html>