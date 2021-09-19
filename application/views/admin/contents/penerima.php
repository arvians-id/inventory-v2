<div class="content-wrapper">
	<div class="page-header">
		<h3 class="page-title"> Daftar Penerima </h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Page</a></li>
				<li class="breadcrumb-item active" aria-current="page">Penerima</li>
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
						<a href="<?= base_url('penerima/create') ?>" class="btn btn-primary">Tambah</a>
					</p>
					<table id="example" class="table table-striped display responsive nowrap">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Penerima</th>
								<th>Jenis Penerima</th>
								<th>Dibuat</th>
								<th>Terakhir Diubah</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
							foreach ($data_penerima as $penerima) : ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $penerima['nama_penerima'] ?></td>
									<td><?= $penerima['jenis_penerima'] ?></td>
									<td><?= $penerima['created_at'] ?></td>
									<td><?= $penerima['updated_at'] ?></td>
									<td class="text-center">
										<a href="<?= base_url('penerima/update/' . $penerima['id_penerima']) ?>" class="btn btn-primary btn-sm">Ubah</a>
										<a href="<?= base_url('penerima/delete/' . $penerima['id_penerima']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('WARNING! Jika anda menghapus data ini, data penerima pada barang masuk akan kosong.')">Hapus</a>
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
