@extends('home')

@section('card-header', 'Laporan Audit Kecukupan sertifikasi Produk')

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
	@if((!is_null($dokImportir) && $dokImportir->lengkap == 2) || (!is_null($dokManufaktur) && $dokManufaktur->lengkap == 2) || (!is_null($tinjauanPP) && $tinjauanPP->lengkap == 2))
	<center><p class="alert alert-primary">Permintaan upload dokumen yang kurang telah dikirm</p></center>
	@elseif((!is_null($dokImportir) && $dokImportir->lengkap == 1) && (!is_null($dokManufaktur) && $dokManufaktur->lengkap == 1) && (!is_null($tinjauanPP) && $tinjauanPP->lengkap == 1))
	<center><p class="alert alert-success">Dokumen sudah lengkap</p></center>
	@elseif((!is_null($dokImportir) && $dokImportir->lengkap == 3) || (!is_null($dokManufaktur) && $dokManufaktur->lengkap == 3) || (!is_null($tinjauanPP) && $tinjauanPP->lengkap == 3))
	<center><p class="alert alert-primary">Client telah men-upload dokumen.<br>Harap verifikasi dokumen terlebih dahulu</p></center>
	@endif
	@if(!$errors->isEmpty())
        <ul class="alert alert-danger">
        @foreach($errors->getMessages() as $key => $error)
            <li class="pl-2">{{ $error[0] }}</li>
        @endforeach
        </ul>
    @endif
    @if(!is_null($laporanAudit) && !is_null($laporanAudit->jadwal_audit_id))
    	@if(\Session::has('successMsg'))
    	<center><p class="alert alert-success">{{ \Session::get('successMsg') }}</p></center>
    	@endif
	    <div class="validMsg"></div>
		<form method="POST" action="{{ url('/dok_sert_produk') }}" enctype="multipart/form-data">
			@csrf
			<input type="hidden" name="idProduk" value="{{ $idProduk }}">
			<b><i>Perusahaan Dalam Negeri (Importir)</i></b><br>
			<div class="dok">
				<label>1. Surat Permohonan Importir F.03.01</label> | 
				<input type="radio" name="dok[0]" required="" value="ada" onclick="{{ (!is_null($dokImportir) && is_null($dokImportir->surat_permohonan_importer)) || is_null($dokImportir) ? 'return false' : '' }}" {{ !is_null($dokImportir) && !is_null($dokImportir->surat_permohonan_importer) ? 'checked' : '' }}>Lengkap
				<input type="radio" name="dok[0]" required="" value="null" onclick="{{ (!is_null($dokImportir) && is_null($dokImportir->surat_permohonan_importer)) || is_null($dokImportir) ? 'return false' : '' }}" {{ (!is_null($dokImportir) && is_null($dokImportir->surat_permohonan_importer)) || is_null($dokImportir) ? 'checked' : '' }}>Tidak Lengkap<br>
				<input class="fileName" type="hidden" name="fileName[]" value="surat_permohonan_importer,dokImportir">
				@if(!is_null($dokImportir) && !is_null($dokImportir->surat_permohonan_importer))
				<i>{{ $dokImportir->surat_permohonan_importer }}</i> |
				<a href="{{ asset('storage/dok/dokImportir/'.$dokImportir->surat_permohonan_importer) }}" target="_blank">Lihat File</a>
				<br><label>Review</label><br>
				<textarea name="review[0]">{{ !is_null($dokImportir) && !is_null($dokImportir->getReview()) ? $dokImportir->getReview()->surat_permohonan_importer : ''}}</textarea>
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
				<i>{{ $dokImportir->daftar_isian_dan_kuesioner_importer }}</i> |
				<a href="{{ asset('storage/dok/dokImportir/'.$dokImportir->daftar_isian_dan_kuesioner_importer) }}" target="_blank">Lihat File</a>
				<br><label>Review</label><br>
				<textarea name="review[1]">{{ !is_null($dokImportir) && !is_null($dokImportir->getReview()) ? $dokImportir->getReview()->daftar_isian_dan_kuesioner_importer : '' }}</textarea>
				@else
				<i>Dokumen belum ada</i>
				@endif
			</div><br>
			<div class="dok">
				<label>3. Copy IUI</label> | 
				<input type="radio" name="dok[2]" required="" value="ada" onclick="{{ (!is_null($dokImportir) && is_null($dokImportir->copy_iui)) || is_null($dokImportir) ? 'return false' : '' }}" {{ !is_null($dokImportir) && !is_null($dokImportir->copy_iui) ? 'checked' : '' }}>Lengkap
				<input type="radio" name="dok[2]" required="" value="null" onclick="{{ (!is_null($dokImportir) && is_null($dokImportir->copy_iui)) || is_null($dokImportir) ? 'return false' : '' }}" {{ (!is_null($dokImportir) && is_null($dokImportir->copy_iui)) || is_null($dokImportir) ? 'checked' : '' }}>Tidak Lengkap<br>
				<input class="fileName" type="hidden" name="fileName[]" value="copy_iui,dokImportir">
				@if(!is_null($dokImportir) && !is_null($dokImportir->copy_iui))
				<i>{{ $dokImportir->copy_iui }}</i> |
				<a href="{{ asset('storage/dok/dokImportir/'.$dokImportir->copy_iui) }}" target="_blank">Lihat File</a>
				<br><label>Review</label><br>
				<textarea name="review[2]">{{ !is_null($dokImportir) && !is_null($dokImportir->getReview()) ? $dokImportir->getReview()->copy_iui : '' }}</textarea>
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
				<i>{{ $dokManufaktur->surat_permohonan_dari_manufaktur }}</i> |
				<a href="{{ asset('storage/dok/dokManufaktur/'.$dokManufaktur->surat_permohonan_dari_manufaktur) }}" target="_blank">Lihat File</a>
				<br><label>Review</label><br>
				<textarea name="review[3]">{{ !is_null($dokManufaktur) && !is_null($dokManufaktur->getReview()) ? $dokManufaktur->getReview()->surat_permohonan_dari_manufaktur : '' }}</textarea>
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
				<i>{{ $tinjauanPP->struktur_organisasi }}</i> |
				<a href="{{ asset('storage/dok/tinjauanPP/'.$tinjauanPP->struktur_organisasi) }}" target="_blank">Lihat File</a>
				<br><label>Review</label><br>
				<textarea name="review[4]">{{ !is_null($tinjauanPP) && !is_null($tinjauanPP->getReview()) ? $tinjauanPP->getReview()->struktur_organisasi : '' }}</textarea>
				@else
				<i>Dokumen belum ada</i>
				@endif
			</div><br>
			@if(!is_null($laporanAudit) && (!is_null($dokImportir) && $dokImportir->lengkap == 2) || (!is_null($dokManufaktur) && $dokManufaktur->lengkap == 2) || (!is_null($tinjauanPP) && $tinjauanPP->lengkap == 2))
			<button type="submit">Submit</button> | <button type="reset">Reset</button>
			@endif
		</form>
	@else
	<center><p class="alert alert-primary">Surat Pemberitahuan Jadwal dan Tim Audit belum dibuat</p></center>
	@endif
@endsection