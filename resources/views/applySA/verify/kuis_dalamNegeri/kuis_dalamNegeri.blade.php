<center><b>{{ strtoupper('A. Info Tambahan') }}</b></center><br>
<div class="table-responsive">
  <table class="table">
  	<tr>
  		<td rowspan="2">1.</td>
  		<td><a data-toggle="collapse" href="#collapseExample" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat detail">Apakah pernah mendapatkan Sertifikat tanda SNI?</a></td>
  	</tr>
    <tr>
      <td>
        <div class="pr-3" style="float: left;"><input 
          @if(!is_null($opsi))
          {{ $cekOpsi('kuis1_opsi', $opsi) != 1 ? 'checked' : '' }} 
          @endif
          type="radio" required name="kuis1_opsi" value="1">Sesuai</div> 
          <input {{ $cekOpsi('kuis1_opsi', $opsi) == 1 ? 'checked' : '' }} type="radio" required name="kuis1_opsi" value="0">Belum Sesuai
      </td>
    </tr>
  	<tr>
  		<td></td>
  		<td>
  			<div class="collapse" id="collapseExample">
  				<b class="pr-2">Jawaban: </b>
          @if(!is_null($infoT))
          {{ !is_null($infoT) && $infoT->kuis1_opsi == 1 ? 'Ya' : 'Tidak' }}
          @endif
	  			@if(!is_null($infoT) && $infoT->kuis1_opsi == 1)
	  			<table width="100%">
	  				<tr>
	  					<td>Penerbit Sertifikat:</td>
	  					<td><input class="form-control" type="text" readonly="" value="{{ !is_null($infoT) && $infoT->kuis1_opsi == 1 ? $infoIsi($infoT->kuis1_isi)[0] : '' }}"></td>
	  				</tr>
	  				<tr>
	  					<td>Masa Berlaku:</td>
	  					<td><input class="form-control" type="text" readonly="" value="{{ !is_null($infoT) && $infoT->kuis1_opsi == 1 ? $infoIsi($infoT->kuis1_isi)[1] : '' }}"></td>
	  				</tr>
	  			</table>
	  			@endif
  			</div>
  		</td>
  	</tr>

    <tr>
      <td rowspan="2">2.</td>
      <td><a data-toggle="collapse" href="#collapseExample2" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat detail">Apakah perusahaan anda bagian dari sebuah group?</a></td>
    </tr>
    <tr>
      <td>
        <div class="pr-3" style="float: left;"><input type="radio" 
          @if(!is_null($opsi))
          {{ $cekOpsi('kuis2_opsi', $opsi) != 1 ? 'checked' : '' }} 
          @endif
          required name="kuis2_opsi" value="1">Sesuai</div> 
          <input type="radio" {{ $cekOpsi('kuis2_opsi', $opsi) == 1 ? 'checked' : '' }} required name="kuis2_opsi" value="0">Belum Sesuai
      </td>
    </tr>
    <tr>
      <td></td>
      <td>
        <div class="collapse" id="collapseExample2">
          <b class="pr-2">Jawaban: </b>
          @if(!is_null($infoT))
          {{ !is_null($infoT) && $infoT->kuis2_opsi == 1 ? 'Ya' : 'Tidak' }}
          @endif
          <table width="100%">
            <tr>
              <td>Detail:</td>
              <td><textarea class="form-control" readonly="">{{ !is_null($infoT) && $infoT->kuis2_opsi == 1 ? $infoIsi($infoT->kuis2_isi)[0] : '' }}</textarea></td>
            </tr>
          </table>
        </div>
      </td>
    </tr>

    <tr>
      <td rowspan="2">3.</td>
      <td><a data-toggle="collapse" href="#collapseExample3" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat detail">Apakah diantara group perusahaan anda ada yang telah mendapat sertifikat SNI?</a></td>
    </tr>
    <tr>
      <td>
        <div class="pr-3" style="float: left;"><input type="radio" 
          @if(!is_null($opsi))
          {{ $cekOpsi('kuis3_opsi', $opsi) != 1 ? 'checked' : '' }} 
          @endif
          required name="kuis3_opsi" value="1">Sesuai</div> 
          <input type="radio" {{ $cekOpsi('kuis3_opsi', $opsi) == 1 ? 'checked' : '' }} required name="kuis3_opsi" value="0">Belum Sesuai
      </td>
    </tr>
    <tr>
      <td></td>
      <td>
        <div class="collapse" id="collapseExample3">
          <b class="pr-2">Jawaban: </b>
          @if(!is_null($infoT))
          {{ !is_null($infoT) && $infoT->kuis3_opsi == 1 ? 'Ya' : 'Tidak' }}
          @endif
          <table width="100%">
            @if(!is_null($infoT) && $infoT->kuis3_opsi == 1)
            <tr>
              <td>Nama dan Alamat Perusahaan:</td>
              <td><textarea class="form-control" readonly="" style="height: 100px;">{{ !is_null($infoT) && $infoT->kuis3_opsi == 1 ? strtoupper($infoIsi($infoT->kuis3_isi)[0]) : '' }} - {{ !is_null($infoT) && $infoT->kuis3_opsi == 1 ? $infoIsi($infoT->kuis3_isi)[1] : '' }}
              </textarea></td>
            </tr>
            @endif
          </table>
        </div>
      </td>
    </tr>

    <tr>
      <td rowspan="2">4.</td>
      <td><a data-toggle="collapse" href="#collapseExample4" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat detail">Apakah perusahaan Saudara telah mendapatkan sertifikat SNI ISO 9001?</a></td>
    </tr>
    <tr>
      <td>
        <div class="pr-3" style="float: left;"><input type="radio" 
          @if(!is_null($opsi))
          {{ $cekOpsi('kuis4_opsi', $opsi) != 1 ? 'checked' : '' }} 
          @endif
          required name="kuis4_opsi" value="1">Sesuai</div> 
          <input type="radio" {{ $cekOpsi('kuis4_opsi', $opsi) == 1 ? 'checked' : '' }} required name="kuis4_opsi" value="0">Belum Sesuai
      </td>
    </tr>
    <tr>
      <td></td>
      <td>
        <div class="collapse" id="collapseExample4">
          <b class="pr-2">Jawaban: </b>
          @if(!is_null($infoT))
          {{ !is_null($infoT) && $infoT->kuis4_opsi == 1 ? 'Ya' : 'Tidak' }}
          @endif
          <table width="100%">
            @if(!is_null($infoT) && $infoT->kuis4_opsi == 1)
            <tr>
              <td>Penerbit sertifikat ISO:</td>
              <td><input class="form-control" type="text" readonly="" value="{{ !is_null($infoT) && $infoT->kuis4_opsi == 1 ? $infoIsi($infoT->kuis4_isi)[0] : '' }}"></td>
            </tr>
            <tr>
              <td>Masa Berlaku:</td>
              <td><input class="form-control" type="text" readonly="" value="{{ !is_null($infoT) && $infoT->kuis4_opsi == 1 ? $infoIsi($infoT->kuis4_isi)[1] : '' }}"></td>
            </tr>
            @elseif(!is_null($infoT) && $infoT->kuis4_opsi == 0)
            <tr>
              <td>Apakah perusahaan menerapkan dokumentasi SMM dan menerbitkan dokumen mutu/produk secara internal?:</td>
              <td><input class="form-control" type="text" readonly="" value="{{ !is_null($infoT) && $infoT->kuis4_opsi == 0 ? $infoIsi($infoT->kuis4_isi)[0] : '' }}"></td>
            </tr>
            @endif
          </table>
        </div>
      </td>
    </tr>

    <tr>
      <td rowspan="2">5.</td>
      <td><a data-toggle="collapse" href="#collapseExample5" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat detail">Apakah anda bekerja dengan menggunakan sistem shift?</a></td>
    </tr>
    <tr>
      <td>
        <div class="pr-3" style="float: left;"><input type="radio" 
          @if(!is_null($opsi))
          {{ $cekOpsi('kuis5_opsi', $opsi) != 1 ? 'checked' : '' }} 
          @endif
          required name="kuis5_opsi" value="1">Sesuai</div>
          <input type="radio" {{ $cekOpsi('kuis5_opsi', $opsi) == 1 ? 'checked' : '' }} required name="kuis5_opsi" value="0">Belum Sesuai
      </td>
    </tr>
    <tr>
      <td></td>
      <td>
        <div class="collapse" id="collapseExample5">
          <b class="pr-2">Jawaban: </b>
          @if(!is_null($infoT))
          {{ !is_null($infoT) && $infoT->kuis5_opsi == 1 ? 'Ya' : 'Tidak' }}
          @endif
        </div>
      </td>
    </tr>

    <tr>
      <td rowspan="2">6.</td>
      <td><a data-toggle="collapse" href="#collapseExample6" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat detail">Kapan perusahaan Anda siap disertifikasi?</a></td>
    </tr>
    <tr>
      <td>
        <div class="pr-3" style="float: left;"><input type="radio" 
          @if(!is_null($opsi))
          {{ $cekOpsi('kuis6_opsi', $opsi) != 1 ? 'checked' : '' }}
          @endif
          required name="kuis6_opsi" value="1">Sesuai</div> 
          <input type="radio" {{ $cekOpsi('kuis6_opsi', $opsi) == 1 ? 'checked' : '' }} required name="kuis6_opsi" value="0">Belum Sesuai
      </td>
    </tr>
    <tr>
      <td></td>
      <td>
        <div class="collapse" id="collapseExample6">
          <table width="100%">
            <tr>
              <td><b>Jawaban:</b></td>
              <td><input class="form-control" type="text" readonly="" value="{{ !is_null($infoT) && !is_null($infoT->kuis6) ? $infoT->kuis6 : '' }}"></td>
            </tr>
          </table>
        </div>
      </td>
    </tr>

    <tr>
      <td colspan="2">
        <b>Pesan:</b>
        <textarea class="form-control" name="pesan">{{ !is_null($pesan) ? $pesan : '' }}</textarea>
      </td>
    </tr>
  </table>
</div>
<br>