@extends('home')

@section('card-header', 'List Produk')

@section('second-content')
	<p>List Produk Pengajuan Sertifikasi</p>
	<table border="1">
		<tr>
			<td>No</td>
			<td>Nama Produk</td>
			<td>Aksi</td>
		</tr>
		@if(!$produk->isEmpty())
			@foreach($produk as $key => $data)
			<tr>
				<td>{{ $key+=1 }}</td>
				<td>{{ $data->produk }}</td>
				<td>
					<a href="{{ url('/produk/'.$link.'/'.$data->id) }}">Lihat Tahap Sertifikasi</a>
				</td>
			</tr>
			@endforeach
		@else
			<tr><td colspan="3"><p>Data kosong</p></td></tr>
		@endif
	</table>
@endsection