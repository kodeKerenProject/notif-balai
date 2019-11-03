@extends('home')

@section('card-header', 'Sign MOU')

@section('second-content')
	@if(!$errors->isEmpty())
        <ul class="alert alert-danger">
        @foreach($errors->getMessages() as $key => $error)
            <li class="pl-2">{{ $error[0] }}</li>
        @endforeach
        </ul>
    @endif
	@if(!is_null($mou) && ($mou->status == 1 && strtotime(date('Y-m-d H:i:s')) <= strtotime($mou->created_at)))
	<center><p class="alert alert-warning">MOU telah dibuat oleh Seksi Kerjama<br>
	Harap untuk upload MOU sebelum tanggal {{ date('d-m-Y', strtotime($mou->created_at)) }}.</p></center>
	<b>Download file terlebih dahulu sebelum upload MOU yang sudah ditanda tangan</b><br>
	<a href="{{ asset('storage/dok/mou/'.$mou->mou) }}" target="_blank">Download MOU</a>
	<br><br>
	<div class="validMsg"></div>
	<form id="signMou_upload" method="POST" action="{{ url('/mou_signed/'.$mou->id) }}" enctype="multipart/form-data">
		@csrf
		Upload MOU yang sudah ditanda tangan<br>
		<input class="file" type="file" name="mou" required=""><br>
		<button type="button" onclick="ValidateSize('.file', '', '#signMou_upload', '.validMsg');">Submit</button>
	</form>
	@elseif(!is_null($mou) && $mou->status == 2 && !is_null($mou->mou))
	<center><p class="alert alert-success">MOU telah diupload</p></center>
	@elseif(!is_null($mou) && strtotime(date('Y-m-d H:i:s')) > strtotime($mou->created_at))
	<center><p class="alert alert-danger">File MOU telah dikunci oleh sistem, Harap hubungi seksi kerjasama</p></center>
	@elseif(is_null($mou))
	<center><p class="alert alert-primary">MOU belum dibuat</p></center>
	@endif
	<br>
	<div class="text-left" style="float: left;">
        <a href="{{ url('/sa') }}" class="btn btn-primary"> <- Tahap sebelumnya</a>
    </div>
	<div class="text-right">
        <a href="{{ url('/form_bayar') }}" class="btn btn-primary">Tahap selanjutnya -></a>
    </div>
@endsection