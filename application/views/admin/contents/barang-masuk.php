<div class="content-wrapper">
	<div class="page-header">
		<h3 class="page-title"> Daftar Barang Masuk </h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Page</a></li>
				<li class="breadcrumb-item active" aria-current="page">Barang Masuk</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">

					<?php if ($this->session->flashdata('success')) : ?>
						<div class="alert alert-success" role="alert">
							<?= $this->session->flashdata('success'); ?>
						</div>
					<?php elseif ($this->session->flashdata('error')) : ?>
						<div class="alert alert-danger" role="alert">
							<?= $this->session->flashdata('error'); ?>
						</div>
					<?php endif; ?>

					<p class="class-description">
						<a href="<?= base_url('barang-masuk/create') ?>" class="btn btn-primary">Tambah</a>
					</p>
					<table id="example" class="table table-striped display responsive nowrap">
						<thead>
							<tr>
								<th>No</th>
								<th>Kode Transaksi</th>
								<th>Barang</th>
								<th>Penerima</th>
								<th>Jumlah Masuk</th>
								<th>Tanggal Masuk</th>
								<th>Keterangan</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
							foreach ($data_barang_masuk as $barang_masuk) : ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $barang_masuk['kode_masuk'] ?></td>
									<td><?= $barang_masuk['nama_barang'] . ' &mdash; ' . $barang_masuk['kode_barang'] ?></td>
									<td><?= empty($barang_masuk['nama_penerima']) ? '<span class="text-danger">Penerima tidak ditemukan!</span>' : $barang_masuk['nama_penerima'] . ' &mdash; ' . $barang_masuk['jenis_penerima'] ?></td>
									<td><?= $barang_masuk['jumlah_masuk'] ?></td>
									<td><?= date('l, d M Y', strtotime($barang_masuk['tanggal_masuk'])) ?></td>
									<td><?= $barang_masuk['keterangan_masuk'] ?: '&mdash;' ?></td>
									<td class="text-center">
										<a href="<?= base_url('barang-masuk/update/' . $barang_masuk['kode_masuk']) ?>" class="btn btn-primary btn-sm">Ubah</a>
										<a href="<?= base_url('barang-masuk/delete/' . $barang_masuk['kode_masuk']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('WARNING! Jika anda menghapus data ini, stok barang akan ikut berubah.')">Hapus</a>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- content-wrapper ends -->
