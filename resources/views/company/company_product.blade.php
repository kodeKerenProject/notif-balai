@extends('home')

@section('card-header', 'List Produk')

@section('perusahaan')
	<div class="row justify-content-center mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Perusahaan</div>

                <div class="card-body">
                	<div style="font-size: 15px;">
	                	<b>{{ $user->nama_perusahaan }}</b>
	                </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('second-content')
	<p>List Produk Pengajuan Sertifikasi</p>
	<table border="1">
		<tr>
			<td>No</td>
			<td>Nama Produk</td>
			<td>Aksi</td>
		</tr>
		@if(!$user->produk_client()->isEmpty())
			@foreach($user->produk_client() as $key => $data)
			<tr>
				<td>{{ $key+=1 }}</td>
				<td>{{ $data->produk }}</td>
				<td>
					<a href="{{ url('/company/'.$user->id.'/'.$link.'/'.$data->id) }}">Lihat Tahap Sertifikasi</a>
				</td>
			</tr>
			@endforeach
		@else
			<tr><td colspan="3"><p>Data kosong</p></td></tr>
		@endif
	</table>
	<br>
@endsection