<b><i>Dok Importir</i></b><br>
<div class="dok">
	<label>1. Surat Permohonan Sertifikasi SNI</label> | 
	<input type="radio" name="dok[]" required="" value="ada" onclick="{{ (!is_null($dokDalamNegeri) && is_null($dokDalamNegeri->surat_permohonan_sertifikat_sni)) || is_null($dokDalamNegeri) ? 'return false' : '' }}" {{ !is_null($dokDalamNegeri) && !is_null($dokDalamNegeri->surat_permohonan_sertifikat_sni) ? 'checked' : '' }}>Lengkap
	<input type="radio" name="dok[]" required="" value="null" onclick="{{ 
		(!is_null($dokDalamNegeri) && is_null($dokDalamNegeri->surat_permohonan_sertifikat_sni)) || is_null($dokDalamNegeri) ? 'return false' : '' }}" {{ (!is_null($dokDalamNegeri) && is_null($dokDalamNegeri->surat_permohonan_sertifikat_sni)) || is_null($dokDalamNegeri) ? 'checked' : '' }}>Tidak Lengkap<br>
	<input class="fileName" type="hidden" name="fileName[]" value="surat_permohonan_sertifikat_sni,sa">
	@if(!is_null($dokDalamNegeri) && !is_null($dokDalamNegeri->surat_permohonan_sertifikat_sni))
	{{ $dokDalamNegeri->surat_permohonan_sertifikat_sni }} | 
	<a href="{{ asset('storage/dok/sa/'.$dokDalamNegeri->surat_permohonan_sertifikat_sni) }}" target="_blank">Lihat File</a>
	@else
	<p>Dokumen belum ada</p>
	@endif
</div><br>
<div class="dok">
	<label>2. Daftar Isian dan Kuesioner F.48.01</label> | 
	<input type="radio" name="dok[]" required="" value="ada" onclick="{{ (!is_null($dokImportir) && is_null($dokImportir->daftar_isian_dan_kuesioner_importer)) || is_null($dokImportir) ? 'return false' : '' }}" {{ !is_null($dokImportir) && !is_null($dokImportir->daftar_isian_dan_kuesioner_importer) ? 'checked' : '' }}>Lengkap
	<input type="radio" name="dok[]" required="" value="null" onclick="{{ (!is_null($dokImportir) && is_null($dokImportir->daftar_isian_dan_kuesioner_importer)) || is_null($dokImportir) ? 'return false' : '' }}" {{ (!is_null($dokImportir) && is_null($dokImportir->daftar_isian_dan_kuesioner_importer)) || is_null($dokImportir) ? 'checked' : '' }}>Tidak Lengkap<br>
	<input class="fileName" type="hidden" name="fileName[]" value="daftar_isian_dan_kuesioner_importer,dokImportir">
	@if(!is_null($dokImportir) && !is_null($dokImportir->daftar_isian_dan_kuesioner_importer))
	{{ $dokImportir->daftar_isian_dan_kuesioner_importer }} | 
	<a href="{{ asset('storage/dok/dokImportir/'.$dokImportir->daftar_isian_dan_kuesioner_importer) }}" target="_blank">Lihat File</a>
	@else
	<p>Dokumen belum ada</p>
	@endif
</div><br>
<div class="dok">
	<label>3. Copy API</label> | 
	<input type="radio" name="dok[]" required="" value="ada" onclick="{{ (!is_null($dokImportir) && is_null($dokImportir->copy_api)) || is_null($dokImportir) ? 'return false' : '' }}" {{ !is_null($dokImportir) && !is_null($dokImportir->copy_api) ? 'checked' : '' }}>Lengkap
	<input type="radio" name="dok[]" required="" value="null" onclick="{{ (!is_null($dokImportir) && is_null($dokImportir->copy_api)) || is_null($dokImportir) ? 'return false' : '' }}" {{ (!is_null($dokImportir) && is_null($dokImportir->copy_api)) || is_null($dokImportir) ? 'checked' : '' }}>Tidak Lengkap<br>
	<input class="fileName" type="hidden" name="fileName[]" value="copy_api,dokImportir">
	@if(!is_null($dokImportir) && !is_null($dokImportir->copy_api))
	{{ $dokImportir->copy_api }} | 
	<a href="{{ asset('storage/dok/dokImportir/'.$dokImportir->copy_api) }}" target="_blank">Lihat File</a>
	@else
	<p>Dokumen belum ada</p>
	@endif
</div><br>
<br>
<b><i>Dok Manufaktur</i></b><br>
<div class="dok">
	<label>1. Surat Permohonan Dari Manufaktur</label> | 
	<input type="radio" name="dok[]" required="" value="ada" onclick="{{ (!is_null($dokManufaktur) && is_null($dokManufaktur->surat_permohonan_dari_manufaktur)) || is_null($dokManufaktur) ? 'return false' : '' }}" {{ !is_null($dokManufaktur) && !is_null($dokManufaktur->surat_permohonan_dari_manufaktur) ? 'checked' : '' }}>Lengkap
	<input type="radio" name="dok[]" required="" value="null" onclick="{{ (!is_null($dokManufaktur) && is_null($dokManufaktur->surat_permohonan_dari_manufaktur)) || is_null($dokManufaktur) ? 'return false' : '' }}" {{ (!is_null($dokManufaktur) && is_null($dokManufaktur->surat_permohonan_dari_manufaktur)) || is_null($dokManufaktur) ? 'checked' : '' }}>Tidak Lengkap<br>
	<input class="fileName" type="hidden" name="fileName[]" value="surat_permohonan_dari_manufaktur,dokManufaktur">
	@if(!is_null($dokManufaktur) && !is_null($dokManufaktur->surat_permohonan_dari_manufaktur))
	{{ $dokManufaktur->surat_permohonan_dari_manufaktur }} | 
	<a href="{{ asset('storage/dok/dokManufaktur/'.$dokManufaktur->surat_permohonan_dari_manufaktur) }}" target="_blank">Lihat File</a>
	@else
	<p>Dokumen belum ada</p>
	@endif
</div><br>