@extends('layouts/app')

@section('content')
	<b><i>Perusahaan</i></b> : {{ $user->nama_perusahaan }}<br>
	<p>List Produk Pengajuan Sertifikasi</p>
	<table border="1">
		<tr>
			<td>No</td>
			<td>Nama Produk</td>
			<td>Aksi</td>
		</tr>
		@if(!$user->produk()->get()->isEmpty())
			@foreach($user->produk()->get() as $key => $data)
			<tr>
				<td>{{ $key+=1 }}</td>
				<td>{{ $data->produk }}</td>
				<td>
					<a href="{{ url('/company/'.$user->id.'/sert/'.$data->id) }}">Lihat Tahap Sertifikasi</a>
				</td>
			</tr>
			@endforeach
		@else
			<tr><td colspan="3"><p>Data kosong</p></td></tr>
		@endif
	</table>
	<br>
	@yield('content2')
@endsection