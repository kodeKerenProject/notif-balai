@extends('layouts/app')

@section('content')
	<div class="right">
		<b><i>List Produk</i></b><br>
		<table border="1">
			<tr>
				<td>No</td>
				<td>Nama Produk</td>
				<td>Aksi</td>
			</tr>
			@if(!is_null($produk))
				@foreach($produk as $key => $data)
				<tr>
					<td>{{ $key+=1 }}</td>
					<td>{{ $data->produk }}</td>
					<td></td>
				</tr>
				@endforeach
			@else
				<tr><td colspan="3"><p>Data kosong</p></td></tr>
			@endif
		</table>
	</div>
@endsection