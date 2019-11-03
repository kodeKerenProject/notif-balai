@if( (!is_null($infoDB) && $infoDB->lengkap == 2) || is_null($infoDB) )
<center><b>{{ strtoupper('A. Informasi Tambahan') }}</b></center><br>
@endif
<table border="0">
    @if( (!is_null($opsi) && $cekOpsi('kuis1_opsi', $opsi)) || is_null($opsi) )
    <tr>
        <td>1.</td>
        <td style="padding-right: 10px;width: 55%;">Apakah pernah mendapatkan Sertifikat tanda SNI?</td>
        <td></td>
        <td><input onclick="slideOpt('.kuis1', 'ya', false)" type="radio" 
            @if(!is_null($opsi))
            {{ !is_null($infoDB) && $infoDB->kuis1_opsi == 1 ? 'checked' : '' }}
            @endif
            name="opsi1" value="ya">Ya<br></td>
        <td><input onclick="slideOpt('.kuis1', 'tidak', false)" type="radio" 
            @if(!is_null($opsi))
            {{ !is_null($infoDB) && $infoDB->kuis1_opsi == 1 ? 'checked' : '' }}
            @endif
            name="opsi1" value="tidak">Tidak</td>
    </tr>
        @if(!is_null($opsi) && $cekOpsi('kuis1_opsi', $opsi))
        <tr class="kuis1 {{ !is_null($opsi) && $cekOpsi('kuis1_opsi', $opsi) ? '' : 'hid' }}">
            <td></td>
            <td>Jika <b>Ya</b>, Penerbit Sertifikat</td>
            <td>:</td>
            <td colspan="2"><input class="inpt" type="text" name="penerbitSertSNI"></td>
        </tr>
        <tr class="kuis1 {{ !is_null($opsi) && $cekOpsi('kuis1_opsi', $opsi) ? '' : 'hid' }}">
            <td></td>
            <td class="pb-3">Masa Berlaku</td>
            <td class="pb-3">:</td>
            <td colspan="2" class="pb-3"><input class="inpt" type="text" name="masaBerlakuSNI"></td>
        </tr>
        @endif
    @endif

    @if( (!is_null($opsi) && $cekOpsi('kuis2_opsi', $opsi)) || is_null($opsi) )
    <tr>
        <td>2.</td>
        <td style="padding-right: 10px;">Apakah perusahaan anda bagian dari sebuah group?</td>
        <td></td>
        <td><input type="radio" 
            @if(!is_null($opsi))
            {{ !is_null($infoDB) && $infoDB->kuis2_opsi == 1 ? 'checked' : '' }}
            @endif
            name="opsi2" value="ya">Ya</td>
        <td><input type="radio" 
            @if(!is_null($opsi))
            {{ !is_null($infoDB) && $infoDB->kuis2_opsi == 1 ? 'checked' : '' }}
            @endif
            name="opsi2" value="tidak">Tidak</td>
    </tr>
    <tr>
        <td></td>
        <td class="pb-3">Berikan Detailnya</td>
        <td class="pb-3">:</td>
        <td class="pb-3" colspan="2"><textarea name="detailGroup"></textarea></td>
    </tr>
    @endif

    @if( (!is_null($opsi) && $cekOpsi('kuis3_opsi', $opsi)) || is_null($opsi) )
    <tr>
        <td>3.</td>
        <td style="padding-right: 10px;">Apakah diantara group perusahaan anda ada yang telah mendapat sertifikat SNI?</td>
        <td></td>
        <td><input onclick="slideOpt('.kuis2', 'ya', false)" type="radio" 
            @if(!is_null($opsi))
            {{ !is_null($infoDB) && $infoDB->kuis3_opsi == 1 ? 'checked' : '' }}
            @endif
            name="opsi3" value="ya">Ya</td>
        <td><input onclick="slideOpt('.kuis2', 'tidak', false)" type="radio" 
            @if(!is_null($opsi))
            {{ !is_null($infoDB) && $infoDB->kuis3_opsi != 1 ? 'checked' : '' }}
            @endif
            name="opsi3" value="tidak">Tidak</td>
    </tr>
        @if(!is_null($opsi) && $cekOpsi('kuis3_opsi', $opsi))
        <tr class="kuis2 {{ !is_null($opsi) && $cekOpsi('kuis3_opsi', $opsi) ? '' : 'hid' }}">
            <td></td>
            <td class="pb-3">Jika <b>Ya</b>, Tulis nama dan alamat perusahaan tsb.</td>
            <td class="pb-3">:</td>
            <td class="pb-3" colspan="2"><input class="inpt" type="text" name="namaComp" placeholder="nama" value="{{ !is_null($infoDB) && $infoDB->kuis3_opsi == 1 ? $infoIsi($infoDB->kuis3_isi)[0] : '' }}"><br><textarea class="inpt" name="alamatComp" placeholder="alamat">{{ !is_null($infoDB) && $infoDB->kuis3_opsi == 1 ? $infoIsi($infoDB->kuis3_isi)[1] : '' }}</textarea></td>
        </tr>
        @endif
    @endif

    @if( (!is_null($opsi) && $cekOpsi('kuis4_opsi', $opsi)) || is_null($opsi) )
    <tr>
        <td>4.</td>
        <td style="padding-right: 10px;">Apakah perusahaan Saudara telah mendapatkan sertifikat SNI ISO 9001?</td>
        <td></td>
        <td><input onclick="slideOpt('.kuis3', 'ya', '.kuis3_')" type="radio" 
            @if(!is_null($opsi))
            {{ !is_null($infoDB) && $infoDB->kuis4_opsi == 1 ? 'checked' : '' }}
            @endif
            name="opsi4" value="ya">Ya</td>
        <td><input onclick="slideOpt('.kuis3', 'tidak', '.kuis3_')" type="radio" 
            @if(!is_null($opsi))
            {{ !is_null($infoDB) && $infoDB->kuis4_opsi != 1 ? 'checked' : '' }}
            @endif
            name="opsi4" value="tidak">Tidak</td>
    </tr>
        @if(!is_null($opsi) && $cekOpsi('kuis4_opsi', $opsi))
        <tr class="kuis3 {{ !is_null($opsi) && $cekOpsi('kuis4_opsi', $opsi) ? '' : 'hid' }}">
            <td></td>
            <td>Jika <b>Ya</b>, Penerbit sertifikat ISO</td>
            <td>:</td>
            <td colspan="2"><input class="inpt" type="text" name="perbitSertISO"></td>
        </tr>
        <tr class="kuis3 {{ !is_null($opsi) && $cekOpsi('kuis4_opsi', $opsi) ? '' : 'hid' }}">
            <td></td>
            <td>Masa berlaku</td>
            <td>:</td>
            <td colspan="2"><input class="inpt" type="text" name="masaBerlakuISO"></td>
        </tr>
        @endif
        @if(!is_null($opsi) && !$cekOpsi('kuis4_opsi', $opsi))
        <tr class="kuis3_ {{ !is_null($opsi) && !$cekOpsi('kuis4_opsi', $opsi) ? '' : 'hid' }}">
            <td></td>
            <td class="pb-3">Jika <b>Tidak</b>, Apakah perusahaan menerapkan dokumentasi SMM dan menerbitkan dokumen mutu/produk secara internal?</td>
            <td class="pb-3">:</td>
            <td class="pb-3"><input class="inpt" type="radio" name="opsi4_tidak" value="ya">Ya</td>
            <td class="pb-3"><input class="inpt" type="radio" name="opsi4_tidak" value="tidak">Tidak</td>
        </tr>
        @endif
    @endif

    @if( (!is_null($opsi) && $cekOpsi('kuis5_opsi', $opsi)) || is_null($opsi) )
    <tr>
        <td class="pb-3">5.</td>
        <td class="pb-3" style="padding-right: 10px;">Apakah anda bekerja dengan menggunakan sistem shift?</td>
        <td class="pb-3"></td>
        <td class="pb-3"><input type="radio" 
            @if(!is_null($opsi))
            {{ !is_null($infoDB) && $infoDB->kuis5_opsi == 1 ? 'checked' : '' }}
            @endif
            name="opsi5" value="ya">Ya</td>
        <td class="pb-3"><input type="radio" 
            @if(!is_null($opsi))
            {{ !is_null($infoDB) && $infoDB->kuis5_opsi != 1 ? 'checked' : '' }}
            @endif
            name="opsi5" value="tidak">Tidak</td>
    </tr>
    @endif

    @if( (!is_null($opsi) && $cekOpsi('kuis6_opsi', $opsi)) || is_null($opsi) )
    <tr>
        <td class="pb-3">6.</td>
        <td class="pb-3" style="padding-right: 10px;">Kapan perusahaan Anda siap disertifikasi?</td>
        <td class="pb-3"></td>
        <td class="pb-3" colspan="2"><input type="date" name="siapSertDate" value="{{ !is_null($infoDB) && !is_null($infoDB->kuis6) ? $infoDB->kuis6 : '' }}"></td>
    </tr>
    @endif
    @if( (!is_null($infoDB) && $infoDB->lengkap == 2) || is_null($infoDB) )
        @if(!is_null($pesan))
        <tr><td colspan="5"><b>Pesan:</b></td></tr>
        <tr>
            <td colspan="5" class="pb-5"><textarea class="form-control" readonly="">{{ $pesan }}</textarea></td>
        </tr>
        @endif
    @endif

{{-- 
    <tr><td class="pb-4" colspan="5"><center><b>{{ strtoupper('B. Kuesioner') }}</b></center></td></tr>
    <tr>
        <td class="pb-3">1.</td>
        <td class="pb-3" style="padding-right: 10px;">Apakah pernah mendapatkan Sertifikat tanda SNI?</td>
        <td class="pb-3">:</td>
        <td class="pb-3" colspan="2"><input type="date" name="evalDate"></td>
    </tr>
    <tr>
        <td class="pb-3">2.</td>
        <td class="pb-3" style="padding-right: 10px;">Apakah merupakan contoh produksi atau contoh prototipe?</td>
        <td class="pb-3">:</td>
        <td class="pb-3" colspan="2"><input type="radio" name="contoh">Contoh Produksi<br><input type="radio" name="contoh">Contoh Prototipe</td>
    </tr>
    <tr>
        <td>3.</td>
        <td style="padding-right: 10px;">Apakah ini menjadi proses produksi atau proses contoh protipe?</td>
        <td>:</td>
        <td colspan="2"><input type="radio" name="proses">Proses Produksi<br><input type="radio" name="proses">Proses Contoh Prototipe</td>
    </tr>
    <tr>
        <td class="pb-3"></td>
        <td class="pb-3" style="padding-right: 10px;">Jika <b>prototipe</b>, Kapan produksi dijadwalkan?</td>
        <td class="pb-3">:</td>
        <td class="pb-3" colspan="2"><input type="date" name="waktuProduksi"></td>
    </tr>
    <tr>
        <td class="pb-3">4. </td>
        <td class="pb-3" style="padding-right: 10px;">Sudahkah produk diuji sesuai dengan standar?<br>(bila sudah, harap dilamprikan laporannya)</td>
        <td class="pb-3">:</td>
        <td class="pb-3"><input type="radio" name="kesudahan">Sudah</td>
        <td class="pb-3"><input type="radio" name="kesudahan">Belum</td>
    </tr> --}}