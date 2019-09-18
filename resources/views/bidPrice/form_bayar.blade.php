@extends('home')

@section('card-header', 'Form Waktu Pembayaran')

@section('second-content')
	@if(\Session::has('errMsg'))
	<p class="pl-3 alert alert-danger">{{ \Session::get('errMsg') }}</p>
	@endif
	@if(is_null($bidPrice))
	<center><p class="alert alert-primary">Penawaran Harga belum dibuat</p></center>
	@elseif(!is_null($bidPrice) && $bidPrice->status == 3 && is_null($bidPrice->verifikasi_bayar) )
		Masukan tanggal pembayaran<br>
		<form method="POST" action="{{ url('/form_bayar/'.$idProduk) }}">
			@csrf
			<label>Tanggal</label>
			<input type="date" name="tgl" required="" value="{{ date('Y-m-d') }}"><br>
			*) Maksimal waktu pembayaran yaitu 7 hari dari sekarang<br>
			<button type="submit" onclick="return confirm('Apakah anda yakin?');">Submit</button>
		</form>
	@elseif(!is_null($bidPrice) && !is_null($bidPrice->verifikasi_bayar) && is_null($bidPrice->bukti_bayar))
	<center><p class="alert alert-warning">Waktu Pembayaran : {{ $bidPrice->tanggal_bayar }}</p></center>
	<center><p class="alert alert-primary">Upload bukti pembayaran setelah invoice dibuat di tahap selanjutnya</p></center>
	@elseif(!is_null($bidPrice) && !is_null($bidPrice->bukti_bayar))
	<center><p class="alert alert-success">Waktu Pembayaran : {{ $bidPrice->tanggal_bayar }}<br>Pembayaran berhasil</p></center>
	@else
	<center><p class="alert alert-primary">Tunggu Apporval Penawaran harga dari Kabid PJT</p></center>
	@endif
	<br>
	<div class="text-left" style="float: left;">
        <a href="{{ url('/mou') }}" class="btn btn-primary"><- Tahap sebelumnya</a>
    </div>
	<div class="text-right">
        <a href="{{ url('/bukti_bayar') }}" class="btn btn-primary">Tahap selanjutnya -></a>
    </div>
@endsection