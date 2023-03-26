<!DOCTYPE html>
<html>
<head>
	<title>Kwitansi Pembayaran Tagihan</title>
</head>
<body>
	<h1>KWITANSI PEMBAYARAN TAGIHAN</h1>
	<table>
        <tr>
			<td>Tanggal:</td>
			<td>: {{ $user->tanggal }}</td>
		</tr>
		<tr>
		<tr>
			<td>Jenis Tagihan</td>
			<td>: {{ $user->tagihan }}</td>
		</tr>
		<tr>
			<td>Nama Pedagang</td>
			<td>: {{ $user->name }}</td>
		</tr>
			<td>Jenis Dagangan</td>
			<td>: {{ $user->jenis }}</td>
		</tr>
		<tr>
			<td>Nominal</td>
			<td>: {{ $user->nominal }}</td>
		</tr>
		<tr>
			<td>Keterangan</td>
			<td>: {{ $user->keterangan }}</td>
		</tr>
		<tr>
			<td>Petugas</td>
			<td>: {{ $user->petugas }}</td>
		</tr>
	</table>
</body>
</html>
