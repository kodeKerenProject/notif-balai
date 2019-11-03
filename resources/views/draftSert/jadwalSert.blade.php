@extends('home')

@section('card-header', 'Penjadwalan Pengambilan atau Pengiriman Sertifikat')

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
    <div class="validMsg"></div>
    @if(!is_null($produk) && !is_null($produk->request_sert) && is_null($produk->tgl_request_sert))
    <b><i>Sertifikat Produk {{ $produk->produk }} {{ $user->nama_perusahaan }}</i></b><br>
    <b><i>Request : </i></b> {{ $produk->request_sert }}<br>
    <form id="jadwalSert_upload" method="POST" action="{{ url('/jadwalSert_action/'.$idProduk) }}" enctype="multipart/form-data">
        @csrf
        <label>Tanggal Pengiriman/Pengambilan Sertifikat</label><br>
        <input class="tanggal" type="date" name="tgl"><br>
        @if($produk->request_sert == 'kirim')
        <input type="hidden" name="user" value="{{ $user->nama_perusahaan }}" required="">
        <label>Upload Resi Pengiriman/Berita Acara</label><br>
        <input class="file" type="file" name="resi"><br>
        <button type="button" onclick="ValidateSize('.file', '.tanggal', '#jadwalSert_upload', '.validMsg');">Submit</button>
        @endif
    </form>
    @elseif(!is_null($produk) && !is_null($produk->tgl_request_sert))
    <center><p class="alert alert-success">Jadwal 
        @if($produk->request_sert == 'ambil')
        Pengambilan
        @else
        Pengiriman
        @endif
        Sertifikat telah ditentukan
    </p></center>
    <b><i>Sertifikat Produk {{ $produk->produk }} {{ $user->nama_perusahaan }}</i></b><br>
    <b><i>Request : </i></b> {{ $produk->request_sert }}<br>
    <b><i>Waktu : {{ $produk->tgl_request_sert }}</i>
    @else
    <center><p class="alert alert-primary">Draft Sertifikat belum jadi</p></center>
    @endif
    <br><br>
    <div class="text-left" style="float: left;">
        <a href="{{ url('/sert_jadi/'.$user_id.'/sert/'.$idProduk) }}" class="btn btn-primary"><- Tahap Sebelumnya</a>
    </div>
@endsection