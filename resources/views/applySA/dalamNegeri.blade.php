{{-- @if( (!is_null($dok) && is_null($dok->surat_permohonan_sertifikat_sni)) || is_null($dok) )
<div class="dok">
    <label>1. Surat Permohonan Sertifikasi SNI</label><br>
    <input class="file form-control @error('dok[]') is-invalid @enderror" type="file" name="dok[]" required="">
    <input class="fileName" type="hidden" name="fileName[]" value="surat_permohonan_sertifikat_sni">
</div>
@endif --}}
{{-- @if( (!is_null($dok) && is_null($dok->daftar_isian_kuesioner)) || is_null($dok) )
<div class="dok">
    <label>2. Daftar Isian Kuesioner</label><br>
    <input class="file form-control @error('dok[]') is-invalid @enderror" type="file" name="dok[]" required="">
    <input class="fileName" type="hidden" name="fileName[]" value="daftar_isian_kuesioner">
</div>
@endif --}}
@if( (!is_null($dok) && is_null($dok->copy_iui)) || is_null($dok) )
<div class="dok">
    <label>1. Copy IUI</label><br>
    <input class="file form-control @error('dok[]') is-invalid @enderror" type="file" name="dok[]" required="">
    <input class="fileName" type="hidden" name="fileName[]" value="copy_iui">
</div><br>
@endif
@if( (!is_null($dok) && is_null($dok->copy_akte_notaris_perusahaan)) || is_null($dok) )
<div class="dok">
    <label>2. Copy Akte Notaris Perusahaan</label><br>
    <input class="file form-control @error('dok[]') is-invalid @enderror" type="file" name="dok[]" required="">
    <input class="fileName" type="hidden" name="fileName[]" value="copy_akte_notaris_perusahaan">
</div><br>
@endif
@if( (!is_null($dok) && is_null($dok->copy_tdp)) || is_null($dok) )
<div class="dok">
    <label>3. Copy TDP</label><br>
    <input class="file form-control @error('dok[]') is-invalid @enderror" type="file" name="dok[]" required="">
    <input class="fileName" type="hidden" name="fileName[]" value="copy_tdp">
</div><br>
@endif
{{-- @if( (!is_null($dok) && is_null($dok->copy_npwp)) || is_null($dok) )
<div class="dok">
    <label>4. Copy NPWP</label><br>
    <input class="file form-control @error('dok[]') is-invalid @enderror" type="file" name="dok[]" required="">
    <input class="fileName" type="hidden" name="fileName[]" value="copy_npwp">
</div><br>
@endif
@if( (!is_null($dok) && is_null($dok->copy_sert_patent_merek)) || is_null($dok) )
<div class="dok">
    <label>5. Copy Sertifikat Patent Merek</label><br>
    <input class="file form-control @error('dok[]') is-invalid @enderror" type="file" name="dok[]" required="">
    <input class="fileName" type="hidden" name="fileName[]" value="copy_sert_patent_merek">
</div><br>
@endif
@if( (!is_null($dok) && is_null($dok->copy_sert_iso_9001)) || is_null($dok) )
<div class="dok">
    <label>6. Copy Sertifikat ISO 9001</label><br>
    <input class="file form-control @error('dok[]') is-invalid @enderror" type="file" name="dok[]" required="">
    <input class="fileName" type="hidden" name="fileName[]" value="copy_sert_iso_9001">
</div><br>
@endif
@if( (!is_null($dok) && is_null($dok->laporan_audit_sistem_mutu_terakhir)) || is_null($dok) )
<div class="dok">
    <label>7. Laporan Audit Sistem Mutu Terakhir</label><br>
    <input class="file form-control @error('dok[]') is-invalid @enderror" type="file" name="dok[]" required="">
    <input class="fileName" type="hidden" name="fileName[]" value="laporan_audit_sistem_mutu_terakhir">
</div><br>
@endif
@if( (!is_null($dok) && is_null($dok->panduan_mutu)) || is_null($dok) )
<div class="dok">
    <label>8. Panduan Mutu</label><br>
    <input class="file form-control @error('dok[]') is-invalid @enderror" type="file" name="dok[]" required="">
    <input class="fileName" type="hidden" name="fileName[]" value="panduan_mutu">
</div><br>
@endif
@if( (!is_null($dok) && is_null($dok->daftar_induk_dok)) || is_null($dok) )
<div class="dok">
    <label>9. Daftar Induk Dokumen</label><br>
    <input class="file form-control @error('dok[]') is-invalid @enderror" type="file" name="dok[]" required="">
    <input class="fileName" type="hidden" name="fileName[]" value="daftar_induk_dok">
</div><br>
@endif
@if( (!is_null($dok) && is_null($dok->struktur_organisasi)) || is_null($dok) )
<div class="dok">
    <label>10. Struktur Organisasi</label><br>
    <input class="file form-control @error('dok[]') is-invalid @enderror" type="file" name="dok[]" required="">
    <input class="fileName" type="hidden" name="fileName[]" value="struktur_organisasi">
</div><br>
@endif
@if( (!is_null($dok) && is_null($dok->diagram_alir_proses_produksi)) || is_null($dok) )
<div class="dok">
    <label>11. Diagram Alir Proses Produksi</label><br>
    <input class="file form-control @error('dok[]') is-invalid @enderror" type="file" name="dok[]" required="">
    <input class="fileName" type="hidden" name="fileName[]" value="diagram_alir_proses_produksi">
</div><br>
@endif
@if( (!is_null($dok) && is_null($dok->surat_pertunjukkan_wakil_manajemen)) || is_null($dok) )
<div class="dok">
    <label>12. Surat Pertujukkan Wakil Manajemen</label><br>
    <input class="file form-control @error('dok[]') is-invalid @enderror" type="file" name="dok[]" required="">
    <input class="fileName" type="hidden" name="fileName[]" value="surat_pertunjukkan_wakil_manajemen">
</div><br>
@endif
@if( (!is_null($dok) && is_null($dok->ilustrasi_pembubuhan_tanda_sni)) || is_null($dok) )
<div class="dok">
    <label>13. Ilustrasi Pembubuhan Tanda SNI</label><br>
    <input class="file form-control @error('dok[]') is-invalid @enderror" type="file" name="dok[]" required="">
    <input class="fileName" type="hidden" name="fileName[]" value="ilustrasi_pembubuhan_tanda_sni">
</div><br>
@endif
@if( (!is_null($dok) && is_null($dok->tabel_daftar_tipe_produk)) || is_null($dok) )
<div class="dok">
    <label>14. Tabel Daftar Tipe Produk</label><br>
    <input class="file form-control @error('dok[]') is-invalid @enderror" type="file" name="dok[]" required="">
    <input class="fileName" type="hidden" name="fileName[]" value="tabel_daftar_tipe_produk">
</div><br>
@endif
@if( (!is_null($dok) && is_null($dok->gambar_dan_spesifikasi_produk)) || is_null($dok) )
<div class="dok">
    <label>15. Gambar dan Spesifikasi Produk</label><br>
    <input class="file form-control @error('dok[]') is-invalid @enderror" type="file" name="dok[]" required="">
    <input class="fileName" type="hidden" name="fileName[]" value="gambar_dan_spesifikasi_produk">
</div><br>
@endif
@if( (!is_null($dok) && is_null($dok->tata_letak_pabrik)) || is_null($dok) )
<div class="dok">
    <label>16. Tata Letak Pabrik</label><br>
    <input class="file form-control @error('dok[]') is-invalid @enderror" type="file" name="dok[]" required="">
    <input class="fileName" type="hidden" name="fileName[]" value="tata_letak_pabrik">
</div><br>
@endif
@if( (!is_null($dok) && is_null($dok->peta_rute_pabrik_dari_bandara_terdekat)) || is_null($dok) )
<div class="dok">
    <label>17. Peta Rute Pabrik Dari Bandara Terdekat</label><br>
    <input class="file form-control @error('dok[]') is-invalid @enderror" type="file" name="dok[]" required="">
    <input class="fileName" type="hidden" name="fileName[]" value="peta_rute_pabrik_dari_bandara_terdekat">
</div><br>
@endif --}}