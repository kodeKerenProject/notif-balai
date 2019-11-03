@extends('home')

@section('card-header', 'Approval Penawaran Harga')

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
	@if(!is_null($model) && !is_null($model->bid_price) && $model->status != 1)
	<center><p class="alert alert-success">Penawaran harga telah dibuat oleh Seksi Pemasaran</p></center>
	<a href="{{ asset('storage/dok/bidPrice/'.$model->bid_price) }}" target="_blank">Lihat Dokumen Penawaran Harga</a><br>
	Approval Penawaran harga
	<form method="POST" action="{{ url('/bidPrice_approval/'.$idProduk) }}">
		@csrf
		<button type="submit" onclick="return confirm('Terima Pernawaran Harga?');" name="choice" value="terima">Terima</button> | <button type="submit" onclick="return confirm('Tolak Pernawaran Harga?, Jika ya maka Pernawaran Harga yang sebelumnya akan dihapus');" name="choice" value="tolak">Tolak</button>
	</form>
	@elseif(!is_null($model) && $model->status == 1)
	<center><p class="alert alert-success">Penawaran harga telah disetujui</p></center>
	<a href="{{ asset('storage/dok/bidPrice/'.$model->bid_price) }}" target="_blank">Lihat Dokumen Penawaran Harga</a><br>
	@else
	<center><p class="alert alert-primary">Penawaran harga belum dibuat</p></center>
	@endif
@endsection