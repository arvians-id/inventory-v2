<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title ?></title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">

</head>

<body>

	<table class="table">
		<thead>
			<tr>
				<th>No</th>
				<th>Kode Transaksi Barang Masuk</th>
				<th>Nama Barang</th>
				<th>Nama Penerima</th>
				<th>Jumlah Masuk</th>
				<th>Tanggal Masuk</th>
				<th>Keterangan</th>
				<th>Tanggal Input</th>
			</tr>
		</thead>
		<tbody>
			<?php $no = 1;
			foreach ($data_laporan as $laporan) : ?>
				<tr>
					<td><?= $no++ ?></td>
					<td><?= $laporan['kode_masuk'] ?></td>
					<td><?= $laporan['nama_barang'] . ' - ' . $laporan['kode_barang'] ?></td>
					<td><?= $laporan['nama_penerima'] . ' - ' . $laporan['jenis_penerima'] ?></td>
					<td><?= $laporan['jumlah_masuk'] ?></td>
					<td><?= $laporan['tanggal_masuk'] ?></td>
					<td><?= $laporan['keterangan_masuk'] ?></td>
					<td><?= $laporan['tanggal_input'] ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
	<script>
		window.print();
	</script>
</body>

</html>
