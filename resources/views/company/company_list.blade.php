@extends('layouts/app')

@section('content')
	<b><i>List Perusahaan yang mengajukan sertifikasi produk</i></b><br>
	<table border="1">
		<tr>
			<td>No</td>
			<td>Nama Perusahaan</td>
			<td>Pimpinan Perusahaan</td>
			<td>Aksi</td>
		</tr>
		@foreach($client as $key => $data)
		<tr>
			<td>{{ $key+=1 }}</td>
			<td>{{ $data->nama_perusahaan }}</td>
			<td>{{ $data->pimpinan_perusahaan }}</td>
			<td><a href="{{ url('/company/'.$data->id) }}">Daftar Produk</a></td>
		</tr>
		@endforeach
	</table>
@endsection