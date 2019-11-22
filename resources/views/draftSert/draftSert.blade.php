@extends('home')

@section('card-header', 'Pembuatan Draft Sertifikasi')

@section('perusahaan')
	<div class="row justify-content-center mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Perusahaan</div>

                <div class="card-body">
                	<div style="font-size: 15px;">
	                	<b>{{ $user->nama_perusahaan }}</b>
	                	@if(isset($produk))
	                	 - <span class="badge badge-secondary">Produk</span> {{ $produk->produk }}
	                	@endif
	                </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('second-content')
	@if(!is_null($produk) && is_null($produk->draft_sert) && !is_null($dok) && !is_null($dok->input_evaluasi_tt))
	<b><i>Pembuatan Draft Sertifikat</i></b>
	<form method="POST" action="{{ url('/draftSert_create/'.$idProduk) }}">
		@csrf
		<input type="hidden" name="user" value="{{ $user->nama_perusahaan }}" required="">
		<button type="submit">Buat Draft Sretifikat</button>
	</form>
	@elseif( (!is_null($dok) && is_null($dok->input_evaluasi_tt)) || is_null($dok))
	<center><p class="alert alert-success">Form Pembuatan Draft Sertifikat masih dikunci.</p></center>
	@else
	<center><p class="alert alert-success">
		@if(!is_null($produk) && !is_null($produk->draft_sert))
		Draft Sertifikat telah dibuat.<br>Approval Draft Sertifikat telah disetujui oleh Client
		@elseif(!is_null($produk) && ($produk->status_sert_jadi == 2 || $produk->status_sert_jadi == 3))
		Sertifikat telah dicetak.
		@endif
	</p></center>
	<a href="{{ asset('storage/dok/draftSert/'.$produk->draft_sert) }}" target="_blank">Lihat Draft Sertifikat</a><br>
	@endif

	@if(!is_null($produk) && $produk->status_sert_jadi == 1)
	<form method="POST" action="{{ url('/cetak_sert/'.$idProduk) }}">
		@csrf
		<button type="submit">Cetak Sertifikat</button>
	</form>
	@endif
	<br>
	<div class="text-left">
        <a href="{{ url('/laporanSert/'.$user_id.'/upload/'.$idProduk) }}" class="btn btn-primary"><- Tahap Sebelumnya</a>
    </div>
@endsection