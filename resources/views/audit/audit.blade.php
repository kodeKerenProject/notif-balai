@extends('home')

@section('card-header', 'Pembuatan Surat Pemberitahuan Jadwal dan Tim Audit')

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
	@if(!$errors->isEmpty())
        <ul class="alert alert-danger">
        @foreach($errors->getMessages() as $key => $error)
            <li class="pl-2">{{ $error[0] }}</li>
        @endforeach
        </ul>
    @endif
    <div class="validMsg"></div>
	@if(!is_null($dok) && !is_null($dok->bukti_bayar) && is_null($jadwalAudit))
	Upload Surat Pemberitahuan Jadwal Audit<br>
	<form id="suratJA_upload" method="POST" action="{{ url('/suratJA_upload/'.$idProduk) }}" enctype="multipart/form-data">
		@csrf
		<input class="fileUpload" type="file" name="dok" required=""><br>
		<button type="button" onclick="ValidateSize('.fileUpload', '', '#suratJA_upload', '.validMsg');">Submit</button>
	</form>
	@elseif(!is_null($dok) && !is_null($dok->bukti_bayar) && !is_null($jadwalAudit))
	<center><p class="alert alert-success">Surat Pemberitahuan Jadwal Audit telah diupload</p></center>
	@else
	Upload Surat Pemberitahuan Jadwal Audit masih dikunci
	@endif
	<br>
    <div class="text-right">
        <a href="{{ url('/auditPlan/'.$user_id.'/upload/'.$idProduk) }}" class="btn btn-primary">Tahap selanjutnya -></a>
    </div>
@endsection