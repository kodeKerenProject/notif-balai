@extends('home')

@section('card-header', 'Input Rekomendasi Evaluasi Rapat Teknis')

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
    @if(!is_null($dok) && !is_null($dok->laporan_hasil_sert) && !$input_tt)
    <b><i>Input Rekomendasi Evaluasi Rapat Teknis</i></b><br>
    <form method="POST" action="{{ url('/rekomendasiRapatTeknis/'.$idProduk) }}">
        @csrf
        Sebagai : {{ \Auth::user()->name }}<br>
        <label>Rekomendasi</label><br>
        <textarea name="rek" required=""></textarea><br>
        <button type="submit">Submit</button> | <button type="reset">Reset</button>
    </form>
    @elseif(is_null($dok) || (!is_null($dok) && is_null($dok->laporan_hasil_sert)))
    <center><p class="alert alert-primary">Dokumen Laporan Hasil Setifikasi belum dibuat</p></center>
    @else
    <center><p class="alert alert-success">Rekomendasi Evaluasi Rapat Teknis telah diisi</p></center>
    <a href="{{ asset('storage/dok/lapSert/'.$dok->laporan_hasil_sert) }}" target="_blank">Lihat File Laporan Hasil Sertifikasi</a><br><br>
    @endif
@endsection