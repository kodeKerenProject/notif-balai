@extends('home')

@section('card-header', 'Apply Sertifikasi Awal')

@section('second-content')
    @if( (!is_null($dok) && $dok->sni == 1) && (!is_null($infoDB) && $infoDB->lengkap == 1) )
    <center><p class="alert alert-success">Dokumen dan form persyaratan sertifikat SNI sudah lengkap</p></center>
    @else
        @if(!is_null($dok) && $dok->sni == 1)
        <center><p class="alert alert-success">Dokumen sudah lengkap</p></center>
        @endif
        @if(!is_null($infoDB) && $infoDB->lengkap == 1)
        <center><p class="alert alert-success">Form persyaratan sertifikat SNI sudah lengkap</p></center>
        @elseif(!is_null($infoDB) && $infoDB->lengkap == 2)
        <center><p class="alert alert-danger">Form persyaratan sertifikat SNI belum lengkap</p></center>
        @endif
    @endif
	@if(!is_null($dok) && $dok->sni == 2)
    <center><p class="alert alert-danger">Harap untuk mengupload dokumen - dokumen yang kurang dibawah ini</p></center>
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
    <form id="applySA_upload" method="POST" action="{{ \Auth::user()->negeri == '1' ? url('sa') : url('saLuar') }}" enctype="multipart/form-data">
        @csrf
        
        @if(is_null(\Auth::user()->produk()))
        <b><i>Produk</i></b><br>
        <label>Nama Produk</label>
        <input class="produk" type="text" name="produk" required=""><br>
        @endif
        @if(\Auth::user()->negeri == '1')
            @include('applySA.dalamNegeri')
            <br>
            @if((!is_null($dok) && $dok->sni != 3) || is_null($dok))
                @include('applySA.info_tambahan')
                </table>
                {{-- @include('applySA.kuesioner1') --}}
                {{-- @include('applySA.kuesioner2') --}}
            @endif
            <br>
        @else
            @if(is_null(is_null(\Auth::user()->produk())))
            <b><i>Produk</i></b><br>
            <label>Nama Produk</label>
            <input class="produk" type="text" name="produk" required=""><br>
            @endif
            @if(is_null($dokImportir) || (!is_null($dokImportir) && $dokImportir->lengkap == 2)))
            <b><i>Dokumen Importir</i></b><br>
            @endif
            @if( (!is_null($dokImportir) && is_null($dokImportir->surat_permohonan_sertifikat_sni)) || is_null($dokImportir) )
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
        <div class="validMsg"></div>
        @if( (!is_null($dok) && $dok->sni != 1 && $dok->sni != 3) || is_null($dok) || (!is_null($infoDB) && $infoDB->lengkap != 1 && $infoDB->lengkap != 3))
        <button type="button" onclick="ValidateSize('.file', '.produk', '#applySA_upload', '.validMsg');">Submit</button> | <button type="reset">Reset</button>
        @endif
    </form>
    <br>
    <div class="text-right">
        <a href="{{ url('/mou') }}" class="btn btn-primary">Tahap selanjutnya -></a>
    </div>
@endsection