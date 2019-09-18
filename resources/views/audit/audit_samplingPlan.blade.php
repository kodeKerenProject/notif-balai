@extends('home')

@section('card-header', 'Upload Audit Plan dan Sampling Plan')

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
	@if((!is_null($dokImportir) && $dokImportir->lengkap == 1) && (!is_null($dokManufaktur) && $dokManufaktur->lengkap == 1) && (!is_null($tinjauanPP) && $tinjauanPP->lengkap == 1) && is_null($asPlan))
	<div class="validMsg"></div>
	<p><b><i>Upload Audit Plan dan Sampling Plan</i></b></p>
	<form id="samplingPlan_upload" method="POST" action="{{ url('/auditPlan_upload/'.$idProduk) }}" enctype="multipart/form-data">
		@csrf
		<label>Audit Plan</label>
		<input class="file" type="file" name="auditPlan"><br>
		<label>Sampling Plan</label>
		<input class="file" type="file" name="samplingPlan"><br>
		<button type="button" onclick="ValidateSize('.file', '', '#samplingPlan_upload', '.validMsg');">Submit</button> | <button type="reset">Reset</button>
	</form>
	@elseif(!is_null($asPlan))
	<center><p class="alert alert-success">Audit Plan dan Sampling Plan telah diupload.<br>Lanjut ke halaman selanjutnya untuk upload SHU, BAPC, CLosed NCR</p></center>
	@else
	<center><p class="alert alert-primary">Laporan audit kecukupan sertifikasi produk client belum lengkap</p></center>
	@endif
	<br>
	<div class="text-left" style="float: left;">
        <a href="{{ url('/company/'.$user_id.'/jadwalAudit/'.$idProduk) }}" class="btn btn-primary"><- Tahap sebelumnya</a>
    </div>
    <div class="text-right">
        <a href="{{ url('/laporanSert/'.$user_id.'/upload/'.$idProduk) }}" class="btn btn-primary">Tahap selanjutnya -></a>
    </div>
@endsection