@extends('home')

@section('card-header', 'Apply Sertifikasi Awal')

@section('second-content')
	@if(!is_null($dok) && $dok->sni == 2)
    <center><p class="alert alert-danger">Harap untuk mengupload dokumen - dokumen yang kurang dibawah ini</p></center>
    @elseif(!is_null($dok) && $dok->sni == 1)
    <!-- {{{ $success = true }}} -->
    <center><p class="alert alert-success">Dokumen sudah lengkap</p></center>
    @elseif(!is_null($dok) && $dok->sni == 3)
    <center><p class="alert alert-warning">Tunggu verifikasi dokumen</p></center>
    @endif

    @if(!$errors->isEmpty())
        <ul class="alert alert-danger">
        @foreach($errors->getMessages() as $key => $error)
            <li class="pl-2">{{ $error[0] }}</li>
        @endforeach
        </ul>
    @endif
    <div class="validMsg"></div>
    <form id="applySA_upload" method="POST" action="{{ \Auth::user()->negeri == '1' ? url('sa') : url('saLuar') }}" enctype="multipart/form-data">
        @csrf
        
        @if(is_null(\Auth::user()->produk()))
        <b><i>Produk</i></b><br>
        <label>Nama Produk</label>
        <input class="produk" type="text" name="produk" required=""><br>
        @endif
        @if(\Auth::user()->negeri == '1')
            @if( (!is_null($dok) && is_null($dok->surat_permohonan_sertifikat_sni)) || is_null($dok) )
            <div class="dok">
                <label>1. Surat Permohonan Sertifikasi SNI</label><br>
                <input class="file form-control @error('dok[]') is-invalid @enderror" type="file" name="dok[]" required="">
                <input class="fileName" type="hidden" name="fileName[]" value="surat_permohonan_sertifikat_sni">
            </div>
            @endif
            @if( (!is_null($dok) && is_null($dok->daftar_isian_kuesioner)) || is_null($dok) )
            <div class="dok">
                <label>2. Daftar Isian Kuesioner</label><br>
                <input class="file form-control @error('dok[]') is-invalid @enderror" type="file" name="dok[]" required="">
                <input class="fileName" type="hidden" name="fileName[]" value="daftar_isian_kuesioner">
            </div>
            @endif
            @if( (!is_null($dok) && is_null($dok->copy_iui)) || is_null($dok) )
            <div class="dok">
                <label>3. Copy IUI</label><br>
                <input class="file form-control @error('dok[]') is-invalid @enderror" type="file" name="dok[]" required="">
                <input class="fileName" type="hidden" name="fileName[]" value="copy_iui">
            </div>
            <br>
            @endif
        @else
            @if(is_null(is_null(\Auth::user()->produk())))
            <b><i>Produk</i></b><br>
            <label>Nama Produk</label>
            <input class="produk" type="text" name="produk" required=""><br>
            @endif
            @if(is_null($dokImportir) || is_null($dokDalamNegeri) || (!is_null($dokImportir) && $dokImportir->lengkap == 2) || (!is_null($dokDalamNegeri) && $dokDalamNegeri->sni == 2))
            <b><i>Dokumen Importir</i></b><br>
            @endif
            @if( (!is_null($dokDalamNegeri) && is_null($dokDalamNegeri->surat_permohonan_sertifikat_sni)) || is_null($dokDalamNegeri) )
            <div class="dok">
                <label>1. Surat Permohonan Importir F.03.01</label><br>
                <!-- <button class="tidakAda">Tidak Ada</button><button class="ada" style="display: none;">Ada</button><br> -->
                <input class="file" type="file" name="dok[]" required="">
                <input class="fileName" type="hidden" name="fileName[]" value="surat_permohonan_sertifikat_sni,sa">
            </div>
            @endif
            @if( (!is_null($dokImportir) && is_null($dokImportir->daftar_isian_dan_kuesioner_importer)) || is_null($dokImportir) )
            <div class="dok">
                <label>2. Daftar Isian dan Kuesioner F.48.01</label><br>
                <input class="file" type="file" name="dok[]" required="">
                <input class="fileName" type="hidden" name="fileName[]" value="daftar_isian_dan_kuesioner_importer,dokImportir">
            </div>
            @endif
            @if( (!is_null($dokImportir) && is_null($dokImportir->copy_api)) || is_null($dokImportir) )
            <div class="dok">
                <label>3. Copy API</label><br>
                <input class="file" type="file" name="dok[]" required="">
                <input class="fileName" type="hidden" name="fileName[]" value="copy_api,dokImportir">
            </div>
            @endif
            @if(is_null($dokManufaktur) || (!is_null($dokManufaktur) && $dokManufaktur->lengkap == 2))
            <br>
            <b><i>Dokumen Manufaktur</i></b><br>
            @endif
            @if( (!is_null($dokManufaktur) && is_null($dokManufaktur->surat_permohonan_dari_manufaktur)) || is_null($dokManufaktur) )
            <div class="dok">
                <label>1. Surat Permohonan Dari Manufaktur</label><br>
                <input class="file" type="file" name="dok[]" required="">
                <input class="fileName" type="hidden" name="fileName[]" value="surat_permohonan_dari_manufaktur,dokManufaktur">
            </div>
            <br>
            @endif
        @endif
        @if( ((!is_null($dok) && $dok->sni != 1) && (!is_null($dok) && $dok->sni != 3)) || is_null($dok) )
        <button type="button" onclick="ValidateSize('.file', '.produk', '#applySA_upload', '.validMsg');">Submit</button> | <button type="reset">Reset</button>
        @endif
    </form>
    <br>
    <div class="text-right">
        <a href="{{ url('/mou') }}" class="btn btn-primary">Tahap selanjutnya -></a>
    </div>
@endsection