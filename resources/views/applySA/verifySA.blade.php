@extends('company.company_product')

@section('content2')
	<form method="POST" action="{{ url('/verifySA') }}">
		@csrf
		@if(\Auth::user()->negeri == 1)
			<div class="dok">
				<label>1. Surat Permohonan Sertifikasi SNI</label> | 
				<input type="radio" name="dok[0]" required="" value="ada" onclick="{{ (!is_null($dok) && is_null($dok->surat_permohonan_sertifikat_sni)) || is_null($dok) ? 'return false' : '' }}" {{ !is_null($dok) && !is_null($dok->surat_permohonan_sertifikat_sni) ? 'checked' : '' }}>Lengkap
				<input type="radio" name="dok[0]" required="" value="null" onclick="{{ 
					(!is_null($dok) && is_null($dok->surat_permohonan_sertifikat_sni)) || is_null($dok) ? 'return false' : '' }}" {{ (!is_null($dok) && is_null($dok->surat_permohonan_sertifikat_sni)) || is_null($dok) ? 'checked' : '' }}>Tidak Lengkap<br>
				<input class="fileName" type="hidden" name="fileName[]" value="surat_permohonan_sertifikat_sni">
				@if(!is_null($dok) && !is_null($dok->surat_permohonan_sertifikat_sni))
				<p>{{ $dok->surat_permohonan_sertifikat_sni }}</p> 
				<a href="{{ asset('dok/sa/'.$dok->surat_permohonan_sertifikat_sni) }}" target="_blank">Lihat File</a>
				@else
				<p>Dokumen belum ada</p>
				@endif
			</div>
			<div class="dok">
				<label>2. Daftar Isian Kuesioner</label> | 
				<input type="radio" name="dok[1]" required="" value="ada" onclick="{{ (!is_null($dok) && is_null($dok->daftar_isian_kuesioner)) || is_null($dok) ? 'return false' : '' }}" {{ !is_null($dok) && !is_null($dok->daftar_isian_kuesioner) ? 'checked' : '' }}>Lengkap
				<input type="radio" name="dok[1]" required="" value="null" onclick="{{ (!is_null($dok) && is_null($dok->daftar_isian_kuesioner)) || is_null($dok) ? 'return false' : '' }}" {{ (!is_null($dok) && is_null($dok->daftar_isian_kuesioner)) || is_null($dok) ? 'checked' : '' }}>Tidak Lengkap<br>
				<input class="fileName" type="hidden" name="fileName[]" value="daftar_isian_kuesioner">
				@if(!is_null($dok) && !is_null($dok->daftar_isian_kuesioner))
				<p>{{ $dok->daftar_isian_kuesioner }}</p>
				<a href="{{ asset('dok/sa/'.$dok->daftar_isian_kuesioner) }}" target="_blank">Lihat File</a>
				@else
				<p>Dokumen belum ada</p>
				@endif
			</div>
			<div class="dok">
				<label>3. Copy IUI</label> | 
				<input type="radio" name="dok[2]" required="" value="ada" onclick="{{ (!is_null($dok) && is_null($dok->copy_iui)) || is_null($dok) ? 'return false' : '' }}" {{ !is_null($dok) && !is_null($dok->copy_iui) ? 'checked' : '' }}>Lengkap
				<input type="radio" name="dok[2]" required="" value="null" onclick="{{ (!is_null($dok) && is_null($dok->copy_iui)) || is_null($dok) ? 'return false' : '' }}" {{ (!is_null($dok) && is_null($dok->copy_iui)) || is_null($dok) ? 'checked' : '' }}>Tidak Lengkap<br>
				<input class="fileName" type="hidden" name="fileName[]" value="copy_iui">
				@if(!is_null($dok) && !is_null($dok->copy_iui))
				<p>{{ $dok->copy_iui }}</p>
				<a href="{{ asset('dok/sa/'.$dok->copy_iui) }}" target="_blank">Lihat File</a>
				@else
				<p>Dokumen belum ada</p>
				@endif
			</div>
			<button type="submit">Kirim hasil kelengkapan dokumen</button><button type="reset">Reset</button>
		@else
			<h4>Apply SA >> Verifikasi SA </h4>
			<b><i>Dok Importir</i></b><br>
			<div class="dok">
				<label>1. Surat Permohonan Sertifikasi SNI</label> | 
				<input type="radio" name="dok[0]" required="" value="ada" onclick="{{ (!is_null($dok) && is_null($dok->surat_permohonan_sertifikat_sni)) || is_null($dok) ? 'return false' : '' }}" {{ !is_null($dok) && !is_null($dok->surat_permohonan_sertifikat_sni) ? 'checked' : '' }}>Lengkap
				<input type="radio" name="dok[0]" required="" value="null" onclick="{{ 
					(!is_null($dok) && is_null($dok->surat_permohonan_sertifikat_sni)) || is_null($dok) ? 'return false' : '' }}" {{ (!is_null($dok) && is_null($dok->surat_permohonan_sertifikat_sni)) || is_null($dok) ? 'checked' : '' }}>Tidak Lengkap<br>
				<input class="fileName" type="hidden" name="fileName[]" value="surat_permohonan_sertifikat_sni">
				@if(!is_null($dok) && !is_null($dok->surat_permohonan_sertifikat_sni))
				<p>{{ $dok->surat_permohonan_sertifikat_sni }}</p> 
				<a href="{{ asset('dok/sa/'.$dok->surat_permohonan_sertifikat_sni) }}" target="_blank">Lihat File</a>
				@else
				<p>Dokumen belum ada</p>
				@endif
			</div>
			<div class="dok">
				<label>2. Daftar Isian dan Kuesioner F.48.01</label> | 
				<input type="radio" name="dok[1]" required="" value="ada" onclick="{{ (!is_null($dokImportir) && is_null($dokImportir->daftar_isian_dan_kuesioner_importer)) || is_null($dokImportir) ? 'return false' : '' }}" {{ !is_null($dokImportir) && !is_null($dokImportir->daftar_isian_dan_kuesioner_importer) ? 'checked' : '' }}>Lengkap
				<input type="radio" name="dok[1]" required="" value="null" onclick="{{ (!is_null($dokImportir) && is_null($dokImportir->daftar_isian_dan_kuesioner_importer)) || is_null($dokImportir) ? 'return false' : '' }}" {{ (!is_null($dokImportir) && is_null($dokImportir->daftar_isian_dan_kuesioner_importer)) || is_null($dokImportir) ? 'checked' : '' }}>Tidak Lengkap<br>
				<input class="fileName" type="hidden" name="fileName[]" value="daftar_isian_dan_kuesioner_importer">
				@if(!is_null($dokImportir) && !is_null($dokImportir->daftar_isian_dan_kuesioner_importer))
				<p>{{ $dokImportir->daftar_isian_dan_kuesioner_importer }}</p>
				<a href="{{ asset('dok/sa/'.$dokImportir->daftar_isian_dan_kuesioner_importer) }}" target="_blank">Lihat File</a>
				@else
				<p>Dokumen belum ada</p>
				@endif
			</div>
			<div class="dok">
				<label>3. Copy API</label> | 
				<input type="radio" name="dok[2]" required="" value="ada" onclick="{{ (!is_null($dokImportir) && is_null($dokImportir->copy_api)) || is_null($dokImportir) ? 'return false' : '' }}" {{ !is_null($dokImportir) && !is_null($dokImportir->copy_api) ? 'checked' : '' }}>Lengkap
				<input type="radio" name="dok[2]" required="" value="null" onclick="{{ (!is_null($dokImportir) && is_null($dokImportir->copy_api)) || is_null($dokImportir) ? 'return false' : '' }}" {{ (!is_null($dokImportir) && is_null($dokImportir->copy_api)) || is_null($dokImportir) ? 'checked' : '' }}>Tidak Lengkap<br>
				<input class="fileName" type="hidden" name="fileName[]" value="copy_api">
				@if(!is_null($dokImportir) && !is_null($dokImportir->copy_api))
				<p>{{ $dokImportir->copy_api }}</p>
				<a href="{{ asset('dok/sa/'.$dokImportir->copy_api) }}" target="_blank">Lihat File</a>
				@else
				<p>Dokumen belum ada</p>
				@endif
			</div>
			<br>
			<b><i>Dok Manufaktur</i></b><br>
			<div class="dok">
				<label>1. Surat Permohonan Dari Manufaktur</label> | 
				<input type="radio" name="dok[2]" required="" value="ada" onclick="{{ (!is_null($dokManufaktur) && is_null($dokManufaktur->surat_permohonan_dari_manufaktur)) || is_null($dokManufaktur) ? 'return false' : '' }}" {{ !is_null($dokManufaktur) && !is_null($dokManufaktur->surat_permohonan_dari_manufaktur) ? 'checked' : '' }}>Lengkap
				<input type="radio" name="dok[2]" required="" value="null" onclick="{{ (!is_null($dokManufaktur) && is_null($dokManufaktur->surat_permohonan_dari_manufaktur)) || is_null($dokManufaktur) ? 'return false' : '' }}" {{ (!is_null($dokManufaktur) && is_null($dokManufaktur->surat_permohonan_dari_manufaktur)) || is_null($dokManufaktur) ? 'checked' : '' }}>Tidak Lengkap<br>
				<input class="fileName" type="hidden" name="fileName[]" value="surat_permohonan_dari_manufaktur">
				@if(!is_null($dokManufaktur) && !is_null($dokManufaktur->surat_permohonan_dari_manufaktur))
				<p>{{ $dokManufaktur->surat_permohonan_dari_manufaktur }}</p>
				<a href="{{ asset('dok/sa/'.$dokManufaktur->surat_permohonan_dari_manufaktur) }}" target="_blank">Lihat File</a>
				@else
				<p>Dokumen belum ada</p>
				@endif
			</div>
			<button type="submit">Kirim hasil kelengkapan dokumen</button><button type="reset">Reset</button>
		@endif
	</form>
	<br><br>
	<!-- @if((!is_null($dok) && $dok->sni == 1 && is_null($mou)) || (!is_null($mou) && $mou->status == null))
	Client x sudah menlengkapi dokumen!<br>
	Form pembuatan MOU.
	<form method="POST" action="{{ url('/mou_create') }}">
		@csrf
		<label>Nama</label>
		<input type="text" name="nama" required=""><br>
		<label>Produk</label>
		<input type="text" name="produk" required=""><br>
		<button type="submit">Buat MOU</button> | <button type="reset">Reset</button>
	</form>
	@elseif((!is_null($mou) && $mou->status != null))
	MoU telah dibuat.
	@endif
	@if(!is_null($mou) && strtotime(date('Y-m-d H:i:s')) > strtotime($mou->created_at) && $mou->status != 2)
	<br>
	Fitur upload MoU yang sudah ditandatangani client x telah dikunci.
	<form method="POST" action="{{ url('/unlock_mou') }}">
		@csrf
		<button type="submit">Buka Fitur MoU</button>
	</form> -->
	@endif
@endsection