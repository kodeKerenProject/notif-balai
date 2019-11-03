@extends('home')

@section('card-header', 'Approval Draft Sertifikasi Produk')

@section('second-content')
	@if(!is_null($produk) && !is_null($produk->draft_sert) && is_null($produk->status_sert_jadi))
	<center><p class="alert alert-success">Draft Sertifikat telah dibuat</p></center>
	<a href="{{ asset('storage/dok/draftSert/'.$produk->draft_sert) }}" target="_blank">Lihat Draft Sertifikat</a><br>
	<b><i>Approval Draft Sertifikat</i></b><br>
	<form method="POSt" action="{{ url('/apprv_draftSert_action') }}">
		@csrf
		<button type="submit" value="1" name="apprv" onclick="return confirm('Apakah anda yakin?');">Terima</button> | <button type="submit" value="0" name="apprv" onclick="return confirm('Apakah anda yakin?');">Tolak</button>
	</form>
	@elseif(!is_null($produk) && ($produk->status_sert_jadi == 1 || $produk->status_sert_jadi == 2 || $produk->status_sert_jadi == 3))
	<center><p class="alert alert-success">Approval Draft Sertifikat berhasil</p></center>
	<a href="{{ asset('storage/dok/draftSert/'.$produk->draft_sert) }}" target="_blank">Lihat Draft Sertifikat</a><br>
	@else
	<center><p class="alert alert-success">Draft Sertifikat belum dibuat</p></center>
	@endif
	<br>
	<div class="text-left" style="float: left;">
        <a href="{{ url('/verify_dokSert') }}" class="btn btn-primary"><- Tahap Sebelumnya</a>
    </div>
    <div class="text-right">
        <a href="{{ url('/req_sert') }}" class="btn btn-primary">Tahap Selanjutnya -></a>
    </div>
@endsection