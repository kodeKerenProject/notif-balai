@extends('home')

@section('card-header', 'Verifikasi Dokumen Sertifikasi Awal')

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
	@if( (!is_null($dok) && $dok->sni == 1) && (!is_null($infoT) && $infoT->lengkap == 1) )
    <center><p class="alert alert-success">Dokumen dan Form Persyaratan Sertifikat SNI sudah lengkap</p></center>
    @else
    	@if(!is_null($dok) && $dok->sni == 1)
	    <center><p class="alert alert-success">Dokumen sudah lengkap</p></center>
	    @elseif(!is_null($dok) && $dok->sni == 2)
	    <center><p class="alert alert-warning">Dokumen belum lengkap</p></center>
	    @endif
	    @if(!is_null($infoT) && $infoT->lengkap == 1)
	    <center><p class="alert alert-success">Form persyaratan sertifikat SNI sudah lengkap</p></center>
	    @elseif(!is_null($infoT) && $infoT->lengkap == 2)
	    <center><p class="alert alert-warning">Form persyaratan sertifikat SNI belum lengkap</p></center>
	    @endif
    @endif
    @if(is_null($dok))
    <center><p class="alert alert-primary">Client belum melengkapi dokumen</p></center>
    @endif
    @if( (!is_null($dok) && !is_null($dok) && $dok->sni != 2 && $dok->sni != 1) )
    <center><p class="alert alert-primary">Client sudah melengkapi dokumen.<br>Form verifikasi telah aktif</p></center>
    @endif
    @if( (!is_null($dok) && $dok->sni == 1 && !is_null($infoT) && $infoT->lengkap == 2) || (!is_null($dok) && $dok->sni == 2 && !is_null($infoT) && $infoT->lengkap == 1) )
    <center><p class="alert alert-primary">Verfikasi telah dilakukan, Permintaan telah dikirim.<br>Tunggu kelengkapan dokumen dari client</p></center>
    @endif
    @if(\Session::has('successMsg'))
    <center><p class="alert alert-success">{{ \Session::get('successMsg') }}</p></center>
    @endif
	<form method="POST" action="{{ $user->negeri == 1 ? url('/verifySA/'.$idProduk) : url('/verifySALuar/'.$idProduk) }}">
		@csrf
		@if($user->negeri == 1)
			@include('applySA.verify.dok_dalamNegeri')
			@include('applySA.verify.kuis_dalamNegeri.kuis_dalamNegeri')

			@if( (!is_null($dok) && $dok->sni != 1  && $dok->sni != 2) || (!is_null($infoT) && $infoT->lengkap != 1 && $infoT->lengkap != 2) )
			<button type="submit">Kirim hasil kelengkapan dokumen</button><button type="reset">Reset</button>
			@endif
		@else
			@include('applySA.verify.dok_luarNegeri')
			@include('applySA.verify.kuis_luarNegeri.kuis_luarNegeri')
			@if((!is_null($dok) && $dok->sni != 1) || is_null($dok))
				<button type="submit">Kirim hasil kelengkapan dokumen</button><button type="reset">Reset</button>
			@endif
		@endif
	</form><br>
	<div class="text-right">
        <a href="{{ url('/bidPrice/'.$user->id.'/sert/'.$idProduk) }}" class="btn btn-primary">Tahap selanjutnya -></a>
    </div>
@endsection