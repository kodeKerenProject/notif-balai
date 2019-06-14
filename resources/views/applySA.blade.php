<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	@if(count($errors) > 0)
	<div class="alert alert-danger">
		@foreach ($errors->all() as $error)
		{{ $error }} <br/>
		@endforeach
	</div>
	@endif
	
	<form method="POST" action="{{ url('sa') }}" enctype="multipart/form-data">
		@csrf
		<table>
			<tr>
				<td>1. Surat Permohonan Sertifikasi SNI</td>
			</tr>
			<tr>
				<td><input type="file" name="dok[]"></td>
			</tr>
			<tr>
				<td>2. Daftar Isian Kuesioner</td>
			</tr>
			<tr>
				<td><input type="file" name="dok[]"></td>
			</tr>
			<tr>
				<td>3. Copy IUI</td>
			</tr>
			<tr>
				<td><input type="file" name="dok[]"></td>
			</tr>
			<tr>
				<td><button type="submit">Submit</button> | <button type="reset">Reset</button></td>
			</tr>
		</table>
	</form>
</body>
</html>