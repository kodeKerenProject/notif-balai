<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	@if(!is_null($dok) && !is_null($dok->bukti_bayar) && is_null($jadwalAudit))
	Upload Surat Pemberitahuan Jadwal Audit<br>
	<form method="POST" action="{{ url('/suratJA_upload') }}" enctype="multipart/form-data">
		@csrf
		<input type="file" name="dok"><br>
		<button type="submit">Submit</button>
	</form>
	@elseif(!is_null($dok) && !is_null($dok->bukti_bayar) && !is_null($jadwalAudit))
	Surat Pemberitahuan Jadwal Audit telah diupload
	@else
	Upload Surat Pemberitahuan Jadwal Audit masih dikunci
	@endif
	<form method="POST" action="{{ url('/dok_sert_produk') }}" enctype="multipart/form-data">
		@csrf
		<b><i>Perusahaan Dalam Negeri (Importir)</i></b><br>
		<div class="dok">
			<label>1. Surat Permohonan Importir F.03.01</label> | 
			<input type="radio" name="dok[0]" required="" value="ada" onclick="{{ (!is_null($dokDalamNegeri) && is_null($dokDalamNegeri->surat_permohonan_sertifikat_sni)) || is_null($dokDalamNegeri) ? 'return false' : '' }}" {{ !is_null($dokDalamNegeri) && !is_null($dokDalamNegeri->surat_permohonan_sertifikat_sni) ? 'checked' : '' }}>Lengkap
			<input type="radio" name="dok[0]" required="" value="null" onclick="{{ (!is_null($dokDalamNegeri) && is_null($dokDalamNegeri->surat_permohonan_sertifikat_sni)) || is_null($dokDalamNegeri) ? 'return false' : '' }}" {{ (!is_null($dokDalamNegeri) && is_null($dokDalamNegeri->surat_permohonan_sertifikat_sni)) || is_null($dokDalamNegeri) ? 'checked' : '' }}>Tidak Lengkap<br>
			<input class="fileName" type="hidden" name="fileName[]" value="surat_permohonan_sertifikat_sni,sa">
			@if(!is_null($dokDalamNegeri) && !is_null($dokDalamNegeri->surat_permohonan_sertifikat_sni))
			<i>{{ $dokDalamNegeri->surat_permohonan_sertifikat_sni }}</i>
			<a href="{{ asset('dok/sa/'.$dokDalamNegeri->surat_permohonan_sertifikat_sni) }}" target="_blank">Lihat File</a>
			<br><label>Review</label><br>
			<textarea name="review[0]">{{ !is_null($dokDalamNegeri->getDokImpor()->first())? $dokDalamNegeri->getDokImpor()->first()->getReview()->first()->surat_permohonan_sertifikat_sni : ''}}</textarea>
			@else
			<i>Dokumen belum ada</i>
			@endif
		</div><br>
		<div class="dok">
			<label>2. Daftar Isian dan Kuesioner F.48.01</label> | 
			<input type="radio" name="dok[1]" required="" value="ada" onclick="{{ (!is_null($dokImportir) && is_null($dokImportir->daftar_isian_dan_kuesioner_importer)) || is_null($dokImportir) ? 'return false' : '' }}" {{ !is_null($dokImportir) && !is_null($dokImportir->daftar_isian_dan_kuesioner_importer) ? 'checked' : '' }}>Lengkap
			<input type="radio" name="dok[1]" required="" value="null" onclick="{{ (!is_null($dokImportir) && is_null($dokImportir->daftar_isian_dan_kuesioner_importer)) || is_null($dokImportir) ? 'return false' : '' }}" {{ (!is_null($dokImportir) && is_null($dokImportir->daftar_isian_dan_kuesioner_importer)) || is_null($dokImportir) ? 'checked' : '' }}>Tidak Lengkap<br>
			<input class="fileName" type="hidden" name="fileName[]" value="daftar_isian_dan_kuesioner_importer,dokImportir">
			@if(!is_null($dokImportir) && !is_null($dokImportir->daftar_isian_dan_kuesioner_importer))
			<i>{{ $dokImportir->daftar_isian_dan_kuesioner_importer }}</i>
			<a href="{{ asset('dok/dokImportir/'.$dokImportir->daftar_isian_dan_kuesioner_importer) }}" target="_blank">Lihat File</a>
			<br><label>Review</label><br>
			<textarea name="review[1]">{{ !is_null($dokImportir->getReview()->first()) ? $dokImportir->getReview()->first()->daftar_isian_dan_kuesioner_importer : '' }}</textarea>
			@else
			<i>Dokumen belum ada</i>
			@endif
		</div><br>
		<div class="dok">
			<label>3. Copy IUI</label> | 
			<input type="radio" name="dok[2]" required="" value="ada" onclick="{{ (!is_null($dokDalamNegeri) && is_null($dokDalamNegeri->copy_iui)) || is_null($dokDalamNegeri) ? 'return false' : '' }}" {{ !is_null($dokDalamNegeri) && !is_null($dokDalamNegeri->copy_iui) ? 'checked' : '' }}>Lengkap
			<input type="radio" name="dok[2]" required="" value="null" onclick="{{ (!is_null($dokDalamNegeri) && is_null($dokDalamNegeri->copy_iui)) || is_null($dokDalamNegeri) ? 'return false' : '' }}" {{ (!is_null($dokDalamNegeri) && is_null($dokDalamNegeri->copy_iui)) || is_null($dokDalamNegeri) ? 'checked' : '' }}>Tidak Lengkap<br>
			<input class="fileName" type="hidden" name="fileName[]" value="copy_iui,sa">
			@if(!is_null($dokDalamNegeri) && !is_null($dokDalamNegeri->copy_iui))
			<i>{{ $dokDalamNegeri->copy_iui }}</i>
			<a href="{{ asset('dok/sa/'.$dokDalamNegeri->copy_iui) }}" target="_blank">Lihat File</a>
			<br><label>Review</label><br>
			<textarea name="review[2]">{{ !is_null($dokDalamNegeri->getDokImpor()->first()) ? $dokDalamNegeri->getDokImpor()->first()->getReview()->first()->copy_iui : '' }}</textarea>
			@else
			<i>Dokumen belum ada</i>
			@endif
		</div><br>
		<b><i>Perusahaan Luar Negeri (Manufaktur)</i></b><br>
		<div class="dok">
			<label>1. Surat Permohonan F.46 dari Manufaktur</label> | 
			<input type="radio" name="dok[3]" required="" value="ada" onclick="{{ (!is_null($dokManufaktur) && is_null($dokManufaktur->surat_permohonan_dari_manufaktur)) || is_null($dokManufaktur) ? 'return false' : '' }}" {{ !is_null($dokManufaktur) && !is_null($dokManufaktur->surat_permohonan_dari_manufaktur) ? 'checked' : '' }}>Lengkap
			<input type="radio" name="dok[3]" required="" value="null" onclick="{{ (!is_null($dokManufaktur) && is_null($dokManufaktur->surat_permohonan_dari_manufaktur)) || is_null($dokManufaktur) ? 'return false' : '' }}" {{ (!is_null($dokManufaktur) && is_null($dokManufaktur->surat_permohonan_dari_manufaktur)) || is_null($dokManufaktur) ? 'checked' : '' }}>Tidak Lengkap<br>
			<input class="fileName" type="hidden" name="fileName[]" value="surat_permohonan_dari_manufaktur,dokManufaktur">
			@if(!is_null($dokManufaktur) && !is_null($dokManufaktur->surat_permohonan_dari_manufaktur))
			<i>{{ $dokManufaktur->surat_permohonan_dari_manufaktur }}</i>
			<a href="{{ asset('dok/dokManufaktur/'.$dokManufaktur->surat_permohonan_dari_manufaktur) }}" target="_blank">Lihat File</a>
			<br><label>Review</label><br>
			<textarea name="review[3]">{{ !is_null($dokManufaktur->getReview()->first()) ? $dokManufaktur->getReview()->first()->surat_permohonan_dari_manufaktur : '' }}</textarea>
			@else
			<i>Dokumen belum ada</i>
			@endif
		</div><br>
		<b><i>Tinjauan Proses Produksi</i></b><br>
		<div class="dok">
			<label>1. Struktur Organisasi (Bhs. Inggris atau Bhs. Indonesia)</label> | 
			<input type="radio" name="dok[4]" required="" value="ada" onclick="{{ (!is_null($tinjauanPP) && is_null($tinjauanPP->struktur_organisasi)) || is_null($tinjauanPP) ? 'return false' : '' }}" {{ !is_null($tinjauanPP) && !is_null($tinjauanPP->struktur_organisasi) ? 'checked' : '' }}>Lengkap
			<input type="radio" name="dok[4]" required="" value="null" onclick="{{ (!is_null($tinjauanPP) && is_null($tinjauanPP->struktur_organisasi)) || is_null($tinjauanPP) ? 'return false' : '' }}" {{ (!is_null($tinjauanPP) && is_null($tinjauanPP->struktur_organisasi)) || is_null($tinjauanPP) ? 'checked' : '' }}>Tidak Lengkap<br>
			<input class="fileName" type="hidden" name="fileName[]" value="struktur_organisasi,tinjauanPP">
			@if(!is_null($tinjauanPP) && !is_null($tinjauanPP->struktur_organisasi))
			<i>{{ $tinjauanPP->struktur_organisasi }}</i>
			<a href="{{ asset('dok/sa/'.$tinjauanPP->struktur_organisasi) }}" target="_blank">Lihat File</a>
			<br><label>Review</label><br>
			<textarea name="review[4]">{{ $tinjauanPP->getReview()->first()->struktur_organisasi }}</textarea>
			@else
			<i>Dokumen belum ada</i>
			@endif
		</div><br>
		@if(!is_null($laporanAudit))
		<button type="submit">Submit</button> | <button type="reset">Reset</button>
		@else
		<i><b>Kecukupan sertifikasi produk masih dikunci</b></i>
		@endif
	</form>
</body>
</html>