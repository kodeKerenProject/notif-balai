<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	@if(!is_null($dok) && $dok->status == 1 && strtotime(date('Y-m-d H:i:s')) <= strtotime($dok->created_at))
	MOU telah dibuat oleh Seksi Kerjama.<br>
	Harap untuk upload MOU sebelum tanggal {{ date('d-m-Y', strtotime($dok->created_at)) }}.<br>
	Download file terlebih dahulu sebelum upload MOU yang sudah ditanda tangan.<br>
	<a href="{{ asset('dok/mou/'.$dok->mou) }}" target="_blank">Download MOU</a>
	<br><br>
	<form method="POST" action="{{ url('/mou_signed') }}" enctype="multipart/form-data">
		@csrf
		Upload MOU yang sudah ditanda tangan<br>
		<input type="file" name="mou" required=""><br>
		<button type="submit">Submit</button> | <button type="reset">Reset</button>
	</form>
	@elseif(!is_null($dok) && $dok->status == 2 && !is_null($dok->mou))
	MOU telah diupload.
	@elseif(!is_null($dok) && strtotime(date('Y-m-d H:i:s')) > strtotime($dok->created_at))
	File MOU telah dikunci oleh sistem.
	Harap hubungi seksi kerjasama.
	@else
	MOU belum dibuat.
	@endif
	<br><br>
	@if(!is_null($bp) && !is_null($bp->status) && $bp->status != 2)
	Form Pembayaran Client<br>
	<form method="POST" action="{{ url('/form_bayar') }}">
		@csrf
		<label>Taggal Pembayaran</label>
		<input type="date" name="tgl" required=""><br>
		<button type="submit">Submit</button> | <button type="reset">Reset</button>
	</form>
	@endif
</body>
</html>