@extends('home')

@section('card-header', 'Form Kelengkapan Laporan Audit Kecukupan sertifikasi Produk')

@section('second-content')
	@if((!is_null($dokImportir) && $dokImportir->lengkap == 2) || (!is_null($dokManufaktur) && $dokManufaktur->lengkap == 2) || (!is_null($tinjauanPP) && $tinjauanPP->lengkap == 2))
	<center><p class="alert alert-danger">Harap untuk mengupload dokumen - dokumen yang kurang dibawah ini</p></center>
	@elseif((!is_null($dokImportir) && $dokImportir->lengkap == 1) && (!is_null($dokManufaktur) && $dokManufaktur->lengkap == 1) && (!is_null($tinjauanPP) && $tinjauanPP->lengkap == 1))
	<center><p class="alert alert-success">Dokumen sudah lengkap</p></center>
	@elseif((!is_null($dokImportir) && $dokImportir->lengkap == 3) || (!is_null($dokManufaktur) && $dokManufaktur->lengkap == 3) || (!is_null($tinjauanPP) && $tinjauanPP->lengkap == 3))
	<center><p class="alert alert-primary">Tunggu verifikasi dokumen</p></center>
	@endif
	<div class="validMsg"></div>
	@if(!is_null($laporanAudit) && !is_null($laporanAudit->auditor) && !is_null($laporanAudit->jadwal_audit_id))
		@if(is_null($dokImportir) || (!is_null($dokImportir) && $dokImportir->lengkap == 2))
			<b><i>Perusahaan Dalam Negeri (Importir)</i></b><br>
		@endif
		<form id="dokAudit_upload" method="POST" action="{{ url('/dokAudit') }}" enctype="multipart/form-data">
			@csrf
			@if( (!is_null($dokImportir) && is_null($dokImportir->surat_permohonan_importer)) || is_null($dokImportir) )
			<div class="dok">
				<label>1. Surat Permohonan Importir F.03.01</label><br>
				<input class="file" type="file" name="dok[]" required="">
				<input class="fileName" type="hidden" name="fileName[]" value="surat_permohonan_importer,dokImportir">
			</div>
			@endif
			@if( (!is_null($dokImportir) && is_null($dokImportir->daftar_isian_dan_kuesioner_importer)) || is_null($dokImportir) )
			<div class="dok">
				<label>2. Daftar Isian dan Kuesioner F.48.01</label><br>
				<input class="file" type="file" name="dok[]" required="">
				<input class="fileName" type="hidden" name="fileName[]" value="daftar_isian_dan_kuesioner_importer,dokImportir">
			</div>
			@endif
			@if( (!is_null($dokImportir) && is_null($dokImportir->copy_iui)) || is_null($dokImportir) )
			<div class="dok">
				<label>3. Copy IUI</label><br>
				<input class="file" type="file" name="dok[]" required="">
				<input class="fileName" type="hidden" name="fileName[]" value="copy_iui,dokImportir">
			</div>
			@endif
			@if(is_null($dokManufaktur) || (!is_null($dokManufaktur) && $dokManufaktur->lengkap == 2))
				<br><b><i>Perusahaan Luar Negeri (Manufaktur)</i></b><br>
			@endif
			@if( (!is_null($dokManufaktur) && is_null($dokManufaktur->surat_permohonan_dari_manufaktur)) || is_null($dokManufaktur) )
			<div class="dok">
				<label>1. Surat Permohonan dari Manufaktur</label><br>
				<input class="file" type="file" name="dok[]" required="">
				<input class="fileName" type="hidden" name="fileName[]" value="surat_permohonan_dari_manufaktur,dokManufaktur">
			</div>
			@endif
			@if(is_null($tinjauanPP) || (!is_null($tinjauanPP) && $tinjauanPP->lengkap == 2))
				<br><b><i>Tinjauan Proses Produksi</i></b><br>
			@endif
			@if( (!is_null($tinjauanPP) && is_null($tinjauanPP->struktur_organisasi)) || is_null($tinjauanPP) )
			<div class="dok">
				<label>1. Struktur Organisasi (Bhs. Inggris atau Bhs. Indonesia)</label><br>
				<input class="file" type="file" name="dok[]" required="">
				<input class="fileName" type="hidden" name="fileName[]" value="struktur_organisasi,tinjauanPP">
			</div>
			@endif
		@else
		<center><p class="alert alert-primary">Auditor belum mengisi Laporan Audit Kecukupan Sertifikasi Produk</p></center>
		@endif
		@if( (!is_null($laporanAudit) && !is_null($laporanAudit->auditor)) && 
			((!is_null($dokImportir) && $dokImportir->lengkap == 2) || 
			(!is_null($dokManufaktur) && $dokManufaktur->lengkap == 2) || 
			(!is_null($tinjauanPP) && $tinjauanPP->lengkap == 2))
		)
		<br><button type="button" onclick="ValidateSize('.file', '', '#dokAudit_upload', '.validMsg');">Submit</button> | <button type="reset">Reset</button>
		@endif
	</form>
	<br>
	<div class="text-left" style="float: left;">
        <a href="{{ url('/bukti_bayar') }}" class="btn btn-primary"><- Tahap sebelumnya</a>
    </div>
    <div class="text-right">
        <a href="{{ url('/apprv_draftSert') }}" class="btn btn-primary">Tahap selanjutnya -></a>
    </div>
@endsection