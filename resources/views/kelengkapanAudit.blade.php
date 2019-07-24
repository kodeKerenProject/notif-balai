<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	@if((!is_null($dokImportir) && $dokImportir->lengkap == 2) || (!is_null($dokManufaktur) && $dokManufaktur->lengkap == 2) || (!is_null($tinjauanPP) && $tinjauanPP->lengkap == 2))
	<p style="color: red">Harap untuk mengupload dokumen - dokumen yang kurang dibawah ini</p>
	@elseif((!is_null($dokImportir) && $dokImportir->lengkap == 1) && (!is_null($dokManufaktur) && $dokManufaktur->lengkap == 1) && (!is_null($tinjauanPP) && $tinjauanPP->lengkap == 1))
	<p style="color: green">Dokumen sudah lengkap</p>
	@elseif((!is_null($dokImportir) && $dokImportir->lengkap == 3) || (!is_null($dokManufaktur) && $dokManufaktur->lengkap == 3) || (!is_null($tinjauanPP) && $tinjauanPP->lengkap == 3))
	<p style="color: yellow">Tunggu verifikasi dokumen</p>
	@endif
	<br><b><i>Perusahaan Dalam Negeri (Importir)</i></b><br>
	<form method="POST" action="{{ url('/dokAudit') }}" enctype="multipart/form-data">
		@csrf
		@if( (!is_null($dok) && is_null($dok->surat_permohonan_sertifikat_sni)) || is_null($dok) )
		<div class="dok">
			<label>1. Surat Permohonan Importir F.03.01</label><br>
			<!-- <button class="tidakAda">Tidak Ada</button><button class="ada" style="display: none;">Ada</button><br> -->
			<input class="file" type="file" name="dok[]" required="">
			<input class="fileName" type="hidden" name="fileName[]" value="surat_permohonan_sertifikat_sni,sa">
		</div>
		@endif
		@if( (!is_null($dokImportir) && is_null($dokImportir->daftar_isian_dan_kuesioner_importer)) || is_null($dokImportir) )
		<div class="dok">
			<label>2. Daftar Isian dan Kuesioner F.48.01</label><br>
			<input class="file" type="file" name="dok[]" required="">
			<input class="fileName" type="hidden" name="fileName[]" value="daftar_isian_dan_kuesioner_importer,dokImportir">
		</div>
		@endif
		@if( (!is_null($dok) && is_null($dok->copy_iui)) || is_null($dok) )
		<div class="dok">
			<label>3. Copy IUI</label><br>
			<input class="file" type="file" name="dok[]" required="">
			<input class="fileName" type="hidden" name="fileName[]" value="copy_iui,sa">
		</div>
		@endif
		<br><b><i>Perusahaan Luar Negeri (Manufaktur)</i></b><br>
		@if( (!is_null($dokManufaktur) && is_null($dokManufaktur->surat_permohonan_dari_manufaktur)) || is_null($dokManufaktur) )
		<div class="dok">
			<label>1. Surat Permohonan dari Manufaktur</label><br>
			<input class="file" type="file" name="dok[]" required="">
			<input class="fileName" type="hidden" name="fileName[]" value="surat_permohonan_dari_manufaktur,dokManufaktur">
		</div>
		@endif
		<br><b><i>Tinjauan Proses Produksi</i></b><br>
		@if( (!is_null($tinjauanPP) && is_null($tinjauanPP->struktur_organisasi)) || is_null($tinjauanPP) )
		<div class="dok">
			<label>1. Struktur Organisasi (Bhs. Inggris atau Bhs. Indonesia)</label><br>
			<input class="file" type="file" name="dok[]" required="">
			<input class="fileName" type="hidden" name="fileName[]" value="struktur_organisasi,tinjauanPP">
		</div>
		@endif
		@if((!is_null($dokImportir) && $dokImportir->lengkap == 2) || (!is_null($dokManufaktur) && $dokManufaktur->lengkap == 2) || (!is_null($tinjauanPP) && $tinjauanPP->lengkap == 2))
		<br><button id="submit" type="submit">Submit</button> | <button type="reset">Reset</button>
		@endif
	</form>
	<br>
	@if((!is_null($dokImportir) && $dokImportir->lengkap == 1) && (!is_null($dokManufaktur) && $dokManufaktur->lengkap == 1) && (!is_null($tinjauanPP) && $tinjauanPP->lengkap == 1))
	<p><b><i>Upload Audit Plan dan Sampling Plan</i></b></p>
	<form method="POST" action="{{ url('/auditPlan_upload') }}" enctype="multipart/form-data">
		@csrf
		<label>Audit Plan</label>
		<input type="file" name="auditPlan"><br>
		<label>Sampling Plan</label>
		<input type="file" name="samplingPlan"><br>
		<button type="submit">Submit</button> | <button type="reset">Reset</button>
	</form>
	@endif
</body>
</html>