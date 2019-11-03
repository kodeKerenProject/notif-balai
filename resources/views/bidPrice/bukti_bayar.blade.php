@extends('home')

@section('card-header', 'Form Upload Bukti Pembayaran')

@section('second-content')
	@if(!$errors->isEmpty())
        <ul class="alert alert-danger">
        @foreach($errors->getMessages() as $key => $error)
            <li class="pl-2">{{ $error[0] }}</li>
        @endforeach
        </ul>
    @endif
    @if(is_null($model) || (!is_null($model) && is_null($model->invoice_id)))
    <center><p class="alert alert-primary">Tunggu pembuatan Invoice dari Seksi Keuangan</p></center>
    @elseif(!is_null($model) && !is_null($model->bukti_bayar))
	<center><p class="alert alert-success">Pembayaran berhasil</p></center>
    @endif
    @if(!is_null($model) && !is_null($model->invoice_id))
    	Invoice telah dibuat.
		<a href="{{ asset('storage/dok/invoice/'.$invoice->invoice) }}" target="_blank">Download Invoice</a><br>
    @endif
	@if(!is_null($model) && !is_null($model->invoice_id) && is_null($model->bukti_bayar) && 
		strtotime(date('Ymd')) <= strtotime($invoice->created_at)
	)
	Upload Bukti Pembayaran.<br>
	<div class="validMsg"></div>
	<form id="buktiBayar_upload" method="POST" action="{{ url('/bukti_bayar/'.$model->produk_id) }}" enctype="multipart/form-data">
		@csrf
		<input class="file" type="file" name="bbyr" required=""><br>
		<button type="button" onclick="ValidateSize('.file', '', '#buktiBayar_upload', '.validMsg');">Submit</button>
	</form>
	@elseif(!is_null($model) && !is_null($model->bukti_bayar))
	Bukti pembayaran telah diupload.
	<a href="{{ asset('storage/dok/buktiBayar/'.$model->bukti_bayar) }}" target="_blank">Download Invoice</a><br>
	@elseif(!is_null($model) && !is_null($model->invoice_id) && is_null($model->bukti_bayar) && 
		strtotime(date('Ymd')) > strtotime($invoice->created_at))
	<center><p class="alert alert-warning">Tidak ada tindakan lebih dari 7 hari sejak pembuatan invoice, Kode Biling hangus.<br>Harap hubungi Seksi Keuangan</p></center>
	@endif
	<br>
	<div class="text-left" style="float: left;">
        <a href="{{ url('/form_bayar') }}" class="btn btn-primary"><- Tahap sebelumnya</a>
    </div>
	<div class="text-right">
        <a href="{{ url('/verify_dokSert') }}" class="btn btn-primary">Tahap selanjutnya -></a>
    </div>
@endsection