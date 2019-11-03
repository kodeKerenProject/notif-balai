@extends('home')

@section('card-header', 'Peninjauan Surat Pemberitahuan Jadwal dan Tim Audit')

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
    @if(!is_null($jadwalAudit) && is_null($jadwalAudit->apprv))
        <center><p class="alert alert-success">Surat Pemberitahuan Jadwal dan Tim Audit sudah dibuat</p></center>
        <a href="{{ asset('storage/dok/jadwalAudit/'.$jadwalAudit->jadwal_audit) }}" target="_blank">Lihat Dokumen</a><br>
        <form method="POST" action="{{ url('/apprv_jadwalAudit') }}">
            @csrf
            <input type="hidden" name="produkId" value="{{ $idProduk }}">
            <label>Persetujuan Surat Pemberitahuan Jadwal dan Tim Audit</label><br>
            <button type="submit" name="choice" value="1" onclick="return confirm('Apakah anda yakin?');">Terima</button> | <button type="submit" name="choice" value="2" onclick="return confirm('Apakah anda yakin?');">Tolak</button>
        </form>
    @elseif(!is_null($jadwalAudit) && $jadwalAudit->apprv == 2)
        <center><p class="alert alert-primary">Surat Pemberitahuan Jadwal dan Tim Audit tidak disetujui</p></center>
    @elseif(!is_null($jadwalAudit) && $jadwalAudit->apprv == 1)
        <center><p class="alert alert-success">Surat Pemberitahuan Jadwal Audit telah disetujui</p></center>    
    @else
        <center><p class="alert alert-primary">Surat Pemberitahuan Jadwal dan Tim Audit belum dibuat</p></center>
    @endif
@endsection