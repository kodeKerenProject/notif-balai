@extends('home')

@section('card-header', 'Verifikasi Dokumen Sertifikasi Awal')

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
	@if(!is_null($dok) && $dok->sni == 1)
    <center><p class="alert alert-success">Dokumen sudah lengkap</p></center>
    @endif
	<form method="POST" action="{{ $user->negeri == 1 ? url('/verifySA/'.$idProduk) : url('/verifySALuar/'.$idProduk) }}">
		@csrf
		@if($user->negeri == 1)
			<div class="dok">
				<label>1. Surat Permohonan Sertifikasi SNI</label> | 
				<input type="radio" name="dok[0]" required="" value="ada" onclick="{{ (!is_null($dok) && is_null($dok->surat_permohonan_sertifikat_sni)) || is_null($dok) ? 'return false' : '' }}" {{ !is_null($dok) && !is_null($dok->surat_permohonan_sertifikat_sni) ? 'checked' : '' }}>Lengkap
				<input type="radio" name="dok[0]" required="" value="null" onclick="{{ 
					(!is_null($dok) && is_null($dok->surat_permohonan_sertifikat_sni)) || is_null($dok) ? 'return false' : '' }}" {{ (!is_null($dok) && is_null($dok->surat_permohonan_sertifikat_sni)) || is_null($dok) ? 'checked' : '' }}>Tidak Lengkap<br>
				<input class="fileName" type="hidden" name="fileName[]" value="surat_permohonan_sertifikat_sni">
				@if(!is_null($dok) && !is_null($dok->surat_permohonan_sertifikat_sni))
				{{ $dok->surat_permohonan_sertifikat_sni }} | 
				<a href="{{ asset('storage/dok/sa/'.$dok->surat_permohonan_sertifikat_sni) }}" target="_blank">Lihat File</a>
				@else
				<p>Dokumen belum ada</p>
				@endif
			</div><br>
			<div class="dok">
				<label>2. Daftar Isian Kuesioner</label> | 
				<input type="radio" name="dok[1]" required="" value="ada" onclick="{{ (!is_null($dok) && is_null($dok->daftar_isian_kuesioner)) || is_null($dok) ? 'return false' : '' }}" {{ !is_null($dok) && !is_null($dok->daftar_isian_kuesioner) ? 'checked' : '' }}>Lengkap
				<input type="radio" name="dok[1]" required="" value="null" onclick="{{ (!is_null($dok) && is_null($dok->daftar_isian_kuesioner)) || is_null($dok) ? 'return false' : '' }}" {{ (!is_null($dok) && is_null($dok->daftar_isian_kuesioner)) || is_null($dok) ? 'checked' : '' }}>Tidak Lengkap<br>
				<input class="fileName" type="hidden" name="fileName[]" value="daftar_isian_kuesioner">
				@if(!is_null($dok) && !is_null($dok->daftar_isian_kuesioner))
				{{ $dok->daftar_isian_kuesioner }} |
				<a href="{{ asset('storage/dok/sa/'.$dok->daftar_isian_kuesioner) }}" target="_blank">Lihat File</a>
				@else
				<p>Dokumen belum ada</p>
				@endif
			</div><br>
			<div class="dok">
				<label>3. Copy IUI</label> | 
				<input type="radio" name="dok[2]" required="" value="ada" onclick="{{ (!is_null($dok) && is_null($dok->copy_iui)) || is_null($dok) ? 'return false' : '' }}" {{ !is_null($dok) && !is_null($dok->copy_iui) ? 'checked' : '' }}>Lengkap
				<input type="radio" name="dok[2]" required="" value="null" onclick="{{ (!is_null($dok) && is_null($dok->copy_iui)) || is_null($dok) ? 'return false' : '' }}" {{ (!is_null($dok) && is_null($dok->copy_iui)) || is_null($dok) ? 'checked' : '' }}>Tidak Lengkap<br>
				<input class="fileName" type="hidden" name="fileName[]" value="copy_iui">
				@if(!is_null($dok) && !is_null($dok->copy_iui))
				{{ $dok->copy_iui }} | 
				<a href="{{ asset('storage/dok/sa/'.$dok->copy_iui) }}" target="_blank">Lihat File</a>
				@else
				<p>Dokumen belum ada</p>
				@endif
			</div><br>
			@if((!is_null($dok) && $dok->sni != 1) || is_null($dok))
			<button type="submit">Kirim hasil kelengkapan dokumen</button><button type="reset">Reset</button>
			@endif
		@else
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
			@if((!is_null($dok) && $dok->sni != 1) || is_null($dok))
				<button type="submit">Kirim hasil kelengkapan dokumen</button><button type="reset">Reset</button>
			@endif
		@endif
	</form><br>
	<div class="text-right">
        <a href="{{ url('/bidPrice/'.$user->id.'/sert/'.$idProduk) }}" class="btn btn-primary">Tahap selanjutnya -></a>
    </div>
@endsection