@extends('home')

@section('card-header', 'Pembuatan Dokumen Penawaran Harga')

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
	@if((!is_null($mou) && $mou->status == 2 && !is_null($model) && is_null($model->bid_price)) || (is_null($model) && !is_null($mou)))
	<center><p class="alert alert-success">Client telah selesai upload MOU yang sudah ditandatangani</p></center>
	Form pembuatan dokumen penawaran harga.
	<form method="POST" action="{{ url('/bidPrice_create/'.$idProduk) }}" enctype="multipart/form-data">
		@csrf
		<label>Nama Produk</label>
		<input type="text" value="{{ $produk->produk }}" readonly=""><br>
		<label>Harga Produk</label>
		<input type="number" name="price" min="0" required=""><br>
		<button type="submit" onclick="return confirm('Dokumen Pernawaran Harga akan dibuat, Lanjutkan?');">Submit</button> | <button type="reset">Reset</button>
	</form>
	@elseif(!is_null($model) && !is_null($model->bid_price) && is_null($model->status))
	<center><p class="alert alert-success">Dokumen Penawaran harga telah dibuat</p></center>
	@elseif(!is_null($model) && $model->status == 1)
	<center><p class="alert alert-primary">Dokumen Penawaran telah di disetujui oleh Kabid PJT</p></center>
	<form method="POST" action="{{ url('/submit_bidPrice/'.$idProduk) }}">
		@csrf
		<button type="submit">Submit Penawaran Harga</button>
	</form>
	@elseif(!is_null($model) && $model->status == 3)
	<center><p class="alert alert-primary">Submit Dokumen Penawaran Harga telah dilakukan</p></center>
	@else
	<center><p class="alert alert-primary">Form pembuatan dokumen penawaran harga masih dikunci</p></center>
	@endif

	<br>
	<div class="text-left" style="float: left;">
        <a href="{{ url('/company/'.$user->id.'/sert/'.$idProduk) }}" class="btn btn-primary"><- Tahap sebelumnya</a>
    </div>
	<div class="text-right">
        <a href="{{ url('/sert_jadi/'.$user->id.'/sert/'.$idProduk) }}" class="btn btn-primary">Tahap selanjutnya -></a>
    </div>
@endsection