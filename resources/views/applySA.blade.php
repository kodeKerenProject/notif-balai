<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	@if(!is_null($dok) && $dok->sni == 2)
	<p style="color: red">Harap untuk mengupload dokumen - dokumen yang kurang dibawah ini</p>
	@elseif(!is_null($dok) && $dok->sni == 1)
	<p style="color: green">Dokumen sudah lengkap</p>
	@elseIf(!is_null($dok) && $dok->sni == 3)
	<p style="color: yellow">Tunggu verifikasi dokumen</p>
	@endif
	<form method="POST" action="{{ url('sa') }}" enctype="multipart/form-data">
		@csrf
		@if( (!is_null($dok) && is_null($dok->surat_permohonan_sertifikat_sni)) || is_null($dok) )
		<div class="dok">
			<label>1. Surat Permohonan Sertifikasi SNI</label> | 
			<button class="tidakAda">Tidak Ada</button><button class="ada" style="display: none;">Ada</button><br>
			<input class="file" type="file" name="dok[]" required="">
			<input class="fileName" type="hidden" name="fileName[]" value="surat_permohonan_sertifikat_sni">
		</div>
		@endif
		@if( (!is_null($dok) && is_null($dok->daftar_isian_kuesioner)) || is_null($dok) )
		<div class="dok">
			<label>2. Daftar Isian Kuesioner</label> | 
			<button class="tidakAda">Tidak Ada</button><button class="ada" style="display: none;">Ada</button><br>
			<input class="file" type="file" name="dok[]" required="">
			<input class="fileName" type="hidden" name="fileName[]" value="daftar_isian_kuesioner">
		</div>
		@endif
		@if( (!is_null($dok) && is_null($dok->copy_iui)) || is_null($dok) )
		<div class="dok">
			<label>3. Copy IUI</label> | 
			<button class="tidakAda">Tidak Ada</button><button class="ada" style="display: none;">Ada</button><br>
			<input class="file" type="file" name="dok[]" required="">
			<input class="fileName" type="hidden" name="fileName[]" value="copy_iui">
		</div>
		@endif
		<br>
		@if((!is_null($dok) && $dok->sni != 1) && (!is_null($dok) && $dok->sni != 3))
		<button id="submit" type="submit">Submit</button> | <button type="reset">Reset</button>
		@endif
	</form>
	<script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/Jsscript.js') }}"></script>
</body>
</html>