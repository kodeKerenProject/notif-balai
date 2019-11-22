@extends('home')

@section('card-header', 'Pembuatan Dokumen Laporan Hasil Sertifikasi')

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
	@if( (is_null($dok) && !is_null($samplingPlan)) || (!is_null($dok) && is_null($dok->shu) && is_null($dok->bapc) && is_null($dok->closed_ncr) && !is_null($samplingPlan)) )
	<div class="validMsg"></div>
	<b><i>Upload SHU, BAPC, dan Closed NCR</i></b><br>
	<form id="laporanSert_upload" method="POST" action="{{ url('/laporanSert_upload/'.$idProduk) }}" enctype="multipart/form-data">
		@csrf
		<label>SHU</label>
		<input class="file" type="file" name="shu" required=""><br>
		<label>BAPC</label>
		<input class="file" type="file" name="bapc" required=""><br>
		<label>Closed NCR</label>
		<input class="file" type="file" name="cncr" required=""><br>
		<button type="button" onclick="ValidateSize('.file', '', '#laporanSert_upload', '.validMsg');">Submit</button> | <button type="reset">Reset</button>
	</form>
	@elseif(is_null($samplingPlan))
	<center><p class="alert alert-primary">Audit Plan dan Sampling Plan belum dibuat!</p></center>
	@else
	<center>
		<p class="alert alert-success">SHU, BAPC, dan Closed NCR telah diupload.<br>
			@if(!is_null($dok) && !is_null($dok->laporan_hasil_sert))
			Laporan Hasil Sertifikasi telah dibuat.
			@endif
		</p>
	</center>
	<a href="{{ asset('storage/dok/shu/'.$dok->shu) }}" target="_blank">Lihat SHU</a> | <a href="{{ asset('storage/dok/bapc/'.$dok->bapc) }}" target="_blank">Lihat BAPC</a> | <a href="{{ asset('storage/dok/closedNCR/'.$dok->closed_ncr) }}" target="_blank">Lihat Closed NCR</a><br>
	@endif

	@if(!is_null($dok) && !is_null($dok->shu) && !is_null($dok->bapc) && !is_null($dok->closed_ncr) && is_null($dok->laporan_hasil_sert))
	<b><i>Buat Laporan Hasil Sertifikasi</i></b>
	<form method="POST" action="{{ url('/lapSert_create/'.$idProduk) }}">
		@csrf
		<label>Nama</label>
		<input type="text" name="nama" required=""><br>
		<label>Produk</label>
		<input type="text" name="produk" required="" value="{{ $produk->produk }}" readonly=""><br>
		<button type="submit">Submit</button> | <button type="reset">Reset</button>
	</form><br>
	@elseif(!is_null($dok) && !is_null($dok->laporan_hasil_sert))
	<a href="{{ asset('storage/dok/lapSert/'.$dok->laporan_hasil_sert) }}" target="_blank">Lihat Laporan Hasil Sertifikasi</a>
	@endif
	<br><br>
	<div class="text-left" style="float: left;">
        <a href="{{ url('/auditPlan/'.$user_id.'/upload/'.$idProduk) }}" class="btn btn-primary"><- Tahap Sebelumnya</a>
    </div>
    <div class="text-right">
        <a href="{{ url('/draftSert/'.$user_id.'/create/'.$idProduk) }}" class="btn btn-primary">Tahap Selanjutnya -></a>
    </div>
@endsection