@extends('layouts/app')

@section('content')
	@if(!is_null($dok) && $dok->sni == 2)
	<p style="color: red">Harap untuk mengupload dokumen - dokumen yang kurang dibawah ini</p>
	@elseif(!is_null($dok) && $dok->sni == 1)
	<p style="color: green">Dokumen sudah lengkap</p>
	@elseif(!is_null($dok) && $dok->sni == 3)
	<p style="color: yellow">Tunggu verifikasi dokumen</p>
	@endif
	<form method="POST" action="{{ \Auth::user()->negeri == '1' ? url('sa') : url('saLuar') }}" enctype="multipart/form-data">
		@csrf
		
		@if(\Auth::user()->negeri == '1')
			@if( (!is_null($dok) && is_null($dok->surat_permohonan_sertifikat_sni)) || is_null($dok) )
			<div class="dok">
				<label>1. Surat Permohonan Sertifikasi SNI</label><br>
				<!-- <button class="tidakAda">Tidak Ada</button><button class="ada" style="display: none;">Ada</button><br> -->
				<input class="file" type="file" name="dok[]" required="">
				<input class="fileName" type="hidden" name="fileName[]" value="surat_permohonan_sertifikat_sni">
			</div>
			@endif
			@if( (!is_null($dok) && is_null($dok->daftar_isian_kuesioner)) || is_null($dok) )
			<div class="dok">
				<label>2. Daftar Isian Kuesioner</label><br>
				<input class="file" type="file" name="dok[]" required="">
				<input class="fileName" type="hidden" name="fileName[]" value="daftar_isian_kuesioner">
			</div>
			@endif
			@if( (!is_null($dok) && is_null($dok->copy_iui)) || is_null($dok) )
			<div class="dok">
				<label>3. Copy IUI</label><br>
				<input class="file" type="file" name="dok[]" required="">
				<input class="fileName" type="hidden" name="fileName[]" value="copy_iui">
			</div>
			@endif
			<br>
			@if(((!is_null($dok) && $dok->sni != 1) && (!is_null($dok) && $dok->sni != 3)) || is_null($dok))
			<button id="submit" type="submit">Submit</button> | <button type="reset">Reset</button>
			@endif
		@else
			<b><i>Produk</i></b><br>
			<label>Nama Produk</label>
			<input type="text" name="produk" required=""><br>
			<b><i>Dokumen Importir</i></b><br>
			@if( (!is_null($dokDalamNegeri) && is_null($dokDalamNegeri->surat_permohonan_sertifikat_sni)) || is_null($dokDalamNegeri) )
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
			@if( (!is_null($dokImportir) && is_null($dokImportir->copy_api)) || is_null($dokImportir) )
			<div class="dok">
				<label>3. Copy API</label><br>
				<input class="file" type="file" name="dok[]" required="">
				<input class="fileName" type="hidden" name="fileName[]" value="copy_api,dokImportir">
			</div>
			@endif
			<br>
			<b><i>Dokumen Manufaktur</i></b><br>
			@if( (!is_null($dokManufaktur) && is_null($dokManufaktur->surat_permohonan_dari_manufaktur)) || is_null($dokManufaktur) )
			<div class="dok">
				<label>1. Surat Permohonan Dari Manufaktur</label><br>
				<input class="file" type="file" name="dok[]" required="">
				<input class="fileName" type="hidden" name="fileName[]" value="surat_permohonan_dari_manufaktur,dokManufaktur">
			</div>
			@endif
			<br>
			@if(((!is_null($dok) && $dok->sni != 1) && (!is_null($dok) && $dok->sni != 3)) || is_null($dok))
			<button id="submit" type="submit">Submit</button> | <button type="reset">Reset</button>
			@endif
		@endif

	</form>
@endsection