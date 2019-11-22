@extends('home')

@section('card-header', 'Request Kirim atau Ambil di BBK')

@section('second-content')
    @if(!is_null($produk) && $produk->status_sert_jadi == 3 && is_null($produk->request_sert))
    <b><i>Request Ambil/Kirim Sertifikat</i></b><br>
    <form method="POST" action="{{ url('/req_sert_action/'.$produk->id) }}">
        @csrf
        <input type="radio" name="req" value="1">Ambil<br>
        <input type="radio" name="req" value="2">Kirim<br>
        <button type="submit">Submit</button>
    </form>
    @elseif(!is_null($produk) && !is_null($produk->request_sert) && is_null($produk->tgl_request_sert))
    <b><i>Sertifikat Produk {{ $produk->produk }} PT.APA</i></b><br>
    <b><i>Request : </i></b> {{ $produk->request_sert }}<br>
    *) Tunggu Jadwal 
        @if($produk->request_sert == 'ambil')
        Pengambilan
        @else
        Pengiriman
        @endif
    Sertifikat dari Seksi Pemasaran
    @elseif(!is_null($produk) && !is_null($produk->request_sert) && !is_null($produk->tgl_request_sert))
    <center><p class="alert alert-success">Jadwal
        @if($produk->request_sert == 'ambil')
        Pengambilan
        @else
        Pengiriman
        @endif
    Sertifikasi telah ditentukan</p></center>
    <b><i>Sertifikat Produk {{ $produk->produk }} PT.APA</i></b><br>
    <b><i>Request : </i></b> {{ $produk->request_sert }}<br>
    <b><i>Waktu : </i></b> {{ $produk->tgl_request_sert }}
    @else
    <center><p class="alert alert-primary">Draft Sertifikat belum jadi</p></center>
    @endif
    <br><br>
    <div class="text-left">
        <a href="{{ url('/apprv_draftSert') }}" class="btn btn-primary"><- Tahap Sebelumnya</a>
    </div>
@endsection