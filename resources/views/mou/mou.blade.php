@extends('home')

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

@section('card-header', 'Buat MOU')

@section('second-content')
	@if((!is_null($dok) && $dok->sni == 1 && is_null($mou)) || (!is_null($mou) && $mou->status == null))
	<center><p class="alert alert-success">Client sudah melengkapi dokumen sertifikasi awal</p></center>
	Form pembuatan MOU.
	<form method="POST" action="{{ url('/mou_create/'.$idProduk) }}">
		@csrf
		<label>Nama</label>
		<input type="text" name="nama" required=""><br>
		<label>Produk</label>
		<input type="text" name="produk" required=""><br>
		<button type="submit">Buat MOU</button> | <button type="reset">Reset</button>
	</form>
	@elseif(!is_null($mou) && $mou->status != null && strtotime(date('Y-m-d H:i:s')) <= strtotime($mou->created_at))
	<center><p class="alert alert-success">MoU telah dibuat!</p></center>
	@elseif(!is_null($mou) && strtotime(date('Y-m-d H:i:s')) > strtotime($mou->created_at) && $mou->status != 2)
	<br>
	<center><p class="alert alert-warning">Fitur upload MoU yang sudah ditandatangani client telah dikunci!</p></center>
	<form method="POST" action="{{ url('/unlock_mou/'.$produk->id) }}">
		@csrf
		<button type="submit">Buka Fitur MoU</button>
	</form>
	@else
	<center><p class="alert alert-primary">Client belum melengkapi dokumen sertifikasi awal
	@endif
@endsection