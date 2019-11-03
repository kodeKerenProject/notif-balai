@extends('home')

@section('card-header', 'Pembuatan Invoice dan Upload Kode Biling')

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
    @if(!$errors->isEmpty())
        <ul class="alert alert-danger">
        @foreach($errors->getMessages() as $key => $error)
            <li class="pl-2">{{ $error[0] }}</li>
        @endforeach
        </ul>
    @endif
    @if(!is_null($model) && $model->verifikasi_bayar == 1 && is_null($model->invoice_id))
    <div class="validMsg"></div>
    <form id="invoice_upload" method="POST" action="{{ url('/invoice_create/'.$idProduk) }}" enctype="multipart/form-data">
        @csrf
        Form pembuatan invoice.<br>
        <label>Nama</label>
        <input class="teks" type="text" name="nama" required=""><br>
        <label>Produk</label>
        <input class="teks" type="text" name="produk" value="{{ $produk->produk }}" readonly="" required=""><br>
        Upload Kode Biling.<br>
        <input class="file" type="file" name="kb" required="">
        <button type="button" onclick="ValidateSize('.file', '.teks', '#invoice_upload', '.validMsg');">Submit</button> | <button type="reset">Reset</button>
    </form>
    @elseif(!is_null($model) && is_null($model->verifikasi_bayar) && is_null($model->tanggal_bayar))
    <center><p class="alert alert-primary">Form Waktu Pembayaran Client belum diisi</p></center>
    @endif
    @if(!is_null($model) && !is_null($model->invoice_id) && !is_null($invoice) && strtotime($invoice->created_at) > strtotime(date('YmdHis')))
    <center><p class="alert alert-success">Invoice telah dibuat</p></center>
    <a href="{{ asset('storage/dok/invoice/'.$invoice->invoice) }}" target="_blank">Download Invoice</a><br><br>
    @elseif(!is_null($model) && !is_null($model->invoice_id) && !is_null($invoice) && strtotime($invoice->created_at) <= strtotime(date('YmdHis')))
    <center><p class="alert alert-warning">Tidak ada tindakan lebih dari 7 hari sejak pembuatan invoice, Kode Biling hangus.<br>Harap Upload Kode Biling yang baru</center>
    <div class="validMsg"></div>
    <i>Upload Kode Biling</i>
    <form id="kodeBiling_upload" method="POST" action="{{ url('/uploadKB/'.$invoice->id) }}" enctype="multipart/form-data">
        @csrf
        <input class="file" type="file" name="kb" required=""><br>
        <button type="button" onclick="ValidateSize('.file', '#kodeBiling_upload', '.validMsg');">Submit</button>
    </form>
    @endif
@endsection