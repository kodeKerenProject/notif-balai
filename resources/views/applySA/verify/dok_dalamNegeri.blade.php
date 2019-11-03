<div class="dok">
	{{-- <label>1. Surat Permohonan Sertifikasi SNI</label> | 
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
</div><br> --}}
<div class="dok">
	<label>1. Copy IUI</label> | 
	<input type="radio" name="dok[0]" required="" value="ada" onclick="{{ (!is_null($dok) && is_null($dok->copy_iui)) || is_null($dok) ? 'return false' : '' }}" {{ !is_null($dok) && !is_null($dok->copy_iui) ? 'checked' : '' }}>Lengkap
	<input type="radio" name="dok[0]" required="" value="null" onclick="{{ (!is_null($dok) && is_null($dok->copy_iui)) || is_null($dok) ? 'return false' : '' }}" {{ (!is_null($dok) && is_null($dok->copy_iui)) || is_null($dok) ? 'checked' : '' }}>Tidak Lengkap<br>
	<input class="fileName" type="hidden" name="fileName[]" value="copy_iui">
	@if(!is_null($dok) && !is_null($dok->copy_iui))
	{{ $dok->copy_iui }} | 
	<a href="{{ asset('storage/dok/sa/'.$dok->copy_iui) }}" target="_blank">Lihat File</a>
	@else
	<p>Dokumen belum ada</p>
	@endif
</div><br>
<div class="dok">
	<label>2. Copy Akte Notaris Perusahaan</label> | 
	<input type="radio" name="dok[1]" required="" value="ada" onclick="{{ (!is_null($dok) && is_null($dok->copy_akte_notaris_perusahaan)) || is_null($dok) ? 'return false' : '' }}" {{ !is_null($dok) && !is_null($dok->copy_akte_notaris_perusahaan) ? 'checked' : '' }}>Lengkap
	<input type="radio" name="dok[1]" required="" value="null" onclick="{{ (!is_null($dok) && is_null($dok->copy_akte_notaris_perusahaan)) || is_null($dok) ? 'return false' : '' }}" {{ (!is_null($dok) && is_null($dok->copy_akte_notaris_perusahaan)) || is_null($dok) ? 'checked' : '' }}>Tidak Lengkap<br>
	<input class="fileName" type="hidden" name="fileName[]" value="copy_akte_notaris_perusahaan">
	@if(!is_null($dok) && !is_null($dok->copy_akte_notaris_perusahaan))
	{{ $dok->copy_akte_notaris_perusahaan }} | 
	<a href="{{ asset('storage/dok/sa/'.$dok->copy_akte_notaris_perusahaan) }}" target="_blank">Lihat File</a>
	@else
	<p>Dokumen belum ada</p>
	@endif
</div><br>
<div class="dok">
	<label>3. Copy TDP</label> | 
	<input type="radio" name="dok[2]" required="" value="ada" onclick="{{ (!is_null($dok) && is_null($dok->copy_tdp)) || is_null($dok) ? 'return false' : '' }}" {{ !is_null($dok) && !is_null($dok->copy_tdp) ? 'checked' : '' }}>Lengkap
	<input type="radio" name="dok[2]" required="" value="null" onclick="{{ (!is_null($dok) && is_null($dok->copy_tdp)) || is_null($dok) ? 'return false' : '' }}" {{ (!is_null($dok) && is_null($dok->copy_tdp)) || is_null($dok) ? 'checked' : '' }}>Tidak Lengkap<br>
	<input class="fileName" type="hidden" name="fileName[]" value="copy_tdp">
	@if(!is_null($dok) && !is_null($dok->copy_tdp))
	{{ $dok->copy_tdp }} | 
	<a href="{{ asset('storage/dok/sa/'.$dok->copy_tdp) }}" target="_blank">Lihat File</a>
	@else
	<p>Dokumen belum ada</p>
	@endif
</div><br>