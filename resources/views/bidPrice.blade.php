<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	@if((!is_null($mou) && $mou->status == 2) || (!is_null($model) && is_null($model->bid_price)))
	<p>Client x telah selesai upload MOU yang sudah ditandatangani.</p>
	Form pembuatan dokumen penawaran harga.
	<form method="POST" action="{{ url('/bidPrice_create') }}" enctype="multipart/form-data">
		@csrf
		<label>Nama Produk</label>
		<input type="text" name="produk" required=""><br>
		<label>Harga Produk</label>
		<input type="number" name="price" required=""><br>
		<button type="submit">Submit</button> | <button type="reset">Reset</button>
	</form>
	@elseif(!is_null($model) && !is_null($model->bid_price))
	<p>Dokumen Penawaran harga telah dibuat. Tunggu approval dari Kabid PJT</p>
	@else
	<p>Form pembuatan dokumen penawaran harga masih dikunci</p>
	@endif
	<br>
	@if(!is_null($model) && !is_null($model->bid_price))
	Penawaran harga telah dibuat oleh Seksi Pemasaran.<br>
	<a href="{{ asset('dok/bidPrice/'.$model->bid_price) }}" target="_blank">Lihat Dokumen Penawaran Harga</a><br>
	Approval Penawaran harga
	<form method="POST" action="{{ url('/bidPrice_approval') }}">
		@csrf
		<button type="submit" name="choice" value="terima">Terima</button> | <button type="submit" name="choice" value="tolak">Tolak</button>
	</form>
	@endif
	@if(!is_null($model) && $model->verifikasi_bayar == 1 && is_null($model->invoice_id))
	<br><br>
	<form method="POST" action="{{ url('/invoice_create') }}">
		@csrf
		<!-- Upload Kode Biling.<br>
		<input type="file" name="kb" required=""><br> -->
		Form pembuatan invoice.<br>
		<label>Nama</label>
		<input type="text" name="nama" required=""><br>
		<label>Produk</label>
		<input type="text" name="produk" required=""><br>
		<button type="submit">Submit</button> | <button type="reset">Reset</button>
	</form>
	@endif
	@if(!is_null($model) && !is_null($model->invoice_id))
	<br>
	Invoice telah dibuat.
	<a href="{{ asset('dok/invoice/'.$model->invoice()->first()->invoice) }}" target="_blank">Download Invoice</a><br><br>
	Upload Bukti Pembayaran.<br>
	<form method="POST" action="{{ url('/bukti_bayar') }}" enctype="multipart/form-data">
		@csrf
		<input type="file" name="bbyr" required=""><br>
		<button type="submit">Submit</button>
	</form>
	@endif
</body>
</html>