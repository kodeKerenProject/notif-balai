<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="POST" action="{{ url('/verifySA') }}">
		@csrf
		<div class="dok">
			<label>1. Surat Permohonan Sertifikasi SNI</label> | 
			<input type="radio" name="dok[0]" required="" value="ada" onclick="{{ is_null($dok->surat_permohonan_sertifikat_sni) ? 'return false' : '' }}">Lengkap
			<input type="radio" name="dok[0]" required="" value="null" onclick="{{ is_null($dok->surat_permohonan_sertifikat_sni) ? 'return false' : '' }}" {{ is_null($dok->surat_permohonan_sertifikat_sni) ? 'checked' : '' }}>Tidak Lengkap<br>
			<input class="fileName" type="hidden" name="fileName[]" value="surat_permohonan_sertifikat_sni">
			@if(!is_null($dok->surat_permohonan_sertifikat_sni))
			<p>{{ $dok->surat_permohonan_sertifikat_sni }}</p> 
			<a href="{{ asset('dok/sa/'.$dok->surat_permohonan_sertifikat_sni) }}" target="_blank">Lihat File</a>
			@else
			<p>Dokumen belum ada</p>
			@endif
		</div>
		<div class="dok">
			<label>2. Daftar Isian Kuesioner</label> | 
			<input type="radio" name="dok[1]" required="" value="ada" onclick="{{ is_null($dok->daftar_isian_kuesioner) ? 'return false' : '' }}">Lengkap
			<input type="radio" name="dok[1]" required="" value="null" onclick="{{ is_null($dok->daftar_isian_kuesioner) ? 'return false' : '' }}" {{ is_null($dok->daftar_isian_kuesioner) ? 'checked' : '' }}>Tidak Lengkap<br>
			<input class="fileName" type="hidden" name="fileName[]" value="daftar_isian_kuesioner">
			@if(!is_null($dok->daftar_isian_kuesioner))
			<p>{{ $dok->daftar_isian_kuesioner }}</p>
			<a href="{{ asset('dok/sa/'.$dok->daftar_isian_kuesioner) }}" target="_blank">Lihat File</a>
			@else
			<p>Dokumen belum ada</p>
			@endif
		</div>
		<div class="dok">
			<label>3. Copy IUI</label> | 
			<input type="radio" name="dok[2]" required="" value="ada" onclick="{{ is_null($dok->copy_iui) ? 'return false' : '' }}">Lengkap
			<input type="radio" name="dok[2]" required="" value="null" onclick="{{ is_null($dok->copy_iui) ? 'return false' : '' }}" {{ is_null($dok->copy_iui) ? 'checked' : '' }}>Tidak Lengkap<br>
			<input class="fileName" type="hidden" name="fileName[]" value="copy_iui">
			@if(!is_null($dok->copy_iui))
			<p>{{ $dok->copy_iui }}</p> 
			<a href="{{ asset('dok/sa/'.$dok->copy_iui) }}" target="_blank">Lihat File</a>
			@else
			<p>Dokumen belum ada</p>
			@endif
		</div>
		<button type="submit">Kirim hasil kelengkapan dokumen</button><button type="reset">Reset</button>
		@if($dok->sni == 1)
		<br><br>
		Client x sudah menlengkapi dokumen!<br>
		<form method="POST" action="{{ url('mou') }}">
			<button type="submit">Buat MOU</button>
		</form>
		@endif
	</form>
</body>
</html>