<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<b>Laporan Hasil Sertifikasi</b><br>
	Nama : {{ $nama }}<br>
	Produk : {{ $produk }}<br><br>
	@if(isset($rekomendasi))
	<b>Rekomendasi Evaluasi Rapat Teknis</b><br>
		@foreach(json_decode($rekomendasi, true) as $value)
		Nama : {{ $value['nama'] }}<br>
		Rekomendasi : {{ $value['rekomendasi'] }}<br>
		@endforeach
	<br><br>
	@endif
	@if(isset($keputusan))
	<b>Keputusan Komite Evaluasi Rapat Teknis</b><br>
		@foreach(json_decode($keputusan, true) as $value)
		Nama : {{ $value['nama'] }}<br>
		Keputusan : {{ $value['keputusan'] }}<br>
		@endforeach
	<br><br>
	@endif
</body>
</html>