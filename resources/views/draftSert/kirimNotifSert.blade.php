@extends('home')

@section('card-header', 'Pemberitahuan Sertifikat Jadi')

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
    @if(!is_null($produk) && ($produk->status_sert_jadi == 1 || $produk->status_sert_jadi == 2 || $produk->status_sert_jadi == 3))
    <center><p class="alert alert-success">Sertifikat telah dicetak oleh bagian Sertifikasi</p></center>
    <form method="POST" action="{{ url('/sert_jadi_action/'.$idProduk) }}">
        @csrf
        <button type="submit">Kirim Pemberitahuan Sertifikat Jadi ke Client</button>
    </form>
    @elseif(!is_null($produk) && is_null($produk->status_sert_jadi))
    <center><p class="alert alert-primary">Draft Sertifikat belum jadi</p></center>
    @endif
    <br>
    <div class="text-left" style="float: left;">
        <a href="{{ url('/bidPrice/'.$user_id.'/sert/'.$idProduk) }}" class="btn btn-primary"><- Tahap Sebelumnya</a>
    </div>
    <div class="text-right">
        <a href="{{ url('/jadwalSert/'.$user_id.'/sert/'.$idProduk) }}" class="btn btn-primary">Tahap Selanjutnya -></a>
    </div>
@endsection